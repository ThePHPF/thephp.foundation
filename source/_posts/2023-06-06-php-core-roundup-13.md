---
title: 'PHP Core Roundup #13'
layout: post
tags:
- roundup
author:
  name: Roman Pronskiy
  url: https://twitter.com/pronskiy  
published_at: 06 June 2023

---

The PHP Core team has been as productive as ever this past month, bringing forth a robust collection of updates that promise to shape the future of PHP. From RFCs that are sure to stir up lively debate, to ones that bring small, yet impactful changes, it has been a month filled with interesting developments. Here's what you need to know.

> The PHP Foundation is a collective of PHP contributors, veterans, and companies that collaborate to ensure the long-term sustainability of the PHP programming language. The foundation currently supports six contributors focused on PHP's maintenance, debt reduction, and feature development. These contributors work closely with others on coding, documentation, and discussions.

<br>

> Started over a year ago, the PHP Core Roundup series offers a summary of the latest developments, discussions, and news about PHP Core, contributed by both PHP Foundation members and other participants. This post is the thirteenth in the PHP Core Roundup series.

{% include "newsletter.html" %}

## Releases

The PHP development team released two new versions in May 2023: .

**[PHP 8.2.6](https://www.php.net/archive/2023.php#2023-05-11-1)**

This release includes several bug fixes and improvements, notably in areas such as Core, Date, DOM, Exif, Intl, PCRE, Reflection, SPL, Standard, and Streams.

**[PHP 8.1.19](https://www.php.net/archive/2023.php#2023-05-11-2)** 

This release includes bug fixes across various components such as Core, DOM, Exif, Intl, PCRE, and Standard.


## Recent RFCs and Mailing List Discussions

> Changes and improvements to PHP are discussed, reported, and voted on by the PHP Foundation Team, the PHP development team, and contributors. Bug reports are made to the PHP [issue tracker](https://github.com/php/php-src/issues), changes are discussed in [mailing lists](https://www.php.net/mailing-lists.php), minor code changes are proposed as [pull requests](https://github.com/php/php-src/issues), and major changes are discussed in detail and voted on as [PHP RFCs](https://wiki.php.net/rfc). [Documentation](https://github.com/php/doc-en/) and the [php.net website](https://github.com/php/web-php) changes are also discussed and improved at their relevant Git repositories on GitHub.

<br>
Hundreds of awesome PHP contributors put their efforts into improvements to the PHP code base, documentation, and the php.net website. Here is a summary of some changes made by the people behind PHP. Things marked with 💜 are done by the PHP Foundation team.

## RFC Updates

Following are the RFCs and major pull-requests discussed, voted on, and implemented since our last update.

### In Voting: [Define proper semantics for range() function](https://wiki.php.net/rfc/proper-range-semantics) by Gina Peter Banyard 💜

This RFC proposes to adjust the semantics of the `range()` function in PHP to throw exceptions or at least warn when passing unusable arguments to `range()`.

The `range()` function in PHP generates an array of values going from a start value to an end value. However, the current behavior of the function is complex and can lead to unexpected results. For example, if one of the boundary inputs is a string digit (e.g. "1"), both inputs will be interpreted as numbers. This RFC aims to address these issues and make the behavior of the `range()` function more predictable and consistent.

### In Voting: [mb_str_pad()](https://wiki.php.net/rfc/mb_str_pad) by Niels Dossche

This RFC proposes the addition of a multibyte string pad function to the mbstring extension. This function would work similarly to the existing `str_pad()` function, but with support for multibyte strings. This is a welcome addition for developers working with multibyte strings, as it will make it easier to manipulate and format these strings in PHP.

### Under Discussion: [Nameof Operator](https://wiki.php.net/rfc/nameof) by Robert Landers

This RFC proposes to add a global `nameof()` function, which would return the name of a variable, class, function, or method as a string. This could be useful in a variety of scenarios, such as debugging, logging, or creating more informative error messages.

### Under Discussion: [Marking Overridden Methods](https://wiki.php.net/rfc/marking_overriden_methods) by Tim Düsterhus

This RFC proposes a way to explicitly mark methods that are intended to override methods from a parent class with a new `#[\Override]` attribute. If this attribute is added to a method, the engine shall validate that a method with the same name exists in a parent class or any of the implemented interfaces. If no such method exists a compile time error shall be emitted.

The similar concepts exist in Java, TypeScript, C++, C#, Swift, Kotlin, and other languages. 


### Under Discussion: [Deprecate Functions with Overloaded Signatures](https://wiki.php.net/rfc/deprecate_functions_with_overloaded_signatures) by Máté Kocsis 💜

This RFC proposes to deprecate a number of functions that have overloaded signatures, meaning they behave differently based on the number or type of arguments passed to them. The goal is to make PHP's function signatures more consistent and predictable.

### Under Discussion: [Deprecations for PHP 8.3](https://wiki.php.net/rfc/deprecations_php_8_3) by Gina Peter Banyard 💜, Christoph M. Becker, Máté Kocsis 💜, Tim Düsterhus, Go Kudo, Andreas Heigl

The aim is to clean up some of the older, less consistent parts of PHP to make the language more reliable and predictable. The following list provides a short overview of the functionality targeted for deprecation:

- Passing negative `$widths` to `mb_strimwidth()`
- The `NumberFormatter::TYPE_CURRENCY` constant
- Unnecessary `crypt()` related constants
- `MT_RAND_PHP`
- Global Mersenne Twister

### Declined: [PHP Technical Committee](https://wiki.php.net/rfc/php_technical_committee) by Jakub Zelenka 💜 and Larry Garfield

This RFC proposed the creation of a PHP Technical Committee (TC) that would make decisions about technical aspects of the PHP language and its reference implementation. The TC would have been responsible for resolving technical conflicts between core developers. Despite the potential benefits, the community decided not to move forward with this proposal.

## Notable Mailing List Discussions

### [Callable types via Interfaces](https://externals.io/message/120083)

The proposal suggests that callable types should be allowed to be represented as interfaces, which would allow for more precise type hinting and better static analysis. The sentiment in the thread is generally positive, with many participants expressing support for the idea. However, some concerns were raised about potential complexity and the need for careful implementation to avoid breaking existing code.

### [Interface Properties](https://externals.io/message/120403)

The discussion starter suggests making it possible to define properties in interfaces and argues that this feature would align well with the deprecation of dynamic properties and could replace the current practice of specifying these properties in doc blocks.

Larry Garfield pointed out that interface properties are already included in the [Property Hooks RFC](https://wiki.php.net/rfc/property-hooks), which is expected to go to a vote soon.

David Gebler expressed his disagreement with the proposal, stating that interfaces in most languages don't support defining properties because they are generally seen as an implementation detail rather than a promise about supported behavior. He also mentioned that interfaces are essentially an alternative to multiple inheritance, and mandating fields as well as method signatures brings them very close to abstract classes. He also expressed concerns about multiple interfaces defining the same property, which could lead to conceptual confusion.

Some participants expressed support, noting that it could improve code clarity and reduce the need for doc blocks.

## Merged PRs and Commits

This month, the PHP core team has been hard at work improving the PHP language. Here's a list of the commits made by the team, grouped by author:


<details markdown="1">
  <summary>Click here to expand</summary>
- __Tim Düsterhus__
    - RFC: Make unserialize() emit a warning for trailing bytes in [GH-9630](https://github.com/php/php-src/pull/9630)
- __Dmitry Stogov__
    - JIT: Fixed inaccurate range inference usage for UNDEF/NULL/FALSE in [25ad171f63](https://github.com/php/php-src/commit/25ad171f63)
    - Fixed [GH-11127](https://github.com/php/php-src/issues/11127) (JIT fault) in [ed0b593c11](https://github.com/php/php-src/commit/ed0b593c11)
- __yang yuhan__
    - JIT: Align JIT stubs in [GH-11149](https://github.com/php/php-src/pull/11149)
- __ColinHDev__
    - Fix negative indices on empty array not affecting next chosen index in [GH-11157](https://github.com/php/php-src/pull/11157)
- __Sara__
    - Add configuration opcache.jit_max_trace_length in [GH-11173](https://github.com/php/php-src/pull/11173)
    - Cacheline demote to improve performance in [GH-11101](https://github.com/php/php-src/pull/11101)
- __Niels Dossche__
    - Fix too wide OR and AND range inference in [GH-11170](https://github.com/php/php-src/pull/11170)
    - Fix [GH-9068](https://github.com/php/php-src/issues/9068): Conditional jump or move depends on uninitialised value(s) in [GH-10221](https://github.com/php/php-src/pull/10221)
    - Fix [GH-11175](https://github.com/php/php-src/issues/11175) and [GH-11177](https://github.com/php/php-src/issues/11177): Stream socket timeout undefined behaviour in [GH-11183](https://github.com/php/php-src/pull/11183)
    - Fix [GH-11178](https://github.com/php/php-src/issues/11178): Segmentation fault in spl_array_it_get_current_data (PHP 8.1.18) in [GH-11182](https://github.com/php/php-src/pull/11182)
    - Fix [GH-11104](https://github.com/php/php-src/issues/11104): STDIN/STDOUT/STDERR is not available for CLI without a script in [f6c0c60ef6](https://github.com/php/php-src/commit/f6c0c60ef6)
    - Implement NEON-accelerated version of BLOCKCONV for lowercasing and uppercasing strings in [GH-11161](https://github.com/php/php-src/pull/11161)
    - Fix [GH-10031](https://github.com/php/php-src/issues/10031): [Stream] STREAM_NOTIFY_PROGRESS over HTTP emitted irregularly for last chunk of data in [GH-10492](https://github.com/php/php-src/pull/10492)
    - Fix [GH-11141](https://github.com/php/php-src/issues/11141): Could not open input file: should be sent to stderr in [GH-11163](https://github.com/php/php-src/pull/11163)
    - Fix maximum argument count of pcntl_forkx() in [GH-11199](https://github.com/php/php-src/pull/11199)
    - Fix [GH-11160](https://github.com/php/php-src/issues/11160): Few tests failed building with new libxml 2.11.0 in [GH-11162](https://github.com/php/php-src/pull/11162)
    - Fix [GH-11180](https://github.com/php/php-src/issues/11180): hash_file() appears to be restricted to 3 arguments in [GH-11198](https://github.com/php/php-src/pull/11198)
    - Remove unnecessary NULL assignments after ecalloc in streams in [GH-11209](https://github.com/php/php-src/pull/11209)
    - Fix [GH-8426](https://github.com/php/php-src/issues/8426): make test fail while soap extension build in [GH-11211](https://github.com/php/php-src/pull/11211)
    - Fix [GH-10834](https://github.com/php/php-src/issues/10834): exif_read_data() cannot read smaller stream wrapper chunk sizes in [GH-10924](https://github.com/php/php-src/pull/10924)
    - Fix [#97836](https://bugs.php.net/bug.php?id=97836) and [#81705](https://bugs.php.net/bug.php?id=81705): Segfault / type confusion in concat_function in [GH-10049](https://github.com/php/php-src/pull/10049)
    - Fix [GH-11274](https://github.com/php/php-src/issues/11274): POST/PATCH request via file_get_contents + stream_context_create switches to GET after a HTTP 308 redirect in [GH-11275](https://github.com/php/php-src/pull/11275)
    - Fix -Wstrict-prototypes warnings in fuzzer SAPI in [GH-11277](https://github.com/php/php-src/pull/11277)
    - Remove unused variable err in mb_send_mail() in [GH-11285](https://github.com/php/php-src/pull/11285)
    - Fix [GH-11245](https://github.com/php/php-src/issues/11245) (In some specific cases SWITCH with one default statement will cause segfault) in [GH-11251](https://github.com/php/php-src/pull/11251)
    - Fix [GH-11281](https://github.com/php/php-src/issues/11281): DateTimeZone::getName() does not include seconds in offset in [GH-11282](https://github.com/php/php-src/pull/11282)
    - Fix allocation loop in `zend_shared_alloc_startup()` in [GH-11306](https://github.com/php/php-src/pull/11306)
    - Fix [GH-11288](https://github.com/php/php-src/issues/11288) and [GH-11289](https://github.com/php/php-src/issues/11289) and [GH-11290](https://github.com/php/php-src/issues/11290) and [GH-9142](https://github.com/php/php-src/issues/9142): DOMExceptions and segfaults with replaceWith in [GH-11299](https://github.com/php/php-src/pull/11299)
    - Shrink libxml_doc_props struct in [GH-11326](https://github.com/php/php-src/pull/11326)
    - Fix [GH-10234](https://github.com/php/php-src/issues/10234): Setting DOMAttr::textContent results in an empty attribute value in [GH-10245](https://github.com/php/php-src/pull/10245)
    - Fix [GH-11338](https://github.com/php/php-src/issues/11338): SplFileInfo empty getBasename with more than one slash in [GH-11340](https://github.com/php/php-src/pull/11340)
    - Fix [GH-11336](https://github.com/php/php-src/issues/11336): php still tries to unlock the shared memory ZendSem with opcache.file_cache_only=1 but it was never locked in [GH-11341](https://github.com/php/php-src/pull/11341)
    - Fix spec compliance error for DOMDocument::getElementsByTagNameNS in [GH-11343](https://github.com/php/php-src/pull/11343)
    - Fix DOMElement::append() and DOMElement::prepend() hierarchy checks in [GH-11344](https://github.com/php/php-src/pull/11344)
    - Remove unnecessary tree setting in dom_zvals_to_fragment() in [GH-11345](https://github.com/php/php-src/pull/11345)
    - Implement dom_get_doc_props_read_only() in [GH-11345](https://github.com/php/php-src/pull/11345)
    - Fix [GH-11347](https://github.com/php/php-src/issues/11347): Memory leak when calling a static method inside an xpath query in [GH-11350](https://github.com/php/php-src/pull/11350)
- __Ilija Tovilo 💜__
    - Add retry mechanism in `run-tests.php` in [GH-10892](https://github.com/php/php-src/pull/10892)
    - Downgrade to Ubuntu 20.04 for ASAN nightly for now in [ef6bbaa1ec](https://github.com/php/php-src/commit/ef6bbaa1ec)
    - Correctly copy lineno for zval asts in [GH-11203](https://github.com/php/php-src/pull/11203)
    - Fix use-of-uninitialized value in `phar_object.c` in [GH-11202](https://github.com/php/php-src/pull/11202)
    - Fix use-of-undefined in zend_fiber_object_gc of ex->call in [GH-11208](https://github.com/php/php-src/pull/11208)
    - Fix compilation for PHP 8.1 in [8f66b67ccf](https://github.com/php/php-src/commit/8f66b67ccf)
    - Fix potential NULL pointer access in zend_fiber_object_gc in [0a04c008d0](https://github.com/php/php-src/commit/0a04c008d0)
    - Fix delayed early binding class redeclaration error in [GH-11226](https://github.com/php/php-src/pull/11226)
    - Fix -Wenum-int-mismatch warning in ext/json/php_json_encoder.h in [ac41608797](https://github.com/php/php-src/commit/ac41608797)
    - Implement delayed early binding for classes without parents in [0600f513b3](https://github.com/php/php-src/commit/0600f513b3)
    - Fix segfault in mb_strrpos/mb_strripos with ASCII encoding and negative offset in [GH-11220](https://github.com/php/php-src/pull/11220)
    - Fix string coercion for $a .= $a in [GH-11296](https://github.com/php/php-src/pull/11296)
    - Fix concat_function use-after-free on out-of-memory error in [GH-11297](https://github.com/php/php-src/pull/11297)
    - Fix access on NULL pointer in array_merge_recursive() in [GH-11303](https://github.com/php/php-src/pull/11303)
    - Fix preg_replace_callback_array() pattern validation in [GH-11301](https://github.com/php/php-src/pull/11301)
    - Fix exception handling in array_multisort() in [GH-11302](https://github.com/php/php-src/pull/11302)
    - Use zend_ast_apply in zend_eval_const_expr in [GH-11261](https://github.com/php/php-src/pull/11261)
    - Allow arbitrary expressions in static variable initializer in [GH-9301](https://github.com/php/php-src/pull/9301)
    - Use single allocation for indirect values in array_multisort in [GH-11309](https://github.com/php/php-src/pull/11309)
    - Fix `zend_jit_stop_counter_handlers()` performance issues with protect_memory=1 in [GH-11323](https://github.com/php/php-src/pull/11323)
    - Add tests for list() in assignment in array literals in [8ed66b4347](https://github.com/php/php-src/commit/8ed66b4347)
    - Revert "Use zend_ast_apply in zend_eval_const_expr (#11261)" in [fbe6696d49](https://github.com/php/php-src/commit/fbe6696d49)
- __Nils__ 
    - Remove unused macro PHP_FNV1_32A_INIT and PHP_FNV1A_64_INIT in [GH-11114](https://github.com/php/php-src/pull/11114)
- __David CARLIER__
    - `ext/pgsql`: pg_cancel_query internal update in [84c185c8ba](https://github.com/php/php-src/commit/84c185c8ba)
    - `ext/pgsql`: pg_trace allow to refine its trace mode via 2 new constants in [7ec8ae12c4](https://github.com/php/php-src/commit/7ec8ae12c4)
    - `ext/pgsql`: pg_lo_read addressing the todo. in [GH-11159](https://github.com/php/php-src/pull/11159)
    - `ext/pgsql` adding PGSQL_ERRORS_SQLSTATE constant support in [f31d253849](https://github.com/php/php-src/commit/f31d253849)
    - `ext/pgsql`: fix pg_trace test when trace mode is supported. in [GH-11191](https://github.com/php/php-src/pull/11191)
- __Bob Weinand__
    - Fix [GH-11189](https://github.com/php/php-src/issues/11189): Exceeding memory limit in zend_hash_do_resize leaves the array in an invalid state in [05bd1423ee](https://github.com/php/php-src/commit/05bd1423ee)
    - Fix [GH-11222](https://github.com/php/php-src/issues/11222): foreach by-ref may jump over keys during a rehash in [975d28e278](https://github.com/php/php-src/commit/975d28e278)
- __Julien Quiaios__
    - Add new test for array_fill() to cover the case when the parameter count is too large in [GH-11184](https://github.com/php/php-src/pull/11184)
- __Cédric Anne__
    - Make SERVER_SOFTWARE compliant with RFC3875 in [GH-11093](https://github.com/php/php-src/pull/11093)
- __Calvin Buckley__
    - `http_response_code` should warn if headers were already sent in [GH-10744](https://github.com/php/php-src/pull/10744)
- __Daniel Kesselberg__
    - Add PKCS7_NOOLDMIMETYPE and OPENSSL_CMS_OLDMIMETYPE in [fa10dfcc81](https://github.com/php/php-src/commit/fa10dfcc81)
- __Jakub Zelenka 💜__
    - Add myself as a standard CODEOWNER to not miss some changes in [5690e8baea](https://github.com/php/php-src/commit/5690e8baea)
    - Fix [GH-10461](https://github.com/php/php-src/issues/10461): Postpone FPM child freeing in event loop in [102953735c](https://github.com/php/php-src/commit/102953735c)
    - Expose JSON internal function to escape string in [e8a836eb39](https://github.com/php/php-src/commit/e8a836eb39)
    - Fix bug [#64539](https://bugs.php.net/bug.php?id=64539): FPM status - query_string not properly JSON encoded in [GH-11050](https://github.com/php/php-src/pull/11050)
    - FPM: Fix memory leak for invalid primary script file handle in [GH-11088](https://github.com/php/php-src/pull/11088)
    - Fix FPM status json encoded value test in [GH-11276](https://github.com/php/php-src/pull/11276)
- __Florian Moser__
    - Fix [GH-11054](https://github.com/php/php-src/issues/11054): Reset OpenSSL errors when using a PEM public key in [GH-11055](https://github.com/php/php-src/pull/11055)
- __Gina Peter Banyard 💜__
    - Prevent unnecessary string duplication in assert() in [GH-11031](https://github.com/php/php-src/pull/11031)
    - ext/standard/array.c: use uint32_t instead of incorrect int type in [646f54b594](https://github.com/php/php-src/commit/646f54b594)
    - Fix assertion warning message when no description is provided in [e35cd34bcd](https://github.com/php/php-src/commit/e35cd34bcd)
    - Use uint32_t for variable storing `ZEND_NUM_ARGS()` in [80c8ca9c8f](https://github.com/php/php-src/commit/80c8ca9c8f)
    - FPM: refactor fpm_php_get_string_from_table() to better match usage in [GH-11051](https://github.com/php/php-src/pull/11051)
- __Máté Kocsis 💜__
    - Narrow bool return types to true when possible in [85338569de](https://github.com/php/php-src/commit/85338569de)
    - Add support for true standalone type when generating methodsynopsis in [281669aeb4](https://github.com/php/php-src/commit/281669aeb4)
    - Narrow some more return types to true in [09dd3e3daf](https://github.com/php/php-src/commit/09dd3e3daf)
- __Michael Voříšek__
    - Fix gmp_long/gmp_ulong typedef warning on Windows x86 in [GH-11112](https://github.com/php/php-src/pull/11112)
    - Allow CTE on more CTE safe functions in [GH-10771](https://github.com/php/php-src/pull/10771)
- __Amedeo Baragiola__
    - Fix compilation error on old GCC versions in [GH-11212](https://github.com/php/php-src/pull/11212)
- __Luc Vieillescazes__
    - Keep the orig_path for xport stream in [GH-11113](https://github.com/php/php-src/pull/11113)
- __Randy Geraads__
    - Added negative offset test for mb_strrpos in [c5a623ba5e](https://github.com/php/php-src/commit/c5a623ba5e)
- __Peter Kokot__
    - Fix #9483: Fix autoconf warnings due to old libtool in [GH-11207](https://github.com/php/php-src/pull/11207)
- __Alex Dowad__
    - Use shared, immutable array for return value of mb_list_encodings in [97e29bed9e](https://github.com/php/php-src/commit/97e29bed9e)
    - Take order of candidate encodings into account when guessing text encoding in [3ab10da758](https://github.com/php/php-src/commit/3ab10da758)
    - Use pakutoma's encoding check functions for mb_detect_encoding even in non-strict mode in [7914b8cefd](https://github.com/php/php-src/commit/7914b8cefd)
    - Combine CJK encoding conversion code in a single source file in [c717c79a09](https://github.com/php/php-src/commit/c717c79a09)
    - Optimize conversion of SJIS-2004 text to Unicode in [73633bf1c3](https://github.com/php/php-src/commit/73633bf1c3)
    - Optimize conversion of CP932 text to Unicode in [175154dbcc](https://github.com/php/php-src/commit/175154dbcc)
    - Move kana translation tables to `mbfilter_cjk.c` in [245daedb41](https://github.com/php/php-src/commit/245daedb41)
    - Test mb_strlen for all text encodings supported by mbstring in [f337c92050](https://github.com/php/php-src/commit/f337c92050)
    - Fix problem with CP949 conversion when 0xC9 precedes byte lower than 0xA1 in [8e6be14372](https://github.com/php/php-src/commit/8e6be14372)
    - Convert mbfilter_conv{,_r}_map_tbl to return bool in [18ca489347](https://github.com/php/php-src/commit/18ca489347)
- __Peter Chun-Sheng, Li__
    - Fix [GH-11099](https://github.com/php/php-src/issues/11099): Generating `phar.php` during cross-compile can't be done in [GH-11243](https://github.com/php/php-src/pull/11243)
- __Nikita Popov__
    - Correctly handle multiple constants in typed declaration in [c230aa9be3](https://github.com/php/php-src/commit/c230aa9be3)
- __LoongT4o__
    - Fix the JIT buffer relocation failure at the corner case in [GH-11266](https://github.com/php/php-src/pull/11266)
- __Pierrick Charron__
    - PHP-8.2 is now for PHP 8.2.8-dev in [d5f68b50fc](https://github.com/php/php-src/commit/d5f68b50fc)
- __Ben Ramsey__
    - PHP-8.1 is now for PHP 8.1.21-dev in [2f2fd06be0](https://github.com/php/php-src/commit/2f2fd06be0)
- __Mikhail Galanin__
    - `ext/session`: pass ini options to extra processes in tests in [GH-11294](https://github.com/php/php-src/pull/11294)
- __KoudelkaB__
    - Access violation when ALLOC_FALLBACK fixed in [8946b7b141](https://github.com/php/php-src/commit/8946b7b141)
- __Daniil Gentili__
    - Fix GCC 12 compilation on riscv64 in [1dfa277a96](https://github.com/php/php-src/commit/1dfa277a96)
- __Kirill Nesmeyanov__
    - Add string output escaping into zend dump (phpdbg + opcache debug) in [GH-11337](https://github.com/php/php-src/pull/11337)
- __divinity76__
    - Fix return value in stub file for DOMNodeList::item in [GH-11342](https://github.com/php/php-src/pull/11342)
- __Yuya Hamada__
    - Fix mb_strlen is wrong length for CP932 when 0x80 in [c50172e812](https://github.com/php/php-src/commit/c50172e812)
- __James Lucas__
    - Fix bug [GH-11246](https://github.com/php/php-src/issues/11246) cli/get_set_process_title in [GH-11247](https://github.com/php/php-src/pull/11247)
</details>
<br>
This concludes the list of commits made by the PHP core team in the past month. We're grateful for their hard work and dedication to improving PHP.

<br>

---

## Support PHP Foundation

At PHP Foundation, we support, promote, and advance the PHP language. We financially support six part-time PHP core developers to contribute to the PHP project. You can help support PHP Foundation at [OpenCollective](https://opencollective.com/phpfoundation) or via [GitHub Sponsors](https://github.com/sponsors/ThePHPF).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is (except for this particular one) prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more. 

