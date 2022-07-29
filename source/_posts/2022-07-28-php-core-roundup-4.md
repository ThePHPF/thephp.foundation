
---
title: 'PHP Core Roundup #4'
layout: post
tags:
    - roundup
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 28 July 2022
---

_PHP Core Roundup_ is a [series of posts](https://thephp.foundation/blog/tag/roundup/) where we make regular updates on improvements, fixes, and new features made to PHP by the _PHP Foundation_ and other contributors. Welcome to the fourth edition in the series, which brings updates about the upcoming PHP 8.2, discussions on a face-lift for the php.net home page, and more.

We’ll be publishing the posts on our website, and you can subscribe to a newsletter; You don’t necessarily have to be a PHP Foundation backer to follow _PHP Core Roundup_.

<div class="px-4 pt-3 pb-10 mb-6 border-b border-t -mx-4 border-gray-200">
    <div class="max-w-xl mx-auto">
        <h2 class="text-xl text-left inline-block font-semibold text-gray-800 mb-1">Subscribe to PHP Foundation Updates</h2>
        <form method="POST" action="https://php-foundation-mailcoach.com/subscribe/9be4e2bd-f9d8-475c-b00e-2dcc4cf90056" class="mt-2">
            <div class="flex items-center">
                <input placeholder="Your email address" type="email" class="w-full px-2 py-4 mr-2  bg-gray-100 shadow-inner rounded-md border border-gray-400 focus:outline-none" name="email" required>
                <button class="bg-[#7f52ff] text-gray-200 px-5 py-2 rounded shadow " style="margin-left: -7.8rem;">Sign Up</button>
            </div>
        </form>
    </div>
</div>


> [The PHP Foundation](https://opencollective.com/phpfoundation) currently supports [six part-time PHP contributors](https://thephp.foundation/blog/2022/05/06/interview-with-core-developers/) who work on both maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.
>
## PHP 8.2 Feature-Freeze

On July 19, PHP 8.2 branch reached its feature-freeze. As the name suggests, the list of features we plan to ship with PHP 8.2 is now frozen. Contributors who wish to make substantial changes to PHP should now target the next PHP version, PHP 8.3.

In the coming weeks, the PHP Foundation members, the PHP development team, and contributors will be making improvements to get PHP 8.2 ready for production release.

Release managers elected for PHP 8.2, Ben Ramsey, Pierrick Charron, and Sergey Panteleev will have the final say in case a major change must be made to the PHP 8.2.


## PHP 8.2 Beta Release

The first beta release of PHP 8.2 was released last week. Now would be an ideal time to test your PHP applications on PHP 8.2.

Compiled Windows binaries are available at [windows.php.net/qa](https://windows.php.net/qa/), [Docker images](https://hub.docker.com/_/php?tab=tags&page=1&name=8.2.0) are available at Docker Hub, and source code at [php/php-src repository on GitHub](https://github.com/php/php-src) to compile yourself. On Homebrew, PHP 8.2-dev packages are available from <code>[shivammathur/php](https://github.com/shivammathur/homebrew-php)</code> tap.

CI/CD platforms that use Docker images can use the PHP 8.2 docker images available with various base images. GitHub Actions can also make use of <code>[shivammathur/setup-php](https://github.com/shivammathur/setup-php)</code> action, which supports PHP 8.2 builds.


## Recent RFCs, Merged PRs, and Commits

Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net web site](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, improving documentation and the php.net web site, and more on a daily basis. Here is a summary of some of the changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.


## PHP 8.2 Release Page and a face-lift to php.net homepage

Sergey Panteleev, one of the release managers for PHP 8.2, made a [pull-request](https://github.com/php/web-php/pull/675) for the upcoming PHP 8.2 release page on php.net. It is still in its early stage, but the idea is to create a similar page highlighting new features in the new version, similar to the release pages for [PHP 8.1](https://www.php.net/releases/8.1/en.php) and [PHP 8.0](https://www.php.net/releases/8.0/en.php).

There is also a new proposal to refresh the php.net web site home page by Mike van Riel, with a relevant [Twitter thread here](https://twitter.com/mvriel/status/1542898919142789123) and a WIP [PR in here](https://github.com/php/web-php/pull/602).

## RFC Updates

Following are the RFCs discussed, voted, and implemented since our last update. 

- **Implemented: [Random Extension](https://wiki.php.net/rfc/rng_extension) and a [follow-up](https://wiki.php.net/rfc/random_extension_improvement) RFC by Go Kudo**

   Go Kudo first-proposed [Object scoped RNG](https://wiki.php.net/rfc/object_scope_prng), back in 2020, and proposed a series of RFCs to improve PHP’s Random Number Generator. The RFCs voted and implemented in PHP 8.2 now refactors PHP functions such as `random_int()`, `random_bytes()`, `rand()`, `mt_rand()` to a new extension called `random`. This is merely an internal refactor, and it is not possible to compile PHP without the extension.

   There is a new PHP class called `\Random\Randomizer`, that can be instantiated with a class object that implements the `\Random\Engine` interface. The extension provides a few implementations built-in, such as `\Random\Engine\Mt19937`, `PcgOneseq128XslRr64`, and `Xoshiro256StarStar`.

- **Implemented: [Disjunctive Normal Form Types](https://wiki.php.net/rfc/dnf_types) RFC by Larry Garfield and George Peter Banyard 💜**

   [Disjunctive Normal Form](https://en.wikipedia.org/wiki/Disjunctive_normal_form) (DNF) is now supported in PHP type declarations. It allows combining Union types (PHP 8.0) and Intersection types (PHP 8.1) to precisely declare a type. 
 
   For example, the it is now possible to declare functions with types like this: 

    ```php
     function showBanner(string|(Stringable&SafeString)|int $value) {}
    ```
	In the snipet above, `showBanner` function's `$value` parameter accepts a `string`, OR Intersection type `Stringable&SafeString`, OR `int`.

- **Implemented: [Fetch properties of enums in const expressions](https://wiki.php.net/rfc/fetch_property_in_const_expressions) by Ilija Tovilo 💜**

    This RFC proposes to allow the use of <code>-></code>/<code>?-></code> to fetch properties of enums in constant expressions. The primary motivation for this change is to allow fetching the name and value properties in places where enum objects aren't allowed, like array keys. There is [currently no way](https://github.com/php/php-src/issues/8344) to express this without repeating the value of the enum case.


    With this change implemented in PHP 8.2, it will be possible to declare expressions like the following:


   ```php
   enum E: string {
       case Foo = 'foo';
   }

   // Constants
   const C = E::Foo->name;  

   // Static variables
   function f() {
       static $v = E::Foo->value;
   }
   

   // Attributes
   #[Attr(E::Foo->name)]
   class C {} 
   

   // Parameter default values
   function f($p = E::Foo->value) {}

   // Property default values
   class C {
       public string $p = E::Foo->name;
   }

   // The rhs of -> allows other constant expressions
   const VALUE = 'value';
   class C {
        const C = E::Foo->{VALUE};
   }
   ```


- **Declined: New Curl URL API by Pierrick Charron**
- **Declined: [`json_encode` indentation](https://wiki.php.net/rfc/json_encode_indentation) by Timon de Groot**
- **Declined: [Short Closures 2.0](https://wiki.php.net/rfc/auto-capture-closure) by Nuno Maduro, Larry Garfield, and Arnaud Le Blanc**
  The RFC missed the 2/3 vote with 27 votes in favor and 16 against.

  It proposed a short syntax for closures, inheriting the features of arrow functions (auto-capture), with multiple statements.

  This received a lot of feedback. Some of which can be addressed, so there is still hope for this feature to land in a future version.

  Some of the authors may propose a new version in PHP 8.3.



## Merged PRs and Commits

Following are some of the changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements. There are automated unit and integration tests for each of these changes, and all pull requests are reviewed by the PHP core developers.



* JIT and Opcache fixes by Dmitry Stogov
    * Fixed bug [GH-8847](https://github.com/php/php-src/issues/8847) (PHP hanging infinitely at 100% CPU when check php syntax of a valid file) in [7cf6f17383](https://github.com/php/php-src/commit/7cf6f17383)
    * Allocate JIT buffer close to PHP .text segment to allow using direct IP-relative calls and jumps in [GH-8890](https://github.com/php/php-src/pull/8890) in [17aa81a5e2](https://github.com/php/php-src/commit/17aa81a5e2)
    * Fix type inference for `FETCH_DI_UNSET` in [bd30eff5de](https://github.com/php/php-src/commit/bd30eff5de)
    * Fix type inference in [82d3ad64df](https://github.com/php/php-src/commit/82d3ad64df)
    * Fix invalid `free()` during type persistence in [f24548e217](https://github.com/php/php-src/commit/f24548e217) and [34b11a7524](https://github.com/php/php-src/commit/34b11a7524)
    * Fix memory leak in [44b86aee31](https://github.com/php/php-src/commit/44b86aee31)
    * JIT: Fix missing type store in [e70d282077](https://github.com/php/php-src/commit/e70d282077)
    * Fix type inference in [d50875c822](https://github.com/php/php-src/commit/d50875c822)
* Improvements in Mbstring extension by Alex Dowad
    * New implementation of `mb_{de,en}code_numericentity` in [91969e908f](https://github.com/php/php-src/commit/91969e908f)
    * Fix legacy conversion filter encodings JIS in [048f6cbcde](https://github.com/php/php-src/commit/048f6cbcde),   QPrint in [31cbb7a3a5](https://github.com/php/php-src/commit/31cbb7a3a5), SJIS-2004 in [d7bab66135](https://github.com/php/php-src/commit/d7bab66135), MacJapanese in [7ece8f18b0](https://github.com/php/php-src/commit/7ece8f18b0), Base64 in [87b71595ba](https://github.com/php/php-src/commit/87b71595ba), HTML entities in [2eff19e38f](https://github.com/php/php-src/commit/2eff19e38f), 
    * ISO-2022-KR in [c8e4f313fa](https://github.com/php/php-src/commit/c8e4f313fa), UTF-7 in [1662f7f79f](https://github.com/php/php-src/commit/1662f7f79f), CP50220 in [6938e35122](https://github.com/php/php-src/commit/6938e35122), GB18030 in [1526bab6d0](https://github.com/php/php-src/commit/1526bab6d0), HZ in [9c3972fb3d](https://github.com/php/php-src/commit/9c3972fb3d), HTML entities in [fa83a8e15e](https://github.com/php/php-src/commit/fa83a8e15e), SJIS variants (‘0’ at end of buffer) in [7559bf77d2](https://github.com/php/php-src/commit/7559bf77d2), CP50220 (multi-codepoint kana at end of buffer) in [3cf432798e](https://github.com/php/php-src/commit/3cf432798e), QPrint (same order of check as legacy code) in [5fee30b630](https://github.com/php/php-src/commit/5fee30b630), UUEncode in [40f5048aa7](https://github.com/php/php-src/commit/40f5048aa7), ISO-2022-JP-KDDI in [d8a61cef4f](https://github.com/php/php-src/commit/d8a61cef4f), SJIS-2004 in [8a915ed26c](https://github.com/php/php-src/commit/8a915ed26c), ISO-2022-KR in [6d525a425e](https://github.com/php/php-src/commit/6d525a425e), and almost all 8-bit text encodings in [cebb8009c6](https://github.com/php/php-src/commit/cebb8009c6), 
    * `mbfl_strwidth` does not need to use legacy conversion filters now in [30bfeef48d](https://github.com/php/php-src/commit/30bfeef48d)
    * `mb_decode_numericentity` converts entities which immediately follow a valid/invalid entity in [5d6bd557b3](https://github.com/php/php-src/commit/5d6bd557b3)
    * New implementation of `mb_convert_kana` in [9ac49c0dd3](https://github.com/php/php-src/commit/9ac49c0dd3)
    * `mb_decode_numericentity` decodes valid entities which are truncated at end of string in [76a92c26e3](https://github.com/php/php-src/commit/76a92c26e3)
* Fixes and improvements in the Date extension by Derick Rethans 💜
    * Fixed memory leaks with `DatePeriod::__unserialise` in [0dbedb3dbd](https://github.com/php/php-src/commit/0dbedb3dbd)
    * Fixed [GH-8730](https://github.com/php/php-src/issues/8730): `DateTime::diff` miscalculation is same time zone of different type in [cc9c57722a](https://github.com/php/php-src/commit/cc9c57722a)
    * Fixed [#81263](https://bugs.php.net/bug.php?id=81263): Wrong result from `DateTimeImmutable::diff` in [37d460b64a](https://github.com/php/php-src/commit/37d460b64a)
    * Fixed [GH-8964](https://github.com/php/php-src/issues/8964) in [7831a1cae6](https://github.com/php/php-src/commit/7831a1cae6)
    * Import timelib 2022.01 in [8ea587a305](https://github.com/php/php-src/commit/8ea587a305)
    * Fixed bug [#80022](https://bugs.php.net/bug.php?id=80022): Support ISO 8601 years outside 0000-9999 range better in [6ae86c2358](https://github.com/php/php-src/commit/6ae86c2358)
    * Add test case for bug [#80483](https://bugs.php.net/bug.php?id=80483)/[#75035](https://bugs.php.net/bug.php?id=75035) in [1d0e5eddd5](https://github.com/php/php-src/commit/1d0e5eddd5)
	* Fixed bug [#80047](https://bugs.php.net/bug.php?id=80047) (DatePeriod doesn't warn with custom DateTimeImmutable) in [001e7dbb04](https://github.com/php/php-src/commit/001e7dbb04)
	* Add test case for [GH-9601](https://github.com/php/php-src/issues/9601): DateInterval 1.5s added to DateTimeInterface is rounded down since PHP 8.1.0 in [a0c01f385c](https://github.com/php/php-src/commit/a0c01f385c)
	* Change test to ignore INT_MIN/MAX, and fixed off WS in [d002a0d837](https://github.com/php/php-src/commit/d002a0d837)
* **Add `error_log_mode` setting in [ffdf25a270](https://github.com/php/php-src/commit/ffdf25a270) by Mikhail Galanin**
* **Add `FILTER_FLAG_GLOBAL_RANGE` to filter Global IPs as per RFC 6890 in [d8fc05c05e](https://github.com/php/php-src/commit/d8fc05c05e) by @** [vnsavage](https://github.com/vnsavage)
* Do not send `X-Powered-By` if headers sent in [GH-9039](https://github.com/php/php-src/pull/9039) in [922371f3b1](https://github.com/php/php-src/commit/922371f3b1) by Eric Norris
* Fixed bug #65069: `GlobIterator` incorrect handling of `open_basedir` check by Jakub Zelenka 💜
* Series of commits by Máté Kocsis 💜 to declare extension constants in stubs: `ext/mysqli` in [GH-8811](https://github.com/php/php-src/pull/8811), `ext/odbc` in [GH-9045](https://github.com/php/php-src/pull/9045), `ext/openssl` in [GH-9046](https://github.com/php/php-src/pull/9046), `ext/pcre` in [GH-9077](https://github.com/php/php-src/pull/9077), `ext/pdo` in [GH-9078](https://github.com/php/php-src/pull/9078), `ext/pspell` in [GH-9096](https://github.com/php/php-src/pull/9096), `ext/posix` in [GH-9095](https://github.com/php/php-src/pull/9095), `ext/phar` in [GH-9094](https://github.com/php/php-src/pull/9094), `ext/random` in [GH-9109](https://github.com/php/php-src/pull/9109), `ext/session` in [GH-9112](https://github.com/php/php-src/pull/9112), `ext/readline` in [GH-9110](https://github.com/php/php-src/pull/9110), `ext/reflection` in [GH-9111](https://github.com/php/php-src/pull/9111), `ext/sysvmsg` in [GH-9125](https://github.com/php/php-src/pull/9125), `ext/soap` in [GH-9124](https://github.com/php/php-src/pull/9124), `ext/zend_test` in [GH-9135](https://github.com/php/php-src/pull/9135), `ext/xml` in [GH-9131](https://github.com/php/php-src/pull/9131), `ext/xsl` in [GH-9134](https://github.com/php/php-src/pull/9134), `ext/xmlreader` in [GH-9133](https://github.com/php/php-src/pull/9133), `ext/snmp` in [GH-9113](https://github.com/php/php-src/pull/9113), `ext/zlib` in [GH-9147](https://github.com/php/php-src/pull/9147), `ext/pgsql` in [GH-9092](https://github.com/php/php-src/pull/9092), and `ext/sqlite3` in [GH-9181](https://github.com/php/php-src/pull/9181)
* Fix `zend_atomic_bool_exchange_ex()` in HAVE_NO_ATOMICS case in [GH-8801](https://github.com/php/php-src/pull/8801) in [b09420e3a8](https://github.com/php/php-src/commit/b09420e3a8) by twosee
* `main/streams/plain_wrapper`: skip `lseek(SEEK_CUR)` for newly opened files in [e2bd3b1e99](https://github.com/php/php-src/commit/e2bd3b1e99) by Max Kellermann
* Improve tests on 32bit in [GH-8448](https://github.com/php/php-src/pull/8448) by Michael Voříšek
* `streams/xp_socket`: fix clang build error with enum usage on bool condition in [7ceae66182](https://github.com/php/php-src/commit/7ceae66182) by David Carlier
* Add test for backtrace with aliased trait in [GH-8705](https://github.com/php/php-src/pull/8705) in [f26f6d9479](https://github.com/php/php-src/commit/f26f6d9479) by Michael Voříšek
* Use bool and rename variable for ease of comprehension in `ps_title.c` in [b468d6fb54](https://github.com/php/php-src/commit/b468d6fb54) by George Peter Banyard 💜
* Use `size_t` for `get_ps_title()` length parameter in [9a7d37ac66](https://github.com/php/php-src/commit/9a7d37ac66) by George Peter Banyard 💜
* Adds `TCP_CONGESTION` socket option for Linux/FreeBSD in [a193427333](https://github.com/php/php-src/commit/a193427333) by David Carlier
* Fix the crypt sha apis build (with recent clang versions) in [b3569865b3](https://github.com/php/php-src/commit/b3569865b3) by David Carlier
* Disallow assigning reference to unset readonly property in [GH-7942](https://github.com/php/php-src/pull/7942) by Ilija Tovilo 💜
* Abort LMDB transaction when trying to delete non-existing key in [8fce70ae7b](https://github.com/php/php-src/commit/8fce70ae7b) and [1d0c287b90](https://github.com/php/php-src/commit/1d0c287b90) by George Peter Banyard 💜
* Add `php_register_known_variable()` for known var names in [55908db007](https://github.com/php/php-src/commit/55908db007) by George Peter Banyard 💜
* Refactor registration of variables for the CLI SAPI in [b37245b8da](https://github.com/php/php-src/commit/b37245b8da) and by George Peter Banyard 💜
* Pre-compute remote address length in CLI SAPI in [1c753a958b](https://github.com/php/php-src/commit/1c753a958b) by George Peter Banyard 💜
* Fix labeler selection of SAPIs in [583cc01e9e](https://github.com/php/php-src/commit/583cc01e9e) by Jakub Zelenka 💜
* Fix [GH-8907](https://github.com/php/php-src/issues/8907): Document forgotten API changes in [fdc09e302a](https://github.com/php/php-src/commit/fdc09e302a) by David Carlier
* Use `safe_*erealloc*` flavor in few places to mitigate possible overflows in [dfbb425295](https://github.com/php/php-src/commit/dfbb425295) by David Carlier
* Update FreeBSD CI image in [4f4457a6e9](https://github.com/php/php-src/commit/4f4457a6e9) and [f2d6e175fe](https://github.com/php/php-src/commit/f2d6e175fe) by David Carlier
* Fix [#81723](https://bugs.php.net/bug.php?id=81723): Memory corruption in `finfo_buffer()` in [ca6d511fa5](https://github.com/php/php-src/commit/ca6d511fa5) by Christoph M. Becker
* Allow for arbitrary (class) attributes in stubs in [9f29e2d7e9](https://github.com/php/php-src/commit/9f29e2d7e9) by Bob Weinand
* Fix [GH-8842](https://github.com/php/php-src/issues/8842) don’t set sensitive param in legacy arginfo in [b45cd10238](https://github.com/php/php-src/commit/b45cd10238) by Remi Collet
* **Implement `mysqli_execute_query()` in [GH-8660](https://github.com/php/php-src/pull/8660) in [1dc51c7b90](https://github.com/php/php-src/commit/1dc51c7b90) by Kamil Tekiela**
* intl extension, build fix for icu >= 71.x release in [b22d2bf589](https://github.com/php/php-src/commit/b22d2bf589) by David Carlier
* Improve contrast for dark mode phpinfo in [GH-8893](https://github.com/php/php-src/pull/8893) in [d9c49ae1c1](https://github.com/php/php-src/commit/d9c49ae1c1) by Levi Morrison
* Fixed bug [GH-8943](https://github.com/php/php-src/issues/8943) `Reflection::getModifiersNames()` with readonly modifier in [c650e67c90](https://github.com/php/php-src/commit/c650e67c90) by Pierrick Charron
* FPM add routing view global option (for FreeBSD for now) in [5174ee2353](https://github.com/php/php-src/commit/5174ee2353) by David CARLIER
* Update mime-db from 1.45.0 to 1.52.0 in [d3c86527a5](https://github.com/php/php-src/commit/d3c86527a5) by Ayesh Karunaratne
* Remove silent argument to `spl_filesystem_file_read_line()` / `spl_filesystem_file_read_line_ex()`  in [a055c54801](https://github.com/php/php-src/commit/a055c54801) and [bb3d0933af](https://github.com/php/php-src/commit/bb3d0933af) by George Peter Banyard 💜
* Use true/false and comment when arg correspond to silent arg in [247de8a4de](https://github.com/php/php-src/commit/247de8a4de) by George Peter Banyard 💜
* Make `php_fgetcsv()` return a `HashTale` instead of in-out zval param in [GH-8936](https://github.com/php/php-src/pull/8936) in [4ccf0b0181](https://github.com/php/php-src/commit/4ccf0b0181) by George Peter Banyard 💜
* FPM: Fix possible double free on configuration load failure in [bd6793372b](https://github.com/php/php-src/commit/bd6793372b) by Heiko Weber
* Add upgrading internals entry for `fgetcsv()` changes in [eacf6f43ed](https://github.com/php/php-src/commit/eacf6f43ed) by George Peter Banyard 💜
* Reduce memory allocated by `var_export`, `json_encode`, `serialize`, and other in [GH-8902](https://github.com/php/php-src/pull/8902) in [4df3dd7679](https://github.com/php/php-src/commit/4df3dd7679) by Arnaud Le Blanc 💜
* **Fix [GH-8924](https://github.com/php/php-src/issues/8924) str_split of empty string must return empty array in [e80925445c](https://github.com/php/php-src/commit/e80925445c) by Michael Voříšek**
* intl extension, build fix for icu >= 69.x release. `ubrk/ucnv_safeClone` had been deprecated in favor of `ubrk/ucnv_clone` which does not use user provided stacks but remain thread safe in [7c3dfbb845](https://github.com/php/php-src/commit/7c3dfbb845) by David Carlier
* Fix [GH-8952](https://github.com/php/php-src/issues/8952): std streams can not be deliberately closed in [GH-8953](https://github.com/php/php-src/pull/8953) in [2dbde18b29](https://github.com/php/php-src/commit/2dbde18b29) by Arnaud Le Blanc 💜
* **Add [`ini_parse_quantity` function](https://php.watch/versions/8.2/ini_parse_quantity) to convert ini quantities shorthand notation to int in [GH-8454](https://github.com/php/php-src/pull/8454) in  by Dennis Snell**
* Fix “`%f`” regex in `run-tests.php` in [GH-8965](https://github.com/php/php-src/pull/8965) in [6cd5bd1bcd](https://github.com/php/php-src/commit/6cd5bd1bcd) by Michael Voříšek
* sockets introduces `socket_set_option` `SO_ZEROCOPY` and `MSG_ZEROCOPY` for the `socket_send*` functions. it avoids copy b/w userland and kernel for both TCP and UDP protocols in [dedad408fe](https://github.com/php/php-src/commit/dedad408fe) by David Carlier
* **FPM: Implement access log filtering in [GH-8174](https://github.com/php/php-src/pull/8174) by Mark Gallagher**
* QA - Test Cov - ext:pcntl - `pcntl_signal()` - max signal allowed in [GH-8956](https://github.com/php/php-src/pull/8956) in [23654a172e](https://github.com/php/php-src/commit/23654a172e) by Juan Morales
* Add `zend_array_to_list()` in [GH-8976](https://github.com/php/php-src/pull/8976) in [75a9a5f311](https://github.com/php/php-src/commit/75a9a5f311) by Tim Düsterhus
* gdbinit: Update `print_ht` for new compact packed arrays representation in [GH-8966](https://github.com/php/php-src/pull/8966) in [c654973c02](https://github.com/php/php-src/commit/c654973c02) by Arnaud Le Blanc 💜
* **Update to libpcre2 10.40 in [32cceb75bf](https://github.com/php/php-src/commit/32cceb75bf) by Christoph M. Becker**
* Make the ABI compatibility of generated arginfo files configurable in [GH-8931](https://github.com/php/php-src/pull/8931) in [0bddbab084](https://github.com/php/php-src/commit/0bddbab084) by Máté Kocsis 💜
* Require `zend_constants.stub.php` from `zend_exceptions.stubs.php` in [bb5be650c6](https://github.com/php/php-src/commit/bb5be650c6) by Máté Kocsis 💜
* Fix [GH-8576](https://github.com/php/php-src/issues/8576): Bad interpretation of length when char is UTF-8 in [GH-8926](https://github.com/php/php-src/pull/8926) by Christoph M. Becker
* Support the actual `#[\SensitiveParameter]` attribute in stubs in [GH-8836](https://github.com/php/php-src/pull/8836) in [342e18f105](https://github.com/php/php-src/commit/342e18f105) by Tim Düsterhus
* Fix parameter order in `gen_stub.php` in [227a8576d2](https://github.com/php/php-src/commit/227a8576d2) by Máté Kocsis 💜
* Fix [GH-8923](https://github.com/php/php-src/issues/8923): error_log on Windows can hold the file write lock in [GH-8925](https://github.com/php/php-src/pull/8925) by Christoph M. Becker
* add compatibility for tentative-return-type in [6e24c16c4a](https://github.com/php/php-src/commit/6e24c16c4a) by Remi Collet
* Fix [GH-8750](https://github.com/php/php-src/issues/8750): Can not create `VT_ERROR` variant type in [GH-8886](https://github.com/php/php-src/pull/8886) by Christoph M. Becker
* INI parser: Fix typo /multipler/multiplier in [GH-8987](https://github.com/php/php-src/pull/8987) by Ayesh Karunaratne
* QA - `pcntl_exec` - check stringable parameters error in [GH-8990](https://github.com/php/php-src/pull/8990) by Juan Morales
* Prevent potential buffer overflow for large value of `php_cli_server_workers_max` in [789a37f144](https://github.com/php/php-src/commit/789a37f144) by guoyiyuan
* QA - `pcntl_signal` - error when handler is int and not `SIG_DFL` or `SIG_IGN` in [GH-9001](https://github.com/php/php-src/pull/9001) by Juan Morales
* QA - `ftp_connect` - error behavior when connection fails in [GH-9002](https://github.com/php/php-src/pull/9002) by Juan Morales
* **Extend deprecation notices to `is_callable($foo)` and `callable $foo` in [GH-8823](https://github.com/php/php-src/pull/8823) by Rowan Tommins**
* Fix RC func info of `str_split` in [GH-9016](https://github.com/php/php-src/pull/9016) in [63912b5ecd](https://github.com/php/php-src/commit/63912b5ecd) by Ilija Tovilo 💜
* Fix `WeakMap` object reference offset causing `TypeError` in [GH-8995](https://github.com/php/php-src/pull/8995) in [ede92a86f2](https://github.com/php/php-src/commit/ede92a86f2) by Tobias Bachert
* random: whitelist `arc4random_buf` if glibc in [3be9118662](https://github.com/php/php-src/commit/3be9118662) by Cristian Rodríguez
* random extension macOs handling update in [d830a1f6f0](https://github.com/php/php-src/commit/d830a1f6f0) by David CARLIER
* QA - `mb_http_input` - function returns FALSE for type ‘L’ or ‘l’ in [GH-9018](https://github.com/php/php-src/pull/9018) by jcm
* opcache JIT: Adds initial support for macOs Instruments performance measurement in [c56e183226](https://github.com/php/php-src/commit/c56e183226) by David CARLIER
* QA -`mb_convert_encoding_array` - error for object item in array in [GH-9023](https://github.com/php/php-src/pull/9023) by jcm
* QA - `ftp_rawlist` - check list return value in [GH-9012](https://github.com/php/php-src/pull/9012) by jcm
* Prevent fiber switching in tick function and signal handlers in [GH-9028](https://github.com/php/php-src/pull/9028) in [2bc6025c2c](https://github.com/php/php-src/commit/2bc6025c2c) by Aaron Piotrowski
* Add `SensitiveParameter` as known string and use it in arginfo in [55a88f36b6](https://github.com/php/php-src/commit/55a88f36b6) by Remi Collet
* Allow to not close stream on rscr dtor in PHP CLII SAPI in [0a4a55fd44](https://github.com/php/php-src/commit/0a4a55fd44) by Jakub Zelenka 💜
* Fix JIT crash with large number of `match`/`switch` arms in [GH-8961](https://github.com/php/php-src/pull/8961) in [f2381ae4ba](https://github.com/php/php-src/commit/f2381ae4ba) by Arnaud Le Blanc 💜
* cleanup unused in [ee1d6188cf](https://github.com/php/php-src/commit/ee1d6188cf) by Remi Collet
* no need for attributes on legacy in [af72d6e5d9](https://github.com/php/php-src/commit/af72d6e5d9) by Remi Collet
* in [f0d536844f](https://github.com/php/php-src/commit/f0d536844f) by Máté Kocsis 💜
* FPM: Downgrade occasional “failed to acquire scoreboard” warning in [3040f75f43](https://github.com/php/php-src/commit/3040f75f43), [db5f6713ee](https://github.com/php/php-src/commit/db5f6713ee) by Felix Wiedemann
* Fix possible crash in case of exception in [c6eb5dc5fd](https://github.com/php/php-src/commit/c6eb5dc5fd) by Dmitry Stogov
* Update request startup error messages in [09237f6126](https://github.com/php/php-src/commit/09237f6126) by Eric Norris
* `DatePeriod` properties cannot be made readonly in [GH-9013](https://github.com/php/php-src/pull/9013) in [e13d60c039](https://github.com/php/php-src/commit/e13d60c039) by Máté Kocsis 💜
* Drop support for `SQLITE_COPY` in authorizer callback in [GH-9041](https://github.com/php/php-src/pull/9041) by Christoph M. Becker
* **Deprecate `MYSQLI_IS_MARIADB` in [GH-8919](https://github.com/php/php-src/pull/8919) by Kamil Tekiela**
* Port standard/crc32 for windows arm64 in [GH-7703](https://github.com/php/php-src/pull/7703) by dixyes
* Do not assert SSE/AVX resolvers at windows arm64 in [GH-7704](https://github.com/php/php-src/pull/7704) by dixyes
* opcache JIT support improvements attempts on macOs in [1416961505](https://github.com/php/php-src/commit/1416961505) by David CARLIER
* Rename `@cname` to `@cvalue` in stubs in [GH-9043](https://github.com/php/php-src/pull/9043) in [e328c68305](https://github.com/php/php-src/commit/e328c68305) by Máté Kocsis 💜
* RFC: Make the `iterator_*()` family accept all `iterable`s in [GH-8819](https://github.com/php/php-src/pull/8819) in [7ae7df5b46](https://github.com/php/php-src/commit/7ae7df5b46) by Tim Düsterhus
* Fix [GH-9017](https://github.com/php/php-src/issues/9017): `php_stream_sock_open_from_socket` could return `NULL` in [GH-9020](https://github.com/php/php-src/pull/9020) by Heiko Weber
* opcache find best candidate near .text segment for large maps on FreeBSD. Follow up on #8890 using similar workflow, we go through the php binary mapping per address boundaries in [1977ef92de](https://github.com/php/php-src/commit/1977ef92de) by David CARLIER
* Fix `--CGI--` support of `run-tests.php` in [GH-9061](https://github.com/php/php-src/pull/9061) by Christoph M. Becker
* Fix [GH-9008](https://github.com/php/php-src/issues/9008): `mb_detect_encoding()`: wrong results with null $encodings in [GH-9063](https://github.com/php/php-src/pull/9063) by Christoph M. Becker
* `phpinfo` HTML Output: Make module title names clickable and link to the URL fragment in [GH-9054](https://github.com/php/php-src/pull/9054) by Ayesh Karunaratne
* Fix segmentation fault in `Randomizer::getBytes()` if a user engine throws in [GH-9055](https://github.com/php/php-src/pull/9055) in [998ede7123](https://github.com/php/php-src/commit/998ede7123) by Tim Düsterhus
* Fix byte expansion in `rand_rangeXX()` in [GH-9056](https://github.com/php/php-src/pull/9056) in [804c3fc821](https://github.com/php/php-src/commit/804c3fc821) by Tim Düsterhus
* Fix [GH-9067](https://github.com/php/php-src/issues/9067): random extension is not thread safe in [GH-9070](https://github.com/php/php-src/pull/9070) by Christoph M. Becker
* Port `win32/codepage.c` codes for windows arm64 in [GH-7702](https://github.com/php/php-src/pull/7702) by dixyes
* Sockets disable zerocopy test on ppc based arch in [067a3022f8](https://github.com/php/php-src/commit/067a3022f8) by David Carlier
* Fix rc info of iterator_to_array in [GH-9080](https://github.com/php/php-src/pull/9080) in [d4a9cc8856](https://github.com/php/php-src/commit/d4a9cc8856) by Ilija Tovilo 💜
* Fix memory leak in LMDB driver in [5b83b3a933](https://github.com/php/php-src/commit/5b83b3a933) by George Peter Banyard 💜
* Fix RC debug of stub attribute in [GH-9082](https://github.com/php/php-src/pull/9082) in [41a5b46e7d](https://github.com/php/php-src/commit/41a5b46e7d) by Ilija Tovilo 💜
* Remove unnecessary include in SPL in [11c424c9fb](https://github.com/php/php-src/commit/11c424c9fb) by George Peter Banyard 💜
* Re-add MSAN in nightly in [ad136e6a6d](https://github.com/php/php-src/commit/ad136e6a6d) by Ilija Tovilo 💜
* Assert all test files are cleaned up in CI in [GH-8977](https://github.com/php/php-src/pull/8977) in [b5ab0e06b8](https://github.com/php/php-src/commit/b5ab0e06b8) by Ilija Tovilo 💜
* Fix SPL test cleanup in [3962f00b01](https://github.com/php/php-src/commit/3962f00b01) by Ilija Tovilo 💜
* Avoid signed integer overflow in `php_random_range()` in [GH-9066](https://github.com/php/php-src/pull/9066) in [133b9b08da](https://github.com/php/php-src/commit/133b9b08da) by Go Kudo
* Convert `client->request.request_uri` to `zend_string` in [GH-9086](https://github.com/php/php-src/pull/9086) in [c8f4801382](https://github.com/php/php-src/commit/c8f4801382) by George Peter Banyard 💜
* Fix shift in `rand_rangeXX()` in [GH-9088](https://github.com/php/php-src/pull/9088) in [ab5491f505](https://github.com/php/php-src/commit/ab5491f505) by Tim Düsterhus
* [`run-tests.php`] Improve non-optimal nested `if`/`elseif`/`else` blocks with happy path optimizations in [51447fb47d](https://github.com/php/php-src/commit/51447fb47d) by Ayesh Karunaratne
* [`run-tests.php`] Minor optimizations in `if` blocks by placing simple expressions first in [056afc8daf](https://github.com/php/php-src/commit/056afc8daf) by Ayesh Karunaratne
* [`run-tests.php`] Merge multiple `unset()` calls to a single call in [f958701dad](https://github.com/php/php-src/commit/f958701dad) by Ayesh Karunaratne
* [`run-tests.php`] Replace backtick operator string literals with `shell_exec()` calls in [c83a10d8db](https://github.com/php/php-src/commit/c83a10d8db) by Ayesh Karunaratne
* [`run-tests.php`] Combine multiple `str_replace` calls to a single `strtr` call in [3483a1f170](https://github.com/php/php-src/commit/3483a1f170) by Ayesh Karunaratne
* [`run-tests.php`] echo call performance optimization in [0490f082e9](https://github.com/php/php-src/commit/0490f082e9) by George Peter Banyard 💜
* crc32 Aarch64 add crc feature to `crc32_aarch64` from clang Closes #8916 in [77bd39a116](https://github.com/php/php-src/commit/77bd39a116) by David CARLIER
* Add support for stubs to declare intersection type class properties in [GH-8751](https://github.com/php/php-src/pull/8751) in [4457dba1fb](https://github.com/php/php-src/commit/4457dba1fb) by George Peter Banyard 💜
* Fix memory leak in fiber constructor by throwing an error in [GH-9098](https://github.com/php/php-src/pull/9098) in [0adbf9c2d4](https://github.com/php/php-src/commit/0adbf9c2d4) by Martin Schröder
* Fix typo in `lob_prefetch_ini.phpt` test in [GH-9099](https://github.com/php/php-src/pull/9099) in [fc42098c23](https://github.com/php/php-src/commit/fc42098c23) by Michael Voříšek
* Use `-1` “precision” in `gen_stub.php` in [GH-8734](https://github.com/php/php-src/pull/8734) by Michael Voříšek
* Remove dead code in `ext/random/random.c` in [GH-9114](https://github.com/php/php-src/pull/9114) in [395b6a9674](https://github.com/php/php-src/commit/395b6a9674) by Tim Düsterhus
* Add comment in GDBM informing to what param the 0 org corresponds to in [c8ba00f627](https://github.com/php/php-src/commit/c8ba00f627) by George Peter Banyard 💜
* Remove personalisation from write on `readonly` db DBA error message in [0887a1d7ab](https://github.com/php/php-src/commit/0887a1d7ab) by George Peter Banyard 💜
* Pass `MDB_RDONLY` to the LMDB environment for readonly DBs in [79d831ff9f](https://github.com/php/php-src/commit/79d831ff9f) by George Peter Banyard 💜
* Add support to pass driver flags to DBA handlers in [3c372901bd](https://github.com/php/php-src/commit/3c372901bd) by George Peter Banyard 💜
* Fix memory leak on `Randomizer::__construct()` call twice in [GH-9091](https://github.com/php/php-src/pull/9091) in [34b352d121](https://github.com/php/php-src/commit/34b352d121) by Go Kudo
* Improve error reporting in random extension in [GH-9071](https://github.com/php/php-src/pull/9071) in [60f149f7ad](https://github.com/php/php-src/commit/60f149f7ad) by Tim Düsterhus
* zend defines attribute malloc for Win32 as returned pointer are not aliased Closes #9118 in [53ae24e435](https://github.com/php/php-src/commit/53ae24e435) by David Carlier
* Fix [GH-9033](https://github.com/php/php-src/issues/9033): Loading blacklist file can fail due to negative length in [GH-9036](https://github.com/php/php-src/pull/9036) by Christoph M. Becker
* Initialize `blacklist_path_length` in [GH-9129](https://github.com/php/php-src/pull/9129) by Christoph M. Becker
* sockets ext for solaris update in [9090e2602e](https://github.com/php/php-src/commit/9090e2602e) by David Carlier
* Skip locale tests /w musl libc in [GH-9141](https://github.com/php/php-src/pull/9141) in [60189aa96a](https://github.com/php/php-src/commit/60189aa96a) by Michael Voříšek
* Amend DBA error message to use standard messaging in [04f6fe4b25](https://github.com/php/php-src/commit/04f6fe4b25) by George Peter Banyard 💜
* Remove `->last_unsafe` from `php_random_status` in [GH-9132](https://github.com/php/php-src/pull/9132) in [5c693c770a](https://github.com/php/php-src/commit/5c693c770a) by Tim Düsterhus
* The hashvalue/index of a bucket is a `zend_ulong` in [bdf5a4e478](https://github.com/php/php-src/commit/bdf5a4e478) by George Peter Banyard 💜
* Use `uint32_t` in `Z_PARAM_VARIADIC_WITH_NAMED` in [9115211ebf](https://github.com/php/php-src/commit/9115211ebf) by George Peter Banyard 💜
* Restrict range of `buffer_length` on all platforms to `INT_MAX` in [GH-9126](https://github.com/php/php-src/pull/9126) by Christoph M. Becker
* Fix [#69181](https://bugs.php.net/bug.php?id=69181): `READ_CSV|DROP_NEW_LINE` drops newlines within fields in [GH-7618](https://github.com/php/php-src/pull/7618) by Christoph M. Becker
* Use `ValueError` if an invalid mode is passed to `Mt19937` in [GH-9159](https://github.com/php/php-src/pull/9159) in [d058acb4ac](https://github.com/php/php-src/commit/d058acb4ac) by Tim Düsterhus
* [GH-9157](https://github.com/php/php-src/issues/9157): opcache fix build on older macOs releases. Closes #9158 in [099b16800c](https://github.com/php/php-src/commit/099b16800c) by David CARLIER
* Fix [GH-9090](https://github.com/php/php-src/issues/9090): Support assigning function pointers in FFI in [GH-9107](https://github.com/php/php-src/pull/9107) by Adam Saponara
* Tweak `openssl_random_pseudo_bytes()` upper bound error message in [5d62cfbc7d](https://github.com/php/php-src/commit/5d62cfbc7d) by Christoph M. Becker
* Fix [GH-9155](https://github.com/php/php-src/issues/9155): `dba_open(“non-existing”, “c-”, “flatfile”)` segfaults in [GH-9156](https://github.com/php/php-src/pull/9156) by Christoph M. Becker
* Fix [GH-9032](https://github.com/php/php-src/issues/9032): SQLite3 authorizer crashes on NULL values in [GH-9040](https://github.com/php/php-src/pull/9040) by Christoph M. Becker
* Fix get/set priority - error handling for MacOS and extra tests in [GH-9044](https://github.com/php/php-src/pull/9044) by jcm
* Avoid using a stack allocated zend_function in Closure::call, to avoid prevent crashes on bailout in [b576bb901e](https://github.com/php/php-src/commit/b576bb901e) by Bob Weinand
* Fix property fetch on magic constants in constant expressions in [GH-9136](https://github.com/php/php-src/pull/9136) by Ilija Tovilo 💜
* Escape `\U` and `\u` in generated stubs in [GH-9154](https://github.com/php/php-src/pull/9154) by Andreas Braun
* Drop Windows specific implementation of `openssl_random_pseudo_bytes()` in [GH-9153](https://github.com/php/php-src/pull/9153) by Christoph M. Becker
* Do not add inherited interface methods to the class synopsis page in [b56492be9c](https://github.com/php/php-src/commit/b56492be9c) by Máté Kocsis 💜
* Improve error messages in `php_random_bytes()` in [GH-9169](https://github.com/php/php-src/pull/9169) by Tim Düsterhus
* Improve DBA test suite in [GH-8904](https://github.com/php/php-src/pull/8904) by George Peter Banyard 💜
* Refactor code handling `file.current_zval` in [GH-8934](https://github.com/php/php-src/pull/8934) by George Peter Banyard 💜


## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

A special mention goes to [mailcoach.app](https://mailcoach.app/) for providing us with a platform for the newsletter.

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more.

