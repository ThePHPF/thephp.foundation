---
title: 'PHP Core Roundup #14'
layout: post
tags:
  - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 01 July 2023

---

The PHP Core team has been as productive as ever this past month, bringing forth a robust collection of updates that promise to shape the future of PHP. From RFCs that are sure to stir up lively debate, to ones that bring small, yet impactful changes, it has been a month filled with interesting developments. Here's what you need to know.

> The PHP Foundation is a collective of PHP contributors, veterans, and companies that collaborate to ensure the long-term sustainability of the PHP programming language. The foundation currently supports six contributors focused on PHP's maintenance, debt reduction, and feature development. These contributors work closely with others on coding, documentation, and discussions.

<br>

> Started over a year ago, the PHP Core Roundup series offers a summary of the latest developments, discussions, and news about PHP Core, contributed by both PHP Foundation members and other participants. This post is the thirteenth in the PHP Core Roundup series.

{% include "newsletter.html" %}

## Happy 28th birthday, PHP!

On June 8, PHP turned 28 years old! For a throwback, see Rasmus Lerdorf’s [initial public announcement of PHP](https://groups.google.com/g/comp.infosystems.www.authoring.cgi/c/PyJ25gZ6z7A/m/M9FkTUVDfcwJ).

Here’s to many more years of empowering developers and pushing the boundaries of web technology. Happy Birthday, PHP! 🎉🥳🎂

## PHP 8.3.0 QA Releases and Feature-freeze

The upcoming PHP 8.3 version is scheduled to be released on November 23. The newly elected PHP 8.3 release managers made the first QA releases of PHP 8.3 — [PHP 8.3.0 Alpha 1](https://www.php.net/archive/2023.php#2023-06-08-3) — on June 08, and the [second alpha release](https://www.php.net/archive/2023.php#2023-06-22-1) on June 22.

These alpha releases are not meant for any production servers, but serve as point releases for testing environments and local development setups.

Compiled Windows binaries are available at [windows.php.net/qa](https://windows.php.net/qa/), [Docker images](https://hub.docker.com/_/php/tags?page=1&name=8.3.0) are available at Docker Hub, and source code at [php/php-src repository on GitHub](https://github.com/php/php-src) to compile yourself. On Homebrew, PHP 8.3.0-dev packages are available from [`shivammathur/php`](https://github.com/shivammathur/homebrew-php) tap.

**July 18** is the PHP 8.3 Feature-Freeze date. The window for submitting major changes to PHP 8.3 ends on this date. PHP follows a two-week discussion period and a two week voting period. All RFCs must be voted (and passed) before the feature-freeze to be included in PHP 8.3.

## Releases

The PHP development team released three new versions in June 2023:

**[PHP 8.2.7](https://www.php.net/archive/2023.php#2023-06-08-2)**

- Security fixes: Fixed GHSA-76gg-c692-v2mw.
- Other changes: This release includes several bug fixes and improvements, notably in areas such as Core, Date, Exif, FPM, Hash, LibXML, MBString, Opcache, PCNTL, PGSQL, Phar, Soap, SPL, Standard, and Streams.

**[PHP 8.1.20](https://www.php.net/archive/2023.php#2023-06-08-4)** 

- Security fixes: Fixed GHSA-76gg-c692-v2mw.
- Other changes: This release includes several bug fixes and improvements, notably in areas such as Core, Date, Exif, FPM, Hash, LibXML, Opcache, PGSQL, Phar, Soap, SPL, Standard, and Streams.

**[PHP 8.0.29](https://www.php.net/archive/2023.php#2023-06-08-1)**

- Security fixes: Fixed GHSA-76gg-c692-v2mw.

## Recent RFCs and Mailing List Discussions

> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

## RFC Updates

Following are the RFCs and major pull-requests discussed, voted on, and implemented since our last update.

### Accepted: [Marking Overridden Methods](https://wiki.php.net/rfc/marking_overriden_methods) by Tim Düsterhus

This RFC proposes a way to explicitly mark methods that are intended to override methods from a parent class with a new `#[\Override]` attribute. If this attribute is added to a method, the engine shall validate that a method with the same name exists in a parent class or any of the implemented interfaces. If no such method exists a compile time error shall be emitted.

The similar concepts exist in Java, TypeScript, C++, C#, Swift, Kotlin, and other languages.

### In Voting: [Deprecations for PHP 8.3](https://wiki.php.net/rfc/deprecations_php_8_3) by George Peter Banyard 💜, Christoph M. Becker, Máté Kocsis 💜, Tim Düsterhus, Go Kudo, Andreas Heigl

The aim is to clean up some of the older, less consistent parts of PHP to make the language more reliable and predictable. The following list provides a short overview of the functionality targeted for deprecation:

- Passing negative `$widths` to `mb_strimwidth()`
- The `NumberFormatter::TYPE_CURRENCY` constant
- Unnecessary `crypt()` related constants
- `MT_RAND_PHP`
- Global Mersenne Twister

### In Voting: [Deprecate Functions with Overloaded Signatures](https://wiki.php.net/rfc/deprecate_functions_with_overloaded_signatures) by Máté Kocsis 💜

This RFC proposes to deprecate a number of functions that have overloaded signatures, meaning they behave differently based on the number or type of arguments passed to them. The goal is to make PHP's function signatures more consistent and predictable.

### Under Discussion: [Closure self-reference](https://wiki.php.net/rfc/closure_self_reference) by Danack, KapitanOczywisty

This RFC proposes to allow closures to be aliased to a variable that can be used within the closure:

```php
<?php

$fibonacci = function (int $n) as $fn {
    if ($n === 0) return 0;
    if ($n === 1) return 1;
    return $fn($n-1) + $fn($n-2);
};
 
echo $fibonacci(5);
```

### Implemented: [Define proper semantics for range() function](https://wiki.php.net/rfc/proper-range-semantics) by George Peter Banyard 💜

This RFC proposes to adjust the semantics of the `range()` function in PHP to throw exceptions or at least warn when passing unusable arguments to `range()`.

The `range()` function in PHP generates an array of values going from a start value to an end value. However, the current behavior of the function is complex and can lead to unexpected results. For example, if one of the boundary inputs is a string digit (e.g. "1"), both inputs will be interpreted as numbers. This RFC aims to address these issues and make the behavior of the `range()` function more predictable and consistent.

### Implemented: [mb_str_pad()](https://wiki.php.net/rfc/mb_str_pad) by Niels Dossche

This RFC proposes the addition of a multibyte string pad function to the mbstring extension. This function would work similarly to the existing `str_pad()` function, but with support for multibyte strings. This is a welcome addition for developers working with multibyte strings, as it will make it easier to manipulate and format these strings in PHP.

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes, the PHP core developers review all pull requests.
 
---

### Full list of commits since [PHP Core Roundup #13](/blog/2023/06/06/php-core-roundup-13/)

<details markdown="1">
  <summary>Click here to expand</summary>

  - Fix bug [GH-11246](https://github.com/php/php-src/issues/11246) cli/get_set_process_title in [GH-11247](https://github.com/php/php-src/pull/11247) by James Lucas
  - Fix [GH-11347](https://github.com/php/php-src/issues/11347): Memory leak when calling a static method inside an xpath query in [GH-11350](https://github.com/php/php-src/pull/11350) by nielsdos
  - Fix [`-Wenum-int-mismatch`] compiler warnings in [GH-11352](https://github.com/php/php-src/pull/11352) by George Peter Banyard 💜
  - `ext/standard/array.c`: Optimize min/max functions for int/float in [GH-11194](https://github.com/php/php-src/pull/11194) by George Peter Banyard 💜
  - Use `zval_ptr_dtor_nogc()` for callable in `ext/xslt` in [GH-11356](https://github.com/php/php-src/pull/11356) by Niels Dossche
  - `http_fopen_wrapper`: fix [`-Wanalyzer-deref-before-check`] in [810507ab1b](https://github.com/php/php-src/commit/810507ab1b) by George Peter Banyard 💜
  - memory stream: fix [`-Wanalyzer-deref-before-check`] in [13ad8ef40b](https://github.com/php/php-src/commit/13ad8ef40b) by George Peter Banyard 💜
  - Fix file descriptor check in [c5d7264149](https://github.com/php/php-src/commit/c5d7264149) by George Peter Banyard 💜
  - Assert `zend_constant` exist in [ce724d186d](https://github.com/php/php-src/commit/ce724d186d) by George Peter Banyard 💜
  - Implement iteration cache, item cache and length cache for node list iteration in [GH-11330](https://github.com/php/php-src/pull/11330) by Niels Dossche
  - Struct-pack `spl_dllist_object` in [5fae4b5031](https://github.com/php/php-src/commit/5fae4b5031) by Niels Dossche
  - Remove dead code from `sxe_get_element_by_name()` in [c6bffff96b](https://github.com/php/php-src/commit/c6bffff96b) by Niels Dossche
  - Remove double class entry variable in [795127942b](https://github.com/php/php-src/commit/795127942b) by Niels Dossche
  - Use `xmlStrEqual()` instead of `!xmlStrCmp()` in [47c277bde5](https://github.com/php/php-src/commit/47c277bde5) by Niels Dossche
  - No need for the double name pointer in [ed097e30f0](https://github.com/php/php-src/commit/ed097e30f0) by Niels Dossche
  - Switch `DOMNodeList::item()` and `DOMNamedNodeMap::item()` to fast ZPP in [GH-11361](https://github.com/php/php-src/pull/11361) by Niels Dossche
  - Fix bug [#67440](https://bugs.php.net/bug.php?id=67440): append_node of a `DOMDocumentFragment` does not reconcile namespaces in [GH-11362](https://github.com/php/php-src/pull/11362) by Niels Dossche
  - Fix bug [#81642](https://bugs.php.net/bug.php?id=81642): `DOMChildNode::replaceWith()` bug when replacing a node with itself in [GH-11363](https://github.com/php/php-src/pull/11363) by Niels Dossche
  - Fix bug [#77686](https://bugs.php.net/bug.php?id=77686): Removed elements are still returned by `getElementById` in [GH-11369](https://github.com/php/php-src/pull/11369) by Niels Dossche
  - Use `uint32_t` for the number of nodes in [GH-11371](https://github.com/php/php-src/pull/11371) by Niels Dossche
  - Use known `zend_string` pointer to check for equality instead of C strings in [GH-11370](https://github.com/php/php-src/pull/11370) by George Peter Banyard 💜
  - `ext/pgsql`: `php_pgsql_convert` converts `E_NOTICE` to `TypeError`/`ValueError` exceptions in [16a63d7b07](https://github.com/php/php-src/commit/16a63d7b07) by David CARLIER
  - Let closure created from magic method accept named parameters in [GH-11364](https://github.com/php/php-src/pull/11364) by Niels Dossche
  - Set `DOMAttr::$value` without expanding entities in [50fdad8325](https://github.com/php/php-src/commit/50fdad8325) by Tim Starling
  - Factor out `dom_remove_all_children()` in [74910b1403](https://github.com/php/php-src/commit/74910b1403) by Tim Starling
  - Don't add 1 when calling `xmlNodeSetContent()` in [ee68c22128](https://github.com/php/php-src/commit/ee68c22128) by Tim Starling
  - Also avoid entity expansion in `DOMAttr::$nodeValue` in [076ddf2b05](https://github.com/php/php-src/commit/076ddf2b05) by Tim Starling
  - Changelog notes for `DOMAttr` value and nodeValue properties in [0cc028c374](https://github.com/php/php-src/commit/0cc028c374) by Tim Starling
  - Improve test `DOMAttr_entity_expansion.phpt` in [ab77485890](https://github.com/php/php-src/commit/ab77485890) by Tim Starling
  - Use common function for `TypeError` on illegal offset access in [GH-10544](https://github.com/php/php-src/pull/10544) by George Peter Banyard 💜
  - Fixed deoptimization info for interrupt handler in [8f06febedf](https://github.com/php/php-src/commit/8f06febedf) by Dmitry Stogov
  - Use more appropriate types for `php_array_walk()` function in [a02f7f24c6](https://github.com/php/php-src/commit/a02f7f24c6) by George Peter Banyard 💜
  - Disable old `libxml2` hack if the version does not suffer from the bug in [GH-11379](https://github.com/php/php-src/pull/11379) by Niels Dossche
  - Update NEWS for PHP 8.3.0alpha1 in [5b430a25fa](https://github.com/php/php-src/commit/5b430a25fa) by Jakub Zelenka 💜
  - Fix test failure for `init_fcall_003.phpt` without opcache in [GH-11378](https://github.com/php/php-src/pull/11378) by nielsdos
  - Fix missing randomness check and insufficient random bytes for SOAP HTTP Digest in [ac4254ad76](https://github.com/php/php-src/commit/ac4254ad76) by Niels Dossche
  - Fix [GH-11382](https://github.com/php/php-src/issues/11382) add missing hash header for bin2hex in [0572448263](https://github.com/php/php-src/commit/0572448263) by Remi Collet
  - Update NEWS in [b720ab99f8](https://github.com/php/php-src/commit/b720ab99f8) by Pierrick Charron
  - Add example commit message to release process doc in [938ebb3b61](https://github.com/php/php-src/commit/938ebb3b61) by Ben Ramsey
  - Add PHP 8.3 to release process doc; remove 7.4 in [ca1905116b](https://github.com/php/php-src/commit/ca1905116b) by Ben Ramsey
  - ensure `session.sid_length` have proper value for test in [0561783903](https://github.com/php/php-src/commit/0561783903) by Remi Collet
  - Remove redundant assignment on nodep->ns in [6e04050474](https://github.com/php/php-src/commit/6e04050474) by nielsdos
  - Fix initial array size in `gc_status()` in [GH-11393](https://github.com/php/php-src/pull/11393) by Florian Engelhardt
  - Allow final modifier when using a method from a trait in [GH-11394](https://github.com/php/php-src/pull/11394) by Niels Dossche
  - Keep consistent `EG(current_execute_data)` after return from generator in [GH-11380](https://github.com/php/php-src/pull/11380) by Dmitry Stogov
  - More usage of known `zend_str` instead of C string in [GH-11381](https://github.com/php/php-src/pull/11381) by George Peter Banyard 💜
  - Suppress warning when the test run under non-root in [GH-11400](https://github.com/php/php-src/pull/11400) by Mikhail Galanin
  - Get rid of return value for `php_libxml_unregister_node()` in [GH-11398](https://github.com/php/php-src/pull/11398) by Niels Dossche
  - Fix [#79700](https://bugs.php.net/bug.php?id=79700): Bad performance with namespaced nodes due to wrong libxml assumption in [GH-11376](https://github.com/php/php-src/pull/11376) by nielsdos
  - Fix add/remove observer API with multiple observers installed in [709540ccdc](https://github.com/php/php-src/commit/709540ccdc) by Bob Weinand
  - Fix bug [GH-9356](https://github.com/php/php-src/issues/9356): Incomplete SAN validation of IPv6 address in [GH-11145](https://github.com/php/php-src/pull/11145) by James Lucas
  - Fix CS and checking for IPv6 SAN verify in [3fc013b2e2](https://github.com/php/php-src/commit/3fc013b2e2) by Jakub Zelenka 💜
  - Fix [#70359](https://bugs.php.net/bug.php?id=70359) and [#78577](https://bugs.php.net/bug.php?id=78577): segfaults with DOMNameSpaceNode in [GH-11402](https://github.com/php/php-src/pull/11402) by nielsdos
  - Implement [GH-8641](https://github.com/php/php-src/issues/8641): STREAM_NOTIFY_COMPLETED over HTTP never emitted in [GH-10505](https://github.com/php/php-src/pull/10505) by Niels Dossche
  - Fix [GH-10406](https://github.com/php/php-src/issues/10406): fgets on a redis socket connection fails on PHP 8.3 in [GH-11421](https://github.com/php/php-src/pull/11421) by Jakub Zelenka 💜
  - Fix lifetime issue with getAttributeNodeNS() in [GH-11422](https://github.com/php/php-src/pull/11422) by Niels Dossche
  - Fix "invalid state error" with cloned namespace declarations in [GH-11429](https://github.com/php/php-src/pull/11429) by Niels Dossche
  - Fix [GH-11433](https://github.com/php/php-src/issues/11433): Unable to set CURLOPT_ACCEPT_ENCODING to NULL in [GH-11446](https://github.com/php/php-src/pull/11446) by nielsdos
  - Fix [GH-11406](https://github.com/php/php-src/issues/11406): segfault with unpacking and magic method closure in [GH-11417](https://github.com/php/php-src/pull/11417) by Niels Dossche
  - `ext/pgsql`: adding pg_set_error_context_visibility in [dd8514a0bd](https://github.com/php/php-src/commit/dd8514a0bd) by David CARLIER
  - `ext/pdo_pgsql`: connection status update to distinguish from truly bad quality connections in [ec3daea1d6](https://github.com/php/php-src/commit/ec3daea1d6) by David CARLIER
  - Fix cross-compilation check in phar generation for FreeBSD in [GH-11441](https://github.com/php/php-src/pull/11441) by Peter
  - `ext/imap`: Refactor + Update to modern property write API in [GH-11415](https://github.com/php/php-src/pull/11415) by George Peter Banyard 💜
  - Add test for [GH-11423](https://github.com/php/php-src/issues/11423) in [96ea06a1d9](https://github.com/php/php-src/commit/96ea06a1d9) by Máté Kocsis 💜
  - Forward shutdown exceptions to user error handlers in [GH-110905](https://github.com/php/php-src/pull/110905) by Ilija Tovilo 💜
  - sapi/fpm: add "pcntl" when running test depending pcntl_sigprocmask() in [7ade242e28](https://github.com/php/php-src/commit/7ade242e28) by Mikhail Galanin
  - FPM: Add "pcntl" when running another test depending on pcntl in [9b18466396](https://github.com/php/php-src/commit/9b18466396) by Jakub Zelenka 💜
  - When running FPM tests, pass `-n` option to `php-fpm` in [GH-11373](https://github.com/php/php-src/pull/11373) by Tim Starling
  - Fix bug [#55294](https://bugs.php.net/bug.php?id=55294) and [#47530](https://bugs.php.net/bug.php?id=47530) and [#47847](https://bugs.php.net/bug.php?id=47847): namespace reconciliation issues in [GH-11454](https://github.com/php/php-src/pull/11454) by nielsdos
  - Fix [GH-11451](https://github.com/php/php-src/issues/11451): Invalid associative array containing duplicate keys in [GH-11453](https://github.com/php/php-src/pull/11453) by nielsdos
  - Fix [GH-11404](https://github.com/php/php-src/issues/11404): `DOMDocument::savexml` and friends ommit `xmlns=""` declaration for null namespace, creating incorrect xml representation of the DOM in [GH-11428](https://github.com/php/php-src/pull/11428) by nielsdos
  - `ext/imap`: Remove `php_imap_list_add_object()` function in [5d0304876f](https://github.com/php/php-src/commit/5d0304876f) by George Peter Banyard 💜
  - `ext/imap`: Use propery API instead of `php_imap_hash_add_object()` in [9798dc20e2](https://github.com/php/php-src/commit/9798dc20e2) by George Peter Banyard 💜
  - `ext/imap`: Cleanup custom implementation of `rfc822_write_address()` in [0b99bc21e5](https://github.com/php/php-src/commit/0b99bc21e5) by George Peter Banyard 💜
  - `ext/imap`: Do not condition on number of arguments but on pointer being set or not in [b1dd9b8a39](https://github.com/php/php-src/commit/b1dd9b8a39) by George Peter Banyard 💜
  - `ext/imap`: Add const qualifier for `header_injection()` in [b1f24e3bea](https://github.com/php/php-src/commit/b1f24e3bea) by George Peter Banyard 💜
  - `ext/imap`: Refactor `imap_fetch_overview()` in [d714ae8964](https://github.com/php/php-src/commit/d714ae8964) by George Peter Banyard 💜
  - `ext/imap`: Narrow return type to `true` in [cc9ab53308](https://github.com/php/php-src/commit/cc9ab53308) by George Peter Banyard 💜
  - `ext/imap`: Refactor common conditional property assignment in [6c25257db0](https://github.com/php/php-src/commit/6c25257db0) by George Peter Banyard 💜
  - Move range() tests to a dedicated folder in [53829b7daf](https://github.com/php/php-src/commit/53829b7daf) by George Peter Banyard 💜
  - Add number or str ZPP macros in [80e90ad7ba](https://github.com/php/php-src/commit/80e90ad7ba) by George Peter Banyard 💜
  - `ext/pgsql`: fix PGtrace invalid free issue in [f194cdf852](https://github.com/php/php-src/commit/f194cdf852) by David CARLIER
  - Add missing cache invalidation in `dom_child_replace_with()` in [8904ac7fef](https://github.com/php/php-src/commit/8904ac7fef) by Niels Dossche
  - Fix [#80332](https://bugs.php.net/bug.php?id=80332): Completely broken array access functionality with DOMNamedNodeMap in [GH-11468](https://github.com/php/php-src/pull/11468) by Niels Dossche
  - `ext/gd`: `imagerotate` removes `ignore_transparent` argument in [b0d8c10fd9](https://github.com/php/php-src/commit/b0d8c10fd9) by David CARLIER
  - Zend: Expose `zendi_try_get_long()` function via a public API in [GH-10175](https://github.com/php/php-src/pull/10175) by George Peter Banyard 💜
  - [RFC] Define proper semantics for `range()` function in [GH-10826](https://github.com/php/php-src/pull/10826) by George Peter Banyard 💜
  - Fix [GH-11455](https://github.com/php/php-src/issues/11455): Segmentation fault with custom object date properties in [GH-11473](https://github.com/php/php-src/pull/11473) by Niels Dossche
  - Revert changes to `DOMAttr::$value` and `DOMAttr::$nodeValue` expansion in [GH-11469](https://github.com/php/php-src/pull/11469) by nielsdos
  - `SKIP_(SLOW|ONLINE)_TESTS` in [GH-11479](https://github.com/php/php-src/pull/11479) by divinity76
  - Fix [GH-11476](https://github.com/php/php-src/issues/11476): crash with count_demerits negative-size-param in [443927e3e8](https://github.com/php/php-src/commit/443927e3e8) by Alex Dowad
  - Fixed incorrect VM stack overflow checks elimination in [1a96d64828](https://github.com/php/php-src/commit/1a96d64828) by Dmitry Stogov
  - Update NEWS for PHP 8.3.0alpha2 in [d9e2da342a](https://github.com/php/php-src/commit/d9e2da342a) by Eric Mann
  - [RFC] Implement `mb_str_pad()` in [GH-11284](https://github.com/php/php-src/pull/11284) by Niels Dossche
  - check `PQsetErrorContextVisibility` availability `(libpq >= 9.6)` in [21aaf3321f](https://github.com/php/php-src/commit/21aaf3321f) by Remi Collet
  - mbstring `count_demerits` in reverse order in [GH-11493](https://github.com/php/php-src/pull/11493) by Ilija Tovilo 💜
  - Fix assertion violation for invalid class const objects in const expressions in [GH-11458](https://github.com/php/php-src/pull/11458) by Ilija Tovilo 💜
  - support running testsuite with negative niceness in [GH-11481](https://github.com/php/php-src/pull/11481) by divinity76
  - Fix arm build in [GH-11501](https://github.com/php/php-src/pull/11501) by Ilija Tovilo 💜
  - Mangle PCRE regex cache key with JIT option in [GH-11396](https://github.com/php/php-src/pull/11396) by Michael Voříšek
  - Remove session ID set through `REQUEST_URI` in [f160eff441](https://github.com/php/php-src/commit/f160eff441) by Ilija Tovilo 💜
  - github: add build scripts to "Category: Build System" label in [GH-11474](https://github.com/php/php-src/pull/11474) by eater
  - Fixes "GC_BENCH" is not defined in extensions including `zend_gc.h` in [973e9b2eec](https://github.com/php/php-src/commit/973e9b2eec) by Patrick Allaert
  - Fixed [GH-11368](https://github.com/php/php-src/issues/11368): Date modify returns invalid datetime in [0747616f84](https://github.com/php/php-src/commit/0747616f84) by Derick Rethans 💜
  - Fix [GH-11492](https://github.com/php/php-src/issues/11492): Make test failure: `ext/pdo_sqlite/tests/bug_42589.phpt` in [GH-11494](https://github.com/php/php-src/pull/11494) by Vinicius Dias
  - Revert "Mangle PCRE regex cache key with JIT option" in [4d91665f78](https://github.com/php/php-src/commit/4d91665f78) by Ilija Tovilo 💜
  - Fix [GH-11507](https://github.com/php/php-src/issues/11507): String concatenation performance regression in 8.3 in [GH-11508](https://github.com/php/php-src/pull/11508) by nielsdos
  - fix `file()` flags error-check in [GH-11483](https://github.com/php/php-src/pull/11483) by hanshenrik
  - Fix interrupted CLI output causing the process to exit in [GH-11510](https://github.com/php/php-src/pull/11510) by nielsdos
  - Fix [GH-11408](https://github.com/php/php-src/issues/11408): Unable to build PHP 8.3.0 alpha 1 / fileinfo extension in [GH-11505](https://github.com/php/php-src/pull/11505) by Niels Dossche
  - Fix [GH-11514](https://github.com/php/php-src/issues/11514): PHP 8.3 build fails with `--enable-mbstring` enabled in [GH-11516](https://github.com/php/php-src/pull/11516) by nielsdos
  - Fix [GH-11498](https://github.com/php/php-src/issues/11498): SIGCHLD is not always returned from `proc_open` in [GH-11509](https://github.com/php/php-src/pull/11509) by nielsdos
  - Add missing `WUNTRACED` in [GH-11526](https://github.com/php/php-src/pull/11526) by Niels Dossche
  - Upgrade to PHP-Parser 5.0 in [6dd62fb3d6](https://github.com/php/php-src/commit/6dd62fb3d6) by Máté Kocsis 💜
  - adapt test expectation with libzip 1.10 in [b972af9589](https://github.com/php/php-src/commit/b972af9589) by Remi Collet
  - zip extension version 1.22.0 for libzip 1.10.0 in [b5638a1202](https://github.com/php/php-src/commit/b5638a1202) by Remi Collet
  - NEWS and UPGRADING for zip 1.22.0 in [ddb6cadb4c](https://github.com/php/php-src/commit/ddb6cadb4c) by Remi Collet
  - Fix [GH-11529](https://github.com/php/php-src/issues/11529): Crash after dealing with an Apache request in [GH-11530](https://github.com/php/php-src/pull/11530) by nielsdos
  - Fix [GH-11500](https://github.com/php/php-src/issues/11500): Namespace reuse in createElementNS() generates wrong output in [GH-11528](https://github.com/php/php-src/pull/11528) by Niels Dossche
</details>
<br>
This concludes the list of commits made by the PHP core team in the past month. We're grateful for their hard work and dedication to improving PHP.

<br>

---

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation) or via [GitHub Sponsors](https://github.com/sponsors/ThePHPF).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 

