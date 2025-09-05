---
title: 'Announcing the Official PHP SDK for MCP'
layout: post
tags:
  - news
author:
  - name: Roman Pronskiy
    url: https://twitter.com/pronskiy
published_at: 05 September 2025
---

**The PHP Foundation**, **Anthropic’s MCP team, and Symfony** are collaborating on the **official PHP SDK for the Model Context Protocol (MCP)**. Our goal is a **framework-agnostic, production-ready** reference implementation the PHP ecosystem can rely on.

The Symfony team will lead maintenance, with contributions from the broader community, including [Kyrian Obikwelu](https://github.com/CodeWithKyrian) ([PHP-MCP](https://github.com/php-mcp)).

This initiative consolidates earlier work into a single, trusted implementation – [**modelcontextprotocol/php-sdk**](https://github.com/modelcontextprotocol/php-sdk) – starting with the server and expanding to client capabilities.

⭐ Star the repo, try it, open issues/PRs, and join discussions.

<!--
- [Symfony announcement](https://symfony.com/blog/symfony-to-provide-the-official-mcp-sdk)  
- [MCP blog announcement]()
-->

## **What is MCP and why is it important**

The [Model Context Protocol](https://modelcontextprotocol.io/) (MCP) is an open protocol introduced by [Anthropic](https://www.anthropic.com/) to enable AI applications to connect with and utilize external tools and data sources, akin to a standardized "USB-C port" for AI systems.

> 💡 Fun fact: MCP co-creator [**David Soria Parra**](https://x.com/dsp_) was release manager for [PHP 5.4](https://wiki.php.net/todo/php54) and [5.5](https://wiki.php.net/todo/php55), and a long-time PHP core contributor. His PHP code still runs inside [every Symfony and Laravel project](https://github.com/symfony/http-foundation/blob/6.1/IpUtils.php#L105) today. Cheers, David! 💜

To make it easier to build MCP servers, the community provides SDKs – lightweight frameworks that handle the protocol details so developers can focus on their applications.

There were several official SDKs for different programming languages. However, there was no official PHP SDK, even though a few community implementations existed.

That’s why **the PHP Foundation stepped up to coordinate** the development and maintenance of the official PHP SDK for MCP.

This brings two important benefits:

* A **trusted reference implementation** developers can rely on.
* Visibility of **PHP’s readiness for AI development** outside its own ecosystem.

## **What’s happening**

**The PHP Foundation** has partnered with the MCP team at **Anthropic** and the **Symfony** team to develop the **official MCP SDK for PHP.**

The Symfony team will be lead maintainers of the SDK as they have a proven track record of building high-quality framework-agnostic components that much of the PHP ecosystem relies on.

Additionally, [Kyrian Obikwelu](https://github.com/CodeWithKyrian) joined the maintainer team and brings his previous experience and work on MCP libraries. Other PHP MCP SDK authors are welcome to participate as well.

**Roadmap (high level):**

1. Server-side building blocks (initial release)
2. Client capabilities and additional transports as the spec evolves
3. Docs, examples, and stability hardening driven by real-world use

We’ll keep this implementation framework-agnostic so it works well in any platform, legacy apps, and custom stacks. Community adapters and examples will live alongside the core packages.

## **Get involved**

**Try it:** install the SDK, scaffold a small MCP server, and expose one or two safe tools.

**Contribute:** issues, docs, and PRs are very welcome – especially around testing, and real-world examples.

**Bring your framework:** we’re keen on first‑class integrations for Laravel, WordPress, Drupal, Laminas, and more. We keep a list of integrations in the repo as well.

**Start here:**

* SDK repo: [**modelcontextprotocol/php-sdk**](https://github.com/modelcontextprotocol/php-sdk)
* Composer package: [**https://packagist.org/packages/mcp/sdk**](https://packagist.org/packages/mcp/sdk)
* MCP spec & ecosystem: [**https://modelcontextprotocol.io/**](https://modelcontextprotocol.io/specification/2025-06-18)

> [**Join the Symfony AI Hackathon**](https://symfony.com/blog/let-s-build-the-symfony-ai-ecosystem-together)  
> The in-person event will be [hosted at Quentic in Berlin](https://maps.app.goo.gl/ML4e5SqtcwGRYJH8A), and requires a [free registration via Eventbrite](https://www.eventbrite.com/e/symfony-ai-hackathon-tickets-1591414586869) upfront. For online participation, please make sure to join our [Slack Workspace](https://symfony.com/slack) and the \#ai channel to follow along and raise your topics or questions.

This SDK helps ensure PHP is visible as a great language choice to a wider audience when working in the AI ecosystem.
Let’s build it together!  
💜🐘
