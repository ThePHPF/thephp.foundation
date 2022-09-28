
---
title: 'PHP Core Roundup #6'
layout: post
tags:
    - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 30 September 2022
---

Welcome back to _PHP Core Roundup_, the sixth in the [series](https://thephp.foundation/blog/tag/roundup/). _PHP Core Roundup_ summarizes the latest improvements, bug fixes, discussions, and proposals to PHP.

> The PHP Foundation currently supports six part-time PHP contributors who work on maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.

<br>
We publish the posts on our website, and you can subscribe to a newsletter; You don’t necessarily have to be a PHP Foundation backer to follow _PHP Core Roundup_.

<div class="px-4 pt-3 pb-10 mb-6 border-b border-t -mx-4 border-gray-200">
    <div class="max-w-xl mx-auto">
        <h2 class="text-xl text-left inline-block font-semibold text-gray-800 mb-1">Subscribe to PHP Core Roundup newsletter</h2>
        <form method="POST" action="https://php-foundation-mailcoach.com/subscribe/9be4e2bd-f9d8-475c-b00e-2dcc4cf90056" class="mt-2">
            <div class="flex items-center">
                <input placeholder="Your email address" type="email" class="w-full px-2 py-4 mr-2  bg-gray-100 shadow-inner rounded-md border border-gray-400 focus:outline-none" name="email" required>
                <button class="bg-[#7f52ff] text-gray-200 px-5 py-2 rounded shadow " style="margin-left: -7.8rem;">Sign Up</button>
            </div>
        </form>
    </div>
</div>


September was a slow month, given that PHP 8.2 reached its feature-freeze, and most of the work is now focused on getting PHP 8.2 ready for its general availability, scheduled for November 24th.


[Nikita Popov](https://github.com/nikic) recently tagged three new releases of the [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) library with support for PHP 8.2 features and syntax. PHP-Parser is used as the underlying PHP parser for several PHP static analyzers, and you can expect many PHP tools to support new PHP 8.2 syntax in the coming weeks. 


## Early-developments for PHP 8.3

Although PHP 8.2 is still being ironed out, there are some discussions and even an RFC currently being voted for proposed changes in PHP 8.3 (scheduled for the end of 2023!).

[Deprecations for PHP 8.3 RFC](https://wiki.php.net/rfc/deprecations_php_8_3) is currently in draft, which stands to track ideas on deprecating certain features. So far those are related to the `mb_strimwidth` function, `NumberFormatter` class, and a few functions related to Random Number Generators (RNG).

Furthermore, there is an [RFC](https://wiki.php.net/rfc/json_validate) currently under vote to add a new function named `json_validate()`, that validates a given JSON string without the memory overhead of otherwise decoding the JSON string into memory. 


## Recent RFCs, Merged PRs, and Commits

Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net web site](https://php.net) changes are also discussed and improved at their relevant Git repositories on GitHub.

Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some of the changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.


### RFC Updates and Pull-Request Updates

Following are the RFCs and major pull-requests discussed, voted, and implemented since our last update. 


- **RFC In Voting: [json_validate](https://wiki.php.net/rfc/json_validate)**

	RFC by Juan Carlos Morales, to add a new `json_validate()` function that returns whether the given string of JSON is a valid JSON. PHP’s `json_decode()` function can emit errors or throw exceptions on strings with invalid JSON, but the proposed `json_validate` function will be faster and more memory efficient because it does not attempt to build the data structures in memory, but merely validate the given string.

	This RFC is currently under vote, and concludes on 7th of October. The responses have been overwhelmingly positive to add `json_validate` to PHP 8.3.

- **RFC In Draft: [Deprecations for PHP 8.3](https://wiki.php.net/rfc/deprecations_php_8_3)**

	RFC Christoph M. Becker and George Peter Banyard 💜 with suggestions from Tim Düsterhus and Go Kudo (so far!), that proposes a series of functionality/syntax to deprecate in PHP 8.3, and eventually remove in PHP 9.0.

	Each proposed deprecation will be voted to determine if the deprecation makes it to PHP 8.3, but having a consolidated RFC eases the voting and discussions.

	So far, the RFC proposes to deprecate the following:
	
	  * Passing negative `$width`s to `mb_strimwidth()`
	  * The `NumberFormatter::TYPE_CURRENCY` constant
	  * `MT_RAND_PHP` constant/mode
	  * Global Mersenne Twister: This includes deprecating several RNG functions including `rand()`, `mt_rand()`, `array_rand()`, `shuffle()`, and `str_shuffle()` functions in favor of the `\Random\Randomizer` class introduced in PHP 8.2, or `random_int()`/`random_bytes()` functions available since PHP 7.0.functions. Most of the applications can simply switch to `random_int()`/`random_bytes()`, and applications that need to use a seedable Global Mersenne Twister can use the new scoped Mersenne Twister RNG engine through the new `\Random\Randomizer` class.

### Documentation

Now that PHP 8.2 is being prepared for GA releases, the documentation available on [php.net](https://php.net), requires updating. An initial version of the [PHP 8.2 migration guide](https://www.php.net/manual/en/migration82.php) has been published.

George P. Banyard 💜 is tracking the progress for PHP 8.2 related changes in [php/doc-en#1803](https://github.com/php/doc-en/issues/1803), and you can help too!

You can also help with other existing issues, a good starting point are [issues marked as “good first issue”](https://github.com/php/doc-en/issues?q=is%3Aissue+is%3Aopen+label%3A%22good+first+issue%22) that George went and triaged in preparation for Hacktoberfest.

[![Did some issue triage on the doc-en GitHub tracker, and labelled a bunch of issues as "good first issue". So if people want to contribute those are probably the best to tackle :)](/assets/post-images/2022/roundup-6/tweet-gbp-php-doc-en-issues.png "George Peter Banyard 💜 on Twitter")](https://twitter.com/Girgias/status/1569626352025747459)

Derick has gone through all the datetime notes, and integrated them where needed, deleted where not.

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes,  the PHP core developers review all pull requests.

* Do not generate `CONST_CS` when registering constants in [GH-9439](https://github.com/php/php-src/pull/9439) by Máté Kocsis 💜
* Fix [GH-9310](https://github.com/php/php-src/issues/9310): SSL `local_cert` and `local_pk` do not respect `open_basedir` restriction in [505e8d2a04](https://github.com/php/php-src/commit/505e8d2a04) by Jakub Zelenka 💜
* Implement FR[ #76935](https://bugs.php.net/bug.php?id=76935): OpenSSL `chacha20-poly1305` AEAD support in [1407968891](https://github.com/php/php-src/commit/1407968891) by Jakub Zelenka 💜
* Add `openssl_cipher_key_length` function in [35e2a25d83](https://github.com/php/php-src/commit/35e2a25d83) by Jakub Zelenka 💜
* Add `libxml_get_external_entity_loader()` in [11796229f2](https://github.com/php/php-src/commit/11796229f2) by Tim Starling
* Drop unsupported `libxml2` 2.10.0 symbols in [GH-9358](https://github.com/php/php-src/pull/9358) by Christoph M. Becker
* Respond without body to HEAD request on a static resource in [4f509058a9](https://github.com/php/php-src/commit/4f509058a9) by Vedran Miletić
* Respond with HTTP status 405 to `DELETE`/`PUT`/`PATCH` request on a static resource in [7065a222b7](https://github.com/php/php-src/commit/7065a222b7) by Vedran Miletić
* Update `NEWS` for CLI built-in server changes in [5e9af0d0b0](https://github.com/php/php-src/commit/5e9af0d0b0) by Jakub Zelenka 💜
* Add a bit verbosity in FPM logs in [335979fe1b](https://github.com/php/php-src/commit/335979fe1b) by Mikhail Galanin
* FPM fix strict prototype warnings in [GH-8986](https://github.com/php/php-src/pull/8986) by David Carlier
* Fix `ext/opcache/tests/jit/inc_obj_004.phpt` failure introduced by[ fd74ee7e](https://github.com/php/php-src/commit/fd74ee7e909c66f09d8d904a5438b275a13e8738) in [ce42dcf483](https://github.com/php/php-src/commit/ce42dcf483) by Dmitry Stogov
* Delay fiber VM stack cleanup until after observer has been called in [8fe1db2089](https://github.com/php/php-src/commit/8fe1db2089) by Bob Weinand
* Revert “Fix [GH-9296](https://github.com/php/php-src/issues/9296): `ksort` behaves incorrectly on arrays with mixed keys” in [725cb4e8ad](https://github.com/php/php-src/commit/725cb4e8ad) by Christoph M. Becker
* JIT: Fix missing type store in [4b884bedc8](https://github.com/php/php-src/commit/4b884bedc8) by Dmitry Stogov
* Fix memory leak in [4135e6011c](https://github.com/php/php-src/commit/4135e6011c) by Dmitry Stogov
* Fixed bug [GH-9431](https://github.com/php/php-src/issues/9431): `DateTime::getLastErrors()` not returning false when no errors/warnings in [932586c426](https://github.com/php/php-src/commit/932586c426) by Derick Rethans 💜
* Fix [GH-8885](https://github.com/php/php-src/issues/8885): access.log with stderr writes logs to error_log after reload in [f92505cf24](https://github.com/php/php-src/commit/f92505cf24) by Dmitry Menshikov
* typo in [263a07e5b0](https://github.com/php/php-src/commit/263a07e5b0) by Dmitry Stogov
* Fix [GH-8885](https://github.com/php/php-src/issues/8885) tests on MacOS in [bcdd9877e1](https://github.com/php/php-src/commit/bcdd9877e1) by Jakub Zelenka 💜
* Re-add fixed tests for [GH-8885](https://github.com/php/php-src/issues/8885) in [986e7319c5](https://github.com/php/php-src/commit/986e7319c5) by Jakub Zelenka 💜
* Fix [GH-9347](https://github.com/php/php-src/issues/9347): Current ODBC liveness checks may be inadequate in [GH-9353](https://github.com/php/php-src/pull/9353) by Calvin Buckley
* Fix bug[ #77780](https://bugs.php.net/bug.php?id=77780): “Headers already sent” when previous connection was aborted in [3503b1daa2](https://github.com/php/php-src/commit/3503b1daa2) by Jakub Zelenka 💜
* Fix FPM tester conflict in [e3034dba3e](https://github.com/php/php-src/commit/e3034dba3e) by Jakub Zelenka 💜
* Update `gen_stub` to avoid compile errors on duplicate function names in [GH-9406](https://github.com/php/php-src/pull/9406) by Andreas Braun
* Fix `zend/test` aliases in [ef21bbe66c](https://github.com/php/php-src/commit/ef21bbe66c) by Máté Kocsis 💜
* Adjust PHPDoc in [869ab3c481](https://github.com/php/php-src/commit/869ab3c481) by Máté Kocsis 💜
* Remove unused `ext/zend_test` alias functions in [8d78dce902](https://github.com/php/php-src/commit/8d78dce902) by Máté Kocsis 💜
* Fix [GH-9186](https://github.com/php/php-src/issues/9186) @strict-properties can be bypassed using unserialization in [GH-9354](https://github.com/php/php-src/pull/9354) by Máté Kocsis 💜
* Make `var_export`/`debug_zval_dump` check for infinite recursion on the `*object*` in [GH-9448](https://github.com/php/php-src/pull/9448) by Tyson Andre
* Fix tests in [65619e868c](https://github.com/php/php-src/commit/65619e868c) by Christoph M. Becker
* Add `NEWS` and `UPGRADING` entries for [GH-9296](https://github.com/php/php-src/issues/9296) in [853181a14d](https://github.com/php/php-src/commit/853181a14d) by Christoph M. Becker
* Prepare for PHP 8.3 in [327c95237c](https://github.com/php/php-src/commit/327c95237c) by Pierrick Charron
* Prepare PHP 8.2.0 RC1 in [58a92772ab](https://github.com/php/php-src/commit/58a92772ab) by Pierrick Charron
* Harden GitHub Workflows security in [GH-9440](https://github.com/php/php-src/pull/9440) by Alex
* Prepare NEWS for PHP 8.2.0RC2 in [9f303cf7d3](https://github.com/php/php-src/commit/9f303cf7d3) by Pierrick Charron
* Add PHP-8.2 branch to build processes in [06f713e80f](https://github.com/php/php-src/commit/06f713e80f) by Ben Ramsey
* Mark `crypt()`'s `$string` parameter as `#[\SensitiveParameter]` in [c77bbf6fe5](https://github.com/php/php-src/commit/c77bbf6fe5) by Tim Düsterhus
* Add PHP-8.2 branch to build processes in [8330a0f323](https://github.com/php/php-src/commit/8330a0f323) by Ben Ramsey
* Fix `pcre.jit` on Apple Silicon in [GH-9279](https://github.com/php/php-src/pull/9279) by Niklas Keller
* Store default object handlers alongside the class entry in [9e6eab3c13](https://github.com/php/php-src/commit/9e6eab3c13) by Bob Weinand
* Fix compilation on MacOS in [800c6672e5](https://github.com/php/php-src/commit/800c6672e5) by Bob Weinand
* Port all internally used classes to use default_object_handlers in [94ee4f9834](https://github.com/php/php-src/commit/94ee4f9834) by Bob Weinand
* Unify structure for `ext/random`'s randomizer tests in [GH-9410](https://github.com/php/php-src/pull/9410) by Tim Düsterhus
* Fix class name FQN when AST dumping new and class const in [GH-9462](https://github.com/php/php-src/pull/9462) by Ilija Tovilo 💜
* Declare `ext/standard` constants in stubs in [GH-9465](https://github.com/php/php-src/pull/9465),[ GH-9466](https://github.com/php/php-src/pull/9466),[ GH-9505](https://github.com/php/php-src/pull/9505), and[ GH-9467](https://github.com/php/php-src/pull/9467) by Máté Kocsis 💜
* Fix [GH-8932](https://github.com/php/php-src/issues/8932): Provide a way to get the called-scope of closures in [GH-9299](https://github.com/php/php-src/pull/9299) by Nicolas Grekas
* Add tests in [db1ef97209](https://github.com/php/php-src/commit/db1ef97209) by Arnaud Le Blanc 💜
* Fix memory leak triggered by unsuccessful dynamic property unserialization in [GH-9468](https://github.com/php/php-src/pull/9468) by Máté Kocsis 💜
* Add parentheses around preprocessor conditions in stubs in [e733ebf30e](https://github.com/php/php-src/commit/e733ebf30e) by Máté Kocsis 💜
* Regenerate optimizer func info after preprocessor condition changes in [5210872747](https://github.com/php/php-src/commit/5210872747) by Máté Kocsis 💜
* Fix high `opcache.interned_strings_buffer` causing shm corruption in [GH-9260](https://github.com/php/php-src/pull/9260) by Arnaud Le Blanc 💜
* Log the cause of error when opcache cannot write to file cache in [GH-9258](https://github.com/php/php-src/pull/9258) by Arnaud Le Blanc 💜
* [GH-9464](https://github.com/php/php-src/issues/9464): Fix build on older macOs releases in [GH-9479](https://github.com/php/php-src/pull/9479) by David Bohman
* Remove obsolete checks for random-related functionality from `ext/standard/config.m4` in [GH-9482](https://github.com/php/php-src/pull/9482) by Tim Düsterhus
* posix add sysconf call in [GH-9481](https://github.com/php/php-src/pull/9481) by David Carlier
* Fix type inference in [81cb005ef7](https://github.com/php/php-src/commit/81cb005ef7) by Dmitry Stogov
* Fix inexistent skipif.inc in [59180b50b3](https://github.com/php/php-src/commit/59180b50b3) by Máté Kocsis 💜
* Add support for validation of missing class synopses in [GH-9472](https://github.com/php/php-src/pull/9472) by Máté Kocsis 💜
* Support `sapi/cli/tests/017.phpt` on Windows, too in [GH-9474](https://github.com/php/php-src/pull/9474) by Christoph M. Becker
* Fix [GH-9411](https://github.com/php/php-src/issues/9411): PgSQL large object resource is incorrectly closed in [GH-9411](https://github.com/php/php-src/pull/9411) by Yurun
* random: Validate that the arrays do not contain extra elements when unserializing in [GH-9458](https://github.com/php/php-src/pull/9458) by Tim Düsterhus
* Add “Start time”, “Last restart time” and “Last force restart time” to `phpinfo()` for opcache in [GH-9475](https://github.com/php/php-src/pull/9475) by Mikhail Galanin
* Use `php_info_print_table_header` for actual column headers only in [GH-9485](https://github.com/php/php-src/pull/9485) by Tim Düsterhus
* Update INI validator and displayers depending on INI type in [GH-9451](https://github.com/php/php-src/pull/9451) by George Peter Banyard 💜
* Update globals to use bool type in [5011a185b5](https://github.com/php/php-src/commit/5011a185b5) by George Peter Banyard 💜
* Add `zend_string` INI validators in [GH-9328](https://github.com/php/php-src/pull/9328) by George Peter Banyard 💜
* intl: use `uspoof_check2UTF8` call when available. in [GH-9478](https://github.com/php/php-src/pull/9478) by David CARLIER
* Upgrade PHP parser to 4.15.1 in [05aa3b3e0a](https://github.com/php/php-src/commit/05aa3b3e0a) by Máté Kocsis 💜
* Add support for validation of missing method synopses in [GH-9491](https://github.com/php/php-src/pull/9491) by Máté Kocsis 💜
* Fix [GH-9493](https://github.com/php/php-src/issues/9493): fix ancillary data build for FreeBSD prior to the 13 release. in [GH-9496](https://github.com/php/php-src/pull/9496) by David CARLIER
* Private method incorrectly marked as “overwrites” in reflection in [GH-9469](https://github.com/php/php-src/pull/9469) by Ilija Tovilo 💜
* Use `PDEATHSIG` to kill cli-server workers if parent exists in [GH-9476](https://github.com/php/php-src/pull/9476) by Ilija Tovilo 💜
* Fix lsp error in `eval`'d code referring to incorrect class for static type in [GH-9471](https://github.com/php/php-src/pull/9471) by Ilija Tovilo 💜
* Improve magic `__get` and property type inconsistency error message in [GH-9436](https://github.com/php/php-src/pull/9436) by Ilija Tovilo 💜
* Fix undefined left shift in oci in [aa7f4497bf](https://github.com/php/php-src/commit/aa7f4497bf) by Ilija Tovilo 💜
* Skip oci tests that leak under asan in [4a8cca241f](https://github.com/php/php-src/commit/4a8cca241f) by Ilija Tovilo 💜
* Fix pdeathsig test on FreeBSD in [GH-9506](https://github.com/php/php-src/pull/9506) by Ilija Tovilo 💜
* Fixed `MemorySanitizer`: use-of-uninitialized-value warning introduced by[ 932586c4](https://github.com/php/php-src/commit/932586c426d7f016e5d0e0d95579f9503ec70a89) in [8cdfffb753](https://github.com/php/php-src/commit/8cdfffb753) by Derick Rethans 💜
* Don’t return existing `error_container`/`NULL`, but use by-ref instead in [f799bc4eca](https://github.com/php/php-src/commit/f799bc4eca) by Derick Rethans 💜
* Fixed error updating once more in [49c029858b](https://github.com/php/php-src/commit/49c029858b) by Derick Rethans 💜
* Check return value of `zend_jit_trace_get_exit_addr()` in [GH-9097](https://github.com/php/php-src/pull/9097) by Arnaud Le Blanc 💜
* Fix [GH-9139](https://github.com/php/php-src/issues/9139): Allow FFI in opcache.preload when opcache.preload_user=root in [GH-9473](https://github.com/php/php-src/pull/9473) by Arnaud Le Blanc 💜
* Validate if the refpurpose and the description is in sync in [GH-9510](https://github.com/php/php-src/pull/9510) by Máté Kocsis 💜
* Security fix [#81727](https://bugs.php.net/bug.php?id=81727), ([CVE-2022-31628](https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2022-31628)): Don’t mangle HTTP variable names that clash with ones that have a specific semantic meaning in [0611be4e82](https://github.com/php/php-src/commit/0611be4e82) by Derick Rethans 💜
* Security fix [#81726](https://bugs.php.net/bug.php?id=81726), ([CVE-2022-31629](https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2022-31629)): phar wrapper: DOS when using quine gzip file in [ 404e8bdb68](https://github.com/php/php-src/commit/404e8bdb68) by Christoph M. Becker
* Introduce `PROGRESS_CACHE_SLOT()` macro in [80315edd58](https://github.com/php/php-src/commit/80315edd58) by George Peter Banyard 💜
* Fix [GH-9516](https://github.com/php/php-src/issues/9516): `(A&B)|D` as a param should allow `AB` or `D`. Not just `A` in [9286101da4](https://github.com/php/php-src/commit/9286101da4) by George Peter Banyard 💜
* Use DNF intersection type check also for simple intersection types in [c70a8281e3](https://github.com/php/php-src/commit/c70a8281e3) by George Peter Banyard 💜
* Update cache slot size calculation in `compact_literals.c` in [6c4d24e4f0](https://github.com/php/php-src/commit/6c4d24e4f0) by George Peter Banyard 💜
* Fix [GH-9518](https://github.com/php/php-src/issues/9518): Disabling IPv6 support disables unrelated constants in [GH-9520](https://github.com/php/php-src/pull/9520) by Christoph M. Becker
* Check that all preprocessor conditions are terminated in [36fdc6fdc0](https://github.com/php/php-src/commit/36fdc6fdc0) by Nikita Popov
* Require PHP 7.4 at least for running the build system in [GH-9519](https://github.com/php/php-src/pull/9519) by Máté Kocsis 💜
* Use PHP 7.4 syntax in `gen_stub.php` in [8b632749d7](https://github.com/php/php-src/commit/8b632749d7) by Máté Kocsis 💜
* Fix syntax error when dnf type in parens after readonly in [GH-9512](https://github.com/php/php-src/pull/9512) by Ilija Tovilo 💜
* Mark `gh9259_003.phpt` as xfail with ASAN in [e9a0d21a06](https://github.com/php/php-src/commit/e9a0d21a06) by Ilija Tovilo 💜
* Fix bug [GH-9517](https://github.com/php/php-src/issues/9517): Compilation error in openssl extension in [f126769a29](https://github.com/php/php-src/commit/f126769a29) by Jakub Zelenka 💜
* Fix always non-null warning in [9f9042fd43](https://github.com/php/php-src/commit/9f9042fd43) by Nikita Popov
* Reset `FG(user_stream_current_filename)` at the end of request in [d0b3096ff0](https://github.com/php/php-src/commit/d0b3096ff0) by Dmitry Stogov
* Fix `ZEND_RC_MOD_CHECK()` for thread local ini parser strings in [9af98cd465](https://github.com/php/php-src/commit/9af98cd465) by Ilija Tovilo 💜
* Only check classes in intersection type if the type might be valid in [GH-9522](https://github.com/php/php-src/pull/9522) by George Peter Banyard 💜
* Update NEWS with DNF type check bug fix in [3675041d03](https://github.com/php/php-src/commit/3675041d03) by George Peter Banyard 💜
* Fix [GH-9308](https://github.com/php/php-src/issues/9308) GMP throws the wrong error when a GMP object is passed to gmp_init() in [GH-9490](https://github.com/php/php-src/pull/9490) by George Peter Banyard 💜
* Fix [GH-9421](https://github.com/php/php-src/issues/9421) Incorrect argument number for ValueError in NumberFormatter in [GH-9489](https://github.com/php/php-src/pull/9489) by George Peter Banyard 💜
* Always skip randomly failing OCI8 extauth tests in [GH-9524](https://github.com/php/php-src/pull/9524) by Michael Voříšek
* Refactor `_xml_add_to_info()` in [0b8ad94b91](https://github.com/php/php-src/commit/0b8ad94b91) by George Peter Banyard 💜
* Mark `_xml_decode_tag()` as taking a `const XML_Char*` in [6aef13402e](https://github.com/php/php-src/commit/6aef13402e) by George Peter Banyard 💜
* Do early returns in `xml.c` in [951bd74038](https://github.com/php/php-src/commit/951bd74038) by George Peter Banyard 💜
* Fix `oci_success_with_info.phpt` test random failures in [GH-9525](https://github.com/php/php-src/pull/9525) by Michael Voříšek
* PHP-8.1 is now for PHP 8.1.12-dev in [0f575aa698](https://github.com/php/php-src/commit/0f575aa698) by Patrick Allaert
* Bump for 8.0.25 in [559da529a0](https://github.com/php/php-src/commit/559da529a0) by Sara Golemon
* Revert “Port all internally used classes to use default_object_handlers” in [a01dd9feda](https://github.com/php/php-src/commit/a01dd9feda) by Bob Weinand
* Revert “Store default object handlers alongside the class entry” in [5a0b68bed7](https://github.com/php/php-src/commit/5a0b68bed7) by Bob Weinand
* Revert “Fix compilation on MacOS” in [d1fc0017c9](https://github.com/php/php-src/commit/d1fc0017c9) by Bob Weinand
* Merge timelib 2021.17 in [4a5202293b](https://github.com/php/php-src/commit/4a5202293b) by Derick Rethans 💜
* Fixed #9165: `strtotime` translates a date-time with DST/non-DST hour differently based on default timezone in [e5b4624b8b](https://github.com/php/php-src/commit/e5b4624b8b) by Derick Rethans 💜
* Add ‘const’ to match actual API in [dd365b044a](https://github.com/php/php-src/commit/dd365b044a) by Derick Rethans 💜
* Fix: sockets constants in [GH-9533](https://github.com/php/php-src/pull/9533) by Bruce Dou
* Integrate timelib 2022.02 in [06d4c70e51](https://github.com/php/php-src/commit/06d4c70e51) by Derick Rethans 💜
* Use `const` for fixed API in [f8b27c73c9](https://github.com/php/php-src/commit/f8b27c73c9) by Derick Rethans 💜
* Add test case for timelib #124 in [7448ee365c](https://github.com/php/php-src/commit/7448ee365c) by Derick Rethans 💜
* Update `NEWS` in [0f9351669b](https://github.com/php/php-src/commit/0f9351669b) by Derick Rethans 💜
* Fix cleanup of fileinfo test in [52850a4c0f](https://github.com/php/php-src/commit/52850a4c0f) by Ilija Tovilo 💜
* Improve flaky php-cli server test in [481a7eb2d4](https://github.com/php/php-src/commit/481a7eb2d4) by Ilija Tovilo 💜
* Skip 64-bit specific date test on 32-bit in [2cdf7b91e5](https://github.com/php/php-src/commit/2cdf7b91e5) by Ilija Tovilo 💜
* Don’t throw CompileError after parsing in [7e860eaef0](https://github.com/php/php-src/commit/7e860eaef0) by Ilija Tovilo 💜
* Add clang ASAN/UBSAN push job in [GH-9507](https://github.com/php/php-src/pull/9507) by Ilija Tovilo 💜
* Skip nightly coverage job in forks in [0451eded79](https://github.com/php/php-src/commit/0451eded79) by Ilija Tovilo 💜
* remove `LIBZIP_VERSION` constant def from stub in [946cdb8ad1](https://github.com/php/php-src/commit/946cdb8ad1) by Remi Collet
* zip version bump to 1.21.1 in [ef4c20dea9](https://github.com/php/php-src/commit/ef4c20dea9) by Remi Collet
* Fix serialization of empty `SplFixedArray` in [70ad93dd6e](https://github.com/php/php-src/commit/70ad93dd6e) by Nikita Popov
* Backport skipping of `ext/date/tests/gh-124.phpt` on ASAN in [dbbb7427be](https://github.com/php/php-src/commit/dbbb7427be) by Ilija Tovilo 💜
* Fix class link observer with `file_cache_only=1` in [GH-9550](https://github.com/php/php-src/pull/9550) by Ilija Tovilo 💜
* Fix test in "`DEBUG_NTS_OPCACHE` Without interned strings" build in [ac54bfb17c](https://github.com/php/php-src/commit/ac54bfb17c) by Arnaud Le Blanc 💜
* Fix test with `POSIX_RLIMIT_FSIZE` and `gcov` in [3f1e9235e1](https://github.com/php/php-src/commit/3f1e9235e1) by Ilija Tovilo 💜
* Fix UB pointer arithmetics on `NULL` in [GH-9559](https://github.com/php/php-src/pull/9559) by Ilija Tovilo 💜
* Work around `dl(mysqli)` issue with OPcache on AppVeyor in [GH-9557](https://github.com/php/php-src/pull/9557) by Christoph M. Becker
* Don’t set rpath for fuzzers in [5f0cbcff3a](https://github.com/php/php-src/commit/5f0cbcff3a) by Nikita Popov
* `fileinfo`: magic: Backport mime type support for `woff/woff2` fonts in [34fa65a6c2](https://github.com/php/php-src/commit/34fa65a6c2) by Anatol Belski
* NEWS: Add entry for [GH-8805](https://github.com/php/php-src/issues/8805) in [54701ea3e7](https://github.com/php/php-src/commit/54701ea3e7) by Anatol Belski
* NEWS: Add entry for [GH-8805](https://github.com/php/php-src/issues/8805) in [eba3be4d38](https://github.com/php/php-src/commit/eba3be4d38) by Anatol Belski
* Fix memory leak in [8a1f7fa721](https://github.com/php/php-src/commit/8a1f7fa721) by Dmitry Stogov
* Fixed warning in [33918f999d](https://github.com/php/php-src/commit/33918f999d) by Dmitry Stogov
* Fix [GH-9574](https://github.com/php/php-src/issues/9574): `SOCKET_EPROTO` constant missing since PHP 8.2 dev in [GH-9575](https://github.com/php/php-src/pull/9575) by Christoph M. Becker
* Fix SSA construction and type inference in [7496a400aa](https://github.com/php/php-src/commit/7496a400aa) by Dmitry Stogov
* Use external diff tool if `TEST_PHP_DIFF_CMD` env var is set in [d7d6794f94](https://github.com/php/php-src/commit/d7d6794f94) by Derick Rethans 💜
* Reorder conditions to avoid valgrind “Conditional jump or move depends on uninitialised value” warning in [e488f7b0eb](https://github.com/php/php-src/commit/e488f7b0eb) by Dmitry Stogov
* declare random globals as public API in [28a4d7676a](https://github.com/php/php-src/commit/28a4d7676a) by Remi Collet
* Remove superfluous helper variable in `Randomizer::getBytes()` in [GH-9563](https://github.com/php/php-src/pull/9563) by Joshua Rüsweg
* Intern string values of internal classes to prevent their future interning during inheritance in [3a46f9fd1d](https://github.com/php/php-src/commit/3a46f9fd1d) by Dmitry Stogov
* Drop dead `ENABLE_TEST_CLASS` check in [0b2fe40d23](https://github.com/php/php-src/commit/0b2fe40d23) by Nikita Popov
* `PS(mod_user_class_name)` must not leak into next request in [3071d85a6b](https://github.com/php/php-src/commit/3071d85a6b) by Ilija Tovilo 💜
* Indirect call reduction for Jit code in [52f4ed16e0](https://github.com/php/php-src/commit/52f4ed16e0) by wxue1
* Fixed undefined macros warnings in [18cd80c327](https://github.com/php/php-src/commit/18cd80c327) by Patrick Allaert
* Replace reallocarray with safe_perealloc in [GH-9593](https://github.com/php/php-src/pull/9593) by Ilija Tovilo 💜
* Check “ssa_op” before dereference (it may be NULL for opcache.jit=51) in [95d9e5157f](https://github.com/php/php-src/commit/95d9e5157f) by Dmitry Stogov
* Use true return type for XML functions which always return true in [GH-9539](https://github.com/php/php-src/pull/9539) by George Peter Banyard 💜
* Revert “Fix `parse_url()`: can not recognize port without scheme” in [GH-9569](https://github.com/php/php-src/pull/9569) by Andy Postnikov
* Migrate community job to GitHub actions in [e10961b27f](https://github.com/php/php-src/commit/e10961b27f) by Ilija Tovilo 💜
* Fix typo (`from` → `form`) in [GH-9609](https://github.com/php/php-src/pull/9609) by Christoph M. Becker
* Move Opcache variation job to GitHub actions in [GH-9606](https://github.com/php/php-src/pull/9606) by Ilija Tovilo 💜
* Migrate MSAN build to GitHub actions in [9377c30577](https://github.com/php/php-src/commit/9377c30577) by Ilija Tovilo 💜
* Enable dl-test for msan job in [6a2875bd3d](https://github.com/php/php-src/commit/6a2875bd3d) by Ilija Tovilo 💜
* Migrate `--repeat 2` job to GitHub actions in [2cf7d70e53](https://github.com/php/php-src/commit/2cf7d70e53) by Ilija Tovilo 💜
* Migrate variation job to GitHub actions in [90b437229f](https://github.com/php/php-src/commit/90b437229f) by Ilija Tovilo 💜
* Migrate `libmysqlclient` job to GitHub actions in [GH-9608](https://github.com/php/php-src/pull/9608) by Ilija Tovilo 💜
* Remove symfony and laravel from PHP-8.0 community job in [afcaf3bd86](https://github.com/php/php-src/commit/afcaf3bd86) by Ilija Tovilo 💜
* Remove unused azure pipelines templates in [a9c66f0064](https://github.com/php/php-src/commit/a9c66f0064) by Ilija Tovilo 💜
* Remove unused azure pipelines files from PHP-8.1 branch in [1265115640](https://github.com/php/php-src/commit/1265115640) by Ilija Tovilo 💜
* Backport community build to PHP-8.0 branch in [b655451439](https://github.com/php/php-src/commit/b655451439) by Ilija Tovilo 💜
* `fileinfo`: tests: Disable times sensitive tests on debug build in [cab2f05f5a](https://github.com/php/php-src/commit/cab2f05f5a) by Anatol Belski
* Add `travis_wait` to travis for `test.sh` in [8c20ad1081](https://github.com/php/php-src/commit/8c20ad1081) by Ilija Tovilo 💜
* Fix memory leak in [8258b7731b](https://github.com/php/php-src/commit/8258b7731b) and [c083efb779](https://github.com/php/php-src/commit/c083efb779) by Dmitry Stogov
* List skipped extensions explicitly in [GH-8363](https://github.com/php/php-src/pull/8363) by Michael Voříšek
* Fixed type inference in [94b8c2da9f](https://github.com/php/php-src/commit/94b8c2da9f) by Dmitry Stogov
* Set `SA_ONSTACK` in zend_sigaction in [GH-9597](https://github.com/php/php-src/pull/9597) by Kévin Dunglas
* Improve string class constant code generation in [GH-9577](https://github.com/php/php-src/pull/9577) by Máté Kocsis 💜
* Throw in `FFI::addr()` when referencing temporary pointer in [GH-9601](https://github.com/php/php-src/pull/9601) by Ilija Tovilo 💜
* Switch to sanitize `CFLAGS` for community build in [12afd0cba8](https://github.com/php/php-src/commit/12afd0cba8) by Ilija Tovilo 💜
* Uniform placing of `init_fcall` guards in [ca93e48b77](https://github.com/php/php-src/commit/ca93e48b77) by Dmitry Stogov
* Add CVEs in [6f586ef90f](https://github.com/php/php-src/commit/6f586ef90f) by Derick Rethans 💜
* Fix `run-tests.php` for explicitly given test cases in [GH-9617](https://github.com/php/php-src/pull/9617) by Christoph M. Becker
* Fix [GH-9583](https://github.com/php/php-src/issues/9583): session_create_id() fails with user defined save handler that doesn’t have a validateId() method in [8b115254c0](https://github.com/php/php-src/commit/8b115254c0) by George Peter Banyard 💜
* Fix regression introduced by fixing bug 81726 in [GH-9620](https://github.com/php/php-src/pull/9620) by Christoph M. Becker
* Rework FPM tests logging for better debugging in [1e8fa6607d](https://github.com/php/php-src/commit/1e8fa6607d) by Jakub Zelenka 💜
* Fix new `bug81726.phpt` for PHP 8.0 in [GH-9621](https://github.com/php/php-src/pull/9621) by Christoph M. Becker
* Fix new `bug81726.phpt` for PHP 8.0 in [809176dab0](https://github.com/php/php-src/commit/809176dab0) by Christoph M. Becker
* Wrap JIT compiler with `zend_try` to recover in case of memory overflow in [2568db287d](https://github.com/php/php-src/commit/2568db287d) by Dmitry Stogov
* Fix invalid label before `}` in [GH-9624](https://github.com/php/php-src/pull/9624) by Ilija Tovilo 💜
* Fix PHP-8.0 skipping for some jobs in [958955e62a](https://github.com/php/php-src/commit/958955e62a) by Ilija Tovilo 💜
* Skip some OCI tests with repeat in [93e509fd8c](https://github.com/php/php-src/commit/93e509fd8c) by Ilija Tovilo 💜
* Fix PHP-8.0 skipping for community steps in [03a48b1209](https://github.com/php/php-src/commit/03a48b1209) and[ f518ae50aa](https://github.com/php/php-src/commit/f518ae50aa) by Ilija Tovilo 💜

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

A special mention goes to [mailcoach.app](https://mailcoach.app/) for providing us with a platform for the newsletter.

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more.

