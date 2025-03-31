---
title: 'The PHP Foundation: Impact and Transparency Report 2024'
layout: post
tags: 
  - report
author:
  name: Roman Pronskiy
  url: https://twitter.com/pronskiy
published_at: 31 March 2025
---

## Executive Summary

As of early 2025, The PHP Foundation comprises **8 volunteer board members**, **an Executive Director** sponsored by JetBrains, and **10 developers** paid part-time/full-time who contribute significantly to the PHP language and its extensions.

In 2024, The PHP Foundation received **$683,550 in donations and investments** from organizations and individuals.

The foundation’s primary focus in 2024 remained strengthening the maintenance of PHP core, housed in the [php/php-src](https://github.com/php/php-src) GitHub repository. This project is the home of the PHP language, where PHP’s interpreter is developed. Everyone who uses PHP benefits in one way or another from the work that is done in this repository.

The 10 part-time and full-time developers contracted by The PHP Foundation were responsible for a substantial portion of the commits and reviews made to the PHP language.

**Key achievements in 2024 included:**

* Completion of projects funded by the Sovereign Tech Fund
* Expansion of the development team
* Increased contributions to PHP core
* Enhanced community engagement and sponsor relations

The foundation **plans to spend up to $900,000 in 2025**, including compensation and fees. We continue to seek additional sponsor contributions to sustain and expand these efforts in the coming years.

## The PHP Foundation Mission

The PHP Foundation’s mission remains focused on ensuring the long-term prosperity of the PHP language. Our priorities continue to be:

* Improving the language for users
* Providing high-quality maintenance
* Improving the project to retain current contributors and integrate new ones
* Promoting the public image of PHP

## The PHP Foundation Sponsors

In 2024, the following companies made major financial contributions (donating $12,000 or more):

**Sovereign Tech Agency, JetBrains, Automattic, Laravel, GoDaddy.com, Craft CMS, Private Packagist, Cybozu, Tideways, Mercari Inc., pixiv Inc., Sentry, Manychat, Zend by Perforce, Les-Tilleuls.coop, CH Studio, Aternos GmbH.**

Overall, 658 organizations and individuals sponsored the foundation in 2024 through [on Open Collective](https://opencollective.com/phpfoundation) and [GitHub Sponsors](https://github.com/sponsors/ThePHPF).

Here is what some of the prominent folks say.

{{ include('quote.html', {
name: 'Taylor Otwell',
title: 'Founder \& CEO, Laravel',
image: '/assets/post-images/2025/report-2024/taylor.png',
quote: 'The PHP Foundation plays a vital role in ensuring the long-term sustainability and health of PHP. By supporting core development and fostering collaboration across the community, the Foundation helps keep PHP modern, stable, and thriving for years to come.'
}) }}

{{ include('quote.html', {
name: 'Artemy Pestretsov',
title: 'Product Leader, PhpStorm at JetBrains',
image: '/assets/post-images/2025/report-2024/artemy.png',
quote: 'At JetBrains, we\’re proud to support the PHP Foundation and its commitment to strengthening PHP. It’s great to see how the Foundation’s achievements directly benefit the developer community we deeply care about, and we’re excited to be part of PHP’s ongoing success.'
}) }}

{{ include('quote.html', {
name: 'Courtney Robertson',
title: 'Open Source Developer Relations, GoDaddy',
image: '/assets/post-images/2025/report-2024/courtney.png',
quote: 'At GoDaddy, we recognize that PHP is the backbone of the open web and the engine powering many of the sites we host. Our contribution to The PHP Foundation is a strategic investment in maintaining the secure, reliable, and innovative technology that drives our digital ecosystem.'
}) }}

{{ include('quote.html', {
name: 'Nils Adermann',
title: 'Co-Founder, Composer, Private Packagist',
image: '/assets/post-images/2025/report-2024/nils.png',
quote: 'PHP is absolutely vital to global business, enabling digital public spaces, human interaction, and commerce around the world. We’re proud to do our part by contributing to PHP’s continuous improvements through the PHP Foundation, and call on all other companies relying on PHP to join us.'
}) }}

{{ include('quote.html', {
name: 'Chad Whitacre',
title: 'Head of Open Source, Sentry',
image: '/assets/post-images/2025/report-2024/chad.jpeg',
quote: 'PHP is my favorite foundation. There I said it. Why? Their primary objective is to **pay developers**. You\'d think that is obvious but most foundations do everything _but_ that.'
}) }}

## Projects for The Sovereign Tech Agency Delivered Successfully

The [Sovereign Tech Agency](https://www.sovereign.tech/) (STA) supports the development, improvement, and maintenance of open digital infrastructure in the public interest. Its goal is to strengthen the open-source ecosystem sustainably, focusing on security, resilience, technological diversity, and the people behind the code. STF is funded by the German Federal Ministry for Economic Affairs and Climate Action (BMWK) and supported by the German Federal Agency for Disruptive Innovation GmbH (SPRIND).

<img src="/assets/post-images/2025/report-2024/stA.png" width="597" alt="STA">

The Sovereign Tech Agency commissioned work on four major projects, all of which we successfully delivered. Here’s a brief overview of the results.

### PECL Overhaul  
The previous system for distributing PHP extensions, PECL/PEAR, is outdated, clumsy for users, and prone to supply-chain attacks, making it unreliable for average developers. This as a result leads to the creation of redundant tools and multiple security issues.

We proposed to rewrite the PECL installer, replacing the messy code and the inefficient website.

The result is [**🥧PIE**](https://github.com/php/pie) **(PHP Installer for Extensions)**, a new tool that replaces PECL with a PHP-native toolchain that is easier to maintain and more secure. It relies on the packagist.org infrastructure which is also a native PHP ecosystem.

Follow the progress of **PIE** here: [https://github.com/php/pie](https://github.com/php/pie).

The tool has already gathered a group of [contributors](https://github.com/php/pie/graphs/contributors) and was well received in the community:

* [Pie: new extension installer for PHP](https://blog.codito.dev/2024/11/pie-new-extension-installer-for-php/)
* [PIE: The PHP’s Next Big Thing](https://phpconference.nl/session/pie-the-phps-next-big-thing/)
* [Introducing PIE: The Modern PHP Extension Installer](https://sensiolabs.com/blog/2024/introducing-pie-php-extension-installer)
* [PIE (PHP Installer for Extensions)](https://laravel-news.com/pie)

We continue investing in PIE in 2024.
### Web Services Tool for PHP-FPM  
The Web Services Tool (WST) is a command-line application designed to test PHP-FPM integration across different web servers, environments, and configurations.

Currently, the tool is hosted under a separate GitHub organization (wstool/wst), with plans to move it to the official PHP GitHub organization in the future.

WST has already proven valuable for PHP-FPM development and testing, helping to identify and address complex issues that were previously untested in an automated way.

Learn more in the [introductory blog post](https://thephp.foundation/blog/2024/10/21/web-services-tool-for-php-fpm/).

### Security Audit
We conducted the first external security audit of the PHP core source code in over a decade. The audit is organized in partnership with [**OSTIF**](https://ostif.org/) and performed by [**Quarkslab**](https://www.quarkslab.com/).

The public report is currently pending and will be published on [The PHP Foundation website](https://thephp.foundation/) once available.

### Documentation Improvements  
We made multiple incremental improvements to the PHP documentation and also conducted a security review of the docs. Like the source code audit, this review was organized in partnership with [**OSTIF**](https://ostif.org/) and performed by [**Quarkslab**](https://www.quarkslab.com/). As the scope here was too huge, we had to be smart and limit the review to certain most impactful pages.

Additionally, a new Wasm-based PHP runner has been included allowing all code example blocks to be executed directly on the page thanks to [Les-Tilleuls.coop](https://les-tilleuls.coop/en). Further improvements have been made since then, by fixing more examples and including resources to make the XML extensions' examples work..

An auto-cleaner script has also been added that removes comments older than 1 year with a score of \-5 or lower.  This has removed around 2000 low-quality notes from the site.

### Infrastructure Update  
As part of [The Sovereign Tech Bug Resilience Program](https://www.sovereign.tech/programs/bug-resilience), we partnered with [Neighbourhoodie Software](https://neighbourhood.ie/) to overhaul the scripts powering parts of PHP’s web infrastructure, and also set up more appropriate back-ups.
Previously scattered scripts have been consolidated into robust Ansible playbooks. The rollout is currently being planned, and will result in a much easier to maintain and restore the PHP project's infrastructure. In the future, all infrastructure will likely be managed through this.

## The PHP Foundation Staff

### Renewing contracts

In 2023, we had a team of 6 developers. All of them demonstrated a high quality of work, and dedication to the mission of the foundation. We were happy to renew the contracts for 2024 as well as extend the total number of hours for developers requesting it.

We aim to review the rates every year based on the available funding and priorities.

### Growing the Team

As was mentioned in the previous transparency report, we aimed to extend the team. It did not happen in 2023 because one of the prospective developers could not join the team for personal reasons, and had to step down from PHP core development entirely. Again, this is [the Bus Factor at its worst](https://blog.jetbrains.com/phpstorm/2021/11/the-php-foundation/#the_bus_factor). However, we were able to extend the team starting with 2024\.

Initially, we offered the new developers 6-month trial contracts so that the developers and the Governing Board can evaluate the results and then decide whether to continue the engagements. The results were far beyond our expectations. All new developers David Carlier, James Titcumb, Saki Takamachi, and Shivam Mathur demonstrated dedication and brought high value results, and demonstrated value.

### Why didn’t we add more developers?

In October 2024, following our usual process, we [opened applications](https://thephp.foundation/blog/2024/09/17/application-form-2025/) to expand or update our development team. We received many applications, including some from highly qualified candidates. However, we ultimately decided not to expand the team this time.

**The main reason is simple: budget constraints.**

Our funding from sponsorships determines how much we can afford, and we prioritize long-term stability over short-term expansion. Retaining the current team ensures we maintain the compound benefits of accumulated knowledge and experience. Growing the team temporarily, only to downsize later, would be counterproductive.

If we secure additional funding throughout the year, we may revisit the decision to expand the team.

### The team as of 2025

Starting from January, we continue contracting 10 developers to work on PHP:

* **Arnaud Le Blanc** [@arnaud-lb](https://github.com/arnaud-lb)
* **David Carlier** [@devnexen](https://github.com/devnexen)
* **Derick Rethans** [@derickr](https://github.com/derickr)
* **Gina Peter Banyard** [@Girgias](https://github.com/Girgias)
* **Ilija Tovilo** [@iluuu1994](https://github.com/iluuu1994)
* **Jakub Zelenka** [@bukka](https://github.com/bukka)
* **James Titcumb** [@asgrim](https://github.com/asgrim)
* **Máté Kocsis** [@kocsismate](https://github.com/kocsismate)
* **Saki Takamachi** [@SakiTakamachi](https://github.com/SakiTakamachi)
* **Shivam Mathur** [@shivammathur](https://github.com/shivammathur)

## Retrospective: Goals of 2024

In the previous report, we outlined a few organizational and technical goals. Let’s look back and evaluate the results.

### Organization goals

**Onboard new major sponsors ❌✅**  
We did have a few new and returning major sponsors, including Laravel, GoDaddy, Manychat. And of course we are happy about ongoing sponsorship from our founding members, and [increased commitment from Automattic](https://x.com/ThePHPF/status/1853390265429508427).

**Explore strategic partnerships and marketing opportunities ✅**  
We did collaborate with the Sentry team on Open Source Pledge initiative

**Further develop the Advisory Board initiative ❌**  
The Advisory Board played a big role in [shaping the Hooks RFC](https://thephp.foundation/blog/2024/11/01/how-hooks-happened/). However, we has much more potential. In 2025, we’d like to revamp the AB to make it more useful and collaborative.

**Grow the foundation's community ✅**  
The PHP Foundation Slack is an invite-only community, and its closed nature has helped keep it very productive. We gradually add more community leaders and developers, along with one-channel guests for specific tasks. We also maintain a public channel, **\#php-internals**, which is mirrored on the [PHP Community Discord server](https://phpc.chat/).

### Technical goals

**Ongoing maintenance and development of the PHP core ✅**

**Deliver the STF projects ✅**

**Improve the quality of the ideas and RFCs coming from the foundation ✅**  
All of the RFCs from The PHP Foundation — even major ones like Hooks — passed the vote. We see that as a clear sign of the proposals’ quality.

**Conduct research and surveys to define priorities ❌✅**  
We conducted [quantitative research](https://youtu.be/XE4g1Tl6RQw?si=6zlWRFlyaKnv9cji&t=843) in collaboration with the [PhpStorm](https://www.jetbrains.com/phpstorm/) team and  
JetBrains. However, we were unable to conduct a PHP community survey. Nevertheless, we supported [Zend by Perforce PHP Landscape Survey](https://www.zend.com/blog/2025-php-survey-launch).

**Develop a high-level roadmap for PHP changes sponsored by the foundation ❌**
The roadmap and vision need further development and discussion. We plan to announce a few strategic moves in the upcoming months.

## PHP Language Impact

Every day, the PHP Foundation staff team contributes to the open-source repositories of the [PHP GitHub organization](https://github.com/php). The foundation team contributes in many forms: filing issues, reviewing pull requests, participating in discussions on mailing lists, triaging issues, submitting RFC proposals.

In this document, four categories of contributions are presented in more detail: commits to php-src, reviews of pull requests on php-src, submitted RFC documents, and documentation work.

### Commits to PHP

The following chart summarizes the number of commits made to the [php/php-src](https://github.com/php/php-src) repository in 2024\.

|                             | 2022 | 2023 | 2024 |
|:----------------------------|:----:|:----:|:----:|
| Total by The PHP Foundation | 683  | 784  | 1976 |
| Total other                 | 885  | 1588 | 3378 |

![Commits](/assets/post-images/2025/report-2024/commits.svg)

We’re happy to see not only an **increase in commits from PHP Foundation** developers but also a significant **boost in contributions from other developers** and the wider community. We consider this one of our biggest achievements and a strong sign of a thriving, **healthy ecosystem**.

> Note that the number of commits does not fairly represent the level of effort or the scope of the work. However, it can demonstrate the foundation's relative level of contribution to the PHP core through an objective metric.

### Reviews

The diagram summarizes the number of pull request reviews made in the [php/php-src](https://github.com/php/php-src) repository from January 1 to December 31, 2024\.

|                             | 2022 | 2023 | 2024 |
|:----------------------------|:----:|:----:|:----:|
| Total by The PHP Foundation | 283  | 702  | 1278 |
| Total other                 | 551  | 416  | 866  |

![Reviews](/assets/post-images/2025/report-2024/reviews.svg)

### RFCs

Below are the RFC proposals authored or co-authored by The PHP Foundation developers in 2024 (date order).

| RFC                                                                                                                                   | Proposed   | Status      |
|:--------------------------------------------------------------------------------------------------------------------------------------|:-----------|:------------|
| [Property hooks](https://wiki.php.net/rfc/property-hooks)                                                                             | 2023-01-03 | Implemented |
| [Release cycle update](https://wiki.php.net/rfc/release_cycle_update)                                                                 | 2023-11-05 | Implemented |
| [Dedicated StreamBucket class](https://github.com/php/php-src/pull/13111)                                                             | 2024-01-19 | Implemented |
| [Support object type in BCMath](https://wiki.php.net/rfc/support_object_type_in_bcmath)                                               | 2024-03-24 | Implemented |
| [Correctly name the rounding mode and make it an Enum](https://wiki.php.net/rfc/correctly_name_the_rounding_mode_and_make_it_an_Enum) | 2024-04-21 | Implemented |
| [Asymmetric Visibility v2](http://wiki.php.net/rfc/asymmetric-visibility-v2)                                                          | 2024-05-09 | Implemented |
| [Lazy Objects](https://wiki.php.net/rfc/lazy-objects)                                                                                 | 2024-06-03 | Implemented |
| [Property hook improvements](http://wiki.php.net/rfc/hook_improvements)                                                               | 2024-06-28 | Implemented |
| [Make the GMP class final](https://wiki.php.net/rfc/gmp-final)                                                                        | 2024-06-29 | Implemented |
| [Add bcdivmod to BCMath](https://wiki.php.net/rfc/add_bcdivmod_to_bcmath)                                                             | 2024-06-30 | Implemented |
| [Fix up BCMath Number Class / Change GMP bool cast behavior](https://wiki.php.net/rfc/fix_up_bcmath_number_class)                     | 2024-06-30 | Implemented |
| [Change Directory class to behave like a resource object](https://wiki.php.net/rfc/directory-opaque-object)                           | 2024-09-14 | Implemented |
| [PHP.net Analytics Collection](http://wiki.php.net/rfc/phpnet-analytics)                                                              | 2024-10-28 | Approved    |

### Generics

Generics are one of the most requested PHP features, but also the hardest. In 2024, the Foundation funded exploratory research into how generics might be implemented.  The [result of that research](https://thephp.foundation/blog/2024/08/19/state-of-generics-and-collections/) is available in its own blog post. In short, there is potential to make it happen but still some significant performance-related issues to resolve.

### Release Maintenance

Saki Takamachi, one of the Foundation developers, volunteered to be a release manager for PHP 8.4. The PHP Foundation supported such an initiative.

Jakub Zelenka, another foundation developer, continued duty as a release manager for PHP 8.3. Also supported by the foundation.

### Security

The PHP Foundation contributed significantly to the 4 security releases. As per [PHP 8.1 changelog](https://github.com/php/php-src/blob/php-8.1.31/NEWS), most security issues were addressed by Niels Dossche (11), followed by the foundation developers Jakub Zelenka (6) and Arnaud Le Blanc (1). There has been additional work done in terms of reviews and release preparations.

In addition, various documentation security issues were fixed by the foundation developers as result of the security audit.

## The PHP Foundation and the EU Cyber Resilience Act

The PHP Foundation is now a founding member of the [Cyber Resilience Act Working Group](https://thephp.foundation/blog/2024/04/02/open-source-community-cra-compliance-initiative/), giving us a key role in monitoring developments, representing PHP’s interests, and ensuring compliance with the regulation.

![EU Cyber Resilience Act Working Group](/assets/post-images/2025/report-2024/eu_cra_wg.png)

Late last year, the group evolved into the [Open Regulatory Compliance Working Group](https://orcwg.org/) (ORCWG). Jakub Zelenka, the Foundation developer, is part of the FAQ task force. That allows us to play an advisory role and help prepare the PHP ecosystem for the regulations.

For more details, see:

* [TechCrunch: Open Source Foundations Unite on Common Standards](https://techcrunch.com/2024/04/02/open-source-foundations-unite-on-common-standards-for-eus-cybersecurity-resilience-act/)
* [Eclipse Foundation Announcement](https://newsroom.eclipse.org/news/announcements/eclipse-foundation-launches-open-regulatory-compliance-working-group-help-open)
* ORCWG website: [orcwg.org](https://orcwg.org)

### Open Source Pledge Collaboration with Sentry

<img src="/assets/post-images/2025/report-2024/open-source-pledge-logo-sticker.svg" width="400" alt="Open Source Pledge"/>

In 2024, Sentry launched the [Open Source Pledge](https://opensourcepledge.com/), with the aim of encouraging companies that rely on Open Source systems to help directly fund Open Source development.

The PHP Foundation is also [a supporter of this effort](https://thephp.foundation/blog/2024/10/08/open-source-pledge/); contributing to Open Source is its entire purpose.  The Foundation also [welcomes sponsorships](https://thephp.foundation/sponsor/) from companies and organizations that wish to support Open Source as part of their Pledge.


## The PHP Foundation brand & public channels

The PHP Foundation represents a community of core PHP developers and advocates for the PHP programming language. The PHP Foundation used the channels listed below for public communication:

* 12,546 Twitter followers [https://twitter.com/thephpf](https://twitter.com/thephpf)
* 18,337 LinkedIn page followers [https://www.linkedin.com/company/phpfoundation](https://www.linkedin.com/company/phpfoundation)
* 1,060 Mastodon followers [https://phpc.social/@thephpf](https://phpc.social/@thephpf)
* 1,029 Bluesky followers [https://bsky.app/profile/thephpf.bsky.social](https://bsky.app/profile/thephpf.bsky.social)

PHP Foundation developers and board members gave talks at multiple conferences throughout the year:

* [Laracon EU](https://www.youtube.com/watch?v=XE4g1Tl6RQw) – Roman Pronskiy
* [PHP UK Conference](https://www.phpconference.co.uk/) – Derick Rethans, Gina Banyard
* [International PHP Conference](https://phpconference.com/) – Derick Rethans, Nils Adermann
* [FrOSCon](https://froscon.org/en/) – Sebastian Bergmann
* [php\[tek\]](https://tek.phparch.com/) – Derick Rethans, Nils Adermann
* [DrupalCon Barcelona](https://events.drupal.org/barcelona2024)\- Nils Adermann
* [betterCode(PHP)](https://php.bettercode.eu/) – Saki Takamachi, Sebastian Bergmann, Nils Adermann
* [ForumPHP](https://event.afup.org/) – Gina P. Banyard, Derick Rethans, Nicolas Grekas
* [SymfonyCon](https://live.symfony.com/2023-brussels-con/) – Nicolas Grekas, Nils Adermann
* Various Symfony meetups in France and Germany \- Nicolas Grekas
* [ConFoo](https://confoo.ca) — Derick Rethans, Nicolas Grekas
* [Dutch PHP Conference](https://phpconference.nl) — Derick Rethans
* [phpDay](https://2024.phpday.it/) — Derick Rethans, Gina Banyard
* [AFUP Days 2024 Lille](https://event.afup.org/afup-day-2024/afup-day-2024-lille/)  — Gina Banyard

### Gina made it to OpenUK’s ‘New Year Honours List’

Gina Banyard, one of the Foundation's developers, was awarded an [Honour by OpenUK](https://openuk.uk/honours/), an Open Technology organization that recognizes "above and beyond" contributions to Open Source.  Congratulations, Gina\!

<img src="/assets/post-images/2025/report-2024/gina_openuk.png" width="492" alt="Gina OpenUK"/>

## Financial report

In 2024, The PHP Foundation was financially backed by organizations and individuals with the goal of paying a competitive salary to as many core developers as possible.

|                    | 2021-2022 | 2023      | 2024      |
|:-------------------|:----------|:----------|:----------|
| Total donated      | $ 712,484 | $ 478,767 | $ 683,550 |
| Fees \*            | $ 90,273  | $ 60,098  | $ 83,110  |
| Total received     | $ 622,211 | $ 418,669 | $ 600,440 |
| Paid to developers | $ 133,285 | $ 275,181 | $ 635,487 |

<br>

*\* Fees include a 10%  Open Source Collective fiscal host fee (dealing with contracts, expense reviews and payments, bank account management, official registrations and dealing with government requirements, open collective platform development etc), and 1-5% percent of payment processing fees, depending on the payment method used.*

All incoming and outgoing transactions of The PHP Foundation are publicly available to view for anyone: [https://opencollective.com/phpfoundation\#category-BUDGET](https://opencollective.com/phpfoundation#category-BUDGET)

## Goals for 2025

Our foremost mission remains the same: **maintain and develop the PHP language**. We’d like PHP to be the best platform for users and for businesses creating web applications and APIs.

The main challenge for continuing the work of The PHP Foundation is to ensure sustainable sponsorship.

From a technical standpoint, the goal is to ensure that foundation developers work on valuable tasks.

### Organization Goals

* Secure funding to support core development and marketing initiatives.
* Launch the "PHP 30" anniversary campaign in collaboration with JetBrains.
* Consolidate and grow social media presence across multiple platforms.
* Increase website traffic through improved documentation and resources.
* Develop an Ambassador Program.
* Begin preparation for the "PHP Next" marketing campaign to highlight PHP's modernization.
* Modernize PHP's website with updated downloads page, documentation, and homepage.

### Technical Goals

* Continue on-going maintenance and development of the PHP core.
* Establish a working group for integrating modern HTTP server capabilities into PHP core.
* Address key developer experience pain points, particularly for first-time users.

## Budget plan for 2025

In 2025, we adjusted the developers’ hours according to their availability, requests, and our budget restrictions.

With this plan, we estimate our annual spending cap at approximately **$900,000** for developer compensation.

Our collaboration with the OpenCollective platform has been positive, and we plan to continue operating under the umbrella of the Open Source Collective in 2025\. This means that sponsorships we receive are reduced by 10% for Open Source Collective fees and 0-5% for payment processing fees.

## Outro

The PHP language is a living entity and, as such, requires continuous support to address developer issues, resolve security vulnerabilities, and has to evolve to meet the needs of the future.

Based on the strong third year of the foundation, we are excited to continue and multiply the efforts in the next years.

With [**your help**](https://thephp.foundation/sponsor/), we continue the mission to support, advance, and develop the PHP language.

<section class="text-center mt-6">
    <div class="mb-14">
        <a href="/sponsor/" target="_blank" class="inline-block text-xl py-2 no-underline px-6 !text-white bg-[#7f52ff] rounded-3xl hover:bg-[rgba(127,82,255,.8)]">
            Join The PHP Foundation
        </a>
    </div>
</section>
