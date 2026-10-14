---
title: "How the PHP Security Team Handles Your Reports"
description: "Where PHP security triage stands, the tools we use, and how to send a report we can act on"
layout: post
tags:
    - security
author:
  - alexandre-daubois
published_at: 14 October 2026
---

If you've ever sent a security report to PHP and then refreshed the advisory page every morning for three weeks, hi, this one's for you, and yes, we read it. PHP runs a large share of the web, so keeping it secure and staying responsive matters far beyond this project, and we take that seriously. There is a small group of volunteers and PHP Foundation contractors doing its best to handle security for PHP core with the limited time and resources available, and this post will show how we are going about it. Considering the significance of PHP's security to many businesses, committing financial resources to The PHP Foundation enables us to help keep companies safe and adequately respond to threats. Without this financial support, we all face an increasingly greater risk of exploits, so we encourage you to partner with us through [sponsorship](https://opencollective.com/phpfoundation).

## Who's on the other end

I'm part of the PHP security team, which triages the reports that come in for php-src. The team is a mix of community members and developers funded by the PHP Foundation, and it runs on its own, separate from the Foundation. The Foundation's [Ecosystem Security Team](https://thephp.foundation/blog/2026/05/18/announcing-ecosystem-security-team/) works alongside us. No report gets a verdict until one of us has read it, tried to reproduce it and checked it against our classification policy.

## What we've shipped since July

Since July 1st, we've published **15 CVEs**. We also closed **106 reports** after determining they did not constitute vulnerabilities, were duplicating something already in the queue, or didn't reproduce. Some came from very confident fuzzers running PHP in ways no production setup does. Each of those got a look before we closed it, so if yours was one of them, someone on the team read it. Closing a report doesn't always mean dropping the issue entirely. The ones that aren't vulnerabilities, but still classify as bugs or that would still make PHP sturdier, become hardening work. [Daniel Scherzer joined the Ecosystem Security Team](https://thephp.foundation/blog/2026/09/09/welcome-daniel-scherzer/) recently to take on this work.

The CVE IDs for our advisories come from us, too. The PHP Group is a CVE Numbering Authority with php-src as its scope, and it has assigned its own CVE IDs since 2019, so **we don't wait on anyone else to get a CVE for a PHP vulnerability**. That matters this year, because GitHub's advisory queue has grown to the point where reviews take weeks for a share of reports, and projects that rely on GitHub for their CVE IDs can end up waiting with it. We don't depend on that queue, so when a fix is ready, **the advisory and its CVE go out on our schedule**.

There's still a backlog of security reports, and we'd rather tell you than pretend otherwise. We keep working through it, and **a quiet advisory doesn't mean a forgotten one**. If you're waiting, thanks for the patience, and please resist the urge to open a public issue to nudge us, because that tells everyone about the bug before there's a fix. But if your business depends on PHP's security and you are not yet a PHP Foundation sponsor, we urge you to become one to help us with this important work.

## The tooling

AI tools have made security reports much cheaper to write over the last year, and php-src gets far more of them than it used to. Keeping up with that by hand isn't realistic, so we automate more of the work and use AI on our side too.

We reproduce on Linux, macOS, Windows and whatever other platform a report needs. Our builds run AddressSanitizer and UndefinedBehaviorSanitizer and are set up like our CI. A crash that only shows up on one custom build doesn't tell us much about the PHP you deploy.

We've also added **Daybreak Red** to the setup. It's the highest tier of OpenAI's Daybreak program, restricted to approved defenders and built for vulnerability research and exploit validation, so **we're fully equipped for this kind of work**. OpenAI opened it to the project as part of its support for open source maintainers. We use it in two ways: It helps us validate reports, following a proof of concept through the engine, and it checks whether the claimed impact holds up. It also helps us sort the queue by spotting reports that hit the same root cause from different ends and pointing us at the ones worth reading first.

Earlier this year we also had access to **Claude Mythos**, the Anthropic model that led the field on security work at the time, and we put it to work on protecting PHP. That access came mostly through connections we made at [Alpha-Omega](https://alpha-omega.dev/), and we're grateful to them for it. Having an organization like the PHP Foundation behind us gives us structured access to resources like these.

**The models don't make the calls, though.** Every verdict is made by a person who sets the severity and writes or reviews every patch, and no reporter hears back about an analysis a person hasn't attempted to reproduce.

## How to report so we can move fast

Most importantly, use the [GitHub security advisory form](https://github.com/php/php-src/security/advisories/new). Please keep public issues, pull requests and social posts out of it.

The reports that move fastest through our queue have the smallest PHP script that triggers the problem, the PHP version or commit, the OS and the configure flags, plus the full sanitizer output if available. Above all, the best reports tell us **the impact**: which input an attacker controls, in what kind of app, and what they get out of it. The impact is glossed over most often, and it's the part that decides the severity. However, please avoid unnecessarily long and overly dramatic reports that force us to spend a lot of time reading for what could be a simple investigation.

Our [security classification policy](https://github.com/php/policies/blob/main/security-classification.rst) lists what we don't treat as a vulnerability, and it's worth a read before you hit submit. Malicious code that is valid PHP, unsanitized input passed to functions like `mysqli_query()`, FFI, `open_basedir` bypasses, non-standard builds and the built-in web server all fall outside it. Plenty of those are still bugs, and the public issue tracker is happy to take them.

## About AI-written reports

Reports found or written with AI tools are welcome, as long as you did what we'd ask of anyone: **reproduce the issue on a PHP build**, check it against the policy, and understand what you're sending. Raw model output with a crash that doesn't reproduce takes us just as long to rule out as a real bug takes to confirm, and we'll have to close it.

## That's it from us

Please fund our security work through a [PHP Foundation sponsorship](https://thephp.foundation/donate/). We'll keep shipping fixes and advisories, with volunteers and Foundation-funded developers working side by side. If you've found something, send it our way and one of us will read it. And if you already did, please bear with us. We'll get back to you soon!
