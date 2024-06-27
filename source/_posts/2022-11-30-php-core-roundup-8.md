
---
title: 'PHP Core Roundup #8'
layout: post
tags:
    - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 2 December 2022
---

Welcome to the eighth issue of _PHP Core Roundup_ series! This issue was supposed to bring the great news of PHP 8.2 release, but the PHP 8.2 release date was pushed to December 8, and yet this issue is still full of exciting new updates about what’s being discussed and improved in PHP. 

> The PHP Foundation currently supports six part-time PHP contributors who work on maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.

<br>
We publish the posts on our website, and you can subscribe to a newsletter; You don’t necessarily have to be a PHP Foundation backer to follow _PHP Core Roundup_.

{% include "newsletter.html" %}

## The PHP Foundation: Impact and Transparency Report 2022

[Roman Pronskiy](https://twitter.com/pronskiy) wrote a detailed post on PHP Foundation’s impact, timeline, a summary of contributions made to PHP by PHP Foundation team, governance, financials, and more on [The PHP Foundation: Impact and Transparency Report 2022](https://thephp.foundation/blog/2022/11/22/transparency-and-impact-report-2022/).


## PHP 8.2 to be released on December 8

PHP 8.2 was scheduled to be released on 24th of November. However, because it falls on the US thanksgiving holiday, and to take some time to fix some bugs reported recently, PHP 8.2’s release managers [decided](https://externals.io/message/118991) to postpone the PHP 8.2 GA release to 8th of December. 


## All PHP 7 versions are now End-of-Life

PHP 7.4 is the last version in the PHP 7.4 series, and it reached its end of life on November 28th. This means that there will be no more bugs or security fixes. If you are running any PHP applications on PHP 7 make sure to upgrade to PHP 8, or to obtain Long-term support from a vendor. PHP 7 [still holds](https://php.watch/news/2021/11/php7-eol#stats) (based on [Packagist.org](https://packagist.org/php-statistics) and [WordPress.org](https://wordpress.org/about/stats/) data) the major usage share, so this is alarming. 

## Recent RFCs, Merged PRs, Discussions, and Commits

> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

### RFC Updates

Following are the RFCs and major pull-requests discussed, voted, and implemented since our last update. 

* **RFC Implemented: [Improve unserialize() error handling](https://wiki.php.net/rfc/improve_unserialize_error_handling)**
	
	RFC by Tim Düsterhus, also mentioned in PHP Core Roundup Issue #7, is now implemented in PHP 8.3. This includes improving error handling of the <code>[unserialize()](https://www.php.net/manual/en/function.unserialize.php)</code> function by increasing the error level from <code>E_NOTICE</code> to <code>E_WARNING</code>. 
	
	More information on [PHP.Watch: unserialize(): Upgrade E_NOTICE errors to E_WARNING](https://php.watch/versions/8.3/unserialize-E-WARNING).

* **RFC Declined: [Destructuring Coalesce](https://wiki.php.net/rfc/destructuring_coalesce)**
	
	Bob Weinand proposed to allow coalescing in array destructing with `[$a ?? $b] = $array;`, where `$a` is assigned `$b` if the key in the array is null or missing. This RFC vote did not reach the required ⅔ majority, and was declined.

* **RFC Under Discussion: [More Appropriate Date/Time Exceptions](https://wiki.php.net/rfc/datetime-exceptions) 💜**
	
	RFC by Derick Rethans, proposes to introduce Date/Time extension-specific exceptions and errors. This detailed RFC suggests more specificity in the exceptions with exception classes such as `DateInvalidTimeZoneException`, and `DateMalformedPeriodStringException` as well as promoting some of the current PHP warnings to Error exceptions.
	
	Vincent Langlet also started a related [mailing list discussion](https://externals.io/message/119019) about a week prior to this RFC.

* **RFC Under Discussion: [Readonly amendments](https://wiki.php.net/rfc/readonly_amendments) 💜**
	
	RFC by Nicolas Grekas and Máté Kocsis, attempts to address the shortcomings of PHP 8.1 readonly properties and 8.2 readonly classes.
	
	This RFC proposes allowing `readonly` classes to be extended by non-readonly classes (currently not allowed, and causes a fatal error):
    ```php
    readonly class A {}
    class B extends A {} // Currently this produces a Fatal error
    ```
    <br>

    ... and to allow reinitializing readonly properties during cloning (within the `__clone()` magic method):
    ```php
    class Foo {
        public function __construct(
            public readonly DateTime $bar,
            public readonly DateTime $baz
        ) {}
     
        public function __clone()
        {
            $this->bar = clone $this->bar; // Works
            $this->cloneBaz();
        }
     
        public function cloneBaz()
        {
            $this->baz = clone $this->baz; // Also works
        }
    }
     
    $foo = new Foo(new DateTime(), new DateTime());
    $foo2 = clone $foo;
     
    // No error, Foo::$bar and Foo::$baz are cloned deeply
    ```
    <br>

* **RFC Accepted: [Randomizer Additions](https://wiki.php.net/rfc/randomizer_additions)**
	
	RFC by Joshua Rüsweg and Tim Düsterhus, proposes to add new “building block” methods to `\Random\Randomizer` (added in PHP 8.2) that implement commonly useful operations that are either verbose or very hard to implement in userland.
	
	The RFC proposes to add two new methods: `getBytesFromString`, to generate a random string containing specific characters, and `getFloat`/`nextFloat`, to generate a random floating point value.
	The vote was accepted, and is pending implementation.
	
* **RFC Under Discussion: [Arbitrary static variable initializers](https://wiki.php.net/rfc/arbitrary_static_variable_initializers) 💜**

	RFC by Ilija Tovilo, proposing a series of changes and improvements to static variables in PHP.
	
	The RFC suggests static variable initializers to contain arbitrary expressions. Currently, static variables can only be initialized with constant expressions:
	
	```php
	function foo() {
        static $p = 16; // Allowed
        static $p = getValue(); // Not allowed, proposed to allow
    }
    ```
	<br />
    Further, it also proposes to disallow redeclaring static variables (in the scope of the same function) at compile-time with a fatal error, along with some changes in the Reflection API to account for the changes.
	
### Notable Mailing List Discussions

* [Microseconds to error log](https://externals.io/message/118865)
* [Remove warning when parsing datetime with + symbol](https://externals.io/message/119025)
* [Asymmetric Visibility, with readonly](https://externals.io/message/118994)


## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes,  the PHP core developers review all pull requests.

 - Fix stub type info for `posix_getrlimit` in [c3b9b0f9a7](https://github.com/php/php-src/commit/c3b9b0f9a7) by Ilija Tovilo 💜
 - Fix pre-PHP 8.2 compatibility for `php_mt_rand_range()` with `MT_RAND_PHP` in [GH-9839](https://github.com/php/php-src/pull/9839) by Tim Düsterhus
 - Fix [GH-9754](https://github.com/php/php-src/issues/9754): SaltStack hangs when running php-fpm 8.1.11 in [1c5844aa3e](https://github.com/php/php-src/commit/1c5844aa3e) by Jakub Zelenka 💜
 - Do not display the value of UNKNOWN constants in the manual in [GH-9843](https://github.com/php/php-src/pull/9843) by Máté Kocsis 💜
 - Match FPM status pool's `expose_php` with parent in [e4a1b80a5f](https://github.com/php/php-src/commit/e4a1b80a5f) by Dominic H
 - Fix [GH-9770](https://github.com/php/php-src/issues/9770): Add small timeout in status-listen test in [8229649045](https://github.com/php/php-src/commit/8229649045) by Jakub Zelenka 💜
 - Fix memory leak in [482ae71fda](https://github.com/php/php-src/commit/482ae71fda) by Dmitry Stogov
 - socket add `socket_atmark` support in [4c4e72f149](https://github.com/php/php-src/commit/4c4e72f149) by David CARLIER
 - Use `zend_call_known_function()` in `ext-pgsql` instead of building FCI/FCC in [4f8d10791b](https://github.com/php/php-src/commit/4f8d10791b) by Gina Peter Banyard 💜
 - Use `zend_call_known_function()` in `ext-mysqli` instead of building FCI/FCC in [c0f2727e55](https://github.com/php/php-src/commit/c0f2727e55) by Gina Peter Banyard 💜
 - `labeler.yml`: set top-level read-only permissions in [GH-9862](https://github.com/php/php-src/pull/9862) by Pedro Nacht
 - Timelib: Updated to version 2022.6 (2022f) in [2b5bed904e](https://github.com/php/php-src/commit/2b5bed904e) by Derick Rethans 💜
 - Don’t reset func in `zend_closure_internal_handler` in [8dabbda8bc](https://github.com/php/php-src/commit/8dabbda8bc) by Florian Sowade
 - Tidy up buffer preparation in mysqlnd in [GH-9834](https://github.com/php/php-src/pull/9834) by Kamil Tekiela
 - Fix [GH-9829](https://github.com/php/php-src/issues/9829): Bug in refactoring Windows shmat() function in [GH-9873](https://github.com/php/php-src/pull/9873) by Christoph M. Becker
 - Fix potential NULL pointer dereference Windows `shm*()` functions in [GH-9872](https://github.com/php/php-src/pull/9872) by Christoph M. Becker
 - Fix observing inherited internal functions in [b30448f48f](https://github.com/php/php-src/commit/b30448f48f) by Bob Weinand
 - Store a reference to closures in the FCC in [7c45b95894](https://github.com/php/php-src/commit/7c45b95894) by Gina Peter Banyard 💜
 - Add various APIs to handle FCC structures in [de4cfff5f6](https://github.com/php/php-src/commit/de4cfff5f6) by Gina Peter Banyard 💜
 - Refactor SPL Callback filter to only use FCC in [8d5d3fd035](https://github.com/php/php-src/commit/8d5d3fd035) by Gina Peter Banyard 💜
 - Only use FCC for SQLite3 user defined functions/collations/authorizer in [29bb426933](https://github.com/php/php-src/commit/29bb426933), [37aea43eed](https://github.com/php/php-src/commit/37aea43eed), and [d105958603](https://github.com/php/php-src/commit/d105958603) by Gina Peter Banyard 💜
 - Only use FCC for libxml entity loader callback in [fb114bf45b](https://github.com/php/php-src/commit/fb114bf45b) by Gina Peter Banyard 💜
 - Fix hardcoded paths in test in [4935e10fc8](https://github.com/php/php-src/commit/4935e10fc8) by Bob Weinand
 - Delay releasing closures until after observer end in [8e49d7f32f](https://github.com/php/php-src/commit/8e49d7f32f) by Bob Weinand
 - Properly deal with internal attributes used on promoted properties in [GH-9661](https://github.com/php/php-src/pull/9661) by Martin Schröder
 - Fix fake closure leaking when called from internal func in [GH-9884](https://github.com/php/php-src/pull/9884) by Ilija Tovilo 💜
 - Migrate i386 to GitHub actions in [GH-9856](https://github.com/php/php-src/pull/9856) by Ilija Tovilo 💜
 - Fix duplicate SKIPIF section in [d2c663441d](https://github.com/php/php-src/commit/d2c663441d) by Ilija Tovilo 💜
 - Fix ext section in [bca1e1f557](https://github.com/php/php-src/commit/bca1e1f557) by Ilija Tovilo 💜
 - Disable CLI server `pdeathsig` test on 32-bit GitHub actions in [1fb40b501d](https://github.com/php/php-src/commit/1fb40b501d) by Ilija Tovilo 💜
 - Fix generator memory leaks when interrupted during argument evaluation in [GH-9756](https://github.com/php/php-src/pull/9756) by Arnaud Le Blanc 💜
 - Fix memory leak in [f31f464cec](https://github.com/php/php-src/commit/f31f464cec) by Dmitry Stogov
 - Don't check "fake" closures (fix assertion) in [05b63b1593](https://github.com/php/php-src/commit/05b63b1593) by Dmitry Stogov
 - Fiber: add shadow stack support in [GH-9283](https://github.com/php/php-src/pull/9283) by Chen, Hu
 - Don't skip test on Windows due to missing `ext/posix` in [GH-9886](https://github.com/php/php-src/pull/9886) by Christoph M. Becker
 - Fix cross-compilation for `copy_file_range` in [5d7b64be1d](https://github.com/php/php-src/commit/5d7b64be1d) by Bob Weinand
 - Move `observer_declared_function_notify` until after `pass_two()` in [6bd8f40291](https://github.com/php/php-src/commit/6bd8f40291) by Bob Weinand
 - Fix [GH-9905](https://github.com/php/php-src/issues/9905): `constant()` behaves inconsistent when class is undefined in [GH-9907](https://github.com/php/php-src/pull/9907) by Christoph M. Becker
 - Do not report MINIT stage internal class aliases in extensions in [182314c317](https://github.com/php/php-src/commit/182314c317) by Bob Weinand
 - Fix opcache preload with observers enabled in [4052bbf0e3](https://github.com/php/php-src/commit/4052bbf0e3) by Bob Weinand
 - Fix crash reading `module_entry` after `DL_UNLOAD()` when module already loaded in [0bfdd5691c](https://github.com/php/php-src/commit/0bfdd5691c) by Bob Weinand
 - Make the usage of the role attribute more clear in [GH-9901](https://github.com/php/php-src/pull/9901) by Máté Kocsis 💜
 - No more need to cater to `mime_magic` extension in [5aa13183ae](https://github.com/php/php-src/commit/5aa13183ae) by Christoph M. Becker
 - Disable opcache `file_cache` for observer preloading test in [09f071e63b](https://github.com/php/php-src/commit/09f071e63b) by Ilija Tovilo 💜
 - Remove unused PHP 8.1 BC layer in JIT in [GH-9937](https://github.com/php/php-src/pull/9937) by Ilija Tovilo 💜
 - Skip tests if extension or SAPI is not included. in [GH-9939](https://github.com/php/php-src/pull/9939) by dwo0
 - Fix [GH-9923](https://github.com/php/php-src/issues/9923): Add the `SIGINFO` constant in pcntl for system supporting it in [e0e347b4a8](https://github.com/php/php-src/commit/e0e347b4a8) by David Carlier
 - Fix [GH-9298](https://github.com/php/php-src/issues/9298): remove all registered signal handlers in pcntl RSHUTDOWN in [5ecbb1b39d](https://github.com/php/php-src/commit/5ecbb1b39d) by Erki Aring
 - Fix [GH-9535](https://github.com/php/php-src/issues/9535) (unintended behavior change for mb_strcut in PHP 8.1) in [fa0401b0b5](https://github.com/php/php-src/commit/fa0401b0b5) by NathanFreeman
 - Introduce `TEST_FPM_EXTENSION_DIR` for FPM tests with shared extensions in [db2d32f476](https://github.com/php/php-src/commit/db2d32f476) by Jakub Zelenka 💜
 - Fix memory leak in [a8bd342397](https://github.com/php/php-src/commit/a8bd342397) by Dmitry Stogov
 - Fix regression test for [GH-9535](https://github.com/php/php-src/issues/9535) on PHP-8.2+ in [d3933e0b6c](https://github.com/php/php-src/commit/d3933e0b6c) by Alex Dowad
 - Fix [GH-9890](https://github.com/php/php-src/issues/9890): OpenSSL legacy providers not available on Windows in [GH-9894](https://github.com/php/php-src/pull/9894) by Christoph M. Becker
 - Fix [GH-9932](https://github.com/php/php-src/issues/9932): Discards further characters for session name in [GH-9940](https://github.com/php/php-src/pull/9940) by David Carlier
 - Escape the role attribute of namespaced classes in [GH-9952](https://github.com/php/php-src/pull/9952) by Máté Kocsis 💜
 - Cache UTF-8-validity status of strings in GC flags in [d0d834429f](https://github.com/php/php-src/commit/d0d834429f) by Alex Dowad
 - Promote `unserialize()` notices to warning in [GH-9629](https://github.com/php/php-src/pull/9629) by Tim Düsterhus
 - Remove code for OS2 in [726d595ec7](https://github.com/php/php-src/commit/726d595ec7) by Gina Peter Banyard 💜
 - Use `zend_result` return type instead of innacurate ones in [dbf54e1a8b](https://github.com/php/php-src/commit/dbf54e1a8b) by Gina Peter Banyard 💜
 - Change conditional check in `disk_free_space()` test in [bab9e349cb](https://github.com/php/php-src/commit/bab9e349cb) by Gina Peter Banyard 💜
 - Add WordPress to community build in [GH-9942](https://github.com/php/php-src/pull/9942) by Ilija Tovilo 💜
 - Fix caching of default params with side-effects in [GH-9935](https://github.com/php/php-src/pull/9935) by Ilija Tovilo 💜
 - Fix cross-compilation for `shadow_stack_exists` in [05f4b84940](https://github.com/php/php-src/commit/05f4b84940) by Dmitry Stogov
 - Fix [GH-9650](https://github.com/php/php-src/issues/9650): Can't initialize heap: [0x000001e7] in [GH-9721](https://github.com/php/php-src/pull/9721) by Michael Voříšek
 - Improvements in modifier parsing in [GH-9926](https://github.com/php/php-src/pull/9926) by Ilija Tovilo 💜
 - Use fast text conversion filters to implement mb_convert_variables in [b1954f5fd6](https://github.com/php/php-src/commit/b1954f5fd6) by Alex Dowad
 - Avoid undefined behavior in Windows `ftok(3)` emulation in [GH-9958](https://github.com/php/php-src/pull/9958) by Christoph M. Becker
 - Use `__atomic_test_and_set()` instead of `__sync_test_and_set()` for lsapi in [GH-7997](https://github.com/php/php-src/pull/7997) by Andy Postnikov
 - opcache fixing w/x pages creation on freebsd 13.1 and above in [GH-9896](https://github.com/php/php-src/pull/9896) by David CARLIER
 - Use `__atomic_xxxx()` instead of `__sync_xxxx()` for lsapi in [4bdfce6c1a](https://github.com/php/php-src/commit/4bdfce6c1a) by George Wang
 - For UTF-7, flag unnecessary extra trailing byte in Base64 section as error in [a618682373](https://github.com/php/php-src/commit/a618682373) by Alex Dowad
 - Fix a memory leak in tracig JIT when the same closure is called through `Closure::call()` and natively in [45cb3f917a](https://github.com/php/php-src/commit/45cb3f917a) by Dmitry Stogov
 - Fix [GH-9883](https://github.com/php/php-src/issues/9883): `SplFileObject::__toString()` reads next line in [GH-9912](https://github.com/php/php-src/pull/9912) by Gina Peter Banyard 💜
 - Fix performance degradation introduced in [c2547ab7](https://github.com/php/php-src/commit/c2547ab7dc67646e287d430e44798cb9f327cf21) in [GH-9876](https://github.com/php/php-src/pull/9876) by Gina Peter Banyard 💜
 - Fix mangled kana output for JIS encoding in [8f84192403](https://github.com/php/php-src/commit/8f84192403) by Alex Dowad
 - Handle trampolines correctly in new FCC API + usages in [GH-9877](https://github.com/php/php-src/pull/9877) by Gina Peter Banyard 💜
 - php-fpm: fix Solaris port events.mechanism in [GH-9959](https://github.com/php/php-src/pull/9959) by Petr Sumbera
 - Fix bug [#68207](https://bugs.php.net/bug.php?id=68207): Setting fastcgi.error_header can result in a WARNING in [5a4520bc2b](https://github.com/php/php-src/commit/5a4520bc2b) by Jakub Zelenka 💜
 - Fix bug [#80669](https://bugs.php.net/bug.php?id=80669): FPM numeric user fails to set groups in [94702c56e0](https://github.com/php/php-src/commit/94702c56e0) by Jakub Zelenka 💜
 - Fix [GH-8517](https://github.com/php/php-src/issues/8517): FPM child pointer can be potentially uninitialized in [c9c1934ff0](https://github.com/php/php-src/commit/c9c1934ff0) by Jakub Zelenka 💜
 - Add a note to `php.ini-*` regarding the required order for [GH-8620](https://github.com/php/php-src/issues/8620) in [9416186ff1](https://github.com/php/php-src/commit/9416186ff1) by Jakub Zelenka 💜
 - Fix [GH-9997](https://github.com/php/php-src/issues/9997): OpenSSL engine clean up segfault in [3d90a24e93](https://github.com/php/php-src/commit/3d90a24e93) by Jakub Zelenka 💜
 - Fix [GH-9064](https://github.com/php/php-src/issues/9064): PHP fails to build if openssl was built with no-ec in [ce57221376](https://github.com/php/php-src/commit/ce57221376) by Jakub Zelenka 💜
 - Do not resolve constants on non-linked class during preloading in [GH-9975](https://github.com/php/php-src/pull/9975) by Arnaud Le Blanc 💜
 - Fix [GH-10000](https://github.com/php/php-src/issues/10000): Test failures when OpenSSL compiled with `no-dsa` in [500b28ad04](https://github.com/php/php-src/commit/500b28ad04) by Jakub Zelenka 💜
 - Simplify decoding filter for UTF-8 in [0109aa62ec](https://github.com/php/php-src/commit/0109aa62ec) by Alex Dowad
 - Add a proper error message for ffi load in [GH-9913](https://github.com/php/php-src/pull/9913) by Thomas PIRAS
 - Remove unnecessary usage of `CONST_CS` in [GH-9685](https://github.com/php/php-src/pull/9685) by Jorg Adam Sowa


## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 
