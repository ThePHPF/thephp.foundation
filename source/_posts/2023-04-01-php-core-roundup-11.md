---
title: 'PHP Core Roundup #11'
layout: post
tags:
    - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 01 April 2023

---

Welcome to the eleventh post in the PHP Core Roundup series. Just like the [previous months](/blog/tag/roundup), March was an eventful month with new RFCs, discussions, and plenty of other developments in PHP. 

> The PHP Foundation currently supports six part-time PHP contributors who work on maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.

<br>
We publish the posts on our website, and you can subscribe to a newsletter; You don’t necessarily have to be a PHP Foundation backer to follow _PHP Core Roundup_.

{% include "newsletter.html" %}

## Call for PHP 8.3 Release Managers In Voting

In February, Sergey Panteleev — one of the PHP 8.2 release managers — called for the volunteers to put their names forward to be the release managers for the upcoming PHP 8.3. [Four volunteers](https://wiki.php.net/todo/php83) stepped in for the three available positions, and a vote is currently under way.

Pierrick Charron, one of the PHP 8.2 release managers volunteered to be the veteran release manager. Pierrick will be working with two newcomers to this position throughout the lifecycle of PHP 8.3.

For the rookie candidates, Eric Mann, Calvin Buckley, and Jakub Zelenka 💜 expressed their interest, and the [vote](https://wiki.php.net/todo/php83) will elect two release managers from this list of three.

Voting will be open until Apr 16, 2023.

## PHP 8.2.4 and 8.1.17 Bug Fix Releases

PHP 8.2.4 and 8.1.17 are now released, both of which contain over 45 bug fixes (and no security fixes).

PHP 8.0 only receives security updates, so there is no corresponding release for PHP 8.0.

## Recent RFCs and Mailing List Discussions

> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

### RFC Updates

Following are the RFCs and major pull-requests discussed, voted on, and implemented since our last update.

- **RFC Implemented: [Saner array_(sum|product)()](https://wiki.php.net/rfc/saner-array-sum-product) by George Peter Banyard 💜**
  
  Proposed to change the current behavior of `array_sum` and `array_product` to properly handle non-numeric values. This results in additional warnings when these functions encounter unsupported types such as certain objects, arrays, and resources. Further, it can result in different return values on objects that support arithmetic operations. 

  This RFC was accepted, and the changes are now implemented in PHP 8.3.

- **RFC Implemented: [Typed class constants](https://wiki.php.net/rfc/typed_class_constants) by Benas Seliuginas and Máté Kocsis 💜**
  
  Despite the huge efforts put into improving the type system of PHP year after year, it was still not possible to declare constant types. This is less of a concern for global constants, but can indeed be a source of bugs and confusion for class constants: This RFC proposed to add support for declaring class, interface, trait, as well as enum constant types:
  ```php
    enum E {
      const string TEST = "Test1";
    }
 
    trait T {
      const string TEST = E::TEST;
    }
    
    interface I {
      const string TEST = E::TEST;
    }

    class C {
      const string TEST = E::TEST;
    }
  ```
  <br>

  This RFC was accepted, and the changes are now implemented in PHP 8.3.

- **RFC In Voting : [Arbitrary static variable initializers](https://wiki.php.net/rfc/arbitrary_static_variable_initializers) by Ilija Tovilo 💜**
  
  PHP does not allow using arbitrary expressions in static variable initializers because the values are initialized at the compile time. This also lead to some unexpected behaviors when the same variable is initialized in more than once within the same scope.

  This RFC proposes to remove the current limitation of not allowing expressions in static variable initializers. It also forbids redeclaring static variables altogether.

  ```php
   function foo() {
     static $i = getValue();
   }
   ```
   The code snippet will be allowed and functional in PHP 8.3 if the RFC is accepted. The RFC is currently under vote, and the current tally us an unanimous Yes. 

- **RFC Under [Discussion](https://externals.io/message/119745): [Make unserialize() emit a warning for trailing bytes](https://wiki.php.net/rfc/unserialize_warn_on_trailing_data) by Tim Düsterhus**
  
  This RFC proposes that [`unserialize()`](http://www.php.net/unserialize) shall emit a new `E_WARNING` whenever the input string contains additional bytes once the unserialization parser terminates after successfully parsing a value. In other words: A warning shall be emitted if bytes can be removed from the end of the input string without changing the return value of [`unserialize()`](http://www.php.net/unserialize).

- **RFC Under [Discussion](https://externals.io/message/119749): [Define proper semantics for range() function](https://wiki.php.net/rfc/proper-range-semantics) by George Peter Banyard**
  
  This RFC attempts to iron out several undesirable and unexpected behaviors of the `range()` function. Introduced in PHP 4, `range()` function attempts to work with various types not only including integers, floats, and strings, but also other types. There are series of behaviors highlighted in the RFC along with several improvements proposed (throwing exceptions, emitting warnings, changing behaviors, etc).
 
### Notable Mailing List Discussions

- [Property Hooks Discussion](https://externals.io/message/119807)
- [First-class callable partial application](https://externals.io/message/119678)
- [Can we get compile time routines?](https://externals.io/message/119726)
- [RFC: code optimizations](https://externals.io/message/119633)


## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes, the PHP core developers review all pull requests.
 
---

### Full list of commits since [PHP Core Roundup #10](/blog/2023/03/01/php-core-roundup-10/)

<details markdown="1">
  <summary>Click here to expand</summary>

 - Fix unescaped {TMP} variables in tests in [2b5aac9303](https://github.com/php/php-src/commit/2b5aac9303) by Ilija Tovilo 💜
 - Use zend_result in `ext/spl` where appropriate ([#10734](https://bugs.php.net/bug.php?id=10734)) in [2b15061fbb](https://github.com/php/php-src/commit/2b15061fbb) by Niels Dossche
 - Add Windows GitHub actions build in [GH-10664](https://github.com/php/php-src/pull/10664) by Michael Voříšek
 - Fix missing readonly modification error with inc/dec in JIT in [GH-10746](https://github.com/php/php-src/pull/10746) by Ilija Tovilo 💜
 - Make error checks on encoding methods for docomo, kddi, sb consistent in [69543e6a10](https://github.com/php/php-src/commit/69543e6a10) by nielsdos
 - Use `CK()` macro to check the output function in mbfilter_unicode2sjis_emoji_sb() in [263655a520](https://github.com/php/php-src/commit/263655a520) by nielsdos
 - Propagate error checks for `mbfl_filt_conv_illegal_output()` in [d66ca5dabb](https://github.com/php/php-src/commit/d66ca5dabb) by nielsdos
 - Fix warning in run-tests when PHP compiled without generating phpdbg support. ([#10745](https://bugs.php.net/bug.php?id=10745)) in [3e6d49e042](https://github.com/php/php-src/commit/3e6d49e042) by Danack
 - fix: support for timeouts with ZTS on Linux ([#10141](https://bugs.php.net/bug.php?id=10141)) in [ad85e71421](https://github.com/php/php-src/commit/ad85e71421) by Kévin Dunglas
 - Fix operator precedence in the skip section of readonly tests in [dab783f7ae](https://github.com/php/php-src/commit/dab783f7ae) by Máté Kocsis 💜
 - Fix [GH-10728](https://github.com/php/php-src/issues/10728): opcache capstone header's inclusion in [GH-10732](https://github.com/php/php-src/pull/10732) by David Carlier
 - Propagate success status of ftp_close() to userland in [abc6fe8f2e](https://github.com/php/php-src/commit/abc6fe8f2e) by nielsdos
 - Add missing `ZEND_ARG_VARIADIC_OBJ_TYPE_MASK` macro, and use consistent class_name variable name in [7fcea9d260](https://github.com/php/php-src/commit/7fcea9d260) by Derick Rethans 💜
 - Do not allow side-effects when readonly property modification fails ([#10757](https://bugs.php.net/bug.php?id=10757)) in [e053ba0a3a](https://github.com/php/php-src/commit/e053ba0a3a) by Máté Kocsis 💜
 - `ext/ftp` fix ftp_nb_get signature (for failure) in [GH-10760](https://github.com/php/php-src/pull/10760) by David Carlier
 - Revert "Zend/zend_type_code: remove hard-coded integer values and" in [3310463484](https://github.com/php/php-src/commit/3310463484) by David CARLIER
 - random: Convert `php_random_(bytes|int)_(silent|throw)` into inline functions ([#10763](https://bugs.php.net/bug.php?id=10763)) in [8abea1b3c2](https://github.com/php/php-src/commit/8abea1b3c2) by Tim Düsterhus
 - Fix failure of AVX2-accelerated `mb_check_encoding` on 32-bit MS Windows in [86ec0bc55c](https://github.com/php/php-src/commit/86ec0bc55c) by Alex Dowad
 - Fix [GH-10766](https://github.com/php/php-src/issues/10766): PharData archive created with Phar::Zip format does not keep files metadata (datetime) in [GH-10769](https://github.com/php/php-src/pull/10769) by Niels Dossche
 - Fix `strlen` error message param name in [1be99faeff](https://github.com/php/php-src/commit/1be99faeff) by Kamil Tekiela
 - Update windows action to `checkout@v3` in [28ef654648](https://github.com/php/php-src/commit/28ef654648) by Ilija Tovilo 💜
 - Fix metaphone encode compiler warning in [GH-10788](https://github.com/php/php-src/pull/10788) by Ilija Tovilo 💜
 - Ignore `-Warray-bounds` compiler warning in JIT ([#10789](https://bugs.php.net/bug.php?id=10789)) in [ad7b90b674](https://github.com/php/php-src/commit/ad7b90b674) by Ilija Tovilo 💜
 - Fix `-Wmaybe-uninitialized` warning in JIT in [95fbd2039f](https://github.com/php/php-src/commit/95fbd2039f) by Ilija Tovilo 💜
 - Fix gcc warnings in `zend_API.c` with `--disable-debug` ([#10786](https://bugs.php.net/bug.php?id=10786)) in [6a7115359e](https://github.com/php/php-src/commit/6a7115359e) by Ilija Tovilo 💜
 - Add missing error checks on `EVP_MD_CTX_create()` and `EVP_VerifyInit()` in [GH-10762](https://github.com/php/php-src/pull/10762) by Niels Dossche
 - Add missing error check on `i2d_PKCS12_bio()` in [GH-10761](https://github.com/php/php-src/pull/10761) by nielsdos
 - Add missing error check on `PEM_write_bio_CMS()` in [51ea4a680d](https://github.com/php/php-src/commit/51ea4a680d) by nielsdos
 - Add missing error check on `PEM_write_bio_PKCS7()` in [GH-10752](https://github.com/php/php-src/pull/10752) by Niels Dossche
 - Throw on negative setcookie expiration timestamp in [82dfd93b9d](https://github.com/php/php-src/commit/82dfd93b9d) by Ilija Tovilo 💜
 - Fix missing return `FAILURE` in [2110398dee](https://github.com/php/php-src/commit/2110398dee) by Ilija Tovilo 💜
 - Re-add missing `EXPECTHEADERS` sections in [87e3513274](https://github.com/php/php-src/commit/87e3513274) by Ilija Tovilo 💜
 - Fix [GH-10709](https://github.com/php/php-src/issues/10709): UAF in recursive AST evaluation in [GH-10718](https://github.com/php/php-src/pull/10718) by Ilija Tovilo 💜
 - Revert "Throw on negative setcookie expiration timestamp" in [9f591c9bf6](https://github.com/php/php-src/commit/9f591c9bf6) by Ilija Tovilo 💜
 - random: Add missing `php.h` include to `php_random.h` ([#10764](https://bugs.php.net/bug.php?id=10764)) in [5087931963](https://github.com/php/php-src/commit/5087931963) by Tim Düsterhus
 - Fix `-Wstrict-prototypes` in DBA in [648e896d0e](https://github.com/php/php-src/commit/648e896d0e) by George Peter Banyard 💜
 - Remove unnecessary workaround for the true type in [368febbf89](https://github.com/php/php-src/commit/368febbf89) by Máté Kocsis 💜
 - `mb_encode_mimeheader` does not crash if provided encoding has no MIME name set in [7c1ee5a02a](https://github.com/php/php-src/commit/7c1ee5a02a) by Alex Dowad
 - Enable GitHub actions cancel-in-progress for PRs in [GH-10799](https://github.com/php/php-src/pull/10799) by Ilija Tovilo 💜
 - Fix readonly+clone JIT issues in [GH-10748](https://github.com/php/php-src/pull/10748) by Ilija Tovilo 💜
 - `*/*.m4`: `update main()` signatures in [fa65873502](https://github.com/php/php-src/commit/fa65873502) by Michael Orlitzky
 - `ext/iconv/config.m4`: add missing `stdio.h` include in [GH-10751](https://github.com/php/php-src/pull/10751) by Michael Orlitzky
 - RFC: Saner `array_(sum|product)()` ([#10161](https://bugs.php.net/bug.php?id=10161)) in [3b06618813](https://github.com/php/php-src/commit/3b06618813) by George Peter Banyard 💜
 - Imply UTF8 validity in implode function ([#10780](https://bugs.php.net/bug.php?id=10780)) in [3821938e81](https://github.com/php/php-src/commit/3821938e81) by Michael Voříšek
 - Fix [GH-8646](https://github.com/php/php-src/issues/8646): Memory leak PHP FPM 8.1 in [GH-10783](https://github.com/php/php-src/pull/10783) by Niels Dossche
 - Fix [GH-8065](https://github.com/php/php-src/issues/8065): `opcache.c`onsistency_checks > 0 causes segfaults in PHP >= 8.1.5 in fpm context in [GH-10798](https://github.com/php/php-src/pull/10798) by Niels Dossche
 - Re-add some CTE functions that were removed from being CTE by a mistake in [GH-10768](https://github.com/php/php-src/pull/10768) by Michael Voříšek
 - Update libmysql 5.7 version in [12290b796b](https://github.com/php/php-src/commit/12290b796b) by Ilija Tovilo 💜
 - Suppress `-Wstrict-prototypes` in GD extension ([#10803](https://bugs.php.net/bug.php?id=10803)) in [afd8695a22](https://github.com/php/php-src/commit/afd8695a22) by George Peter Banyard 💜
 - Micro optimization: readonly properties always have a type in [574e531127](https://github.com/php/php-src/commit/574e531127) by Máté Kocsis 💜
 - Fixed macro generation for variadics, which don't have a default value in [717335ec63](https://github.com/php/php-src/commit/717335ec63) by Derick Rethans 💜
 - Add test case in [8a9b80cfe0](https://github.com/php/php-src/commit/8a9b80cfe0) by Derick Rethans 💜
 - Fixed strict zpp arginfo test in [f8891f2861](https://github.com/php/php-src/commit/f8891f2861) by Derick Rethans 💜
 - Fixed strict zpp arginfo test in [aead0c8059](https://github.com/php/php-src/commit/aead0c8059) by Derick Rethans 💜
 - Test Windows with opcache on GitHub actions in [6b884737c4](https://github.com/php/php-src/commit/6b884737c4) by Ilija Tovilo 💜
 - `ext/intl`: dateformatter settimezone changes on success, returning true like setcalendar in [GH-10790](https://github.com/php/php-src/pull/10790) by David Carlier
 - Disable asan instrumentation for phpdbg_watchpoint_userfaultfd_thread in [GH-10818](https://github.com/php/php-src/pull/10818) by Ilija Tovilo 💜
 - Switch to Ubuntu 22.04 for GitHub actions jobs in [GH-10814](https://github.com/php/php-src/pull/10814) by Ilija Tovilo 💜
 - Fix `GC_BENCH` flag ([#10823](https://bugs.php.net/bug.php?id=10823)) in [6f1e5ff8c3](https://github.com/php/php-src/commit/6f1e5ff8c3) by Ilija Tovilo 💜
 - Fix [GH-10519](https://github.com/php/php-src/issues/10519): Array Data Address Reference Issue in [GH-10749](https://github.com/php/php-src/pull/10749) by NathanFreeman
 - Fix [GH-10747](https://github.com/php/php-src/issues/10747): Private and protected properties in serialized Date* objects throw in [a225581833](https://github.com/php/php-src/commit/a225581833) by Derick Rethans 💜
 - feat: enable Zend Max Execution Timers by default in 8.3 ([#10778](https://bugs.php.net/bug.php?id=10778)) in [f0495855a3](https://github.com/php/php-src/commit/f0495855a3) by Kévin Dunglas
 - Re-enable `-Wstrict-aliasing` in [GH-10821](https://github.com/php/php-src/pull/10821) by Ilija Tovilo 💜
 - Remove unnecessary type punnign from `mysqli_api.c` in [47f80ffc77](https://github.com/php/php-src/commit/47f80ffc77) by Ilija Tovilo 💜
 - Fix [GH-10801](https://github.com/php/php-src/issues/10801): Named arguments in CTE functions cause a segfault in [GH-10811](https://github.com/php/php-src/pull/10811) by Niels Dossche
 - Fix [GH-10611](https://github.com/php/php-src/issues/10611): fpm_env_init_main leaks environ in [GH-10618](https://github.com/php/php-src/pull/10618) by Niels Dossche
 - Fix RC1 assumption for typed properties with `__get` in [GH-10833](https://github.com/php/php-src/pull/10833) by Ilija Tovilo 💜
 - Fixed oss-fuzz [#56931](https://bugs.php.net/bug.php?id=56931) in [ce5f75fb6f](https://github.com/php/php-src/commit/ce5f75fb6f) by Derick Rethans 💜
 - Fixed test for [GH-10147](https://github.com/php/php-src/issues/10147) in [2d3aa8a5c4](https://github.com/php/php-src/commit/2d3aa8a5c4) by Derick Rethans 💜
 - Fixed new OSS-FUZZ test in [897b13a217](https://github.com/php/php-src/commit/897b13a217) by Derick Rethans 💜
 - Handle `zend_execute_internal` in JIT in [c53e8d3e30](https://github.com/php/php-src/commit/c53e8d3e30) by Bob Weinand
 - Add test, fix x86 JIT in [1015f1ff61](https://github.com/php/php-src/commit/1015f1ff61) by Bob Weinand
 - Fix module shutdown crash during ZTS JIT shutdown in [GH-10835](https://github.com/php/php-src/pull/10835) by Niels Dossche
 - `ext/mysqli/pgsql`: `mysqli_fetch_object`/`pgsql_fetch_object` raises `ValueError` on constructor args error in [GH-10832](https://github.com/php/php-src/pull/10832) by David Carlier
 - avoid test file being consider binary in [f575027b56](https://github.com/php/php-src/commit/f575027b56) by Remi Collet
 - `use_tls=0` on `MSAN` in [GH-10851](https://github.com/php/php-src/pull/10851) by Ilija Tovilo 💜
 - Fix test on non-UTC platforms in [a141543594](https://github.com/php/php-src/commit/a141543594) by Matteo Beccati
 - Fix mysql tests on Cirrus ASAN in [GH-10802](https://github.com/php/php-src/pull/10802) by Ilija Tovilo 💜
 - Move ARM64 build to Cirrus in [GH-10795](https://github.com/php/php-src/pull/10795) by Ilija Tovilo 💜
 - remove assert raising strange behavior with GCC 10 in [bdf2f722ca](https://github.com/php/php-src/commit/bdf2f722ca) by Remi Collet
 - Upgrade cirrus arm build to GCC 12 ([#10855](https://bugs.php.net/bug.php?id=10855)) in [6ebb506637](https://github.com/php/php-src/commit/6ebb506637) by Ilija Tovilo 💜
 - Implement `mb_encode_mimeheader` using fast text conversion filters in [0ce755be26](https://github.com/php/php-src/commit/0ce755be26) by Alex Dowad
 - `php_pgsql_meta_data` raises a `ValueError` when table name is invalid in [394470c052](https://github.com/php/php-src/commit/394470c052) by David Carlier
 - `ext/mysqi`: mysqli_poll raises a ValueError on absent 1st and 2ng arguments in [90a39fd52c](https://github.com/php/php-src/commit/90a39fd52c) by David Carlier
 - Fix missing and inconsistent error check on `SQLAllocHandle` in [GH-10740](https://github.com/php/php-src/pull/10740) by nielsdos
 - Remove CTE flag from `array_diff_ukey()`, which was added by mistake in [GH-10859](https://github.com/php/php-src/pull/10859) by Michael Voříšek
 - Another attempt to fix MSAN nightly on `master` in [471105abd7](https://github.com/php/php-src/commit/471105abd7) by Ilija Tovilo 💜
 - `pgsql_insert` fix unit tests ([#10860](https://bugs.php.net/bug.php?id=10860)) in [feb82d91b9](https://github.com/php/php-src/commit/feb82d91b9) by David CARLIER
 - Windows CI log verbosity, CI bat file guard in [GH-10817](https://github.com/php/php-src/pull/10817) by Michael Voříšek
 - `zend_hash`: Use AVX2 instructions for better code efficiency ([#10858](https://bugs.php.net/bug.php?id=10858)) in [d835de1993](https://github.com/php/php-src/commit/d835de1993) by Tony Su
 - Add extra option to FPM tester for handling script filename in [3125155b5d](https://github.com/php/php-src/commit/3125155b5d) by Jakub Zelenka 💜
 - Test FPM FCGI envs without path info fix for custom source in [92d2cd5cb8](https://github.com/php/php-src/commit/92d2cd5cb8) by Jakub Zelenka 💜
 - Test FPM FCGI envs with path info fix for Apache proxy balancer in [b53b0ac2ea](https://github.com/php/php-src/commit/b53b0ac2ea) by Jakub Zelenka 💜
 - Test FPM FCGI envs with path info fix for Apache proxy handler in [8cf621e0e4](https://github.com/php/php-src/commit/8cf621e0e4) by Jakub Zelenka 💜
 - Test FPM FCGI envs with path info fix for Apache proxy pass in [38d2e7ea9a](https://github.com/php/php-src/commit/38d2e7ea9a) by Jakub Zelenka 💜
 - Fix FPM tester `$scriptName` logic in [7d987ebbbf](https://github.com/php/php-src/commit/7d987ebbbf) by Jakub Zelenka 💜
 - Implement [GH-10854](https://github.com/php/php-src/issues/10854): TSRM should set a smarter value for expected_threads ([#10867](https://bugs.php.net/bug.php?id=10867)) in [4da0da7f2d](https://github.com/php/php-src/commit/4da0da7f2d) by Niels Dossche
 - Fix [GH-10634](https://github.com/php/php-src/issues/10634): Lexing memory corruption ([#10866](https://bugs.php.net/bug.php?id=10866)) in [ac9964502c](https://github.com/php/php-src/commit/ac9964502c) by Niels Dossche
 - Remove `xfail` from tests that do not fail anymore ([#10871](https://bugs.php.net/bug.php?id=10871)) in [53763e14b7](https://github.com/php/php-src/commit/53763e14b7) by Arnaud Le Blanc 💜
 - `ext/psql`: `pg_meta_data`, extended mode, fix typo for pseudo typtype in [GH-10865](https://github.com/php/php-src/pull/10865) by David CARLIER
 - Fix [GH-8789](https://github.com/php/php-src/issues/8789) and [GH-10015](https://github.com/php/php-src/issues/10015): Fix ZTS zend signal crashes due to NULL globals in [GH-10861](https://github.com/php/php-src/pull/10861) by Niels Dossche
 - Destroy `file_handle` in `fpm_main` in [GH-10707](https://github.com/php/php-src/pull/10707) by Niels Dossche
 - Fix `NUL` byte in exception string terminating `Exception::__toString()` in [GH-10873](https://github.com/php/php-src/pull/10873) by Ilija Tovilo 💜
 - Fix bug [#74129](https://bugs.php.net/bug.php?id=74129): Incorrect SCRIPT_NAME with apache ProxyPassMatch in [GH-10869](https://github.com/php/php-src/pull/10869) by Jakub Zelenka 💜
 - Fix [GH-10755](https://github.com/php/php-src/issues/10755): Memory leak in phar_rename_archive() in [GH-10856](https://github.com/php/php-src/pull/10856) by Su, Tao
 - Use new ZSTR_INIT_LITERAL macro ([#10879](https://bugs.php.net/bug.php?id=10879)) in [9d5f2f1343](https://github.com/php/php-src/commit/9d5f2f1343) by Ilija Tovilo 💜
 - Fix [GH-10885](https://github.com/php/php-src/issues/10885): Leaking stream_socket_server context in [GH-10886](https://github.com/php/php-src/pull/10886) by Ilija Tovilo 💜
 - add a basic CODEOWNERS file in [GH-8670](https://github.com/php/php-src/pull/8670) by Ben Ramsey
 - CODEOWNERS: Add myself to `ext/random` in [e73d8de784](https://github.com/php/php-src/commit/e73d8de784) by Tim Düsterhus
 - Fix [GH-10052](https://github.com/php/php-src/issues/10052): Browscap crashes PHP 8.1.12 on request shutdown (apache2) in [GH-10883](https://github.com/php/php-src/pull/10883) by Niels Dossche
 - Fix [GH-10521](https://github.com/php/php-src/issues/10521): ftp_get/ftp_nb_get resumepos offset is maximum 10GB in [GH-10525](https://github.com/php/php-src/pull/10525) by Niels Dossche
 - CODEOWNERS: Add myself as an owner of `ext/ffi`, `ext/opcache` and the core Zend files in [b698108133](https://github.com/php/php-src/commit/b698108133) by Dmitry Stogov
 - Update assertion about unsupported property types in [3deba4c2e8](https://github.com/php/php-src/commit/3deba4c2e8) by Máté Kocsis 💜
 - Add myself for `ext/date` in [b5262218d4](https://github.com/php/php-src/commit/b5262218d4) by Derick Rethans 💜
 - [Zend]: Remove unused code in MAKE_NOP macro ([#10906](https://bugs.php.net/bug.php?id=10906)) in [7eee0d1bc7](https://github.com/php/php-src/commit/7eee0d1bc7) by Tony Su
 - Shrink some commonly used structs by reordering members ([#10880](https://bugs.php.net/bug.php?id=10880)) in [6a6e91f3c7](https://github.com/php/php-src/commit/6a6e91f3c7) by Niels Dossche
 - Implement better diff for `run-tests.php` in [GH-10875](https://github.com/php/php-src/pull/10875) by Ilija Tovilo 💜
 - `ext/curl`: suppress -Wdeprecated-declarations in `curl_arginfo.h` in [2646d76abc](https://github.com/php/php-src/commit/2646d76abc) by Max Kellermann
 - Empty merge in [4c114efd1a](https://github.com/php/php-src/commit/4c114efd1a) by Derick Rethans 💜
 - Updated to version 2023.1 (2023a) in [8424b5caaa](https://github.com/php/php-src/commit/8424b5caaa) by Derick Rethans 💜
 - Empty merge in [6c5e07a8b9](https://github.com/php/php-src/commit/6c5e07a8b9) by Derick Rethans 💜
 - Updated to version 2023.1 (2023a) in [d9e89416f8](https://github.com/php/php-src/commit/d9e89416f8) by Derick Rethans 💜
 - Updated to version 2023.1 (2023a) in [9495406c9e](https://github.com/php/php-src/commit/9495406c9e) by Derick Rethans 💜
 - Fix [GH-10583](https://github.com/php/php-src/issues/10583): DateTime modify with tz pattern should not update linked timezone in [cbac68df6b](https://github.com/php/php-src/commit/cbac68df6b) by Derick Rethans 💜
 - `ext/pdo_sqlite`: simplifying sqlite3_exec usage. ([#10910](https://bugs.php.net/bug.php?id=10910)) in [54f92fc333](https://github.com/php/php-src/commit/54f92fc333) by David CARLIER
 - Fix direct comparison in `run-tests.php` differ in [c58c2666a1](https://github.com/php/php-src/commit/c58c2666a1) by Ilija Tovilo 💜
 - Updated to version 2023.2 (2023b) in [90f5b2b4ff](https://github.com/php/php-src/commit/90f5b2b4ff) by Derick Rethans 💜
 - Empty merge in [a337dfb75f](https://github.com/php/php-src/commit/a337dfb75f) by Derick Rethans 💜
 - Updated to version 2023.2 (2023b) in [8a2586228d](https://github.com/php/php-src/commit/8a2586228d) by Derick Rethans 💜
 - Empty merge in [61a595c883](https://github.com/php/php-src/commit/61a595c883) by Derick Rethans 💜
 - Updated to version 2023.2 (2023b) in [2a553322d8](https://github.com/php/php-src/commit/2a553322d8) by Derick Rethans 💜
 - Add me to the CODEOWNERS in [ff183ad923](https://github.com/php/php-src/commit/ff183ad923) by Jakub Zelenka 💜
 - Fix [GH-8979](https://github.com/php/php-src/issues/8979): Possible Memory Leak with SSL-enabled MySQL connections in [GH-10909](https://github.com/php/php-src/pull/10909) by Niels Dossche
 - Fix [GH-10907](https://github.com/php/php-src/issues/10907): Unable to serialize processed SplFixedArrays in PHP 8.2.4 in [GH-10921](https://github.com/php/php-src/pull/10921) by Niels Dossche
 - Fix test for [GH-10907](https://github.com/php/php-src/issues/10907) with output in different order for master branch in [01cb6fb65a](https://github.com/php/php-src/commit/01cb6fb65a) by Niels Dossche
 - Fix phpGH-10648: add check function pointer into mbfl_encoding in [6fc8d014df](https://github.com/php/php-src/commit/6fc8d014df) by pakutoma
 - Update NEWS and UPGRADING to reflect changes in 0ce755be26 in [bf64342d30](https://github.com/php/php-src/commit/bf64342d30) by Alex Dowad
 - Fix compile errors caused by missing initializers in 0779950768 in [345abce590](https://github.com/php/php-src/commit/345abce590) by Alex Dowad
 - Fix compile error in Windows CI job caused by 0779950768 in [57e194e02d](https://github.com/php/php-src/commit/57e194e02d) by Alex Dowad
 - Fix phpGH-10648: add check function pointer into mbfl_encoding in [b721d0f71e](https://github.com/php/php-src/commit/b721d0f71e) by pakutoma
 - Use capstone explicitly, drop oprofile (GH 10876) ([#10918](https://bugs.php.net/bug.php?id=10918)) in [87922411bf](https://github.com/php/php-src/commit/87922411bf) by Michael Orlitzky
 - By-ref modification of typed and readonly props through ArrayIterator in [GH-10872](https://github.com/php/php-src/pull/10872) by Ilija Tovilo 💜
 - Fix buffer-overflow in `php_fgetcsv()` with \0 delimiter and enclosure in [GH-10923](https://github.com/php/php-src/pull/10923) by Ilija Tovilo 💜
 - Disallow parent dir components (..) in open_basedir() at runtime in [GH-10913](https://github.com/php/php-src/pull/10913) by Ilija Tovilo 💜
 - Disable `--with-valgrind` by default ([#10934](https://bugs.php.net/bug.php?id=10934)) in [5eb6905405](https://github.com/php/php-src/commit/5eb6905405) by Ilija Tovilo 💜
 - Fix [GH-10928](https://github.com/php/php-src/issues/10928): PHP Build Failed - Test curl_version() basic functionality [ext/curl/tests/curl_version_basic_001.phpt] in [GH-10930](https://github.com/php/php-src/pull/10930) by Niels Dossche
 - `ext/pdo_mysql`: mysql_handle_closer nullify some freed data in [f6989df8cc](https://github.com/php/php-src/commit/f6989df8cc) by David CARLIER
 - Fix undefined behaviour in string uppercasing and lowercasing in [GH-10936](https://github.com/php/php-src/pull/10936) by Niels Dossche
 - Fix buffer-overflow in `open_basedir()` in [a7f91e37de](https://github.com/php/php-src/commit/a7f91e37de) by Ilija Tovilo 💜
 - Propagate UTF-8 flag during Rope operations ([#10915](https://bugs.php.net/bug.php?id=10915)) in [d7c351ea54](https://github.com/php/php-src/commit/d7c351ea54) by George Peter Banyard 💜
 - Use `php_random_bytes_silent()` where possible in gmp_init_random() ([#10944](https://bugs.php.net/bug.php?id=10944)) in [8317a147b9](https://github.com/php/php-src/commit/8317a147b9) by Niels Dossche
 - Fix undefined behaviour when writing 32-bit values in phar/tar.c in [GH-10940](https://github.com/php/php-src/pull/10940) by Niels Dossche
 - Fix undefined behaviour in `GENERATE_SEED()` in [GH-10942](https://github.com/php/php-src/pull/10942) by Niels Dossche
 - Improve the warning message for unpack() in case not enough values were provided ([#10949](https://bugs.php.net/bug.php?id=10949)) in [6ec69d727a](https://github.com/php/php-src/commit/6ec69d727a) by Niels Dossche
 - php-fuzz-mbstring also tests text encoding validation functions in [5f2587eb25](https://github.com/php/php-src/commit/5f2587eb25) by Alex Dowad
 - For UTF-7, emit error marker if Base64 section ends abruptly after first half of surrogate pair in [c4fb049bf6](https://github.com/php/php-src/commit/c4fb049bf6) by Alex Dowad
 - Rename `--with-opcache-capstone` to `--with-capstone` ([#10952](https://bugs.php.net/bug.php?id=10952)) in [b73b70f097](https://github.com/php/php-src/commit/b73b70f097) by Ilija Tovilo 💜
 - Unparallelize IO heavy tests in [GH-10953](https://github.com/php/php-src/pull/10953) by Ilija Tovilo 💜
 - Suppress snmp lib memory leak, xfail ASAN tests in [be4db6b550](https://github.com/php/php-src/commit/be4db6b550) by Ilija Tovilo 💜
 - Fix incorrect optimization in [1f5d9534ae](https://github.com/php/php-src/commit/1f5d9534ae) by Dmitry Stogov
 - Fix one more differ direct comparison (through in_array) in [b9f8b696c4](https://github.com/php/php-src/commit/b9f8b696c4) by Ilija Tovilo 💜
 - Fix [GH-10908](https://github.com/php/php-src/issues/10908): Bus error with PDO Firebird on RPI with 64 bit kernel and 32 bit userland in [GH-10920](https://github.com/php/php-src/pull/10920) by Niels Dossche
 - Handle indirect zvals in `SplFixedArray::__serialize` in [GH-10925](https://github.com/php/php-src/pull/10925) by Niels Dossche
 - Revert "Handle indirect zvals in `SplFixedArray::__serialize`" in [0d524eda94](https://github.com/php/php-src/commit/0d524eda94) by Niels Dossche
 - Reset EG(trampoline).op_array.last_var that FFI may modify in [GH-10916](https://github.com/php/php-src/pull/10916) by Ilija Tovilo 💜
 - `ext/posix`: proposing posix_eaccess. unlike access, it is not standard but available in enough platforms ; on linux it's euidaccess in reality eaccess being 'just' an alias. key difference is eaccess checks the effective user id instead in [2b354318d9](https://github.com/php/php-src/commit/2b354318d9) by David CARLIER
 - Fix test for [GH-10908](https://github.com/php/php-src/issues/10908) in [1357d1eb41](https://github.com/php/php-src/commit/1357d1eb41) by Niels Dossche
 - `ext/intl`: breakiterator::setText returns false on failure in [7623bf0b06](https://github.com/php/php-src/commit/7623bf0b06) by David Carlier
 - Note where a session was already started ([#10736](https://bugs.php.net/bug.php?id=10736)) in [180f785404](https://github.com/php/php-src/commit/180f785404) by Calvin Buckley
 - `ext/imap/config.m4`: `-Werror=implicit-function-declaration` compatibility in [GH-10948](https://github.com/php/php-src/pull/10948) by Michael Orlitzky
 - `ext/intl` IntlChar::enumCharNames changes the signature to void in [2da299703a](https://github.com/php/php-src/commit/2da299703a) by David CARLIER
 - Fix undefined behaviour in unpack() in [GH-10943](https://github.com/php/php-src/pull/10943) by Niels Dossche
 - Updated to version 2023.3 (2023c) in [bb7dd51f7a](https://github.com/php/php-src/commit/bb7dd51f7a) by Derick Rethans 💜
 - Empty merge in [cb4e90dca3](https://github.com/php/php-src/commit/cb4e90dca3) by Derick Rethans 💜
 - Updated to version 2023.3 (2023c) in [3ec02202fd](https://github.com/php/php-src/commit/3ec02202fd) by Derick Rethans 💜
 - Empty merge in [ad28cf6111](https://github.com/php/php-src/commit/ad28cf6111) by Derick Rethans 💜
 - Updated to version 2023.3 (2023c) in [2f309dee8e](https://github.com/php/php-src/commit/2f309dee8e) by Derick Rethans 💜
 - Fix uninitialized variable accesses in sockets/conversions in [GH-10966](https://github.com/php/php-src/pull/10966) by Niels Dossche
 - `ext/posix`: posix_eaccess little update and forgotten UPGRADING entry. ([#10965](https://bugs.php.net/bug.php?id=10965)) in [717f460fa4](https://github.com/php/php-src/commit/717f460fa4) by David CARLIER
 - Silence compiler warnings in ext/sockets/conversions.c ([#10974](https://bugs.php.net/bug.php?id=10974)) in [GH-10959](https://github.com/php/php-src/pull/10959) by Niels Dossche

</details>


<br>

---

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 

