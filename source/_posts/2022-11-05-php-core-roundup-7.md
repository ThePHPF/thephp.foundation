
---
title: 'PHP Core Roundup #7'
layout: post
tags:
    - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 05 November 2022
---

Welcome to the seventh in the _PHP Core Roundup_ series, where we summarize the latest improvements, bug fixes, proposals, and other developments in PHP. 

We are merely three weeks away from PHP 8.2 GA release, and we already have changes implemented and being discussed for the next PHP version, PHP 8.3! Exciting times!

> The PHP Foundation currently supports six part-time PHP contributors who work on maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.

<br>
We publish the posts on our website, and you can subscribe to a newsletter; You don’t necessarily have to be a PHP Foundation backer to follow _PHP Core Roundup_.

{% include "newsletter.html" %}

## First PHP 8.3 Changes Implemented!

PHP 8.3 is more than a year away, but the first change for PHP 8.3 is already merged into the `master` branch. 

Juan Carlos Morales’s RFC to add a new `json_validate` function to PHP was voted and is already implemented. The new `json_validate` function returns whether a given JSON string is valid or not, without consuming the memory and processing it takes to decode a JSON string. For quick JSON string validations, `json_validate` can come in handy.

Additionally, Tim Düsterhus’s RFC to improve error handling semantics of the `unserialize` function recently finished the vote.

There are quite a few more RFCs under discussion that target PHP 8.3, so it’s safe to say that the PHP 8.3 development is quite active even before we have the first GA PHP 8.2 release!


## PHP 8.2 GA to be released this month!

The first GA PHP version, PHP 8.2.0 is scheduled to be released on 24th of November. PHP 8.2 RC5 is already released, and RC6 (the last one) is scheduled for 10th of November.

PHP 8.2 RC versions are available in Ondrej Sury’s Debian/Ubuntu repos, Remi’s repos for Fedora/RHEL, Docker images on Docker Hub, and compiled Windows binaries on [windows.php.net](https://windows.php.net). 


## All PHP 7 Versions Reach EOL Next Month

PHP 7’s journey comes to an end when PHP 8.2 is released. PHP 7.0 through 7.3 are no longer maintained and no longer receive security updates, but PHP 7.4 is currently receiving security updates from the PHP core developers. 


## Recent RFCs, Merged PRs, Discussions, and Commits

Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net web site](github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some of the changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

A security release for all current PHP versions (7.4, 8.0, and 8.1) were made fixing an out-of-bounds read vulnerability in the GD extension (CVE-2022-31630), and a buffer overflow vulnerability in PHP’s SHA3 implementation (CVE-2022-37454). The SHA3 [vulnerability](https://mouha.be/sha-3-buffer-overflow/) was in the reference upstream SHA3 implementation written in C. Python and a few libraries were affected along with PHP.


### RFC Updates

Following are the RFCs and major pull-requests discussed, voted, and implemented since our last update. 

* **RFC Implemented: [json_validate](https://wiki.php.net/rfc/json_validate)**
	
	RFC by Juan Carlos Morales, to add a new `json_validate()` function that returns whether the given string of JSON is a valid JSON. This RFC’s vote passed, and is now implemented in PHP 8.3.
	
	There is a polyfill [proposed](https://github.com/symfony/polyfill/pull/416) to Symfony polyfills, and more information on [PHP.Watch: json_validate()](https://php.watch/versions/8.3/json_validate).

* **RFC Pending Implementation: [Improve unserialize() error handling](https://wiki.php.net/rfc/improve_unserialize_error_handling)**
	
	RFC by Tim Düsterhus completed its vote, and is pending implementation. It proposed to improve error handling of the unserialize function by increasing the error level from E_NOTICE to E_WARNING, adding a new '`UnserializationFailedException`' exception, and throwing exceptions on error conditions.
		
	The vote was not in favor of adding the new 'UnserializationFailedException' exception type, but the vote to promote notices to warnings was in favor, and is currently pending implementation.
	
	More information on [PHP.Watch: `unserialize()`: Upgrade `E_NOTICE` errors to `E_WARNING`](https://php.watch/versions/8.3/unserialize-E-WARNING).

* **RFC Under Discussion: [Destructuring Coalesce](https://wiki.php.net/rfc/destructuring_coalesce)**
	
	Bob Weinand created a new RFC and a [discussion](https://externals.io/message/118829) on allowing `[$a ?? $b] = $array;`, where `$a` is assigned `$b` if the key in the array is null or missing:
	
	```php
	[$a ?? $b] = $array;
	[$a ?? "default value"] = $array;
	```
	<br />
	Currently, the snippets above result in Parse Error. The RFC proposes adding support for coalesce in array destructing (`list()` function calls, or `[$a, $b, …] = $array` syntax).

	When destructing an array, the `$a` will be assigned ``$b```/"default value"` if `$array[0]` is not set.

* **RFC Under Discussion: [Randomizer Additions](https://wiki.php.net/rfc/randomizer_additions)**
	
	RFC by Joshua Rüsweg and Tim Düsterhus, proposes to add new “building block” methods to `\Random\Randomizer` that implement commonly useful operations that are either verbose or very hard to implement in userland. It proposes to add `getBytesFromString`, `nextFloat`, and `getFloat` methods to the new `\Random\Randomizer` classes added as part of the [Random Extension](https://wiki.php.net/rfc/rng_extension) RFC.

* **RFC Under Discussion: [Dynamic class constant fetch](https://wiki.php.net/rfc/dynamic_class_constant_fetch)**
	
	In this RFC, Ilija Tovilo 💜 proposes to allow fetching class constants and magic constants dynamically.
	
	```php
	class Foo {
    	const BAR = 'bar';
    }
	
    $bar = 'BAR';

    // This is currently a syntax error
    echo Foo::{$bar};
    ```
	
	<br />
	Currently, accessing class constants dynamically has to be done with a constant() function call:
	
	```php
	echo constant(Foo::class . '::' . $bar);
	```
	
	<br />
	This RFC proposes to allow the syntax shown in the snippet above, which is apparently only an arbitrary limitation and not a technical limitation.

### Notable Mailing List Discussions

* [Proposal to incrementally improve timeout and signal handling](https://externals.io/message/118859)
* [ARRAY_UNIQUE_IDENTICAL option](https://externals.io/message/118952)
* [ReflectionType for iterable / PHP 8.2](https://externals.io/message/118939)
* [Microseconds to error log](https://externals.io/message/118865)
* [Expanded iterable helper functions and aliasing iterator_to_array in `iterable\` namespace](https://externals.io/message/118896)
* [SQLite3: remove warnings, move to exceptions](https://externals.io/message/118873)
* [Objects can be declared falsifiable](https://externals.io/message/118958)


## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes,  the PHP core developers review all pull requests.

 - Fix invalid label before `}` in [GH-9624](https://github.com/php/php-src/pull/9624) by Ilija Tovilo 💜
 - Fix PHP-8.0 skipping for some jobs in [958955e62a](https://github.com/php/php-src/commit/958955e62a) by Ilija Tovilo 💜
 - Skip some OCI tests with repeat in [93e509fd8c](https://github.com/php/php-src/commit/93e509fd8c) by Ilija Tovilo 💜
 - Fix PHP-8.0 skipping for community steps in [03a48b1209](https://github.com/php/php-src/commit/03a48b1209) by Ilija Tovilo 💜
 - And also update the branch ref in [f518ae50aa](https://github.com/php/php-src/commit/f518ae50aa) by Ilija Tovilo 💜
 - Skip Symfony preloading for PHP-8.0 in [f49709a544](https://github.com/php/php-src/commit/f49709a544) by Ilija Tovilo 💜
 - Updated to timelib version 2022.6 in [d16b5d3803](https://github.com/php/php-src/commit/d16b5d3803), [2b5bed904e](https://github.com/php/php-src/commit/2b5bed904e), and [24963be8ef](https://github.com/php/php-src/commit/24963be8ef) by Derick Rethans 💜
 - Keep original `EG(jit_trace_num)` value around `__autoload()` in [f7d0a3e0e0](https://github.com/php/php-src/commit/f7d0a3e0e0) by Dmitry Stogov
 - Force exit to VM in [aa179bf3dd](https://github.com/php/php-src/commit/aa179bf3dd) by Dmitry Stogov
 - Replace `reallocarray` with `safe_perealloc` in [138fd5b3c8](https://github.com/php/php-src/commit/138fd5b3c8) by Ilija Tovilo 💜
 - Improve CS in FPM Tester Response in [1ed4303957](https://github.com/php/php-src/commit/1ed4303957) by Jakub Zelenka 💜
 - Do not check `X-Powered-By` header in FPM tester if `expose_php` off in [GH-9508](https://github.com/php/php-src/pull/9508) by Jakub Zelenka 💜
 - fix `php_init_crypt_r`/`php_shutdown_crypt_r` signatures warning in [257f108924](https://github.com/php/php-src/commit/257f108924) by David Carlier
 - add missing CVEs in [b0cc5ed91f](https://github.com/php/php-src/commit/b0cc5ed91f) and [12c3636d01](https://github.com/php/php-src/commit/12c3636d01) by Remi Collet
 - Add support for binary and octal number prefixes for INI settings in [GH-9560](https://github.com/php/php-src/pull/9560) by George Peter Banyard 💜
 - Fix UPGRADING by adding DBA constants in [a8d6ca4ef1](https://github.com/php/php-src/commit/a8d6ca4ef1) by George Peter Banyard 💜
 - Move object/class redundancy check into union type handling in [74ae498a4b](https://github.com/php/php-src/commit/74ae498a4b) by George Peter Banyard 💜
 - Fix [GH-9556](https://github.com/php/php-src/issues/9556) `iterable` alias `array|Traversable` breaks PHP 8.1 code in [GH-9558](https://github.com/php/php-src/pull/9558) by George Peter Banyard 💜
 - Make socket path shorter for `ext/sockets/tests/socket_cmsg_{rights|credentials}.phpt` in [c58241a003](https://github.com/php/php-src/commit/c58241a003) by Andy Postnikov
 - Return immediately when `FD_SETSIZE` is exceeded in [GH-9602](https://github.com/php/php-src/pull/9602) by Arnaud Le Blanc 💜
 - Use `--EXTENSIONS--` section for newly added tests in [47c79a97f5](https://github.com/php/php-src/commit/47c79a97f5) by Christoph M. Becker
 - `gh9590.phpt` requires `ext/posix` in [48ae3a0e3f](https://github.com/php/php-src/commit/48ae3a0e3f) by Christoph M. Becker
 - Fix [GH-9655](https://github.com/php/php-src/issues/9655): Allow pure intersection types to be implicitly nullable in [GH-9659](https://github.com/php/php-src/pull/9659) by HypeMC
 - Fix abstract trace consisency for `FE_FETCH` instruction in [5ca4113386](https://github.com/php/php-src/commit/5ca4113386) by Dmitry Stogov
 - Fix [GH-9626](https://github.com/php/php-src/issues/9626): JIT type assertion failure in Symfony community build in [ec5882e1c3](https://github.com/php/php-src/commit/ec5882e1c3) by Dmitry Stogov
 - Fix register allocation (missing store) in [ed652a514f](https://github.com/php/php-src/commit/ed652a514f) by Dmitry Stogov
 - Follow-up fix for [GH-9655](https://github.com/php/php-src/issues/9655) in [01eb06a0de](https://github.com/php/php-src/commit/01eb06a0de) by George Peter Banyard 💜
 - Restore backwards-compatible mappings of `U+005C` and `U+007E` to `SJIS-2004` in [dd00e2f1e3](https://github.com/php/php-src/commit/dd00e2f1e3) by Alex Dowad
 - Fix typo in [072dc3c857](https://github.com/php/php-src/commit/072dc3c857) by Dmitry Stogov
 - Remove support for `libmysql-client` from mysqli test suite in [GH-9652](https://github.com/php/php-src/pull/9652) by Christoph M. Becker
 - Fix memory-leak in CLI web server in [GH-9680](https://github.com/php/php-src/pull/9680) by Benoit Viguier
 - Reduce scope of `r` in `rand_rangeXX` in [GH-9678](https://github.com/php/php-src/pull/9678) by Tim Düsterhus
 - Actually fix [GH-9583](https://github.com/php/php-src/issues/9583) in [GH-9638](https://github.com/php/php-src/pull/9638) by George Peter Banyard 💜
 - Add empty default params to nightly linux matrix in [26499f53fb](https://github.com/php/php-src/commit/26499f53fb) by Ilija Tovilo 💜
 - Prepare for Windows CI with Github Actions in [b43e49437c](https://github.com/php/php-src/commit/b43e49437c) by Michael Voříšek
 - Fix [GH-9697](https://github.com/php/php-src/issues/9697): `array_walk($ffiInstance, function () {})` crashes due to expecting mutable array in [d9651a9419](https://github.com/php/php-src/commit/d9651a9419) by Dmitry Stogov
 - Generate constant declarations with the `CONST_CS` flag for PHP 7.x in [69ef3247fd](https://github.com/php/php-src/commit/69ef3247fd) by Máté Kocsis 💜
 - Increase job timeout for ASAN/UBSAN build in [2c8f2e9349](https://github.com/php/php-src/commit/2c8f2e9349) by Ilija Tovilo 💜
 - Fix [GH-9566](https://github.com/php/php-src/issues/9566): disable assembly for Fiber on FreeBSD i386 in [be53e5e5bb](https://github.com/php/php-src/commit/be53e5e5bb) by David Carlier
 - Fix [GH-9589](https://github.com/php/php-src/issues/9589): `dl()` segfaults when module is already loaded in [GH-9689](https://github.com/php/php-src/pull/9689) by Christoph M. Becker
 - In legacy text conversion filters, reset filter state in 'flush' function in [5812b4fe54](https://github.com/php/php-src/commit/5812b4fe54) by Alex Dowad
 - Add regression test for problem with `mb_encode_mimeheader` reported as [GH-9683](https://github.com/php/php-src/issues/9683) in [faa5425b0f](https://github.com/php/php-src/commit/faa5425b0f) by Alex Dowad
 - Ensure driver specific PDO methods have a proper `run_time_cache` in [9be00e3935](https://github.com/php/php-src/commit/9be00e3935) by Bob Weinand
 - Fix crashes after opcache restart in [c5364b851a](https://github.com/php/php-src/commit/c5364b851a) by Dmitry Stogov
 - Fix [GH-9653](https://github.com/php/php-src/issues/9653): does not inconditionally support copy_file_range on older kernels in [c15fe51918](https://github.com/php/php-src/commit/c15fe51918) by David Carlier
 - Fix potential heap corruption due to alignment mismatch in [GH-9724](https://github.com/php/php-src/pull/9724) by Christoph M. Becker
 - Fix [GH-9720](https://github.com/php/php-src/issues/9720): Null pointer dereference while serializing the response in [GH-9739](https://github.com/php/php-src/pull/9739) by Christoph M. Becker
 - Restore `extra_named_params` when restoring frozen call stack in [86e1fea39a](https://github.com/php/php-src/commit/86e1fea39a) by Arnaud Le Blanc 💜
 - Update to `actions/checkout@v3` in [GH-9759](https://github.com/php/php-src/pull/9759) by Tim Düsterhus
 - Update to `actions/checkout@v3` (PHP-8.1) in [8cd1b837c1](https://github.com/php/php-src/commit/8cd1b837c1) by Tim Düsterhus
 - Discard disasm symbols on opcache restart in [cefb228e15](https://github.com/php/php-src/commit/cefb228e15) by Dmitry Stogov
 - Reset JIT for dynamic functions on opcache restrart in [61e563ca40](https://github.com/php/php-src/commit/61e563ca40) by Dmitry Stogov
 - Fix memory leak in [eecbb60db6](https://github.com/php/php-src/commit/eecbb60db6) by Dmitry Stogov
 - Fixed [GH-9763](https://github.com/php/php-src/issues/9763): DateTimeZone ctr mishandles input and adds null byte if the argument is an offset larger than 100*60 minutes in [7b48053293](https://github.com/php/php-src/commit/7b48053293) by Derick Rethans 💜
 - Update NEWS in [41a6a298d9](https://github.com/php/php-src/commit/41a6a298d9) by Derick Rethans 💜
 - Fix [GH-9372](https://github.com/php/php-src/issues/9372): `HY010` when binding overlong parameter in [GH-9541](https://github.com/php/php-src/pull/9541) by Christoph M. Becker
 - Test for bug [#78055](https://bugs.php.net/bug.php?id=78055) (`DatePeriod`'s getRecurrences and `->recurrences` don't match) in [011b7f9840](https://github.com/php/php-src/commit/011b7f9840) by Derick Rethans 💜
 - Fix failing date test in [4e8a6554cb](https://github.com/php/php-src/commit/4e8a6554cb) by Ilija Tovilo 💜
 - Fix cli server blocking on accept when using multiple workers in [GH-9693](https://github.com/php/php-src/pull/9693) by Ilija Tovilo 💜
 - opcache: add FrankenPHP to the allow list in [7acb7703e2](https://github.com/php/php-src/commit/7acb7703e2) by Kévin Dunglas
 - Fix bug [#81738](https://bugs.php.net/bug.php?id=81738) (buffer overflow in hash_update() on long parameter) in [248f647724](https://github.com/php/php-src/commit/248f647724) by Stanislav Malyshev
 - Revert incorrect PHP-7.4 version constants in [8b919c3175](https://github.com/php/php-src/commit/8b919c3175) by Ilija Tovilo 💜
 - Fix crash when memory limit is exceeded during generator initialization in [26c7c82d32](https://github.com/php/php-src/commit/26c7c82d32) by Arnaud Le Blanc 💜
 - Fix compilation warning in [994097093c](https://github.com/php/php-src/commit/994097093c) by Benoit
 - Clean up OpenSSL engine list when OpenSSL 1.0.2 used in [1ef65c1cf0](https://github.com/php/php-src/commit/1ef65c1cf0) by Jakub Zelenka 💜
 - Fix [GH-8430](https://github.com/php/php-src/issues/8430): OpenSSL compiled with old disgests does not build in [fa1b6ab5db](https://github.com/php/php-src/commit/fa1b6ab5db) by Jakub Zelenka 💜
 - Fixed missing `run_time_cache` for preloaded arena allocated internal functions in [5e9654be03](https://github.com/php/php-src/commit/5e9654be03) by Bob Weinand
 - Fix OpenSSL conflicting merge for compilation issue with old digests in [3e2184f795](https://github.com/php/php-src/commit/3e2184f795) by Jakub Zelenka 💜
 - Fix [GH-9709](https://github.com/php/php-src/issues/9709): Guard against current_execute_data==NULL in is_handle_exception_set in [45e224cf51](https://github.com/php/php-src/commit/45e224cf51) by Adam Saponara
 - Fix bug [GH-9779](https://github.com/php/php-src/issues/9779): stream_copy_to_stream fail when dest in append mode in [b732d80329](https://github.com/php/php-src/commit/b732d80329) by Jakub Zelenka 💜
 - Fix [#81739](https://bugs.php.net/bug.php?id=81739): OOB read due to insufficient validation in imageloadfont() in [d50532be91](https://github.com/php/php-src/commit/d50532be91) by Christoph M. Becker
 - Update NEWS in [2669ed7d77](https://github.com/php/php-src/commit/2669ed7d77) by Stanislav Malyshev
 - JIT: Fix incorrect EX(opline) override in [261a08af65](https://github.com/php/php-src/commit/261a08af65) by Dmitry Stogov
 - Fixed test in [e0d9a29958](https://github.com/php/php-src/commit/e0d9a29958) by Dmitry Stogov
 - Convert Implicitly nullable pure intersection types to DNF in [0b0259a418](https://github.com/php/php-src/commit/0b0259a418) by George Peter Banyard 💜
 - Revert [01eb06a0](https://github.com/php/php-src/commit/01eb06a0def9fb5facf0abf0f4168fcacbbb5789) in [8c2df899d0](https://github.com/php/php-src/commit/8c2df899d0) by George Peter Banyard 💜
 - Update new test to use EXTENSIONS section instead of SKIPIF in [b4fb66463b](https://github.com/php/php-src/commit/b4fb66463b) by Christoph M. Becker
 - Fix OpCache build after [0b0259a4](https://github.com/php/php-src/commit/0b0259a418b78c05cd5cd23f756582615d9b5918) in [cb3adf351d](https://github.com/php/php-src/commit/cb3adf351d) by George Peter Banyard 💜
 - opcache: fix syntax error introduced in [261a08af](https://github.com/php/php-src/commit/261a08af65168e24c43a81321284f3f461f3500d) in [GH-9821](https://github.com/php/php-src/pull/9821) by Kévin Dunglas
 - Fix user path in test in [537a104f14](https://github.com/php/php-src/commit/537a104f14) by Ilija Tovilo 💜
 - Initialize run time cache in PDO methods in [GH-9818](https://github.com/php/php-src/pull/9818) by Florian Sowade
 - Don’t report arginfo violations on fake closures in [GH-9823](https://github.com/php/php-src/pull/9823) by Florian Sowade
 - move CVEs in 8.0.25 changelog in [db28ee8fd0](https://github.com/php/php-src/commit/db28ee8fd0) by Remi Collet
 - move CVEs in 8.1.12 changelog in [c84d7cc27e](https://github.com/php/php-src/commit/c84d7cc27e) by Remi Collet
 - Remove unnecessary ast eval bailout in [GH-9805](https://github.com/php/php-src/pull/9805) by Ilija Tovilo 💜
 - Add missing EXTENSION section to tests in [a4acba9e52](https://github.com/php/php-src/commit/a4acba9e52) by George Peter Banyard 💜
 - mysqli_query throws warning despite using silenced error mode in [GH-9842](https://github.com/php/php-src/pull/9842) by Kamil Tekiela
 - Add a temporary fix for insufficient buffer size in mysqlnd in [GH-9835](https://github.com/php/php-src/pull/9835) by Kamil Tekiela
 - Add NEWS entry for #9841 in [GH-9841](https://github.com/php/php-src/pull/9841) by Kamil Tekiela
 - Add NEWS entry for #9841 in [bce12f4e57](https://github.com/php/php-src/commit/bce12f4e57) by Kamil Tekiela
 - Fix pre-PHP 8.2 compatibility for `php_mt_rand_range()` with MT_RAND_PHP in [GH-9839](https://github.com/php/php-src/pull/9839) by Tim Düsterhus
 - Fix [GH-9754](https://github.com/php/php-src/issues/9754): SaltStack hangs when running php-fpm 8.1.11 in [1c5844aa3e](https://github.com/php/php-src/commit/1c5844aa3e) by Jakub Zelenka 💜
 - Do not display the value of UNKNOWN constants in the manual in [GH-9843](https://github.com/php/php-src/pull/9843) by Máté Kocsis 💜
 - Fix [GH-9770](https://github.com/php/php-src/issues/9770): Add small timeout in status-listen test in [8229649045](https://github.com/php/php-src/commit/8229649045) by Jakub Zelenka 💜
 - Fix memory leak in [482ae71fda](https://github.com/php/php-src/commit/482ae71fda) by Dmitry Stogov
 - Bumb versions in [004cb82750](https://github.com/php/php-src/commit/004cb82750) by Derick Rethans 💜
 - Don’t reset func in zend_closure_internal_handler in [8dabbda8bc](https://github.com/php/php-src/commit/8dabbda8bc) by Florian Sowade
 - Fix [GH-9829](https://github.com/php/php-src/issues/9829): Bug in refactoring Windows shmat() function in [GH-9873](https://github.com/php/php-src/pull/9873) by Christoph M. Becker
 - Fix potential NULL pointer dereference Windows shm*() functions in [GH-9872](https://github.com/php/php-src/pull/9872) by Christoph M. Becker
 - Fix observing inherited internal functions in [b30448f48f](https://github.com/php/php-src/commit/b30448f48f) by Bob Weinand
 - Fix hardcoded paths in test in [4935e10fc8](https://github.com/php/php-src/commit/4935e10fc8) by Bob Weinand
 - Delay releasing closures until after observer end in [8e49d7f32f](https://github.com/php/php-src/commit/8e49d7f32f) by Bob Weinand
 - Properly deal with internal attributes used on promoted properties in [GH-9661](https://github.com/php/php-src/pull/9661) by Martin Schröder
 - Fix fake closure leaking when called from internal func in [GH-9884](https://github.com/php/php-src/pull/9884) by Ilija Tovilo 💜
 - Migrate i386 to GitHub actions in [GH-9856](https://github.com/php/php-src/pull/9856) by Ilija Tovilo 💜
 - Fix duplicate `SKIPIF` section in [d2c663441d](https://github.com/php/php-src/commit/d2c663441d) by Ilija Tovilo 💜
 - Fix ext section in [bca1e1f557](https://github.com/php/php-src/commit/bca1e1f557) by Ilija Tovilo 💜
 - Really fix test this time in [35167af771](https://github.com/php/php-src/commit/35167af771) by Ilija Tovilo 💜
 - Fix generator memory leaks when interrupted during argument evaluation in [GH-9756](https://github.com/php/php-src/pull/9756) by Arnaud Le Blanc 💜

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 
