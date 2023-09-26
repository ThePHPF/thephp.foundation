
---
title: 'PHP Core Roundup #17'
layout: post
tags:
  - roundup
author:
  - name: Ayesh Karunaratne
    url: https://aye.sh
  
  - name: Sergey Panteleev
    url: https://sergeypanteleev.com
published_at: 01 October 2023

---

Welcome back to [PHP Core Roundup](/blog/tag/roundup/) series! This is post #17, where we highlight and celebrate the improvements made to PHP during the month past by the PHP development team, members of the PHP Foundation, and more.

> The PHP Foundation is a collective of PHP contributors, veterans, and companies that collaborate to ensure the long-term sustainability of the PHP programming language. The foundation currently supports six contributors focused on PHP's maintenance, debt reduction, and feature development. These contributors work closely with others on coding, documentation, and discussions.

> Started over a year ago, the PHP Core Roundup series offers a summary of the latest developments, discussions, and news about PHP Core, contributed by both PHP Foundation members and other participants. This post is the thirteenth in the PHP Core Roundup series.

{% include "newsletter.html" %}

## PHP Security Audit organized by The PHP Foundation 💜

The PHP Foundation is planning to organized a security audit in PHP source code. Derick Rethans 💜 emailed the PHP Internals mailing list requesting opinions to identify the places in the PHP source code where checking this will have the most impact. Feel free to join the [conversation](https://externals.io/message/121135) if you have suggestions.

## Releases

The PHP development team released two new versions in September 2023:

**[PHP 8.2.11](TODO)** and **[PHP 8.1.24](TODO)**

These releases include several bug fixes and improvements, notably in areas such as Core, DOM, Iconv, Intl, MySQLnd, ODBC, SimpleXML, SPL, and SQLite3.

## Recent RFCs and Mailing List Discussions


> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

## Early-developments for PHP 8.4

Although PHP 8.3 is still being ironed out, there are some discussions and even an RFC currently being voted for proposed changes in PHP 8.4 (scheduled for the end of 2024).

### Declined: [Support optional suffix parameter in tempnam](https://wiki.php.net/rfc/tempnam-suffix-v2) by Athos Ribeiro

RFC proposes to add a new optional suffix parameter to the `tempnam()` function.

A suffix could provide even more semantic value or context for a user inspecting the generated files, and, in specific situations, could even provide more context for software processing such files. Right now, users can only add a prefix.

### In Voting: [Increasing the default BCrypt cost](https://wiki.php.net/rfc/bcrypt_cost_2023) by Tim Düsterhus

RFC proposes to increase default BCrypt cost, which denotes the algorithmic cost that should be used, from 10 to 11 (doubling the time) or 12 (quadrupling the time). The [RFC](https://wiki.php.net/rfc/bcrypt_cost_2023) and the relevant [mailing list thread](https://externals.io/message/121004) mention several benchmarks showing the execution time for various cost levels on different CPUs.

### Under Discussion: [DOM HTML5 parsing and serialization](https://wiki.php.net/rfc/domdocument_html5_parser) by Niels Dossche

RFC proposes to add two new classes: `DOM\HTMLDocument` and `DOM\XMLDocument` to the dom extension. Furthermore, existing dom classes in the global namespace get an alias in the new DOM namespace. The `HTMLDocument` class will add support for HTML5 document parsing and serializing. The `XMLDocument` class serves as a modern alternative to `\DOMDocument`, which is retained for compatibility. These new classes also provide a more misuse-resistant API for loading documents.

### Under Discussion: [XML_OPTION_PARSE_HUGE](https://wiki.php.net/rfc/xml_option_parse_huge) by Niels Dossche

RFC proposes to add a new `XmlParser` option to allow large documents to be parsed.

### Under Discussion: [Add 4 new rounding modes to round() function](https://wiki.php.net/rfc/new_rounding_modes_to_round_function) by Jorg Sowa

RFC proposes to add 4 new modes to the `round()` function: `PHP_ROUND_CEILING`, `PHP_ROUND_FLOOR`, `PHP_ROUND_AWAY_FROM_ZERO`, `PHP_ROUND_TOWARD_ZERO`.

### Under Discussion: [A new JIT implementation based on IR Framework](https://wiki.php.net/rfc/jit-ir) by Dmitry Stogov

RFC proposes a new JIT implementation that is based on a separately developed [IR Framework](https://github.com/dstogov/ir). The main advantage of the new approach is that PHP source code will be freed from the low-level details of JIT compilation. The downside is a longer JIT-compilation time.

Dmitry [emailed](https://externals.io/message/121038) PHP Internals mailing list, which lead to a lengthy discussion on the merits of the new JIT implementation.

### Draft: [Deprecations for PHP 8.4 RFC](https://wiki.php.net/rfc/deprecations_php_8_4) by Niels Dossche

RFC is currently in draft, which stands to track ideas on deprecating certain features. So far those are related to the `DOMAttr::$schemaTypeInfo`, `DOMElement::$schemaTypeInfo` properties, `DOMImplementation::getFeature()`, `mysqli_ping()`, `mysqli::ping()` functions, and `DOM_PHP_ERR` constant.

<br>

## Documentation

While PHP 8.3 has moved to the RC cycle, the documentation available on [php.net](https://php.net), requires updating. An initial version of the [PHP 8.3 migration guide](https://www.php.net/manual/en/migration83.php) has been published by Yoshinari Takaoka.

George P. Banyard 💜 has triaged issues in the docs and marked several of them as "good first time", which are ideal easy picks if you would like to start contributing to PHP docs. You can find the full list on [GitHub](https://github.com/php/doc-en/issues?q=is%3Aopen+is%3Aissue+label%3A%22good+first+issue%22).

<br>

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements.
 
---

### Full list of commits  since [PHP Core Roundup #16](/blog/2023/09/01/php-core-roundup-16/)

Commits are in the order they were added, grouped by author in alphabetical order.

<details markdown="1">
  <summary>Click here to expand</summary>



</details>
<br>
We are incredibly grateful for the commitment and dedication of all contributors. Stay tuned for next month's roundup as we continue to make PHP better together.

<br>

---

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation) or via [GitHub Sponsors](https://github.com/sponsors/ThePHPF).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 


