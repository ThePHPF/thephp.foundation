---
title: 'FrankenPHP Is Now Officially Supported by&nbsp;The&nbsp;PHP&nbsp;Foundation'
layout: post
tags:
  - news
author:
  - name: Roman Pronskiy
    url: https://twitter.com/pronskiy
published_at: 15 May 2025
---

FrankenPHP, a modern high-performance PHP application server created by [Kévin Dunglas](https://dunglas.dev) and sponsored by [Les-Tilleuls.coop](http://Les-Tilleuls.coop), is now officially supported by the PHP Foundation. FrankenPHP integrates PHP directly into Go and Caddy, simplifying deployment, improving performance, and reducing costs. It powers real-time features, supports advanced hosting scenarios, and offers a performance-boosting “worker mode” already integrated by Laravel, Symfony, and Yii. The PHP Foundation will actively contribute to FrankenPHP’s development and host its code on the official PHP GitHub, marking a major step toward modernizing the PHP ecosystem while keeping governance with the original maintainers.

![FrankenPHP-PHP-Foundation](/assets/post-images/2025/2025-05-15-frankenphp.png)

PHP is a programming language used by around 70% of websites and applications, and by key software and frameworks such as [WordPress](https://wordpress.org), [Laravel](https://laravel.com), and [Symfony](https://symfony.com).

FrankenPHP offers a host of new features that allow to:

* simplify the development of applications written in PHP;
* drastically improve performance, while considerably reducing hosting costs (FinOps) and energy consumption (GreenOps);
* facilitate deployment in production, whether on bare-metal servers or in cloud-native environments;
* easily develop real-time features thanks to native [Mercure](https://mercure.rocks) protocol support;
* extend PHP apps with Go, C, and C++ programming languages;
* support the PHP programming language in any application written in Go (server, proxy, in-house development...).

Specifically, FrankenPHP integrates the official PHP interpreter as a module for Go and [Caddy](https://caddyserver.com), the popular next-generation web server that supports the latest web platform innovations in terms of performance, security, and DevOps: HTTP/3, compression with Zstandard, 103 Early Hints, automatic generation and renewal of HTTPS certificates, Encrypted Client Hello, structured logs, OpenMetrics/Prometheus metrics… Caddy is also co-maintained by Kévin and sponsored by Les-Tilleuls.coop.

Thanks to its innovative architecture, FrankenPHP lets you install a complete PHP environment (interpreter, web server, extensions, etc.) optimized for performance and security, by downloading a standalone statically compiled executable or a Docker image.

FrankenPHP also offers a performance-optimized mode called “worker mode”, which takes advantage of the capabilities of the Go programming language. When this optional mode is used, the PHP application will be able to retain in memory those elements that can be reused to process other HTTP requests instead of being completely reset to process each incoming HTTP request (“share nothing” model). Worker mode is especially useful for frameworks such as Symfony and Laravel that can prevent rebuilding their kernels and services again and again for nothing.

Using this mode requires minimal adaptations to the code of modern PHP applications in line with good programming practice. The Laravel, Symfony and Yii frameworks already offer official integrations of FrankenPHP's worker mode, enabling worker mode to be activated without modifying the application code.

According to [an analysis carried out this summer by Sylius](https://sylius.com/blog/ecosystem/month-of-sylius-august-2024/#frankenphp), the publisher of the eponymous e-commerce platform, the use of FrankenPHP's worker mode reduces the software's response times by 80%, while reducing by more than 6 the number of machines required to serve the same number of users.

FrankenPHP is now a reliable, mature solution used in production for an ever-increasing number of projects. The project now has [almost 8,000 stars on GitHub](https://github.com/dunglas/frankenphp), has passed the symbolic 100-contributor mark, and is officially supported by numerous hosting providers, including Upsun, Laravel Cloud, and Clever Cloud.

To get to this point, it was necessary to initiate close collaboration between the development teams of FrankenPHP, the PHP interpreter itself, the Caddy web server, and even the Go programming language.

Today, we're proud to announce that, with the aim of intensifying this collaboration, enabling the project to gain momentum, and modernizing the entire PHP ecosystem, **the FrankenPHP project is now officially supported by the PHP Foundation**.

In concrete terms, FrankenPHP's source code will be transferred to the PHP project's GitHub organization, and the PHP Foundation team will contribute to the maintenance and development of FrankenPHP to ensure its reliability, durability, and compatibility with the latest language innovations.

Part of the FrankenPHP documentation will also be transferred to the PHP website.

The governance of the project remains unchanged, and the current team of maintainers (Kévin Dunglas, Robert Landers, Alexander Stecher) will continue to be in charge of releases, as well as code reviews. They will be actively collaborating with the PHP Foundation team in charge of the language development.

In addition to the support provided by the foundation, Les-Tilleuls.coop will continue to sponsor FrankenPHP (as well as PHP and Caddy) by providing developers and contributing financially.

FrankenPHP is already [promoted by Caddy](https://caddyserver.com/#:~:text=4x%20faster%20PHP%20apps) as the official, modern solution for using PHP with this server.  
In the future, to simplify the PHP development experience (one-line installation of a complete development environment) and to promote a solution that, for projects requiring it, considerably improves the performance and efficiency of PHP applications, FrankenPHP may be highlighted on the PHP website as one of the ways to use the language (other SAPIs such as PHP-FPM will continue to be fully supported solutions).

To find out more about FrankenPHP and the many new possibilities it offers, take a look at [its documentation](https://frankenphp.dev). To meet the software's authors and find out how it is used in production, don't miss [the API Platform conference](https://api-platform.com/con/) (by the same authors as FrankenPHP) taking place on September 18 and 19 in France (Lille).

Also, join us online for [**PHPverse on June 17**](https://lp.jetbrains.com/phpverse-2025/) — a special event celebrating PHP’s 30th anniversary.

Finally, to help keep the PHP ecosystem innovating, [support the foundation](https://thephp.foundation/sponsor/)\!

[The PHP Foundation](https://thephp.foundation/)  
[Les-Tilleuls.coop](http://Les-Tilleuls.coop)  
[The Caddy team](https://caddyserver.com)  
