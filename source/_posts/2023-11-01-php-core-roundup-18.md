
---
title: 'PHP Core Roundup #18'
layout: post
tags:
  - roundup
author:
  - name: Ayesh Karunaratne
    url: https://aye.sh
  
  - name: Sergey Panteleev
    url: https://sergeypanteleev.com
published_at: 01 November 2023

---

Welcome back to [PHP Core Roundup](/blog/tag/roundup/) series! This is post #18, where we highlight and celebrate the improvements made to PHP during the month past by the PHP development team, members of the PHP Foundation, and more.

> The PHP Foundation is a collective of PHP contributors, veterans, and companies that collaborate to ensure the long-term sustainability of the PHP programming language. The foundation currently supports six contributors focused on PHP's maintenance, debt reduction, and feature development. These contributors work closely with others on coding, documentation, and discussions.

> Started over a year ago, the PHP Core Roundup series offers a summary of the latest developments, discussions, and news about PHP Core, contributed by both PHP Foundation members and other participants. This post is the thirteenth in the PHP Core Roundup series.

{% include "newsletter.html" %}

## Releases

The PHP development team released two new versions in October 2023:

**[PHP 8.2.12](TODO)** and **[PHP 8.1.25](TODO)**

These releases include several bug fixes and improvements, notably in areas such as Core, CLI, CType, DOM, Fileinfo, Filter, Hash, Intl, MySQLnd, Opcache, PCRE, SimpleXML, Streams, XML, and XSL. 

## Recent RFCs and Mailing List Discussions


> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

## PHP 8.3 GA to be released this month!

PHP 8.3.0 GA is scheduled to be released on November, 23. PHP 8.3.0 RC5 is already released, and RC6 (the last one) is scheduled for November, 9.

PHP 8.3.0 RC versions are available in [Remi’s](https://rpms.remirepo.net/) repos for Fedora/RHEL, [Docker images](https://hub.docker.com/_/php/tags?page=1&name=8.3) on Docker Hub, and compiled Windows binaries on [windows.php.net](https://windows.php.net/).

## PHP 8.0 will reach EOL

PHP 8.0 will reach EOL with the release of PHP 8.3 and will no longer get security updates.

## RFC Updates

Following are the RFCs and major pull-requests discussed, voted, and implemented since our last update.

### Implemented: [Increasing the default BCrypt cost](https://wiki.php.net/rfc/bcrypt_cost_2023) by Tim Düsterhus

RFC was approved unanimously, but in the second vote, where a new cost value had to be determined, opinions were divided.

Cost will be raised in PHP 8.4 to a value of 12.

### Implemented: [XML_OPTION_PARSE_HUGE](https://wiki.php.net/rfc/xml_option_parse_huge) by Niels Dossche

RFC proposes to add a new option to the event-driven (SAX) `XmlParser` that would allow it to parse large documents.

### Accepted: [DOM HTML5 parsing and serialization](https://wiki.php.net/rfc/domdocument_html5_parser) by Niels Dossche

PHP 8.4 will get new classes: `DOM\HTMLDocument` and `DOM\XMLDocument` to the dom extension. Existing dom classes in the global namespace get an alias in the new DOM namespace. The `HTMLDocument` class will add support for HTML5 document parsing and serializing. The `XMLDocument` class serves as a modern alternative to `\DOMDocument`, which is retained for compatibility. These new classes also provide a more misuse-resistant API for loading documents.

### Accepted: [A new JIT implementation based on IR Framework](https://wiki.php.net/rfc/jit-ir) by Dmitry Stogov

RFC proposes a new JIT implementation that is based on a separately developed [IR Framework](https://github.com/dstogov/ir). The main advantage of the new approach is that PHP source code will be freed from the low-level details of JIT compilation. The downside is a longer JIT-compilation time.

Dmitry [emailed](https://externals.io/message/121038) PHP Internals mailing list, which led to a lengthy discussion on the merits of the new JIT implementation.

### Under discussion: [RFC1867 for non-POST HTTP verbs](https://wiki.php.net/rfc/rfc1867-non-post) by Ilija Tovilo 💜

Now PHP supports the parsing of `multipart/form-data` content type natively, but only for POST requests. If POST request has the `multipart/form-data` content type, the request body is immediately consumed before starting the PHP script and populated into the `$_POST` and `$_FILES` superglobals.

RFC proposes to add a new function `request_parse_body()` to expose the existing functionality to userland so that it may be used for other HTTP verbs.

### Under discussion: [Rounding Integers as int](https://wiki.php.net/rfc/integer-rounding) by Marc Bennewitz

Currently `round()`, `ceil()` and `floor()` functions return float numbers, but when using integers above `2^53` you get unexpected results due to loss of precision.

RFC proposes to perform rounding for a given integer and returning the resulting integer if possible.

### Under discussion: [Unbundle ext/imap, ext/pspell, ext/oci8, and ext/PDO_OCI](https://wiki.php.net/rfc/unbundle_imap_pspell_oci8) by Derick Rethans 💜

RFC proposes to unbundle these extensions: remove them from the PHP source distribution, and move them to PECL.

### Under discussion: [Multibyte for trim function mb_trim, mb_ltrim and mb_rtrim](https://wiki.php.net/rfc/mb_trim) by Yuya Hamada

RFC proposes to add multibyte support for trim functions.

### Under discussion: [Change the edge case of round()](https://wiki.php.net/rfc/change_the_edge_case_of_round) by Saki Takamachi

RFC proposes to change the `round()` behavior, and stop expecting decimal behavior to float point and start expecting floating point to behave as floating point.


<br>

## Documentation

While PHP 8.3 is just around the corner, the documentation available on [php.net](https://php.net), requires updating.

George P. Banyard 💜 is tracking the progress for PHP 8.3 related changes in [php/doc-en#2796](https://github.com/php/doc-en/issues/2796), and also triaged issues in the docs and marked several of them as "good first time", which are ideal easy picks if you would like to start contributing to PHP docs. You can find the full list on [GitHub](https://github.com/php/doc-en/issues?q=is%3Aopen+is%3Aissue+label%3A%22good+first+issue%22).

<br>

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements.
 
---

### Full list of commits  since [PHP Core Roundup #17](/blog/2023/10/01/php-core-roundup-17/)

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


