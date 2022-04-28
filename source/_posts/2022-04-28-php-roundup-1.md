---
title: PHP Roundup &#35;1
layout: post
tags:
    - update
author:
  name: Ayesh Karunaratne
  url: https://twitter.com/Ayeshlive
published_at: 28 April 2022
---

Welcome to the first _PHP Roundup_, where we’ll make regular updates on the improvements made to PHP by the _PHP Foundation_ and other contributors. PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP news and articles on upcoming changes.


In this series, we highlight some of the interesting and major improvements made to the PHP language. Traditionally, the PHP team releases a new minor version of the interpreter towards the end of each year, but the changes and improvements are discussed and implemented throughout the year.

You don’t necessarily have to be a PHP Foundation backer to follow the PHP Roundup. We’ll be publishing the posts on our website, and you can subscribe to a newsletter:

<form method="POST" action="https://php-foundation-mailcoach.com/subscribe/9be4e2bd-f9d8-475c-b00e-2dcc4cf90056">
    <div>
        <label for="email">Email</label>
        <input type=email name="email">
        <button type="submit">Subscribe</button>
    </div>
</form>


The PHP Foundation currently supports six part-time PHP contributors who work on both maintenance and new features for PHP. Maintenance is not limited to fixing bugs, but also includes work to reduce technical debt, making life easier for everyone working on PHP. The contributors funded by the PHP Foundation collaborate with other contributors on code, documentation, and discussions.

Things marked with 💜 are done by the PHP Foundation team.

Let’s get straight to the updates.


## RFC Updates

Every major change to PHP is discussed and implemented with the consensus of the PHP community. Each RFC proposes a set of changes, and the PHP Internals community holds a vote that lasts two weeks by default.



* **Accepted: [Allow null and false as stand-alone types](https://wiki.php.net/rfc/null-false-standalone-types) 💜**

  RFC by George Peter Banyard was accepted unanimously with all 38 votes in favor and is now merged into PHP.


  Prior to this change, `null `and `false `could only be used as part of a Union Type, but not as stand-alone types. This change further improves PHP’s type system to be more expressive and defensive. See the `true` type RFC below that proposes adding `true `as a type too.

  Learn more about this RFC from the [PHP Internals News podcast](https://phpinternals.news/99) hosted by Derick Rethans.



* **Implemented: [Redacting parameters in back traces](https://wiki.php.net/rfc/redact_parameters_in_back_traces)**

  RFC by Tim Düsterhus, approved with 24:1 votes in favor, is now implemented in PHP core.


  This RFC proposed adding a `#[SensitiveParameter]` attribute that redacts the parameter's actual value when it is spewed out in stack traces and `var_dump `output. The attribute can be used to prevent leaking sensitive information in debugging logs.

  Learn more about this RFC from the [PHP Internals News podcast](https://phpinternals.news/97) hosted by Derick Rethans.


* **Discussion: [Add true type](https://wiki.php.net/rfc/true-type) 💜**

  RFC by George Peter Banyard is currently under discussion, to add true as a type to PHP. In PHP 8.0 Union Types, we added `false `as one of the possible members of Union Types, but left out `true`. This RFC proposes to complete it by adding `true `as a type as well.


* **Accepted: [Undefined Variable Error Promotion](https://wiki.php.net/rfc/undefined_variable_error_promotion)**

  RFC by Mark Randall accepted with 33:8 votes in favor.


  This proposes to convert the current behavior of PHP raising a warning for accessing an undefined variable (PHP 8.0+) to throw an Error exception instead in PHP 9.0.


* **Voting: [Undefined Property Error Promotion](https://wiki.php.net/rfc/undefined_property_error_promotion)**

  Another RFC by Mark Randall proposes to throw an error on undefined class property access, similar to the now accepted changes with undefined variables. Notably, PHP 8.2 already emits deprecation notices on dynamic property creation ([with a few exceptions](https://php.watch/versions/8.2/dynamic-properties-deprecated#exempt)).


* **Voting: [Readonly classes](https://wiki.php.net/rfc/readonly_classes) 💜**

  RFC by Máté Kocsis proposes to add support for readonly classes. In such a class, all properties are `readonly `and dynamic properties are forbidden. Voting is scheduled to start on April 27th.

* **Accepted: [Deprecate ${} string interpolation](https://wiki.php.net/rfc/deprecate_dollar_brace_string_interpolation) 💜**

  RFC by Ilija Tovilo accepted with 31:1 votes in favor.


  This RFC proposes to deprecate `"${foo}"` and "`${(foo)}`" string interpolation patterns. It does _not_ deprecate the standard "`{$foo}`" pattern.


* **Accepted: [Deprecate and Remove utf8_encode and utf8_decode](https://wiki.php.net/rfc/remove_utf8_decode_and_utf8_encode)**

  Learn more about this RFC from the [PHP Internals News podcast](https://phpinternals.news/98) hosted by Derick Rethans.



## Merged PRs and Commits

Some of the minor changes made to PHP are first made as a pull request to the [PHP GitHub project](github.com/php/php-src), and if deemed acceptable by PHP core maintainers, they are merged without going through a formal RFC process. We have automatic tests in place to flag PRs that break existing functionality. The majority of the minor changes from the community are made through PRs.



* New: [Introduce CURLOPT_XFERINFOFUNCTION](https://github.com/php/php-src/pull/7823) by [David CARLIER](https://github.com/devnexen).
* Fixed: [Constants in Enum classes causes php-fpm worker to segfault](https://github.com/php/php-src/issues/8133) by Ilija Tovilo. 💜
* Fixed: [SplFileObject: key() returns wrong value](https://github.com/php/php-src/issues/8273) by George Peter Banyard. **💜**
* Fixed: Bug #[76003](https://bugs.php.net/bug.php?id=76003) [FPM /status reports wrong number of active processes](https://github.com/php/php-src/commit/33bb201b3eddbda0cc93c9cd1cb9adb4c77d0df2) by Jakub Zelenka **💜**
* Fixed: Bug #[77023 PHP-FPM cannot shutdown processes](https://github.com/php/php-src/commit/d8612fb6b7496a4f17e8250037a00b26623c1c77) by Jakub Zelenka **💜**
* Reviewed and merged various fixes and improvements to FPM by Jakub Zelenka: **💜**
	* [Emitting error for invalid listen port](https://github.com/php/php-src/commit/2874e5fa052d54affd31ed5eaf3e0d53c9116c93) (implemented by David Carlier)
	* [SELinux dumpable](https://github.com/php/php-src/commit/7bb2a9ff38b739d2143134b6ce0d9cc3dd9b78fe) (implemented by David Carlier)
	* [Clang warning in socket cleanup](https://github.com/php/php-src/commit/2f0918c638cbba0f5d36b9b2f3d0aa8cf95651c9) (implemented by David Carlier)
	* [Listening queue MacOS support](https://github.com/php/php-src/commit/7be195caa7589560d5e1a019e389850fdb5c8a1e) (implemented by David Carlier)
	* [New default for listen backlog on Linux](https://github.com/php/php-src/commit/1e562683cb995b9903f4d24ba9eb5bb89ae3fbfb) (implemented by Cristian Rodríguez)
	* [Kqueue typo in remove callback type](https://github.com/php/php-src/commit/ff90d42b8bc292bd7bfc532e29e5cdff242ee3e1) (implemented by David Carlier)
* Fixed: Various ([1](https://github.com/php/php-src/issues/7752), [2](https://github.com/php/php-src/issues/8101), [3](https://bugs.php.net/bug.php?id=81660)) bugs related to DateTime support, as well as reimplementing serialization support for all classes, by Derick Rethans 💜
* Improved: Migrated most of the CI setup from Azure Pipelines to GitHub Actions by Ilija Tovilo 💜
* Fixed: [Registry settings are no longer recognized](https://github.com/php/php-src/issues/8310) by Christoph M. Becker, reported by Vladimir S.
* Several engine improvements by Dmitry Stogov and Nikita Popov.

Apart from the highlighted changes above, there have been more improvements and fixes from @divinity76, Marco Pivetta, Arnaud Le Blanc, Alex Dowad, and more.


## Mailing List Discussions



* [Canonicalize "iterable" into "array|Traversable" and Reflection](https://externals.io/message/117577), started by George Peter Banyard. 💜
* [MySQLi Execute Query RFC](https://externals.io/message/117486), started by Craig Francis.
* [NULL Coercion Consistency](https://externals.io/message/117501), also started by Craig Francis.


## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation).

A big thanks to all our sponsors — PHP Foundation is all of us!

A special mention goes to [mailcoach.app](https://mailcoach.app/) for providing us with a platform for the newsletter.

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.


> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more.

💜️ 🐘
