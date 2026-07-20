---
title: "Quarterly Progress Report - Q2 2026"
description: "A report of Foundation contractor activities in Q2 of 2026."
layout: post
tags:
    - team
    - updates
author:
  - elizabeth-barron
published_at: 21 July 2026
---
Our [team of core developers](https://thephp.foundation/structure/#Core%20Developers) works very hard to strengthen and improve the PHP language. In an effort to improve the way we communicate this work, from now on, we will be posting quarterly updates regarding their individual projects and efforts.

Our core team consists of 13 people, distributed across 8 countries. Most of our contractors work part-time for The PHP Foundation and have other ventures aside from working on the PHP core. Also, this report is not meant to be a comprehensive list of everything our contractors shipped, but a high-level summary of their most impactful work.

In addition to our regular efforts around sustaining PHP through routine tasks like code reviews, bug fixes, issue triage and other maintenance work that we expect from all our developers, we want to highlight these particular efforts:

### Arnaud Le Blanc

Arnaud worked out a general solution to two long-standing sources of engine bugs tied to error handlers and destructors, in collaboration with Ilija Tovilo (one of Arnaud's fixes builds on an earlier attempt made by him). The forthcoming RFC will add a fix for a related third bug source, all targeting a version after PHP 8.6. On the STF project, he's stepped back from I/O hooks and shifted with Jakub Zelenka to [a dependency of hooks](https://github.com/php/php-src/pull/22538), also targeting a version after PHP 8.6.

### David Carlier

David shipped [`AF_PACKET` raw buffer support](https://github.com/php/php-src/pull/21631) in PHP's sockets extension, so PHP can now work with low-level Linux packet sockets directly instead of shelling out or resorting to FFI. This PR closes a real gap with C, Python, Go, and Rust, and opens up native packet capture and injection for PHP. It's also safe by design, since like every other language it needs a privileged account (`CAP_NET_RAW/root`) to use, so it doesn't widen the attack surface for ordinary code.

### Derick Rethans

Derick spent many hours investigating, trialing, and planning, and was able to complete a migration of the whole php.net infrastructure to a new CDN provider (more details on this are coming in a separate announcement).

### Gina Banyard

Gina worked on `ext/phar` to cut unnecessary string allocations and improve its clarity, and investigated unifying PHP's type-checking code to remove redundant return-type checks (tied to her interface-only generic types proposal), both of which reduce duplication and improve performance and maintainability. She also explored replacing the `get_constructor()` object handler with an attribute, which would make constructors more predictable and could eventually let `new MyClass(...)` be used as a callable. This is a small but long-requested ergonomics win. In parallel, she's been preparing the mass deprecation RFC for PHP 8.6, investigating how often objects get treated as arrays, and keeping up with PR reviews and older bug fixes to prevent technical debt from piling up ahead of the next release. On top of the engineering work, she represented the project publicly: preparing and giving a talk at UNSOUND (her first academic conference), along with other conference talks and an opinion blog post, helping raise the project's visibility outside its usual community.

### Ilija Tovilo

Ilija focused on ongoing security and regular issue handling and triage, work that keeps critical bugs from piling up and gets exploitable issues fixed before they reach users. He also continued work on the STF stream project, a core I/O abstraction where improvements pay off across many parts of the engine at once. In addition, he experimented with an 8-byte `zval` representation, which is a potentially high-leverage change, since `zval` is the fundamental value representation used throughout the engine, meaning a smaller size could meaningfully cut memory footprint and improve performance broadly. This is in the very early stages of experimentation. Finally, he drove improvements to `gcovr` accuracy from roughly 54% to 71%, giving the team a far more trustworthy picture of what's actually tested and better ability to catch under-tested code early.

### Jakub Zelenka

Jakub delivered several major new PHP core APIs, including a new stream errors API, an internal and userspace polling API (Io\Poll), and significant OpenSSL/TLS enhancements such as configurable session resumption, PSK support, and crypto status exposure. He also patched a security vulnerability in the FPM status endpoint and fixed a number of memory leaks and long-standing stream bugs. Together these changes strengthened PHP's streams, I/O, and TLS capabilities.

### James Titcumb

For the last few months, the PIE team has been hard at work on new features for the upcoming 1.5 release with several new key features. There's been a lot of background work to align the PIE interactions with Composer, which has allowed them to build several new requested features, including being able to install multiple extensions at once, adding a `--select` flag for unattended PIE installs for PHP projects, making re-installing an already installed extension a no-op, and being able to install locked extensions for a target PHP install with a new `pie install --from-lock` flag. Additionally, they have added support for some of the old PECL placeholder replacements, updated PIE to use the providers API, and kept up with maintenance of the 1.4.x series, bug-fixes, and security fixes for GitHub Security Advisories reported by the community.

### Joe Watkins

Joe's work has centered on experimenting with ideas that improve the PHP language and experience for contributors. His latest experiment was creating a multi-engine parser that would feed into a larger framework for mapping and connecting the PHP core code across repos, documentation, and eventually issues, PR comments, and other pieces of contextual information, which would help new contributors understand the context, evolution, and functionality of the PHP core codebase. This project was recently put on hold in lieu of other priorities, but is available on [GitHub](https://github.com/krakjoe/phathom).

### Máté Kocsis

Thanks to Máté's work, the ['Followup improvements for ext/uri' RFC](https://wiki.php.net/rfc/uri_followup) was accepted, and most of the work is already implemented. Once all changes land, it will become possible to build URIs and URLs via the new Builder classes, and some other, more advanced use cases will be better supported. Additionally, there is another RFC that has a fairly complete proposed implementation, which could revolutionize how query parameters are handled in PHP: [https://wiki.php.net/rfc/query_params](https://wiki.php.net/rfc/query_params). Voting is not yet open for this RFC but it should be open in the next quarter. Finally, Máté was also experimenting with UUIDs (UUID v7 more specifically) and created a proof-of-concept implementation for a new extension. Work on this will continue after the pending URI proposals are wrapped up.

### Saki Takamachi

Saki was responsible for various bug fixes and code reviews and is currently out for family leave.

### Shivam Mathur

Shivam added support for the new Visual Studio 2026 (VS18) toolchain across PHP's Windows build infrastructure and dependency stack, laying the groundwork the ecosystem needs ahead of PHP 8.6. He strengthened the security and stability of official Windows builds by updating and testing critical dependencies (OpenSSL, curl, SQLite, Apache, ICU, and libssh2), effectively closing off known vulnerabilities that could otherwise affect every Windows install. Shivam also resolved Windows-specific PGO and ZTS crashes, directly improving reliability for Windows users on currently supported versions. And lastly, he also maintained and improved php-windows-builder, keeping Windows binaries flowing for new PECL extension releases and keeping the platform from falling behind Linux/macOS in build support.

### Volker Dusch

Volker founded the [PHP Ecosystem Security Team](https://thephp.foundation/blog/2026/05/18/announcing-ecosystem-security-team/), a new effort to help PHP project maintainers find, fix, and handle security vulnerabilities. This is important because many maintainers, especially of smaller projects, lack the time or expertise to catch these issues themselves, leaving gaps that affect the wider ecosystem. Toward that end, he scanned over 500 of the most-used Composer packages and nearly every major framework, sharing 100+ fixes directly with maintainers, which translates into concrete, shipped security improvements across a large swath of the PHP ecosystem rather than just one project. He also worked alongside maintainers to help grow the team and support projects through specific security incidents (projects with a security need are encouraged to reach out).

### Alexandre Daubois

Our 13th contractor, Alexandre Daubois, is brand new to the team, so we won't have updates to share until the next quarterly report.

---

We are happy to share these updates with you, and if you have any questions about what our developers are working on, you can connect with us in The PHP Foundation Discord channel on the [PHPC server](https://phpc.chat/).