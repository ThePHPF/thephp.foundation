
---
title: 'PHP Core Roundup #3'
layout: post
tags:
    - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 30 June 2022
---

Welcome back to the _PHP Core Roundup_ series, where we make regular updates on the improvements made to PHP by the _PHP Foundation_ and other contributors. 

In this edition, we have news about PHP 8.2 that is only three weeks away from its feature-freeze, and several improvements made by the PHP Foundation team and contributors.

You don’t necessarily have to be a PHP Foundation backer to follow the PHP Roundup. We’ll be publishing the posts on our website, and you can subscribe to the newsletter:

{% include "newsletter.html" %}


> [The PHP Foundation](https://opencollective.com/phpfoundation) currently supports [six part-time PHP contributors](https://thephp.foundation/blog/2022/05/06/interview-with-core-developers/) who work on both maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.
> 
>
> Things marked with 💜 are done by the PHP Foundation team.

<br />

## PHP 8.2 QA Releases and Feature-freeze

The upcoming PHP 8.2 version is scheduled to be released on **November 24**. The newly [elected PHP 8.2 release managers](https://thephp.foundation/blog/2022/05/30/php-core-roundup-2/#php-8.2-release-managers) made the first QA release of PHP 8.2 — PHP 8.2 Alpha 1 — on June 09, and the second alpha release on June 23. 

These alpha releases are not meant for any production servers, but serve as point releases for testing environments and local development setups.

Compiled Windows binaries are available at [windows.php.net/qa](https://windows.php.net/qa/), [Docker images](https://hub.docker.com/_/php?tab=tags&page=1&name=8.2.0) are available at Docker Hub, and source code at [php/php-src repository on GitHub](https://github.com/php/php-src) to compile yourself. On Homebrew, PHP 8.2-dev packages are available from [`shivammathur/php`](https://github.com/shivammathur/homebrew-php) tap.

**July 19** is the PHP 8.2 Feature-Freeze date. The window for submitting major changes to PHP 8.2 ends on this date. PHP follows a two week discussion period and a two week voting period. All RFCs must be voted (and passed) before the feature-freeze to be included in PHP 8.2. 


## RFC Updates

Following are the RFCs discussed, voted, and implemented since our last update. 


* **Implemented: [Allow null and false as stand-alone types](https://wiki.php.net/rfc/null-false-standalone-types) 💜**

    RFC by George Peter Banyard proposed to allow null and false as standalone types in PHP. With the addition of Union Types in PHP 8.0, it was possible to declare a Union Type with `null` and `false`, but not as stand-alone types. With this change, it is now possible to declare class properties, parameters, and return types with `null` and `false` as stand-alone types. They are already reserved keywords in PHP, and this change is highly unlikely to cause any backwards compatibility issues. 


    Learn more about this RFC in [PHP Internals News Podcast #99](https://phpinternals.news/99) **💜**, hosted by Derick Rethans, and on [PHP.Watch](https://php.watch/versions/8.2/null-false-types).

* **Implemented: [Add true type](https://wiki.php.net/rfc/true-type) 💜**

    Another RFC by George Peter Banyard proposes to add `true` as a valid and standalone type to PHP. This RFC, along with RFC to allow `null` and `false` as standalone types, makes PHP’s type system more expressive and precise. 


    Learn more about this RFC in [PHP Internals News Podcast #102](https://phpinternals.news/102), hosted by Derick Rethans, and on [PHP.Watch](https://php.watch/versions/8.2/true-type).

* **Accepted: Random Extension 5.x**

    Random Extension 5.x RFC, as the name implies, is the fifth iteration of the RFC proposed by Go Kudo to improve PHP’s Random Number Generator (RNG). It proposes a series of changes starting from moving the RNG to a separate PHP extension, and providing multiple choices of the RNGs in an object-oriented API pattern. It does not propose to change the existing user-land `random_int` and `random_bytes` functions, but rather refactor the internals of the RNG.


    There is a [follow-up RFC](https://wiki.php.net/rfc/random_extension_improvement) currently being discussed to make further improvements to it.

* **Accepted: [Expand deprecation notice scope for partially supported callables](https://wiki.php.net/rfc/partially-supported-callables-expand-deprecation-notices)**

    Juliette Reinders Folmer’s RFC that follows up on the [Deprecate partially supported callables RFC](https://wiki.php.net/rfc/deprecate_partially_supported_callables) (implemented in PHP 8.2) to widen the scope of the deprecation to include `is_callable` function and when type verification is executed on the `callable` type was accepted.


    Learn more about this RFC from the [PHP Internals News Podcast #101](https://phpinternals.news/101) hosted by Derick Rethans**.**

* **Accepted: [Disjunctive Normal Form Types](https://wiki.php.net/rfc/dnf_types) 💜**

    Yet another RFC by George Peter Banyard that proposes to add Disjunctive Normal Form types to the language. 


    PHP has support for Union Types (`foo|bar`) since PHP 8.0, and Intersection Types (`foo&bar`) since PHP 8.1. The DNF Types RFC proposes to add support for combining Union and Intersection types to declare a type in a canonical form. 


    This RFC is currently in voting, with a majority of votes in favor. With only two days left on the vote, it is highly likely that this RFC will pass.

    Learn more about this RFC from the [PHP Internals News Podcast #103](https://phpinternals.news/103) hosted by Derick Rethans.

* **Under Discussion: [New Curl URL API](https://wiki.php.net/rfc/curl-url-api)**

    RFC by Pierrick Charron discusses improvements to the Curl extension including the possibility to introduce a new `CurlUrl` class to build, query, and validate a URL using the same mechanisms Curl uses.

* **Under Discussion: [Fetch properties of enums in const expressions](https://wiki.php.net/rfc/fetch_property_in_const_expressions) 💜**

    Ilija Tovilo proposes to add support to fetch Enum properties in constant expressions. In PHP Enums, each enumerated member has name and value properties. 


    ```php
  const VALUE = 'value';
  const C = E::Foo->name;
  const C = E::Foo->{VALUE};
  function foo($param = E::Foo->value) {}

  #[Attr(E::Foo->name)]
  class C {}
  ```
  <br />
	 The RFC is to allow expressions above and other similar patterns, which are not currently allowed.

* **Under Discussion: [PDO driver specific sub-classes](https://wiki.php.net/rfc/pdo_driver_specific_subclasses)**

    RFC by Dan Ackroyd proposes to add new subclasses (with PDO as the parent) for individual database drivers so they can introduce their own additions to the PDO class easily. Some of the use cases mentioned in the RFC include PostgreSQL and Sqlite drivers that could declare methods to functionality that are unique to that software. 

* **Under Discussion: [Make the iterator_*() family accept all iterables ](https://wiki.php.net/rfc/iterator_xyz_accept_array)**

    RFC by Tim Düsterhus proposes to widen the type of $iterator parameter of `iterator_to_array()` and `iterator_count()` functions to iterable, from the current type \Traversable. The difference is that the `iterable` type includes array type as well (i.e `\Traversable|array`). By widening the parameter type, these functions will be able to handle `array` values as well.

* **Under Discussion: [Constants in Traits](https://wiki.php.net/rfc/constants_in_traits)**

    Shinji Igarashi proposes in this RFC to allow declaring constants in PHP traits. The proposal details that direct access to the constants with trait name will not be allowed (i.e `MyTrait::FOO`), and enforces some additional composing rules. Constants declared in traits will also suppose visibility and final constants too.

* **Under Discussion: [Auto-implement Stringable for string backed enums](https://wiki.php.net/rfc/auto-implement_stringable_for_string_backed_enums) 💜**

    In this RFC, Ilija Tovilo and Nicolas Grekas propose that string-backed enums auto-implement `Stringable`, while continuing to disallow user-land implementations of the method (``__toString()``). One of the use cases this RFC intends to solve is with Symfony’s use of attributes that the attribute expects a string value, but it is not possible to to pass the name or value property of Enums directly. The [Fetch properties of enums in const expressions RFC]() might also solve this problem with a different approach.

* **Under Discussion: [Short Closures 2.0](https://wiki.php.net/rfc/auto-capture-closure) 💜**

    Originally this RFC was co-authored by Nuno Maduro and Larry Garfield. Now Arnaud Le Blanc took over and significantly reworked the implementation. It proposes to allow multiple statements in anonymous functions using the short function syntax. For example, the following snippet will be valid, should the RFC is voted on and implemented:


    ```php
    $guests = array_filter($users, fn ($user) {
        $guest = $repository->findByUserId($user->id);
        return $guest !== null && in_array($guest->id, $guestsIds);
    });
    ```



    Currently, the `fn` syntax does not allow multiple statements inside the function body, and this RFC proposes to remove this limitation.



## Merged PRs and Commits

Following are some of the changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes, and all pull requests are reviewed by the PHP core developers.

* Bug fixes and improvements in Date extension by Derick Rethans 💜
    * Bug [#80047](https://bugs.php.net/bug.php?id=80047): DatePeriod doesn't warn with custom `DateTimeImmutable` in commit [973c3f6](https://github.com/php/php-src/commit/973c3f6e241227ffc14c3608c774d7636b798cec)
    * Bug [#77243](https://bugs.php.net/bug.php?id=77243): Weekdays are calculated incorrectly for negative years in PR [#8740](https://github.com/php/php-src/pull/8740)
    * Fixed tests that relied on `date.timezone=UTC` to work in commit [242b943](https://github.com/php/php-src/commit/242b9438ea1f9a7f72afe1db5cd8f3bf80152dc5)
    * Bug [#73239](https://bugs.php.net/bug.php?id=73239): DateTime shows strange error message with invalid timezone in PR [#8594](https://github.com/php/php-src/pull/8594)
* Bug fixes and improvements in Opcache by Dmitry Stogov,  Ilija Tovilo, and Derick Rethans 💜
    * Bug [GH-8863](https://github.com/php/php-src/issues/8863): RW operation on readonly property doesn't throw with JIT in commit [ad40fffd](https://github.com/php/php-src/commit/ad40fffd36cab87c249c28af6374c72959937dd6) 
    * Fix incorrect constant propagation for `VERIFY_RETURN_TYPE` in commit [fa75bd07](https://github.com/php/php-src/commit/fa75bd078511c80c8be655719c7681fa65798c13)
    * JIT: Fix incorrect reference-counting in commit [971b07ea](https://github.com/php/php-src/commit/971b07ea60172a80ee308e91c7a7912eea8a571f)
    * JIT: Fix missing register store in commit [1cd8074](https://github.com/php/php-src/commit/1cd8074743d1a13529cf2dbd72bfb2b0ea0ffe25)
    * Memory leak fixes in commits [229e80c6](https://github.com/php/php-src/commit/229e80c6ef507cc26dbd02f0b392f270e1fb6ebe), [088e5677fb](https://github.com/php/php-src/commit/088e5677fbfa41d0c66d756e3076b30c500db126), [3a8912fb7c9](https://github.com/php/php-src/commit/3a8912fb7c97ea5a8490037d45224230be10625d), [f135ed9a](https://github.com/php/php-src/commit/f135ed9a8a5da2968be8cf534c21882d274d10fb), and [229e80c6](https://github.com/php/php-src/commit/229e80c6ef507cc26dbd02f0b392f270e1fb6ebe).
    * Type inference fixes in commits [05375602a](https://github.com/php/php-src/commit/05375602a756e8ca7220480bdb8cec5b8bdd1f0d), [b86c6245](https://github.com/php/php-src/commit/b86c6245cc7dd739a526c29748725b59926b17cc), [1b45efb6fb9dd](https://github.com/php/php-src/commit/1b45efb6fb9dd37c2c6f2079ba2ab851f12e84e0), and [729be469](https://github.com/php/php-src/commit/729be469ae1c50251607b8978647f8b510b45b46)
    * JIT: Add Indirect Branch Tracking (IBT) support with Chen, Hu in PR [#8774](https://github.com/php/php-src/pull/8774) 
    * Fully convert `accel_remap_huge_pages` to use zend_result in commit [0429159](https://github.com/php/php-src/commit/0429159775658f9b9f81d67e4206cf449da01679)
    * Remove redundant address comparison in `accel_remap_huge_pages` in commit [1380b65d](https://github.com/php/php-src/commit/1380b65d261d1ab2e2e920173b836cd95325c8a0)
    * Fixed bug[ GH-8847](https://github.com/php/php-src/issues/8847): PHP hanging infinitely at 100% cpu when check php syntaxes of a valid file in commit [7cf6f173](https://github.com/php/php-src/commit/7cf6f173831caea9952a84b9e4a93594aac8ba00)
* Several improvements in the Curl extension by Pierrick Charron
    * Add curl_upkeep function in PR [#8720](https://github.com/php/php-src/pull/8720/commits)
    * Fixed `CURLOPT_TLSAUTH_TYPE` is not treated as a string option in commit [d84b972](https://github.com/php/php-src/commit/d84b972658fe623b465ce0f3b6632de1e1875534)
    * Expose new constants from libcurl 7.62 to 7.80 in [#8720](https://github.com/php/php-src/pull/8720/commits)
* Several improvements Mbstring extension by Alex Dowad
    * `mbfl_strlen` does not need to use old conversion filters any more in commit [9468fa7f](https://github.com/php/php-src/commit/9468fa7ff2579e2b55da149b01003d3fc796b7c3)
    * Use fast text conversion filters to implement `mb_check_encoding`  in commit [950a7db9](https://github.com/php/php-src/commit/950a7db9fec125c666d9485e4db79c364fe4c810)
    * Use fast conversion filters to implement `php_mb_ord` in commit [880803a2](https://github.com/php/php-src/commit/880803a21e9d5ff339add66033d3021bd5ca9dcc)
    * Assert minimum size of wchar buffer in text conversion filters in commit [8533fccd](https://github.com/php/php-src/commit/8533fccd6332412ec0423b48f7f263317196a14e)
    * Fully use available buffer space where converting Base64 in commit [871e61f](https://github.com/php/php-src/commit/871e61f9429f6eeecc46bc210faa7c59704a2c63)
    * Restore backwards-compatible mappings of 0x5C and 0x7E in SJIS in commit [2dc9026c](https://github.com/php/php-src/commit/2dc9026cbc46c1a76bfac4c8436cb6b293b3e4db)
    * Fast text conversion interfaces for several character encodings 
* Deprecate `zend_atol()` / add `zend_ini_parse_quantity()` in PR [#7951](https://github.com/php/php-src/pull/7951) by Sara Golemon and Arnaud Le Blanc 💜
  
  Note that this introduces warnings on INI values for data sizes that PHP used to parse without any prior warnings. Some of the examples of these patterns are “_`123GB`_” (interpretted as “_`123`_”, although the caller likely meant 123 Gigabytes) and “_`123KMG`_” as "_`123G`_" -> _132070244352_”. This is because  `zend_atol()` / add `zend_ini_parse_quantity()` functions accept 'K', 'M', or 'G' as a unit multiplier, but ignore all other non-numeric characters in between.
* Mark parameters as sensitive (using `SensitiveParameter` attribute [new in PHP 8.2](https://php.watch/versions/8.2/backtrace-parameter-redaction), [RFC](https://wiki.php.net/rfc/redact_parameters_in_back_traces)) in several PHP extensions in PR [#8352](https://github.com/php/php-src/pull/8352) by Tim Düsterhus
* Don't shortcut empty oparray executions if `zend_execute_ex` has been overridden in commit [5bfc1608](https://github.com/php/php-src/commit/5bfc160817a3b707718cc764661321daffadd402), so that debugging continues working well by Derick Rethans 💜
* Fix phpize to include `_GNU_SOURCE` by default in commit [2c166647](https://github.com/php/php-src/commit/2c166647f1a54dfa768b4dda680c5953f54b9c3a) by Derick Rethans 💜
* Zip extension: Implement `fseek` for zip stream when possible with libzip 1.9.1 in commit [2223853c](https://github.com/php/php-src/commit/2223853c58087f3c025bf04257f53720e5454036) by Remi Collet 
* Zip extension: Fix[ GH-8781](https://github.com/php/php-src/issues/8781) `ZipArchive::close` deletes zip file without updating stat cache in commit [390538a](https://github.com/php/php-src/commit/390538af2ed5cd18e3096ad70597035dbca52139) by Remi Collet 
* FPM: Fixed zlog message prepend, free on incorrect address in commit [325ca31d](https://github.com/php/php-src/commit/325ca31dc) by Heiko Weber and David CARLIER
* FPM: Fix use after free in `fpm_evaluate_full_path` in PR [#8796](https://github.com/php/php-src/pull/8796) by Heiko Weber
* FPM: Fix `syslog.indent` does not work in PR [#8780](https://github.com/php/php-src/pull/8780) by Jakub Zelenka 💜
* com_dotnet: Increase test portability in PR [#8879](https://github.com/php/php-src/pull/8879) by Christoph M. Becker
* Add `reallocarray` implementation in PR [#8871](https://github.com/php/php-src/pull/8871) by David CARLIER
* Convert return type of various object handlers from int to zend_result in PR [#8755](https://github.com/php/php-src/pull/8755) by Ilija Tovilo 💜 
* Multiple bug fixes related Enums in commits [bc03deec](https://github.com/php/php-src/commit/bc03deec278923045235f470b4969bab358feaa2), [d9e1871c](https://github.com/php/php-src/commit/bc03deec278923045235f470b4969bab358feaa2), [912c22cc](https://github.com/php/php-src/commit/912c22cca0477a60507a957a835eccedfe1d00fe), [45210b47](https://github.com/php/php-src/commit/45210b47294da6aafee7ca0a1b80db1c76fe4433), and [76fcd70c](https://github.com/php/php-src/commit/76fcd70c13f0c4b66937f381d5313c4f4c4cd548) by Ilija Tovilo 💜
* Allow arbitrary constant expressions in backed enums in PR [#8190](https://github.com/php/php-src/pull/8190) by Ilija Tovilo 💜
* Get rid of duplicated rotr3 implementation in PR [#8853](https://github.com/php/php-src/pull/8853) by Ilija Tovilo 💜
* Declare constants in stubs for several extensions by Máté Kocsis 💜
* Fix lineno in backtrace of multi-line function calls, fixing [GH-8810](https://github.com/php/php-src/issues/8810) in PR [#8818](https://github.com/php/php-src/pull/8818) by Ilija Tovilo 💜
* Refactoring part of SPL `Directory.c` PR [#8837](https://github.com/php/php-src/pull/8837) by George Peter Banyard 💜 
* Use the passed '`this`' pointer instead of `ZEND_THIS `in PR [#8854](https://github.com/php/php-src/pull/8854) by George Peter Banyard 💜 
* Fixed [GH-8861](https://github.com/php/php-src/issues/8861): correctly handle string lengths in `SplFileinfo` methods in PR [#8861](https://github.com/php/php-src/issues/8861) by M. Vondano and George Peter Banyard 💜 
* Fix[ GH-8848](https://github.com/php/php-src/issues/8848): `imagecopyresized()` error refers to the wrong argument in commit [9405f43b](https://github.com/php/php-src/commit/9405f43ba927376e02f4023cbfdc0f9bf412396d) by Christoph M. Becker
* Convert iterable into an internal alias for Traversable|array PR [#7309](https://github.com/php/php-src/pull/7309) by George Peter Banyard 💜 
* Use same type error wording for alias iterable in ZPP in PR [#8838](https://github.com/php/php-src/pull/8838) by George Peter Banyard 💜 
* Support the `#[\AllowDynamicProperties]` attribute in stubs in PR [#8776](https://github.com/php/php-src/pull/8776) by Tim Düsterhus
* Refactor `sapi_getenv()` in PR [#8786](https://github.com/php/php-src/pull/8786) by Heiko Weber
* Specify unit in out of memory error in PR [#8820](https://github.com/php/php-src/pull/8820) by Ilija Tovilo 💜
* Tweak `$count` range check of array_fill() in PR [#8804](https://github.com/php/php-src/pull/8804) by Christoph M. Becker
* Fix[ GH-8827](https://github.com/php/php-src/issues/8827): Intentionally closing std handles no longer possible in commit [a8437d08](https://github.com/php/php-src/commit/a8437d08a8a7122af17532e21c7ac3e02838809a) by Christoph M. Becker
* Introduction of timing attack safe bcmp implementation in commit [bfe6f9e6](https://github.com/php/php-src/commit/bfe6f9e66a65d7c40fd486249097f932e2b237c3) by David CARLIER
* Replace the use of `ZVAL_BOOL()` with `ZVAL_TRUE()` or` ZVAL_FALSE()` where the value is fixed in PR [#8815](https://github.com/php/php-src/pull/8815) by Yurun
* intl ICU C++ code modernisation, making it closer to C++11 in PR [#8650](https://github.com/php/php-src/pull/8650) by David CARLIER
* Fix[ GH-8563](https://github.com/php/php-src/issues/8563) Different results for `seek()` on `SplFileObject` and `SplTempFileObject` in commit [#6f87a5c6](https://github.com/php/php-src/commit/6f87a5c633) by George Peter Banyard 💜
* Zend, ext/opcache: use `PR_SET_VMA_ANON_NAME` (Linux 5.17) in PR [#8234](https://github.com/php/php-src/pull/8234) by Max Kellermann
* Fixed potential use after free in `php_binary_init()` in PR [#8791](https://github.com/php/php-src/pull/8791) by Heiko Weber
* Implemented: Declare true return types in PR [#8759](https://github.com/php/php-src/pull/8759) by Máté Kocsis 💜
* streams/xp_socket: eliminate `poll()` when `MSG_DONTWAIT` is available in PR [#8092](https://github.com/php/php-src/pull/8092) by Max Kellermann
* Fix[ GH-8778](https://github.com/php/php-src/issues/8778): Integer arithmetic with large number variants fails in PR [#8779](https://github.com/php/php-src/pull/8779) by Christoph M. Becker
* Fixed [#77726](https://bugs.php.net/bug.php?id=77726): Allow null character in regex patterns in PR [#8114](https://github.com/php/php-src/pull/8114) by @tobil4sk
* Fix `imagecreatefromavif()` memory leak in PR [#8812](https://github.com/php/php-src/pull/8812) by Christoph M. Becker
* Add `clean_module_functions()` in PR [#8763](https://github.com/php/php-src/pull/8763) by @[twosee](https://github.com/twose)
* Use `get_active_function_or_method_name()` for `zend_forbid_dynamic_call()` in PR [#8762](https://github.com/php/php-src/pull/8762) by @twosee
* Use HTTPS URLs in resource files in commit [9e9141f7](https://github.com/php/php-src/commit/9e9141f7126c507c2790bbbeede5abb99a0dc766) by Christoph M. Becker
* Add test for `iconv_mime_encode()` for input-charset and output-charset in PR [#8766](https://github.com/php/php-src/pull/8766) by Christoph M. Becker
* Regen missing `Zend/Optimizer/zend_func_infos.h` in commit [bbc0c4c5](https://github.com/php/php-src/commit/bbc0c4c5c8bfadcd3dd74dfd923ac8d4e512de9a) by Pierrick Charron
* Indent with TAB in `.h` files generated by `gen_stub` in commit [6fd2b393](https://github.com/php/php-src/commit/6fd2b39397be0626345786dd1803dd799ab3eb5b) by Pierrick Charron
* PDO ODBC: Fix handling of single-key connection strings in PR [#8748](https://github.com/php/php-src/pull/8748) by Calvin Buckley
* Fix redundant `ZSTR_VAL` condition in `php_date.c` in PR [#8753](https://github.com/php/php-src/pull/8753) by Ilija Tovilo 💜
* Add `SO_SETFIB` FreeBSD socket option constant in PR [#8742](https://github.com/php/php-src/pull/8742) by David CARLIER. This is a follow-up to several of David’s contributions to the Sockets extension.
* Fix[ GH-8661](https://github.com/php/php-src/issues/8661): Nullsafe in coalesce triggers undefined variable warning in PR [#8690](https://github.com/php/php-src/pull/8690) by Ilija Tovilo 💜
* Add function exposing `HAVE_GCC_GLOBAL_REGS` in PR [#8359](https://github.com/php/php-src/pull/8359) by Joe Rowell
* Fix[ GH-8691](https://github.com/php/php-src/issues/8691): Add required extensions for redirected tests in commit [c05c96b3](https://github.com/php/php-src/commit/c05c96b3fe2f309b9fe9b118d46681bf00caf798) by George Peter Banyard 💜 
* Remove code duplication in `zend_std_compare_objects` in PR [#8710](https://github.com/php/php-src/pull/8710) by Ilija Tovilo 💜
* Fix Bug [#76452](https://bugs.php.net/bug.php?id=76452): Crash while parsing blob data in `firebird_fetch_blob` in commit [a6a13139](https://github.com/php/php-src/commit/a6a13139db) by Ben Ramsey
* Fix [#81720](https://bugs.php.net/bug.php?id=81720): Uninitialized array in `pg_query_params()` leading to RCE in commit [55f6895f](https://github.com/php/php-src/commit/55f6895f4b4c677272fd4ee1113acdbd99c4b5ab) by Christoph M. Becker
* Fix detection of unknown gcc function attributes in PR [#8483](https://github.com/php/php-src/pull/8483) by Athos Ribeiro
* Better return types for `ReflectionEnum::getBackingType` in PR [#8687](https://github.com/php/php-src/pull/8687) by Sam


## Mailing List Discussions

* [Discussion about new Curl URL API and ext/curl improvements](https://externals.io/message/117958), started by Pierrick Charron
* [The future of objects and operators](https://externals.io/message/117678), started by Jordan LeDoux
* [Adding new closing tag `=?>` for keeping trailing newline](https://externals.io/message/117852), started by Shinji Igarashi


## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

A special mention goes to [mailcoach.app](https://mailcoach.app/) for providing us with a platform for the newsletter.

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more.

