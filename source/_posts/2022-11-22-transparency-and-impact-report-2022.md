
---
title: 'The PHP Foundation: Impact and Transparency Report 2022'
layout: post
tags:
author:
  name: Roman Pronskiy
  url: https://twitter.com/pronskiy
published_at: 22 November 2022
---

## Executive Summary

At the end of 2022, The PHP Foundation is a collective of 10 volunteer administrators and 6&nbsp;part-time paid developers who make nearly half of the commits to PHP language core and extensions.

The collective received $580,000 in donations from organizations, and 1400 people backed or donated to The PHP Foundation individually.

The PHP Foundation’s main focus for 2022 has been the strengthening of maintenance for the PHP core, the project that lives in the [php/php-src](https://github.com/php/php-src) GitHub repository. This project is the home of the PHP language, where PHP’s interpreter is developed. Everyone who uses PHP benefits in one way or another from the work that is done in this repository.

The 6 part-time developers employed by The PHP Foundation started in April 2022. From April through November (the time of this report), The PHP Foundation staff were responsible for nearly half of the commits and reviews made in the [php/php-src](https://github.com/php/php-src) repository.

The foundation intends to expand its development efforts in 2023 by hiring an additional developer and increasing the number of hours that our current contracted developers are working. We plan to spend $678,000, including compensation and fees. Additional sponsor contributions will allow us to extend the developer team further.

Among other goals for 2023, we would like to address the following:

* Extend the foundation developers team.
* Establish processes for continuity beyond the current administration group.
* Improve communication with sponsors and decide on the level of involvement for them.
* Explore strategic partnerships and marketing opportunities.
* Improve the quality of the ideas and RFCs coming from the foundation.
* Develop a high-level roadmap and vision for PHP changes sponsored by the foundation.


## Outset

The PHP Foundation was initiated by JetBrains, Automattic, Laravel, Acquia, Zend&nbsp;by&nbsp;Perforce, Private Packagist, Symfony, Craft CMS, and Tideways. It was publicly [launched](https://blog.jetbrains.com/phpstorm/2021/11/the-php-foundation/) on November 22, 2021.

Intending to ensure the PHP language's success, a group of individuals and organizations have formed The PHP Foundation. Through part-time staff, community management, and a network of partner organizations, The PHP Foundation enables sustainable maintenance of the PHP interpreter.


## Organizational Growth

The PHP Foundation's founding companies in 2021 included the following businesses, which took an active part in discussions about establishing and running the foundation:

Initial members:

* JetBrains
* Automattic
* Acquia
* Private Packagist
* Craft CMS
* Tideways
* Laravel
* Zend by Perforce
* Symfony
* PrestaShop

Representatives of these companies formed the initial administration group.

Many more companies with a vested interest in PHP’s prosperity, made a major financial contribution during the year. These are the companies that donated $10,000 or more:

* Livesport s.r.o.
* OP.GG
* EC-CUBE
* Spryker
* Polcode
* Shopware AG
* BASE, Inc.
* Aternos GmbH
* Digital Scholar
* Ardennes-étape
* RAKUS
* Cambium Learning, Inc.
* Paycom

Overall, there are 145 organizations and 1220 individual sponsors [on Open Collective](https://opencollective.com/phpfoundation).

#### Taylor Otwell, Laravel:
> “Laravel is honored to support the PHP Foundation initiative as it continues to preserve, maintain, and mold the future of the PHP ecosystem.“


#### Fabien Potencier, Symfony:
> “Symfony is very proud to support the PHP Foundation which helps build a bright and sustainable future for the PHP language, thanks to a large and diverse group of individuals and companies.“

#### Jordi Boggiano, Private Packagist & Composer: 
> “At Private Packagist we build and maintain the tools enabling a thriving PHP ecosystem. Our customers rely on the PHP language and runtime, so our contribution to the PHP Foundation helps ensure PHP receives a reliable amount of professional care.”

#### Dries Buytaert, Acquia, Drupal:
> “Acquia and the Drupal community are proud to have helped with getting The PHP Foundation in place to provide broader and more resilient support to the mission of advancing and developing PHP. We are elated by the foundation's progress in a year and look forward to its future endeavors.”

## Events Timeline

![Timeline](/assets/post-images/2022/report-2022/php-foundation-timeline-2022.svg)

## The PHP Foundation Staff

### Application Process

We accepted applications for sponsorship from November through December 2021. We received about 100 resumes, and we’ve chosen 6 developers with a proven track record of contributions to the PHP language. We’ve created a shortlist of promising candidates for future expansion of the program or to replace participants, if necessary.

Up until March 2022, we were negotiating the text of contracts. The legal departments at JetBrains and OpenCollective both supported us in this.


### The team as of 2022

Starting in April, we contracted 6 developers to work on PHP:

* **Arnaud Le Blanc** [@arnaud-lb](https://github.com/arnaud-lb)
* **Derick Rethans** [@derickr](https://github.com/derickr)
* **George Peter Banyard** [@Girgias](https://github.com/Girgias)
* **Ilija Tovilo** [@iluuu1994](https://github.com/iluuu1994)
* **Jakub Zelenka** [@bukka](https://github.com/bukka)
* **Máté Kocsis** [@kocsismate](https://github.com/kocsismate)


### Compensation Considerations

We have thought long and hard about what approach to use for remuneration. Given the different experiences of the chosen developers and the limited budget, we devised the following scheme.

We would take a conservative (safe) approach and accept 7 candidates with a proven record of work. We’d pay developers hourly, with a factor based on experience. This rate was chosen to meet developers' expectations, but to remain within the allocated budget.

In 2022, we offered all developers a 6-month contract to start. They all work as freelance contractors. In 2023, we offer yearly contracts.

With such an approach, we were planning to spend $329,000 per year, which was a safe number based on the funding at that time.

One of the candidates dropped out, and we eventually accepted only 6 candidates. That is one of the reasons we spent less money than expected. But sticking to our conservative approach made more sense to us in the initial year than spending everything at once, as it allowed us to build up savings to even out fluctuating income in the future.


## Goals for 2022

The primary goal for the foundation in 2022 was to **hire developers to maintain the PHP core**.

We consider this goal accomplished. We'll look in depth at how much work has been done in the next section. The foundation demonstrated its reliability and effectiveness. We rolled out a sustainable process for supporting contributors. Now we are ready to scale and grow.


## Contributions to PHP Core

The PHP Foundation’s main focus has been contributions to [php/php-src](https://github.com/php/php-src), the primary repository for the PHP language.


### Day-to-day work

On a daily basis, the PHP Foundation staff team contributes to the open-source repositories of the [PHP GitHub organization](https://github.com/php). The foundation team contributes in many forms: filing issues, reviewing pull requests, participating in discussions on mailing lists, triaging issues, submitting RFC proposals.

In this document, four categories of contributions are presented in more detail: commits to php/src, reviews of pull requests on php/src, submitted RFC documents, and documentation work.


### Commits to PHP

The following chart summarizes the number of commits made to the php/php-src repository from April to November, 2022.

- Total by The PHP Foundation: 683
- Total other: 885

![Commits chart](/assets/post-images/2022/report-2022/commits_chart.svg)

### Reviews

The diagram summarizes the number of pull request reviews made in the php/php-src repository from April to November, 2022.

- Total by The PHP Foundation: 283
- Total other: 551

![Reviews chart](/assets/post-images/2022/report-2022/reviews_chart.svg)

### RFCs

Below are the RFC proposals authored or co-authored by The PHP Foundation developers from April to November, 2022.

* [Readonly classes](https://wiki.php.net/rfc/readonly_classes)
* [Deprecate ${} string interpolation](https://wiki.php.net/rfc/deprecate_dollar_brace_string_interpolation)
* [Allow null and false as stand-alone types](https://wiki.php.net/rfc/null-false-standalone-types)
* [Add true type](https://wiki.php.net/rfc/true-type)
* [Disjunctive Normal Form Types](https://wiki.php.net/rfc/dnf_types)
* [Fetch properties of enums in const expressions](https://wiki.php.net/rfc/fetch_property_in_const_expressions)
* [Dynamic class constant fetch](https://wiki.php.net/rfc/dynamic_class_constant_fetch)
* [Short Closures 2.0](https://wiki.php.net/rfc/auto-capture-closure)


## The PHP Foundation brand & public channels

The PHP Foundation represents a community of core PHP developers and advocates for the PHP programming language.The channels listed below were used by the PHP Foundation for public communication:

* 9,302 Twitter followers [https://twitter.com/thephpf](https://twitter.com/thephpf)
* 1,533 LinkedIn page followers [https://www.linkedin.com/company/85931483/admin/](https://www.linkedin.com/company/85931483/admin/)
* 1,441 Collective updates subscribers [https://opencollective.com/phpfoundation/updates](https://opencollective.com/phpfoundation/updates)
* 650 PHP Core Roundup subscribers [https://thephp.foundation/blog/tag/roundup/](https://thephp.foundation/blog/tag/roundup/)

[Ayesh Karunaratne](https://twitter.com/Ayeshlive) assisted us in publishing 7 iterations of the PHP Core Roundup blog posts, which provide a summary of the most recent PHP core updates, bug fixes, proposals, and other developments:

* [https://thephp.foundation/blog/tag/roundup/](https://thephp.foundation/blog/tag/roundup/)

The PHP Foundation admins also participated in two conferences:

* Forum PHP, Paris [[video](https://www.youtube.com/watch?v=JBPtPy9iSP0)]
* International PHP Conference, Munich [[video](https://www.youtube.com/watch?v=Nmb-_66RArs)]

Published a case study on the OpenCollective blog:

* [https://blog.opencollective.com/php-foundation-alive-and-kicking/](https://blog.opencollective.com/php-foundation-alive-and-kicking/)

The PHP Foundation won the Next Generation Award at the Open Source Awards by All Things Open:

* [https://twitter.com/MLHacks/status/1587805042282840073](https://twitter.com/MLHacks/status/1587805042282840073)


## The PHP Foundation Governance

The Administration group consists of veteran PHP core developers, PHP community leaders, representatives of the founding companies, and other key stakeholders.

We spent some time discussing how to organize management effectively. However, we concluded that it was worth focusing on our primary goal early on. 

So for the first year, we decided to keep the group of administrators declared at the launch active. And make it invite-only for the first year.

This allowed us to move faster. However, the negative effect is definitely the lack of transparency in the process.

Nevertheless, this group will continue in 2023. And one of the goals will be to provide more transparency and establish a level of involvement for other key stakeholders from the PHP world.

We intend to make the ground rules more clear over the coming year, including the terms of participating in The PHP Foundation's governance and technical steering activities.


## Financial report

In 2022, PHP Foundation was financially backed by organizations and individuals with the goal of paying a competitive salary to as many core developers as possible.

|                                                                       |
|-----------------------------------------------------------------------|
| • Total contributed by sponsors and individuals before fees: $712,484 |
| • Fees: $90,273                                                       |
| • Total raised: $622,211                                              |
| &nbsp;                                                                |
| • From organizations: 77%                                             |
| • From individuals: 23%                                               |
| &nbsp;                                                                |
| • Recurring: 39.5%                                                    |
| • One-Time: 60.5%                                                     |
| &nbsp;                                                                |
| • Paid to developers in 2022: $133,285                                | 
| • Current balance: $488,635                                           |
| &nbsp;                                                                |
| • Planned expenses for 2023: $678,000                                 |

<br>
All incoming and outgoing transactions of The PHP Foundation are publicly available to view for anyone, not just sponsors of the foundation: [https://opencollective.com/phpfoundation#category-BUDGET](https://opencollective.com/phpfoundation#category-BUDGET)


### All Financial Contributions From Sponsors

[![Financial Contributions chart](/assets/post-images/2022/report-2022/financial_contributions.png)](https://opencollective.com/phpfoundation/transactions?kind=ADDED_FUNDS%2CCONTRIBUTION)


### Expenses

[https://opencollective.com/phpfoundation/expenses](https://opencollective.com/phpfoundation/expenses)

[![Expenses chart](/assets/post-images/2022/report-2022/expenses.png)](https://opencollective.com/phpfoundation/expenses)


## Why did we not spend all donated funds?

There were multiple reasons for this:

* Our projected budget was planned in December 2021, and the developers only started working in April.
* One of the top-rated candidates to whom we had allocated a large budget dropped out for 2022 and this significantly reduced our spending.
* Being a young organization, we felt that having a bigger buffer is a wiser choice for the first year.

## Goals for 2023

Our foremost mission remains the same: **maintain and develop the PHP language**. In this regard, we have two groups of more specific goals for the next year.

From an organization perspective, the main challenge will be to grow in a way that ensures the long-term sustainability of the foundation and the PHP language.

From a technical standpoint, we'd like our work to be more meaningful, in the interest of PHP users, and oriented toward a common direction rather than uncoordinated, more or less random ideas.

### Organization goals

* Extend the foundation developers team.
* Grow the community of the foundation.
* Improve communication and provide clear benefits for sponsors.
* Explore strategic partnerships and marketing opportunities.


### Technical goals

* Ongoing maintenance and development of  the PHP core.
* Improve the quality of the ideas and RFCs coming from the foundation.
* Develop a high-level roadmap and vision for PHP changes sponsored by the foundation.


## Budget plan for 2023

In 2022, all sponsored developers worked part-time, between 1 and 2 days per week.

In 2023, almost all developers indicated a desire to increase the amount of time they devote to PHP, ranging from working on PHP for 2 days a week to full-time.

As a result, we will pay for the equivalent time of nearly 4 full-time employees in 2023, which is close to double the 2022 commitment.

With this plan, we expect to spend about $600,000 per year on paying developers’ compensation.

Our collaboration with the OpenCollective platform has been positive, and we plan to continue operating under the umbrella of OpenSourceCollective in 2023. This means that in addition to the above-mentioned costs, we will also incur 10% in OpenCollective fees and about 3% in payment processing fees.


### What if the foundation has extra funds in 2023?

We'd like to set aside at least 50% of an annual budget in reserves for unforeseen events.

If the PHP Foundation receives additional donations, we would be delighted to scale our efforts:

* Open the application form for new developers
* Hire a technical writer to work on the documentation


## Thank you!

The PHP language is a living entity and, as such, requires continuous support to address developer issues, resolve security vulnerabilities, and evolve to meet the needs of the future.

Based on the strong first year of the foundation, we are excited to continue and multiply the efforts in the next years.

With your help, we continue the mission to support, advance, and develop the PHP language. 
