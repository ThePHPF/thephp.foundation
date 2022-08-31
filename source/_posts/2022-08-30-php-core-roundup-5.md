
---
title: 'PHP Core Roundup #5'
layout: post
tags:
    - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 31 August 2022
---

Welcome to the fifth edition of _PHP Core Roundup,_ a [series of posts](https://thephp.foundation/blog/tag/roundup/) that round up updates and news on the latest improvements, discussions, bug fixes, and new features in PHP. 

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


[Roman Pronskiy](https://twitter.com/pronskiy/), administration member of the PHP Foundation, also writes a monthly series about updates on the PHP Foundation, which are available under [The PHP Foundation Update](https://thephp.foundation/blog/tag/update/) tag on the blog.

Elena Rubashevska from Open Collective interviewed Roman about the PHP Foundation, why and how it came to be, and his thoughts on the future of PHP, which you can read at [PHP Foundation: Alive and Kicking](https://blog.opencollective.com/php-foundation-alive-and-kicking/).


## PHP 8.2 Branching Out

PHP 8.2 [reached its feature-freeze](https://thephp.foundation/blog/2022/07/28/php-core-roundup-4/#php-8.2-feature-freeze), and [release managers](https://thephp.foundation/blog/2022/05/30/php-core-roundup-2/#php-8.2-release-managers) have branched the PHP-8.2 branch on Aug 30th. 

Now that PHP 8.2 is branched out, the `master` branch will be the development branch for PHP 8.3. Bug fixes and other improvements will be cherry-picked for PHP 8.2 (and older branches) as appropriate, but new features that are made to the master branch will not be merged to the PHP 8.2 branch.

Tools that build PHP based on the Git branches will also see the new branch, and the builds from the `master` branch will be named “PHP 8.3” for the first time. 


## PHP 8.2 Release Candidates

We already have PHP 8.2 beta releases, and the first PHP 8.2 Release Candidate (PHP 8.2.0-RC1) will be released on Sept 1st.


## Remaining minor changes to PHP 8.2

Although the PHP 8.2 feature-freeze is passed, there are few changes that Jakub Zelenka [proposed](https://externals.io/message/118438) merging, and a few more by other contributors that are now merged to PHP 8.2. All of the changes are contained (in that, they don’t drastically change other parts of PHP apart from that proposed change), and do not include any syntax changes.


* Add `libxml_get_external_entity_loader()` in PR [#7977](https://github.com/php/php-src/pull/7977) by Tim Starling
* Add `openssl_cipher_key_length` function in PR [#9368](https://github.com/php/php-src/pull/9368) by Jakub Zelenka
* Implement FR [#76935](https://bugs.php.net/bug.php?id=76935): OpenSSL chacha20-poly1305 AEAD support in PR [#9366](https://github.com/php/php-src/pull/9366) by Jakub Zelenka
* Improved responses to different requests on static resources in built-in web server in PR [#8215](https://github.com/php/php-src/pull/8215) by Vedran Miletić
* Fix Issue [#9186](https://github.com/php/php-src/issues/9186): `@strict-properties` can be bypassed using unserialization by Tim Düsterhus, Máté Kocsis, and Tyson Andre


## Recent RFCs, Merged PRs, and Commits

Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net web site](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some of the changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

Derick 💜 has gone through all the date/time notes in the manual and integrated them where possible into said manual. There were literally hundreds of notes, resulting in the following changes: [#1](https://news-web.php.net/php.doc.cvs/19840) [#2](https://news-web.php.net/php.doc.cvs/19867) [#3](https://news-web.php.net/php.doc.cvs/19871)


## RFC Updates and Pull-Request Updates

Following are the RFCs and major pull-requests discussed, voted, and implemented since our last update. 



- **RFC Under Discussion: [Asymmetric Visibility](https://wiki.php.net/rfc/asymmetric-visibility)**

	RFC by Ilija Tovilo 💜 and Larry Garfield propose (who also brought Enums to PHP in PHP 8.2) started a discussion on adding a new syntax to granularly declare visibility conditions (such as public, protected, or private) for class property set operations (such as assigning a value to a class property), while the get operations (reading the class properties) are not restricted.

	This RFC provides a new syntax for declaring the “set” operation visibility of an object property. Specifically:
	
    ```
    class Foo
    {
    	public private(set) string $bar;
    }
    ```

	This code declares a property `$bar` that may be read from `public` scope but may only be modified from `private` scope. It may also be declared `protected(set)` to allow the property to be set from any protected scope (that is, child classes).


    There is an ongoing lengthy [discussion](https://externals.io/message/118353) about this RFC, and Brent Roose has written a [blog post](https://stitcher.io/blog/thoughts-on-asymmetric-visibility) about his take on this RFC too.

- **RFC Under Discussion: [json_validate](https://wiki.php.net/rfc/json_validate)**
	
	Juan Carlos Morales, on his first RFC, proposes to add a new `json_validate()` function that returns if the given string of JSON is a valid JSON. PHP’s `json_decode()` function can emit errors or throw exceptions on strings with invalid JSON, but the proposed json_validate function will be faster and more memory efficient because it does not attempt to build the data structures in memory, but merely validate the given string.

	Juan first emailed the PHP-DEV mailing list [last month](https://externals.io/message/118310), trying to gather feedback. By that time, his proposed name was `is_json`. You can also read and participate in the [discussions](https://externals.io/message/118467) on the mailing list.

- **RFC Under Discussion: <code>StreamWrapper</code> Support for `glob()`**

	In this RFC Timmy Almroth proposes to add support for stream wrappers in the <code>glob()</code> function.

	`glob()` is a function in PHP to list and filter files and/or folders using a globbing pattern. The current implementation of `glob()` is a thin wrapper for POSIX glob(3). While all the Filesystem Functions in PHP support StreamWrappers, `glob()` does not.
	This RFC proposes to add consistently for stream wrappers in glob() function. With stream wrappers supported, glob() function will be able to use any supported and [registered stream wrapper](https://www.php.net/manual/en/wrappers.php) in PHP, similar to how other file system functions: \

	```php
	glob('vfs://*.ext')
	```
    <br>

- **RFC Implemented: [Constants in Traits](https://wiki.php.net/rfc/constants_in_traits)**

	Shinji Igarashi and Stephen Reay's RFC to allow defining constants in traits is now implemented in PHP 8.2.

	Constants defined in traits use the same syntax as class constants, and work similarly to class constants when the traits are used in classes. However, direct access to trait constants (without going through the classes that use the trait), and using traits in classes that both have the same constant names is not allowed.

	All of the following constant declarations will work in PHP 8.2, but not allowed in older PHP versions:

	```php
	trait FooBar {
		const FOO = 'foo';
		private const BAR = 'bar';
        final const BAZ = 'baz';
        final protected const QUX = 'qux';
    }
    ```
   <br>


- **New Pull Request: [Allow writing to readonly properties during cloning](https://github.com/php/php-src/pull/9403)**

	Nicolas Grekas has an open pull-request currently being discussed to allow setting or unsetting a property once when an object is being cloned (in the `__clone()` magic method). 

	There is a lengthy discussion in the PR itself, and a [Twitter thread](https://twitter.com/nicolasgrekas/status/1561960616331546625) started by Nicolas: 

    <blockquote class="twitter-tweet"><p lang="en" dir="ltr">Here is a proposal, for <a href="https://twitter.com/hashtag/PHP?src=hash&amp;ref_src=twsrc%5Etfw">#PHP</a> 8.3? <a href="https://t.co/bjvBXBhkzF">https://t.co/bjvBXBhkzF</a> <a href="https://t.co/d46FckQDc0">pic.twitter.com/d46FckQDc0</a></p>&mdash; Nicolas Grekas 💙💛 (@nicolasgrekas) <a href="https://twitter.com/nicolasgrekas/status/1561960616331546625?ref_src=twsrc%5Etfw">August 23, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

    This might lead to an RFC in the coming weeks and it might as well be the first RFC for PHP 8.3!


## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes,  the PHP core developers review all pull requests.

 - Máté Kocsis 💜 on his series of declaring extension constants in stub files for several extensions
   - `ext/sqlite3` in [GH-9181](https://github.com/php/php-src/pull/9181)
   - `ext/gd` in [GH-9180](https://github.com/php/php-src/pull/9180)
   - `ext/pcntl` in [GH-9075](https://github.com/php/php-src/pull/9075)
   - `ext/tokenizer` in [GH-9148](https://github.com/php/php-src/pull/9148)
   - `ext/sodium` in [GH-9225](https://github.com/php/php-src/pull/9225)
   - `ext/spl` in [GH-9226](https://github.com/php/php-src/pull/9226)
   - `ext/intl` constants in stubs, in series [GH-9205](https://github.com/php/php-src/pull/9205), [GH-9219](https://github.com/php/php-src/pull/9219), [GH-9233](https://github.com/php/php-src/pull/9233), [GH-9234](https://github.com/php/php-src/pull/9234), [GH-9267](https://github.com/php/php-src/pull/9267), [GH-9268](https://github.com/php/php-src/pull/9268), [GH-9269](https://github.com/php/php-src/pull/9269), [GH-9275](https://github.com/php/php-src/pull/9275), [GH-9276](https://github.com/php/php-src/pull/9276), [GH-9280](https://github.com/php/php-src/pull/9280), [GH-9281](https://github.com/php/php-src/pull/9281), [GH-9282](https://github.com/php/php-src/pull/9282), [GH-9385](https://github.com/php/php-src/pull/9385), and [GH-9387](https://github.com/php/php-src/pull/9387)
   - `ext/zip` in [GH-9146](https://github.com/php/php-src/pull/9146)
   - `ext/sockets` in [GH-9349](https://github.com/php/php-src/pull/9349)
   - `ext/curl` in [GH-9384](https://github.com/php/php-src/pull/9384)
   - `ext/tidy` in [GH-9383](https://github.com/php/php-src/pull/9383)
   - `phpdbg` in [GH-9392](https://github.com/php/php-src/pull/9392)
   - `ext/standard` in series [GH-9404](https://github.com/php/php-src/pull/9404), [GH-9426](https://github.com/php/php-src/pull/9426), and [GH-9427](https://github.com/php/php-src/pull/9427)
   - `ext/oci8` in [GH-9419](https://github.com/php/php-src/pull/9419)
 - Derick Rethans 💜 on DateTime extension bug fixes, improvements, and major documentation improvements.
   - Updated to version 2022.2 (2022b) in [c6992121cc](https://github.com/php/php-src/commit/c6992121cc), [455c40da50](https://github.com/php/php-src/commit/455c40da50), and [2fbea217c2](https://github.com/php/php-src/commit/2fbea217c2)
   - The data for Tehran has changed, update test in [962d8bd0b6](https://github.com/php/php-src/commit/962d8bd0b6)
   - Fixed bug [GH-9431](https://github.com/php/php-src/issues/9431): `DateTime::getLastErrors()` not returning false when no errors/warnings in [932586c426](https://github.com/php/php-src/commit/932586c426)
   - Major improvements in DateTime extension documentation in [`1a9ee818e`](https://github.com/php/doc-en/commit/1a9ee818e554e116b4721d432c6d671e14281ea0), [`c249f3bc56`](https://github.com/php/doc-en/commit/c249f3bc56fcdb3ea3f64b1fa0c4fd96a7dcd5a4), and [`5c951013`](https://github.com/php/doc-en/commit/5c951013ca04161992efed8b86fb40f55669958e)
 - Fixed [GH-9200](https://github.com/php/php-src/issues/9200): setcookie has an obsolete expires date format in [15e3fcb468](https://github.com/php/php-src/commit/15e3fcb468) by Derick Rethans 💜
 - Simplify and move check for too high expiry time, which you can't reach on 32bit systems in [a6a5d46704](https://github.com/php/php-src/commit/a6a5d46704) by Derick Rethans 💜
 - `ext/random` improvements by Tim Düsterhus
   - Improve error messages in `php_random_bytes()` in [GH-9169](https://github.com/php/php-src/pull/9169)
   - Improve phrasing in argument value errors in `ext/random` in [GH-9206](https://github.com/php/php-src/pull/9206)
   - Unify `ext/random` unserialize errors with `ext/date` in [GH-9185](https://github.com/php/php-src/pull/9185)
   - Clean up nested exceptions without value-add in `ext/random` in [GH-9211](https://github.com/php/php-src/pull/9211)
   - Clean up the implementation of `Randomizer::__construct()` in [GH-9222](https://github.com/php/php-src/pull/9222)
   - Fix PcgOneseq128XslRr64::__construct() definition in `random.stub.php` in [GH-9235](https://github.com/php/php-src/pull/9235)
   - Add `ext/random` Exception hierarchy in [GH-9220](https://github.com/php/php-src/pull/9220)
   - Fix undefined behavior of MT_RAND_PHP if range exceeds `ZEND_LONG_MAX` in [GH-9197](https://github.com/php/php-src/pull/9197)
   - Handle all-zero state in `Xoshiro256**` in [GH-9250](https://github.com/php/php-src/pull/9250)
   - Replace `RuntimeException` in `Randomizer::nextInt()` by `RandomException` in [GH-9305](https://github.com/php/php-src/pull/9305)
   - Unify structure for `ext/random`'s engine tests in [GH-9321](https://github.com/php/php-src/pull/9321)
   - Fix rand_range32() for umax = UINT32_MAX in [GH-9416](https://github.com/php/php-src/pull/9416)
   - Select `rand_rangeXX()` variant only based on the requested range in [GH-9418](https://github.com/php/php-src/pull/9418)
 - random: split `Randomizer::getInt()` without argument to `Randomizer::nextInt()` in [GH-9057](https://github.com/php/php-src/pull/9057) by zeriyoshi
 - `PcgOneseq128XslRr64::jump()`: Throw `ValueError` for negative `$advance` in [GH-9213](https://github.com/php/php-src/pull/9213) by Anton Smirnov
 - `PcgOneseq128XslRr64::jump()`: Throw `ValueError` for negative `$advance` in [GH-9213](https://github.com/php/php-src/pull/9213) by Anton Smirnov
 - Mbstring bug fixes and improvements by Alex Dowad
   - Move implementation of `mb_strlen` to `mbstring.c` in [94fde1566f](https://github.com/php/php-src/commit/94fde1566f)
   - New implementation of `mb_strimwidth` in [7299096095](https://github.com/php/php-src/commit/7299096095)
   - Fix legacy text conversion filter for CP50220 in [44b4fb2c36](https://github.com/php/php-src/commit/44b4fb2c36), UCS-4 in [0a6ea5bd4e](https://github.com/php/php-src/commit/0a6ea5bd4e), UTF7-IMAP in [219fff376b](https://github.com/php/php-src/commit/219fff376b), UTF-16 in [e1351eb0a6](https://github.com/php/php-src/commit/e1351eb0a6), 'HTML-ENTITIES' in [d617fcaae2](https://github.com/php/php-src/commit/d617fcaae2), CP50220 in [3517a70f93](https://github.com/php/php-src/commit/3517a70f93), and SJIS-2004 in [18e526cb51](https://github.com/php/php-src/commit/18e526cb51)
   - In legacy text conversion filters, reset filter state in 'flush' function in [f3c8efd711](https://github.com/php/php-src/commit/f3c8efd711)
   - Move kana conversion function to `mbfilter_cp5022x.c` in [78ee18413f](https://github.com/php/php-src/commit/78ee18413f)
   - `mb_strimwidth` inserts error markers in invalid input string (for backwards compatibility) in [5370f344d2](https://github.com/php/php-src/commit/5370f344d2)
   - Use new encoding conversion filters for mb_parse_str and php_mb_post_handler in [aeccb139c3](https://github.com/php/php-src/commit/aeccb139c3)
   - Remove unused 'to_language' and 'from_language' struct fields in [8df515555b](https://github.com/php/php-src/commit/8df515555b)
   - Make control flow in mb_wchar_to_cp50220 a bit clearer in [88d13491de](https://github.com/php/php-src/commit/88d13491de)
   - mitate legacy behavior when converting non-encodings using mbstring in [a4656895dd](https://github.com/php/php-src/commit/a4656895dd)
   - Adjust number of error markers emitted for truncated UTF-8 code units in [128768a450](https://github.com/php/php-src/commit/128768a450)
   - Adjust number of error markers emitted for truncated ISO-2022-JP escape sequence in [c6bd08530e](https://github.com/php/php-src/commit/c6bd08530e)
   - Ensure that Base64 output always wraps lines in the same manner as legacy implementation in [4b370330d4](https://github.com/php/php-src/commit/4b370330d4)
   - Legacy conversion code for '7bit' to '8bit' inserts error markers in [983a29d3c0](https://github.com/php/php-src/commit/983a29d3c0)
   - SJIS-Mobile#SOFTBANK string can end immediately after special escape sequence in [bfccdbd858](https://github.com/php/php-src/commit/bfccdbd858)
   - Fix problems with ISO-2022-KR conversion in [d9269becca](https://github.com/php/php-src/commit/d9269becca)
   - Add test to exercise `_php_mb_encoding_handler_ex` with multiple possible input encodings in [93207535fa](https://github.com/php/php-src/commit/93207535fa)
 - Reintroduce legacy 'SJIS-win' text encoding in mbstring in [371367ce3e](https://github.com/php/php-src/commit/371367ce3e) by Alex Dowad
 - Improve DBA test suite in [GH-8904](https://github.com/php/php-src/pull/8904) by George Peter Banyard 💜
 - Refactor code handling `file.current_zval` in [GH-8934](https://github.com/php/php-src/pull/8934) by George Peter Banyard 💜
 - Fix parentheses warnings in [ba9debb544](https://github.com/php/php-src/commit/ba9debb544) by Nikita Popov
 - Change `fetch_type` from `int` to `uint32_t` in [GH-9152](https://github.com/php/php-src/pull/9152) by George Peter Banyard 💜
 - Fix unused-but-set-variable warnings in timelib in [40af94a24c](https://github.com/php/php-src/commit/40af94a24c) by Nikita Popov
 - Fix unused-but-set-variable warning in `hebrev()` in [6ff662b2e6](https://github.com/php/php-src/commit/6ff662b2e6) by Nikita Popov
 - Avoid K&R style function declarations in `sha1()` in [04f5da4b77](https://github.com/php/php-src/commit/04f5da4b77) by Nikita Popov
 - Suppress unused-but-set-variable warning in parsers in [107ad28350](https://github.com/php/php-src/commit/107ad28350) by Nikita Popov
 - Close stale feature requests in [GH-9182](https://github.com/php/php-src/pull/9182) by Ilija Tovilo 💜
 - Fix attribute target validation on fake closures in [GH-9173](https://github.com/php/php-src/pull/9173) by Ilija Tovilo 💜
 - Fix arrow function with never return type in [GH-9103](https://github.com/php/php-src/pull/9103) by Ilija Tovilo 💜
 - Add an API to manipulate observers at runtime in [9e2de4c2d9](https://github.com/php/php-src/commit/9e2de4c2d9) by Bob Weinand
 - Update `libmysqlclient` version used in CI in [fc394b476b](https://github.com/php/php-src/commit/fc394b476b) by Nikita Popov
 - Declare the `TestInterface::DUMMY` constant in stub in [668dbaf6ab](https://github.com/php/php-src/commit/668dbaf6ab) by Máté Kocsis 💜
 - Fix [GH-9183](https://github.com/php/php-src/issues/9183) Get rid of unnecessary PHPDoc param and return type checks in [GH-9203](https://github.com/php/php-src/pull/9203) by Máté Kocsis 💜
 - Fix unserialize dictionary generation in [828c93bedc](https://github.com/php/php-src/commit/828c93bedc) by Nikita Popov
 - Add `opcache.preload_user=root` to `run-tests.php` if root in [1c9a49e3f1](https://github.com/php/php-src/commit/1c9a49e3f1) by Bob Weinand
 - Fix memory_leak in `zend_test` in [ac31e2e611](https://github.com/php/php-src/commit/ac31e2e611) by Bob Weinand
 - Include internal functions in the observer API in [625f164963](https://github.com/php/php-src/commit/625f164963) by Bob Weinand
 - Fix stale message in `close-stale-feature-requests.yml` in [7804cffe04](https://github.com/php/php-src/commit/7804cffe04) by Ilija Tovilo 💜
 - Fix observer test in [50a3fa49b6](https://github.com/php/php-src/commit/50a3fa49b6) by Bob Weinand
 - Fix `ZEND_RC_DEBUG` build in zend_test observer tests in [b3b21ed558](https://github.com/php/php-src/commit/b3b21ed558) by Bob Weinand
 - `phpdbg` few fixes, mostly printf-like format issues due to C str -> zend_string mismatches. annotate the allocator wrapper in [449edd815b](https://github.com/php/php-src/commit/449edd815b) by David Carlier
 - Hide skipped tests in CI in [GH-9163](https://github.com/php/php-src/pull/9163) by Ilija Tovilo 💜
 - Declare `Transliterator::$id` as `readonly` to unlock subclassing it in [GH-9167](https://github.com/php/php-src/pull/9167) by Nicolas Grekas
 - Fix SSA reconstruction when body of "foreach" loop is removed in [af1a7b7b72](https://github.com/php/php-src/commit/af1a7b7b72) by Dmitry Stogov
 - Fix incorrect guard motion out of the loop in [69c10aed58](https://github.com/php/php-src/commit/69c10aed58) by Dmitry Stogov
 - Tracing: Prevent recording types of variables used to pass `zend_class_entry` in [2758ff2a77](https://github.com/php/php-src/commit/2758ff2a77) by Dmitry Stogov
 - SPL: Use new improved `is_line_empty()` function instead of the old one in [GH-9217](https://github.com/php/php-src/pull/9217) by George Peter Banyard 💜
 - Extended `map_ptr` before copying class table in [GH-9188](https://github.com/php/php-src/pull/9188) by Arnaud Le Blanc 💜
 - Fix bug [#65489](https://bugs.php.net/bug.php?id=65489): `glob()` `basedir` check is inconsistent in [e5ab9f45d5](https://github.com/php/php-src/commit/e5ab9f45d5) by Jakub Zelenka 💜
 - Fix [GH-8396](https://github.com/php/php-src/issues/8396): Network online test using https broken in [dc01fce36d](https://github.com/php/php-src/commit/dc01fce36d) by Jakub Zelenka 💜
 - Also fix `?->` on magic consts in const expressions in [7b43d819c8](https://github.com/php/php-src/commit/7b43d819c8) by Ilija Tovilo 💜
 - DIM on null in const expr should emit warning in [3663f7661a](https://github.com/php/php-src/commit/3663f7661a) by Ilija Tovilo 💜
 - Avoid unnecessary comparison in [GH-9246](https://github.com/php/php-src/pull/9246) by Christoph M. Becker
 - Convert some macros to `zend_always_inline` functions in [GH-8288](https://github.com/php/php-src/pull/8288) by George Peter Banyard 💜
 - Add conflict markers for dba tests in [f11228cdbe](https://github.com/php/php-src/commit/f11228cdbe) by Christoph M. Becker
 - Remove `ZEND_DVAL_TO_LVAL_CAST_OK` in [GH-9215](https://github.com/php/php-src/pull/9215) by Go Kudo
 - Save previous observer on the VM stack in [dc5475c191](https://github.com/php/php-src/commit/dc5475c191) by Bob Weinand
 - Add proper handling to observe functions in fibers in [da94baf31a](https://github.com/php/php-src/commit/da94baf31a) by Bob Weinand
 - CI: `macos-10.15` -> `macos-11` in [GH-9087](https://github.com/php/php-src/pull/9087) by Go Kudo
 - Implement constants in traits in [GH-8888](https://github.com/php/php-src/pull/8888) by sji
 - Fix unstable sapi test, fix [GH-9140](https://github.com/php/php-src/issues/9140) in [GH-9184](https://github.com/php/php-src/pull/9184) by Michael Voříšek
 - zend allocators adding `__declspec` allocator for windows in [GH-9253](https://github.com/php/php-src/pull/9253) by David CARLIER
 - Fix `mb_strimwidth` RC info in [GH-9254](https://github.com/php/php-src/pull/9254) by Ilija Tovilo 💜
 - Fix [GH-9244](https://github.com/php/php-src/issues/9244): Segfault with `array_multisort` + `array_shift` in [GH-9247](https://github.com/php/php-src/pull/9247) by Christoph M. Becker
 - Fix [GH-8472](https://github.com/php/php-src/issues/8472): `stream_socket_accept` result may have incorrect metadata in [d9ff5e079f](https://github.com/php/php-src/commit/d9ff5e079f) by Jakub Zelenka 💜
 - Fix [GH-9248](https://github.com/php/php-src/issues/9248): Segmentation fault in `mb_strimwidth()` in [GH-9273](https://github.com/php/php-src/pull/9273) by Christoph M. Becker
 - Make `"{$g{'h'}}"` emit fatal error and no incorrect deprecation notice in 8.2 in [GH-9264](https://github.com/php/php-src/pull/9264) by Tyson Andre
 - Windows arm64 zend and standard extension support in [GH-9115](https://github.com/php/php-src/pull/9115) by dixyes
 - Fix [GH-9266](https://github.com/php/php-src/issues/9266): GC root buffer keeps growing when dtors are present in [GH-9265](https://github.com/php/php-src/pull/9265) by Michael Olšavský
 - Windows arm64 build system support in [GH-9116](https://github.com/php/php-src/pull/9116) by dixyes
 - QA - `pcntl` - adjust tests set/get priority check env vars and root user in [663b037c7b](https://github.com/php/php-src/commit/663b037c7b) by jcm
 - Fixes CI macOs, replacing now disabled tidyp dependency to tidy-html5 in [8aeae636e3](https://github.com/php/php-src/commit/8aeae636e3) by Vladislav Senin
 - Fix order of checks to throw exception with better message in [18183ff9c7](https://github.com/php/php-src/commit/18183ff9c7) by Dmitry Stogov
 - Add `--[no-]progress` option to `run-tests.php` in [GH-9255](https://github.com/php/php-src/pull/9255) by Ilija Tovilo 💜
 - Fix [GH-9296](https://github.com/php/php-src/issues/9296): `ksort` behaves incorrectly on arrays with mixed keys in [GH-9293](https://github.com/php/php-src/pull/9293) by Denis Vaksman
 - Make pestr[n]dup infallible in [GH-9295](https://github.com/php/php-src/pull/9295) by Ilija Tovilo 💜
 - Show function name when dumping fake closure in [GH-9306](https://github.com/php/php-src/pull/9306) by Ilija Tovilo 💜
 - Fix `run-tests.php` --no-progress flag for non-parallel testing in [c809a213f2](https://github.com/php/php-src/commit/c809a213f2) by Ilija Tovilo 💜
 - reallocarray using proper inline facility to check overflow on windows in [GH-9300](https://github.com/php/php-src/pull/9300) by David CARLIER
 - Fix [GH-9309](https://github.com/php/php-src/issues/9309): Segfault when connection is used after imap_close() in [GH-9313](https://github.com/php/php-src/pull/9313) by Christoph M. Becker
 - Fix [GH-8409](https://github.com/php/php-src/issues/8409): SSL handshake timeout persistent connections hanging in [d0527427be](https://github.com/php/php-src/commit/d0527427be) by Jakub Zelenka 💜
 - Update expires format for session cookie in [GH-9304](https://github.com/php/php-src/pull/9304) by Tim Düsterhus
 - Remove useless UNEXPECTED around RETURN_VALUE_USED in specialized RETVAL handler in [GH-9329](https://github.com/php/php-src/pull/9329) by Ilija Tovilo 💜
 - Fix unexpected deprecated dynamic property warning in [GH-9324](https://github.com/php/php-src/pull/9324) by twosee
 - Correct IntlDateFormatter::formatObject params in [GH-9341](https://github.com/php/php-src/pull/9341) by Gert de Pagter
 - zend introduce const GNUC attribute. sub optimisation where there is no pointers, nor particular memory layout, thread local/volatile ... involved. usage concealed for now into little pack helpers. Closes #9326 in [db64c1cb70](https://github.com/php/php-src/commit/db64c1cb70) by David Carlier
 - random left rotates annotating as const in [GH-9346](https://github.com/php/php-src/pull/9346) by David CARLIER
 - PHP-8.1 is now for PHP 8.1.11-dev in [7f26661993](https://github.com/php/php-src/commit/7f26661993) by Ben Ramsey
 - Prepare for 8.0.24 in [7c6316ad1c](https://github.com/php/php-src/commit/7c6316ad1c) by Gabriel Caruso
 - Fix [GH-9339](https://github.com/php/php-src/issues/9339): OpenSSL oid_file path check warning contains uninitialized path in [84dcf578b1](https://github.com/php/php-src/commit/84dcf578b1) by Jakub Zelenka 💜
 - Fix [GH-9316](https://github.com/php/php-src/issues/9316): $http_response_header is wrong for long status line in [GH-9319](https://github.com/php/php-src/pull/9319) by Christoph M. Becker
 - add compat stuff for function attributes in [aa702c5459](https://github.com/php/php-src/commit/aa702c5459) by Remi Collet
 - Fix bug [#79451](https://bugs.php.net/bug.php?id=79451): Using DOMDocument->replaceChild on doctype causes double free in [GH-9201](https://github.com/php/php-src/pull/9201) by NathanFreeman
 - Fix GCC 9.4 uninitialized variable warning in [410e5d48a3](https://github.com/php/php-src/commit/410e5d48a3) by Tim Starling
 - Fix [GH-9323](https://github.com/php/php-src/issues/9323): crash when the VM enters userspace code via the GC in [GH-9323](https://github.com/php/php-src/pull/9323) by Tim Starling
 - Fix bad merge in [5739dd0030](https://github.com/php/php-src/commit/5739dd0030) by George Peter Banyard 💜
 - Fix [GH-9227](https://github.com/php/php-src/issues/9227): Trailing dots and spaces in filenames are ignored in [GH-9229](https://github.com/php/php-src/pull/9229) by Christoph M. Becker
 - Revert Fixed bug [#79451](https://bugs.php.net/bug.php?id=79451) in [d6831e9a5c](https://github.com/php/php-src/commit/d6831e9a5c) by George Peter Banyard 💜
 - opcache jit fix message format for OpenBSD in [52e312afb8](https://github.com/php/php-src/commit/52e312afb8) by David Carlier
 - Fix [#79451](https://bugs.php.net/bug.php?id=79451): `DOMDocument->replaceChild` on doctype causes double free in [GH-9201](https://github.com/php/php-src/pull/9201) by NathanFreeman
 - Fix [GH-9285](https://github.com/php/php-src/issues/9285) Traits cannot be used in `readonly` classes in [0897266219](https://github.com/php/php-src/commit/0897266219) by Máté Kocsis 💜
 - Fix `curl/sync_constants.php` in [GH-9391](https://github.com/php/php-src/pull/9391) by Máté Kocsis 💜
 - Fix `pdo_oci` tests for PHP 8.0 in [305892580e](https://github.com/php/php-src/commit/305892580e) by Michael Voříšek
 - Fix [GH-9361](https://github.com/php/php-src/issues/9361): Segmentation fault on script exit in [GH-9379](https://github.com/php/php-src/pull/9379) by Christoph M. Becker
 - Tracing JIT: Fix incorrect guard elimination in [c9c51eb1f1](https://github.com/php/php-src/commit/c9c51eb1f1) by Dmitry Stogov
 - Add a new zend API to check that strings don't have `NUL` bytes in [GH-9375](https://github.com/php/php-src/pull/9375) by George Peter Banyard 💜
 - Use `bool` instead of `int` in session struct in [e8e015777e](https://github.com/php/php-src/commit/e8e015777e) by George Peter Banyard 💜
 - Add test for negative cookie lifetime in [a75de167bf](https://github.com/php/php-src/commit/a75de167bf) by George Peter Banyard 💜
 - Remove `OnUpdateLazyWrite` validator in [e9749a3c1e](https://github.com/php/php-src/commit/e9749a3c1e) by George Peter Banyard 💜
 - Remove `OnUpdateTransSid` validator in [ad3ee47c6d](https://github.com/php/php-src/commit/ad3ee47c6d) by George Peter Banyard 💜
 - Check sessions are active before output emitted consistently in [a8f8cc207c](https://github.com/php/php-src/commit/a8f8cc207c) by George Peter Banyard 💜
 - Fix memory leaks in [73c2d79fc5](https://github.com/php/php-src/commit/73c2d79fc5) by Dmitry Stogov
 - `SameSite` session cookie prop should behave like other INI settings in [66aed3a86f](https://github.com/php/php-src/commit/66aed3a86f) by George Peter Banyard 💜
 - Don't enforce 64 hit counter on Windows in [GH-9367](https://github.com/php/php-src/pull/9367) by Christoph M. Becker
 - JIT: Make code generation to be consistent with register allocation in [fd74ee7e90](https://github.com/php/php-src/commit/fd74ee7e90) by Dmitry Stogov
 - Fix type inference in [95befc786a](https://github.com/php/php-src/commit/95befc786a) by Dmitry Stogov
 - Drop range inference for `IS_NULL`/`IS_FALSE`/`IS_TRUE` in [567213c32a](https://github.com/php/php-src/commit/567213c32a) by Dmitry Stogov
 - Enum error message consistency in [GH-9350](https://github.com/php/php-src/pull/9350) by Ollie Read
 - Add an API to observe functions and classes being linked in [bf427b732a](https://github.com/php/php-src/commit/bf427b732a) by Bob Weinand
 - Wrap observer notify functions into inlined enabled checks in [396b2aab85](https://github.com/php/php-src/commit/396b2aab85) by Bob Weinand
 - Check at compile time that a built-in class is not being aliased in [GH-9402](https://github.com/php/php-src/pull/9402) by George Peter Banyard 💜
 - Stop JIT hot spot counting in [GH-9343](https://github.com/php/php-src/pull/9343) by wxue1
 - Fix coding style in [205ad0af29](https://github.com/php/php-src/commit/205ad0af29) by Dmitry Stogov
 - Fix typo (Paletter → Palette) in [GH-9414](https://github.com/php/php-src/pull/9414) by Christoph M. Becker
 - Fix `pdo_oci` tests for PHP 8.1 in [GH-9051](https://github.com/php/php-src/pull/9051) by Michael Voříšek
 - Test `oci8` & `pdo_oci` in CI in [GH-8348](https://github.com/php/php-src/pull/8348) by Michael Voříšek
 - [GH-9370](https://github.com/php/php-src/issues/9370): Fix opcache jit protection bits in [e787d9a0dc](https://github.com/php/php-src/commit/e787d9a0dc) by David CARLIER
 - `xmlRelaxNGCleanupTypes()` is deprecated as of `libxml2` 2.10.0 in [GH-9417](https://github.com/php/php-src/pull/9417) by Christoph M. Becker
 - Fix `oci8/pdo_oci` random test failures when run in parallel in [GH-9424](https://github.com/php/php-src/pull/9424) by Michael Voříšek
 - Reduce observer overhead when restoring script from opcache in [GH-9413](https://github.com/php/php-src/pull/9413) by Dmitry Stogov
 - Fix [GH-8348](https://github.com/php/php-src/issues/8348) for nightly in [34d9e089c2](https://github.com/php/php-src/commit/34d9e089c2) by Michael Voříšek
 - **Fix `@strict-prototypes` warning in [3264f2367d](https://github.com/php/php-src/commit/3264f2367d) by Ilija Tovilo 💜**
 - Support test-ini also for phpize builds in [GH-8787](https://github.com/php/php-src/pull/8787) by Christoph M. Becker
 - Fix `pdo_dblib` ext test conflicts when run in parallel in [GH-9430](https://github.com/php/php-src/pull/9430) by Michael Voříšek
 - Do not generate `CONST_CS` when registering constants in [GH-9439](https://github.com/php/php-src/pull/9439) by Máté Kocsis 💜
 - Fix [GH-9310](https://github.com/php/php-src/issues/9310): SSL 	local_cert` and `local_pk` do not respect `open_basedir` restriction in [505e8d2a04](https://github.com/php/php-src/commit/505e8d2a04) by Jakub Zelenka 💜
 - Implement FR [#76935](https://bugs.php.net/bug.php?id=76935): OpenSSL 	chacha20-poly1305	 AEAD support in [1407968891](https://github.com/php/php-src/commit/1407968891) by Jakub Zelenka 💜
 - **Add `openssl_cipher_key_length` function in [35e2a25d83](https://github.com/php/php-src/commit/35e2a25d83) by Jakub Zelenka 💜**
 - **Add `libxml_get_external_entity_loader()` in [11796229f2](https://github.com/php/php-src/commit/11796229f2) by Tim Starling**
 - Drop unsupported `libxml2` 2.10.0 symbols in [GH-9358](https://github.com/php/php-src/pull/9358) by Christoph M. Becker
 - Respond without body to `HEAD` request on a static resource in [4f509058a9](https://github.com/php/php-src/commit/4f509058a9) by Vedran Miletić
 - Respond with HTTP status 405 to `DELETE/PUT/PATCH` request on a static resource in [7065a222b7](https://github.com/php/php-src/commit/7065a222b7) by Vedran Miletić
 - Update NEWS for CLI built-in server changes in [5e9af0d0b0](https://github.com/php/php-src/commit/5e9af0d0b0) by Jakub Zelenka 💜
 - Add a bit verbosity in FPM logs in [335979fe1b](https://github.com/php/php-src/commit/335979fe1b) by Mikhail Galanin
 - FPM fix strict prototype warnings in [GH-8986](https://github.com/php/php-src/pull/8986) by David Carlier
 - Fix `ext/opcache/tests/jit/inc_obj_004.phpt` failure introduced by [fd74ee7e](https://github.com/php/php-src/commit/fd74ee7e909c66f09d8d904a5438b275a13e8738) in [ce42dcf483](https://github.com/php/php-src/commit/ce42dcf483) by Dmitry Stogov
 - Delay fiber VM stack cleanup until after observer has been called in [8fe1db2089](https://github.com/php/php-src/commit/8fe1db2089) by Bob Weinand
 - **Revert "Fix [GH-9296](https://github.com/php/php-src/issues/9296): `ksort` behaves incorrectly on arrays with mixed keys" in [725cb4e8ad](https://github.com/php/php-src/commit/725cb4e8ad) by Christoph M. Becker**
 - JIT: Fix missing type store in [4b884bedc8](https://github.com/php/php-src/commit/4b884bedc8) by Dmitry Stogov
 - Fix memory leak in [4135e6011c](https://github.com/php/php-src/commit/4135e6011c) by Dmitry Stogov
 - Fix [GH-8885](https://github.com/php/php-src/issues/8885): access.log with stderr writes logs to error_log after reload in [f92505cf24](https://github.com/php/php-src/commit/f92505cf24) by Dmitry Menshikov
 - Fix [GH-8885](https://github.com/php/php-src/issues/8885) tests on MacOS in [bcdd9877e1](https://github.com/php/php-src/commit/bcdd9877e1) by Jakub Zelenka 💜
 - Re-add fixed tests for [GH-8885](https://github.com/php/php-src/issues/8885) in [986e7319c5](https://github.com/php/php-src/commit/986e7319c5) by Jakub Zelenka 💜
 - Fix [GH-9347](https://github.com/php/php-src/issues/9347): Current ODBC liveness checks may be inadequate in [GH-9353](https://github.com/php/php-src/pull/9353) by Calvin Buckley
 - Fix bug [#77780](https://bugs.php.net/bug.php?id=77780): "Headers already sent" when previous connection was aborted in [3503b1daa2](https://github.com/php/php-src/commit/3503b1daa2) by Jakub Zelenka 💜
 - Fix FPM tester conflict in [e3034dba3e](https://github.com/php/php-src/commit/e3034dba3e) by Jakub Zelenka 💜
 - Update `gen_stub` to avoid compile errors on duplicate function names in [GH-9406](https://github.com/php/php-src/pull/9406) by Andreas Braun
 - Fix `zend/test` aliases in [ef21bbe66c](https://github.com/php/php-src/commit/ef21bbe66c) by Máté Kocsis 💜
 - Adjust PHPDoc in [869ab3c481](https://github.com/php/php-src/commit/869ab3c481) by Máté Kocsis 💜
 - Remove unused `ext/zend_test` alias functions in [8d78dce902](https://github.com/php/php-src/commit/8d78dce902) by Máté Kocsis 💜
 - Fix [GH-9186](https://github.com/php/php-src/issues/9186) @strict-properties can be bypassed using unserialization in [GH-9354](https://github.com/php/php-src/pull/9354) by Máté Kocsis 💜
 - Catch up dev version numbers in [3d6ed8c852](https://github.com/php/php-src/commit/3d6ed8c852) by Sara Golemon
 - Make `var_export`/`debug_zval_dump` check for infinite recursion on the *object* in [GH-9448](https://github.com/php/php-src/pull/9448) by Tyson Andre
 - Revert "Fix [GH-9296](https://github.com/php/php-src/issues/9296): `ksort` behaves incorrectly on arrays with mixed keys" in [1862152145](https://github.com/php/php-src/commit/1862152145) by Ben Ramsey
 - Fix tests in [65619e868c](https://github.com/php/php-src/commit/65619e868c) by Christoph M. Becker
 - Add NEWS and UPGRADING entries for [GH-9296](https://github.com/php/php-src/issues/9296) in [853181a14d](https://github.com/php/php-src/commit/853181a14d) by Christoph M. Becker
 - Prepare for PHP 8.3 in [327c95237c](https://github.com/php/php-src/commit/327c95237c) by Pierrick Charron


## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

A special mention goes to [mailcoach.app](https://mailcoach.app/) for providing us with a platform for the newsletter.

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more.

