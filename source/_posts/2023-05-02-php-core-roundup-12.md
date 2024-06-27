
---
title: 'PHP Core Roundup #12'
layout: post
tags:
    - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 02 May 2023

---

The PHP Foundation is a collective of PHP contributors, veterans, and companies that collaborate to ensure the long-term sustainability of the PHP programming language. Started over a year ago, the PHP Core Roundup series deliver a summary of the latest developments, discussions, and news about PHP Core made by both PHP Foundation members and other contributors. This post is the twelfth in the PHP Core Roundup series.

> The PHP Foundation currently supports six part-time PHP contributors who work on maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.

<br>
We publish the posts on our website, and you can subscribe to a newsletter; You don’t necessarily have to be a PHP Foundation backer to follow _PHP Core Roundup_.

{% include "newsletter.html" %}

## PHP 8.3 Release Managers Elected

Release managers for PHP 8.3 were elected from a vote that ended on April 16.

**Pierrick Charron**, one of the PHP 8.2 release managers stepped in to be the veteran release manager, and **Jakub Zelenka 💜** and **Calvin Buckley** were elected as the "rookie" release managers. Jakub Zelenka is one of the PHP Foundation members.

Release managers are responsible for triaging bugs and security vulnerabilities, signing and releasing tagged PHP releases, communication, and other management tasks until the PHP version reaches its End-Of-Life.


## Discussions on PHP Governance and Communication

During the last month, there were several mailing list discussions about PHP governance and communication. These lengthy discussions lead to an RFC (currently in vote) to form a "PHP Technical Committee", and a discussion on moving PHP Internals mailing list to GitHub issues and discussions. 

While the PHP Foundation seeks the long-term sustainability of the PHP project by funding full-time and part-time PHP contributors and acting as a collective for other PHP initiatives, the RFC for the technical committee and the discussion on moving the PHP Internals mailing list to GitHub remained the discussion of all PHP contributors.

The [Technical Committee RFC](https://wiki.php.net/rfc/php_technical_committee) intends to form an elected group of PHP contributors who will focus on PHP internal changes. User-facing changes such as PHP APIs would still go through the current RFC voting process. [RFC discussion](https://externals.io/message/119829) and an [in-vote discussion](https://externals.io/message/120151) provide more context. Jakub also emailed the PHP Internals with [Current RFC process and project decisions](https://externals.io/message/120167) to provide more information.

[Moving PHP internals to GitHub](https://externals.io/message/119955) is also a lengthy discussion on highlighting some of the flaws of the current mailing list approach to discussions, and proposing to use GitHub Discussions and issues for the communication amongst PHP contributors and users. 


## Recent RFCs and Mailing List Discussions

> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

### RFC Updates

Following are the RFCs and major pull-requests discussed, voted on, and implemented since our last update.

- **RFC In Vote: [PHP Technical Committee](https://wiki.php.net/rfc/php_technical_committee) by Jakub Zelenka 💜 and Larry Garfield**
  
  As mentioned above, proposes to establish a technical committee to take decisions on PHP internal API changes and other technical aspects.

- **RFC Under [Discussion](https://externals.io/message/120146): [Deprecate functions with overloaded signatures](https://wiki.php.net/rfc/deprecate_functions_with_overloaded_signatures) by Máté Kocsis 💜**
  
  PHP does not support method overloading similar to Swift or Java. However, there are some internal PHP functions and methods that accept multiple function/method signatures that behave differently. For example, the `session_set_save_handler` function accepts several `callable` parameters **_or_** a single `SessionHandlerInterface` implementation.

  While there are historical reasons for those internal functions to provide multiple signatures, part of of the long-term language streamlining goals of PHP is to get rid of these inconsistencies. This RFC proposes to deprecate several overloaded functions and methods. For each of the deprecated signatures, the RFC proposes a new function or a method, or to eventually remove the deprecated signature in the next major PHP version (PHP 9.0 as for now).
 
- **RFC Under [Discussion](https://externals.io/message/120048): [Clone with](https://wiki.php.net/rfc/clone_with) by Máté Kocsis 💜**
  
  Proposes a new "clone with" construct to PHP to address to too strict nature of `readonly` properties. As of PHP 8.2, `readonly` properties can be too strict and do not provide the means to create immutable objects that remain immutable at an object level, because cloned objects remain read-only too.

   ```php
   class Response implements ResponseInterface {
       public readonly int $statusCode;
       public readonly string $reasonPhrase;
       // ...
       public function withStatus($code, $reasonPhrase = ''): Response
       {
           return clone $this with {
               statusCode: $code,
               reasonPhrase: $reasonPhrase
           };
       }
       // ...
   }

   $response = new Response(200);
   $response->withStatus(201)->withStatus(202);
   ```

<br />

- **RFC Under [Discussion](https://externals.io/message/119851): [New core autoloading mechanism with support for function autoloading](https://wiki.php.net/rfc/core-autoloading) by Gina Peter Banyard 💜 and Dan Ackroyd**
  
  PHP has had support for class autoloading since PHP 5 and it is an extremely useful feature that is relied on to only load classes that are being used within the current request. However, the current autoloading mechanism does not support autoloading functions.

   The need for such a feature seems very clear as users will create “helper” classes with static methods to take advantage of autoloading via the class autoloading mechanism.

   The proposal consists of adding a better designed class autoloading mechanism and a new function autoloading mechanism, and aliasing the existing autoload functions to the new versions. The proposal does _not_ include a default implementation for either the class or the function autoloading mechanism.

  Eight newly proposed `autoload_(register|unregister|call|list)_(class|function)` functions will be used to register, unregister, call, and list autoloaders for both classes and functions. Existing `spl_*` functions are proposed to be aliased to the new functions.

   Further, `function_exists` will get a new parameter `$autoload` similar to `class_exists()` to trigger the autoloader if necessary.
  
- **RFC Accepted : [Arbitrary static variable initializers](https://wiki.php.net/rfc/arbitrary_static_variable_initializers) by Ilija Tovilo 💜**
  
  PHP does not allow using arbitrary expressions in static variable initializers because the values are initialized at the compile time. This also lead to some unexpected behaviors when the same variable is initialized in more than once within the same scope.

  This RFC proposes to remove the current limitation of not allowing expressions in static variable initializers. It also forbids redeclaring static variables altogether.

  ```php
   function foo() {
     static $i = getValue();
   }
   ```

   This RFC was accepted by the vote, and will be implemented in PHP 8.3.

- **RFC Implemented: [Make unserialize() emit a warning for trailing bytes](https://wiki.php.net/rfc/unserialize_warn_on_trailing_data) by Tim Düsterhus**
  
  This RFC proposes that [`unserialize()`](http://www.php.net/unserialize) shall emit a new `E_WARNING` whenever the input string contains additional bytes once the unserialization parser terminates after successfully parsing a value. In other words: A warning shall be emitted if bytes can be removed from the end of the input string without changing the return value of [`unserialize()`](http://www.php.net/unserialize).
  
  The RFC vote unanimously accepted this change, and it is already implemented for PHP 8.3.

 
### Notable Mailing List Discussions

- [Final anonymous classes](https://externals.io/message/120118)
- [[Discussion] Callable types via Interfaces](https://externals.io/message/120083)
- [Expansion of PHP Symbols?](https://externals.io/message/120094)
- [Future stability of PHP?](https://externals.io/message/119834)
- [Moving PHP internals to GitHub](https://externals.io/message/119955)
- [Brainstorming idea: inline syntax for lexical (captured) variables](https://externals.io/message/119696)
- [Possible RFC: `$_SERVER['REQUEST_TIME_FLOAT']` ](https://externals.io/message/119948)
- [[RFC] PHP Technical Committee](https://externals.io/message/119829)
- [Array spread append ](https://externals.io/message/119818)
- [PHP Modules ](https://externals.io/message/119893)
- [Property Hooks Discussion ](https://externals.io/message/119807)


## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes, the PHP core developers review all pull requests.
 
---

### Full list of commits since [PHP Core Roundup #11](/blog/2023/04/01/php-core-roundup-11/)

<details markdown="1">
  <summary>Click here to expand</summary>

 - Fix [GH-8841](https://github.com/php/php-src/issues/8841): php-cli core dump calling a badly formed function in [GH-10989](https://github.com/php/php-src/pull/10989) by Niels Dossche
 - Fix [GH-10990](https://github.com/php/php-src/issues/10990): `mail()` throws `TypeError` after iterating over `$additional_headers` array by reference in [GH-10991](https://github.com/php/php-src/pull/10991) by Niels Dossche
 - Fix [GH-10983](https://github.com/php/php-src/issues/10983): State-dependant segfault in `ReflectionObject::getProperties` in [GH-10984](https://github.com/php/php-src/pull/10984) by Niels Dossche
 - Remove `XFAIL` from test cases for `mb_strcut` when used with JIS or ISO-2022-JP encoding in [c211e67b4e](https://github.com/php/php-src/commit/c211e67b4e) by Alex Dowad
 - Add ASAN `XLEAK` support in [GH-10996](https://github.com/php/php-src/pull/10996) by Ilija Tovilo 💜
 - Fix `add_function_array()` assertion when op2 contains op1 in [GH-10975](https://github.com/php/php-src/pull/10975) by Ilija Tovilo 💜
 - Add `zend_alloc` `XLEAK` support in [GH-10999](https://github.com/php/php-src/pull/10999) by Ilija Tovilo 💜
 - Tracing JIT: Fixed incorrect code generation for SEND-ing of result of ASSIGN to typed reference in [8a749c79d0](https://github.com/php/php-src/commit/8a749c79d0) by Dmitry Stogov
 - Fix incorrect error handling in `dom_zvals_to_fragment()` in [GH-10981](https://github.com/php/php-src/pull/10981) by Niels Dossche
 - Add forgotten upgrading note for the Readonly amendments RFC in [0a169cbd5b](https://github.com/php/php-src/commit/0a169cbd5b) by Máté Kocsis 💜
 - Remove name field from the `zend_constant` struct in [GH-10954](https://github.com/php/php-src/pull/10954) by Máté Kocsis 💜
 - Cleanup pubkey checks in `ext/phar` in [GH-11009](https://github.com/php/php-src/pull/11009) by Niels Dossche
 - [Zend]: Fix unnecessary alignment in `ZEND_CALL_FRAME_SLOT` macro in [GH-10988](https://github.com/php/php-src/pull/10988) by Tony Su
 - Add ngx-php to opcache supported sapis in [GH-11013](https://github.com/php/php-src/pull/11013) by Joan Miquel
 - Delay freeing of overwritten values in assignments in [915b2837f7](https://github.com/php/php-src/commit/915b2837f7) by Dmitry Stogov
 - Add various tests for [GH-10168](https://github.com/php/php-src/issues/10168) in [f43fa59171](https://github.com/php/php-src/commit/f43fa59171) by Ilija Tovilo 💜
 - Delay destructor for `zend_assign_to_typed_ref` in [b39107c774](https://github.com/php/php-src/commit/b39107c774) by Ilija Tovilo 💜
 - Delay destructor for `zend_std_write_property` in [24acb4f134](https://github.com/php/php-src/commit/24acb4f134) by Dmitry Stogov
 - Add `GC_DTOR`/`GC_DTOR_NO_REF` macros in [fdbea4f39e](https://github.com/php/php-src/commit/fdbea4f39e) by Ilija Tovilo 💜
 - JIT support for delayed destructor for `zend_assign_to_typed_ref`/`prop` in [e1c6fb76c0](https://github.com/php/php-src/commit/e1c6fb76c0) by Dmitry Stogov
 - Add note for [GH-10168](https://github.com/php/php-src/issues/10168) to `UPGRADING.INTERNALS` in [3528ca8930](https://github.com/php/php-src/commit/3528ca8930) by Ilija Tovilo 💜
 - Remove includes in [d5484bf115](https://github.com/php/php-src/commit/d5484bf115) by Dmitry Stogov
 - Re-add `GC_DTOR` and `GC_DTOR_NO_REF` in [c796ce5713](https://github.com/php/php-src/commit/c796ce5713) by Dmitry Stogov
 - Fix [GH-9397](https://github.com/php/php-src/issues/9397): exif read : warnings and errors : Potentially invalid endianess, Illegal IFD size and Undefined index in [GH-10470](https://github.com/php/php-src/pull/10470) by Niels Dossche
 - Add separate static property through trait if parent already declares it in [GH-10937](https://github.com/php/php-src/pull/10937) by Ilija Tovilo 💜
 - Use `zend_call_known_instance_method()` instead of building FCI/FCC in serializer subroutine in [GH-9955](https://github.com/php/php-src/pull/9955) by Gina Peter Banyard 💜
 - Extract common code for phar IO intercept functions in [3fb63f7fa2](https://github.com/php/php-src/commit/3fb63f7fa2) by Gina Peter Banyard 💜
 - size variable is only used once, move closer to usage in [96ffdd492c](https://github.com/php/php-src/commit/96ffdd492c) by Gina Peter Banyard 💜
 - Improve locality of stream variable in [06896d1c45](https://github.com/php/php-src/commit/06896d1c45) by Gina Peter Banyard 💜
 - Use `zend_string_concat` helper instead of `strpprintf` in [8e51cfe0ae](https://github.com/php/php-src/commit/8e51cfe0ae) by Gina Peter Banyard 💜
 - Convert `char*` + `size_t` parameters to `zend_string*` in `phar_find_in_include_path()` in [7d93ef067f](https://github.com/php/php-src/commit/7d93ef067f) by Gina Peter Banyard 💜
 - Add FPM FastCGI env var test for Apache without path info fix in [15802dfc62](https://github.com/php/php-src/commit/15802dfc62) by Jakub Zelenka 💜
 - Fix number of elements after packed hash filling in [GH-11022](https://github.com/php/php-src/pull/11022) by Niels Dossche
 - Fix [GH-11016](https://github.com/php/php-src/issues/11016): Heap buffer overflow in `ZEND_ADD_ARRAY_UNPACK_SPEC_HANDLER` in [GH-11021](https://github.com/php/php-src/pull/11021) by Niels Dossche
 - Add FPM FCGI env Apache handler UDS test in [ebb3213f79](https://github.com/php/php-src/commit/ebb3213f79) by Jakub Zelenka 💜
 - Fixed tests and remove the `XFAIL` 'Various bugs exist'. They did, but they were in the tests in [e67bb14ab4](https://github.com/php/php-src/commit/e67bb14ab4) by Derick Rethans 💜
 - Fix [GH-10737](https://github.com/php/php-src/issues/10737): PHP 8.1.16 segfaults on line 597 of `sapi/apache2handler/sapi_apache2.c` in [GH-10863](https://github.com/php/php-src/pull/10863) by Niels Dossche
 - Use `zend_string` for DBA path in [GH-10698](https://github.com/php/php-src/pull/10698) by Gina Peter Banyard 💜
 - `ext/sockets` adding FreeBSD's `SO_REUSEPORT_LB` constant in [6c532df705](https://github.com/php/php-src/commit/6c532df705) by David CARLIER
 - Add case insensitive versions of the `zend_string_starts_with_*` APIs in [GH-11032](https://github.com/php/php-src/pull/11032) by Gina Peter Banyard 💜
 - `ext/phar`: Prevent unnecessary known string length computation in [GH-11033](https://github.com/php/php-src/pull/11033) by Gina Peter Banyard 💜
 - `ext/phar`: Remove duplicate cleaning-up code in [4082d425a9](https://github.com/php/php-src/commit/4082d425a9) by Gina Peter Banyard 💜
 - Fix unevaluated rhs of class constant fetch in constant expression in [GH-11047](https://github.com/php/php-src/pull/11047) by Ilija Tovilo 💜
 - Remove unneeded occurrences of my name in `UPGRADING` in [d64c7184d4](https://github.com/php/php-src/commit/d64c7184d4) by Alex Dowad
 - Add more details to `NEWS` on `mb_detect_encoding`; also include in UPGRADING in [aa51871adc](https://github.com/php/php-src/commit/aa51871adc) by Alex Dowad
 - Add additional note on `mb_encode_mimeheader` in `UPGRADING` in [a62d192ede](https://github.com/php/php-src/commit/a62d192ede) by Alex Dowad
 - Add more details in `UPGRADING` on `mb_check_encoding` changes in [7cef7cb0ee](https://github.com/php/php-src/commit/7cef7cb0ee) by Alex Dowad
 - Allow `FETCH_OBJ_W` and `FETCH_STATIC_PROP_W` to return `INDIRECT`/`UNDEF` zval for uninitialized typed properties in [GH-11048](https://github.com/php/php-src/pull/11048) by Dmitry Stogov
 - `ext/curl`: Protocol should be a case insensitive check in [GH-11052](https://github.com/php/php-src/pull/11052) by Gina Peter Banyard 💜
 - Use curl from brew on MacOS CI in [GH-11056](https://github.com/php/php-src/pull/11056) by Jakub Zelenka 💜
 - Improve ini number handling with `INI_SCANNER_TYPED` in [GH-11014](https://github.com/php/php-src/pull/11014) by Ilija Tovilo 💜
 - `ext/phar`: Fix recently introduced potential `NULL` dereferencement segfaults in [GH-11065](https://github.com/php/php-src/pull/11065) by Gina Peter Banyard 💜
 - Optimize `HT_HASH_RESET` in [GH-11059](https://github.com/php/php-src/pull/11059) by Niels Dossche
 - `mb_parse_str`, `mb_http_input`, and `mb_convert_variables` use fast text conversion code for automatic encoding detection in [6df7557e43](https://github.com/php/php-src/commit/6df7557e43) by Alex Dowad
 - Remove unnecessary memory clearing in virtual_file_ex() in [GH-10963](https://github.com/php/php-src/pull/10963) by Niels Dossche
 - Fix test `bug60120.phpt` in [GH-11064](https://github.com/php/php-src/pull/11064) by Ilija Tovilo 💜
 - `xxhash.h`: Fix GCC 12 -Og in [GH-11062](https://github.com/php/php-src/pull/11062) by Mingli Yu
 - Add benchmarking to CI in [GH-11068](https://github.com/php/php-src/pull/11068) by Ilija Tovilo 💜
 - Restrict benchmarking push to php org in [d126031728](https://github.com/php/php-src/commit/d126031728) by Ilija Tovilo 💜
 - Fix commit sha in commit name in [8d5e06dc94](https://github.com/php/php-src/commit/8d5e06dc94) by Ilija Tovilo 💜
 - Micro-optimize double comparison in [GH-11061](https://github.com/php/php-src/pull/11061) by Niels Dossche
 - Fix commit hash really this time in [f4ede230cd](https://github.com/php/php-src/commit/f4ede230cd) by Ilija Tovilo 💜
 - Fix [GH-11028](https://github.com/php/php-src/issues/11028): Heap Buffer Overflow in `zval_undefined_cv` in [GH-11083](https://github.com/php/php-src/pull/11083) by Niels Dossche
 - Add `zend_test_crash` funtion to segfault PHP process in [GH-11082](https://github.com/php/php-src/pull/11082) by Jakub Zelenka 💜
 - Benchmarking mean in [GH-11085](https://github.com/php/php-src/pull/11085) by Ilija Tovilo 💜
 - Fix uninitialized variable compile error in [2044e5aea0](https://github.com/php/php-src/commit/2044e5aea0) by Ilija Tovilo 💜
 - Fix CI benchmarking diff in [af809ef028](https://github.com/php/php-src/commit/af809ef028) by Ilija Tovilo 💜
 - Add missing `zend_test_crash` message initialization in [84be9042f9](https://github.com/php/php-src/commit/84be9042f9) by Jakub Zelenka 💜
 - fpm: remove 2 unneeded newlines from zlog call in [581e729e8d](https://github.com/php/php-src/commit/581e729e8d) by Sjon Hortensius
 - Support enums in array_unique in [GH-11015](https://github.com/php/php-src/pull/11015) by Ilija Tovilo 💜
 - Typed class constants in [GH-10444](https://github.com/php/php-src/pull/10444) by Máté Kocsis 💜
 - `ext/openssl`: pass ini options to extra processes in tests in [5a4083181b](https://github.com/php/php-src/commit/5a4083181b) by Jakub Holubansky
 - Fix uninitialized memory in `parse_ini_string()` in [GH-11092](https://github.com/php/php-src/pull/11092) by Ilija Tovilo 💜
 - Fix [GH-11071](https://github.com/php/php-src/issues/11071): Revert "Fix [-Wundef] warning in INTL extension" in [31e21f7dbc](https://github.com/php/php-src/commit/31e21f7dbc) by Remi Collet
 - Import timelib 2022.06 in [44eef677b0](https://github.com/php/php-src/commit/44eef677b0) by Derick Rethans 💜
 - Fixed tests in [cc7b799c44](https://github.com/php/php-src/commit/cc7b799c44) by Derick Rethans 💜
 - Add NEWS entry in [1dcab8a534](https://github.com/php/php-src/commit/1dcab8a534) by Derick Rethans 💜
 - Fix mysql tests with non-standard server port in [GH-9744](https://github.com/php/php-src/pull/9744) by Michael Voříšek
 - Bump OCI8 version to make a PECL release for 8.2 in [91d3aaaa93](https://github.com/php/php-src/commit/91d3aaaa93) by Christopher Jones
 - Fix reference returned from `CallbackFilterIterator::accept()` in [5855bdcd6c](https://github.com/php/php-src/commit/5855bdcd6c) by Ilija Tovilo 💜
 - Fix `-Wenum-int-mismatch` warnings on gcc 13 in [GH-11103](https://github.com/php/php-src/pull/11103) by Ilija Tovilo 💜
 - Fix incorrect `CG(memoize_mode)` state after bailout in `??=` in [GH-11109](https://github.com/php/php-src/pull/11109) by Ilija Tovilo 💜
 - ci update freebsd image to the 13.2 image in [GH-11110](https://github.com/php/php-src/pull/11110) by David CARLIER
 - Import timelib 2022.07 to address OSS fuzz issue in [629d7740e8](https://github.com/php/php-src/commit/629d7740e8) by Derick Rethans 💜
 - `ext/intl`: deprecate `U_MULTIPLE_DECIMAL_SEPERATORS` constant in [976d7ed4c6](https://github.com/php/php-src/commit/976d7ed4c6) by David CARLIER
 - Allow CTE on basic type/math functions in [GH-10842](https://github.com/php/php-src/pull/10842) by Michael Voříšek
 - Allow array functions to operate in-place if the `refcount` is 1 in [GH-11060](https://github.com/php/php-src/pull/11060) by Niels Dossche
 - Set `error_log` to an empty value if the test relies on that feature in [GH-10772](https://github.com/php/php-src/pull/10772) by Niels Dossche
 - Add test to make sure that readonly properties cannot be reassigned by invoking the `__clone()` method directly in [04a5f2b11f](https://github.com/php/php-src/commit/04a5f2b11f) by Máté Kocsis 💜
 - Minor conditions simplify in [GH-10397](https://github.com/php/php-src/pull/10397) by Michael Voříšek
 - Fix incorrect match default branch optimization in [GH-11135](https://github.com/php/php-src/pull/11135) by Ilija Tovilo 💜
 - `ext/sockets`: addig Linux's `IP_BIND_ADDRESS_NO_PORT` in [7b4b40f06f](https://github.com/php/php-src/commit/7b4b40f06f) by David Carlier
 - Fix ZPP of `pg_lo_export()` in [GH-11132](https://github.com/php/php-src/pull/11132) by Máté Kocsis 💜
 - Fix [GH-9344](https://github.com/php/php-src/issues/9344): pgsql pipeline mode proposal in [6a9061e0af](https://github.com/php/php-src/commit/6a9061e0af) by David CARLIER
 - Propagate `STREAM_DISABLE_OPEN_BASEDIR` src flag to `php_stream_stat_path_ex` in [GH-11156](https://github.com/php/php-src/pull/11156) by Ilija Tovilo 💜
 - Allow aliasing namespaces containing reserved class names in [GH-11153](https://github.com/php/php-src/pull/11153) by Ilija Tovilo 💜
 - Fix uninitialised variable warning in `mbfilter_sjis.c` in [b915a1d8d7](https://github.com/php/php-src/commit/b915a1d8d7) by Niels Dossche
 - Update libenchant in arm build in [5cbc917fee](https://github.com/php/php-src/commit/5cbc917fee) by Ilija Tovilo 💜



</details>


<br>

---

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 

