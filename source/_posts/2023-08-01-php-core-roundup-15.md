
---
title: 'PHP Core Roundup #15'
layout: post
tags:
  - roundup
author:
  - name: Ayesh Karunaratne
    url: https://aye.sh
  
  - name: Sergey Panteleev
    url: https://sergeypanteleev.com
published_at: 01 August 2023

---

Welcome back to [PHP Core Roundup](/blog/tag/roundup/) series! This is post #15, where we highlight and celebrate the improvements made to PHP during the month past by the PHP development team, members of the PHP Foundation, and more.

> The PHP Foundation is a collective of PHP contributors, veterans, and companies that collaborate to ensure the long-term sustainability of the PHP programming language. The foundation currently supports six contributors focused on PHP's maintenance, debt reduction, and feature development. These contributors work closely with others on coding, documentation, and discussions.

> Started over a year ago, the PHP Core Roundup series offers a summary of the latest developments, discussions, and news about PHP Core, contributed by both PHP Foundation members and other participants. This post is the thirteenth in the PHP Core Roundup series.

{% include "newsletter.html" %}

## PHP 8.3 Feature-Freeze

On July 18, PHP 8.3 branch reached its feature-freeze. As the name suggests, the list of features we plan to ship with PHP 8.3 is now frozen. Contributors who wish to make substantial changes to PHP should now target the next PHP version, PHP 8.4.

In the coming weeks, the PHP Foundation members, the PHP development team, and contributors will be making improvements to get PHP 8.3 ready for production release.

Release managers elected for PHP 8.3, Pierrick Charron, Jakub Zelenka, and Eric Mann will have the final say in case a major change must be made to the PHP 8.3.

## PHP 8.3 Beta Release

The second beta release of PHP 8.3 was released this week. Now would be an ideal time to test your PHP applications on PHP 8.3.

Compiled Windows binaries are available at [windows.php.net/qa](https://windows.php.net/qa/), [Docker images](https://hub.docker.com/_/php/tags?page=1&name=8.3.0) are available at Docker Hub, and source code at [php/php-src repository on GitHub](https://github.com/php/php-src) to compile yourself. On Homebrew, `PHP 8.3.0-dev` packages are available from <code>[shivammathur/php](https://github.com/shivammathur/homebrew-php)</code> tap.

CI/CD platforms that use Docker images can use the PHP 8.2 docker images available with various base images. GitHub Actions can also make use of <code>[shivammathur/setup-php](https://github.com/shivammathur/setup-php)</code> action, which supports PHP 8.3 builds.

## PHP Bug Fix Releases

The PHP development team released two new versions in July 2023:

**[PHP 8.2.8](https://www.php.net/archive/2023.php#2023-07-06-2)** and **[PHP 8.1.21](https://www.php.net/archive/2023.php#2023-07-06-3)**

These releases include bug fixes across various components such as CLI, Core, Curl, DOM, Opcache, OpenSSL, PGSQL, Phar, SPL, and Standard.

## Recent RFCs and Mailing List Discussions


> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

## RFC Updates

### Accepted: [PDO driver specific sub-classes](https://wiki.php.net/rfc/pdo_driver_specific_subclasses) by Danack

PHP's PDO extension supports connecting to multiple database software by using different database drivers available. Some of these drivers include MySQL, PostgreSQL, and SQLite. Although most of these database support a common set of features, all of these databases have evolved to provide additional features that PDO _sometimes_ can support, but there is no easy way for a library to check for these capabilities without having to inspect the driver and their versions.

This RFC proposes to create driver-specific sub classes of `\PDO`, so libraries and applications can easily indicate the database driver they expect, and make use of IDE autocompletion and proper error handling. 

The vote was unanimously accepted, and is pending implementation.

### Accepted: [Deprecate Functions with Overloaded Signatures](https://wiki.php.net/rfc/deprecate_functions_with_overloaded_signatures) by Máté Kocsis 💜

This RFC proposes to deprecate a number of functions that have overloaded signatures, meaning they behave differently based on the number or type of arguments passed to them. The goal is to make PHP's function signatures more consistent and predictable.

### Implemented: [Deprecations for PHP 8.3](https://wiki.php.net/rfc/deprecations_php_8_3) by George Peter Banyard 💜, Christoph M. Becker, Máté Kocsis 💜, Tim Düsterhus, Go Kudo, Andreas Heigl

The aim is to clean up some of the older, less consistent parts of PHP to make the language more reliable and predictable. The following list provides a short overview of the functionality targeted for deprecation:

- Passing negative `$widths` to `mb_strimwidth()`
- The `NumberFormatter::TYPE_CURRENCY` constant
- `MT_RAND_PHP`
- Calling `ldap_connect` with 2 parameters

### Implemented: [Marking Overridden Methods](https://wiki.php.net/rfc/marking_overriden_methods) by Tim Düsterhus

PHP 8.3 will have a new attribute `#[\Override]`. If this attribute is added to a method, the engine will validate that a method with the same name exists in a parent class or any of the implemented interfaces. If no such method exists, a compile time error will be emitted.

The similar concepts exist in Java, TypeScript, C++, C#, Swift, Kotlin, and other languages.

### Implemented: [Path to Saner Increment/Decrement operators](https://wiki.php.net/rfc/saner-inc-dec-operators) by George Peter Banyard  💜

This RFC proposed several improvements to normalize the behavior of `$v++` and `$v--` to be the same as `$v += 1` and `$v -= 1`, which PHP is currently inconsistent on.

It deprecates certain patterns, and introduces two new functions named `str_increment` and `str_decrement` to provide the deprecated behavior in a conscious way. 

<br>

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements.
 
---

### Full list of commits  since [PHP Core Roundup #14](/blog/2023/07/01/php-core-roundup-14/)

Commits are in the order they were added, grouped by author in alphabetical order.

<details markdown="1">
  <summary>Click here to expand</summary>

### Adam Saponara
 - Fix [GH-9669](https://github.com/php/php-src/issues/9669): phpdbg -h options doesn't list the -z option in [GH-9713](https://github.com/php/php-src/pull/9713)

### Anatol Belski
 - fileinfo: Backport xz detection fix in [86f79b299e](https://github.com/php/php-src/commit/86f79b299e)
 - fileinfo: Backport xz detection patch in [97f0d97d2a](https://github.com/php/php-src/commit/97f0d97d2a)
 - fileinfo: Add test for xz type in [292e10b14b](https://github.com/php/php-src/commit/292e10b14b)
 - NEWS: Add note for #11298 in [928fc68c9e](https://github.com/php/php-src/commit/928fc68c9e)
 - NEWS: Add note for #11298 in [4e8b1ddc53](https://github.com/php/php-src/commit/4e8b1ddc53)

### Andreas Heigl
 - Deprecate `ldap_connect` with two parameters in [GH-5177](https://github.com/php/php-src/pull/5177)

### Arnaud Le Blanc 💜
 - Add stack limit check in `zend_eval_const_expr()` in [GH-11424](https://github.com/php/php-src/pull/11424)
 - Expose time spent collecting cycles in `gc_status()` in [GH-11523](https://github.com/php/php-src/pull/11523)
 - Remove WeakMap entries whose key is only reachable through the entry value in [GH-10932](https://github.com/php/php-src/pull/10932)
 - Add AMPHP, ReactPHP, Revolt PHP to community job in [GH-10933](https://github.com/php/php-src/pull/10933)

### Athos Ribeiro
 - Fix [#79026](https://bugs.php.net/bug.php?id=79026): Allow `PHP_EXTRA_VERSION` overrides in [GH-11706](https://github.com/php/php-src/pull/11706)

### Bob Weinand
 - Fix [GH-11548](https://github.com/php/php-src/issues/11548) (Argument corruption when calling `XMLReader::open` or `XMLReader::XML` non-statically with observer active) in [cad47be8b6](https://github.com/php/php-src/commit/cad47be8b6)

### BohwaZ
 - [RFC] Transition SQLite3 to exceptions in [GH-11058](https://github.com/php/php-src/pull/11058)

### Cristian Rodríguez
 - proc_open: Use posix_spawn(3) interface on systems where it is profitable in [GH-7933](https://github.com/php/php-src/pull/7933)

### David CARLIER
 - `ext/intl`: intl_CharFromString using `zend_string_truncate` to adjust th… in [GH-11575](https://github.com/php/php-src/pull/11575)
 - zend stack: prepare `zend_call_stack_get` implementation for OpenBSD. in [GH-11578](https://github.com/php/php-src/pull/11578)
 - zend call stack fix freebsd code path. in [GH-11766](https://github.com/php/php-src/pull/11766)
 - zend vm savee registers support for riscv 64. in [GH-11773](https://github.com/php/php-src/pull/11773)

### David Carlier
 - zend call stack, follow-up on 75e9980 in [343b599747](https://github.com/php/php-src/commit/343b599747)
 - `zend_gdb` disable gdb detection for FreeBSD < 11 in [69b4360e88](https://github.com/php/php-src/commit/69b4360e88)

### Derick Rethans 💜
 - Import timelib 2022.08 in [c02ac26685](https://github.com/php/php-src/commit/c02ac26685)
 - Fix bug [GH-11600](https://github.com/php/php-src/issues/11600): Can't parse time strings which include (narrow) non-breaking space characters in [a4bdaeabf6](https://github.com/php/php-src/commit/a4bdaeabf6)
 - CS in [b669cb4c1b](https://github.com/php/php-src/commit/b669cb4c1b)
 - Make the new `DatePeriod::createFromISO8601String` method emit DateTimeImmutable objects in [82ff4c5e84](https://github.com/php/php-src/commit/82ff4c5e84)

### Dmitry Stogov
 - Fixed incorrect QM_ASSIGN elimination in [9fc0eab4b4](https://github.com/php/php-src/commit/9fc0eab4b4)
 - Fixed incorrect QM_ASSIGN elimination in [b5f8a7270a](https://github.com/php/php-src/commit/b5f8a7270a)

### Eno
 - Improve openssl ext to generate EC keys with custom EC parameters in [GH-9991](https://github.com/php/php-src/pull/9991)

### Filip Zrůst
 - Improve DTrace probe generation /w non-default compiler in [GH-11643](https://github.com/php/php-src/pull/11643)

### Gabriel Fontes
 - Add fallback value syntax for ini variables in [bc8b9aedf6](https://github.com/php/php-src/commit/bc8b9aedf6)
 - small fixes in [cd9dba81c7](https://github.com/php/php-src/commit/cd9dba81c7)

### George Peter Banyard 💜
 - Use binary safe case compare in new `zend_string` API in [eb5cc1372c](https://github.com/php/php-src/commit/eb5cc1372c)
 - Revert "Use binary safe case compare in new `zend_string` API" in [a342138e17](https://github.com/php/php-src/commit/a342138e17)
 - Add tests for uncastable streams and dataloss streams in [GH-10173](https://github.com/php/php-src/pull/10173)
 - Remove assert.bail INI setting usage in DOMDocument tests in [d510b5ae3e](https://github.com/php/php-src/commit/d510b5ae3e)
 - `ext/posix`: `posix_isatty()` fix use-of-uninitialized-value in [GH-11676](https://github.com/php/php-src/pull/11676)
 - `ext/intl`: Fix memory leak in `MessageFormatter::format()` in [GH-11658](https://github.com/php/php-src/pull/11658)
 - RFC: Deprecate remains of string evaluated code assertions in [GH-11671](https://github.com/php/php-src/pull/11671)
 - Deprecate passing a negative width to `mb_strimwidth()` in [af3c220abb](https://github.com/php/php-src/commit/af3c220abb)
 - Add support for deprecating class constants in [3e2dbbf9c2](https://github.com/php/php-src/commit/3e2dbbf9c2)
 - Deprecate `NumberFormater::TYPE_CURRENCY` constant in [d65251e6e8](https://github.com/php/php-src/commit/d65251e6e8)
 - [RFC] Path to Saner Increment/Decrement operators in [GH-10358](https://github.com/php/php-src/pull/10358)
 - `libxml_get_external_entity_loader()`: test for incompatible resource being loaded in [GH-11728](https://github.com/php/php-src/pull/11728)
 - Refactor BCMath bundledlib and extension in [GH-10774](https://github.com/php/php-src/pull/10774)
 - `ext/mysqli`: Remove custom `sys_get_temp_dir()` function in [17a80eb08b](https://github.com/php/php-src/commit/17a80eb08b)
 - `ext/mysqli`: Remove conditional function declaration in [0c21715935](https://github.com/php/php-src/commit/0c21715935)
 - `ext/mysqli`: Stop using global variable in connection test helper in [8582d97b8c](https://github.com/php/php-src/commit/8582d97b8c)
 - `ext/mysqli`: Remove catchable fatal error handler in [b389846d05](https://github.com/php/php-src/commit/b389846d05)

### Ilija Tovilo 💜
 - Fix `ext/zip` `arginfo.h` in [73cf12d6ac](https://github.com/php/php-src/commit/73cf12d6ac)
 - Fix mis-compilation of by-reference nullsafe operator in [GH-11540](https://github.com/php/php-src/pull/11540)
 - Fix missing "Optional parameter before required" deprecation on union null type in [GH-11497](https://github.com/php/php-src/pull/11497)
 - Fix serialization of RC1 objects appearing in object graph twice in [GH-11349](https://github.com/php/php-src/pull/11349)
 - xfail socket zerocopy test on Cirrus + arm in [GH-11553](https://github.com/php/php-src/pull/11553)
 - Attempt to fix `gh11498.phpt` on MSAN in [07dd0c80a8](https://github.com/php/php-src/commit/07dd0c80a8)
 - Revert "Fix [GH-9967](https://github.com/php/php-src/issues/9967) Add support for generating custom function, class const, and property attributes in stubs" in [ef4f08832c](https://github.com/php/php-src/commit/ef4f08832c)
 - Revert "Merge branch 'PHP-8.2'" in [7b355e8d34](https://github.com/php/php-src/commit/7b355e8d34)
 - Use waitpid(-1) over WAIT_ANY in [GH-11588](https://github.com/php/php-src/pull/11588)
 - Revert "Revert "Remove name field from the `zend_constant` struct (#10954)"" in [ad1b70d67e](https://github.com/php/php-src/commit/ad1b70d67e)
 - Revert "Fix test after reverted commit" in [188072a58f](https://github.com/php/php-src/commit/188072a58f)
 - Attempt to improve setup-slapd.sh stability in [GH-11590](https://github.com/php/php-src/pull/11590)
 - Retire AppVeyor in [GH-11566](https://github.com/php/php-src/pull/11566)
 - Fix trailing if element JMP lineno in [GH-11598](https://github.com/php/php-src/pull/11598)
 - Fix use-of-uninitialized-value with ??= on assert in [GH-11581](https://github.com/php/php-src/pull/11581)
 - Implement flaky test section in [GH-11325](https://github.com/php/php-src/pull/11325)
 - Fix incorrect handling of unwind and graceful exit exceptions in [GH-11608](https://github.com/php/php-src/pull/11608)
 - Skip `xleak` tests on asan in [GH-11610](https://github.com/php/php-src/pull/11610)
 - Refine skipif for cirrus+arm in [GH-11612](https://github.com/php/php-src/pull/11612)
 - Fix double-compilation of arrow-function in [GH-11632](https://github.com/php/php-src/pull/11632)
 - Fix `bug-gh11600.phpt` in [57229836d4](https://github.com/php/php-src/commit/57229836d4)
 - Always memoize assert in [GH-11686](https://github.com/php/php-src/pull/11686)
 - Fix missing iface class const inheritance type check in [7343ae5d3c](https://github.com/php/php-src/commit/7343ae5d3c)
 - Fix iface const visibility variance check in [d9db446065](https://github.com/php/php-src/commit/d9db446065)
 - Fix use-of-uninitialized-value when calling `php_posix_stream_get_fd` in [GH-11694](https://github.com/php/php-src/pull/11694)
 - Fix gc_status type info in [GH-11722](https://github.com/php/php-src/pull/11722)
 - Revert "Remove name field from the `zend_constant` struct (#10954)" in [GH-11604](https://github.com/php/php-src/pull/11604)
 - Fix clang warning in [GH-11729](https://github.com/php/php-src/pull/11729)
 - Use :- as ini interpolation fallback separator in [a48b977d3f](https://github.com/php/php-src/commit/a48b977d3f)
 - Always memoize calls in lhs of coalesce assignment in [GH-11592](https://github.com/php/php-src/pull/11592)
 - Resolve `open_basedir` paths on ini update in [GH-10987](https://github.com/php/php-src/pull/10987)
 - Fix `hash_pbkdf2` options parameter in [GH-11731](https://github.com/php/php-src/pull/11731)
 - Fix use-after-free when unregistering user stream wrapper from itself in [GH-11737](https://github.com/php/php-src/pull/11737)
 - Fix leaking definitions on `FFI::cdef()`->new() in [GH-11751](https://github.com/php/php-src/pull/11751)
 - Fix merge conflict in [ac99f7306c](https://github.com/php/php-src/commit/ac99f7306c)
 - Fix `open_basedir` leak in [GH-11780](https://github.com/php/php-src/pull/11780)
 - Call cast_object handler from get_properties_for in [GH-11583](https://github.com/php/php-src/pull/11583)
 - Replace xfail with skipif in `calendar_clear_variation1.phpt` in [GH-11801](https://github.com/php/php-src/pull/11801)
 - Fix uaf of MBSTRG(all_encodings_list) in [GH-11822](https://github.com/php/php-src/pull/11822)
 - Fix uouv in `array_column` in [2053af6628](https://github.com/php/php-src/commit/2053af6628)
 - Fix uouv in `password_needs_rehash()` and `password_hash()` in [a145b40fa6](https://github.com/php/php-src/commit/a145b40fa6)
 - Fix various uouv in intl in [322da7bcc3](https://github.com/php/php-src/commit/322da7bcc3)
 - Fix some uouv in `ext/pgsql` in [82aa4253f1](https://github.com/php/php-src/commit/82aa4253f1)

### Jakub Zelenka 💜
 - Fix [GH-11242](https://github.com/php/php-src/issues/11242): Use dynamic buffer for large length in stream mem copy in [4a5d13e205](https://github.com/php/php-src/commit/4a5d13e205)

### Jorg Adam Sowa
 - Extend tests of bcmath extension in [GH-11563](https://github.com/php/php-src/pull/11563)
 - Reorder list construction in the function php_intpow10 in [GH-11683](https://github.com/php/php-src/pull/11683)
 - Fix [GH-11761](https://github.com/php/php-src/issues/11761): Bcmath numbers with trailing zeros  in [GH-11798](https://github.com/php/php-src/pull/11798)

### Joshua Behrens
 - Warn when fpm socket was not registered on the expected path in [GH-11066](https://github.com/php/php-src/pull/11066)

### Juliette
 - GH Actions: auto-skip CI on PRs containing only docs changes in [GH-11839](https://github.com/php/php-src/pull/11839)

### Kévin Dunglas
 - tests(ext-curl): fix HTTP/2 Server Push tests in [GH-10669](https://github.com/php/php-src/pull/10669)

### Marc Bennewitz
 - `number_format()` Support rounding negative places in [GH-11487](https://github.com/php/php-src/pull/11487)
 - Prevent decimal int precision loss in `number_format()` in [GH-11584](https://github.com/php/php-src/pull/11584)
 - Prevent int overflow on $decimals in number_format in [GH-11714](https://github.com/php/php-src/pull/11714)

### Michael Orlitzky
 - Fix most external GD 2.3.3 compatibility in [GH-11257](https://github.com/php/php-src/pull/11257)
 - ext/session/tests: more lenient expected output checks. in [GH-11631](https://github.com/php/php-src/pull/11631)
 - ext/imap/tests/*mutf7*.phpt: update for missing utf8_to_mutf7() in [GH-11654](https://github.com/php/php-src/pull/11654)
 - ext/sockets/tests/mcast_ipv6_*.phpt: suppress no-ipv6 warning in [GH-11651](https://github.com/php/php-src/pull/11651)
 - Skip oci8 tests when no database is available in [GH-11820](https://github.com/php/php-src/pull/11820)

### Mikhail Galanin
 - Check if restart is pending before trying to lock SHM in [GH-11805](https://github.com/php/php-src/pull/11805)

### Máté Kocsis 💜
 - Add support for typed class constants in stubs in [3906bccc00](https://github.com/php/php-src/commit/3906bccc00)
 - Fix [GH-9967](https://github.com/php/php-src/issues/9967) Add support for generating custom function, class const, and property attributes in stubs in [d7ab0ff0c8](https://github.com/php/php-src/commit/d7ab0ff0c8)
 - Revert "Remove name field from the `zend_constant` struct (#10954)" in [9f4bd3040d](https://github.com/php/php-src/commit/9f4bd3040d)
 - Add support for extending multiple interfaces in the manual in [3c6590a391](https://github.com/php/php-src/commit/3c6590a391)
 - Display the readonly modifier for readonly classes in [4db4f0ba00](https://github.com/php/php-src/commit/4db4f0ba00)
 - Fix test after reverted commit in [0ce4f91d73](https://github.com/php/php-src/commit/0ce4f91d73)
 - Declare type for `ext/ffi` internal class constants in [6988973bc6](https://github.com/php/php-src/commit/6988973bc6)
 - Implement `DatePeriod::createFromISO8601String`() in [9c7c0a0b93](https://github.com/php/php-src/commit/9c7c0a0b93)
 - Deprecate calling `dba_fetch()` with $dba at the 3rd parameter in [134441efa9](https://github.com/php/php-src/commit/134441efa9)
 - Deprecate calling `FFI::cast()`, `FFI::new()`, and `FFI::type()` statically in [4acf0084dc](https://github.com/php/php-src/commit/4acf0084dc)
 - Deprecate calling `get_class()` and `get_parent_class()` without arguments in [1126232053](https://github.com/php/php-src/commit/1126232053)
 - Add `IntlCalendar::setDate()` and `IntlCalendar::setDateTime()` in [f236eb83b4](https://github.com/php/php-src/commit/f236eb83b4)
 - Implement `IntlGregorianCalendar::createFromDate()` and `IntlGregorianCalendar::createFromDateTime()` in [1486f52a12](https://github.com/php/php-src/commit/1486f52a12)
 - Implement `ldap_connect_wallet()` in [72aada3c7c](https://github.com/php/php-src/commit/72aada3c7c)
 - Implement `ldap_exop_sync` in [b3bd55f244](https://github.com/php/php-src/commit/b3bd55f244)
 - Make the $row param of `pg_fetch_result()`, `pg_field_prtlen()` and `pg_field_is_null()` nullable in [7ae0273ba3](https://github.com/php/php-src/commit/7ae0273ba3)
 - Deprecate `Phar::setStub`(resource $stub, int $length) in [840d665583](https://github.com/php/php-src/commit/840d665583)
 - Implement `ReflectionMethod::createFromMethodName()` in [f41220fe5d](https://github.com/php/php-src/commit/f41220fe5d)
 - Deprecate `ReflectionProperty::setValue()` with an incorrect 1st arg type in [d9a7f6741e](https://github.com/php/php-src/commit/d9a7f6741e)
 - Implement `stream_context_set_options()` in [a5ad7e09d5](https://github.com/php/php-src/commit/a5ad7e09d5)
 - Declare type for `ext/snmp` internal class constants in [1dcac9619c](https://github.com/php/php-src/commit/1dcac9619c)
 - Add UPGRADING note about SNMP class constant type declarations in [0f64b01aee](https://github.com/php/php-src/commit/0f64b01aee)
 - Fix misleading pass by reference error message in [GH-10639](https://github.com/php/php-src/pull/10639)
 - Use new class synopsis generating markup in [GH-11809](https://github.com/php/php-src/pull/11809)

### Niels Dossche
 - Fix [GH-11567](https://github.com/php/php-src/issues/11567): `mb_str_pad` causes access violation in [78d98e50c4](https://github.com/php/php-src/commit/78d98e50c4)
 - Fix [GH-11300](https://github.com/php/php-src/issues/11300): license issue: restricted unicode license headers in [GH-11572](https://github.com/php/php-src/pull/11572)
 - Remove always-false check in [45c93c173c](https://github.com/php/php-src/commit/45c93c173c)
 - Add negative test for isElementContentWhitespace() in [2aebca899c](https://github.com/php/php-src/commit/2aebca899c)
 - Add edge-case testcase for offset in DOMNamedNodeMap in [bccd924e3f](https://github.com/php/php-src/commit/bccd924e3f)
 - Add tests for DOMProcessingInstruction class in [f62757e74a](https://github.com/php/php-src/commit/f62757e74a)
 - Fix [GH-9628](https://github.com/php/php-src/issues/9628): Implicitly removing nodes from \DOMDocument breaks existing references in [GH-11576](https://github.com/php/php-src/pull/11576)
 - Cleanup macro usage in `ext/dom` and `ext/libxml` in [87e7b61d8f](https://github.com/php/php-src/commit/87e7b61d8f)
 - Implement [GH-10024](https://github.com/php/php-src/issues/10024): support linting multiple files at once using php -l in [GH-10024](https://github.com/php/php-src/pull/10024)
 - Fix replaced error handling in SQLite3Stmt::__construct in [GH-11607](https://github.com/php/php-src/pull/11607)
 - Fix [GH-10562](https://github.com/php/php-src/issues/10562): Memory leak and invalid state with consecutive `ftp_nb_fget` in [GH-11606](https://github.com/php/php-src/pull/11606)
 - Remove unused is_recursive entry in [1fbbd2b250](https://github.com/php/php-src/commit/1fbbd2b250)
 - Reserve less file space if possible in a directory entry in [00c1e7bf0f](https://github.com/php/php-src/commit/00c1e7bf0f)
 - Cache d_type in directory entry in [0b2e6bc2b0](https://github.com/php/php-src/commit/0b2e6bc2b0)
 - Fix crash when an invalid callback function is passed to CURLMOPT_PUSHFUNCTION in [GH-11639](https://github.com/php/php-src/pull/11639)
 - Fix return value of _php_server_push_callback in case of failure in [dc9adda653](https://github.com/php/php-src/commit/dc9adda653)
 - Add missing check on EVP_VerifyUpdate() in phar util in [GH-11640](https://github.com/php/php-src/pull/11640)
 - Avoid copying the stat buffer on a cache hit in [GH-11628](https://github.com/php/php-src/pull/11628)
 - Update type inference for `ZEND_GET_CLASS` and `ZEND_GET_CALLED_CLASS` in [838d80e7ee](https://github.com/php/php-src/commit/838d80e7ee)
 - Update type inference for `ZEND_STRLEN` in [3d944a367e](https://github.com/php/php-src/commit/3d944a367e)
 - Fix [GH-11625](https://github.com/php/php-src/issues/11625): `DOMElement::replaceWith()` doesn't replace node with DOMDocumentFragment but just deletes node or causes wrapping <></> depending on libxml2 version in [GH-11627](https://github.com/php/php-src/pull/11627)
 - Fix [GH-11629](https://github.com/php/php-src/issues/11629): `bug77020.phpt` tries to send mail in [GH-11636](https://github.com/php/php-src/pull/11636)
 - Fix [GH-11630](https://github.com/php/php-src/issues/11630): `proc_nice_basic.phpt` only works at certain nice levels in [GH-11635](https://github.com/php/php-src/pull/11635)
 - Remove always-true condition from `php_dom_iterator_move_forward()` in [a2fde39169](https://github.com/php/php-src/commit/a2fde39169)
 - Remove always-true condition from xml_utf8_decode() in [6d3433e60f](https://github.com/php/php-src/commit/6d3433e60f)
 - Cleanup `php_libxml_node_decrement_resource()` in [75229cb127](https://github.com/php/php-src/commit/75229cb127)
 - Fix tests for stat rdev in [6b87e08b82](https://github.com/php/php-src/commit/6b87e08b82)
 - Fix [GH-10914](https://github.com/php/php-src/issues/10914): OPCache with Enum and Callback functions results in segmentation fault in [GH-11675](https://github.com/php/php-src/pull/11675)
 - Add regression test for [GH-11682](https://github.com/php/php-src/issues/11682) in [48b246e038](https://github.com/php/php-src/commit/48b246e038)
 - Fix `bug-gh11600.phpt` to work with different ICU versions in [9c47f33a5f](https://github.com/php/php-src/commit/9c47f33a5f)
 - Implement `DOMNode::contains()` in [ea794e9cde](https://github.com/php/php-src/commit/ea794e9cde)
 - Avoid string allocation in dom_get_dom1_attribute() for as long as possible in [9880c336be](https://github.com/php/php-src/commit/9880c336be)
 - Avoid allocations in `DOMElement::getAttribute()` in [f04e5059bb](https://github.com/php/php-src/commit/f04e5059bb)
 - Handle fragments consisting out of multiple children without a single root correctly in [GH-11698](https://github.com/php/php-src/pull/11698)
 - Refactor `dom_node_node_name_read()` to avoid double allocation in [b3899eb569](https://github.com/php/php-src/commit/b3899eb569)
 - Implement `DOMElement::getAttributeNames()` in [10d7e8dc3a](https://github.com/php/php-src/commit/10d7e8dc3a)
 - Implement `DOMNode::getRootNode()` in [GH-11693](https://github.com/php/php-src/pull/11693)
 - Implement `DOMElement::className` in [GH-11691](https://github.com/php/php-src/pull/11691)
 - Implement `DOMParentNode::replaceChildren()` in [6560c9bf8e](https://github.com/php/php-src/commit/6560c9bf8e)
 - Fix ? in [e8f0bdc7f1](https://github.com/php/php-src/commit/e8f0bdc7f1)
 - Implement `DOMElement::id` in [GH-11701](https://github.com/php/php-src/pull/11701)
 - Prevent potential deadlock if accelerated globals cannot be allocated in [GH-11718](https://github.com/php/php-src/pull/11718)
 - Implement `DOMNode::isConnected` and `DOMNameSpaceNode::isConnected` in [GH-11677](https://github.com/php/php-src/pull/11677)
 - Implement `DOMNode::parentElement` and `DOMNameSpaceNode::parentElement` in [GH-11679](https://github.com/php/php-src/pull/11679)
 - Fix build on Windows in [c97507b5c1](https://github.com/php/php-src/commit/c97507b5c1)
 - Implement `DOMNode::isEqualNode()` in [GH-11690](https://github.com/php/php-src/pull/11690)
 - Implement `DOMElement::insertAdjacent`{Element,Text} in [GH-11700](https://github.com/php/php-src/pull/11700)
 - Split off some methods so they can be reused in different places in [5b5a3d79da](https://github.com/php/php-src/commit/5b5a3d79da)
 - Implement `DOMElement::toggleAttribute()` in [GH-11696](https://github.com/php/php-src/pull/11696)
 - Add new curl constants from curl until (including) 7.87 in [GH-10459](https://github.com/php/php-src/pull/10459)
 - Get rid of some unnecessary string conversion in [GH-11733](https://github.com/php/php-src/pull/11733)
 - Fix [GH-11715](https://github.com/php/php-src/issues/11715): opcache.interned_strings_buffer either has no effect or `opcache_get_status()` / phpinfo() is wrong in [GH-11717](https://github.com/php/php-src/pull/11717)
 - Fix [GH-11716](https://github.com/php/php-src/issues/11716): cli server crashes on SIGINT when compiled with `ZEND_RC_DEBUG`=1 in [GH-11757](https://github.com/php/php-src/pull/11757)
 - Use xmlSetNsProp when possible to prevent parsing the name in [c8964b9a08](https://github.com/php/php-src/commit/c8964b9a08)
 - Remove useless readonly checks in [dbe897b73e](https://github.com/php/php-src/commit/dbe897b73e)
 - Simplify configuration getters in [GH-11778](https://github.com/php/php-src/pull/11778)
 - Fix DOMEntity field getter bugs in [GH-11779](https://github.com/php/php-src/pull/11779)
 - Fix incorrect attribute existence check in `DOMElement::setAttributeNodeNS()` in [GH-11776](https://github.com/php/php-src/pull/11776)
 - Fix `DOMCharacterData::replaceWith()` with itself in [GH-11770](https://github.com/php/php-src/pull/11770)
 - Fix empty argument cases for DOMParentNode methods in [GH-11768](https://github.com/php/php-src/pull/11768)
 - Fix [GH-11791](https://github.com/php/php-src/issues/11791): Wrong default value of `DOMDocument::xmlStandalone` in [GH-11793](https://github.com/php/php-src/pull/11793)
 - Fix [GH-11792](https://github.com/php/php-src/issues/11792): LIBXML_NOXMLDECL is not implemented or broken in [GH-11794](https://github.com/php/php-src/pull/11794)
 - Fix DOM test in [bed0e54104](https://github.com/php/php-src/commit/bed0e54104)
 - Corrections to return type of loading DOM documents in [ae66a0d142](https://github.com/php/php-src/commit/ae66a0d142)
 - `XLEAK` XML_SAVE_NO_DECL test for old libxml2 versions in [655f116be5](https://github.com/php/php-src/commit/655f116be5)

### Peter Kokot
 - Fix [GH-11603](https://github.com/php/php-src/issues/11603): Set LDFLAGS in [GH-11605](https://github.com/php/php-src/pull/11605)
 - Fix [GH-9483](https://github.com/php/php-src/issues/9483): Autoconf warnings for newer Autoconf versions in [41a3573fcc](https://github.com/php/php-src/commit/41a3573fcc)
 - Update config.guess to 2023-06-23 and config.sub to 2023-06-26 in [GH-11711](https://github.com/php/php-src/pull/11711)
 - Fix Autoconf check for development versions in [GH-11532](https://github.com/php/php-src/pull/11532)
 - Remove unused `PHP_HASH` variable in [GH-11653](https://github.com/php/php-src/pull/11653)
 - Remove check for `time.h` and HAVE_TIME_H in [GH-11726](https://github.com/php/php-src/pull/11726)
 - Remove unused `ZEND_STACK_GROWS_DOWNWARDS` constant in [GH-11762](https://github.com/php/php-src/pull/11762)
 - Move --enable/--disable-fiber-asm help output in [GH-11827](https://github.com/php/php-src/pull/11827)

### Remi Collet
 - The `ZipArchive::FL_RECOMPRESS` constant is deprecated in [d8dd72fc31](https://github.com/php/php-src/commit/d8dd72fc31)
 - zip extension version 1.22.1 in [b406f7c67a](https://github.com/php/php-src/commit/b406f7c67a)
 - cast _private to avoid [-fpermissive] error in [fde4386648](https://github.com/php/php-src/commit/fde4386648)
 - add `ZipArchive::LENGTH_TO_END` and `ZipArchive::LENGTH_UNCHECKED` constants in [0893b4bed5](https://github.com/php/php-src/commit/0893b4bed5)
 - use typed constants in 8.3 in [ae3646db48](https://github.com/php/php-src/commit/ae3646db48)

### SakiTakamachi
 - Fix [GH-11587](https://github.com/php/php-src/issues/11587) `PDO::ATTR_STRINGIFY_FETCHES` should return strings even in if `PDO::ATTR_EMULATE_PREPARES` is enabled in [GH-11622](https://github.com/php/php-src/pull/11622)

### Tim Düsterhus
 - RFC: Add #[Override] attribute in [GH-9836](https://github.com/php/php-src/pull/9836)
 - Deprecate MT_RAND_PHP in [GH-11560](https://github.com/php/php-src/pull/11560)

### Yurun
 - Fix incorrect function/method names in DBG_ENTER() in [GH-11554](https://github.com/php/php-src/pull/11554)

### eater
 - `ext/gettext`: resolve underqouting that breaks with autoconf 2.72 in [GH-11427](https://github.com/php/php-src/pull/11427)

### tekimen
 - Fix warning `crc32.c` on function declaration without a prototype. in [GH-11742](https://github.com/php/php-src/pull/11742)
 - Fix [GH-11785](https://github.com/php/php-src/issues/11785): '++nothing+crc' is not a recognized feature for M1 / M2 macOS compile target in [GH-11796](https://github.com/php/php-src/pull/11796)



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


