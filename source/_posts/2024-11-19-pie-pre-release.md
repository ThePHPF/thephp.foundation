---
title: 'Announcing the Pre-Release of the PHP Installer for Extensions (PIE)'
layout: post
tags:
  - news
author:
  - name: James Titcumb
    url: https://phpc.social/@asgrim
published_at: 19 November 2024
---

We're thrilled to introduce the pre-release of the PHP Installer for Extensions (PIE) – [**github.com/php/pie**](https://github.com/php/pie)!

PIE aims to simplify managing PHP extensions by providing a modern, flexible alternative to PECL and treating extensions as first-class citizens in the PHP ecosystem.

<blockquote>
PIE development is commissioned by the <a href="https://www.sovereign.tech/tech/php"><strong>Sovereign Tech Agency</strong></a>.
</blockquote>

This initial pre-release is available as a [PHAR download](https://github.com/php/pie/releases/tag/0.2.0), and we invite you to take it for a spin and share your feedback. While this release is an exciting milestone, we know there's a lot more work ahead to make PIE ready for widespread use, so your feedback is invaluable. If you encounter any issues, or have any questions, feel free to open an [issue on GitHub](https://github.com/php/pie/issues), and help us shape the future of PIE.

## Why PIE?

With PIE, the process of managing PHP extensions becomes more streamlined. Extensions are distributed via [Packagist](https://packagist.org/extensions) just like regular PHP packages! It makes the installation and update process quite familiar if you already use Composer.

We’re working to make PIE stronger and easier to use. We’re improving how PHP extensions are managed and using ideas from Composer to make the process smoother.

## Are you an extension author?

Extensions do need to be made compatible with PIE by adding a \`composer.json\` (more instructions [here](https://github.com/php/pie/blob/main/docs/extension-maintainers.md)), and submitting it to [Packagist](https://packagist.org/packages/submit). Once a package has added support for PIE, it will appear on the Packagist [Extensions list](https://packagist.org/extensions) page.

💜️🐘
