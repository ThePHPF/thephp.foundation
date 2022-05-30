
---
title: 'PHP Core Roundup #2'
layout: post
tags:
    - update
author:
  name: Ayesh Karunaratne
  url: https://aye.sh
published_at: 30 May 2022
---

Welcome back to round #2 of *PHP Core Roundup*, where we’ll make regular updates on the improvements made to PHP by the PHP Foundation and other contributors. In this second one in the series, we have news about the upcoming PHP 8.2 release, some new RFCs accepted, voted, and being discussed, and some further improvements to PHP made in the past few weeks.

You don’t necessarily have to be a PHP Foundation backer to follow the PHP Roundup. We’ll be publishing the posts on our website, and you can subscribe to a newsletter:

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
  
The PHP Foundation currently supports six part-time PHP contributors who work on both maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.

## PHP 8.2 Release Managers

For each major version of PHP (such as PHP 7.4, 8.0, 8.1, and 8.2), PHP core developers vote and elect one or two release managers along with a veteran PHP core developer who has been a release manager before.

PHP Release managers are responsible for tagging and creating PHP releases throughout the lifecycle of that PHP version, including the alpha/beta/RC releases, and security releases as well as regular patch versions. Lasting for about three and half years, the release managers have the final say last-minute RFCs as well.

For the upcoming PHP 8.2, we had [7 candidates](https://wiki.php.net/todo/php82), with Ben Ramsey, one of the PHP 8.1 release managers stepping in as the veteran release manager. After a poll that ended on May 18, Sergey Panteleev and Pierrick Charron were elected as rookie release managers.

Congratulations Sergey, Pierrick, and Ben on being PHP 8.2 release managers!

## RFC Updates

Every major change to PHP is discussed and implemented with the consensus of the PHP community. Each RFC proposes a set of changes, and the PHP Internals community holds a vote that lasts two weeks by default.

Things marked with 💜 are done by the PHP Foundation team.

-  **Implemented: [Deprecate ${} string interpolation](https://wiki.php.net/rfc/deprecate_dollar_brace_string_interpolation) 💜**
    
    RFC by Ilija Tovilo was accepted with 31:1 votes in favor, and is now implemented in PHP core. This RFC proposes to deprecate string interpolation with `${var}` and `${expr}` patterns with `{$var}` and `{${expr}}` patterns.

    On top 1,000 most downloaded packages as per Packagist data, over 40 packages contained at least one occurrence of this now-deprecated pattern. Fixes are being made to the libraries, you can help out by testing your libraries and submitting pull-requests to the relevant repositories.

    This RFC is likely to be followed up with another RFC vote to decide whether the deprecated string interpolation patterns should throw an error, or silently ignored in PHP 9.0

    Learn more about this RFC on [PHP.Watch](https://php.watch/versions/8.2/$%7Bvar%7D-string-interpolation-deprecated).

-  **Implemented: [Readonly Classes](https://wiki.php.net/rfc/readonly_classes) 💜**
    
    Máté Kocsis follows up PHP 8.1 readonly properties feature with support for marking the entire class as readonly in this new RFC. In PHP 8.2, all properties (must be typed) of the class will be implicitly readonly if the class is declared as readonly.

    Learn more about this RFC on [PHP.Watch](https://php.watch/versions/8.2/readonly-classes).

-  **Accepted: [MySQLi Execute Query](https://wiki.php.net/rfc/mysqli_execute_query)**

    RFC by Kamil Tekiela and Craig Francis was accepted unanimously with 24 votes. This RFC proposes to add a new `mysqli_execute_query` function to the MySQLi extension that greatly simplifies the multiple function calls it required to prepare, bind parameters, execute, and retrieve data with mysqli_prepare/execute/stement_get_result functions.

    Learn more about this RFC on [PHP.Watch](https://php.watch/versions/8.2/mysqli_execute_query).


-  **Accepted: [Undefined Property Error Promotion](https://wiki.php.net/rfc/undefined_property_error_promotion)**
    
    RFC by Mark Randall proposes to throw an error on undefined class property access, similar to the now accepted changes with undefined variables. Notably, PHP 8.2 already emits deprecation notices on dynamic property creation ([with a few exceptions](https://php.watch/versions/8.2/dynamic-properties-deprecated#exempt)).

-  **Under Discussion: [Expand deprecation notice scope for partially supported callables](https://wiki.php.net/rfc/partially-supported-callables-expand-deprecation-notices)**
    
    Juliette Reinders Folmer follows up on the [Deprecate partially supported callables RFC](https://wiki.php.net/rfc/deprecate_partially_supported_callables) (implemented in PHP 8.2) to widen the scope of the deprecation to include is_callable function and when type verification is executed on the callable type.

    Learn more about this RFC on [PHP Internals News Podcast](https://phpinternals.news/101) hosted by Derick Rethans.

-  **Under Discussion: [Stricter implicit boolean coercions](https://wiki.php.net/rfc/stricter_implicit_boolean_coercions)**
    
    RFC by Andreas Leathley is currently under discussion, which discovers ways how various types are coerced with boolean values. A [lengthy discussion](https://externals.io/message/117732) is underway.

-  **Under Discussion: [Fetching properties in constant expressions](https://wiki.php.net/rfc/fetch_property_in_const_expressions) 💜**

    RFC by Ilija Tovilo proposes adding support for fetching properties in constant expressions using the `->` operator. This will make it possible to fetch the name and value of enums in constant expressions.


## Merged PRs and Commits

Some of the minor changes made to PHP are first made as a pull request to the [PHP GitHub project](http://github.com/php/php-src), and if deemed acceptable by PHP core maintainers, they are merged without going through a formal RFC process. We have automatic tests in place to flag PRs that break existing functionality. The majority of the minor changes from the community are made through PRs.

-   New: Curl extension support for `CURLOPT_MAXFILESIZE_LARGE` and `CURLOPT_XFERINFOFUNCTION` options in PR [#7823](https://github.com/php/php-src/pull/7823) and [#8557](https://github.com/php/php-src/pull/8557) by David Carlier.
-   New: Add `ReflectionMethod::hasPrototype()` in PR [#8487](https://github.com/php/php-src/pull/8487) by Ollie Read.
-   New: Add `ReflectionFunction::isAnonymous()` in PR [#8499](https://github.com/php/php-src/pull/8499) by Nicolas Grekas.
-   New: Socket extension support for `TCP_NOTSENT_LOWAT` and `SO_MEMINFO` options in PR [#8559](https://github.com/php/php-src/pull/8559) and commit [2410e378](https://github.com/php/php-src/commit/2410e378c1729df267b0be82e9c7ab8a47b9a6a6) by David Carlier.
-   New: `idate()` now accepts format specifiers "N" (ISO Day-of-Week) and "o" (ISO Year) in commit [12702a20](https://github.com/php/php-src/commit/12702a20474635605cd7f08a9d0e1acac3a5f078) by Pavel Djundik.
-   Improved: Tidy extension’s tidy class properties are now typed, and tidyNode properties are declared readonly. PR [#8515](https://github.com/php/php-src/pull/8515) by Máté Kocsis 💜.
-   Improved: It is now possible to declare constants in stubs. This change will make it easier to keep the manual always up-to-date as well as static analyzers to get type information about constants. PR [#7434](https://github.com/php/php-src/pull/7434) by Máté Kocsis 💜.
-   Changed: Build `ext/zip` as shared library by default on Windows in PR [#8549](https://github.com/php/php-src/pull/8549) by Christoph M. Becker.
-   Fixed: Bug [#8548](https://github.com/php/php-src/issues/8548)  `stream_wrapper_unregister()` memory leak in PR [#8587](https://github.com/php/php-src/pull/8587) by Ilija Tovilo 💜.
-   Fixed: `ini_get()` could be optimized-out by the optimizer in PR [#8507](https://github.com/php/php-src/pull/8507) by Arnaud Le Blanc 💜.
-   Fixed: Crash while unregistering `dl()’`-ed extension in ZTS in PR [#8435](https://github.com/php/php-src/pull/8435) by Arnaud Le Blanc 💜.
-   Fixed: Add JIT guards for `INIT_METHOD_CALL` when the method may be modified PR [#8600](https://github.com/php/php-src/pull/8600) by Arnaud Le Blanc 💜.
-   Fixed: Datetime format string to follow POSIX spec in `ftp_mdtm` in PR [#8259](https://github.com/php/php-src/pull/8259) by Jihwan Kim.
-   Fixed: `parse_url()` can not recognize port without scheme in PR [#7844](https://github.com/php/php-src/pull/7844) by @pandaLIU.
-   Fixed bug #72185: php-fpm writes empty fcgi record causing nginx 502 by Jakub Zelenka and @loveharmful 💜.
-   Fixed: Bug #79589: ssl3_read_n:unexpected eof while reading by Jakub Zelenka 💜.
-   Fixed: Memory leak in `Enum::from`/`tryFrom` when type coercion occurs in internal enums in PR [#8633](https://github.com/php/php-src/pull/8633) by Ilija Tovilo 💜.
-   Improved: Add internal C API for fetching backed enums by value in PR [#8518](https://github.com/php/php-src/pull/8518) by Ilija Tovilo
-   Fixed: Several bug fixes in Date extension by Derick Rethans 💜.
	-  Bug [#51987](https://bugs.php.net/bug.php?id=51987) DateTime fails to parse an ISO 8601 ordinal date (extended format) in PR #8589.
    -  `DateInterval::createFromDateString` does not throw if non-relative items are present in PR [#8458](https://github.com/php/php-src/issues/8458).
	-  Bug [#72963](https://bugs.php.net/bug.php?id=72963) Null-byte injection in `DateTime::createFromFormat` and related functions.
	-  Bug [#GH-8471](https://github.com/php/php-src/issues/8471) Segmentation fault when converting immutable and mutable `DateTime` instances created using reflection in PR [#8497](https://github.com/php/php-src/pull/8497).
	-  Bug [#68549](https://bugs.php.net/bug.php?id=68549) Timezones and offsets are not properly used when working with dates in PR [#8589](https://github.com/php/php-src/pull/8589).
	-  Updated to timelib 2021.12 in PR [#8589](https://github.com/php/php-src/pull/8589) by Derick Rethans 💜. Also fixes bug [#51934](https://bugs.php.net/bug.php?id=51934), [GH-7758](https://github.com/php/php-src/issues/7758), [#68549](https://bugs.php.net/bug.php?id=68549), [#66019](https://bugs.php.net/bug.php?id=66019), and [#81565](https://bugs.php.net/bug.php?id=81565).
	-  Bug [#52015](https://bugs.php.net/bug.php?id=52015) Allow including end date in `DatePeriod` iterations in PR [#8550](https://github.com/php/php-src/pull/8550).
	-  DatePeriod properties are also going to be properly declared as readonly soon (PR [#8534](https://github.com/php/php-src/pull/8534)).
	-   Bug [#74671](https://bugs.php.net/bug.php?id=74671) DST timezone abbreviation has incorrect offset in PR [#8595](https://github.com/php/php-src/pull/8595).
	-   Bug [#78139](https://bugs.php.net/bug.php?id=78139)  `timezone_open` accepts invalid timezone string argument in PR [#8595](https://github.com/php/php-src/pull/8595).
    

Apart from the highlighted changes above, there have been more improvements and fixes from Alex Dowad, Nikita Popov, Dmitry Stogov, and more contributors.

  
  

## Mailing List Discussions

-   [The future of objects and operators](https://externals.io/message/117678) started by Jordan LeDoux as a follow-up to previously declined [Operator overloading RFC](https://wiki.php.net/rfc/user_defined_operator_overloads).
-   [NULL Coercion Consistency](https://externals.io/message/117501) started by Craig Francis.
-   [Stricter implicit boolean coercions](https://externals.io/message/117732) started by Andreas Leathley.
-   [Body-less methods](https://github.com/php/php-src/issues/8420) started by Aleksei Gagarin.
    
## Other News

-   [The opcache optimizer](https://www.npopov.com/2022/05/22/The-opcache-optimizer.html) – blog post by Nikita Popov.
-   [PHP Annotated](https://blog.jetbrains.com/phpstorm/2022/05/php-annotated-may-2022/) – for more news and links from the userland PHP community.

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

A special mention goes to [mailcoach.app](https://mailcoach.app/) for providing us with a platform for the newsletter.

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more.

