---
title: "Maintaining PHP Build infrastructure for Windows: Tooling for builds and security updates"
layout: post
tags:
    - windows
    - security
author:
  name: Shivam Mathur
  url: https://github.com/shivammathur
published_at: 26 June 2026
---

Most PHP developers never think about how PHP is built. They download it or install it using a command or a pre-built image and get started with their work. That is exactly how it should feel. A build system is doing its job when the final result looks great and works as expected.

Behind every official PHP for Windows release is a lot of infrastructure: compilers, SDKs, dependency libraries, extension compatibility, CI pipelines, and security updates that keep the supported PHP versions working.

As part of my work for The PHP Foundation, the focus has been on the Windows side of PHP: maintaining and improving the build infrastructure, updating dependencies, supporting extension builds, and making the process more reliable for current and future PHP releases.

This post is a look at that work, why it matters, and what goes into keeping PHP healthy on Windows.

## Why Windows support still matters

PHP is widely used on Linux, as the most common use case is running web applications, but Windows support remains important for several reasons.

Many developers use Windows as their local development environment, and many companies run PHP applications on Windows servers. A lot of users depend on it for local testing environments, CLI tooling, and extensions that must work reliably on Windows. As per the [Stack Overflow annual developer survey in 2025](https://survey.stackoverflow.co/2025/technology#1-computer-operating-systems) close to 50% of respondents use Windows for development.

Official PHP builds for Windows matter because they provide a trusted baseline and are part of the PHP project’s release process.

That means Windows support is not only about producing the final PHP build. It is about maintaining the full chain that makes a reliable PHP runtime possible.

## The build system is now a toolchain

Building PHP on Windows is very different from building PHP on Unix-like systems.

On Linux and macOS, building PHP usually depends on package managers for dependencies and easy-to-use popular build toolchains. On Windows, PHP uses a separate build system built around MSVC, Windows SDK that handles various MSVC versions, custom build scripts, and custom prebuilt dependencies with patches specific to PHP.

A PHP Windows build needs to know:

- Which Visual Studio toolset to use
- Which Windows SDK to target
- Which dependency packages are available
- Which library versions are compatible with each PHP branch
- Whether a build is x64, x86, thread-safe, non-thread-safe, debug, or release

A major part of my work has been consolidating this into a modern toolchain: [php/php-windows-builder](https://github.com/php/php-windows-builder).

### PHP extension builds for Windows

We started with the purpose of making it easier to build PHP extensions on Windows. The goal was giving extension authors a path to produce builds that are compatible with the newer [PIE](https://github.com/php/pie) direction. But because this new way of distribution for PHP’s extensions using PIE is still evolving, we also revived Windows builds for extension releases on PECL. As part of that, we have released builds for more than 100 actively maintained extensions.

That matters because Windows extension builds have historically been challenging for maintainers. Extension authors often do not have the full Windows build environment locally, and many contributors are more familiar with Linux-based workflows. A builder with a unified interface with known inputs gives the ecosystem a common place to test, debug, and improve Windows builds.

```yaml
- name: Build the extension
  uses: php/php-windows-builder/extension@v1
  with:
    extension-url: https://github.com/xdebug/xdebug
    extension-ref: '3.5.3'
    php-version: '8.5'
    ts: nts
    arch: x64
    args: --with-xdebug
    libs: zlib
```

This is not only about convenience. It changes what is possible. For most extensions, building for Windows is as easy as copying one of the [example workflows](https://github.com/php/php-windows-builder/tree/master/examples) we have.

### Automating Windows release builds

In addition to improving support for building PHP extensions, we also improved how the PHP runtime is built and maintained on Windows. We now have automated workflows in [php/php-windows-builder](https://github.com/php/php-windows-builder) that build PHP on new tags in [php/php-src](https://github.com/php/php-src), run tests, deploy them to the [downloads server](https://www.php.net/downloads.php?os=windows), and make them available on the PHP website. This is a huge improvement on what used to be a manual process with delays, where the builds were run manually by one person in the Windows team and tested after publishing.

![Automated PHP for Windows release flow](/assets/post-images/2026/windows-build-infrastructure/php-windows-release-flow.svg)

### Dependency updates and testing

As part of the PHP build infrastructure improvements, we also created a test bench workflow. It allows us to build PHP with unpublished builds of PHP dependencies directly from GitHub workflow artifacts rather than fetching them from the PHP servers. That allows us to test dependency updates.

Before this test-bench infrastructure existed, some dependency updates were delayed or avoided because testing them properly on Windows was too slow, too manual, or too challenging. With a dedicated builder and test bench, dependency updates can be tested more quickly across PHP branches and configurations. That helps us move faster on both compatibility and security work.

PHP 8.0 through PHP 8.3 use the Visual Studio 2019 toolset, while newer versions such as PHP 8.4 and PHP 8.5 use the Visual Studio 2022 toolset. PHP 8.6 will use the Visual Studio 2026 toolset. These transitions sound simple, but in practice they affect compiler flags, dependency builds, extension compatibility, CI base images, and long-term support decisions.

Keeping this working means constantly testing combinations of PHP branches, Visual Studio versions, and dependency packages. [php/php-windows-builder](https://github.com/php/php-windows-builder) gives us a structured way to do that instead of relying on one-off manual builds.

## Security work: CVEs, dependency updates, and backported fixes

A big part of maintaining PHP for Windows is security work.

That often means updating the dependency libraries that PHP and its extensions rely on when they receive CVE fixes or when new features demand it. These include libraries such as libcurl, OpenSSL, ICU, SQLite, libxml2, libjpeg, and more than 40 others.

When one of these libraries fixes a vulnerability, the Windows dependency stack has to be reviewed, rebuilt, and tested. The work is not as simple as bumping a version number.

A new dependency release can change ABI behavior, remove APIs, require another dependency to be rebuilt, expose new compiler warnings, or break an extension that used to compile cleanly.

For example, updating OpenSSL requires rebuilding curl and other libraries that depend on it. Updating ICU can introduce MSVC warnings or header-level changes that affect the `intl` extension. Updating Apache has to be evaluated carefully because PHP’s Apache module needs to remain compatible with the wider Windows ecosystem, including users running third-party installers [lacking maintainers](https://mariadb.org/xampp-needs-more-apache-friends/), but still have a large user-base.

There is also backporting work. Sometimes the safest path for a supported PHP branch is not to move an entire dependency stack forward, but to apply or adapt targeted security patches. That means reviewing upstream fixes, checking whether they apply cleanly to the version used by PHP for Windows, rebuilding the affected library, and validating that the patched build remains compatible with PHP and its extensions.

This balance matters. We want users to receive security fixes quickly, but we also need to avoid introducing regressions into supported PHP releases. Security maintenance on Windows is therefore a careful process of tracking CVEs, reviewing upstream changes, rebuilding dependencies, backporting fixes where appropriate, and validating the result through PHP’s test suites and real extension builds.

This is one of the less visible parts of the work, but also one of the most important. A secure PHP runtime depends not only on PHP source code but also on the native libraries that are shipped with it.

![Known CVEs detected in PHP 8.5 Windows builds](/assets/post-images/2026/windows-build-infrastructure/php-85-cve-bin-tool-findings.svg)

As part of this process, we updated these dependencies addressing a number of security issues reported for them over the last year.

| Dependency        | Old version | Updated version | Security issues resolved                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       |
|-------------------|-------------|-----------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Apache            | 2.4.43      | 2.4.68          | CVE-2026-49975, CVE-2026-48913, CVE-2026-44631, CVE-2026-44186, CVE-2026-44185, CVE-2026-44119, CVE-2026-43951, CVE-2026-42536, CVE-2026-42535, CVE-2026-34356, CVE-2026-34355, CVE-2026-29170, CVE-2026-29167, CVE-2026-23918, CVE-2026-24072, CVE-2026-28780, CVE-2026-29168, CVE-2026-29169, CVE-2026-33006, CVE-2026-33007, CVE-2026-33523, CVE-2026-33857, CVE-2026-34032, CVE-2026-34059, CVE-2025-49630, CVE-2025-55753, CVE-2025-58098, CVE-2025-59775, CVE-2025-65082, CVE-2025-66200, CVE-2025-54090, CVE-2024-42516, CVE-2024-43204, CVE-2024-43394, CVE-2024-47252, CVE-2025-23048, CVE-2025-49812 |
| Firebird client   | 3.0.6       | 3.0.14          | CVE-2025-54989                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| FreeType          | 2.11.1      | 2.14.3          | CVE-2022-27404, CVE-2022-27405, CVE-2022-27406, CVE-2025-27363                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| libavif           | 0.9.0       | 1.4.2           | CVE-2025-48174, CVE-2025-48175, CVE-2023-6350, CVE-2023-6351, CVE-2023-6704                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
| libcurl           | 8.17.0      | 8.20.0          | CVE-2025-15224, CVE-2025-15079, CVE-2025-14819, CVE-2026-1965, CVE-2026-3783, CVE-2026-3784, CVE-2026-3805, CVE-2026-4873, CVE-2026-5545, CVE-2026-5773, CVE-2026-6253, CVE-2026-6276, CVE-2026-6429, CVE-2026-7009, CVE-2026-7168                                                                                                                                                                                                                                                                                                                                                                             |
| liblzma / XZ      | 5.8.2       | 5.8.3           | CVE-2026-34743                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| libpng            | 1.6.34      | 1.6.56          | CVE-2026-33416, CVE-2026-33636                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| PostgreSQL client | 14.18/16.9  | 14.22/16.13     | CVE-2025-8713, CVE-2025-8714, CVE-2025-8715, CVE-2025-12817, CVE-2025-12818, CVE-2026-2003, CVE-2026-2004, CVE-2026-2005, CVE-2026-2006                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| Cyrus SASL        | 2.1.27      | 2.1.28          | CVE-2022-24407                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| libsodium         | 1.0.18      | 1.0.22          | CVE-2025-69277                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| libssh2           | 1.11.1      | 1.11.1          | Patch for CVE-2026-7598 was backported                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| libxml2           | 2.10.4      | 2.10.4          | Patches for the following CVEs were backported - CVE-2026-0989, CVE-2026-0990, CVE-2026-0992, CVE-2026-1757, CVE-2025-7425                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| libxslt           | 1.1.37      | 1.1.43          | CVE-2024-55549, CVE-2025-24855, CVE-2025-11731, CVE-2025-7424, CVE-2025-10911                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
| nghttp2           | 1.64.0      | 1.69.0          | CVE-2026-27135                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| OpenSSL           | 3.0.18      | 3.0.21/3.5.7    | CVE-2026-45447, CVE-2026-34182, CVE-2026-34183, CVE-2026-42764, CVE-2026-45445, CVE-2026-7383, CVE-2026-9076, CVE-2026-34180, CVE-2026-34181, CVE-2026-42766, CVE-2026-42767, CVE-2026-42768, CVE-2026-42769, CVE-2026-42770, CVE-2026-45446, CVE-2026-31790, CVE-2026-28387, CVE-2026-28388, CVE-2026-35188, CVE-2026-42765, CVE-2026-42771, CVE-2026-28386, CVE-2026-28389, CVE-2026-28390, CVE-2026-31789                                                                                                                                                                                                   |
| SQLite            | 3.39.2      | 3.53.2          | CVE-2025-7709, CVE-2025-70873, CVE-2025-7458.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
| zlib              | 1.2.12      | 1.3.2           | CVE-2022-37434                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |

We also refreshed these dependencies to newer releases for bug fixes and new features.

| Dependency    | Old version | Updated version |
|:--------------|:------------|:----------------|
| GLib          | 2.53.3      | 2.88.1          |
| libwebp       | 1.3.2       | 1.6.0           |
| libjpeg-turbo | 2.1.0       | 3.1.4           |
| LMDB          | 0.9.22      | 0.9.35          |
| libiconv      | 1.17        | 1.19            |
| libintl       | 0.18.3      | 1.0             |
| libffi        | 3.3-4       | 3.5.2           |
| Oniguruma     | 6.9.8       | 6.9.10          |
| libenchant2   | 2.2.8       | 2.8.16          |
| OpenLDAP      | 2.4.47      | 2.6.13          |

## CI has become essential

Modern PHP Windows work depends heavily on CI.

It is not enough to build PHP once locally and release it. We need repeatable testing across branches, architectures, dependency versions, and runtime combinations.

As part of [php/php-windows-builder](https://github.com/php/php-windows-builder), we now have a GitHub Actions-based approach to building PHP and its extensions; this is an improvement from the early days of building these on the Windows machine provided by Microsoft.

## Preparing for the future

Windows support also has to look ahead.

One major area is architecture support. Historically, PHP for Windows has shipped x86 and x64 builds. But the value of x86 support continues to decrease as modern Windows systems are overwhelmingly 64-bit, while interest in ARM64 is growing.

That creates an important long-term question: what should the official PHP Windows build matrix look like in the future?

Dropping x86 and investing in ARM64 may make more sense for future versions. But that kind of decision cannot be made casually. It requires understanding who still depends on x86, what compatibility is actually being preserved, and what new users would benefit from ARM64 builds.

Part of the job is to make these transitions possible before they become urgent.

## In closing

Open source maintenance is invisible by design. If everything goes well, users do not notice that a dependency was rebuilt, a compiler issue was fixed, an extension was patched, or a CI workflow was improved. They just download PHP and continue working.

That is the goal.

But it is also why it is worth talking about this work occasionally. The reliability of a project like PHP depends on many layers of maintenance that happen outside the spotlight.

The Windows side of PHP has its own set of challenges, and continuing to invest in it helps keep PHP accessible to more developers, more environments, and more use cases.
