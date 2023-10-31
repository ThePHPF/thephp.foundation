
---
title: 'PHP Core Roundup #18'
layout: post
tags:
  - roundup
author:
  - name: Ayesh Karunaratne
    url: https://aye.sh
  
  - name: Sergey Panteleev
    url: https://sergeypanteleev.com
published_at: 01 November 2023

---

Welcome back to [PHP Core Roundup](/blog/tag/roundup/) series! This is post #18, where we highlight and celebrate the improvements made to PHP during the month past by the PHP development team, members of the PHP Foundation, and more.

> The PHP Foundation is a collective of PHP contributors, veterans, and companies that collaborate to ensure the long-term sustainability of the PHP programming language. The foundation currently supports six contributors focused on PHP's maintenance, debt reduction, and feature development. These contributors work closely with others on coding, documentation, and discussions.

> Started over a year ago, the PHP Core Roundup series offers a summary of the latest developments, discussions, and news about PHP Core, contributed by both PHP Foundation members and other participants. This post is the thirteenth in the PHP Core Roundup series.

{% include "newsletter.html" %}

## Releases

The PHP development team released two new versions in October 2023:

**[PHP 8.2.12](https://www.php.net/ChangeLog-8.php#8.2.12)** and **[PHP 8.1.25](https://www.php.net/ChangeLog-8.php#8.1.25)**

These releases include several bug fixes and improvements, notably in areas such as Core, CLI, CType, DOM, Fileinfo, Filter, Hash, Intl, MySQLnd, Opcache, PCRE, SimpleXML, Streams, XML, and XSL. 

## Recent RFCs and Mailing List Discussions


> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

## PHP 8.3 GA to be released this month!

PHP 8.3.0 GA is scheduled to be released on November 23rd. PHP 8.3.0 RC5 is already released, and RC6 (the last one) is scheduled for November, 9.

PHP 8.3.0 RC versions are available in [Remi’s](https://rpms.remirepo.net/) repos for Fedora/RHEL, [Ondrej's](https://deb.sury.org/#php-packages) repos for Debian/Ubuntu LTS, [Docker images](https://hub.docker.com/_/php/tags?page=1&name=8.3) on Docker Hub, and compiled Windows binaries on [windows.php.net](https://windows.php.net/).

## PHP 8.0 will reach EOL

PHP 8.0 will reach EOL with the release of PHP 8.3 and will no longer get security updates.

## RFC Updates

Following are the RFCs and major pull-requests discussed, voted, and implemented since our last update.

### In Voting: Straw poll - How to name the Process resource after it is converted to an object by Máté Kocsis 💜

As part of PHP's efforts in gradually phrasing out `resource` objects ([php-tasks#6](https://github.com/php/php-tasks/issues/6), [article on PHP.Watch](https://php.watch/articles/resource-object)), this RFC polls the proposed names for the resource object class name that replaces `Process` resources. This ranked-choice poll (following [STV](https://en.wikipedia.org/wiki/Single_transferable_vote#Example)) intends to pick a name from `\Process`, `\ProcessHandle`, and `\OS\Process`.

### Implemented: [Increasing the default BCrypt cost](https://wiki.php.net/rfc/bcrypt_cost_2023) by Tim Düsterhus

RFC was approved unanimously, but in the second vote, where a new cost value had to be determined, opinions were divided.

Cost will be raised in PHP 8.4 to a value of 12.

### Implemented: [XML_OPTION_PARSE_HUGE](https://wiki.php.net/rfc/xml_option_parse_huge) by Niels Dossche

RFC proposes to add a new option to the event-driven (SAX) `XmlParser` that would allow it to parse large documents.

### Accepted: [DOM HTML5 parsing and serialization](https://wiki.php.net/rfc/domdocument_html5_parser) by Niels Dossche

PHP 8.4 will get new classes: `DOM\HTMLDocument` and `DOM\XMLDocument` to the dom extension. Existing dom classes in the global namespace get an alias in the new DOM namespace. The `HTMLDocument` class will add support for HTML5 document parsing and serializing. The `XMLDocument` class serves as a modern alternative to `\DOMDocument`, which is retained for compatibility. These new classes also provide a more misuse-resistant API for loading documents.

### Accepted: [A new JIT implementation based on IR Framework](https://wiki.php.net/rfc/jit-ir) by Dmitry Stogov

RFC proposes a new JIT implementation that is based on a separately developed [IR Framework](https://github.com/dstogov/ir). The main advantage of the new approach is that PHP source code will be freed from the low-level details of JIT compilation. The downside is a longer JIT-compilation time.

Dmitry [emailed](https://externals.io/message/121038) PHP Internals mailing list, which led to a lengthy discussion on the merits of the new JIT implementation. After the RFC vote was accepted, Dmitry [plans](https://externals.io/message/121239#121437) to merge the changes to `php-src` and remove the old JIT implementation in the next few days.

### Under discussion: [RFC1867 for non-POST HTTP verbs](https://wiki.php.net/rfc/rfc1867-non-post) by Ilija Tovilo 💜

Now PHP supports the parsing of `multipart/form-data` content type natively, but only for POST requests. If POST request has the `multipart/form-data` content type, the request body is immediately consumed before starting the PHP script and populated into the `$_POST` and `$_FILES` superglobals.

RFC proposes to add a new function `request_parse_body()` to expose the existing functionality to userland so that it may be used for other HTTP verbs.

### Under discussion: [Rounding Integers as int](https://wiki.php.net/rfc/integer-rounding) by Marc Bennewitz

Currently `round()`, `ceil()` and `floor()` functions return float numbers, but when using integers above `2^53` you get unexpected results due to loss of precision.

RFC proposes to perform rounding for a given integer and returning the resulting integer if possible.

### Under discussion: [Unbundle ext/imap, ext/pspell, ext/oci8, and ext/PDO_OCI](https://wiki.php.net/rfc/unbundle_imap_pspell_oci8) by Derick Rethans 💜

RFC proposes to unbundle these extensions: remove them from the PHP source distribution, and move them to PECL.

### Under discussion: [Multibyte for trim function mb_trim, mb_ltrim and mb_rtrim](https://wiki.php.net/rfc/mb_trim) by Yuya Hamada

RFC proposes to add multibyte support for trim functions.

### Under discussion: [Change the edge case of round()](https://wiki.php.net/rfc/change_the_edge_case_of_round) by Saki Takamachi

RFC proposes to change the `round()` behavior, and stop expecting decimal behavior to float point and start expecting floating point to behave as floating point.


<br>

## Documentation

While PHP 8.3 is just around the corner, the documentation available on [php.net](https://php.net), requires updating.

George P. Banyard 💜 is tracking the progress for PHP 8.3 related changes in [php/doc-en#2796](https://github.com/php/doc-en/issues/2796), and also triaged issues in the docs and marked several of them as "[good first time](https://github.com/php/doc-en/issues?q=is%3Aissue+is%3Aopen+label%3A%22good+first+issue%22)", which are ideal easy picks if you would like to start contributing to PHP docs. You can find the full list on [GitHub](https://github.com/php/doc-en/issues?q=is%3Aopen+is%3Aissue+label%3A%22good+first+issue%22).

<br>

## Merged PRs and Commits

Following are some changes that did not go through an RFC process because they are either planned, bug fixes, or progressive enhancements.
 
---

### Full list of commits  since [PHP Core Roundup #17](/blog/2023/10/01/php-core-roundup-17/)

Commits are in the order they were added, grouped by author in alphabetical order.

<details markdown="1">
  <summary>Click here to expand</summary>

### Alex Dowad
 - Add fast `mb_strcut` implementation for UTF-16 in [d04854b38c](https://github.com/php/php-src/commit/d04854b38c)
 - Fix infinite loop when `mb_detect_encoding` is used on UTF-8 BOM in [81e236cde5](https://github.com/php/php-src/commit/81e236cde5)
 - `PHP_HAVE_BUILTIN_USUB_OVERFLOW` macro is defined even if __builtin_usub_overflow not available in [0c22276888](https://github.com/php/php-src/commit/0c22276888)
 - Add fast `mb_strcut` implementation for UTF-8 in [1f0cf133db](https://github.com/php/php-src/commit/1f0cf133db)
 - Add test cases for `mb_strcut` in [3fa836f711](https://github.com/php/php-src/commit/3fa836f711)
 - Add tests to document behavior of UTF7-IMAP conversion in obscure corner case in [9aa4b2bbad](https://github.com/php/php-src/commit/9aa4b2bbad)
 - Add assertion to mb_utf7imap_to_wchar to catch buffer overrun in [a57fdea149](https://github.com/php/php-src/commit/a57fdea149)


### Anatol Belski
 - NEWS: Add note about [GH-11891](https://github.com/php/php-src/issues/11891) in [31a44c8ca7](https://github.com/php/php-src/commit/31a44c8ca7)
 - NEWS: Added note about [GH-11891](https://github.com/php/php-src/issues/11891) in [1934da0a81](https://github.com/php/php-src/commit/1934da0a81)
 - NEWS: Added note about [GH-11891](https://github.com/php/php-src/issues/11891) in [a1225f35bb](https://github.com/php/php-src/commit/a1225f35bb)
 - fileinfo: Backport svg detection patch in [bd24c56207](https://github.com/php/php-src/commit/bd24c56207)


### Ayesh Karunaratne
 - Minor fix in `NEWS` alignment in [f8433a5100](https://github.com/php/php-src/commit/f8433a5100)


### Ben Ramsey
 - Add instructions for updating security.txt in web-php in [GH-12316](https://github.com/php/php-src/pull/12316)


### coppolafab
 - `php_cli_server`: ensure single date header is present in [f6ac08c6a3](https://github.com/php/php-src/commit/f6ac08c6a3)


### Cristian Rodríguez
 - opcache: Use O_TMPFILE file lock if available in [GH-8634](https://github.com/php/php-src/pull/8634)


### Daniil Gentili
 - Fix [GH-11121](https://github.com/php/php-src/issues/11121): ReflectionFiber segfault in [71f14510f6](https://github.com/php/php-src/commit/71f14510f6)
 - Report warning if JIT cannot be enabled in [7177461141](https://github.com/php/php-src/commit/7177461141)
 - Trigger JIT tracing&amp;compilation more often in [098d9ca720](https://github.com/php/php-src/commit/098d9ca720)

### David CARLIER
 - cleanup inet_ntoa usage in [1c8943bc78](https://github.com/php/php-src/commit/1c8943bc78)
 - `ext/pdo_pgsql`: cleanup the 3rd protocol is supported since circa 2010. in [GH-12464](https://github.com/php/php-src/pull/12464)
 - `ext/pgsql`: cleanup the 3rd protocol is supported since circa 2010. in [GH-12465](https://github.com/php/php-src/pull/12465)
 - CODEOWNERS: adding myself for the pdo_pgsql extension in [GH-12456](https://github.com/php/php-src/pull/12456)
 - Fix 12424 PDO_PGSQL unit test unexistent variables in [GH-12446](https://github.com/php/php-src/pull/12446)
 - opcache posix creating special shared segments for FreeBSD 13 and above in [2e0ca4718b](https://github.com/php/php-src/commit/2e0ca4718b)
 - zend call stack for DragonFlyBSD. in [GH-12325](https://github.com/php/php-src/pull/12325)


### Dmitry Stogov
 - Backport fix for incorrect assumption about in-memory zval type in [455a967934](https://github.com/php/php-src/commit/455a967934)
 - Backport implementation of iterative Pearce&#039;s SCC finding algoritm in [GH-12528](https://github.com/php/php-src/pull/12528)
 - Add reference to IR framework in [c282e2080f](https://github.com/php/php-src/commit/c282e2080f)
 - Fixed codegeneration for NOT in [ed37ab9d14](https://github.com/php/php-src/commit/ed37ab9d14)
 - Fixed [GH-12511](https://github.com/php/php-src/issues/12511): Use must be in next opline assertion with patched infection in [b3b46a44c5](https://github.com/php/php-src/commit/b3b46a44c5)
 - Fix memory leak after GC inside a foreach loop in [GH-12572](https://github.com/php/php-src/pull/12572)
 - Fixed [GH-12560](https://github.com/php/php-src/issues/12560): Assertion `0 &amp;&amp; &quot;too long jmp distance&quot;&#039; failed with new JIT on AArch64 in [93c57af778](https://github.com/php/php-src/commit/93c57af778)
 - Fixed codegeneration for PRE_DEC in [411b6fb4e6](https://github.com/php/php-src/commit/411b6fb4e6)
 - Fixed incorrect assumption about in-memory zval type in [52480b3a79](https://github.com/php/php-src/commit/52480b3a79)
 - Fixed codegeneration for MATCH in [bd183a4069](https://github.com/php/php-src/commit/bd183a4069)
 - Fixed codegeneration for FETCH_DIM_IS in [e482785886](https://github.com/php/php-src/commit/e482785886)
 - Fixed codegenertion for FETCH_DIM_W in [c8cb68ad0a](https://github.com/php/php-src/commit/c8cb68ad0a)
 - Fixed incorrect trace type inference in [c19347a0d3](https://github.com/php/php-src/commit/c19347a0d3)
 - Implement iterative Pearce&#039;s SCC finding algoritm in [GH-12528](https://github.com/php/php-src/pull/12528)
 - Fixed [GH-12509](https://github.com/php/php-src/issues/12509): JIT assertion when running php-parser tests in [5f46d86955](https://github.com/php/php-src/commit/5f46d86955)
 - Fixed codegeneration for IDENTICAL in [e95faaeebd](https://github.com/php/php-src/commit/e95faaeebd)
 - Fixed code generation for DETCH_DIM_R in [ce269178a9](https://github.com/php/php-src/commit/ce269178a9)
 - Fixed regression introduced by [4ae483af](https://github.com/php/php-src/commit/4ae483af36a86aeccbdae29af31213ba13cddb12) in [8eda3151eb](https://github.com/php/php-src/commit/8eda3151eb)
 - Fixed regression intoduced by [76c41d27](https://github.com/php/php-src/commit/76c41d27f9277eb8210d0058f19d0a7cfa7d7a66) in [fbf4e196da](https://github.com/php/php-src/commit/fbf4e196da)
 - Fixed codegeneration for INC_OBJ in [a96ea5d235](https://github.com/php/php-src/commit/a96ea5d235)
 - Fixed code generation for MOD in [9f5a4c3799](https://github.com/php/php-src/commit/9f5a4c3799)
 - Fixed code generation for CMP in [c2b704b63e](https://github.com/php/php-src/commit/c2b704b63e)
 - Fixed code generation for ASSIGN_DIM in [c163ff68da](https://github.com/php/php-src/commit/c163ff68da)
 - Invalidate &quot;memory&quot; type of zval if a register was stored in memory to call a helper function in [accc1e6c67](https://github.com/php/php-src/commit/accc1e6c67)
 - Fixed compilation of &quot;switch&quot; with undefined input in [8fc3615a7a](https://github.com/php/php-src/commit/8fc3615a7a)
 - Fixed compilation of dead code after assignment property to non object in [3a8767b0d1](https://github.com/php/php-src/commit/3a8767b0d1)
 - Update IR in [894a7594aa](https://github.com/php/php-src/commit/894a7594aa)
 - Update IR in [1068a5f758](https://github.com/php/php-src/commit/1068a5f758)
 - Fixed selection candidates for register allocation in [4ae483af36](https://github.com/php/php-src/commit/4ae483af36)
 - Fixed compilation of match with undefined input in [23e4e3b18b](https://github.com/php/php-src/commit/23e4e3b18b)
 - Fixed incorrect type inference in [aa45df4849](https://github.com/php/php-src/commit/aa45df4849)
 - Fixed [GH-12482](https://github.com/php/php-src/issues/12482): Abortion with tracing JIT in [76c41d27f9](https://github.com/php/php-src/commit/76c41d27f9)
 - Remove old JIT implementation in [GH-12498](https://github.com/php/php-src/pull/12498)
 - memory_consumption must be page aligned in [e270ee3008](https://github.com/php/php-src/commit/e270ee3008)
 - Fixed [GH-12494](https://github.com/php/php-src/issues/12494): Zend/tests/arginfo_zpp_mismatch.phpt causes a segfault withJIT + `--repeat` 2 in [e0ca4dca5b](https://github.com/php/php-src/commit/e0ca4dca5b)
 - Fix possible NULL dereference (crash on Zend/tests/arginfo_zpp_mismatch.phpt) in [25cb2a40d6](https://github.com/php/php-src/commit/25cb2a40d6)
 - A new PHP JIT implementation based on IR JIT framework in [GH-12079](https://github.com/php/php-src/pull/12079)
 - Fixed [GH-11917](https://github.com/php/php-src/issues/11917): primitives seem to be passed via reference instead of by value under some conditions when JIT is enabled on windows in [GH-12451](https://github.com/php/php-src/pull/12451)
 - Fixed [GH-12428](https://github.com/php/php-src/issues/12428): Assertion with function/tracing JIT in [dabced0fbb](https://github.com/php/php-src/commit/dabced0fbb)
 - Fixed possible use-after-free in [2297e8c143](https://github.com/php/php-src/commit/2297e8c143)
 - Fix [GH-12364](https://github.com/php/php-src/issues/12364): JIT leak in Symfony TranslationDebugCommandTest in [GH-12394](https://github.com/php/php-src/pull/12394)
 - Fix [GH-12364](https://github.com/php/php-src/issues/12364): JIT leak in Symfony TranslationDebugCommandTest in [GH-12394](https://github.com/php/php-src/pull/12394)
 - Fix incorrect trace type inference in [44a7016049](https://github.com/php/php-src/commit/44a7016049)
 - Fixed [GH-12382](https://github.com/php/php-src/issues/12382): JIT Index invalid or out of range error in [5a8f96b0bb](https://github.com/php/php-src/commit/5a8f96b0bb)
 - Fixed [GH-12262](https://github.com/php/php-src/issues/12262): Tracing JIT assertion crash when using phpstan in [54452b4811](https://github.com/php/php-src/commit/54452b4811)


### Eric Mann
 - Prepare NEWS for PHP 8.3.0RC5 in [cd71ab33c4](https://github.com/php/php-src/commit/cd71ab33c4)


### Gina Peter Banyard 💜
 - PDO: Clean-up tests so it&#039;s easier to see if they use default test table in [GH-12552](https://github.com/php/php-src/pull/12552)
 - `ext/xml`: Refactor extension to use FCC instead of zvals for handlers in [GH-12340](https://github.com/php/php-src/pull/12340)
 - `ext/spl`: Use new F ZPP modifier in [e41598c7fc](https://github.com/php/php-src/commit/e41598c7fc)
 - `ext/libxml`: Use new F ZPP modifier in [52de0950f4](https://github.com/php/php-src/commit/52de0950f4)
 - Zend: Add ZPP F type check for callables that do not free trampolines in [d86314939c](https://github.com/php/php-src/commit/d86314939c)
 - Add some const qualifiers in HashTable foreach macros in [GH-8671](https://github.com/php/php-src/pull/8671)


### icy17
 - Fix null pointer dereferences in case of allocation failure in [900f0cab9f](https://github.com/php/php-src/commit/900f0cab9f)


### Ilija Tovilo 💜
 - Add `zend_worklist.h` to `PHP_INSTALL_HEADERS` in [GH-12571](https://github.com/php/php-src/pull/12571)
 - Attempt to fix pdo_mysql conflict on CircleCI in [GH-12563](https://github.com/php/php-src/pull/12563)
 - Run FreeBSD on push in [b280f1f964](https://github.com/php/php-src/commit/b280f1f964)
 - Split complex regexes to multiple lines in `zend_vm_gen.php` in [964e9d806b](https://github.com/php/php-src/commit/964e9d806b)
 - Fix double-free of doc_comment when overriding static property via trait in [af3d2f7ec9](https://github.com/php/php-src/commit/af3d2f7ec9)
 - Implement diagnostic ignore macro for Clang in [80b4c73030](https://github.com/php/php-src/commit/80b4c73030)
 - Close PHP tags in tests in [f39b5c4c25](https://github.com/php/php-src/commit/f39b5c4c25)
 - Avoid JIT warning with opcache.jit_buffer_size=0 in [07d81592e9](https://github.com/php/php-src/commit/07d81592e9)
 - Revert &quot;Test ASAN on Ubuntu 22.04 in nightly by increasing swap&quot; in [5a0c0072dd](https://github.com/php/php-src/commit/5a0c0072dd)
 - Remove redundant CI JIT flags in [29fed1cf47](https://github.com/php/php-src/commit/29fed1cf47)
 - Fix JIT on nightly in [734afa0ba8](https://github.com/php/php-src/commit/734afa0ba8)
 - CircleCI: Increase no_output_timeout to 30m in [c07aed53dd](https://github.com/php/php-src/commit/c07aed53dd)
 - Remove invalid `--with-zlib-dir`=/usr configure flag in [384a4764b1](https://github.com/php/php-src/commit/384a4764b1)
 - Move ARM build to CircleCI in [4332546bbf](https://github.com/php/php-src/commit/4332546bbf)
 - Reduce jit_max_root_traces in tests in [2aa2d91a7b](https://github.com/php/php-src/commit/2aa2d91a7b)
 - Fix use-after-free of constant name in [53dbb760da](https://github.com/php/php-src/commit/53dbb760da)
 - Move Cirrus to nightly only, trigger on-demand in [92693a2286](https://github.com/php/php-src/commit/92693a2286)
 - Minimal backport of 098d9ca in [36a87e6d32](https://github.com/php/php-src/commit/36a87e6d32)
 - Fix `SKIPIF` jit test in [6e7e52de19](https://github.com/php/php-src/commit/6e7e52de19)
 - Add missing jitType input for test-macos action in [234648e40c](https://github.com/php/php-src/commit/234648e40c)
 - Fix invalid returned opcode for memoized expressions in [4ba5699903](https://github.com/php/php-src/commit/4ba5699903)
 - Test ASAN on Ubuntu 22.04 in nightly by increasing swap in [f7cef9a242](https://github.com/php/php-src/commit/f7cef9a242)
 - Fix `str_decrement()` on &quot;1&quot; in [b31a5b2731](https://github.com/php/php-src/commit/b31a5b2731)
 - Use separate sqlsrv dbs for different exts in [769f41bb21](https://github.com/php/php-src/commit/769f41bb21)
 - Fix GCC warning in `math.c` in [fcae58809f](https://github.com/php/php-src/commit/fcae58809f)


### Jakub Zelenka 💜
 - Fix failing test for bug [#75708](https://bugs.php.net/bug.php?id=75708) in [006032b6f0](https://github.com/php/php-src/commit/006032b6f0)
 - Fix bug [#75708](https://bugs.php.net/bug.php?id=75708): getimagesize with &quot;&amp;$imageinfo&quot; fails on StreamWrappers in [52aa0d9ecc](https://github.com/php/php-src/commit/52aa0d9ecc)
 - Fix [GH-12489](https://github.com/php/php-src/issues/12489): Missing sigbio creation checking in openssl_cms_verify in [83a242ec0c](https://github.com/php/php-src/commit/83a242ec0c)
 - Fix [GH-12232](https://github.com/php/php-src/issues/12232): FPM: segfault dynamically loading extension without opcache in [0217be4d5b](https://github.com/php/php-src/commit/0217be4d5b)


### Jorg Adam Sowa
 - Typed constants in sqlite extension in [GH-12379](https://github.com/php/php-src/pull/12379)
 - Typed constants in Intl extenstion in [GH-12360](https://github.com/php/php-src/pull/12360)
 - Typed constants in PDO extension in [GH-12362](https://github.com/php/php-src/pull/12362)
 - Typed constants in reflection extension in [GH-12378](https://github.com/php/php-src/pull/12378)
 - Typed constants in SPL extension in [GH-12358](https://github.com/php/php-src/pull/12358)


### Julien Desrosiers
 - Nested match expression tests in [226b92b1dc](https://github.com/php/php-src/commit/226b92b1dc)


### Julien Francoz
 - add file path in opcache lock file error in [GH-10331](https://github.com/php/php-src/pull/10331)


### Kévin Dunglas
 - fix: don&#039;t delete an unitialized timer in [GH-12537](https://github.com/php/php-src/pull/12537)


### Levi Morrison
 - fix `mbstring.c` -Wsingle-bit-bitfield-constant-conversion in [GH-12327](https://github.com/php/php-src/pull/12327)
 - fix -Wreturn-type and -Wstrict-prototypes in gd configure in [GH-12328](https://github.com/php/php-src/pull/12328)


### Marcos Marcolin
 - Remove unused code in `run-tests.php` in [GH-12553](https://github.com/php/php-src/pull/12553)
 - chore: removes redundant validation of $repeat, as it is the while condition. in [GH-12521](https://github.com/php/php-src/pull/12521)


### Michael Voříšek
 - Fix unused variable in `phpdbg_cmd.c` in [GH-12575](https://github.com/php/php-src/pull/12575)
 - Fix [GH-11374](https://github.com/php/php-src/issues/11374): Different preg_match result with -d pcre.jit=0 in [83a505e85f](https://github.com/php/php-src/commit/83a505e85f)


### Mikhail Galanin
 - Invalidate path even if the file was deleted in [f4ab494906](https://github.com/php/php-src/commit/f4ab494906)


### Máté Kocsis 💜
 - Parallelize pdo tests (dblib, firebird, oci, odbc, pgsql) in [GH-12395](https://github.com/php/php-src/pull/12395)


### Niels Dossche
 - Fix memory leak in error path of `zend_register_list_destructors_ex` in [3bf5d89efb](https://github.com/php/php-src/commit/3bf5d89efb)
 - Fix cloning attribute with namespace disappearing namespace in [3e33eda39a](https://github.com/php/php-src/commit/3e33eda39a)
 - Fix [GH-12532](https://github.com/php/php-src/issues/12532): PharData created from zip has incorrect timestamp in [a470c4aeef](https://github.com/php/php-src/commit/a470c4aeef)
 - Remove dead stores from `ext/spl` in [GH-12550](https://github.com/php/php-src/pull/12550)
 - Mitigate [#51561](https://bugs.php.net/bug.php?id=51561): SoapServer with a extented class and using sessions, lost the setPersistence() in [53218b1a32](https://github.com/php/php-src/commit/53218b1a32)
 - Fix FFI tests on 8.3+ in [43064cae94](https://github.com/php/php-src/commit/43064cae94)
 - Fix #47531: No way of removing redundant xmlns: declarations in [f9a24969d0](https://github.com/php/php-src/commit/f9a24969d0)
 - Fix bug [#75306](https://bugs.php.net/bug.php?id=75306): Memleak in SoapClient in [27797a26ca](https://github.com/php/php-src/commit/27797a26ca)
 - Fix incorrect dtor for persistent sdl-&gt;encoders in [9f7f3b2034](https://github.com/php/php-src/commit/9f7f3b2034)
 - Fix soap crash with `ZEND_RC_DEBUG` in [GH-12514](https://github.com/php/php-src/pull/12514)
 - Convert `ext/xml` fields from int to bool in [GH-12497](https://github.com/php/php-src/pull/12497)
 - Use Clang 16 to work around LSAN TLS crashes in [GH-12496](https://github.com/php/php-src/pull/12496)
 - [RFC] DOM HTML5 parsing and serialization support (Lexbor library part) in [GH-12493](https://github.com/php/php-src/pull/12493)
 - Implement request [#68325](https://bugs.php.net/bug.php?id=68325): parse huge option for `xml_parser_create` ([#12256](https://bugs.php.net/bug.php?id=12256)) in [98b08c52db](https://github.com/php/php-src/commit/98b08c52db)
 - Remove `php_xsl_create_object()` in [GH-12492](https://github.com/php/php-src/pull/12492)
 - Fix segfault and assertion failure with refcounted props and arrays in [01d61605d3](https://github.com/php/php-src/commit/01d61605d3)
 - Fix segfault and assertion failure with refcounted props and arrays in [deebb68612](https://github.com/php/php-src/commit/deebb68612)
 - Fix incorrect uri check in SOAP caching in [abf562c417](https://github.com/php/php-src/commit/abf562c417)
 - Fix bug [#66150](https://bugs.php.net/bug.php?id=66150): SOAP WSDL cache race condition causes Segmentation Fault in [43e63168e9](https://github.com/php/php-src/commit/43e63168e9)
 - Avoid refcounted copy in `_object_properties_init()` for internal classes in [GH-12474](https://github.com/php/php-src/pull/12474)
 - Add Laravel demo page to benchmark CI in [1c9c3af157](https://github.com/php/php-src/commit/1c9c3af157)
 - Cleanup unused variable in `php_dom.c` in [GH-12463](https://github.com/php/php-src/pull/12463)
 - Refactor some `ext/pcre` code for performance in [GH-12447](https://github.com/php/php-src/pull/12447)
 - Add missing module dependency for xsl in [68aa793173](https://github.com/php/php-src/commit/68aa793173)
 - Remove unused variable &#039;error&#039; in [GH-12438](https://github.com/php/php-src/pull/12438)
 - Fix compile error when `php_libxml.h` is included in C++ in [0cab865275](https://github.com/php/php-src/commit/0cab865275)
 - Optimize `strspn()` in [d0b29d8286](https://github.com/php/php-src/commit/d0b29d8286)
 - Fix registerNodeClass with abstract class crashing in [d7de0ceca6](https://github.com/php/php-src/commit/d7de0ceca6)
 - Cover more paths in `dom_xpath_ext_function_php()` with tests in [49b8168ddb](https://github.com/php/php-src/commit/49b8168ddb)
 - Introduce Z_PARAM_FUNC_EX2 to maintain compatibility in [GH-12419](https://github.com/php/php-src/pull/12419)
 - Fix [GH-12392](https://github.com/php/php-src/issues/12392): Segmentation fault on SoapClient::__getTypes in [7e4a3236d9](https://github.com/php/php-src/commit/7e4a3236d9)
 - Fix [GH-8996](https://github.com/php/php-src/issues/8996): DOMNode serialization on PHP ^8.1 in [24e5e4ec0d](https://github.com/php/php-src/commit/24e5e4ec0d)
 - Fix [GH-12380](https://github.com/php/php-src/issues/12380): JIT+private array property access inside closure accesses private property in child class in [fb6838770c](https://github.com/php/php-src/commit/fb6838770c)
 - Convert bounds exception in SplFixedArray to OutOfBoundsException instead of RuntimeException in [GH-12383](https://github.com/php/php-src/pull/12383)
 - Fix Windows CI in [ae52f1958d](https://github.com/php/php-src/commit/ae52f1958d)
 - Add missing properties to xsl stub in [GH-12334](https://github.com/php/php-src/pull/12334)
 - Ignore optional warning output in test in [6cf76d552e](https://github.com/php/php-src/commit/6cf76d552e)
 - Fix test under older CI configurations in [b140f6e9f8](https://github.com/php/php-src/commit/b140f6e9f8)
 - Fix [#80092](https://bugs.php.net/bug.php?id=80092): ZTS + preload = segfault on shutdown in [bdc87b0f66](https://github.com/php/php-src/commit/bdc87b0f66)
 - Improve error messages for `XSLTProcessor::transformToDoc()` in [GH-12332](https://github.com/php/php-src/pull/12332)
 - Fix broken cache invalidation with deallocated and reallocated document node in [eebc528cbf](https://github.com/php/php-src/commit/eebc528cbf)
 - Use RETURN_STR_COPY() in xsl in [f10e1b8f59](https://github.com/php/php-src/commit/f10e1b8f59)
 - Implement request [#64137](https://bugs.php.net/bug.php?id=64137) (`XSLTProcessor::setParameter()` should allow both quotes to be used) in [5c749ad4cf](https://github.com/php/php-src/commit/5c749ad4cf)
 - Apply SimpleXML iterator fixes only on master in [b842ea4fa8](https://github.com/php/php-src/commit/b842ea4fa8)
 - Add test for `XSLTProcessor::getParameter()` in [b67530a6c0](https://github.com/php/php-src/commit/b67530a6c0)


### Omar Emara
 - PGSQL: Allow unconditional selection in pg_select in [75da0d7c45](https://github.com/php/php-src/commit/75da0d7c45)


### Peter Kokot
 - Remove unused DBA_CDB_MAKE constant in [GH-12535](https://github.com/php/php-src/pull/12535)
 - Remove redundant code in `ext/mysqlnd` build in [GH-12384](https://github.com/php/php-src/pull/12384)


### Saki Takamachi
 - Optimized pdo_pgsql connection test in [GH-12454](https://github.com/php/php-src/pull/12454)
 - Fixed regular expression to get password from dsn in [GH-12448](https://github.com/php/php-src/pull/12448)
 - Fixed a bug in `zend_memnistr` with single character needle in [736032febf](https://github.com/php/php-src/commit/736032febf)
 - Fix [GH-12423](https://github.com/php/php-src/issues/12423): Changed to prioritize DSN authentication information over arguments in [b5c287e4b4](https://github.com/php/php-src/commit/b5c287e4b4)


### Sergei Turchanov
 - Reset inheritance_cache pointer of `zend_class_entry` upon serialization in [GH-12401](https://github.com/php/php-src/pull/12401)


### sji
 - Fix segfault caused by weak references to FFI objects in [GH-12488](https://github.com/php/php-src/pull/12488)


### Tim Düsterhus
 - random: Add additional test for `Randomizer::getFloat()` in [GH-12436](https://github.com/php/php-src/pull/12436)
 - random: Fix γ-section implementation for `Randomizer::getFloat()` in [GH-12402](https://github.com/php/php-src/pull/12402)
 - random: Remove RAND_RANGE_BADSCALING in [GH-12374](https://github.com/php/php-src/pull/12374)
 - pcre: Stop special-casing /e in [GH-12355](https://github.com/php/php-src/pull/12355)
 - password_hash: Increase `PHP_PASSWORD_BCRYPT_COST` to 12 in [GH-12367](https://github.com/php/php-src/pull/12367)


### usarise
 - fileinfo: Backport svg detection patch in [1f5bea3452](https://github.com/php/php-src/commit/1f5bea3452)


### Viktor Vassilyev
 - `ext/soap`: Add support for clark notation for namespaces in class map in [e58af7c160](https://github.com/php/php-src/commit/e58af7c160)


### Yurun
 - Fix the incorrect data type of float values in PDO query results in [6d10a69898](https://github.com/php/php-src/commit/6d10a69898)


### 武田 憲太郎
 - Fix pgsql and mysql tests on GitHub actions in [f42cef6675](https://github.com/php/php-src/commit/f42cef6675)

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


