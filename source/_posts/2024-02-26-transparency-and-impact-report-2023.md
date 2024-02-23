---
title: 'The PHP Foundation: Impact and Transparency Report 2023'
layout: post
tags: 
  - report
author:
  name: Roman Pronskiy
  url: https://twitter.com/pronskiy
published_at: 26 February 2024
---

We’re a little late in posting our report from 2023, so we’ll also share some of the things we’re focusing on as we start 2024.

## Executive Summary

At the beginning of 2024, The PHP Foundation is a collective of **9 volunteer board members**, **1 full-time operations manager** sponsored by JetBrains, and **10 developers** paid part-time/full-time who make more than half of the contributions to the PHP language and its extensions.

In 2023, The PHP Foundation received **$418,669 in donations** from organizations and individuals.

The PHP Foundation’s main focus in 2023 was strengthening the maintenance of PHP core, the project that lives in the [php/php-src](https://github.com/php/php-src) GitHub repository. This project is the home of the PHP language, where PHP’s interpreter is developed. Everyone who uses PHP benefits in one way or another from the work that is done in this repository.

The PHP Foundation demonstrates its growing impact on the language through an increased volume and velocity of code contributions and reviews. The 6 part-time and full-time developers contracted by The PHP Foundation were responsible for nearly half of the commits and reviews made in the PHP language.

Moreover, the foundation's presence and activities have led to heightened interest and activity in the PHP project overall, with the total number of **contributions to the language growing by 79% compared to 2022**.

At the end of 2023, the German government’s **Sovereign Tech Fund chose to invest in The PHP Foundation’s mission** by providing funding for a security audit and other long outstanding projects critical for the PHP ecosystem.

The foundation is **expanding its development efforts in 2024** by contracting 4 additional developers and increasing the number of hours that current contracted developers are working.

The foundation plans to spend up to $1,045,000, including compensation and fees. We are looking for additional sponsor contributions to allow us to continue these efforts in the next years.

In 2024, we aim to achieve the following strategic goals:

* Ensure sustainable sponsorship for the foundation.
* Ensure that foundation developers focus on valuable tasks.
* Promote PHP within the web development ecosystem.


## The PHP Foundation Mission

The PHP Foundation was initiated by JetBrains, Automattic, Laravel, Acquia, Zend, Private Packagist, Symfony, Craft CMS, and Tideways. It was publicly [launched](https://blog.jetbrains.com/phpstorm/2021/11/the-php-foundation/) on November 22, 2021.

Since 2021, many companies and individuals have joined the initiative. To make the priorities of the foundation more clear and aligned we’ve **updated the mission statement**:


> The PHP Foundation’s mission is to ensure the long-term prosperity of the PHP language. The PHP Foundation focuses on providing financial support and guidance to PHP language developers to support its goals of improving the language for its users, providing high-quality maintenance, and improving the PHP language project to retain current contributors and to integrate new contributors. The PHP Foundation aims to promote the public image of the PHP language in the interest of retaining existing and gaining new users and contributors.

<br>
So it defines 4 priorities of the foundation:

1. Improve the language for users.
2. Provide high-quality maintenance.
3. Improve the project to retain current contributors and to integrate new contributors.
4. Promote the public image of PHP.

## Organizational Growth

Many companies with a vested interest in PHP’s prosperity, made a major financial contribution during the year. These are the companies that donated $10,000 or more in 2023:

**JetBrains, Automattic, Private Packagist, Craft CMS, Tideways, pixiv Inc., Mercari Inc., Symfony Corp, Aternos GmbH, Sentry, Ardennes-étape, Zend by Perforce, Les-Tilleuls.coop, Cybozu.**

Overall, 718 organizations and individuals sponsored the foundation in 2023 [on Open Collective](https://opencollective.com/phpfoundation) and [GitHub Sponsors](https://github.com/sponsors/ThePHPF).

### Quotes
Here is what some of the prominent folks say about the foundation.

{{ include('quote.html', {
name: 'Brandon Kelly',
title: 'CEO at Craft CMS',
image: '/assets/post-images/2024/report-2023/brandon_kelly.jpg',
quote: 'We’re proud supporters of the PHP Foundation here at Craft CMS. PHP has played such a huge role in our careers, and it’s an honor to be a part of its story.'
}) }}

{{ include('quote.html', {
name: 'Kevin Dunglas',
title: 'Les-Tilleuls.coop, FrankenPHP',
image: '/assets/post-images/2024/report-2023/kevin_dunglas.png',
quote: 'Les-Tilleuls.coop is proud to support the PHP Foundation. By maintaining the language, the foundation is ensuring the future of PHP and the web. By adding innovative new features, it simplifies knowledge sharing and, in the spirit of free software, makes it easier than ever for everyone to create independent sites and applications.'
}) }}

{{ include('quote.html', {
name: 'Matthew Weier O'Phinney',
title: 'Senior Product Manager, Zend by Perforce',
image: '/assets/post-images/2024/report-2023/mwop.jpg',
quote: 'As longtime contributors to the PHP project, both financially as well as by employing developers on the project, Zend by Perforce is pleased to sponsor the PHP Foundation and support its mission.
Expanding the pool of maintainers and developers capable of evolving the language will help keep PHP relevant, and expand its reach in the web development ecosystem.'
}) }}



{{ include('quote.html', {
name: 'Ben Marks',
title: 'Director Global Market Development at shopware AG',
image: '/assets/post-images/2024/report-2023/ben_marks.jpg',
quote: 'TODO'
}) }}

{{ include('quote.html', {
name: 'Matt Mullenweg',
title: 'CEO at Automattic, WordPress',
image: '/assets/post-images/2024/report-2023/matt_mullenweg.jpg',
quote: 'TODO'
}) }}

{{ include('quote.html', {
name: 'Rasmus Lerdorf',
title: 'The creator of PHP, Etsy',
image: '/assets/post-images/2024/report-2023/rasmus_lerdorf.jpg',
quote: 'TODO'
}) }}

<br>

## The Sovereign Tech Fund Investment

The [Sovereign Tech Fund](https://sovereigntechfund.de/en/) (STF) supports the development, improvement, and maintenance of open digital infrastructure in the public interest. Its goal is to strengthen the open-source ecosystem sustainably, focusing on security, resilience, technological diversity, and the people behind the code. STF is funded by the German Federal Ministry for Economic Affairs and Climate Action (BMWK) and supported by the German Federal Agency for Disruptive Innovation GmbH (SPRIND).

We have collaborated with STF to create work plans for these specific projects:

#### PECL overhaul
The current system for distributing PHP extensions, PECL/PEAR, is outdated and prone to supply-chain attacks, making it unreliable for average developers. This leads to the creation of redundant tools and new security issues.

We proposed to rewrite the PECL installer, replacing the messy pear code and the inefficient website.

Follow the progress of **the new tool 🥧PIE** here: [https://github.com/ThePHPF/pie-design](https://github.com/ThePHPF/pie-design).

#### Testing tool for FPM
Currently, the PHP project's testing framework lacks more specialized support for the automated testing of the FastCGI Process Manager (FPM), especially for issues that require higher load. We propose to develop an FPM/SAPI testing tool that can execute all applications and set expectations on the produced logs and server responses. This tool will be connected with a load testing tool (e.g., wrk) to simulate real-world usage and load. 

The work has started in the [https://github.com/bukka/wst](https://github.com/bukka/wst) repository with the plan to move it to the PHP GitHub organization when ready.

#### Security Audit
PHP, like any other language, has its share of security issues. We are going to collaborate with a security research group for a comprehensive codebase audit and address the discovered issues. This will significantly improve the security of PHP and make it more reliable for developers and businesses.

The audit is being organized in partnership with [OSTIF](https://ostif.org/).

#### Documentation improvements
The current PHP documentation has several blind spots, with many functions and methods not covered at all. We propose to update and modernize the English PHP documentation, review and remove user comments, integrate 3v4l.org for interactive examples, and simplify the maintenance process. This will make PHP more accessible to new developers and serve as a reliable reference for experienced ones.

## The PHP Foundation Governance
In 2023 we renamed the Administration group to the **Governing Board** to avoid confusions and better align with industry standards.

[The lineup](https://thephp.foundation/structure/#admins) of the group has not changed and consists of veteran PHP community leaders, representatives of the founding companies, and other key stakeholders.

One notable change compared to previous year is a full-time operations manager sponsored by JetBrains in addition to the financial contribution.

We aim to establish a level of involvement for other key stakeholders from the PHP world through the Advisory Board and other initiatives.


## The Advisory Board

To keep major sponsors of PHP abreast of the latest happenings in the foundation and allow them to see the direct impact of their support, we announced the advisory board initiative [in March](https://thephp.foundation/blog/2023/03/31/php-foundation-update-march-2023/#a-new-benefit-for-major-sponsors-%E2%80%93-advisory-board-membership).


In addition to the [Governing Board](https://thephp.foundation/structure/) representatives from Automattic, JetBrains, Private Packagist, Symfony, Tideways, and Zend by Perforce, the **Advisory Board includes members from** Moodle, Shopware, Laravel, Ardennes-étape, Les-Tilleuls.coop / API Platform, Aternos GmbH, PrestaShop, CraftCMS.

Your company can **[become a member](https://thephp.foundation/join/)** by contributing a minimum of $12,000 to The PHP Foundation as at least a Silver Sponsor.


## The PHP Foundation Staff

### Renewing contracts

In 2023, we had a team of 6 developers. All of them demonstrated a high quality of work, and dedication to the mission of the foundation. We were happy to renew the contracts for 2024 as well as extend the total number of hours for developers requesting it.

We have also adjusted the compensation rates for developers to better reflect the market, as the rates had not changed since 2021.

We aim to review the rates every year based on the available funding and priorities.

### Team extension

As was mentioned in the previous transparency report, we aimed to extend the team. It did not happen in 2023 because one of the prospective developers could not join the team for personal reasons, and had to step down from PHP core development entirely. Again, this is [the Bus Factor at its worst](https://blog.jetbrains.com/phpstorm/2021/11/the-php-foundation/#the_bus_factor). However, we were able to extend the team starting with 2024.

We accepted applications for developer positions from September through October 2023. We received about 200 resumes, and we’ve chosen 4 developers with a proven track record of contributions to the PHP language and ecosystem.

We offered the new developers 6-month trial contracts so that the developers and the Governing Board can evaluate the results and then decide whether to continue the engagements.


### The team as of 2024

Starting from January, we now contract 10 developers to work on PHP:

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


### Team timeline

We established the following timeline for team review.

* January 2024: Developers start work according to the new contracts.
* May 2024: Evaluate new developers, contracts are extended, expanded, or terminated after the first 6 months.
* September 2024: Open applications for new developers, evaluate performance of the current group of developers.
* October 2024: Evaluate applications, work out updates to compensation, decide on a budget.
* November 2024: Renew contracts with existing developers, potentially sign contracts with new developers.

And in 2025 we start the cycle again.


## Retrospective: Goals of 2023

In the previous report we outlined a few organizational and technical goals. Let’s look back and evaluate the results.

### Organization goals

* **Extend the foundation developers team. ✅**<br/>
  We did not grow in 2023 strictly speaking, but the work done in 2023 helped to build the ground for two contracted developers to go full-time, as well as to hire 4 new developers.<br/><br/>
* **Grow the community of the foundation. ✅**<br/>
  The foundation’s Slack became a hub for the community and helped to move initiatives.<br/><br/>
* **Improve communication and provide clear benefits for sponsors. ✅** <br/>
  We created a [deck with benefits for sponsors](https://thephp.foundation/join/#membership-deck) and started the advisory board initiative. <br/><br/>
* **Explore strategic partnerships and marketing opportunities. ✅ / ❌**<br/>
    We received investment from the Sovereign Tech Fund and started collaboration with OSTIF.<br/>
    We did not explore any marketing opportunities. And there is a room for many more strategic partnerships.

### Technical goals

* **Ongoing maintenance and development of the PHP core.  ✅** <br/><br/>
* **Improve the quality of the ideas and RFCs coming from the foundation. ✅**<br/>
  One of the examples here could be [Property Hooks RFC](https://wiki.php.net/rfc/property-hooks). Although it has not been voted on yet, we have put amazing work into it and consulted many different parties to make it as good as possible.<br/><br/>
* **Develop a high-level roadmap and vision for PHP changes sponsored by the foundation. ❌**<br/>
  The roadmap and vision need further development and discussion. However, we conducted several pieces of research, both quantitative and qualitative. Some of these findings were shared at conferences where we participated, including PHPCon Poland, SymfonyCon, and Laracon EU. We plan to continue this work.

## PHP Language Impact

On a daily basis, the PHP Foundation staff team contributes to the open-source repositories of the [PHP GitHub organization](https://github.com/php). The foundation team contributes in many forms: filing issues, reviewing pull requests, participating in discussions on mailing lists, triaging issues, submitting RFC proposals.

In this document, four categories of contributions are presented in more detail: commits to php-src, reviews of pull requests on php-src, submitted RFC documents, and documentation work.


### Commits to PHP

The following chart summarizes the number of commits made to the [php/php-src](https://github.com/php/php-src) repository in 2023.


|                             | 2022 | 2023 |
|-----------------------------|------|------|
| Total by The PHP Foundation | 683  | 784  |
| Total other                 | 885  | 1588 |


![Commits](/assets/post-images/2024/report-2023/commits.png)


Note that the number of commits does not fairly represent the level of effort or the scope of the work. However, it can demonstrate the foundation's relative level of contribution to the PHP core through an objective metric.


### Reviews

The diagram summarizes the number of pull request reviews made in the [php/php-src](https://github.com/php/php-src) repository from January 1 to December 31, 2023.

|                             | 2022 | 2023 |
|-----------------------------|------|------|
| Total by The PHP Foundation | 283  | 702  |
| Total other                 | 551  | 416  |

![Reviews](/assets/post-images/2024/report-2023/reviews.png)



### RFCs

Below are the RFC proposals authored or co-authored by The PHP Foundation developers in 2023 (random order).

| RFC                                                                                                                       | Proposed   | Status           |
|---------------------------------------------------------------------------------------------------------------------------|------------|------------------|
| [Deprecate implicitly nullable parameter types](https://wiki.php.net/rfc/deprecate-implicitly-nullable-types)             | 2023-12-20 | Under Discussion |
| [Deprecate functions with overloaded signatures](https://wiki.php.net/rfc/deprecate_functions_with_overloaded_signatures) | 2023-01-31 | Implemented      |
| [More Appropriate Date/Time Exceptions](https://wiki.php.net/rfc/datetime-exceptions)                                     | 2023-02-08 | Implemented      |
| [Define proper semantics for range() function](https://wiki.php.net/rfc/proper-range-semantics)                           | 2023-03-13 | Implemented      |
| [Typed class constants](https://wiki.php.net/rfc/typed_class_constants)                                                   | 2020-07-06 | Implemented      |
| [Deprecate remains of string evaluated code assertions](https://wiki.php.net/rfc/assert-string-eval-cleanup)              | 2023-05-31 | Implemented      |
| [Saner array_(sum\|product)()](https://wiki.php.net/rfc/saner-array-sum-product)                                          | 2023-01-14 | Implemented      |
| [Path to Saner Increment/Decrement operators](https://wiki.php.net/rfc/saner-inc-dec-operators)                           | 2022-11-21 | Implemented      |
| [RFC1867 for non-POST HTTP verbs](https://wiki.php.net/rfc/rfc1867-non-post)                                              | 2023-10-06 | Implemented      |
| [Unbundle ext/imap, ext/pspell, ext/oci8, and ext/PDO_OCI](https://wiki.php.net/rfc/unbundle_imap_pspell_oci8)            | 2023-10-03 | Accepted         |
| [Policy Repository](https://wiki.php.net/rfc/policy-repository)                                                           | 2023-12-04 | Implemented      |
| [Access Scope from Magic Accessors](https://wiki.php.net/rfc/access_scope_from_magic_accessors)                           | 2023-01-19 | Withdrawn        |
| [Deprecations for PHP 8.4](https://wiki.php.net/rfc/deprecations_php_8_4)                                                 | 2023-07-25 | Draft            |
| [Add file_descriptor() function](https://wiki.php.net/rfc/file-descriptor-function)                                       | 2023-01-16 | Under Discussion |
| [New core autoloading mechanism with support for function autoloading](https://wiki.php.net/rfc/core-autoloading)         | 2023-04-03 | Under Discussion |
| [Property hooks](https://wiki.php.net/rfc/property-hooks)                                                                 | 2023-01-03 | Under discussion |
| [Release cycle update](https://wiki.php.net/rfc/release_cycle_update)                                                     | 2023-11-05 | Under Discussion |



### Release Maintenance

Jakub Zelenka, one of the foundation developers, also volunteered to be a release manager for PHP 8.3. The PHP Foundation supported such an initiative.


## The PHP Foundation brand & public channels

The PHP Foundation represents a community of core PHP developers and advocates for the PHP programming language.The channels listed below were used by the PHP Foundation for public communication:

* 11,481 Twitter followers [https://twitter.com/thephpf](https://twitter.com/thephpf)
* 10,320 LinkedIn page followers [https://www.linkedin.com/company/phpfoundation](https://www.linkedin.com/company/phpfoundation)
* 684 Mastodon followers [https://phpc.social/@thephpf](https://phpc.social/@thephpf)

The PHP Foundation members gave talks on multiple conferences throughout the year:

* [PHP UK Conference](https://www.phpconference.co.uk/) – Derick Rethans
* [International PHP Conference](https://phpconference.com/) – Nils Adermann
* [FrOSCon](https://froscon.org/en/) – Sebastian Bergmann
* [php\[tek\]](https://tek.phparch.com/) – Derick Rethans
* [DrupalCon Lille](https://events.drupal.org/lille2023/session/php-foundation-0) - Nils Adermann
* [betterCode(PHP)](https://php.bettercode.eu/) – Jakub Zalenka
* [ForumPHP](https://event.afup.org/) – Gina P. Banyard
* [PHPCon Poland](https://2023.phpcon.pl/en/) – Roman Pronskiy
* [SymfonyCon](https://live.symfony.com/2023-brussels-con/) – Nicolas Grekas


## Official Recognition on the PHP website

The PHP Foundation is now officially endorsed on the php.net website. This was the result of a community vote on [RFC Promote the PHP Foundation](https://wiki.php.net/rfc/promote_php_foundation). Big thanks to Jim Winstead and the PHP community for this.


## Financial report

In 2023, The PHP Foundation was financially backed by organizations and individuals with the goal of paying a competitive salary to as many core developers as possible.

|                                     | 2021 - 2022 | 2023      |
|-------------------------------------|-------------|-----------|
| Total donated to The PHP Foundation | $ 712,484   | $ 478,767 |
| Fees *                              | $ 90,273    | $ 60,098  |
| Total received                      | $ 622,211   | $ 418,669 |
| Paid to developers                  | $ 133,285   | $ 275,181 |

<br>
_* Fees include a 10%  Open Source Collective fiscal host fee (dealing with contracts, expense reviews and payments, bank account management, official registrations and dealing with government requirements, open collective platform development etc), and 1-5% percent of payment processing fees, depending on the payment method used._


All incoming and outgoing **transactions of The PHP Foundation are publicly available** to view for anyone: [https://opencollective.com/phpfoundation#category-BUDGET](https://opencollective.com/phpfoundation#category-BUDGET)

![Budget](/assets/post-images/2024/report-2023/budget.png)


### Expenses

[https://opencollective.com/phpfoundation/expenses](https://opencollective.com/phpfoundation/expenses)

![Expenses](/assets/post-images/2024/report-2023/expenses.png)



## Goals for 2024

Our foremost mission remains the same: **maintain and develop the PHP language**. We’d like PHP to be the best platform for users and for businesses creating web applications and APIs.

The main challenge for continuing the work of The PHP Foundation is to ensure sustainable sponsorship.

From a technical standpoint, the goal is to ensure that foundation developers work on valuable tasks.


### Organization goals



* Onboard new major sponsors.
* Explore strategic partnerships and marketing opportunities.
* Further develop the Advisory Board initiative.
* Grow the foundation's community.


### Technical goals



* On-going maintenance and development of the PHP core.
* Deliver the STF projects.
* Improve the quality of the ideas and RFCs coming from the foundation.
* Conduct research and surveys to define priorities.
* Develop a high-level roadmap for PHP changes sponsored by the foundation.


## Budget plan for 2024

In 2024, two of our part-time developers extended commitment to go full-time, and we contracted 4 new developers.

We have also adjusted the compensation rates for developers to better reflect the market, as the rates had not changed since 2021. As a result, our budget significantly increased.

With this plan, we estimate our annual spending cap at approximately **$840,000** for developer compensation.

Additionally, we anticipate receiving **€205,000** from the STF investment. These funds will be allocated to developer reimbursements and our partnership with OSTIF.org for an external security audit.

Our collaboration with the OpenCollective platform has been positive, and we plan to continue operating under the umbrella of the Open Source Collective in 2024. This means that sponsorships we receive are reduced by 10% for Open Source Collective fees and 1-5% for payment processing fees.


## Outro

The PHP language is a living entity and, as such, requires continuous support to address developer issues, resolve security vulnerabilities, and has to evolve to meet the needs of the future.

Based on the strong second year of the foundation, we are excited to continue and multiply the efforts in the next years.

With your help, we continue the mission to support, advance, and develop the PHP language. 
 
<section class="text-center mt-6">
    <div class="mb-14">
        <a href="/join" target="_blank" class="inline-block text-xl py-2 no-underline px-6 !text-white bg-[#7f52ff] rounded-3xl hover:bg-[rgba(127,82,255,.8)]">
            Join The PHP Foundation
        </a>
    </div>
</section>
