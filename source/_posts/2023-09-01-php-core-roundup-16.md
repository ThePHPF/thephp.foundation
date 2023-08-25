
---
title: 'PHP Core Roundup #16'
layout: post
tags:
  - roundup
author:
  - name: Ayesh Karunaratne
    url: https://aye.sh
  
  - name: Sergey Panteleev
    url: https://sergeypanteleev.com
published_at: 01 September 2023

---

Welcome back to [PHP Core Roundup](/blog/tag/roundup/) series! This is post #16, where we highlight and celebrate the improvements made to PHP during the month past by the PHP development team, members of the PHP Foundation, and more.

> The PHP Foundation is a collective of PHP contributors, veterans, and companies that collaborate to ensure the long-term sustainability of the PHP programming language. The foundation currently supports six contributors focused on PHP's maintenance, debt reduction, and feature development. These contributors work closely with others on coding, documentation, and discussions.

> Started over a year ago, the PHP Core Roundup series offers a summary of the latest developments, discussions, and news about PHP Core, contributed by both PHP Foundation members and other participants. This post is the thirteenth in the PHP Core Roundup series.

{% include "newsletter.html" %}

## PHP 8.3 Branching Out

PHP 8.3 reached its [feature-freeze](/blog/2023/08/01/php-core-roundup-15/#php-8.3-feature-freeze), and [release managers](/blog/2023/05/02/php-core-roundup-12/#php-8.3-release-managers-elected) have branched the PHP-8.3 branch on August 31.

Now that PHP 8.3 is branched out, the `master` branch will be the development branch for PHP 8.4. Bug fixes and other improvements will be cherry-picked for PHP 8.3 (and older branches) as appropriate, but new features that are made to the master branch will not be merged to the PHP 8.3 branch.

Tools that build PHP based on the Git branches will also see the new branch, and the builds from the `master` branch will be named “PHP 8.4” for the first time.

## Releases

The PHP development team released three new versions in August 2023:

**[PHP 8.2.9](https://www.php.net/archive/2023.php#2023-08-16-1)**, **[PHP 8.1.22](https://www.php.net/archive/2023.php#2023-08-03-1)**, and **[PHP 8.0.30](https://www.php.net/archive/2023.php#2023-08-04-1)**

All three include security fixes: [GHSA-3qrf-m4j2-pcrr](https://github.com/php/php-src/security/advisories/GHSA-3qrf-m4j2-pcrr) and [GHSA-jqcx-ccgc-xwhv](https://github.com/php/php-src/security/advisories/GHSA-jqcx-ccgc-xwhv).

PHP 8.2.9 and PHP 8.1.22 additionally include several bug fixes and improvements, notably in areas such as Build, CLI, Core, Curl, Date, DOM, Fileinfo, FTP, GD, Intl, MBString, Opcache, PCNTL, PDO, PDO SQLite, Phar, PHPDBG, Session, Standard, Streams, SQLite3, and XMLReader.

Please note, that Windows binaries for PHP 8.2.9 are not synchronized and don't contain a fix for [GH-11854](https://github.com/php/php-src/issues/11854). Windows binaries for PHP 8.0.30 are missing yet.

## Recent RFCs and Mailing List Discussions


> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

## RFC Updates

### Under Discussion: [Support optional suffix parameter in tempnam](https://wiki.php.net/rfc/tempnam-suffix-v2) by Athos Ribeiro

RFC proposes to add a new optional suffix parameter to the `tempnam()` function.

A suffix could provide even more semantic value or context for a user inspecting the generated files, and, in specific situations, could even provide more context for software processing such files. Right now, users can only add a prefix.

<br>

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements.
 
---

### Full list of commits  since [PHP Core Roundup #15](/blog/2023/08/01/php-core-roundup-15/)

Commits are in the order they were added, grouped by author in alphabetical order.

<details markdown="1">
  <summary>Click here to expand</summary>


</details>
<br>
We are incredibly grateful for the commitment and dedication of all contributors. Stay tuned for next month's roundup as we continue to make PHP better together.

<br>

---

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation) or via [GitHub Sponsors](https://github.com/sponsors/ThePHPF).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 


