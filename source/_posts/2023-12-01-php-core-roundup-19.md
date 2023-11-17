
---
title: 'PHP Core Roundup #19'
layout: post
tags:
  - roundup
author:
  - name: Ayesh Karunaratne
    url: https://aye.sh
  
  - name: Sergey Panteleev
    url: https://sergeypanteleev.com
published_at: 01 December 2023

---

Welcome back to [PHP Core Roundup](/blog/tag/roundup/) series! This is where we highlight and celebrate the improvements made to PHP during the month past by the PHP development team and members of the PHP Foundation.

> The PHP Foundation is a collective of PHP contributors, veterans, and companies that collaborate to ensure the long-term sustainability of the PHP programming language. The foundation currently supports six contributors focused on PHP's maintenance, debt reduction, and feature development. These contributors work closely with others on coding, documentation, and discussions.

> Started over a year ago, the PHP Core Roundup series offers a summary of the latest developments, discussions, and news about PHP Core, contributed by both PHP Foundation members and other participants. This post is the thirteenth in the PHP Core Roundup series.

{% include "newsletter.html" %}

## PHP 8.3 Released

PHP 8.3 is here! With explicit typing of class constants, deep-cloning of readonly properties and additions to the randomness functionality. As always it also includes performance improvements, bug fixes and general cleanup.

Over **110 people** along with our six PHP Foundation members, helped shape PHP 8.3. **Thank you for your amazing efforts** 🙏🏼💜.

[PHP 8.3 Release Announcement](https://www.php.net/releases/8.3/en.php) on [php.net](https://php.net) contains a summary of what’s new and changed in PHP 8.3.

Learn a little more [about the release](/blog/2023/11/23/php-83/).

## Releases

In addition to the PHP 8.3 release, the PHP development team released two other new versions in November 2023:

**[PHP 8.2.13](https://www.php.net/ChangeLog-8.php#8.2.13)** and **[PHP 8.1.26](https://www.php.net/ChangeLog-8.php#8.1.26)**

These releases include several bug fixes and improvements, notably in areas such as Core, DOM, Fiber, FPM, Intl, Opcache, OpenSSL, PCRE, SOAP, Streams, XMLReader, XMLWriter, and XSL.

## PHP 8.0 is now End-of-Life

PHP 8.0 reached its end of life on November 26th. This means that there will be no more bugs or security fixes. If you are running any PHP applications on PHP 8.0 make sure to upgrade to [newer version](https://www.php.net/manual/en/migration81.php), or to obtain Long-term support from a vendor.

## PHP Foundation turns 2 years

The PHP Foundation was [established two years ago](https://blog.jetbrains.com/phpstorm/2021/11/the-php-foundation/).

Over the past year, the PHP Foundation has supported the work of 6 [core developers](/structure/#core_developers), and made a significant contribution to the PHP language.

Consider supporting the PHP Foundation via [OpenCollective](https://opencollective.com/phpfoundation) or [GitHub Sponsors](https://github.com/sponsors/thephpf).

## Recent RFCs and Mailing List Discussions


> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

## RFC Updates

Following are the RFCs and major pull-requests discussed, voted, and implemented since our last update.

### Under Discussion: [Resource to object conversion](https://wiki.php.net/rfc/resource_to_object_conversion) by Máté Kocsis 💜

Resources are an obsolete data structure that has long since been superseded by objects. Work on replacing resources with objects started back in 2013, but most extensions migrated only in PHP 8.0.

Máté Kocsis suggests migrating the remaining extensions and defining a policy for future development.

### Under Discussion: [Release cycle update](https://wiki.php.net/rfc/release_cycle_update) by Jakub Zelenka

The lifetime of a PHP version is 3 years. Many people consider this to be short, and the pre-release phase, which is six months, too long.

Jakub Zelenka, the PHP 8.3 release manager, proposes to increase the PHP version lifetime to 4 years (2 years of maintenance and 2 years of security updates) and to revise the pre-release phase.

### Under Discussion: [Improve callbacks in ext/dom and ext/xsl](https://wiki.php.net/rfc/improve_callbacks_dom_and_xsl) by Niels Dossche

Niels Dossche proposes to allow `XSLTProcessor::registerPHPFunctions()` and `DOMXPath::registerPhpFunctions()` methods to use callable.

### Under Discussion: [Change how JIT is disabled by default](https://wiki.php.net/rfc/jit_config_defaults) by Daniil Gentili

Currently, JIT is running in `tracing` mode, but disabled by default due to `opcache.jit_buffer_size=0`. RFC suggests disabling JIT by default by setting `opcache.jit=disable`, and increase the default `jit_buffer_size` value to `64`.

### Under Discussion: [Final anonymous classes](https://wiki.php.net/rfc/final_anonymous_classes) by Daniil Gentili

The RFC proposes to add support for final anonymous classes, and to make anonymous classes final by default with the option to make them non-final with an `open` keyword.

<br>

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements.
 
---

### Full list of commits  since [PHP Core Roundup #18](/blog/2023/11/01/php-core-roundup-18/)

Commits are in the order they were added, grouped by author in alphabetical order.

<details markdown="1">
  <summary>Click here to expand</summary>

TODO

</details>
<br>
We are incredibly grateful for the commitment and dedication of all contributors. Stay tuned for next month's roundup as we continue to make PHP better together.

<br>

---

## Support PHP Foundation

At The PHP Foundation, we support, promote, and advance the PHP language. We financially support six PHP core developers to contribute to the PHP project. You can help support PHP Foundation on [OpenCollective](https://opencollective.com/phpfoundation) or via [GitHub Sponsors](https://github.com/sponsors/ThePHPF).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on X [@ThePHPF](https://twitter.com/thephpf) or on Mastodon [@thephpf](https://phpc.social/@thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 


