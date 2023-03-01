---
title: 'PHP Core Roundup #10'
layout: post
tags:
    - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 01 March 2023

---

Welcome back to the tenth in the PHP Core Roundup series. As February comes to end we have plenty of PHP developments to write about. February was a month full of new RFCs for upcoming PHP 8.3, merged changes, security releases for PHP 8.2, 8.1, and 8.0, as well as several discussions in the mailing list about improving PHP. 

> The PHP Foundation currently supports six part-time PHP contributors who work on maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.

<br>
We publish the posts on our website, and you can subscribe to a newsletter; You don’t necessarily have to be a PHP Foundation backer to follow _PHP Core Roundup_.

{% include "newsletter.html" %}

## Call for PHP 8.3 Release Managers

Sergey Panteleev, one of the PHP 8.2, called for the volunteers to put their names forward to be the release managers for the upcoming PHP 8.3. Typically, each major PHP version gets two or three release managers, one of whom is a "veteran" RM with previous experience being an RM. 

Release managers will be responsible for tagging releases, coordinating releases, triaging security issues, and will have the ultimate say on last-minute RFCs and the release schedule. The standard PHP support cycle of two years of active support, followed by a year of security support means this position lasts for three years.

The release managers will be elected with the same RFC voting process. Applications will be accepted until 31 March 12:00:00 UTC. Elections (if needed) will start on 1 April and run until 16 April 12:00:00 UTC.

The RM process is thoroughly documented, and previous RMs and PHP core contributors will be there to help. If you have reasonable internals knowledge, are able to triage security issues and bugs, review and merge pull requests, and overall take responsibility for managing a branch of one of the most widely used programming languages in the world, feel free to [email the list](https://externals.io/message/119645) and put your name forward. 

## PHP 8.2.3, 8.1.16, and 8.0.28 Security Fix Releases

PHP 8.2.3, 8.1.16, and 8.0.28 were released on February 14, containing fixes for three security vulnerabilities along with several bug fixes. 

PHP 7.4 has reached its End-Of-Life, and there will be no security fix releases.

## Recent RFCs and Mailing List Discussions

> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

### RFC Updates

Following are the RFCs and major pull-requests discussed, voted on, and implemented since our last update.

- **RFC In Voting: [Saner array_(sum|product)()](https://wiki.php.net/rfc/saner-array-sum-product) by George Peter Banyard 💜**
  
  Proposes to change the current behavior of `array_sum` and `array_product` to properly handle non-numeric values. This results in additional warnings when these functions encounter unsupported types such as certain objects, arrays, and resources. Further, it can result in different return values on objects that support arithmetic operations. 

- **RFC In Voting: [Typed class constants](https://wiki.php.net/rfc/typed_class_constants) by Benas Seliuginas and Máté Kocsis 💜**
  
  Despite the huge efforts put into improving the type system of PHP year after year, it is still not possible to declare constant types. This is less of a concern for global constants, but can indeed be a source of bugs and confusion for class constants: This RFC proposes to add support for declaring class, interface, trait, as well as enum constant types:
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

*	**RFC Partially Accepted: [Readonly amendments](https://wiki.php.net/rfc/readonly_amendments) by Nicolas Grekas and Máté Kocsis💜**

	This RFC attempts to address some of the shortcomings of PHP 8.1 readonly properties and 8.2 readonly classes.

	This RFC proposed allowing `readonly` classes to be extended by non-readonly classes (currently not allowed, and causes a fatal error), and to allow reinitializing readonly properties during cloning (within the `__clone()` magic method).

    During the two-part RFC vote, the first change of **allowing `readonly` classes to be extended by non-readonly classes was rejected**. The second change of **making it possible to reinitialize readonly properties during cloning was accepted**. 

*	**RFC Implemented: [More Appropriate Date/Time Exceptions](https://wiki.php.net/rfc/datetime-exceptions) 💜**

	RFC by Derick Rethans, proposed to introduce Date/Time extension-specific exceptions and errors. This detailed RFC suggests more specificity in the exceptions with exception classes such as `DateInvalidTimeZoneException`, and `DateMalformedPeriodStringException` as well as promoting some of the current PHP warnings to Error exceptions.

    The [changes](https://github.com/php/php-src/pull/10366) are now merged.


 
### Notable Mailing List Discussions

- [Official Preprocessor](https://externals.io/message/119451)
- [Deprecate ldap_connect with host and port as separate arguments](https://externals.io/message/119425)
- [RFC proposal: function array_filter_list() to avoid subtle bugs/workarounds](https://externals.io/message/119444)
- [RFC Proposal - Types for Inline Variables](https://externals.io/message/119470)
- [Class Re-implementation Mechanism](https://externals.io/message/119584)
- [PHP code refactoring (was: include cleanup)](https://externals.io/message/119613)
- [RFC Idea - json_validate() validate schema](https://externals.io/message/119631)


## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes, the PHP core developers review all pull requests.

### Change Highlights
 
 - Max Kellermann continued to clean-up several extensions and the Zend engine.
 - Alex Dowad continued with his series of improvements in mbstring extension optimizations. PHP 8.2 received several impactful performance improvements in mbstring extension too.
 - Jakub Zelenka 💜 added a new INI directive `max_multipart_body_parts` to PHP 8.0, 8.1, and 8.2 (in addition to the master branch). When set, PHP limits the number of body parts PHP processes in multipart requests. This is to prevent a DoS attack vector reported as [GHSA-54hq-v5wp-fqgv](https://github.com/php/php-src/security/advisories/GHSA-54hq-v5wp-fqgv)
 - David Carlier also continued his series of additions and improvements to the Socket extension, widening the features and their availability in various operating environments. 
 - Niels Dossche implemented [GH-9826](https://github.com/php/php-src/issues/9826), making it possible for `class_alias()` to work with internal classes. Previously, it was not possible to alias an internal class with `class_alias()`, and resulted in a `ValueError` exception saying the class must be a user-defined class.
 
---

### Full list of commits since [PHP Core Roundup #9](/blog/2023/01/30/php-core-roundup-9/)

<details markdown="1">
  <summary>Click here to expand</summary>

 - Fix type inference in [81607a62ca](https://github.com/php/php-src/commit/81607a62ca) by Dmitry Stogov
 - Fix resetting `ZEND_GENERATOR_IN_FIBER` flag in [b9bca2dadb](https://github.com/php/php-src/commit/b9bca2dadb) by Bob Weinand
 - Look at executing generator for fiber destructor behaviour in [00be6e1aed](https://github.com/php/php-src/commit/00be6e1aed) by Bob Weinand
 - Use `bool` and `zend_result` where it makes sense in sockets extension in [3eb9dd47e0](https://github.com/php/php-src/commit/3eb9dd47e0) by George Peter Banyard 💜
 - Voidify `php_sock_array_from_fd_set()` as result is never used in [735edd1c17](https://github.com/php/php-src/commit/735edd1c17) by George Peter Banyard 💜
 - Bring minimum precision inline with `spprintf` in [93fb2c12b9](https://github.com/php/php-src/commit/93fb2c12b9) by Derick Rethans 💜
 - Fix [GH-10152](https://github.com/php/php-src/issues/10152): Custom properties of Date's child classes are not serialised in [85fbc6eaa6](https://github.com/php/php-src/commit/85fbc6eaa6) by Derick Rethans 💜
 - Fixed [GH-10447](https://github.com/php/php-src/issues/10447): 'p' format specifier does not yield 'Z' for 00:00 in [a42bf93308](https://github.com/php/php-src/commit/a42bf93308) by Derick Rethans 💜
 - Add macro to check `zend_string` is marked as valid UTF-8 in [0b9fb636d1](https://github.com/php/php-src/commit/0b9fb636d1) by George Peter Banyard 💜
 - Add function in `zend_test` to check UTF8 flag is added in [0c9181b646](https://github.com/php/php-src/commit/0c9181b646) by George Peter Banyard 💜
 - Mark numeric strings as valid UTF-8 in [78720e39a6](https://github.com/php/php-src/commit/78720e39a6) by George Peter Banyard 💜
 - Concatenating two valid UTF-8 strings produces a valid UTF-8 string in [64127b66c6](https://github.com/php/php-src/commit/64127b66c6) by George Peter Banyard 💜
 - Ignore generated file on arm64 in [21cab65c00](https://github.com/php/php-src/commit/21cab65c00) by Danack
 - `github/workflows/push.yml`: enable ccache in [GH-10395](https://github.com/php/php-src/pull/10395) by Max Kellermann
 - Fix `lineno` for all constant expressions in [GH-8855](https://github.com/php/php-src/pull/8855) by Ilija Tovilo 💜
 - Allow comments between intersection types and by-ref params in [GH-10125](https://github.com/php/php-src/pull/10125) by Ilija Tovilo 💜
 - Fix comp-time and constant evaluation of dynamic class constant fetch in [GH-10487](https://github.com/php/php-src/pull/10487) by Ilija Tovilo 💜
 - Fix incorrect line number of constant in constant expression in [848a6e5035](https://github.com/php/php-src/commit/848a6e5035) by Ilija Tovilo 💜
 - Move setting of `CG(zend_lineno)` in [fb670f2b80](https://github.com/php/php-src/commit/fb670f2b80) by Ilija Tovilo 💜
 - Fix use-after-free in `write_property` when object is released in [GH-10179](https://github.com/php/php-src/pull/10179) by Ilija Tovilo 💜
 - Avoid crash for `reset`/`end`/`next`/`prev()` on ffi classes in [GH-9711](https://github.com/php/php-src/pull/9711) by Tyson Andre
 - Use AVX2 to accelerate `strto{upper,lower}` (only on 'AVX2-native' builds for now) in [c02af98ae5](https://github.com/php/php-src/commit/c02af98ae5) by Alex Dowad
 - fixed some misspellings ([#10503](https://bugs.php.net/bug.php?id=10503)) in [d2cdfdbe44](https://github.com/php/php-src/commit/d2cdfdbe44) by rj1
 - Fix [GH-10315](https://github.com/php/php-src/issues/10315): FPM unknown child alert not valid in [GH-10319](https://github.com/php/php-src/pull/10319) by Jakub Zelenka 💜
 - Fix [GH-10385](https://github.com/php/php-src/issues/10385): FPM successful config test early exit in [GH-10388](https://github.com/php/php-src/pull/10388) by Niels Dossche
 - Introduce convenience macros for copying flags that hold when concatenating two strings in [99b86141ae](https://github.com/php/php-src/commit/99b86141ae) by Niels Dossche
 - Copy UTF-8 flag for `str_repeat` in [c2d4bafc4f](https://github.com/php/php-src/commit/c2d4bafc4f) by Niels Dossche
 - `ext/snmp`: use `memcpy()` instead of `memmove()` ([#10498](https://bugs.php.net/bug.php?id=10498)) in [d3abcae4a2](https://github.com/php/php-src/commit/d3abcae4a2) by Max Kellermann
 - Implement an SSE2 accelerated version of `zend_adler32` ([#10507](https://bugs.php.net/bug.php?id=10507)) in [722fbd01a3](https://github.com/php/php-src/commit/722fbd01a3) by Niels Dossche
 - Sync boost/context assembly files for fibers in [GH-10407](https://github.com/php/php-src/pull/10407) by Niels Dossche
 - Metaphone performance improvement ([#10501](https://bugs.php.net/bug.php?id=10501)) in [c9cbe525e1](https://github.com/php/php-src/commit/c9cbe525e1) by Niels Dossche
 - Do not build unnecessary FCI in Reflection in [50a2de78a8](https://github.com/php/php-src/commit/50a2de78a8) by George Peter Banyard 💜
 - When fuzzing mbstring encoding conversion code, compare output with different intermediate buffer sizes in [d5d9900661](https://github.com/php/php-src/commit/d5d9900661) by Alex Dowad
 - Add AVX2-accelerated UTF-16 decoding/encoding routines in [c8ec2ed730](https://github.com/php/php-src/commit/c8ec2ed730) by Alex Dowad
 - Fix possible `exit_counters` memory leak in ZTS build in [a21195650e](https://github.com/php/php-src/commit/a21195650e) by Dmitry Stogov
 - Make fuzzer respect `ZEND_MMAP_AHEAD` in [5c5707d44d](https://github.com/php/php-src/commit/5c5707d44d) by Dmitry Stogov
 - `ext/opcache/zend_jit`: cast function to fix `-Wincompatible-pointer-types` ([#10527](https://bugs.php.net/bug.php?id=10527)) in [afbb28dfb7](https://github.com/php/php-src/commit/afbb28dfb7) by Max Kellermann
 - Disable timestamp for GitHub actions ccache in [c95125d370](https://github.com/php/php-src/commit/c95125d370) by Ilija Tovilo 💜
 - `ext/opcache/zend_jit`: call TSRM dtor before unloading opcache.so ([#10533](https://bugs.php.net/bug.php?id=10533)) in [131b862ac0](https://github.com/php/php-src/commit/131b862ac0) by Max Kellermann
 - Fix PDO OCI Bug [#60994](https://bugs.php.net/bug.php?id=60994) (Reading a multibyte CLOB caps at 8192 chars) in [4df4264ac9](https://github.com/php/php-src/commit/4df4264ac9) by Michael Voříšek
 - `Zend/zend_cpuinfo`, `ext/standard/crc32_x86`: fix `-Wstrict-prototypes` in [0752baa583](https://github.com/php/php-src/commit/0752baa583) by Max Kellermann
 - `php.ini-production`: disable `opcache.huge_code_pages` by default in [GH-10336](https://github.com/php/php-src/pull/10336) by Max Kellermann
 - Cleanup dead code in `array_slice` ([#10539](https://bugs.php.net/bug.php?id=10539)) in [3ff8333473](https://github.com/php/php-src/commit/3ff8333473) by Niels Dossche
 - Fix [GH-10168](https://github.com/php/php-src/issues/10168): heap-buffer-overflow at `zval_undefined_cv` in [GH-10524](https://github.com/php/php-src/pull/10524) by Niels Dossche
 - `github/workflows/nightly.yml`: add job to build out-of-tree extensions in [GH-10404](https://github.com/php/php-src/pull/10404) by Max Kellermann
 - `random`: Use branchless implementation for mask generation in `Randomizer::getBytesFromString()` ([#10522](https://bugs.php.net/bug.php?id=10522)) in [0cfc45b667](https://github.com/php/php-src/commit/0cfc45b667) by Tim Düsterhus
 - Implement More Appropriate Date/Time Exceptions RFC in [b7860cd564](https://github.com/php/php-src/commit/b7860cd564) by Derick Rethans 💜
 - Improve illegal offset error messages ([#10504](https://bugs.php.net/bug.php?id=10504)) in [641fe23e3a](https://github.com/php/php-src/commit/641fe23e3a) by Marcos Marcolin
 - `ext/curl`: suppress `-Wdeprecated-declarations` in [GH-10531](https://github.com/php/php-src/pull/10531) by Max Kellermann
 - Bump minimum `re2c` version requirement to 1.0.3 in [df853cb305](https://github.com/php/php-src/commit/df853cb305) by Derick Rethans 💜
 - `opcache/pcntl/cli`: Fixes few functions signatures in [81aedad452](https://github.com/php/php-src/commit/81aedad452) by David Carlier
 - Fix [GH-10370](https://github.com/php/php-src/issues/10370): File corruption in `_php_stream_copy_to_stream_ex` when using `copy_file_range` ([#10440](https://bugs.php.net/bug.php?id=10440)) in [b4db690cb3](https://github.com/php/php-src/commit/b4db690cb3) by Niels Dossche
 - Fix concurrent testing in [10f2378584](https://github.com/php/php-src/commit/10f2378584) by Arnaud Le Blanc 💜
 - Fixed OSS fuzz issues [#55589](https://bugs.php.net/bug.php?id=55589), [#55599](https://bugs.php.net/bug.php?id=55599), and [#55727](https://bugs.php.net/bug.php?id=55727) in [5d9ee8f920](https://github.com/php/php-src/commit/5d9ee8f920) by Derick Rethans 💜
 - Fix memory leaks in `ext-tidy` in [GH-10545](https://github.com/php/php-src/pull/10545) by George Peter Banyard 💜
 - Mark test as `XFAIL` in [13c34aac05](https://github.com/php/php-src/commit/13c34aac05) by Ilija Tovilo 💜
 - Temporarily disable odbc in ci in [18b611d6a0](https://github.com/php/php-src/commit/18b611d6a0) by Ilija Tovilo 💜
 - Simplify `php_reflection.c`, class name cannot start with backslash ([#10536](https://bugs.php.net/bug.php?id=10536)) in [a11e9c9d02](https://github.com/php/php-src/commit/a11e9c9d02) by Michael Voříšek
 - Fix [GH-10548](https://github.com/php/php-src/issues/10548): `copy()` fails on cifs mounts because of incorrect length (cfr_max) specified in `streams.c`:1584 `copy_file_range()` ([#10551](https://bugs.php.net/bug.php?id=10551)) in [e787d6c9e6](https://github.com/php/php-src/commit/e787d6c9e6) by Niels Dossche
 - sockets add `SO_RERROR`/`SO_ZEROIZE`/`SO_SPLICE` net/openbsd's constants in [GH-10563](https://github.com/php/php-src/pull/10563) by David Carlier
 - base64: add avx512 and vbmi version. in [GH-6361](https://github.com/php/php-src/pull/6361) by Frank Du
 - crypt: Fix validation of malformed BCrypt hashes in [c840f71524](https://github.com/php/php-src/commit/c840f71524) by Tim Düsterhus
 - crypt: Fix possible buffer overread in `php_crypt()` in [a92acbad87](https://github.com/php/php-src/commit/a92acbad87) by Tim Düsterhus
 - Fix array overrun when appending slash to paths in [ec10b28d64](https://github.com/php/php-src/commit/ec10b28d64) by Niels Dossche
 - Stop copying internal functions into each thread ([#10517](https://bugs.php.net/bug.php?id=10517)) in [3b75f07c9a](https://github.com/php/php-src/commit/3b75f07c9a) by Dmitry Stogov
 - Fix collection of unfinished function call in fibers in [d721dcc2ef](https://github.com/php/php-src/commit/d721dcc2ef) by Arnaud Le Blanc 💜
 - Fix [GH-10496](https://github.com/php/php-src/issues/10496): Fibers must not be garbage collected while implicitly suspended by resumption of another fiber in [95016138a5](https://github.com/php/php-src/commit/95016138a5) by Bob Weinand
 - Fix assertion failure when `var_dump`'ing void FFI result ([#10568](https://bugs.php.net/bug.php?id=10568)) in [1a5fc6e1a3](https://github.com/php/php-src/commit/1a5fc6e1a3) by Niels Dossche
 - `posix`: fix misuse of `bool` (invalid code in c23) in [GH-10577](https://github.com/php/php-src/pull/10577) by Cristian Rodríguez
 - Make C functions returning "void" to return PHP "null" ([#10579](https://bugs.php.net/bug.php?id=10579)) in [7d49189ff4](https://github.com/php/php-src/commit/7d49189ff4) and [851e4623f5](https://github.com/php/php-src/commit/851e4623f5) by Dmitry Stogov
 - Fix updating SSA object type for `*_ASSIGN_OP` ([#10458](https://bugs.php.net/bug.php?id=10458)) in [d94ddbed2c](https://github.com/php/php-src/commit/d94ddbed2c) by Niels Dossche
 - Fix repeated warning for file uploads limit exceeding in [e45850c195](https://github.com/php/php-src/commit/e45850c195) by Jakub Zelenka 💜
 - Introduce `max_multipart_body_parts` INI in [716de0cff5](https://github.com/php/php-src/commit/716de0cff5) and [fd3cc17cbd](https://github.com/php/php-src/commit/fd3cc17cbd) by Jakub Zelenka 💜
 - Fix incorrect character in `NEWS` in [caaaf75990](https://github.com/php/php-src/commit/caaaf75990) by Jakub Zelenka 💜
 - Change `NEWS` for [GHSA-54hq-v5wp-fqgv](https://github.com/php/php-src/security/advisories/GHSA-54hq-v5wp-fqgv) as it is for all SAPIs in [eef29d434a](https://github.com/php/php-src/commit/eef29d434a) by Jakub Zelenka 💜
 - more config for new FPM tests in [e86d8704b4](https://github.com/php/php-src/commit/e86d8704b4) by Remi Collet
 - Point to the issue tracker on GitHub in [586e81b259](https://github.com/php/php-src/commit/586e81b259) by Ben Ramsey
 - Use `gtar` if it's in the `PATH` in [843ba82b53](https://github.com/php/php-src/commit/843ba82b53) by Ben Ramsey
 - Ensure `tar` is not `bsdtar` in [d9ac59b0a9](https://github.com/php/php-src/commit/d9ac59b0a9) by Ben Ramsey
 - Add a `SECURITY.md` community health file to the repo in [5845a52973](https://github.com/php/php-src/commit/5845a52973) and [bbc1f821dd](https://github.com/php/php-src/commit/bbc1f821dd) by Ben Ramsey
 - Update to use GitHub security issue reporting in [d62968cd12](https://github.com/php/php-src/commit/d62968cd12) by Ben Ramsey
 - Revert "Fix [GH-10168](https://github.com/php/php-src/issues/10168): heap-buffer-overflow at `zval_undefined_cv`" in [7b68ff46da](https://github.com/php/php-src/commit/7b68ff46da) by Ilija Tovilo 💜
 - Update RM doc with new PGP keyserver in [0493187024](https://github.com/php/php-src/commit/0493187024) by Ben Ramsey
 - Revert "Remove useless `UNEXPECTED` around `RETURN_VALUE_USED` in specialized `RETVAL` handler" in [81f3fcd5cc](https://github.com/php/php-src/commit/81f3fcd5cc) by Ilija Tovilo 💜
 - Fix strict prototypes warnings in [7c3b92fc91](https://github.com/php/php-src/commit/7c3b92fc91) by Ilija Tovilo 💜
 - `ext/json`: add `php_json_scanner_defs.h` as make target in [2fde3afffb](https://github.com/php/php-src/commit/2fde3afffb) by Daniel Black
 - `ext/Zend`: `zend_language_scanner_defs.h` as make target in [e83cda0887](https://github.com/php/php-src/commit/e83cda0887) by Daniel Black
 - zend win32 RE2C header files to Make targets and generated_files in [2b3fa5edac](https://github.com/php/php-src/commit/2b3fa5edac) by Daniel Black
 - Fix `php_json_scanner_defs.h` target in `ext/json/Makefile.frag` in [4f731fa2ec](https://github.com/php/php-src/commit/4f731fa2ec) by Jakub Zelenka 💜
 - Update `NEWS` with scanner and parser build fixes in [a9e4f51844](https://github.com/php/php-src/commit/a9e4f51844) by Jakub Zelenka 💜
 - `makedist`: Use fixed owner/group in generated tarball ([#10613](https://bugs.php.net/bug.php?id=10613)) in [7d229787b0](https://github.com/php/php-src/commit/7d229787b0) by Tim Düsterhus
 - `proc_open`: reject array with empty command name ([#10559](https://bugs.php.net/bug.php?id=10559)) in [5e617d0b4d](https://github.com/php/php-src/commit/5e617d0b4d) by Cristian Rodríguez
 - `Zend/zend_types.h`: deprecate `zend_bool`, `zend_intptr_t`, `zend_uintptr_t` ([#10597](https://bugs.php.net/bug.php?id=10597)) in [413844d626](https://github.com/php/php-src/commit/413844d626) by Max Kellermann
 - `ext/opcache/zend_shared_alloc`: `bool` fixups in [3b9812f8be](https://github.com/php/php-src/commit/3b9812f8be) by Max Kellermann
 - `ext/opcache/zend_shared_alloc`: convert more `int` to `bool` in [3dcd47243c](https://github.com/php/php-src/commit/3dcd47243c) by Max Kellermann
 - `ext/opcache/ZendAccelerator`: `accel_is_inactive()` returns bool in [a50de37013](https://github.com/php/php-src/commit/a50de37013) by Max Kellermann
 - `ext/opcache/ZendAccelerator`: fix functions to return zend_result in [04c85a3371](https://github.com/php/php-src/commit/04c85a3371) by Max Kellermann
 - `Zend/zend_alloc`: make `stderr_last_error()` static ([#10587](https://bugs.php.net/bug.php?id=10587)) in [c0d89e54c8](https://github.com/php/php-src/commit/c0d89e54c8) by Max Kellermann
 - Make globals const (part 2) ([#10610](https://bugs.php.net/bug.php?id=10610)) in [d46dea169c](https://github.com/php/php-src/commit/d46dea169c) by Max Kellermann
 - `Zend/zend_globals`: convert `fiber_stack_size` to `size_t` ([#10619](https://bugs.php.net/bug.php?id=10619)) in [bf036fa2a3](https://github.com/php/php-src/commit/bf036fa2a3) by Max Kellermann
 - Fix [GH-10623](https://github.com/php/php-src/issues/10623): `ReflectionFunction::getClosureUsedVariables()` returns empty array in presence of variadic arguments in [ae16471628](https://github.com/php/php-src/commit/ae16471628) by Niels Dossche
 - Fix [GH-10377](https://github.com/php/php-src/issues/10377): Unable to have an anonymous readonly class in [GH-10381](https://github.com/php/php-src/pull/10381) by Niels Dossche
 - `Zend/zend_types.h`: move `zend_result` to separate header ([#10609](https://bugs.php.net/bug.php?id=10609)) in [3bce116069](https://github.com/php/php-src/commit/3bce116069) by Max Kellermann
 - `Zend/zend_extensions`: make `zend_extension_version_info` const ([#10592](https://bugs.php.net/bug.php?id=10592)) in [7029fd08b1](https://github.com/php/php-src/commit/7029fd08b1) by Max Kellermann
 - `CODING_STANDARDS.md`: establish C99 as the implementation language ([#10631](https://bugs.php.net/bug.php?id=10631)) in [5bfd3fa40f](https://github.com/php/php-src/commit/5bfd3fa40f) by Max Kellermann
 - `ext/mbstring`: fix `new_value` length check in [GH-10532](https://github.com/php/php-src/pull/10532) by Max Kellermann
 - Fix [GH-10627](https://github.com/php/php-src/issues/10627): `mb_convert_encoding` crashes PHP on Windows in [GH-10628](https://github.com/php/php-src/pull/10628) by Niels Dossche
 - Make various pointers const in Zend/ ([#10608](https://bugs.php.net/bug.php?id=10608)) in [49c1e6eb33](https://github.com/php/php-src/commit/49c1e6eb33) by Max Kellermann
 - Fix (at lease part of the) #[GH-10635](https://github.com/php/php-src/issues/10635): ARM64 function JIT causes impossible assertion in [08e7591206](https://github.com/php/php-src/commit/08e7591206) by Dmitry Stogov
 - Improve the optimizer's check if a function is a prototype or not ([#10467](https://bugs.php.net/bug.php?id=10467)) in [2e78c080c6](https://github.com/php/php-src/commit/2e78c080c6) by Niels Dossche
 - Fix [GH-10635](https://github.com/php/php-src/issues/10635): ARM64 function JIT causes impossible assertion ([#10638](https://bugs.php.net/bug.php?id=10638)) in [70ff10af72](https://github.com/php/php-src/commit/70ff10af72) by Dmitry Stogov
 - `Zend/zend_ini`: fix zend_result return values in [d51eb1d74c](https://github.com/php/php-src/commit/d51eb1d74c) by Max Kellermann
 - `ext/curl/interface`: fix zend_result return value in [GH-10640](https://github.com/php/php-src/pull/10640) by Max Kellermann
 - Make lots of string pointers `const` ([#10646](https://bugs.php.net/bug.php?id=10646)) in [263b22f374](https://github.com/php/php-src/commit/263b22f374) by Max Kellermann
 - Add missing error check on tidyLoadConfig in [GH-10636](https://github.com/php/php-src/pull/10636) by ndossche
 - Fix incorrect error check in browsecap for `pcre2_match()` in [GH-10632](https://github.com/php/php-src/pull/10632) by ndossche
 - Fix Tidy tests failing due to different spelling in [74c880edd1](https://github.com/php/php-src/commit/74c880edd1) by nielsdos
 - Two `enum`s instead of preprocessor macros ([#10617](https://bugs.php.net/bug.php?id=10617)) in [bb07e20203](https://github.com/php/php-src/commit/bb07e20203) by Max Kellermann
 - `sapi/fpm`: remove use of variable-length arrays ([#10645](https://bugs.php.net/bug.php?id=10645)) in [ff2a211d55](https://github.com/php/php-src/commit/ff2a211d55) by Max Kellermann
 - ext: make various internal functions static ([#10650](https://bugs.php.net/bug.php?id=10650)) in [1287747a9a](https://github.com/php/php-src/commit/1287747a9a) by Max Kellermann
 - Propagate errors correctly in `ps_files_cleanup_dir()` in [GH-10644](https://github.com/php/php-src/pull/10644) by nielsdos
 - Fix [GH-10647](https://github.com/php/php-src/issues/10647): `Spoofchecker` `isSuspicious`/`areConfusable` methods error code's argument in [GH-10653](https://github.com/php/php-src/pull/10653) by NathanFreeman
 - make clean: remove `ext/opcache/minilua` in [GH-10656](https://github.com/php/php-src/pull/10656) by Kévin Dunglas
 - Implement [GH-9826](https://github.com/php/php-src/issues/9826): Make `class_alias()` work with internal classes ([#10483](https://bugs.php.net/bug.php?id=10483)) in [821fc55a68](https://github.com/php/php-src/commit/821fc55a68) by Niels Dossche
 - Fix [GH-10239](https://github.com/php/php-src/issues/10239): `proc_close` after `proc_get_status` always returns `-1` in [GH-10250](https://github.com/php/php-src/pull/10250) by Niels Dossche
 - `CODING_STANDARDS.md`: add rules for `bool`/`zend_result` return types ([#10630](https://bugs.php.net/bug.php?id=10630)) in [da777d493a](https://github.com/php/php-src/commit/da777d493a) by Max Kellermann
 - `makedist`: Use fixed sort in generated tarball ([#10615](https://bugs.php.net/bug.php?id=10615)) in [9660a7fa59](https://github.com/php/php-src/commit/9660a7fa59) by Tim Düsterhus
 - New test case from ed0c0df351 exercises the code it was intended to in [e934c5cde1](https://github.com/php/php-src/commit/e934c5cde1) by Alex Dowad
 - Remove unneeded function `mbfl_name2no_encoding` in [a85adb170c](https://github.com/php/php-src/commit/a85adb170c) by Alex Dowad
 - Remove unneeded function `mbfl_no2preferred_mime_name` in [117f2263ce](https://github.com/php/php-src/commit/117f2263ce) by Alex Dowad
 - Implement `mb_decode_mimeheader` using fast text conversion filters in [157ca654f2](https://github.com/php/php-src/commit/157ca654f2) by Alex Dowad
 - `mb_decode_mimeheader` obeys RFC 2047 regarding underscores and QPrint encoding in [8995f60258](https://github.com/php/php-src/commit/8995f60258) by Alex Dowad
 - Add support for generating namespaced constant in [GH-10552](https://github.com/php/php-src/pull/10552) by SATO Kentaro
 - Declare proper parameter default values for `imagegd2` ([#10569](https://bugs.php.net/bug.php?id=10569)) in [101178214c](https://github.com/php/php-src/commit/101178214c) by Máté Kocsis 💜
 - `Zend/zend_variables`: use C99 designated initializers ([#10655](https://bugs.php.net/bug.php?id=10655)) in [0460420205](https://github.com/php/php-src/commit/0460420205) by Max Kellermann
 - `zend_compiler`, ...: use `uint8_t` instead of `zend_uchar` ([#10621](https://bugs.php.net/bug.php?id=10621)) in [d5c649b36b](https://github.com/php/php-src/commit/d5c649b36b) by Max Kellermann
 - random: Move the CSPRNG implementation into a separate C file ([#10668](https://bugs.php.net/bug.php?id=10668)) in [b14dd85dca](https://github.com/php/php-src/commit/b14dd85dca) by Tim Düsterhus
 - Fix incorrect string length for `output_handler` in zlib ini code in [GH-10667](https://github.com/php/php-src/pull/10667) by Niels Dossche
 - Use an explicit failure check for `zend_result` functions in the scanner ([#10688](https://bugs.php.net/bug.php?id=10688)) in [91857ccaf9](https://github.com/php/php-src/commit/91857ccaf9) by Niels Dossche
 - Re-enable `UnixODBC` testing in [939c546ea1](https://github.com/php/php-src/commit/939c546ea1) by Danack
 - Fix segfault when using `ReflectionFiber` (fixes [#10439](https://bugs.php.net/bug.php?id=10439)) in [GH-10478](https://github.com/php/php-src/pull/10478) by Daniil Gentili
 - `ext/opcache/zend_shared_alloc`: use `memfd` for locking if available in [GH-10589](https://github.com/php/php-src/pull/10589) by Max Kellermann
 - `random`: Fix return type of `php_random_(bytes|int)` ([#10687](https://bugs.php.net/bug.php?id=10687)) in [f079aa2e24](https://github.com/php/php-src/commit/f079aa2e24) by Tim Düsterhus
 - Fix [GH-10672](https://github.com/php/php-src/issues/10672) (`pg_lo_open` segfaults in the `strict_types` mode) in [GH-10677](https://github.com/php/php-src/pull/10677) by George Peter Banyard 💜
 - Fixed bug [GH-10270](https://github.com/php/php-src/issues/10270) Unable to return `CURL_READFUNC_PAUSE` in readfunc callback in [GH-10607](https://github.com/php/php-src/pull/10607) by Pierrick Charron
 - Fix incorrect type for return value of `zend_update_static_property_ex()` in [GH-10691](https://github.com/php/php-src/pull/10691) by nielsdos
 - Fix [GH-10570](https://github.com/php/php-src/issues/10570): Assertion `(key)->h != 0 && "Hash must be known"' failed in [GH-10572](https://github.com/php/php-src/pull/10572) by Niels Dossche
 - Fix [GH-10489](https://github.com/php/php-src/issues/10489): `run-tests.php` does not escape path when building cmd  ([#10560](https://bugs.php.net/bug.php?id=10560)) in [dcc3255b18](https://github.com/php/php-src/commit/dcc3255b18) by Niels Dossche
 - Fix [GH-10692](https://github.com/php/php-src/issues/10692): PHP crashes on Windows when an in-existent filename is executed in [GH-10697](https://github.com/php/php-src/pull/10697) by Niels Dossche
 - Fix [GH-10659](https://github.com/php/php-src/issues/10659): `hash/xxhash` applying build upstream fix in [GH-10693](https://github.com/php/php-src/pull/10693) by David Carlier
 - Change `DOMCharacterData::appendData` return type to true ([#10690](https://bugs.php.net/bug.php?id=10690)) in [e1967ca9ed](https://github.com/php/php-src/commit/e1967ca9ed) by othercorey
 - Fix format string mistake in `accel_move_code_to_huge_pages()` in [eb7bb3430b](https://github.com/php/php-src/commit/eb7bb3430b) by Niels Dossche
 - Fix incorrect error checking in `php_openssl_set_server_dh_param()` in [GH-10705](https://github.com/php/php-src/pull/10705) by Niels Dossche
 - Use `zend_result` where appropriate in `ext/openssl` Remove dead code in [GH-10704](https://github.com/php/php-src/pull/10704) by Niels Dossche
 - Change implicit enum return value checks to explicit checks ([#10703](https://bugs.php.net/bug.php?id=10703)) in [375e7402af](https://github.com/php/php-src/commit/375e7402af) by Niels Dossche
 - Fix `UBSAN` warning about applying zero offset to null pointer ([#10700](https://bugs.php.net/bug.php?id=10700)) in [382148d7bb](https://github.com/php/php-src/commit/382148d7bb) by George Peter Banyard 💜
 - Simplify checks and returns in `ext/xmlwriter` ([#10701](https://bugs.php.net/bug.php?id=10701)) in [07fe46fb5d](https://github.com/php/php-src/commit/07fe46fb5d) by Niels Dossche
 - chore: standardize the visibility of functions. ([#10708](https://bugs.php.net/bug.php?id=10708)) in [9004725367](https://github.com/php/php-src/commit/9004725367) by Marcos Marcolin
 - Minor cleanups in Zend execution APIs ([#10699](https://bugs.php.net/bug.php?id=10699)) in [9108a32bfe](https://github.com/php/php-src/commit/9108a32bfe) by Niels Dossche
 - `Zend/zend_types.h`: move `zend_rc_debug` to `zend_rc_debug.h` in [d6e95041e2](https://github.com/php/php-src/commit/d6e95041e2) by Max Kellermann
 - `Zend/zend_rc_debug`: convert `ZEND_RC_MOD_CHECK()` to function in [e509a66a9c](https://github.com/php/php-src/commit/e509a66a9c) by Max Kellermann
 - `Zend/zend_types.h`: move `IS_*` to `zend_type_code.h` in [0270a1e54c](https://github.com/php/php-src/commit/0270a1e54c) by Max Kellermann
 - `Zend/zend_type_code.h`: convert to `enum` in [b98f18e7c3](https://github.com/php/php-src/commit/b98f18e7c3) by Max Kellermann
 - `Zend/zend_types.h`: move `zend_refcounted` to `zend_refcounted.h` in [eb34c28fed](https://github.com/php/php-src/commit/eb34c28fed) by Max Kellermann
 - `Zend/zend_types.h`: move `zend_uchar.h` to `zend_char.h` in [42577c6b6b](https://github.com/php/php-src/commit/42577c6b6b) by Max Kellermann
 - `Zend/zend_types.h`: move `zend_string` to `zend_string.h` in [02690fe3c0](https://github.com/php/php-src/commit/02690fe3c0) by Max Kellermann
 - The userland constants do not start with PHP_ in [6a5b3f0ff9](https://github.com/php/php-src/commit/6a5b3f0ff9) by George Peter Banyard 💜
 - Fixed `ValueError` message in `substr_compare()` in [2133970152](https://github.com/php/php-src/commit/2133970152) by George Peter Banyard 💜
 - Fixed `ValueError` message in count_chars() in [adc5edd411](https://github.com/php/php-src/commit/adc5edd411) by George Peter Banyard 💜
 - Improve handling of XML options in [GH-10675](https://github.com/php/php-src/pull/10675) by George Peter Banyard 💜
 - `Zend/zend_fibers`: change return value to zend_result in [GH-10622](https://github.com/php/php-src/pull/10622) by Max Kellermann
 - Remove unnecessary checks in `ftp_fopen_wrapper.c` ([#10711](https://bugs.php.net/bug.php?id=10711)) in [edacfbd1d4](https://github.com/php/php-src/commit/edacfbd1d4) by Niels Dossche
 - Allow `gen_stub.php` to parse and ignore extended docblock types in [81abd8dc37](https://github.com/php/php-src/commit/81abd8dc37) by Bob Weinand
 - Fix incorrect inheritance cache update ([#10719](https://bugs.php.net/bug.php?id=10719)) in [2e3fc8c0ff](https://github.com/php/php-src/commit/2e3fc8c0ff) by Dmitry Stogov
 - Fix incorrect inheritance cache update ([#10719](https://bugs.php.net/bug.php?id=10719)) in [44e5c04e55](https://github.com/php/php-src/commit/44e5c04e55) by Dmitry Stogov
 - Fix [GH-10715](https://github.com/php/php-src/issues/10715): phpdbg heap buffer overflow -- by misuse of the option "--run" in [GH-10720](https://github.com/php/php-src/pull/10720) by Niels Dossche
 - `Zend/zend_type_code`: remove hard-coded integer values and remove unused macro `ZEND_SAME_FAKE_TYPE` `Zend/zend_variables`: add _Static_assert on the size zend_rc_dtor_func _Static_assert is C11, but has been supported since GCC 4.6 in [GH-10714](https://github.com/php/php-src/pull/10714) by Max Kellermann
 - `ext/sockets`: add `TCP_REPAIR` to silently close a connection in [GH-10724](https://github.com/php/php-src/pull/10724) by David CARLIER


</details>


<br>

---

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 

