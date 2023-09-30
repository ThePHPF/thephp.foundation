
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

## PHP 8.3 Release Page

A [pull-request](https://github.com/php/web-php/pull/807) for the upcoming PHP 8.3 release page on php.net is in the progress, and you can help with that!

This is a continuation of [a good tradition](https://externals.io/message/112026) started by Roman Pronskiy, Alexander Makarov, and Svetlana Belozerova.

Check out how these pages looked like for [PHP 8.0](https://www.php.net/releases/8.0/en.php), [PHP 8.1](https://www.php.net/releases/8.1/en.php), and [PHP 8.2](https://www.php.net/releases/8.2/en.php).

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

George P. Banyard 💜 is tracking the progress for PHP 8.3 related changes in [php/doc-en#2796](https://github.com/php/doc-en/issues/2796), and also triaged issues in the docs and marked several of them as "good first time", which are ideal easy picks if you would like to start contributing to PHP docs. You can find the full list on [GitHub](https://github.com/php/doc-en/issues?q=is%3Aopen+is%3Aissue+label%3A%22good+first+issue%22).

<br>

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements.
 
---

### Full list of commits  since [PHP Core Roundup #16](/blog/2023/09/01/php-core-roundup-16/)

Commits are in the order they were added, grouped by author in alphabetical order.

<details markdown="1">
  <summary>Click here to expand</summary>

### Alex Dowad
 - `PHP_HAVE_BUILTIN_USUB_OVERFLOW` macro is defined even if __builtin_usub_overflow not available in [50ca24251d](https://github.com/php/php-src/commit/50ca24251d)


### Calvin Buckley
 - ODBC unit tests shouldn&#039;t override odbc.ini location in [a648d39297](https://github.com/php/php-src/commit/a648d39297)
 - Fix persistent procedural ODBC connections not getting closed in [5a2b251610](https://github.com/php/php-src/commit/5a2b251610)
 - Fix memory leak with failed SQLPrepare in [a022ec53bd](https://github.com/php/php-src/commit/a022ec53bd)


### David CARLIER
 - zend call stack support for haiku w/o using posix pthread api but the in [GH-12103](https://github.com/php/php-src/pull/12103)


### David Carlier
 - Fix [GH-12190](https://github.com/php/php-src/issues/12190): `stream_context_create` with address and port at 0 in [d65c80031a](https://github.com/php/php-src/commit/d65c80031a)
 - Fix [GH-12282](https://github.com/php/php-src/issues/12282): `IntlDateFormatter::construct` should throw an exception is the locale field has an invalid value in [a80db7b52a](https://github.com/php/php-src/commit/a80db7b52a)
 - `ext/intl`: expose dateformat UDAT_PATTERN constant in [f6fae19a10](https://github.com/php/php-src/commit/f6fae19a10)
 - Fix [GH-12243](https://github.com/php/php-src/issues/12243), segfault on `IntlDateFormatter::construct` with dateType set to UDAT_PATTERN but not timeType in [84c4336aa3](https://github.com/php/php-src/commit/84c4336aa3)
 - `zend_call_stack_get` implementation for NetBSD in [aef5225394](https://github.com/php/php-src/commit/aef5225394)


### divinity76
 - random: Perform fewer iterations if SKIP_SLOW_TESTS is set in [GH-12279](https://github.com/php/php-src/pull/12279)
 - support running testsuite with negative niceness in [GH-11481](https://github.com/php/php-src/pull/11481)


### Dmitry Stogov
 - Fixed tracing JIT support for CALLABLE_CONVERT in [GH-12156](https://github.com/php/php-src/pull/12156)
 - Fix ws in [3ffa1c4c3e](https://github.com/php/php-src/commit/3ffa1c4c3e)
 - Fixed tracing jit for BIND_INIT_STATIC_OR_JMP in [95edb50b58](https://github.com/php/php-src/commit/95edb50b58)
 - Fixed uninitialized EX(opline) access (possible Zend/tests/gh12073.phpt crash) in [f1f608bf53](https://github.com/php/php-src/commit/f1f608bf53)
 - Use version of PHP SDK binary tools that uses PHP downloads in [b7af61a154](https://github.com/php/php-src/commit/b7af61a154)


### Florian Sowade
 - Fix [GH-12207](https://github.com/php/php-src/issues/12207) memory leak of doc blocks of static properties in [910f579f14](https://github.com/php/php-src/commit/910f579f14)


### George Peter Banyard
 - `ext/mysqli`: Work on making tests parallizable in [GH-11814](https://github.com/php/php-src/pull/11814)
 - `ext/pcntl`: Remove useless call to `zend_get_callable_name()` in [GH-12241](https://github.com/php/php-src/pull/12241)
 - Fixed oss-fuzz [#62294](https://bugs.php.net/bug.php?id=62294): Unsetting variable after ++/-- on string variable warning in [0b614a6c2b](https://github.com/php/php-src/commit/0b614a6c2b)
 - Zend: Remove dependency on `zend.h` for certain headers in [GH-12166](https://github.com/php/php-src/pull/12166)
 - streams: Checking if a stream is castable should not emit warnings for user defined streams in [d68073c23b](https://github.com/php/php-src/commit/d68073c23b)
 - `ext/pdo`: Refactor `pdo_stmt_construct()` to use newer FCI/FCC API in [GH-12142](https://github.com/php/php-src/pull/12142)
 - Fix OSS Fuzz [#61865](https://bugs.php.net/bug.php?id=61865): Undef variable in ++/-- for declared property that is unset in error handler in [8a392eddf9](https://github.com/php/php-src/commit/8a392eddf9)
 - Fixed bug [GH-12020](https://github.com/php/php-src/issues/12020): `intl_get_error_message()` broken after `MessageFormatter::formatMessage()` fails in [a579fa807c](https://github.com/php/php-src/commit/a579fa807c)
 - Add tests for oss-fuzz-61469: Undef dynamic property in ++/-- unset in error handler in [013bb5769b](https://github.com/php/php-src/commit/013bb5769b)


### Graham Campbell
 - Removed incorrect news items for things already in 8.3.x or earlier in [58b8393cce](https://github.com/php/php-src/commit/58b8393cce)


### Ilija Tovilo
 - Use autoconf for recognizing __builtin_unreachable() in [GH-12266](https://github.com/php/php-src/pull/12266)
 - Fix getpriority test with negative return value in [181598d403](https://github.com/php/php-src/commit/181598d403)
 - Use __builtin_unreachable() directly in `ZEND_UNREACHABLE` in [37ce7199f2](https://github.com/php/php-src/commit/37ce7199f2)
 - Move static property check to assert in [GH-12239](https://github.com/php/php-src/pull/12239)
 - Upgrade to macOS 12 in CI in [55ed7690f4](https://github.com/php/php-src/commit/55ed7690f4)
 - Upload callgrind profile to GA in [GH-12212](https://github.com/php/php-src/pull/12212)
 - Fix filter_var with callback and explicit REQUIRE_SCALAR in [c2fb10d2d2](https://github.com/php/php-src/commit/c2fb10d2d2)
 - Use `zend_error_noreturn` for E_ERROR consistently in [692cea5cbc](https://github.com/php/php-src/commit/692cea5cbc)
 - Fix noreturn with warning that should be an error in [2227fefa17](https://github.com/php/php-src/commit/2227fefa17)
 - Improve invalid cpp modifier message in [011071a3b3](https://github.com/php/php-src/commit/011071a3b3)
 - Fix `zend_separate_if_call_and_write` for FUNC_ARGs in [748adf18fc](https://github.com/php/php-src/commit/748adf18fc)
 - Revert &quot;Skip profiling of sqlite3_step&quot; in [3fb09940fc](https://github.com/php/php-src/commit/3fb09940fc)
 - Skip profiling of sqlite3_step in [bb31a75321](https://github.com/php/php-src/commit/bb31a75321)
 - Revert [479e6593](https://github.com/php/php-src/commit/479e65933154f1da92e6a820000e3bd3b2392874) in [3433dab5f7](https://github.com/php/php-src/commit/3433dab5f7)
 - Fix freeing of incompletely initialized closures in [af2110e664](https://github.com/php/php-src/commit/af2110e664)
 - `xfail` mbstring test on Windows 32-bit in [6b74f1f745](https://github.com/php/php-src/commit/6b74f1f745)
 - Fix master branch check in find-target-branch.bat in [9ce9c11ee8](https://github.com/php/php-src/commit/9ce9c11ee8)
 - Include branch in benchmarking information in [ee6f9e294c](https://github.com/php/php-src/commit/ee6f9e294c)


### Jakub Zelenka
 - Prepare NEWS for PHP 8.3.0RC4 in [517411d2fb](https://github.com/php/php-src/commit/517411d2fb)
 - Reduce impact of stream file path check in filestat in [5e8c992c78](https://github.com/php/php-src/commit/5e8c992c78)
 - Fix [GH-12151](https://github.com/php/php-src/issues/12151): str_getcsv ending with escape zero segfualt in [64ebadcac5](https://github.com/php/php-src/commit/64ebadcac5)
 - Use version of PHP SDK binary tools that uses PHP downloads in [GH-12085](https://github.com/php/php-src/pull/12085)


### ju1ius
 - Prevents double call to internal iterator rewind handler in [da7a66d647](https://github.com/php/php-src/commit/da7a66d647)
 - adds failing test case for [GH-12060](https://github.com/php/php-src/issues/12060) in [9658d9ada4](https://github.com/php/php-src/commit/9658d9ada4)


### Kamil Tekiela
 - Remove MySQL 4.1 checks in [83738fc9a4](https://github.com/php/php-src/commit/83738fc9a4)
 - Improve mysqli_character_set_name tests in [5f6bf3edd6](https://github.com/php/php-src/commit/5f6bf3edd6)


### Levi Morrison
 - Set func pointer to null in Closure __invoke in [GH-12275](https://github.com/php/php-src/pull/12275)


### Lewis Cowles
 - ci: more verbose output in [GH-12264](https://github.com/php/php-src/pull/12264)


### Max Semenik
 - Fix [GH-12186](https://github.com/php/php-src/issues/12186): segfault copying/cloning a finalized HashContext in [10f5a06d3c](https://github.com/php/php-src/commit/10f5a06d3c)


### Máté Kocsis
 - Fix predefined constant page synchonization in [cc2a68e588](https://github.com/php/php-src/commit/cc2a68e588)
 - Fix [GH-12123](https://github.com/php/php-src/issues/12123) Make _ZEND_TYPE_PREFIX apply only for MSVC in [45c7e3b06b](https://github.com/php/php-src/commit/45c7e3b06b)
 - Fix type of the `PHP_FLOAT_DIG` constant in [58657ff26a](https://github.com/php/php-src/commit/58657ff26a)
 - Fix type of the `PHP_FLOAT_DIG` constant in [2fad7cdd60](https://github.com/php/php-src/commit/2fad7cdd60)
 - Improve detection of predefined constants in [2cb4d00693](https://github.com/php/php-src/commit/2cb4d00693)
 - Add support for verifying and syncronizing predefined constants with the manual in [0363dbfef4](https://github.com/php/php-src/commit/0363dbfef4)
 - Align class name detection to the new class synopsis format in [c5fb8b6a6b](https://github.com/php/php-src/commit/c5fb8b6a6b)


### Niels Dossche
 - Revert &quot;Fix [GH-10008](https://github.com/php/php-src/issues/10008): Narrowing occurred during type inference of `ZEND_ADD_ARRAY_ELEMENT`&quot; in [643c4ba417](https://github.com/php/php-src/commit/643c4ba417)
 - Fix compile error with -Werror=incompatible-function-pointer-types and old libxml2 in [df89409aba](https://github.com/php/php-src/commit/df89409aba)
 - Fix [GH-10008](https://github.com/php/php-src/issues/10008): Narrowing occurred during type inference of `ZEND_ADD_ARRAY_ELEMENT` in [e72fc12058](https://github.com/php/php-src/commit/e72fc12058)
 - Fix type error on `XSLTProcessor::transformToDoc` return value with SimpleXML in [2a7f23e9b9](https://github.com/php/php-src/commit/2a7f23e9b9)
 - Restore old namespace reconciliation behaviour in [e127f87114](https://github.com/php/php-src/commit/e127f87114)
 - Fix [GH-11997](https://github.com/php/php-src/issues/11997): ctype_alnum 5 times slower in PHP 8.1 or greater in [07811b6390](https://github.com/php/php-src/commit/07811b6390)
 - Fix [GH-12297](https://github.com/php/php-src/issues/12297): PHP Startup: Invalid library (maybe not a PHP library) &#039;mysqlnd.so&#039; in Unknown on line in [14fc3d1566](https://github.com/php/php-src/commit/14fc3d1566)
 - Fix [GH-12167](https://github.com/php/php-src/issues/12167) and [GH-12169](https://github.com/php/php-src/issues/12169): Unable to get comment or processing instruction contents in SimpleXML in [82a84d0b7b](https://github.com/php/php-src/commit/82a84d0b7b)
 - Make sure core module has number 0 in [GH-12272](https://github.com/php/php-src/pull/12272)
 - Extend C14N fast path to HTML documents too in [GH-12293](https://github.com/php/php-src/pull/12293)
 - Remove unnecessary libxml2 version checks in [6a7b96529b](https://github.com/php/php-src/commit/6a7b96529b)
 - Add additional test for special cases for C14N in [916dedf7d7](https://github.com/php/php-src/commit/916dedf7d7)
 - Remove unnecessary invalidation in [554f659602](https://github.com/php/php-src/commit/554f659602)
 - Implement [#53655](https://bugs.php.net/bug.php?id=53655): Improve speed of DOMNode::C14N() on large XML documents in [5d68d61943](https://github.com/php/php-src/commit/5d68d61943)
 - Fix memory leak when calling `xml_parse_into_struct()` twice in [30f26b587a](https://github.com/php/php-src/commit/30f26b587a)
 - Fix return type of stub of `xml_parse_into_struct()` in [b1d9a8d321](https://github.com/php/php-src/commit/b1d9a8d321)
 - Fix [GH-12215](https://github.com/php/php-src/issues/12215): Module entry being overwritten causes type errors in `ext/dom` (PHP 8.4) in [8a812c3fda](https://github.com/php/php-src/commit/8a812c3fda)
 - Fix [GH-12215](https://github.com/php/php-src/issues/12215): Module entry being overwritten causes type errors in `ext/dom` (&lt;= PHP 8.3) in [da6097ffc8](https://github.com/php/php-src/commit/da6097ffc8)
 - Fix bug [#55098](https://bugs.php.net/bug.php?id=55098): SimpleXML iteration produces infinite loop in [1a4e401bf0](https://github.com/php/php-src/commit/1a4e401bf0)
 - Fix [GH-11956](https://github.com/php/php-src/issues/11956): PCRE regular expressions with JIT enabled gives different result in [d61efdfe97](https://github.com/php/php-src/commit/d61efdfe97)
 - Fix [GH-12208](https://github.com/php/php-src/issues/12208): SimpleXML infinite loop when a cast is used inside a foreach in [486276f0f9](https://github.com/php/php-src/commit/486276f0f9)
 - Simplify `php_sxe_count_elements_helper()` by using non-destructive iterator reset in [8f9626c0f7](https://github.com/php/php-src/commit/8f9626c0f7)
 - Add a test case for iterator and empty &amp; var_dump interactions in [fe98a16af7](https://github.com/php/php-src/commit/fe98a16af7)
 - Use `php_sxe_reset_iterator_no_clear_iter_data()` to avoid having to store and restore iterator data in [550ec29821](https://github.com/php/php-src/commit/550ec29821)
 - Remove unnecessary _IS_BOOL case in [GH-12230](https://github.com/php/php-src/pull/12230)
 - Fix [GH-12223](https://github.com/php/php-src/issues/12223): Entity reference produces infinite loop in var_dump/print_r in [39a9e561f9](https://github.com/php/php-src/commit/39a9e561f9)
 - Fix [GH-12192](https://github.com/php/php-src/issues/12192): SimpleXML infinite loop when getName() is called within foreach in [4d888cf53f](https://github.com/php/php-src/commit/4d888cf53f)
 - Simplify node check in simplexml in [0fee720173](https://github.com/php/php-src/commit/0fee720173)
 - Fix [GH-12170](https://github.com/php/php-src/issues/12170): Can&#039;t use xpath with comments in SimpleXML in [747335f100](https://github.com/php/php-src/commit/747335f100)
 - Small optimization in `php_sxe_get_first_node()` by avoiding unwrapping iterator data in [GH-12194](https://github.com/php/php-src/pull/12194)
 - Fix [#52751](https://bugs.php.net/bug.php?id=52751): XPath processing-`instruction()` function is not supported in [107443b311](https://github.com/php/php-src/commit/107443b311)
 - Deduplicate ParentNode and ChildNode interface implementations using @implementation-alias in [f2fede56c8](https://github.com/php/php-src/commit/f2fede56c8)
 - Remove useless SKIP_TEXT() invokes in [GH-12164](https://github.com/php/php-src/pull/12164)
 - Preallocate result array size in simplexml xpath in [d18bab5562](https://github.com/php/php-src/commit/d18bab5562)
 - Remove obsolete libxml2 code in [0ea268b51a](https://github.com/php/php-src/commit/0ea268b51a)
 - Use `zend_get_gc_buffer_add_fcc()` in [49980ee89d](https://github.com/php/php-src/commit/49980ee89d)
 - Fix build with sqlite3 gc and fci/fcc api in [1d59b37742](https://github.com/php/php-src/commit/1d59b37742)
 - Fix [GH-11878](https://github.com/php/php-src/issues/11878): SQLite3 callback functions cause a memory leak with a callable array in [07a9d2fb32](https://github.com/php/php-src/commit/07a9d2fb32)
 - Add `DOMNode::compareDocumentPosition()` in [GH-12146](https://github.com/php/php-src/pull/12146)
 - Replace always-false attribute type check with assertion in [8c2c69494e](https://github.com/php/php-src/commit/8c2c69494e)
 - Update bundled pcre2 to 10.42 in [c4e8f652c5](https://github.com/php/php-src/commit/c4e8f652c5)
 - Remove DOM_NO_ARGS() and DOM_NOT_IMPLEMENTED() in [GH-12147](https://github.com/php/php-src/pull/12147)
 - Tweak behaviour of dynamic properties wrt error handlers in [eee1617f38](https://github.com/php/php-src/commit/eee1617f38)
 - Use `zend_result` as return for properties in `ext/dom` in [GH-12113](https://github.com/php/php-src/pull/12113)
 - Preallocate result array size in xpath in [GH-12105](https://github.com/php/php-src/pull/12105)
 - Add XPath tests for basic types in [7be47953a3](https://github.com/php/php-src/commit/7be47953a3)
 - Add XPath test with a context node in [07c688f224](https://github.com/php/php-src/commit/07c688f224)


### Peter Kokot
 - Remove _IO_cookie_io_functions_t in favor of cookie_io_functions_t in [abed8b8e41](https://github.com/php/php-src/commit/abed8b8e41)
 - Fix too many arguments in FPM ACL compile check in [GH-12242](https://github.com/php/php-src/pull/12242)
 - Remove unused `--with-zlib-dir` configure option in [a8e1b1018d](https://github.com/php/php-src/commit/a8e1b1018d)
 - Remove unneeded `zend_language_parser.h` patch in [GH-12178](https://github.com/php/php-src/pull/12178)


### Remi Collet
 - Fix port conflict 64324 used in `bug51056.phpt` in [80266f80d4](https://github.com/php/php-src/commit/80266f80d4)
 - zip: add new test for dynamic files in [57123ee489](https://github.com/php/php-src/commit/57123ee489)
 - also display PHP version in phpize in [c3c4b5356a](https://github.com/php/php-src/commit/c3c4b5356a)
 - ensure displays_errors is off (default) in [1f2cfd8009](https://github.com/php/php-src/commit/1f2cfd8009)


### Thomas Hurst
 - Fix [GH-12273](https://github.com/php/php-src/issues/12273) - configure __builtin_cpu_init() check in [66a33dbdce](https://github.com/php/php-src/commit/66a33dbdce)
 - Fix [GH-12273](https://github.com/php/php-src/issues/12273) - configure __builtin_cpu_init() check in [d93800ec0f](https://github.com/php/php-src/commit/d93800ec0f)


### Tim Düsterhus
 - abs: Make `value == ZEND_LONG_MIN` an unexpected branch in [9e66bc9b97](https://github.com/php/php-src/commit/9e66bc9b97)
 - round: Make `fractional == 0.5` an unexpected branch in [865535267b](https://github.com/php/php-src/commit/865535267b)
 - Unify type juggling in `math.c` in [GH-12286](https://github.com/php/php-src/pull/12286)
 - UPGRADING: Move the validation of the rounding mode to Backward Incompatible Changes in [659c06d4c9](https://github.com/php/php-src/commit/659c06d4c9)
 - `round()`: Validate the rounding mode in [GH-12252](https://github.com/php/php-src/pull/12252)
 - Reimplement `php_round_helper()` using `modf()` in [GH-12220](https://github.com/php/php-src/pull/12220)
 - Fix #[Override] on traits overriding a parent method without a matching interface in [GH-12205](https://github.com/php/php-src/pull/12205)
 - Show the integer size in `phpinfo()` in [GH-12201](https://github.com/php/php-src/pull/12201)
 - Add abstract __construct() test for #[\Override] (024.phpt) in [0e9d658dd2](https://github.com/php/php-src/commit/0e9d658dd2)
 - Update GitHub Action workflows to `actions/checkout@v4` (8.3+) in [99cd81cd0a](https://github.com/php/php-src/commit/99cd81cd0a)
 - Update GitHub Action workflows to `actions/checkout@v4` in [45e60e585e](https://github.com/php/php-src/commit/45e60e585e)


### twosee
 - Fix `socket_export_stream()` with wrong protocol in [b5da98b972](https://github.com/php/php-src/commit/b5da98b972)

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


