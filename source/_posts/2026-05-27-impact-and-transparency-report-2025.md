---
title: The PHP Foundation Impact and Transparency Report 2025
layout: post
tags:
    - report
author:
  name: Elizabeth Barron
  url: https://www.linkedin.com/in/elizabethn/
published_at: 27 May 2026
---
## Executive Summary

PHP turned 30 in 2025. With The PHP Foundation's support, the PHP project marked the year by shipping PHP 8.5. The PHP Foundation also launched PIE 1.0, initiated a project to modernize PHP's stream layer, and authored roughly 42% of all commits to PHP's core. This work was supported by 536 sponsors and individual contributors, and it could not have happened without them.

At the end of 2025, The PHP Foundation consisted of 8 volunteer board members, an Executive Director sponsored by [JetBrains](https://www.jetbrains.com/), and 11 contracted developers who worked part- and full-time to strengthen and improve the core PHP language through bug and security fixes, feature development, and contributing to the RFC process through discussion and development of new RFCs. 

The total contributions received from sponsors and individual donors was $730,534, which enabled The PHP Foundation to advance its mission in a meaningful way.


### About the PHP Foundation

The PHP Foundation's main focus is to ensure the sustainability and long term viability of the PHP language. Our priorities continue to be:

* Improving the language for users
* Providing high-quality maintenance
* Improving the project to retain current contributors and integrate new ones
* Promoting the public image of PHP

It should be noted that The PHP Foundation does not control the decisions made by the PHP community regarding the language, nor does it assume any governance over the language itself. PHP has always been, and will continue to be a community-owned Open Source project.


## What we shipped in 2025

Leadership at The PHP Foundation coordinated several high-level initiatives, including:

* The completion of a [Security Audit](https://thephp.foundation/blog/2025/04/10/php-core-security-audit-results/) by [Open Source Technology Improvement Fund (OSTIF)](https://ostif.org/), funded by the [Sovereign Tech Agency](https://www.sovereign.tech/) through the Sovereign Tech Fund (STF), and sustained security advisory work across the team
* The [addition of FrankenPHP](https://thephp.foundation/blog/2025/05/15/frankenphp/) to the PHP GitHub organization, in collaboration with [Les-Tilleuls.coop](https://les-tilleuls.coop/en/)
* The development of the [official PHP SDK for MCP](https://thephp.foundation/blog/2025/09/05/php-mcp-sdk/), in collaboration with the [Symfony](https://symfony.com/) Team and [Anthropic](https://www.anthropic.com/)

In addition, in 2025, eleven Foundation-funded contractors collectively logged thousands of hours advancing PHP's language, runtime, security posture, ecosystem tooling, and community reach.

Key achievements included: 

* Successful delivery of PHP 8.5
* Launch of PIE 1.0 and initiation of the formal PECL deprecation process
* Launch of the STF Streams modernization project
* PHP Foundation representation at the OpenSSF [Open Regulatory Compliance Working Group](https://orcwg.org/) on the EU Cyber Resilience Act


## The PHP Foundation Staff

Our 2025 team was stable and productive, and worked very well together. We ended 2025 by adding one more contractor to the team in H2: [Joe Watkins](https://thephp.foundation/blog/2025/09/25/joe-watkins/).

Therefore, as of January 1, 2026, 11 Foundation developers work on PHP:

* Arnaud Le Blanc [@arnaud-lb](https://github.com/arnaud-lb)
* David Carlier [@devnexen](https://github.com/devnexen)
* Derick Rethans [@derickr](https://github.com/derickr)
* Gina P. Banyard [@Girgias](https://github.com/Girgias)
* Ilija Tovilo [@iluuu1994](https://github.com/iluuu1994)
* Jakub Zelenka [@bukka](https://github.com/bukka)
* James Titcumb [@asgrim](https://github.com/asgrim)
* Joe Watkins [@krakjoe](https://github.com/krakjoe)
* Máté Kocsis [@kocsismate](https://github.com/kocsismate)
* Saki Takamachi [@SakiTakamachi](https://github.com/SakiTakamachi)
* Shivam Mathur [@shivammathur](https://github.com/shivammathur)


### Team Achievements
<img src="/assets/post-images/2026/impact-report-2025/php_foundation_stats_2025.png" width="300" alt="PHP Foundation 2025 contribution statistics infographic showing key metrics: Foundation developers contributed 2,929 commits and 662 merged PRs across 9 PHP repositories; 1,685 community PRs reviewed in php-src; Foundation developers authored 42% of commits, 32% of merged PRs, and 25% of bug-fix PRs in php-src; Foundation leads 90%+ of activity in php/pie, php/php-windows-builder, and php/web-downloads; 14 PIE releases shipped including version 1.0; team delivered 40+ international conference talks throughout 2025. The infographic presents these accomplishments in an organized, visually hierarchical layout highlighting The PHP Foundation team's productive year." class="mb-4 sm:mr-4 sm:float-left"/>


We acknowledge the limitations in providing any metrics; very rarely do metrics accurately represent the full scenario (for instance, a 1-line commit and a 100-line commit are counted equally in the overall number of commits). Additionally, some metrics are more difficult to capture than others. Therefore, we offer this set of obtainable metrics to collectively demonstrate the team's impact. To clarify the data points above: 

* PRs merged = PRs that were authored by a contractor that were merged by anyone
* Community PR Reviews = PRs from other people that were reviewed/commented on by contractors
* % of Bug Fixes = the percent of all bug fix PRs that were authored by a contractor but merged by anyone in the community. PRs were considered “fixes” if they included the words “fix,” “resolve,” or “bug” in the title of the PR


#### Language & runtime

* **URL/URI parsing RFC** (Máté Kocsis) passed in May, representing PHP's most significant standard-library addition in years, including upstream contributions to the uriparser C library.
* **Gina P. Banyard** drove the entire PHP 8.5 deprecations and warnings RFC to php-src and authored 173 merged PRs (roughly 16% of all merged PRs to php-src in 2025).
* **Arnaud Le Blanc's** Tail Call VM technique merged in August, removing PHP's dependency on a single compiler for peak performance; he also co-developed Partial Function Applications v2 and Context Managers with Larry Garfield.
* **Ilija Tovilo** was the team's leading committer to php-src (565 commits) and advanced the Pattern Matching RFC alongside deep performance work on zend_op size and TMP|VAR consolidation.
* **Saki Takamachi** delivered BCMath optimizations and created xsse, a portable SIMD abstraction library already in use in php-src.
* **Jakub Zelenka** progressed with implementation of JsonSchema support for the JSON extension.

#### Security

Jakub Zelenka led sustained multi-month investigations on multiple security advisories, which included the handling of PHP security releases. Jakub also represented the PHP Foundation in the OpenSSF working group shaping EU Cyber Resilience Act compliance.  David Carlier delivered a steady stream of overflow, double-free, and memory leak fixes across GD, ZIP, intl, PDO_SQLite, sodium, and Fiber, upstreaming several directly to libgd. Shivam Mathur is responsible for security upgrades to Windows PHP builds addressing 50+ CVEs/security issues, and continues to support builds for 100+ extensions for Windows. Derick Rethans patched an XSS in php.net and ran an emergency CVE response for the rsync server.

#### Streams modernization (Sovereign Tech Fund)

The STF underwrote a 530-hour modernization of PHP's stream layer, delivering a new Polling API, TLS 1.3 improvements with session resumption (PSK, tickets, early data), redesigned stream error handling, an io_uring/IOCP abstraction, modernized copy infrastructure (copy_file_range, splice, sendfile), filter seeking improvements, and socket option enhancements. This is an ongoing project and will see more progress in 2026.

#### Ecosystem & infrastructure

The PHP Foundation has demonstrated meaningful contributions in several areas:

* **PIE (the new PHP extension installer)**: James Titcumb authored 482 of 537 commits to php/pie (roughly 90% of the codebase)  and 109 of 156 merged PRs. He shipped 14 PIE releases including 1.0 in June, formally initiated PECL's deprecation, and delivered five conference talks evangelizing the project. 
* **Windows infrastructure**: Shivam Mathur authored 95% of commits to php/php-windows-builder and 98% of commits to php/web-downloads. Without his work, PHP would have no Windows distribution maintainer. 
* **French documentation**: 38% of commits and 47% of merged PRs to php/doc-fr in 2025 came from David Carlier, a community-facing impact that is often invisible in English-language reporting but reaches Francophone PHP developers worldwide.
* **Infrastructure:** Derick Rethans migrated nearly every php.net property (wiki, downloads, qa, pecl, bugs, docs, www, and more) to modern Ansible-managed infrastructure, expanded WebAssembly support for interactive examples in the manual, and contributed alongside Shivam and Roman on the redesigned downloads page. Máté Kocsis and Ilija built statistical benchmarking infrastructure (Welch T-Test, Wilcoxon, Valgrind, variance reduction) underpinning the team's performance work.

#### Strategic R&D

Joe Watkins joined in H2 and published ORT, a PHP tensor library with backends for SSE2/SSE4.1/AVX2/AVX512, NEON, CUDA, RISC-V64, and WebAssembly (including a custom IEEE 754-2008 float16 implementation in C) reaching 97% test coverage and positioning PHP to participate in AI/ML workloads. Arnaud explored generational and Boehm GC, plus Modules and Snapshots PoCs.

#### Maintenance & stewardship

Beyond headline projects, the team spent a large percentage of their time carrying PHP's day-to-day weight: continuous bug triage (Ilija's largest recurring line item every month), monthly release management across 8.3.x and 8.4.x, cross-platform fixes spanning Windows, macOS, FreeBSD, Solaris, and Haiku, French (David) and Japanese (Saki) documentation contributions, mailing list moderation, and dozens of code reviews monthly across virtually every PHP subsystem. Additionally, the team spent time on maintenance and stable releases of external extensions including imagick and GnuPG, and tools like PHP-FPM that are part of PHP core.


### RFCs

The following list covers RFCs authored or co-authored by PHP Foundation contractors in 2025, along with their RFCs that changed status in 2025.


<table>
  <tr>
   <td><strong>RFC</strong>
   </td>
   <td><strong>Author</strong>
   </td>
   <td><strong>Status</strong>
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/url_parsing_api">URL Parsing API (ext/uri)</a>
   </td>
   <td>Máté Kocsis
   </td>
   <td>Implemented in PHP 8.5
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/deprecations_php_8_5">PHP 8.5 Deprecations</a>
   </td>
   <td>Gina P. Banyard, Christoph M. Becker*, Daniel Scherzer*, Tim Düsterhus*, Theodore Brown*, Jorg Sowa*, David Carlier, Jakub Zelenka, Nicolas Grekas*, Volker Dusch*, Calvin Buckle*
   </td>
   <td>Implemented in PHP 8.5
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/warnings-php-8-5">PHP 8.5 Warnings</a>
   </td>
   <td>Gina P. Banyard
   </td>
   <td>Implemented in PHP 8.5
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/get-error-exception-handler">Add get_error_handler(), get_exception_handler()</a>
   </td>
   <td>Arnaud Le Blanc
   </td>
   <td>Implemented in PHP 8.5
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/stream_errors">Stream Error Handling</a>
   </td>
   <td>Jakub Zelenka
   </td>
   <td>Accepted
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/tls_session_resumption_api">TLS Session Resumption</a>
   </td>
   <td>Jakub Zelenka
   </td>
   <td>Accepted
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/make_round_behave_correctly_as_float">Make round() behave correctly as float</a>
   </td>
   <td>Saki Takamachi
   </td>
   <td>Draft
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/policy-release-process-update">Policy Release Process Update</a>
   </td>
   <td>Jakub Zelenka
   </td>
   <td>Accepted
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/context-managers">Context Managers</a>
   </td>
   <td>Arnaud Le Blanc & Larry Garfield*
   </td>
   <td>In Discussion
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/partial_function_application_v2">Partial Function Application v2</a>
   </td>
   <td>Arnaud Le Blanc & Larry Garfield*
   </td>
   <td>In Implementation
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/uri_followup">URI Followup</a>
   </td>
   <td>Máté Kocsis
   </td>
   <td>Vote started
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/adopt_pie_deprecate_pecl">Deprecate PECL / Adopt PIE</a>
   </td>
   <td>James Titcumb
   </td>
   <td>Accepted
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/pattern-matching">Pattern Matching</a>
   </td>
   <td>Ilija Tovilo & Larry Garfield*
   </td>
   <td>In Discussion
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/json_schema_validation">JSON Validation Schema Support</a>
   </td>
   <td>Jakub Zelenka
   </td>
   <td>In Discussion
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/void-as-null">Void as Null</a>
   </td>
   <td>Gina P. Banyard
   </td>
   <td>In Discussion
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/tidyexception-for-tidy">TidyException Type for Tidy</a>
   </td>
   <td>David Carlier
   </td>
   <td>In Discussion
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/deprecate-function-bool-type-juggling">Deprecate Type Juggling</a>
   </td>
   <td>Gina P. Banyard
   </td>
   <td>Declined
   </td>
  </tr>
  <tr>
   <td><a href="https://wiki.php.net/rfc/make_opcache_required">Make OPcache a non-optional part of PHP</a>
   </td>
   <td>Tim Düsterhus*, Arnaud Le Blanc, Ilija Tovilo
   </td>
   <td>Implemented in 8.5
   </td>
   </tr>
   <tr>
    <td><a href="https://wiki.php.net/rfc/static-aviz">Asymmetric Visibility for Static Properties</a>
    </td>
   <td>Ilija Tovilo & Larry Garfield*
   </td>
   <td>Implemented in 8.5
   </td>
  </tr>
   <tr>
    <td><a href="https://wiki.php.net/rfc/uri_followup">Followup Improvements for ext/uri</a>
    </td>
   <td>Máté Kocsis
   </td>
   <td>Accepted
   </td>
  </tr>
</table>

*This person was not a contractor for The PHP Foundation at time of authorship, but is acknowledged here for their contribution to the RFC

## The PHP Foundation Sponsors

Our sponsors and individual contributors are the lifeblood of The PHP Foundation, for without their continued support, we would not be able to continue making meaningful contributions and improvements to the PHP language.

Our highest level sponsors for 2025 were [Sovereign Tech Agency,](https://www.sovereign.tech/) [JetBrains](https://www.jetbrains.com/), [Automattic](https://automattic.com/), [GoDaddy.com](GoDaddy.com), [Passbolt](https://www.passbolt.com/), [Sentry](https://sentry.io/welcome/), [Les-Tilleuls.coop](http://Les-Tilleuls.coop), [Craft CMS](https://craftcms.com/), [Private Packagist](https://packagist.com/), [Cybozu](https://cybozu.co.jp/en/company/), [Tideways](https://tideways.com/), [Manychat](https://manychat.com/), [Zend by Perforce](https://www.perforce.com/products/zend), [CH Studio](https://chstudio.fr/), and [Aternos GmbH](https://aternos.gmbh/en/).

Overall, 536 organizations and individuals sponsored The PHP Foundation in 2025, which is substantially less than the previous year. This is an indication of an increasingly challenging fundraising space in the open source ecosystem, a reality our peers at other Foundations and Open Source projects are also navigating.

We are incredibly grateful for all those who have financially supported and continue to support The PHP Foundation. 


## The PHP Foundation Financial Report

In 2025, The PHP Foundation was financially backed by organizations and individuals with the goal of paying a competitive salary to as many core developers as possible. These numbers represent figures in USD.


<table>
  <tr>
   <td>
   </td>
   <td><strong>2021-2022</strong>
   </td>
   <td><strong>2023</strong>
   </td>
   <td><strong>2024</strong>
   </td>
   <td><strong>2025**</strong>
   </td>
  </tr>
  <tr>
   <td>Total donated
   </td>
   <td>$ 712,484
   </td>
   <td>$ 478,767
   </td>
   <td>$ 683,550
   </td>
   <td>$ 730,534
   </td>
  </tr>
  <tr>
   <td>Fees *
   </td>
   <td>$ 90,273
   </td>
   <td>$ 60,098
   </td>
   <td>$ 83,110
   </td>
   <td>$ 85,343
   </td>
  </tr>
  <tr>
   <td>Total received
   </td>
   <td>$ 622,211
   </td>
   <td>$ 418,669
   </td>
   <td>$ 600,440
   </td>
   <td>$ 645,191
   </td>
  </tr>
  <tr>
   <td>Expenses
   </td>
   <td>$ 133,285
   </td>
   <td>$ 275,181
   </td>
   <td>$ 635,487
   </td>
   <td>$ 784,376
   </td>
  </tr>
</table>


*Fees include a 10% Open Source Collective fiscal host fee (dealing with contracts, expense reviews and payments, bank account management, official registrations and dealing with government requirements, open collective platform development etc), and 1-5% percent of payment processing fees, depending on the payment method used.

**Starting in 2025, some funds were donated and paid in Euro; please allow for small rounding variance due to conversion rates.

All incoming and outgoing transactions of The PHP Foundation are publicly available to view for anyone: [https://opencollective.com/phpfoundation#category-BUDGET](https://opencollective.com/phpfoundation#category-BUDGET)


## The PHP Foundation Brand & Public Channels

The PHP Foundation represents a community of core PHP developers and advocates for the PHP programming language. The PHP Foundation used the channels listed below for public communication:

* 24.8K LinkedIn page followers: [https://www.linkedin.com/company/phpfoundation](https://www.linkedin.com/company/phpfoundation)
* 13.7K X followers: [https://x.com/thephpf](https://x.com/thephpf)
* 1.2K Mastodon followers: [https://phpc.social/@thephpf](https://phpc.social/@thephpf)
* 1.2K Bluesky followers: [https://bsky.app/profile/thephpf.bsky.social](https://bsky.app/profile/thephpf.bsky.social)
* 3390 Subscribers to The PHP Foundation Newsletter

We will continue to grow our social media presence as a means of connecting with the broader PHP community. 


## Looking Back: Goals for 2025

In the previous report, we outlined a few organizational and technical goals. Let's take a look at how we did.


### Organization Goals


* **Secure funding to support core development and marketing initiatives.** ✅

    The PHP Foundation received funds as noted above to continue our focus on core development and the marketing of PHP and The PHP Foundation.

* **Launch the "PHP 30" anniversary campaign in collaboration with JetBrains.** ✅

    The PHP Foundation celebrated [30 years of PHP](https://thephp.foundation/blog/2025/06/08/php-30/) at the PHPverse conference hosted by JetBrains.

* **Consolidate and grow social media presence across multiple platforms. ✅**

	The reach and engagement for our social media accounts grew in every platform.


* **Increase website traffic through improved documentation and resources. ❓**

    We only added tracking to the [php.net](https://php.net) website toward the end of 2024, so we did not have a baseline for comparison. This is something we can measure moving forward. 

* **Develop an Ambassador Program. ❌**

    This was discussed, but not launched. Look for a version of this in 2026.

* **Begin preparation for the "PHP Next" marketing campaign to highlight PHP's modernization. ❌**

    This was discussed, but not launched. Look for a version of this in 2026.

* **Modernize PHP's website with updated downloads page, documentation, and homepage. ⚠️ Partial**

    This was partially completed and included a [redesigned page for the 8.5 release](https://www.php.net/releases/8.5/en.php) and a clearer and more functional Downloads page. There is still work to be done on the homepage and in the documentation.


### Technical Goals

* **Continue on-going maintenance and development of the PHP core. ✅**

    As demonstrated in this report, our contractors continue to focus on improving the PHP core. 

* **Establish a working group for integrating modern HTTP server capabilities into PHP core. ✅**

    Instead, the PHP project incorporated the FrankenPHP project into its GitHub organization, offering a modern solution to running PHP in an HTTP server. This change was initiated by engineers at [Les-Tilleuls.coop](https://les-tilleuls.coop/en/), and implemented in partnership with the PHP Foundation.

* **Address key developer experience pain points, particularly for first-time users. ⚠️ Partial**

    This was partially completed with the improvements on the Downloads page, but there is still much work and research to be done here. 


## Looking Ahead: Goals for 2026

2026 brings its own challenges but we are committed to continuing to make a measurable difference in the PHP language and ecosystem.


### Organization Goals

* Complete the executive transition initiated in Q4 2025
* Complete the onboarding of a Director of Fundraising
* Expand support for the PHP Ecosystem
* Improve Foundation communication, transparency, and internal documentation
* Build a plan to improve public perception of PHP
* Balance spending with funding and creating a systematic approach to fundraising

### Technical Goals

* Create Cryptography working group
* Explore support for continued security-focused work


## Budget plan for 2026

Total expenses exceeded total received donations by approximately $139,000 in 2025, which was a deliberate choice to maintain investment in technical headcount while we strengthen relationships with sponsors and individual contributors. The PHP Foundation remains financially solvent with healthy reserves, and reducing this gap is a 2026 priority.

We will also continue to utilize [Open Collective](https://opencollective.com/phpfoundation) as our fiscal host, as they provide transparency and a suite of valuable financial services for The PHP Foundation. 


## Outro

The work in this report is the runway for what's next. We head into 2026 with real momentum and a clear sense of what the community has asked of us.  None of the technical leadership, the security work, the new partnerships ahead, and the support for the PHP ecosystem happens without the people who fund us. [With your help](https://thephp.foundation/sponsor/), together we can keep PHP thriving in a changing open source world.
