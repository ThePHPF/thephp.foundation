---
title: "PIE 1.5 Released"
description: "This is the release announcement for PIE 1.5"
layout: post
tags:
    - news
    - pie
author:
  - james-titcumb
published_at: 07 October 2026
---

The PIE team is pleased to announce the release of the PHP Installer for Extensions 1.5 series, which has been in the works for around five months. There has been significant work gone into some internal improvements which has enabled us to deliver several long-awaited features for the tool. Lets dive into a few of these new features!

#### Install multiple extensions
You are now able to install multiple extensions at once, for example:

```bash
$ pie install php-amqp/php-amqp:^2.2 girgias/csv
```

This is helpful for setting up Docker images. Configure options may still be passed, and they will be automatically filtered off into the appropriate extension's `./configure` options.

#### Introduce package selections with `--select=...` for unattended installs
When you're running `pie install` within a PHP project, in previous versions of PIE you could use `--allow-non-interactive-project-install` to automatically select packages for missing extensions. However, this approach was risky, as there are no guarantees which package a missing extension would actually resolve to. To eliminate this risk, you must now make explicit package selections in a non-interactive / unattended install:

```bash
$ pie install \  
  --select=example_pie_extension=asgrim/example-pie-extension \  
  --select=redis=phpredis/phpredis
```

This allows you to make conscious and explicit decisions about which package to use for any missing extensions.

#### Upgrade all your PIE extensions
```bash
$ pie upgrade
```

That's all it takes now to automatically upgrade all your PIE extensions, within the limits of the constraints you originally installed each extension with. For example:

- you install `foo/bar:^1.1` using PIE and the latest version, 1.1.5, gets installed
- the `foo/bar` extension later releases a new version 1.2.0
- you run `pie upgrade`, and `foo/bar` gets upgraded to 1.2.0, since that is within the original `^1.1` constraint.
- subsequently, an all new `foo/bar` 2.0.0 is released
- when you run `pie upgrade`, `foo/bar` will *not* be upgraded, as 2.0.0 is not within the `^1.1` constraint.

#### A huge update to the Attestation library
For some time, PIE has used Sigstore framework to verify authenticity of PIE itself. The primary mechanism for this has been to invoke the `gh` CLI tooling, if available, and if not fall back to a basic foundational implementation of the Sigstore verification. After much work, we were able to implement the majority of the Sigstore conformance test suite, reaching 131 passed tests, 5 skipped (as the library is verification-only), and 4 expected failures. This was a huge undertaking, and we believe is the most comprehensive PHP implementation of the Sigstore verification suite. PIE can now take advantage of this more extensive verification when carrying out updates. Additionally, the library is no longer strictly coupled to GitHub's attestations and trusted root certificate, although both are included out of the box for convenience. This open source library is available for all under the BSD-3-Clause license, on [github.com/ThePHPF/attestation](https://github.com/ThePHPF/attestation).

#### A summary of other new features...
 - The `--no-dev` option for `pie install` in a PHP project to skip dev extensions
 - You can `--suppress-download-url-method` to eliminate certain download URL methods, even if the extension supports it.
 - A new `pie search ...` command to help locate packages providing extensions.
 - You can optimistically check the prerequisite build tools are installed with `pie check-build-tools`
 - Support some placeholders for some PECL extensions that relied on this feature

As always, PIE development is ongoing, and The PHP Foundation team working on PIE is striving to make PHP extension management as easy as PIE. If you have ideas or suggestions, please join us on the [GitHub Discussions](https://github.com/php/pie/discussions) to chat about your ideas. If you discover a bug, please do report it on our [GitHub Issues tracker](https://github.com/php/pie/issues).
