
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

PHP 8.3 has reached its [feature-freeze](/blog/2023/08/01/php-core-roundup-15/#php-8.3-feature-freeze), and [release managers](/blog/2023/05/02/php-core-roundup-12/#php-8.3-release-managers-elected) branched out the PHP-8.3 branch on August 31.

Now that PHP 8.3 is in a separate branch, the `master` branch will be the development source for PHP 8.4. Bug fixes and other improvements will be cherry-picked for PHP 8.3 (and older branches) as appropriate, but new features that are made to the master branch will not be merged to the PHP 8.3 branch.

Tools that build PHP based on the Git branches will also see a new branch, and the builds from the `master` branch will be named “PHP 8.4” for the first time.

## Releases

The PHP development team released three new versions in August 2023:

**[PHP 8.2.9](https://www.php.net/archive/2023.php#2023-08-16-1)**, **[PHP 8.1.22](https://www.php.net/archive/2023.php#2023-08-03-1)**, and **[PHP 8.0.30](https://www.php.net/archive/2023.php#2023-08-04-1)**

All three include security fixes: [GHSA-3qrf-m4j2-pcrr](https://github.com/php/php-src/security/advisories/GHSA-3qrf-m4j2-pcrr) and [GHSA-jqcx-ccgc-xwhv](https://github.com/php/php-src/security/advisories/GHSA-jqcx-ccgc-xwhv).

PHP 8.2.9 and PHP 8.1.22 additionally include several bug fixes and improvements, notably in areas such as Build, CLI, Core, Curl, Date, DOM, Fileinfo, FTP, GD, Intl, MBString, Opcache, PCNTL, PDO, PDO SQLite, Phar, PHPDBG, Session, Standard, Streams, SQLite3, and XMLReader.

Please note, that Windows binaries for PHP 8.2.9 are not synchronized and don't contain a fix for [GH-11854](https://github.com/php/php-src/issues/11854). Windows binaries for PHP 8.0.30 are missing so far.

## Recent RFCs and Mailing List Discussions


> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

## RFC Updates

### In Voting: [Support optional suffix parameter in tempnam](https://wiki.php.net/rfc/tempnam-suffix-v2) by Athos Ribeiro

RFC proposes to add a new optional suffix parameter to the `tempnam()` function.

A suffix could provide even more semantic value or context for a user inspecting the generated files, and, in specific situations, could even provide more context for software processing such files. Right now, users can only add a prefix.

### Merging postponed: [PDO driver specific sub-classes](https://wiki.php.net/rfc/tempnam-suffix-v2) by Danack

This RFC proposed to introduce driver-specific `\PDO` sub-classes so applications can granular declare the specific PDO drivers they support.

This RFC vote was completed and accepted unanimously, but due to the implementation complexity, the changes for this RFC were not finalized before the PHP 8.3.0RC1 release. Because PHP 8.3 is beyond its feature-freeze and now that the first release candidate is released, the consensus seems to be that this RFC will not be implemented in PHP 8.3 but on the next PHP version.

<br>

## Documentation

While PHP 8.3 has moved to the RC cycle, the documentation available on [php.net](https://php.net), requires updating.

George P. Banyard 💜 marked easy pickings issues, which you can find at [GitHub](https://github.com/php/doc-en/issues?q=is%3Aopen+is%3Aissue+label%3A%22good+first+issue%22).

To make it easier to see the result of changes locally, Anna Filina prepared a Docker Compose. [Check it out](https://github.com/php/doc-en/pull/2638).

<br>

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements.
 
---

### Full list of commits  since [PHP Core Roundup #15](/blog/2023/08/01/php-core-roundup-15/)

Commits are in the order they were added, grouped by author in alphabetical order.

<details markdown="1">
  <summary>Click here to expand</summary>

### Alexandre Daubois
- Improve `ext/pdo_sqlite` tests cleanup in [GH-11900](https://github.com/php/php-src/pull/11900)


### Alex Dowad
- Improve `mb_detect_encoding` accuracy for text containing vowels with macrons in [81faab9235](https://github.com/php/php-src/commit/81faab9235)
- Print host CPU and installed package info in CI build log on Linux in [fd462b1e0f](https://github.com/php/php-src/commit/fd462b1e0f)


### Athos Ribeiro
- Fix off-by-one bug when truncating tempnam prefix in [cbfd73765a](https://github.com/php/php-src/commit/cbfd73765a)


### Ayesh Karunaratne
- Add class constant types to Phar extension in [GH-11826](https://github.com/php/php-src/pull/11826)
- gen_stub: fix regexps with unintentional range due to `-` character placement in [GH-12004](https://github.com/php/php-src/pull/12004)
- [skip-ci] minor typo fixes in UPGRADING and CONTRIBUTING.md in [GH-11976](https://github.com/php/php-src/pull/11976)
- Fix DateTime exception hierarchy for DateInvalidTimeZoneException in [GH-11970](https://github.com/php/php-src/pull/11970)


### Bob Weinand
- Address CR comments in [b07a2d4714](https://github.com/php/php-src/commit/b07a2d4714)
- Track HashTableIterators for copy-on-write copies of HashTables in [cd53ce838a](https://github.com/php/php-src/commit/cd53ce838a)


### Cristian Rodríguez
- Use a single version of strnlen  in [GH-12015](https://github.com/php/php-src/pull/12015)
- Use `zend_ast_size` consistenly in [GH-11955](https://github.com/php/php-src/pull/11955)


### David CARLIER
- `zend_call_stack_default_size` update BSD values. in [GH-12051](https://github.com/php/php-src/pull/12051)
- libxml set error structure simplification proposal in [GH-12054](https://github.com/php/php-src/pull/12054)
- ci update freebsd image to the 13.2 image in [GH-11110](https://github.com/php/php-src/pull/11110)
- `ext/iconv`: fix build for netbsd in [fc8d5c72e5](https://github.com/php/php-src/commit/fc8d5c72e5)


### Derick Rethans
- Update initialisation check for new PHP-8.3 API in [e157da11f3](https://github.com/php/php-src/commit/e157da11f3)
- Fix [GH-11416](https://github.com/php/php-src/issues/11416): Crash with DatePeriod when uninitialised objects are passed in (PHP 8.2+) in [b71d2e16e6](https://github.com/php/php-src/commit/b71d2e16e6)
- Fix [GH-11416](https://github.com/php/php-src/issues/11416): Crash with DatePeriod when uninitialised objects are passed in in [4833b84854](https://github.com/php/php-src/commit/4833b84854)


### Filip Zrůst
- Remove CPP when invoking dtrace utility in [02b3fb1f6b](https://github.com/php/php-src/commit/02b3fb1f6b)


### George Peter Banyard
- Fix [GH-11876](https://github.com/php/php-src/issues/11876): `ini_parse_quantity()` accepts invalid quantities in [d229a480ad](https://github.com/php/php-src/commit/d229a480ad)
- Fix various bugs related to DNF types in [02a80c5b82](https://github.com/php/php-src/commit/02a80c5b82)
- Fix `skipif` condition on new test in [4cbc66d5e6](https://github.com/php/php-src/commit/4cbc66d5e6)


### HypeMC
- Add before_needle argument to `strrchr()` in [f25474f7f2](https://github.com/php/php-src/commit/f25474f7f2)


### Ilija Tovilo
- Increase `run-tests.php` timeout for asan in [f4a6a6d096](https://github.com/php/php-src/commit/f4a6a6d096)
- Skip dl() tests on ASAN in [fb0f4215de](https://github.com/php/php-src/commit/fb0f4215de)
- Make unrepeatable tests retriable in [f2c16b7ba3](https://github.com/php/php-src/commit/f2c16b7ba3)
- Fix variable resource ids in odbc test in [d1a38e8b8e](https://github.com/php/php-src/commit/d1a38e8b8e)
- Fix missing instantclient in CI in [f3bd027b69](https://github.com/php/php-src/commit/f3bd027b69)
- Fix type macros for C++ in [5ad658bc5e](https://github.com/php/php-src/commit/5ad658bc5e)
- Switch asan build to Ubuntu 23.04 in Docker in [c9e5e1fc52](https://github.com/php/php-src/commit/c9e5e1fc52)
- Move installation of oracle instant client in GHA in [ba07a0b846](https://github.com/php/php-src/commit/ba07a0b846)
- Make `php_cli_server_pdeathsig.phpt` `SKIPIF` more specific in [bad5298707](https://github.com/php/php-src/commit/bad5298707)
- Remove redundant condition in [dd01c74a6f](https://github.com/php/php-src/commit/dd01c74a6f)
- Fix segfault in format_default_value due to unexpected enum/object in [f78d1d0d10](https://github.com/php/php-src/commit/f78d1d0d10)
- Use per-branch matrix for windows nightly in [902d39d57c](https://github.com/php/php-src/commit/902d39d57c)
- Fix uouv on oom on object allocation in [ee000ea186](https://github.com/php/php-src/commit/ee000ea186)
- Remove i386 Linux from push in [248e6b0404](https://github.com/php/php-src/commit/248e6b0404)
- Add Windows build to nightly in [90f514cf21](https://github.com/php/php-src/commit/90f514cf21)
- Fix EXPECT for `bug52820.phpt` on newer curl versions in [0e843c5d82](https://github.com/php/php-src/commit/0e843c5d82)
- Fix `curl_basic_009.phpt` for newer curl versions in [3af76b2302](https://github.com/php/php-src/commit/3af76b2302)
- Move ASAN built to GitHub actions in [fc9266a5fc](https://github.com/php/php-src/commit/fc9266a5fc)
- Move opnum_start for goto for clarification in [GH-11911](https://github.com/php/php-src/pull/11911)
- Revert &quot;Call cast_object handler from get_properties_for&quot; in [efc73f24c3](https://github.com/php/php-src/commit/efc73f24c3)
- Don&#039;t test macOS &amp; i386 without opcache on push in [5cd0208e9f](https://github.com/php/php-src/commit/5cd0208e9f)


### Jakub Zelenka
- Remove incorrectly updated dtrace change from NEWS in [760367dd70](https://github.com/php/php-src/commit/760367dd70)
- Fix [GH-12077](https://github.com/php/php-src/issues/12077): Check lsof functionality in socket on close test in [fe30c5098f](https://github.com/php/php-src/commit/fe30c5098f)
- Fix FPM UDS test for very long name check by extending its length in [ea87501aee](https://github.com/php/php-src/commit/ea87501aee)
- Extend workflow matrix and nighly with PHP-8.3 in [300ad65c7c](https://github.com/php/php-src/commit/300ad65c7c)
- Start PHP 8.4 development cycle in [7deb84b7a6](https://github.com/php/php-src/commit/7deb84b7a6)
- Update API versions and numbers in [2eb21b0b1e](https://github.com/php/php-src/commit/2eb21b0b1e)
- Small tyding up of filestat code in [4e7ab1478d](https://github.com/php/php-src/commit/4e7ab1478d)
- Expand file path in file stat only for wrapper path in [GH-12068](https://github.com/php/php-src/pull/12068)
- Fix bug [#76857](https://bugs.php.net/bug.php?id=76857): Can read &quot;non-existant&quot; files in [766cac072f](https://github.com/php/php-src/commit/766cac072f)
- Fix bug [#52335](https://bugs.php.net/bug.php?id=52335) (`fseek()` on memory stream behavior different then file) in [ba9650d697](https://github.com/php/php-src/commit/ba9650d697)
- Fix flaky file stat tests due to changing nature of atime in [e1396a314d](https://github.com/php/php-src/commit/e1396a314d)
- Format UPGRADING in [10e16347ef](https://github.com/php/php-src/commit/10e16347ef)
- Fix [GH-11982](https://github.com/php/php-src/issues/11982): str_getcsv returns null byte for unterminated quoted string in [aff46d75e1](https://github.com/php/php-src/commit/aff46d75e1)
- FPM tester FastCGI client transport in [GH-11764](https://github.com/php/php-src/pull/11764)
- Introduce Zend guard recursion protection in [53aa53f42f](https://github.com/php/php-src/commit/53aa53f42f)


### Jeremie Courreges-Anglas
- On riscv64 require libatomic if actually needed in [bf3fb4e5c9](https://github.com/php/php-src/commit/bf3fb4e5c9)


### Jorg Adam Sowa
- Fix `round()` tests for different modes in [GH-12049](https://github.com/php/php-src/pull/12049)
- Tests improvement for `round()` modes in [GH-11996](https://github.com/php/php-src/pull/11996)
- BCmath extension code reformatting in [GH-11896](https://github.com/php/php-src/pull/11896)


### jrfnl
- Remove `mysqli.reconnect` from php.ini files in [GH-11836](https://github.com/php/php-src/pull/11836)


### ju1ius
- releases property attributes of internal classes in [GH-11980](https://github.com/php/php-src/pull/11980)
- Adds support for DNF types in internal functions and properties  in [GH-11969](https://github.com/php/php-src/pull/11969)


### Kamil Tekiela
- Fix param name in `implode()` error message in [b1ce1d1f21](https://github.com/php/php-src/commit/b1ce1d1f21)
- Fix failing test on nightly in [ffd398b4fe](https://github.com/php/php-src/commit/ffd398b4fe)
- Fix implicit/explicit port in mysqlnd in [c1103a9772](https://github.com/php/php-src/commit/c1103a9772)
- mysqli_field_seek return type changed to true in [GH-11948](https://github.com/php/php-src/pull/11948)
- Align highlight_string|file with HTML standard and modern browsers in [f907a009f9](https://github.com/php/php-src/commit/f907a009f9)
- Fix error checking in mysqlnd in [0d922aa595](https://github.com/php/php-src/commit/0d922aa595)
- Remove remnant of COM_FIELD_LIST in [788540ef2c](https://github.com/php/php-src/commit/788540ef2c)


### Kévin Dunglas
- fix: handle the GNU specific version of strerror_r in [96885bc04f](https://github.com/php/php-src/commit/96885bc04f)


### Mikhail Galanin
- Set CLOEXEC on listened/accepted sockets in the FPM children in [418cdc0bea](https://github.com/php/php-src/commit/418cdc0bea)


### Máté Kocsis
- Fix the class synopsis of Throwable in [597aeb1246](https://github.com/php/php-src/commit/597aeb1246)
- Improve test for `odbc_columns()` in [2f9f2928ce](https://github.com/php/php-src/commit/2f9f2928ce)
- Use correct format specifier in [9dcdfa5e3f](https://github.com/php/php-src/commit/9dcdfa5e3f)
- Fix [GH-9967](https://github.com/php/php-src/issues/9967) Add support for generating custom function, class const, and property attributes in stubs in [c934e24197](https://github.com/php/php-src/commit/c934e24197)
- Expose PDO_ODBC_TYPE to userland in [462792ee51](https://github.com/php/php-src/commit/462792ee51)
- Improve and fix `ext/odbc` tests in [8726ae0601](https://github.com/php/php-src/commit/8726ae0601)
- Enable `ext/odbc` and `ext/pdo_odbc` tests on Linux in GitHub CI in [985511e968](https://github.com/php/php-src/commit/985511e968)
- Add more test coverage for `ext/odbc` in [66acaba9db](https://github.com/php/php-src/commit/66acaba9db)
- Align the return type of `snmp_set_oid_numeric_print()` to its aliased funtion in [67ab2b7d87](https://github.com/php/php-src/commit/67ab2b7d87)
- Make the $enable parameter of `odbc_autocommit()` nullable in [GH-11909](https://github.com/php/php-src/pull/11909)
- Fix return type of `odbc_data_source()` in [77252afaf0](https://github.com/php/php-src/commit/77252afaf0)


### Niels Dossche
- Fix [GH-11972](https://github.com/php/php-src/issues/11972): RecursiveCallbackFilterIterator regression in 8.1.18 in [1cdcbc05b0](https://github.com/php/php-src/commit/1cdcbc05b0)
- Fix [GH-11972](https://github.com/php/php-src/issues/11972): RecursiveCallbackFilterIterator regression in 8.1.18 in [ffd7018fcd](https://github.com/php/php-src/commit/ffd7018fcd)
- Implement [GH-11934](https://github.com/php/php-src/issues/11934): Allow to pass CData into struct and/or union fields in [0b9702c9ed](https://github.com/php/php-src/commit/0b9702c9ed)
- Fix oss-fuzz [#61712](https://bugs.php.net/bug.php?id=61712): assertion failure with error handler during binary op in [a3a3964497](https://github.com/php/php-src/commit/a3a3964497)
- Remove useless duplicated call to `php_stream_parse_fopen_modes` in [GH-12059](https://github.com/php/php-src/pull/12059)
- Add missing EXTENSIONS section to DOM tests in [bffc74474b](https://github.com/php/php-src/commit/bffc74474b)
- Improve warning when returning null from the resolver set by libxml_set_external_entity_loader in [e1cb721679](https://github.com/php/php-src/commit/e1cb721679)
- Update DOM test to work around libxml2 bug in [0fd226c277](https://github.com/php/php-src/commit/0fd226c277)
- Fix memory leak when setting an invalid DOMDocument encoding in [20ac42e1b0](https://github.com/php/php-src/commit/20ac42e1b0)
- Remove unnecessary invalidation from processing instructions in [4ff93f779c](https://github.com/php/php-src/commit/4ff93f779c)
- Add test for `SimpleXMLElement::asXML()` with a fragment and a filename in [2b61f71046](https://github.com/php/php-src/commit/2b61f71046)
- Fix various namespace prefix conflict resolution bugs and namespace shift bugs in [d46dc5694c](https://github.com/php/php-src/commit/d46dc5694c)
- Fix [#81992](https://bugs.php.net/bug.php?id=81992): `SplFixedArray::setSize()` causes use-after-free in [b71c6b2c6c](https://github.com/php/php-src/commit/b71c6b2c6c)
- [GH-11964](https://github.com/php/php-src/issues/11964): In ext/date/php_date.`stub.php`, DateRangeError extends itself in [17b3af2958](https://github.com/php/php-src/commit/17b3af2958)
- Fix [#80927](https://bugs.php.net/bug.php?id=80927): Removing documentElement after creating attribute node: possible use-after-free in [bb092ab4c6](https://github.com/php/php-src/commit/bb092ab4c6)
- Optimize checks for DOMParentNode and DOMChildNode in [620b6220c2](https://github.com/php/php-src/commit/620b6220c2)
- Align DOMChildNode parent checks with spec in [23ba4cde53](https://github.com/php/php-src/commit/23ba4cde53)
- Fix segfault when `DOMParentNode::prepend()` is called when the child disappears in [d19e4da125](https://github.com/php/php-src/commit/d19e4da125)
- Fix viable next sibling search for replaceWith in [df6e8bd4fd](https://github.com/php/php-src/commit/df6e8bd4fd)
- Fix viable next sibling search for replaceWith in [815b5ad501](https://github.com/php/php-src/commit/815b5ad501)
- Remove useless hashmap check in [5018dfecdf](https://github.com/php/php-src/commit/5018dfecdf)
- Fix [GH-11830](https://github.com/php/php-src/issues/11830): ParentNode methods should perform their checks upfront in [dddd309da4](https://github.com/php/php-src/commit/dddd309da4)
- Fix manually calling __construct() on DOM classes in [08c4db7f36](https://github.com/php/php-src/commit/08c4db7f36)
- Make `DOMChildNode::remove()` run in O(1) performance in [e701b2fee7](https://github.com/php/php-src/commit/e701b2fee7)
- Remove useless check in [872bf56fed](https://github.com/php/php-src/commit/872bf56fed)


### Peter Kokot
- Remove unneeded `zend_language_parser.h` patch in [GH-11974](https://github.com/php/php-src/pull/11974)
- Fix configure phpdbg help output in [GH-12013](https://github.com/php/php-src/pull/12013)
- Fix passing null to parameter of type string in [GH-12014](https://github.com/php/php-src/pull/12014)
- Sync `--enable-mysqlnd-compression-support` option in [GH-12006](https://github.com/php/php-src/pull/12006)
- Add all README.* files to paths-ignore in [GH-12003](https://github.com/php/php-src/pull/12003)
- Remove unused call to Makefile.frag in `ext/zip` in [c180e9b48a](https://github.com/php/php-src/commit/c180e9b48a)
- Remove unused HAVE_GCC_GLOBAL_REGS shell variable in [GH-11877](https://github.com/php/php-src/pull/11877)


### Pierrick Charron
- Prepare for PHP 8.4 in [ad2ac6f05f](https://github.com/php/php-src/commit/ad2ac6f05f)


### Remi Collet
- Fix [GH-12063](https://github.com/php/php-src/issues/12063) convert PHP single-quote to C double-quote string in [13d3564a51](https://github.com/php/php-src/commit/13d3564a51)

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


