
---
title: 'PHP Core Roundup #9'
layout: post
tags:
    - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 30 January 2023
---

The first for the year 2023, and the ninth in the series, this episode of PHP Core Roundup is full of exciting new developments in PHP and about PHP 8.2, the latest PHP version released last month! January was a busy month with many RFC proposals, discussions, votes, and some that are already included for the upcoming PHP 8.3 version that is scheduled for November 2023.

> The PHP Foundation currently supports six part-time PHP contributors who work on maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.

<br>
We publish the posts on our website, and you can subscribe to a newsletter; You don’t necessarily have to be a PHP Foundation backer to follow _PHP Core Roundup_.

{% include "newsletter.html" %}

## PHP 8.2 Released

PHP 8.2 is here! With type-system improvements, `readonly `classes, sensitive parameter redaction support, a new "`random`" extension, and several new features and improvements, PHP 8.2.0 was released on December 08th, followed by a security-fix release 8.2.1 on January 05th.

Over **110 people**, along with our six PHP Foundation members, helped shape PHP 8.2. **Thank you for your amazing efforts 🙏🏼💜**.

[PHP 8.2 Release Announcement](https://www.php.net/releases/8.2/en.php) on [php.net](https://php.net) contains a summary of what’s new and changed in PHP 8.2. Detailed lists and guides are also available on [PHP.Watch: PHP 8.2](https://php.watch/versions/8.2) and [Stitcher.io](https://stitcher.io/blog/new-in-php-82).


## PHP 8.3 RFCs and Discussions

Discussions and proposals for new features and changes for the upcoming PHP version 8.3 were being made even before PHP 8.2.0 was released. January was a particularly eventful month with several proposals and discussions, including a few that went to a vote, and a few that are now implemented in the PHP master branch.

Most of the proposed improvements are in improving existing PHP functionality, especially the new readonly properties/class and the random extension. There were also discussions and proposals about adding a new syntax similar to Swift to declare granular get/set access to properties, passing the calling scope to class magic methods, and more.

Additionally, the [Deprecations for PHP 8.3 RFC](https://wiki.php.net/rfc/deprecations_php_8_3) is also being drafted and discussed on features that the community proposes to deprecate in PHP 8.3 and remove in PHP 9.0.


## Recent RFCs, Merged PRs, Discussions, and Commits

> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

### RFC Updates

Following are the RFCs and major pull-requests discussed, voted, and implemented since our last update.


*	**RFC In Voting: [Readonly amendments](https://wiki.php.net/rfc/readonly_amendments) 💜**

	RFC by Nicolas Grekas and Máté Kocsis, attempts to address some of the shortcomings of PHP 8.1 readonly properties and 8.2 readonly classes.

	This RFC proposes allowing `readonly` classes to be extended by non-readonly classes (currently not allowed, and causes a fatal error), and to allow reinitializing readonly properties during cloning (within the `__clone()` magic method).

*	**RFC Accepted: [More Appropriate Date/Time Exceptions](https://wiki.php.net/rfc/datetime-exceptions) 💜**

	RFC by Derick Rethans, proposed to introduce Date/Time extension-specific exceptions and errors. This detailed RFC suggests more specificity in the exceptions with exception classes such as `DateInvalidTimeZoneException`, and `DateMalformedPeriodStringException` as well as promoting some of the current PHP warnings to Error exceptions.

    The vote was accepted, and the [pull-request](https://github.com/php/php-src/pull/10366) is nearly ready to be merged.


*	**RFC Implemented: [Randomizer Additions](https://wiki.php.net/rfc/randomizer_additions)**

	RFC by Joshua Rüsweg and Tim Düsterhus, proposed to add new “building block” methods to `\Random\Randomizer` (added in PHP 8.2) that implement commonly useful operations that are either verbose or very hard to implement in userland.

	The RFC proposed to add two new methods: `getBytesFromString`, to generate a random string containing specific characters, and `getFloat`/`nextFloat`, to generate a random floating point value.

*	**RFC Under Discussion: [Pass Scope to Magic Accessors](https://wiki.php.net/rfc/pass_scope_to_magic_accessors) 💜**

	RFC by Nicolas Grekas and Ilija Tovilo, proposing to pass the calling scope to magic accessors to make it trivial to get it. While it is currently possible to retrieve the calling scope by retrieving the backtrace, the RFC proposes to pass the calling scope as the last argument to the magic methods, making it easier compared to fiddling with the debug backtrace.

*	**RFC Under Discussion: [Path to Saner Increment/Decrement operators](https://wiki.php.net/rfc/saner-inc-dec-operators) 💜**

	PHP's increment and decrement operators can have some surprising behaviours when used with types other than int and float. Various previous attempts ([1](https://wiki.php.net/rfc/normalize_inc_dec), [2](https://wiki.php.net/rfc/alpanumeric_decrement), [3](https://wiki.php.net/rfc/increment_decrement_fixes)) have been made to improve the behaviour of these operators, but none have been implemented. The goal of this RFC by George Peter Banyard is to normalize the behaviour of `$v++` and `$v--` to be the same as `$v += 1` and `$v -= 1`, respectively.
	
*	**RFC Under Discussion: [Saner `array_(sum|product)()`](https://wiki.php.net/rfc/saner-array-sum-product) 💜**

	RFC by George Peter Banyard suggests improvements to the existing `array_sum` and `array_product` functions by emitting a warning when the arrays being summed/multiplied contain invalid types. This can introduce backwards-incompatible effects (apart from the warning) on code that relies on the current behavior of the functions.

*	**RFC Under Discussion: [Add SameSite cookie attribute parameter](https://wiki.php.net/rfc/same-site-parameter) 💜**

	RFC by George Peter Banyard proposes adding support for SameSite cookies as a function parameter to `setcookie`, `setrawcookie`, and `session_set_cookie_params` functions. While PHP 7.3 and later supports [SameSite cookies](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie/SameSite) when the cookie options are passed as an array, this RFC proposes to add a new parameter that accepts a `SameSite` enum value. The proposed `SameSite` enum contains `Strict`, `Lax`, and `None` members, which are the only accepted values.

*	**RFC Under Discussion: [Add file_descriptor() function](https://wiki.php.net/rfc/file-descriptor-function) 💜**

	RFC by George Peter Banyard proposes a new `file_descriptor()` function that returns the integer file descriptor of a given stream, if the underlying file system supports it.

*	**RFC Declined: [Asymmetric Visibility](https://wiki.php.net/rfc/asymmetric-visibility) 💜**

	PHP’s property visibility modifiers (`public`, `protected`, and `private`) apply to both get and set operations. This RFC by Ilija Tovilo and Larry Garfield proposed a new syntax inspired by Swift to asymmetrically declare the visibility modifiers individually for get and set operations:

	```
	class Foo
    {
        public private(set) string $bar;
    }
    ```
	<br>
	In the snippet above, `public private(set) `indicates that get operations are `public`, while set operations are `private`.

    However, the vote held for this RFC did not pass. A lengthy mailing list discussion on this RFC is available [here](https://externals.io/message/118994).
 
### Notable Mailing List Discussions

* [base64url format](https://externals.io/message/119243)
* [PHP build for the wasm32-wasi target](https://externals.io/message/119198)
* [A set of 18 functions/changes to improve PHP core](https://externals.io/message/119238)
* [PHP support for matrix operations - BLAS, LAPACK](https://externals.io/message/119086)
* [Unicode Text Processing](https://externals.io/message/119149)
* [Deprecate ldap_connect with host and port as separate arguments](https://externals.io/message/119425)
* [Introduce the ability to use the first-call-callable syntax on non-static methods, statically](https://externals.io/message/119392)
* [Loading SQLite extensions on PDO](https://externals.io/message/119374)
* [rules for #include directives](https://externals.io/message/119272)


## Merged PRs and Commits

 - Alex Dowad continued with his series of improvements in mbstring extension optimizations. PHP 8.2 received several impactful performance improvements in mbstring extension too.
 - Tim Düsterhus made several improvements and fixes to the new "random" extension.
 - Max Kellermann made several improvements in making several pointers `const`, along with a new [RFC](https://wiki.php.net/rfc/include_cleanup) to clean up PHP source's header `include` calls.

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes, the PHP core developers review all pull requests.

---

### Full list of commits since [PHP Core Roundup #8](/blog/2022/11/30/php-core-roundup-8/)

<details markdown="1">
  <summary>Click here to expand</summary>

 - Fix incorrect short-circuiting in constant expressions ([#10030](https://bugs.php.net/bug.php?id=10030)) in [683d81e4bd](https://github.com/php/php-src/commit/683d81e4bd) by Ilija Tovilo 💜
 - Fix [GH-9769](https://github.com/php/php-src/issues/9769): Misleading error message for unpacking of objects in [GH-9776](https://github.com/php/php-src/pull/9776) by 蝦米
 - Fix `zend_fcc_equals()` with trampolines ([#10012](https://bugs.php.net/bug.php?id=10012)) in [c4a0fc62a2](https://github.com/php/php-src/commit/c4a0fc62a2) by George Peter Banyard 💜
 - Fix [GH-10011](https://github.com/php/php-src/issues/10011) (Trampoline autoloader will get reregistered and cannot be unregistered) in [GH-10033](https://github.com/php/php-src/pull/10033) by George Peter Banyard 💜
 - Fallback to first line of function when `ex->opline` is NULL ([#10003](https://bugs.php.net/bug.php?id=10003)) in [adc23828b4](https://github.com/php/php-src/commit/adc23828b4) by Arnaud Le Blanc 💜
 - `ext/mysqli` tests "using password" optional in error messages in [GH-10035](https://github.com/php/php-src/pull/10035) by Daniel Black
 - Drop superfluous check for `imap_stream` in [GH-10053](https://github.com/php/php-src/pull/10053) by Christoph M. Becker
 - Fix [#81742](https://bugs.php.net/bug.php?id=81742): open_basedir bypass in SQLite3 by using file URI in [GH-10018](https://github.com/php/php-src/pull/10018) by Christoph M. Becker
 - Replace Azure DevOps link with GitHub Actions in [35a4950ffa](https://github.com/php/php-src/commit/35a4950ffa) by Ben Ramsey
 - Rename `PHP_STREAM_TO_ZVAL` to `PHP_STREAM_FROM_ZVAL` ([#10065](https://bugs.php.net/bug.php?id=10065)) in [11b612af6d](https://github.com/php/php-src/commit/11b612af6d) by Niels
 - `ext/mysqli` tests "using password" optional in error messages (part 2) in [GH-10064](https://github.com/php/php-src/pull/10064) by Daniel Black
 - `standard/basic_functions.c` remove x bit on this file ([#10069](https://bugs.php.net/bug.php?id=10069)) in [faef55d638](https://github.com/php/php-src/commit/faef55d638) by David CARLIER
 - Support Microsoft's "Best Fit" mappings for `Windows-1252` text encoding in [a1a69c3734](https://github.com/php/php-src/commit/a1a69c3734) by Alex Dowad
 - Fix mysqli test wrt. MariaDB in [GH-10029](https://github.com/php/php-src/pull/10029) by Daniel Black
 - Add `Randomizer::getBytesFromString()` method in [GH-9664](https://github.com/php/php-src/pull/9664) by Joshua Rüsweg
 - `intl` extension: `msgfmt_set_pattern` add pattern format error informations in [6422cf6f1a](https://github.com/php/php-src/commit/6422cf6f1a) by David Carlier
 - Avoid code duplication in `php_ini.c` in [GH-4512](https://github.com/php/php-src/pull/4512) by Elan Ruusamäe
 - Fix litespeed SAPI build warnings in [GH-10068](https://github.com/php/php-src/pull/10068) by David Carlier
 - Fix compilation on RHEL 7 ppc64le (gcc 4.8) in [GH-10078](https://github.com/php/php-src/pull/10078) by Mattias Ellert
 - Use fast text conversion filters for `mb_strpos`, `mb_stripos`, `mb_substr`, etc in [0c0774f5b4](https://github.com/php/php-src/commit/0c0774f5b4) by Alex Dowad
 - Optimize SJIS decoder for speed in [b3d197d688](https://github.com/php/php-src/commit/b3d197d688) by Alex Dowad
 - Move MacJapanese implementation into `mbfilter_sjis.c` in [4072a76e3f](https://github.com/php/php-src/commit/4072a76e3f) by Alex Dowad
 - Optimize MacJapanese decoder for speed in [005e49e552](https://github.com/php/php-src/commit/005e49e552) by Alex Dowad
 - Move mobile variants of SJIS into `mbfilter_sjis.c` in [4ebfddfad4](https://github.com/php/php-src/commit/4ebfddfad4) by Alex Dowad
 - Optimize `SJIS-Mobile#DOCOMO` decoder for speed in [43cdfa3190](https://github.com/php/php-src/commit/43cdfa3190) by Alex Dowad
 - Optimize `SJIS-Mobile#KDDI` decoder for speed in [6bf0c44f48](https://github.com/php/php-src/commit/6bf0c44f48) by Alex Dowad
 - Optimize `SJIS-Mobile#SOFTBANK` decoder for speed in [e36c600a31](https://github.com/php/php-src/commit/e36c600a31) by Alex Dowad
 - Add CLEAN section to some IO tests ([#10081](https://bugs.php.net/bug.php?id=10081)) in [3be2b0d0d8](https://github.com/php/php-src/commit/3be2b0d0d8) by George Peter Banyard 💜
 - Fix borked Windows tests after [3be2b0d0](https://github.com/php/php-src/commit/3be2b0d0d83702db409bfcc3fbb4a176d565932d) in [fa3bbf078a](https://github.com/php/php-src/commit/fa3bbf078a) by George Peter Banyard 💜
 - `intl` extension, follow up on [#10006](https://bugs.php.net/bug.php?id=10006) for numfmt_set_pattern in [GH-10073](https://github.com/php/php-src/pull/10073) by David Carlier
 - Change if (stack) check to an assertion ([#10090](https://bugs.php.net/bug.php?id=10090)) in [3ab18d4d14](https://github.com/php/php-src/commit/3ab18d4d14) by Niels
 - Fix [GH-9949](https://github.com/php/php-src/issues/9949): Partial content on incomplete POST request in [GH-10059](https://github.com/php/php-src/pull/10059) by Christoph M. Becker
 - Fix Windows `shmget()` wrt. `IPC_PRIVATE` in [GH-9946](https://github.com/php/php-src/pull/9946) by Tyson Andre
 - `shmget()` with IPC_CREAT must not create 0 size SHM in [4631e9de2b](https://github.com/php/php-src/commit/4631e9de2b) by Christoph M. Becker
 - Add a new `imap_is_open()` function to check that a connection object is still valid in [52a891aeaa](https://github.com/php/php-src/commit/52a891aeaa) by George Peter Banyard 💜
 - Add `Randomizer::nextFloat()` and `Randomizer::getFloat()` in [GH-9679](https://github.com/php/php-src/pull/9679) by Tim Düsterhus
 - Implement `mb_substr_count` using fast text conversion filters in [b9cd1cdb4f](https://github.com/php/php-src/commit/b9cd1cdb4f) by Alex Dowad
 - Replace another root XML element format to the "canonical" one in [60cf9fbee0](https://github.com/php/php-src/commit/60cf9fbee0) by Máté Kocsis 💜
 - Remove the superfluous closing parentheses from class synopsis page includes in [b4df038cee](https://github.com/php/php-src/commit/b4df038cee) by Máté Kocsis 💜
 - Always include the constructor on the class manual pages in [0fc60fab72](https://github.com/php/php-src/commit/0fc60fab72) by Máté Kocsis 💜
 - Backport methodsynopsis role attributes changes from master in [6aa5e58414](https://github.com/php/php-src/commit/6aa5e58414) by Máté Kocsis 💜
 - Fix [GH-10112](https://github.com/php/php-src/issues/10112): `LDAP\Connection::__construct()` refers to `ldap_create()` in [GH-10115](https://github.com/php/php-src/pull/10115) by Christoph M. Becker
 - Only include the default constructor for non-abstract class synopses in [d832125b8e](https://github.com/php/php-src/commit/d832125b8e) by Máté Kocsis 💜
 - Limit stack size in [GH-9104](https://github.com/php/php-src/pull/9104) by Arnaud Le Blanc 💜
 - Optimize JMP[N]Z_EX to BOOL instead of QM_ASSIGN ([#10108](https://bugs.php.net/bug.php?id=10108)) in [6d9d2eb355](https://github.com/php/php-src/commit/6d9d2eb355) by Ilija Tovilo 💜
 - Remove unnecessary check of p in `phpdbg_trim` ([#10122](https://bugs.php.net/bug.php?id=10122)) in [e288438373](https://github.com/php/php-src/commit/e288438373) by Niels
 - Speed boost for `mb_stripos` (when not using UTF-8) in [744ca16e73](https://github.com/php/php-src/commit/744ca16e73) by Alex Dowad
 - `mb_str{i,}pos` does not match illegal byte sequences against occurrences of `mb_substitute_char` in [GH-9613](https://github.com/php/php-src/pull/9613) by Alex Dowad
 - Fix [#81740](https://bugs.php.net/bug.php?id=81740): `PDO::quote()` may return unquoted string in [921b6813da](https://github.com/php/php-src/commit/921b6813da) by Christoph M. Becker
 - Make build work with newer OpenSSL in [5f90134bb6](https://github.com/php/php-src/commit/5f90134bb6) by Stanislav Malyshev
 - Improve fix for bug [#81740](https://bugs.php.net/bug.php?id=81740) in [a6a80eefe0](https://github.com/php/php-src/commit/a6a80eefe0) by Stanislav Malyshev
 - Fix memory leak in [683285165e](https://github.com/php/php-src/commit/683285165e) by Dmitry Stogov
 - `mbstring`: Do not stop when mbstring test failed in [e0e587cdb8](https://github.com/php/php-src/commit/e0e587cdb8) by Yuya Hamada
 - Skip newly added test on 32bit platforms in [cf5dac07d2](https://github.com/php/php-src/commit/cf5dac07d2) by Christoph M. Becker
 - Force extension loading for new test in [da5cbca23e](https://github.com/php/php-src/commit/da5cbca23e) by Christoph M. Becker
 - Skip tests under MSAN in [cf77762970](https://github.com/php/php-src/commit/cf77762970) by Arnaud Le Blanc 💜
 - Fix [GH-9891](https://github.com/php/php-src/issues/9891): DateTime modify with unixtimestamp (@) must work like setTimestamp in [d19a70c9a0](https://github.com/php/php-src/commit/d19a70c9a0) by Derick Rethans 💜
 - Fix [#10133](https://bugs.php.net/bug.php?id=10133) set variables_order en ensure `$ENV` is set in [bfa56cf62b](https://github.com/php/php-src/commit/bfa56cf62b) by Remi Collet
 - Fix bug [#77106](https://bugs.php.net/bug.php?id=77106): Missing separator in FPM FastCGI errors in [891b58d503](https://github.com/php/php-src/commit/891b58d503) by Jakub Zelenka 💜
 - `ext/opcache/jit/zend_jit`: fix inverted bailout value in `zend_runtime_jit()` ([#10144](https://bugs.php.net/bug.php?id=10144)) in [d3a6eedf4a](https://github.com/php/php-src/commit/d3a6eedf4a) by Max Kellermann
 - Cleanup redundant lookups in `phar_object.c` ([#10150](https://bugs.php.net/bug.php?id=10150)) in [7b2c3c11b2](https://github.com/php/php-src/commit/7b2c3c11b2) by Niels
 - Initialize `ping_auto_globals_mask` to prevent undefined behaviour in [GH-10121](https://github.com/php/php-src/pull/10121) by Niels Dossche
 - Remove `_zend_ast_decl->lex_pos` ([#10046](https://bugs.php.net/bug.php?id=10046)) in [23fe58c3a8](https://github.com/php/php-src/commit/23fe58c3a8) by Niels
 - cli server addressing few todos in [GH-10124](https://github.com/php/php-src/pull/10124) by David Carlier
 - sockets adding `TCP_QUICKACK` constant in [GH-10145](https://github.com/php/php-src/pull/10145) by David Carlier
 - Add a regression test for `auto_globals_jit=0` with preloading on in [bbad29b9c1](https://github.com/php/php-src/commit/bbad29b9c1) by Niels Dossche
 - Fix undefined behaviour in `phpdbg_load_module_or_extension` in [GH-10157](https://github.com/php/php-src/pull/10157) by Niels Dossche
 - Update test for changed behaviour of GMP constructor in [a24659e70c](https://github.com/php/php-src/commit/a24659e70c) by Niels Dossche
 - Fix [GH-10072](https://github.com/php/php-src/issues/10072): PHP crashes when execute_ex is overridden and a __call trampoline is used from internal code in [233ffccc35](https://github.com/php/php-src/commit/233ffccc35) by Derick Rethans 💜
 - Make sure to disable JIT when overriding `execute_ex` in [b489e0f2b8](https://github.com/php/php-src/commit/b489e0f2b8) by Derick Rethans 💜
 - Add secondary test that registers a trampoline as a shutdown function in [44add3c791](https://github.com/php/php-src/commit/44add3c791) by George Peter Banyard 💜
 - Fix [GH-9981](https://github.com/php/php-src/issues/9981): FPM does not reset `fastcgi.error_header` in [a3891d9d1a](https://github.com/php/php-src/commit/a3891d9d1a) by Jakub Zelenka 💜
 - Fix memory leak because of incorrect optimization in [0464524292](https://github.com/php/php-src/commit/0464524292) by Dmitry Stogov
 - Fix bug [#68591](https://bugs.php.net/bug.php?id=68591): Configuration test does not perform UID lookups in [GH-10165](https://github.com/php/php-src/pull/10165) by Jakub Zelenka 💜
 - `ext/opcache/jit`: handle `zend_jit_find_trace()` failures in [b26b758952](https://github.com/php/php-src/commit/b26b758952) by Max Kellermann
 - Use proper `int|float` union type instead of `numeric` ([#10162](https://bugs.php.net/bug.php?id=10162)) in [4cee2c0127](https://github.com/php/php-src/commit/4cee2c0127) by George Peter Banyard 💜
 - Added missed return in [ca5f668f7c](https://github.com/php/php-src/commit/ca5f668f7c) by Dmitry Stogov
 - `ext/opcache/jit/zend_jit_trace`: add missing lock for `EXIT_INVALIDATE` in [e217138b40](https://github.com/php/php-src/commit/e217138b40) by Max Kellermann
 - Allow `h` and `k` flags to be combined for `mb_convert_kana` in [GH-10174](https://github.com/php/php-src/pull/10174) by Alex Dowad
 - Register parameter attributes via stub in `ext/zend_test` ([#10183](https://bugs.php.net/bug.php?id=10183)) in [3e48e52d93](https://github.com/php/php-src/commit/3e48e52d93) by Tim Düsterhus
 - Fix null pointer dereference of param in [3a44c78f14](https://github.com/php/php-src/commit/3a44c78f14) by Niels Dossche
 - Improve `mb_detect_encoding`'s recognition of Turkish text in [f40c3fca88](https://github.com/php/php-src/commit/f40c3fca88) by Alex Dowad
 - Fix memory leak in `posix_ttyname()` in [GH-10190](https://github.com/php/php-src/pull/10190) by George Peter Banyard 💜
 - Fix [GH-10187](https://github.com/php/php-src/issues/10187): Segfault in stripslashes() with arm64 in [GH-10188](https://github.com/php/php-src/pull/10188) by Niels Dossche
 - Fix `variation5-win32(-mb).phpt` wrt. parallel test execution in [GH-10189](https://github.com/php/php-src/pull/10189) by Christoph M. Becker
 - Better document constructors in [eebf3bc0ba](https://github.com/php/php-src/commit/eebf3bc0ba) by Máté Kocsis 💜
 - Do not display non-existent constructors in [38e138798d](https://github.com/php/php-src/commit/38e138798d) by Máté Kocsis 💜
 - Do not list private constructors as inherited in [7b08fe9f2d](https://github.com/php/php-src/commit/7b08fe9f2d) by Máté Kocsis 💜
 - Fix [GH-10200](https://github.com/php/php-src/issues/10200): zif_get_object_vars: Assertion `!(((__ht)->u.flags & (1<<2)) != 0)` failed in [GH-10209](https://github.com/php/php-src/pull/10209) by Niels Dossche
 - Fix [GH-10200](https://github.com/php/php-src/issues/10200): zif_get_object_vars: Assertion `!(((__ht)->u.flags & (1<<2)) != 0)` failed in [GH-10209](https://github.com/php/php-src/pull/10209) by Niels Dossche
 - `ext/opcache/zend_shared_alloc`: add assertions on "locked" flag in [e1a25ff2ed](https://github.com/php/php-src/commit/e1a25ff2ed) by Max Kellermann
 - `ext/opcache/zend_shared_alloc`: change "locked" check to assertion in [10d43c40dd](https://github.com/php/php-src/commit/10d43c40dd) by Max Kellermann
 - Fix [GH-10202](https://github.com/php/php-src/issues/10202): `posix_getgr(gid|nam)_basic.phpt` fail in [d5f0362e59](https://github.com/php/php-src/commit/d5f0362e59) by Niels Dossche
 - Implement `mb_output_handler` using fast text conversion filters in [a9a672048b](https://github.com/php/php-src/commit/a9a672048b) by Alex Dowad
 - Implement `mb_str_split` using fast text conversion filters in [88c99afdac](https://github.com/php/php-src/commit/88c99afdac) by Alex Dowad
 - Mark default interned strings as valid UTF-8 where appropriate in [e2654a532a](https://github.com/php/php-src/commit/e2654a532a) by Alex Dowad
 - Implement `php_mb_zend_encoding_converter` using fast text conversion filters in [953864661a](https://github.com/php/php-src/commit/953864661a) by Alex Dowad
 - Implement `mb_detect_encoding` using fast text conversion filters in [0e7160b836](https://github.com/php/php-src/commit/0e7160b836) by Alex Dowad
 - Use `smart_str` in `mb_http_input` rather than `mbfl_memory_device` in [3b5072f6f6](https://github.com/php/php-src/commit/3b5072f6f6) by Alex Dowad
 - Revert "Make build work with newer OpenSSL" in [255e08ac56](https://github.com/php/php-src/commit/255e08ac56) by Gabriel Caruso
 - `Zend/zend_ini_scanner`: `zend_ini_scanner_get_filename()` returns const string in [5e9b335e24](https://github.com/php/php-src/commit/5e9b335e24) by Max Kellermann
 - `Zend/zend_ini_scanner`: parse const strings in [2d662f325d](https://github.com/php/php-src/commit/2d662f325d) by Max Kellermann
 - `main/SAPI`: make "ini_entries" a const string in [d53ad4b566](https://github.com/php/php-src/commit/d53ad4b566) by Max Kellermann
 - `Zend/zend_operators`: make several pointers const in [a8eb399ca3](https://github.com/php/php-src/commit/a8eb399ca3) by Max Kellermann
 - `Zend/zend_API`: make several pointers const in [f5149535e8](https://github.com/php/php-src/commit/f5149535e8) by Max Kellermann
 - `Zend/zend_smart_str`: make several pointers const in [00a918f0cc](https://github.com/php/php-src/commit/00a918f0cc) by Max Kellermann
 - `Zend/zend_execute`: make several pointers const in [0caef56ed6](https://github.com/php/php-src/commit/0caef56ed6) by Max Kellermann
 - `Zend/zend_object_handlers`: make several pointers const in [d48c5372ab](https://github.com/php/php-src/commit/d48c5372ab) by Max Kellermann
 - `Zend/Optimizer/zend_inference`: make several pointers const in [efd5ecb0f2](https://github.com/php/php-src/commit/efd5ecb0f2) by Max Kellermann
 - `Zend/Optimizer/zend_ssa`: make pointer const in [5ea9a7e219](https://github.com/php/php-src/commit/5ea9a7e219) by Max Kellermann
 - Enforce literals in certain macros ([#10111](https://bugs.php.net/bug.php?id=10111)) in [0f4d37d040](https://github.com/php/php-src/commit/0f4d37d040) by Levi Morrison
 - Simplify code for conversion of UHC to Unicode in [ef114f94b9](https://github.com/php/php-src/commit/ef114f94b9) by Alex Dowad
 - Combine uhc1_ucs_table and `uhc2_ucs_table` for UHC/EUC-KR/ISO-2022-KR conversion in [74319de2f9](https://github.com/php/php-src/commit/74319de2f9) by Alex Dowad
 - Remove redundant bounds check for lookup in BIG5 conversion table in [b15d0a9ba5](https://github.com/php/php-src/commit/b15d0a9ba5) by Alex Dowad
 - Manually handle int ZPP for `posix_isatty()`/`posix_ttyname()` in [54767b1047](https://github.com/php/php-src/commit/54767b1047) by George Peter Banyard 💜
 - Check that int file descriptor is valid for `posix_(isatty|ttyname)` in [31e7d6ef05](https://github.com/php/php-src/commit/31e7d6ef05) by George Peter Banyard 💜
 - Optimize conversion of CP936 to Unicode in [703725e43b](https://github.com/php/php-src/commit/703725e43b) by Alex Dowad
 - Optimize conversion of GB18030 to Unicode in [ffbddc4848](https://github.com/php/php-src/commit/ffbddc4848) by Alex Dowad
 - Optimize out bounds check in UHC decoder in [a76658b329](https://github.com/php/php-src/commit/a76658b329) by Alex Dowad
 - Optimize another check out of hot path for UHC decoding in [e837a8800b](https://github.com/php/php-src/commit/e837a8800b) by Alex Dowad
 - Optimize out another bounds check in BIG5 decoder in [9c283850fb](https://github.com/php/php-src/commit/9c283850fb) by Alex Dowad
 - Optimize out checks in hot path for SJIS decoding in [d75c78b0c8](https://github.com/php/php-src/commit/d75c78b0c8) by Alex Dowad
 - Optimize out more checks from hot path for BIG5 decoding in [204694cc71](https://github.com/php/php-src/commit/204694cc71) by Alex Dowad
 - Correct entry for `0x80`,`0xFD-FF` in SJIS multi-byte character length table in [d104481af8](https://github.com/php/php-src/commit/d104481af8) by Alex Dowad
 - Add missing `EXTENSIONS` section to test file gh10200 in [de633c31dd](https://github.com/php/php-src/commit/de633c31dd) by George Peter Banyard 💜
 - Close [GH-10217](https://github.com/php/php-src/issues/10217): Use strlen() for determining the class_name length in [GH-10231](https://github.com/php/php-src/pull/10231) by Dennis Buteyn
 - chore: remove semicolon left over in [GH-10236](https://github.com/php/php-src/pull/10236) by Marcos Marcolin
 - Use different `mblen_table` for different SJIS variants in [3152b7b26f](https://github.com/php/php-src/commit/3152b7b26f) by Alex Dowad
 - posix adding `posix_pathconf` in [GH-10238](https://github.com/php/php-src/pull/10238) by David Carlier
 - follow-up on [GH-10238](https://github.com/php/php-src/issues/10238). ([#10243](https://bugs.php.net/bug.php?id=10243)) in [84af629e7e](https://github.com/php/php-src/commit/84af629e7e) by David CARLIER
 - Move test for [GH-10200](https://github.com/php/php-src/issues/10200) to the simplexml extension test directory in [GH-10252](https://github.com/php/php-src/pull/10252) by Niels Dossche
 - random: Fix check before closing `random_fd` ([#10247](https://bugs.php.net/bug.php?id=10247)) in [32f503e4e3](https://github.com/php/php-src/commit/32f503e4e3) by Tim Düsterhus
 - Remove unnecessary NULL-checks on ctx ([#10256](https://bugs.php.net/bug.php?id=10256)) in [58d741c042](https://github.com/php/php-src/commit/58d741c042) by Niels
 - Remove 'fast path' using mblen_table from `mb_get_strlen` (it's actually a slow path) in [cca4ca6d3d](https://github.com/php/php-src/commit/cca4ca6d3d) by Alex Dowad
 - Add unit tests for `mb_str_split`/`mb_substr` on MacJapanese encoding in [d8b5b9fa55](https://github.com/php/php-src/commit/d8b5b9fa55) by Alex Dowad
 - Optimize branch structure of UTF-8 decoder routine in [092ad3e462](https://github.com/php/php-src/commit/092ad3e462) by Alex Dowad
 - Fix [GH-9710](https://github.com/php/php-src/issues/9710): phpdbg memory leaks by option "-h" in [GH-10237](https://github.com/php/php-src/pull/10237) by Niels Dossche
 - Fix [GH-10251](https://github.com/php/php-src/issues/10251): Assertion `(flag & (1<<3)) == 0` failed in [GH-10254](https://github.com/php/php-src/pull/10254) by Niels Dossche
 - Fix recently introduced `gh10251.phpt` in [6faeb9571d](https://github.com/php/php-src/commit/6faeb9571d) by Christoph M. Becker
 - Add fast SSE2-based implementation of `mb_strlen` for known-valid UTF-8 strings in [b4cbaabd9b](https://github.com/php/php-src/commit/b4cbaabd9b) by Alex Dowad
 - `ext/opcache/jit/zend_jit_trace`: fix memory leak in `_compile_root_trace()` ([#10146](https://bugs.php.net/bug.php?id=10146)) in [bcc5d268f6](https://github.com/php/php-src/commit/bcc5d268f6) by Max Kellermann
 - Fix incorrect optimization of ASSIGN_OP may lead to incorrect result (sub assign -> pre dec conversion for null values) in [4d4a53beee](https://github.com/php/php-src/commit/4d4a53beee) by Dmitry Stogov
 - Adapt `ext/intl` tests for ICU 72.1 in [a9e7b90cc2](https://github.com/php/php-src/commit/a9e7b90cc2) by Christoph M. Becker
 - random: `Randomizer::getFloat()`: Fix check for empty open intervals ([#10185](https://bugs.php.net/bug.php?id=10185)) in [13b82eef84](https://github.com/php/php-src/commit/13b82eef84) by Tim Düsterhus
 - `posix_pathconf` throwing `ValueError` on empty path in [61cf7d49ab](https://github.com/php/php-src/commit/61cf7d49ab) by David Carlier
 - Fixed [GH-10218](https://github.com/php/php-src/issues/10218): DateTimeZone fails to parse time zones that contain the "+" character in [d12ba111e0](https://github.com/php/php-src/commit/d12ba111e0) by Derick Rethans 💜
 - fix: indirect_return compilation warning in [GH-10274](https://github.com/php/php-src/pull/10274) by Kévin Dunglas
 - random: Rely on `free(NULL)` being safe for random status freeing ([#10246](https://bugs.php.net/bug.php?id=10246)) in [e7c0f4e816](https://github.com/php/php-src/commit/e7c0f4e816) by Tim Düsterhus
 - Mark UTF-8 strings emitted by mbstring functions as valid UTF-8 in [4427b2e1ab](https://github.com/php/php-src/commit/4427b2e1ab) by Alex Dowad
 - Fix ASAN reported leak in FPM config test in [GH-10296](https://github.com/php/php-src/pull/10296) by Jakub Zelenka 💜
 - `ext/opcache`: C++ compatibility in [b47bfd698d](https://github.com/php/php-src/commit/b47bfd698d) by Max Kellermann
 - `ext/opcache/zend_shared_alloc`: rename _register_xlat_entry() params in [24b311bdd7](https://github.com/php/php-src/commit/24b311bdd7) by Max Kellermann
 - Implement Unicode conditional casing rules for Greek letter sigma in [GH-8096](https://github.com/php/php-src/pull/8096) by Alex Dowad
 - Adjust code which checks if encoding is ISO-8859-9 when converting case in [290efe842d](https://github.com/php/php-src/commit/290efe842d) by Alex Dowad
 - Implement conditional casing for Greek letter sigma when title-casing text in [a90358639d](https://github.com/php/php-src/commit/a90358639d) by Alex Dowad
 - Use absolute paths in OPCache tests when calling `opcache_compile_file()` in [GH-10266](https://github.com/php/php-src/pull/10266) by Thomas Gerbet
 - unserialize: Strictly check for `:{` at object start ([#10214](https://bugs.php.net/bug.php?id=10214)) in [f2e8c5da90](https://github.com/php/php-src/commit/f2e8c5da90) by Tim Düsterhus
 - Stop using the deprecated `set-output` command in `nightly_matrix.php` ([#10302](https://bugs.php.net/bug.php?id=10302)) in [71bdcce9f8](https://github.com/php/php-src/commit/71bdcce9f8) by Tim Düsterhus
 - Fix [GH-10249](https://github.com/php/php-src/issues/10249): Assertion `size >= page_size + 1 * page_size' failed in [GH-10284](https://github.com/php/php-src/pull/10284) by Niels Dossche
 - posix adding `posix_fpathconf` in [55d19eee49](https://github.com/php/php-src/commit/55d19eee49) by David Carlier
 - socket DF flag on UDP socket via IP_MTU_DISCOVER on Linux and IP_DONTFRAGMENT on FreeBSD for path MTU discovery purpose in [9198e8894b](https://github.com/php/php-src/commit/9198e8894b) by David Carlier
 - Fix comment for `php_safe_bcmp` ([#10306](https://bugs.php.net/bug.php?id=10306)) in [fd7214436a](https://github.com/php/php-src/commit/fd7214436a) by Tim Düsterhus
 - `ext/opcache`: use C11 atomics for "restart_in" ([#10276](https://bugs.php.net/bug.php?id=10276)) in [061fcdb0a5](https://github.com/php/php-src/commit/061fcdb0a5) by Max Kellermann
 - Fix bug [#67244](https://bugs.php.net/bug.php?id=67244): Wrong owner:group for listening unix socket in [120aafcc42](https://github.com/php/php-src/commit/120aafcc42) by Jakub Zelenka 💜
 - GC fiber unfinished executions in [GH-9810](https://github.com/php/php-src/pull/9810) by Arnaud Le Blanc 💜
 - Reduce HT_MAX_SIZE to account for the max load factor of 0.5 ([#10242](https://bugs.php.net/bug.php?id=10242)) in [0f7625c47c](https://github.com/php/php-src/commit/0f7625c47c) by Arnaud Le Blanc 💜
 - `build/php.m4`: remove test for integer types ([#10304](https://bugs.php.net/bug.php?id=10304)) in [7473b86f10](https://github.com/php/php-src/commit/7473b86f10) by Max Kellermann
 - `zend_hash_check_size`: allow nSize <= HT_MAX_SIZE ([#10244](https://bugs.php.net/bug.php?id=10244)) in [2b1907786c](https://github.com/php/php-src/commit/2b1907786c) by Arnaud Le Blanc 💜
 - Fix `run-tests.php` hanging when a worker process dies without notice in [GH-9931](https://github.com/php/php-src/pull/9931) by Arnaud Le Blanc 💜
 - intl extension couple of micro optimisations for error edge cases. ([#10044](https://bugs.php.net/bug.php?id=10044)) in [690db97c6d](https://github.com/php/php-src/commit/690db97c6d) by David CARLIER
 - Make array_pad's $length warning less confusing ([#10149](https://bugs.php.net/bug.php?id=10149)) in [6ab503814d](https://github.com/php/php-src/commit/6ab503814d) by Niels
 - Fix typo in `HAVE_` macro ([#10310](https://bugs.php.net/bug.php?id=10310)) in [a493da7b9d](https://github.com/php/php-src/commit/a493da7b9d) by Arnaud Le Blanc 💜
 - Fix missing comment in FPM `www.conf` in [7d98e3e40c](https://github.com/php/php-src/commit/7d98e3e40c) by Jakub Zelenka 💜
 - Remove useless check, `search_str` is always true here ([#10322](https://bugs.php.net/bug.php?id=10322)) in [e951202a69](https://github.com/php/php-src/commit/e951202a69) by Niels
 - Mark constant static arrays in function bodies actually as const ([#10325](https://bugs.php.net/bug.php?id=10325)) in [a60c6ee0ac](https://github.com/php/php-src/commit/a60c6ee0ac) by Niels Dossche
 - Fix substr_replace with slots in repl_ht being UNDEF in [GH-10323](https://github.com/php/php-src/pull/10323) by Niels Dossche
 - Fix missing check for `xmlTextWriterEndElement` in [GH-10324](https://github.com/php/php-src/pull/10324) by Niels Dossche
 - Fix wrong flags check for compression method in `phar_object.c` in [GH-10328](https://github.com/php/php-src/pull/10328) by Niels Dossche
 - Move `http_build_query()` tests to the HTTP test folder in [c177ea91d4](https://github.com/php/php-src/commit/c177ea91d4) by George Peter Banyard 💜
 - Add more tests for `http_build_query()` in [ec7c7a7550](https://github.com/php/php-src/commit/ec7c7a7550) by George Peter Banyard 💜
 - Handle floats directly in `http_build_query()` in [7d33a30b40](https://github.com/php/php-src/commit/7d33a30b40) by George Peter Banyard 💜
 - Extract scalar url encoding into its own function in [20a6638e22](https://github.com/php/php-src/commit/20a6638e22) by George Peter Banyard 💜
 - Introduce new INI API to get `zend_string*` value for an INI setting in [098a43dbd0](https://github.com/php/php-src/commit/098a43dbd0) by George Peter Banyard 💜
 - Use a zend_string* for `arg_sep` in `php_url_encode_hash_ex()` in [76eaff080a](https://github.com/php/php-src/commit/76eaff080a) by George Peter Banyard 💜
 - Use `zend_string*` instead of `char*` and `size_t` pair for `key_prefix` in [c9b8d1bfaa](https://github.com/php/php-src/commit/c9b8d1bfaa) by George Peter Banyard 💜
 - Drop `key_suffix` parameter in `php_url_encode_hash_ex()` in [540e5104df](https://github.com/php/php-src/commit/540e5104df) by George Peter Banyard 💜
 - Update `UPGRADING.INTERNALS` with the changes made to `php_url_encode_hash_ex()` in [334ecbed5e](https://github.com/php/php-src/commit/334ecbed5e) by George Peter Banyard 💜
 - Fix [GH-10271](https://github.com/php/php-src/issues/10271): Incorrect arithmetic calculations when using JIT in [42eed7bb4e](https://github.com/php/php-src/commit/42eed7bb4e) by Dmitry Stogov
 - Remove dead cleanup code ([#10333](https://bugs.php.net/bug.php?id=10333)) in [9006f06a84](https://github.com/php/php-src/commit/9006f06a84) by Niels Dossche
 - Remove `main()` from mysqli warning ([#10321](https://bugs.php.net/bug.php?id=10321)) in [38dfd20526](https://github.com/php/php-src/commit/38dfd20526) by Kamil Tekiela
 - `MYSQL_ATTR_USE_BUFFERED_QUERY` is a bool attribute ([#10320](https://bugs.php.net/bug.php?id=10320)) in [da550e7762](https://github.com/php/php-src/commit/da550e7762) by Kamil Tekiela
 - Add some const qualifiers and better return types to `zend_object_handlers.h` ([#10330](https://bugs.php.net/bug.php?id=10330)) in [6556601b45](https://github.com/php/php-src/commit/6556601b45) by George Peter Banyard 💜
 - Fix [GH-9675](https://github.com/php/php-src/issues/9675): Re-adjust run_time_cache init for internal enum methods in [GH-10143](https://github.com/php/php-src/pull/10143) by Petar Obradović
 - Fix incorrect comparison in block optimization pass in [dfe9c2af19](https://github.com/php/php-src/commit/dfe9c2af19) by Niels Dossche
 - Add accelerated (SIMD-based) implementation of mb_check_encoding for UTF-8 in [3ae4779305](https://github.com/php/php-src/commit/3ae4779305) by Alex Dowad
 - Tweaks for accelerated implementation of mb_strlen for UTF-8 in [b189aaacc2](https://github.com/php/php-src/commit/b189aaacc2) by Alex Dowad
 - Add regression test for [e560592a](https://github.com/php/php-src/commit/e560592a61c01b8a5df5256ac18361803fae252e) in [a6a20c9e17](https://github.com/php/php-src/commit/a6a20c9e17) by Bob Weinand
 - Remove `mysqlnd_shutdown()` ([#10355](https://bugs.php.net/bug.php?id=10355)) in [0e5128c256](https://github.com/php/php-src/commit/0e5128c256) by Kamil Tekiela
 - Fix phpdbg segmentation fault in case of malformed input in [GH-10353](https://github.com/php/php-src/pull/10353) by Niels Dossche
 - Handle exceptions from `__toString` in XXH3's initialization in [GH-10352](https://github.com/php/php-src/pull/10352) by Niels Dossche
 - Remove useless `php_stream_tell()` call in [GH-10365](https://github.com/php/php-src/pull/10365) by Niels Dossche
 - Fix UNEXPECTED() paren mistakes in [GH-10364](https://github.com/php/php-src/pull/10364) by Niels Dossche
 - Remove `pcre_get_compiled_regex_ex()` ([#10354](https://bugs.php.net/bug.php?id=10354)) in [fa1e3f9798](https://github.com/php/php-src/commit/fa1e3f9798) by Kamil Tekiela
 - Simplify check (in `mb_fast_check_utf8`) for seeing if 16 bytes are all ASCII characters in [d58f70455b](https://github.com/php/php-src/commit/d58f70455b) by Alex Dowad
 - Simplify checks (in `mb_fast_check_utf8`) for overlong code units and invalid codepoint values in [8902e47f3d](https://github.com/php/php-src/commit/8902e47f3d) by Alex Dowad
 - Fix incorrect check condition in `ZEND_YIELD` in [GH-10332](https://github.com/php/php-src/pull/10332) by Niels Dossche
 - Remove `php_pdo_mysql_sqlstate.h` in [GH-10363](https://github.com/php/php-src/pull/10363) by Marcos Marcolin
 - Fix incorrect UNEXPECTED paren placement in `zend_gc.c` in [GH-10371](https://github.com/php/php-src/pull/10371) by Niels Dossche
 - Fix incorrect compilation of FE_FETCH with predicted empty array in [7d68f9128e](https://github.com/php/php-src/commit/7d68f9128e) by Dmitry Stogov
 - mb_detect_encoding is more accurate on strings with UTF-8/16 BOM in [cb840799b4](https://github.com/php/php-src/commit/cb840799b4) by Alex Dowad
 - Customize the link of some constants in the manual in [148ac364e9](https://github.com/php/php-src/commit/148ac364e9) by Máté Kocsis 💜
 - Fix bug 69168: DomNode::getNodePath() returns invalid path in [GH-10318](https://github.com/php/php-src/pull/10318) by Niels Dossche
 - Implement GMP::__construct() in [GH-10225](https://github.com/php/php-src/pull/10225) by Niels Dossche
 - Fix incorrect trace type inference when function SSA is not available in [298aa74b16](https://github.com/php/php-src/commit/298aa74b16) by Dmitry Stogov
 - Revert "`ext/opcache`: use C11 atomics for "restart_in" ([#10276](https://bugs.php.net/bug.php?id=10276))" ([#10339](https://bugs.php.net/bug.php?id=10339)) in [bff7a56d00](https://github.com/php/php-src/commit/bff7a56d00) by Max Kellermann
 - Sync with timelib 2021.19 in [ce877da23b](https://github.com/php/php-src/commit/ce877da23b), [4d8f981818](https://github.com/php/php-src/commit/4d8f981818), and [0df92d218e](https://github.com/php/php-src/commit/0df92d218e) by Derick Rethans 💜
 - Fix [GH-8086](https://github.com/php/php-src/issues/8086): Introduce mail.mixed_lf_and_crlf INI in [cc931af35d](https://github.com/php/php-src/commit/cc931af35d) by Jakub Zelenka 💜
 - Delay debug JIT op_array dump until actual JIT-ing in [6676f5d3cb](https://github.com/php/php-src/commit/6676f5d3cb) by Dmitry Stogov
 - Tweak SSE2-accelerated strtoupper() and strtolower() for speed in [0b7986f976](https://github.com/php/php-src/commit/0b7986f976) by Alex Dowad
 - Fix [GH-10248](https://github.com/php/php-src/issues/10248): Assertion `!(zval_get_type(&(*(property))) == 10)` failed in [0801c567dc](https://github.com/php/php-src/commit/0801c567dc) by Niels Dossche
 - Fix [GH-10292](https://github.com/php/php-src/issues/10292) make the default value of the first parame of srand() and mt_srand() nullable ([#10380](https://bugs.php.net/bug.php?id=10380)) in [1f05d6ef80](https://github.com/php/php-src/commit/1f05d6ef80) by Máté Kocsis 💜
 - Use fast encoding conversion filters in mb_send_mail in [8a73a68190](https://github.com/php/php-src/commit/8a73a68190) by Alex Dowad
 - Use smart_str as dynamic buffer for extra headers in mb_send_mail in [23dab38fe9](https://github.com/php/php-src/commit/23dab38fe9) by Alex Dowad
 - Remove duplicated length check in exif and remove always false condition from exif in [f4dd35ea53](https://github.com/php/php-src/commit/f4dd35ea53) by Niels Dossche
 - mb_scrub does not attempt to scrub known-valid UTF-8 strings in [6f53dbb83e](https://github.com/php/php-src/commit/6f53dbb83e) by Alex Dowad
 - Use RETURN_STR_COPY in mb_output_handler in [4f36623c1e](https://github.com/php/php-src/commit/4f36623c1e) by Alex Dowad
 - Honor constant expressions instead of just taking the last constant encountered in stubs in [1fbe855971](https://github.com/php/php-src/commit/1fbe855971) by Bob Weinand
 - Add a couple clarifying comments in [cf1d21edbd](https://github.com/php/php-src/commit/cf1d21edbd) by Bob Weinand
 - sockets add AF_DIVERT constant in [f8f7fd2db1](https://github.com/php/php-src/commit/f8f7fd2db1) by David Carlier
 - Fix [GH-8329](https://github.com/php/php-src/issues/8329) Print true/false instead of bool in error and debug messages in [GH-8385](https://github.com/php/php-src/pull/8385) by Máté Kocsis 💜
 - strtok warns in case the string to split was not set in [256a34ed15](https://github.com/php/php-src/commit/256a34ed15) by David Carlier
 - exif add simple assert into jpeg header parsing as safety net more in a context of a possible text change. follow-up on [GH-10402](https://github.com/php/php-src/issues/10402) in [1ab5d35bde](https://github.com/php/php-src/commit/1ab5d35bde) by David Carlier
 - Remove unbalanced parentheses in an error message ([#10420](https://bugs.php.net/bug.php?id=10420)) in [670f1aa477](https://github.com/php/php-src/commit/670f1aa477) by Kamil Tekiela
 - Make `stripslashes()` only dependent on SSE2 configuration. ([#10408](https://bugs.php.net/bug.php?id=10408)) in [2b55dee4dc](https://github.com/php/php-src/commit/2b55dee4dc) by Niels Dossche
 - AC_PROG_CC_C99 is obsolete with `autoconf` >= 2.70 ([#10383](https://bugs.php.net/bug.php?id=10383)) in [bf5fdbd3a8](https://github.com/php/php-src/commit/bf5fdbd3a8) by Peter Kokot
 - session: Remove `PS_EXTRA_RAND_BYTES` ([#10394](https://bugs.php.net/bug.php?id=10394)) in [d9c2cf7e3d](https://github.com/php/php-src/commit/d9c2cf7e3d) by Tim Düsterhus
 - Mark globals as const ([#10303](https://bugs.php.net/bug.php?id=10303)) in [d3facbe283](https://github.com/php/php-src/commit/d3facbe283) by Max Kellermann
 - Fix duplicated `FILE` section in test `bug80747.phpt` in [974dba3b80](https://github.com/php/php-src/commit/974dba3b80) by Niels Dossche
 - random: Remove check for `HAVE_DEV_URANDOM` in [2b395f7b6e](https://github.com/php/php-src/commit/2b395f7b6e) by Tim Düsterhus
 - Remove now-unused check for `/dev/urandom` from `Zend/Zend.m4` in [a408781ab4](https://github.com/php/php-src/commit/a408781ab4) by Tim Düsterhus
 - random: Do not trust `arc4random_buf()` on glibc ([#10390](https://bugs.php.net/bug.php?id=10390)) in [57b362b7a9](https://github.com/php/php-src/commit/57b362b7a9) by Tim Düsterhus
 - random: Simplify control flow for handling /dev/urandom errors ([#10392](https://bugs.php.net/bug.php?id=10392)) in [a7998fda8d](https://github.com/php/php-src/commit/a7998fda8d) by Tim Düsterhus
 - password: Use `php_random_bytes_throw` in `php_password_make_salt` ([#10393](https://bugs.php.net/bug.php?id=10393)) in [c59e0750af](https://github.com/php/php-src/commit/c59e0750af) by Tim Düsterhus
 - random netbsd 10 update finally supporting getrandom syscall properly in [948cb4702c](https://github.com/php/php-src/commit/948cb4702c) by David Carlier
 - posix detects `posix_pathconf` api in [GH-10350](https://github.com/php/php-src/pull/10350) by David Carlier
 - random disable `arc4random_buf` for glibc, merge mistake in [2740920a39](https://github.com/php/php-src/commit/2740920a39) by David Carlier
 - Fix incorrect bitshifting and masking in ffi bitfield ([#10403](https://bugs.php.net/bug.php?id=10403)) in [560ca9c7ae](https://github.com/php/php-src/commit/560ca9c7ae) by Niels Dossche
 - Fix incorrect check condition in type inference ([#10425](https://bugs.php.net/bug.php?id=10425)) in [2787e3cd65](https://github.com/php/php-src/commit/2787e3cd65) by Niels Dossche
 - Fix test failures when PHP is compiled without ZEND_CHECK_STACK_LIMIT (e.g. 32-bit CLANG build with address sanitizer) in [68381457cc](https://github.com/php/php-src/commit/68381457cc) by Dmitry Stogov
 - Fix [GH-10292](https://github.com/php/php-src/issues/10292) 1st param of mt_srand() has UNKNOWN default on PHP <8.3 in [GH-10429](https://github.com/php/php-src/pull/10429) by Máté Kocsis 💜
 - Fix [GH-10259](https://github.com/php/php-src/issues/10259) ReflectionClass::getStaticProperties doesn't need null return type ([#10418](https://bugs.php.net/bug.php?id=10418)) in [016160800c](https://github.com/php/php-src/commit/016160800c) by Máté Kocsis 💜
 - Fix incorrect page_size check in [GH-10427](https://github.com/php/php-src/pull/10427) by Niels Dossche
 - Fix incorrect check in `cs_8559_5` in `map_from_unicode()` in [GH-10399](https://github.com/php/php-src/pull/10399) by Niels Dossche
 - Fix incorrect check in `zend_internal_call_should_throw()` in [GH-10417](https://github.com/php/php-src/pull/10417) by Niels Dossche
 - random: Reduce variable scopes in CSPRNG ([#10426](https://bugs.php.net/bug.php?id=10426)) in [6c8ef1d997](https://github.com/php/php-src/commit/6c8ef1d997) by Tim Düsterhus
 - Add missing type guard in [f6fc0fd97b](https://github.com/php/php-src/commit/f6fc0fd97b) by Dmitry Stogov
 - Sync timelib to 2022.05 to address OSS Fuzzer issues in [639bfbc217](https://github.com/php/php-src/commit/639bfbc217) by Derick Rethans 💜
 - GNU compilers remove hot attribute proposal. in [GH-8922](https://github.com/php/php-src/pull/8922) by David CARLIER
 - zend extension build warning fix in [fe9b622e7a](https://github.com/php/php-src/commit/fe9b622e7a) by David Carlier
 - Adjust code to finish validating remaining 0-8 bytes at end of UTF-8 string in [d14ed12783](https://github.com/php/php-src/commit/d14ed12783) by Alex Dowad
 - Add AVX2-accelerated version of `mb_check_encoding` for UTF-8 only in [63c50cc87e](https://github.com/php/php-src/commit/63c50cc87e) by Alex Dowad
 - Implement dynamic class const fetch in [GH-9793](https://github.com/php/php-src/pull/9793) by Ilija Tovilo 💜
 - Add specialized UTF-8 validation function for hosts with no SSE2/AVX2 support in [8f318c383d](https://github.com/php/php-src/commit/8f318c383d) by Alex Dowad
 - random: Fix off-by-one in fast path selection of Randomizer::getBytesFromString() ([#10449](https://bugs.php.net/bug.php?id=10449)) in [64d9080534](https://github.com/php/php-src/commit/64d9080534) by Tim Düsterhus
 - Handle non-INDIRECT symbol table entries in `zend_fiber_object_gc()` ([#10386](https://bugs.php.net/bug.php?id=10386)) in [9830204213](https://github.com/php/php-src/commit/9830204213) by Arnaud Le Blanc 💜
 - Prevent dtor of generator in suspended fiber ([#10462](https://bugs.php.net/bug.php?id=10462)) in [1173c2e64a](https://github.com/php/php-src/commit/1173c2e64a) by Arnaud Le Blanc 💜
 - Fix overflow check in OnUpdateMemoryConsumption ([#10456](https://bugs.php.net/bug.php?id=10456)) in [d7de73b551](https://github.com/php/php-src/commit/d7de73b551) by Niels Dossche
 - Fix missing `zend_shared_alloc_unlock()` ([#10405](https://bugs.php.net/bug.php?id=10405)) in [dc6fbec037](https://github.com/php/php-src/commit/dc6fbec037) by Niels Dossche
 - Add test for [GH-10405](https://github.com/php/php-src/issues/10405) in [306a72add4](https://github.com/php/php-src/commit/306a72add4) by Arnaud Le Blanc 💜
 - Fix [GH-10437](https://github.com/php/php-src/issues/10437): Set active fiber to null on bailout ([#10443](https://bugs.php.net/bug.php?id=10443)) in [284c29328e](https://github.com/php/php-src/commit/284c29328e) by Aaron Piotrowski
 - Fix incorrect check in phar tar parsing in [GH-10464](https://github.com/php/php-src/pull/10464) by Niels Dossche

</details>

---

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 
