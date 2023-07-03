---
title: 'PHP Core Roundup #14'
layout: post
tags:
  - roundup
author:
  - name: Ayesh Karunaratne
    url: https://aye.sh
  
  - name: Sergey Panteleev
    url: https://sergeypanteleev.com
published_at: 29 June 2023

---

There have been numerous updates and enhancements to the PHP core over the past month, from thought-provoking RFCs to minor yet profound adjustments. Let's dive in and keep up with the most recent PHP developments.

> The PHP Foundation is a collective of PHP contributors, veterans, and companies that collaborate to ensure the long-term sustainability of the PHP programming language. The foundation currently supports six contributors focused on PHP's maintenance, debt reduction, and feature development. These contributors work closely with others on coding, documentation, and discussions.

<br>

> Started over a year ago, the PHP Core Roundup series offers a summary of the latest developments, discussions, and news about PHP Core, contributed by both PHP Foundation members and other participants. This post is the thirteenth in the PHP Core Roundup series.

{% include "newsletter.html" %}

## Happy 28th birthday, PHP!

On June 8, PHP turned 28 years old! For a throwback, see Rasmus Lerdorf’s [initial public announcement of PHP](https://groups.google.com/g/comp.infosystems.www.authoring.cgi/c/PyJ25gZ6z7A/m/M9FkTUVDfcwJ).

Here’s to many more years of empowering developers and pushing the boundaries of web technology. Happy Birthday, PHP! 🎉🥳🎂

## PHP 8.3.0 QA Releases and Feature-freeze

The upcoming PHP 8.3 version is scheduled to be released on November 23. The newly elected PHP 8.3 release managers made the first QA releases of PHP 8.3 — [PHP&nbsp;8.3.0&nbsp;Alpha&nbsp;1](https://www.php.net/archive/2023.php#2023-06-08-3) — on June 08, and the [second alpha release](https://www.php.net/archive/2023.php#2023-06-22-1) on June 22.

These alpha versions aren't intended for production environments but are provided for testing and local development.

Compiled Windows binaries are available at [windows.php.net/qa](https://windows.php.net/qa/), [Docker images](https://hub.docker.com/_/php/tags?page=1&name=8.3.0) are available at Docker Hub. For macOS, PHP 8.3.0-dev packages are available via Homebrew from [`shivammathur/php`](https://github.com/shivammathur/homebrew-php) tap. 

If you want to compile the source code yourself, you can find it on [php/php-src repository on GitHub](https://github.com/php/php-src). 

**July 18** marks the feature-freeze for PHP 8.3. It means that all major changes to the language must be discussed and voted on prior to this date in order to make it to PHP 8.3.

## Releases

The PHP development team released three new versions in June 2023:

**[PHP 8.2.7](https://www.php.net/archive/2023.php#2023-06-08-2)**, **[PHP 8.1.20](https://www.php.net/archive/2023.php#2023-06-08-4)**, **[PHP 8.0.29](https://www.php.net/archive/2023.php#2023-06-08-1)**

All three include a security fix: [GHSA-76gg-c692-v2mw](https://github.com/php/php-src/security/advisories/GHSA-76gg-c692-v2mw). The random byte generation function used in the SOAP HTTP Digest authentication code was not checked for failure. This could result in a stack information leak.

PHP 8.2.7 and PHP 8.1.20 additionally include several bug fixes and improvements, notably in areas such as Core, Date, Exif, FPM, Hash, LibXML, MBString, Opcache, PCNTL, PGSQL, Phar, Soap, SPL, Standard, and Streams.


## Recent RFCs and Mailing List Discussions

> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

## RFC Updates

Following are the RFCs and major pull-requests discussed, voted on, and implemented since our last update.

### Accepted: [Marking Overridden Methods](https://wiki.php.net/rfc/marking_overriden_methods) by Tim Düsterhus

PHP 8.3 will have a new attribute `#[\Override]`. If this attribute is added to a method, the engine will validate that a method with the same name exists in a parent class or any of the implemented interfaces. If no such method exists, a compile time error will be emitted.

The similar concepts exist in Java, TypeScript, C++, C#, Swift, Kotlin, and other languages.

### Implemented: [Define proper semantics for range() function](https://wiki.php.net/rfc/proper-range-semantics) by George Peter Banyard 💜

In the forthcoming PHP 8.3 release, the `range()` function will have improved behavior. It will now issue warnings or throw exceptions if it receives incompatible or unusable arguments.

### Implemented: [mb_str_pad()](https://wiki.php.net/rfc/mb_str_pad) by Niels Dossche

PHP 8.3 will include a new function that works similarly to the existing `str_pad()` function, but with support for multibyte strings. This is a welcome addition for developers working with multibyte strings, as it will make it easier to manipulate and format these strings in PHP.

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
<br>

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements.
 
---

### Full list of commits  since [PHP Core Roundup #13](/blog/2023/06/06/php-core-roundup-13/)

Commits are grouped by author in random order.

<details markdown="1">
  <summary>Click here to expand</summary>

### James Lucas
- Fix [GH-11246](https://github.com/php/php-src/issues/11246) cli/get_set_process_title in [GH-11247](https://github.com/php/php-src/pull/11247)
- Fix bug [GH-9356](https://github.com/php/php-src/issues/9356): Incomplete SAN validation of IPv6 address in [GH-11145](https://github.com/php/php-src/pull/11145)

### George Peter Banyard 💜
- Fix [`-Wenum-int-mismatch`] compiler warnings in [GH-11352](https://github.com/php/php-src/pull/11352)
- `ext/standard/array.c`: Optimize min/max functions for int/float in [GH-11194](https://github.com/php/php-src/pull/11194)
- `http_fopen_wrapper`: fix [`-Wanalyzer-deref-before-check`] in [810507ab1b](https://github.com/php/php-src/commit/810507ab1b)
- memory stream: fix [`-Wanalyzer-deref-before-check`] in [13ad8ef40b](https://github.com/php/php-src/commit/13ad8ef40b)
- Fix file descriptor check in [c5d7264149](https://github.com/php/php-src/commit/c5d7264149)
- Assert `zend_constant` exist in [ce724d186d](https://github.com/php/php-src/commit/ce724d186d)
- Use known `zend_string` pointer to check for equality instead of C strings in [GH-11370](https://github.com/php/php-src/pull/11370)
- Use common function for `TypeError` on illegal offset access in [GH-10544](https://github.com/php/php-src/pull/10544)
- Use more appropriate types for `php_array_walk()` function in [a02f7f24c6](https://github.com/php/php-src/commit/a02f7f24c6)
- More usage of known `zend_str` instead of C string in [GH-11381](https://github.com/php/php-src/pull/11381)
- `ext/imap`: Refactor + Update to modern property write API in [GH-11415](https://github.com/php/php-src/pull/11415)
- Remove `php_imap_list_add_object()` function in [ext/imap](https://github.com/php/php-src/commit/5d0304876f)
- Use propery API instead of `php_imap_hash_add_object()` in [ext/imap](https://github.com/php/php-src/commit/9798dc20e2)
- Cleanup custom implementation of `rfc822_write_address()` in [ext/imap](https://github.com/php/php-src/commit/0b99bc21e5)
- Do not condition on number of arguments but on pointer being set or not in [ext/imap](https://github.com/php/php-src/commit/b1dd9b8a39)
- Add const qualifier for `header_injection()` in [ext/imap](https://github.com/php/php-src/commit/b1f24e3bea)
- Refactor `imap_fetch_overview()` in [ext/imap](https://github.com/php/php-src/commit/d714ae8964)
- Narrow return type to `true` in [ext/imap](https://github.com/php/php-src/commit/cc9ab53308)
- Refactor common conditional property assignment in [ext/imap](https://github.com/php/php-src/commit/6c25257db0)
- Move range() tests to a dedicated folder in [PHP Source](https://github.com/php/php-src/commit/53829b7daf)
- Add number or str ZPP macros in [PHP Source](https://github.com/php/php-src/commit/80e90ad7ba)
- Expose `zendi_try_get_long()` function via a public API in [Zend](https://github.com/php/php-src/pull/10175)
- Define proper semantics for `range()` function in [RFC](https://github.com/php/php-src/pull/10826)

### Niels Dossche
- Fix [GH-11347](https://github.com/php/php-src/issues/11347): Memory leak when calling a static method inside an xpath query in [GH-11350](https://github.com/php/php-src/pull/11350)
- Use `zval_ptr_dtor_nogc()` for callable in `ext/xslt` in [GH-11356](https://github.com/php/php-src/pull/11356)
- Implement iteration cache, item cache and length cache for node list iteration in [GH-11330](https://github.com/php/php-src/pull/11330)
- Struct-pack `spl_dllist_object` in [5fae4b5031](https://github.com/php/php-src/commit/5fae4b5031)
- Remove dead code from `sxe_get_element_by_name()` in [c6bffff96b](https://github.com/php/php-src/commit/c6bffff96b)
- Remove double class entry variable in [795127942b](https://github.com/php/php-src/commit/795127942b)
- Use `xmlStrEqual()` instead of `!xmlStrCmp()` in [47c277bde5](https://github.com/php/php-src/commit/47c277bde5)
- No need for the double name pointer in [ed097e30f0](https://github.com/php/php-src/commit/ed097e30f0)
- Switch `DOMNodeList::item()` and `DOMNamedNodeMap::item()` to fast ZPP in [GH-11361](https://github.com/php/php-src/pull/11361)
- Fix bug [#67440](https://bugs.php.net/bug.php?id=67440): append_node of a `DOMDocumentFragment` does not reconcile namespaces in [GH-11362](https://github.com/php/php-src/pull/11362)
- Fix bug [#81642](https://bugs.php.net/bug.php?id=81642): `DOMChildNode::replaceWith()` bug when replacing a node with itself in [GH-11363](https://github.com/php/php-src/pull/11363)
- Fix bug [#77686](https://bugs.php.net/bug.php?id=77686): Removed elements are still returned by `getElementById` in [GH-11369](https://github.com/php/php-src/pull/11369)
- Use `uint32_t` for the number of nodes in [GH-11371](https://github.com/php/php-src/pull/11371)
- Let closure created from magic method accept named parameters in [GH-11364](https://github.com/php/php-src/pull/11364)
- Disable old `libxml2` hack if the version does not suffer from the bug in [GH-11379](https://github.com/php/php-src/pull/11379)
- Fix missing randomness check and insufficient random bytes for SOAP HTTP Digest in [ac4254ad76](https://github.com/php/php-src/commit/ac4254ad76)
- Fix test failure for `init_fcall_003.phpt` without opcache in [GH-11378](https://github.com/php/php-src/pull/11378)
- Remove redundant assignment on nodep->ns in [6e04050474](https://github.com/php/php-src/commit/6e04050474)
- Fix [#79700](https://bugs.php.net/bug.php?id=79700): Bad performance with namespaced nodes due to wrong libxml assumption in [GH-11376](https://github.com/php/php-src/pull/11376)
- Fix [#70359](https://bugs.php.net/bug.php?id=70359) and [#78577](https://bugs.php.net/bug.php?id=78577): segfaults with DOMNameSpaceNode in [GH-11402](https://github.com/php/php-src/pull/11402)
- Allow final modifier when using a method from a trait in [GH-11394](https://github.com/php/php-src/pull/11394)
- Get rid of return value for `php_libxml_unregister_node()` in [GH-11398](https://github.com/php/php-src/pull/11398)
- Implement [GH-8641](https://github.com/php/php-src/issues/8641): STREAM_NOTIFY_COMPLETED over HTTP never emitted in [GH-10505](https://github.com/php/php-src/pull/10505)
- Fix lifetime issue with getAttributeNodeNS() in [GH-11422](https://github.com/php/php-src/pull/11422)
- Fix "invalid state error" with cloned namespace declarations in [GH-11429](https://github.com/php/php-src/pull/11429)
- Fix [GH-11406](https://github.com/php/php-src/issues/11406): segfault with unpacking and magic method closure in [GH-11417](https://github.com/php/php-src/pull/11417)
- Fix [GH-11433](https://github.com/php/php-src/issues/11433): Unable to set CURLOPT_ACCEPT_ENCODING to NULL in [GH-11446](https://github.com/php/php-src/pull/11446)
- Fix bug [#55294](https://bugs.php.net/bug.php?id=55294) and [#47530](https://bugs.php.net/bug.php?id=47530) and [#47847](https://bugs.php.net/bug.php?id=47847): namespace reconciliation issues in [GH-11454](https://github.com/php/php-src/pull/11454)
- Fix [GH-11451](https://github.com/php/php-src/issues/11451): Invalid associative array containing duplicate keys in [GH-11453](https://github.com/php/php-src/pull/11453)
- Fix [GH-11404](https://github.com/php/php-src/issues/11404): `DOMDocument::savexml` and friends ommit `xmlns=""` declaration for null namespace, creating incorrect xml representation of the DOM in [GH-11428](https://github.com/php/php-src/pull/11428)
- [RFC] Implement `mb_str_pad()` in [GH-11284](https://github.com/php/php-src/pull/11284)
- Fix [GH-11507](https://github.com/php/php-src/issues/11507): String concatenation performance regression in 8.3 in [GH-11508](https://github.com/php/php-src/pull/11508)
- Fix interrupted CLI output causing the process to exit in [GH-11510](https://github.com/php/php-src/pull/11510)
- Fix [GH-11514](https://github.com/php/php-src/issues/11514): PHP 8.3 build fails with `--enable-mbstring` enabled in [GH-11516](https://github.com/php/php-src/pull/11516)
- Fix [GH-11498](https://github.com/php/php-src/issues/11498): SIGCHLD is not always returned from `proc_open` in [GH-11509](https://github.com/php/php-src/pull/11509)
- Fix [GH-11529](https://github.com/php/php-src/issues/11529): Crash after dealing with an Apache request in [GH-11530](https://github.com/php/php-src/pull/11530)
- Add missing cache invalidation in `dom_child_replace_with()` in [PHP Source](https://github.com/php/php-src/commit/8904ac7fef)
- Fix [#80332](https://bugs.php.net/bug.php?id=80332): Completely broken array access functionality with DOMNamedNodeMap in [PHP Source](https://github.com/php/php-src/pull/11468)
- Fix [GH-11455](https://github.com/php/php-src/issues/11455): Segmentation fault with custom object date properties in [PHP Source](https://github.com/php/php-src/pull/11473)
- Revert changes to `DOMAttr::$value` and `DOMAttr::$nodeValue` expansion in [PHP Source](https://github.com/php/php-src/pull/11469)
- Fix [GH-11408](https://github.com/php/php-src/issues/11408): Unable to build PHP 8.3.0 alpha 1 / fileinfo extension in [GH-11505](https://github.com/php/php-src/pull/11505)
- Add missing `WUNTRACED` in [GH-11526](https://github.com/php/php-src/pull/11526)
- Fix [GH-11500](https://github.com/php/php-src/issues/11500): Namespace reuse in createElementNS() generates wrong output in [GH-11528](https://github.com/php/php-src/pull/11528)

### David CARLIER
- `ext/pgsql`: `php_pgsql_convert` converts `E_NOTICE` to `TypeError`/`ValueError` exceptions in [16a63d7b07](https://github.com/php/php-src/commit/16a63d7b07)
- `ext/pgsql`: adding pg_set_error_context_visibility in [dd8514a0bd](https://github.com/php/php-src/commit/dd8514a0bd)
- `ext/pdo_pgsql`: connection status update to distinguish from truly bad quality connections in [ec3daea1d6](https://github.com/php/php-src/commit/ec3daea1d6)
- Fix PGtrace invalid free issue in [`ext/pgsql`](https://github.com/php/php-src/commit/f194cdf852)
- `imagerotate` removes `ignore_transparent` argument in [`ext/gd`](https://github.com/php/php-src/commit/b0d8c10fd9)

### Tim Starling
- Set `DOMAttr::$value` without expanding entities in [50fdad8325](https://github.com/php/php-src/commit/50fdad8325)
- Factor out `dom_remove_all_children()` in [74910b1403](https://github.com/php/php-src/commit/74910b1403)
- Don't add 1 when calling `xmlNodeSetContent()` in [ee68c22128](https://github.com/php/php-src/commit/ee68c22128)
- Also avoid entity expansion in `DOMAttr::$nodeValue` in [076ddf2b05](https://github.com/php/php-src/commit/076ddf2b05)
- Changelog notes for `DOMAttr` value and nodeValue properties in [0cc028c374](https://github.com/php/php-src/commit/0cc028c374)
- Improve test `DOMAttr_entity_expansion.phpt` in [ab77485890](https://github.com/php/php-src/commit/ab77485890)
- When running FPM tests, pass `-n` option to `php-fpm` in [GH-11373](https://github.com/php/php-src/pull/11373)

## Dmitry Stogov
- Fixed deoptimization info for interrupt handler in [8f06febedf](https://github.com/php/php-src/commit/8f06febedf)
- Keep consistent `EG(current_execute_data)` after return from generator in [GH-11380](https://github.com/php/php-src/pull/11380)
- Fixed incorrect VM stack overflow checks elimination in [1a96d64828](https://github.com/php/php-src/commit/1a96d64828)

## Jakub Zelenka 💜
- Update NEWS for PHP 8.3.0alpha1 in [5b430a25fa](https://github.com/php/php-src/commit/5b430a25fa)
- Fix CS and checking for IPv6 SAN verify in [3fc013b2e2](https://github.com/php/php-src/commit/3fc013b2e2)
- Fix [GH-10406](https://github.com/php/php-src/issues/10406): fgets on a redis socket connection fails on PHP 8.3 in [GH-11421](https://github.com/php/php-src/pull/11421)
- FPM: Add "pcntl" when running another test depending on pcntl in [9b18466396](https://github.com/php/php-src/commit/9b18466396)

## Remi Collet
- Fix [GH-11382](https://github.com/php/php-src/issues/11382) add missing hash header for bin2hex in [0572448263](https://github.com/php/php-src/commit/0572448263)
- Ensure `session.sid_length` have proper value for test in [0561783903](https://github.com/php/php-src/commit/0561783903)
- Check `PQsetErrorContextVisibility` availability `(libpq >= 9.6)` in [21aaf3321f](https://github.com/php/php-src/commit/21aaf3321f)
- adapt test expectation with libzip 1.10 in [b972af9589](https://github.com/php/php-src/commit/b972af9589)
- zip extension version 1.22.0 for libzip 1.10.0 in [b5638a1202](https://github.com/php/php-src/commit/b5638a1202)
- NEWS and UPGRADING for zip 1.22.0 in [ddb6cadb4c](https://github.com/php/php-src/commit/ddb6cadb4c)

### Pierrick Charron
- Update NEWS in [b720ab99f8](https://github.com/php/php-src/commit/b720ab99f8)

### Ben Ramsey
- Add example commit message to release process doc in [938ebb3b61](https://github.com/php/php-src/commit/938ebb3b61)
- Add PHP 8.3 to release process doc; remove 7.4 in [ca1905116b](https://github.com/php/php-src/commit/ca1905116b)

### Florian Engelhardt
- Fix initial array size in `gc_status()` in [GH-11393](https://github.com/php/php-src/pull/11393)

### Mikhail Galanin
- Suppress warning when the test run under non-root in [GH-11400](https://github.com/php/php-src/pull/11400)
- sapi/fpm: add "pcntl" when running test depending pcntl_sigprocmask() in [7ade242e28](https://github.com/php/php-src/commit/7ade242e28)

### Bob Weinand
- Fix add/remove observer API with multiple observers installed in [709540ccdc](https://github.com/php/php-src/commit/709540ccdc)

### Peter Chun-Sheng, Li
- Fix cross-compilation check in phar generation for FreeBSD in [GH-11441](https://github.com/php/php-src/pull/11441)

### Máté Kocsis 💜
- Add test for [GH-11423](https://github.com/php/php-src/issues/11423) in [96ea06a1d9](https://github.com/php/php-src/commit/96ea06a1d9)
- Upgrade to PHP-Parser 5.0 in [6dd62fb3d6](https://github.com/php/php-src/commit/6dd62fb3d6)

### Ilija Tovilo 💜
- Forward shutdown exceptions to user error handlers in [GH-110905](https://github.com/php/php-src/pull/110905)
- `mbstring count_demerits` in reverse order in [GH-11493](https://github.com/php/php-src/pull/11493)
- Fix assertion violation for invalid class const objects in const expressions in [GH-11458](https://github.com/php/php-src/pull/11458)
- Fix arm build in [GH-11501](https://github.com/php/php-src/pull/11501)
- Remove session ID set through `REQUEST_URI` in [f160eff441](https://github.com/php/php-src/commit/f160eff441)
- Revert "Mangle PCRE regex cache key with JIT option" in [4d91665f78](https://github.com/php/php-src/commit/4d91665f78)

### divinity76
- Implement `SKIP_(SLOW|ONLINE)_TESTS` in [GH-11479](https://github.com/php/php-src/pull/11479)
- Support running testsuite with negative niceness in [GH-11481](https://github.com/php/php-src/pull/11481)

### Alex Dowad
- Fix [GH-11476](https://github.com/php/php-src/issues/11476): crash with count_demerits negative-size-param in [443927e3e8](https://github.com/php/php-src/commit/443927e3e8)

### Eric Mann
- Update NEWS for PHP 8.3.0alpha2 in [d9e2da342a](https://github.com/php/php-src/commit/d9e2da342a)

### Michael Voříšek
- Mangle PCRE regex cache key with JIT option in [GH-11396](https://github.com/php/php-src/pull/11396)

### eater
- Add build scripts to "Category: Build System" label in [GH-11474](https://github.com/php/php-src/pull/11474)

### Patrick Allaert
- Fixes "GC_BENCH" is not defined in extensions including `zend_gc.h` in [973e9b2eec](https://github.com/php/php-src/commit/973e9b2eec)

### Derick Rethans 💜
- Fixed [GH-11368](https://github.com/php/php-src/issues/11368): Date modify returns invalid datetime in [0747616f84](https://github.com/php/php-src/commit/0747616f84)

### Vinicius Dias
- Fix [GH-11492](https://github.com/php/php-src/issues/11492): Make test failure: `ext/pdo_sqlite/tests/bug_42589.phpt` in [GH-11494](https://github.com/php/php-src/pull/11494)

### hanshenrik
- fix `file()` flags error-check in [GH-11483](https://github.com/php/php-src/pull/11483)


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

