---
title: "Today's PHP Security Release, and How We're Strengthening PHP Security"
description: "Describing the story behind how critical security vulnerabilities were found and fixed."
layout: post
tags:
    - news
    - security
author:
  - the-php-foundation
published_at: 21 October 2026
---
Earlier today, the PHP project released PHP 8.5.12, 8.4.27, 8.3.36, and 8.2.35. These releases fix two critical vulnerabilities that, under the right conditions, allow an unauthenticated attacker to execute code on servers running PHP. If you run PHP, it is imperative that you update now. The [announcement on php.net](https://www.php.net/archive/2026.php#2026-10-21-5) contains and references technical details on the vulnerabilities, attack vectors, and instructions on how to update on which systems.

This post isn't about how to update. It's about how these vulnerabilities were found and fixed, what has changed in how PHP security is handled over the past two years, and what we need from the organizations that depend on PHP to keep PHP's security work going.

## Two related critical remote code execution vulnerabilities

* CVE-2026-109618 / [GHSA-w8hw-w9fx-j79w](https://github.com/php/php-src/security/advisories/GHSA-w8hw-w9fx-j79w): **RCE via OOM corruption** (out-of-memory): If a request reached PHP's memory\_limit at exactly the wrong moment, PHP could leave partially initialized internal data behind and later treat it as valid, corrupting memory. On Apache with mod\_php, an unauthenticated request can trigger this before any application code runs, and full remote code execution was demonstrated with default settings. Remote code execution was also confirmed on PHP-FPM through application-level code paths.  
* CVE-2026-109619 / [GHSA-6wmf-4rv5-p3rp](https://github.com/php/php-src/security/advisories/GHSA-6wmf-4rv5-p3rp): **RCE via stale global state**: A fatal error at the wrong point could leave internal state pointing to memory that belonged to a previous request. A later request handled by the same worker could then use that freed memory. A use-after-free and worker crash were confirmed, and the reporter demonstrated remote code execution against a real-world application running on Apache with mod\_php.

Both issues sit in parts of PHP that nearly every request touches: memory management and error handling. Their central place in PHP is what made both vulnerabilities serious, and also so hard to fix without breaking compatibility, hurting performance, or forcing changes on the large ecosystem of third-party extensions.

## A first external audit and increased security focus

In 2024, PHP underwent its first [external security audit](https://thephp.foundation/blog/2025/04/10/php-core-security-audit-results/) in years. The PHP Foundation secured funding from the Sovereign Tech Agency to organize this audit through [OSTIF](https://ostif.org/), and it was carried out by [Quarkslab](https://www.quarkslab.com/). While fixing one of the issues Quarkslab reported, a PHP core developer contracted by the PHP Foundation found the first signs of the OOM problem behind CVE-2026-109618. In 2024, a potential exploit for the OOM problem was theorized, but no concrete vectors were found and other concrete issues with clear impact overshadowed these concerns.

To fix the OOM problem, the PHP security team developed several competing approaches, but each came with its own trade-offs: backward compatibility breaks, new denial-of-service potential, or requiring changes to many third-party extensions which seemed impossible to coordinate. The PHP security team, operating on consensus, struggled to choose between these and feared the repercussions of shipping the wrong choice. Combined with the lack of a known path to remote code execution and the small team of core developers with the necessary deep knowledge of the engine occupied with many responsibilities, this decision process caused work on a fix to stall and restart repeatedly over months. We won't pretend otherwise: the delay was a structural failure, caused by both the security team's decision process and its lack of resources. The security team has since started changing its processes, and that work continues, so that decisions can be made by majority and compromises are encouraged.

## Building a sustainable professional security organization

Over the last months the way PHP security work is organized has changed considerably. In May 2026, the PHP Foundation created the [Ecosystem Security Team](https://thephp.foundation/blog/2026/05/18/announcing-ecosystem-security-team/), which works alongside the PHP security team on triage, coordination, and hardening. Volker Dusch's work as AI Security Engineer in Residence at the PHP Foundation has significantly improved communication and collaboration between the PHP security team and the Foundation. [Alexandre Daubois joined](https://thephp.foundation/blog/2026/07/14/welcoming-alexandre-daubois/) the PHP Foundation in July to help the PHP security team triage, handle, and fix security reports and [Daniel Scherzer joined](https://thephp.foundation/blog/2026/09/09/welcome-daniel-scherzer/) in September to take on hardening work.

Earlier this year, we worked with [Alpha-Omega](https://alpha-omega.dev/) to scan PHP with Anthropic's Claude Mythos. But since the Mythos scan, we have added other tools, including OpenAI's Daybreak Red for validating reports and exploits, alongside sanitizer builds and reproduction environments that match our CI on every platform PHP supports.

The PHP Foundation got the PHP project into the [Patch the Planet](https://openai.com/index/patch-the-planet/) program, as part of which security firm [Calif](https://calif.io/) began an audit of PHP on July 30th, 2026\. On August 11th  researcher Ryan A at Calif reported an unconditional remote code execution with the same root cause as the OOM problem we had found in 2024\. [OpenAI](https://openai.com/) independently reported the same root cause on the same day, followed by further attack vectors from OpenAI on September 18th and from [Wiz](https://www.wiz.io/) on August 24th. More recently, [Trail of Bits](https://trailofbits.com/) has also been auditing PHP. The reports from Calif, OpenAI, and Wiz made the full impact of the OOM problem clear, and from August 11th onward, fixing it became the top priority for all of the PHP Foundation's team working on security. Without the Foundation’s funding it would have been impossible to have multiple people work on this issue full time, eventually through weekends and around the clock to coordinate and communicate with other involved parties.

The growth of AI-assisted research also means the PHP security team receives far more reports than before. As Alexandre Daubois described last week in [How the PHP Security Team Handles Your Reports](https://thephp.foundation/blog/2026/10/14/how-the-php-security-team-handles-your-reports/), the team has published 15 CVEs since July 1st and worked through more than 100 reports that turned out to be invalid, duplicates, or not reproducible. AI helps the team validate reports and group reports sharing the same root cause, but a person makes every call and works on every patch.

## Leak and disrupted disclosure

The coordinated disclosure of these vulnerabilities worked well until 2 days ahead of the targeted release date.

On Tuesday, October 20th, at around 15:00 UTC, the two CVE IDs began circulating on online forums and social media. They came with a wrong release time and a wrong CVSS score of 10.0 (the actual score is 9.2). No technical details leaked. In response, the PHP project brought its pre-announcement forward and [published it at 19:30 UTC](https://www.php.net/archive/2026.php#2026-10-20-1). It also moved the release from October 22nd, 14:00 UTC, to October 21st, 14:00 UTC. Distributors were still packaging the fix, so releasing immediately would have left many users without an easy way to update. Moving the release forward by one day was the best compromise between acting quickly, giving people time to prepare, and making sure everyone had a simple update path when the vulnerabilities were disclosed.

As a result of the leak and pre-announcement around 20:00 UTC, Calif, one of the security firms that had reported the issues, mistakenly published a video. It showed their proof of concept working against a number of targets and revealed a few additional, though limited, details about the vulnerabilities. Copies of the deleted video started circulating on social media soon after. The video contributed to accelerated development of various PoCs (exploitation proof of concepts), which then increased circulation on October 21st.

Mitigation advice we started providing to a few critical infrastructure providers around Oct 20th 23:00 UTC, may have leaked as well. The PHP security team closely monitored and inspected appearing PoCs after the leak but did not identify any functional exploits at the time of release/public disclosure.

On October 21st at 07:41 UTC, more than six hours before the coordinated release, Chainguard unilaterally broke the embargo and published built images containing the fix. Like other distributors, Chainguard had received the patch in advance so its users could update the moment the vulnerabilities were disclosed. Any attacker could now study the fix in binary form while every other PHP user was still waiting for the release. This disregarded weeks of work by many parties toward a coordinated disclosure.

## A cautiously optimistic outlook

Today's release shows the progress we’re making in how PHP security is handled. Once the full impact of the OOM problem was understood in August, the security team, the foundation, and the release managers delivered a fix for this deeply rooted problem across all supported branches, and distributions and LTS vendors received the patch ahead of time so their users can update quickly.

We are confident that a serious vulnerability with a fix stuck on hard trade-offs would now reach the PHP Foundation leadership much sooner, as we’re changing processes so leadership can help steer the situation to a timely resolution. We are now prioritizing measures to make sure vulnerabilities that need similarly complex fixes get resolved faster when they are reported in the future. The PHP Foundation and the PHP security team learned a lot in the last weeks and will work to turn their experiences into lasting repeatable processes.

## What we need from you

PHP runs a large share of the web, including government services, online stores, banks, media sites, and much of the software that businesses rely on every day. Yet security work on PHP itself still depends on a small group of foundation-funded developers and a little volunteer help.  

Tools now find bugs faster than ever, for defenders and attackers alike, and the number of reports will keep growing. What tools cannot do is decide on the right fix for a long-standing design decision in the engine, weigh the compatibility trade-offs, and review the patch. Making those decisions takes experienced engineers who know the entire PHP codebase, and today there are too few of them.

A core part of the PHP Foundation's mission is to grow the number of engineers with deep knowledge of the PHP codebase and give the security team the resources it needs. We can only achieve this goal with funding from those who depend on PHP:

* Companies that build products and services on PHP: please sponsor the PHP Foundation at a level that reflects how much you rely on it.  
* Hosting providers, cloud platforms, and distributions that deliver PHP to millions of users.  
* Governments and public institutions whose services run on PHP. The German Sovereign Tech Agency's funding of the 2024 audit shows what public investment can achieve, and we need more of it, on a sustained basis.

Sponsoring the PHP Foundation is the most direct way to ensure structural issues like the OOM vulnerability are addressed sustainably, before they turn into emergencies. Become a sponsor at [thephp.foundation/sponsor](https://thephp.foundation/sponsor/), and if your organization would like to talk about a larger commitment, [get in touch](https://thephp.foundation/contact).

## Thank you

Thank you to the PHP security team, volunteers and PHP Foundation contractors alike, the release managers, and the package maintainers at distributions and LTS vendors who made these releases possible. Thank you to Calif, especially Ryan A, Wiz, OpenAI Codex Security, especially Amy Burnett, OSTIF, and Quarkslab for their research and responsible disclosure; to Alpha-Omega, OpenAI, and Anthropic for giving the team access to their tools and funding some of the security work; to the Sovereign Tech Agency for funding the 2024 audit; and to all of our sponsors, whose support made this work possible.
