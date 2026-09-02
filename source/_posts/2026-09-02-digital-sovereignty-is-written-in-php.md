---
title: Digital Sovereignty Is Written in PHP
description: "Across Europe, public administrations have already decided what their digital infrastructure runs on, and it is PHP"
layout: post
tags:
  - stories
author:
  - sebastian-bergmann
published_at: 2 September 2026
---

Germany is spending €108 million to move its federal websites onto a PHP application.

The money is the budget for the eleventh version of the Government Site Builder, the German federal administration's standard content management solution: [€26.88 million for product development and support, €73.2 million for migration and relaunch, €8 million for operations](https://www.plan2.net/blog-news/blogbeitrag/deutschland-investiert-108-millionen-euro-in-typo3), phased over four years. [More than 80 federal agencies and institutions already use it, and they have built well over 250 websites with it](https://www.itzbund.de/DE/itloesungen/standardloesungen/gsb/gsb.html).

In 2025, The PHP Foundation received [$730,534 in total contributions](https://thephp.foundation/blog/2026/05/27/impact-and-transparency-report-2025/).

I am not going to argue from those two numbers that PHP deserves better treatment. What I want to describe is something that has gone largely unnoticed, including by those of us who work on PHP: across Europe, public administrations have already decided what their digital infrastructure runs on. They decided it in procurement documents, framework agreements, and coalition agreements. And when those documents say "digital sovereignty", what they describe, over and over, is a PHP application.

## Where citizens actually reach their governments

The European Commission is the largest case: At the Drupal4Gov EU conference in Brussels in January 2026, the team behind the Europa Web Publishing Platform described what they operate: [770 live sites for 44 different Commission services, 700 million visits and 2.2 billion page views per year](https://drunomics.com/en/blog/drupal4gov-eu-2026-how-drupal-powers-european-governments-247). The move to a shared Drupal platform began in 2019, because letting each Directorate-General maintain its own customised codebase had made security patching and consistent user experience progressively harder. The reusable parts are public, in the [OpenEuropa](https://github.com/openeuropa) and [ec-europa](https://github.com/ec-europa) organisations on GitHub.

The European Union Aviation Safety Agency runs its [Sustainability Portal](https://www.easa.europa.eu/en/domains/environment/sustainability-portal) on Drupal: a regulatory compliance platform serving over 350 airlines and 31 national authorities for the ReFuelEU Aviation regulation. Analytics run on Matomo, email on Mautic. Three PHP applications carry an aviation compliance regime.

In the Netherlands, DICTU's [GovNL CMS](https://www.drupal.org/project/govnl_cms_project) brings government website deployment down from three months to ten minutes using design tokens, Drupal Recipes, and automated infrastructure. In France, the Drupal base theme for the state design system is [monitored by the Service d'Information du Gouvernement and DINUM](https://www.drupal.org/project/dsfr), so the French state supervises PHP code as part of its own design authority. In the United Kingdom and Ireland, [LocalGov Drupal](https://localgovdrupal.org) has over 58 councils sharing a common codebase and pooling development budgets, with reported savings of 50 to 80 percent against building a council website from scratch. In Australia, [GovCMS](https://www.govcms.gov.au/why-govcms) hosts more than 370 websites for 115 government agencies, has been running for over a decade, and holds an OFFICIAL:Sensitive security classification.

Not one of these is a pilot project. Each of them carries the everyday traffic between a government and the people it serves.

## Germany's shortlist only had PHP entries

The German case is worth looking at closely, because the decision is documented rather than inferred.

The [Government Site Builder (GSB)](https://produkt.gsb.bund.de/gsb11) became, in version 11, a measure under the federal Ministry of the Interior's service consolidation programme. It is [built entirely from open-source components and published on the OpenCoDE platform](https://de.wikipedia.org/wiki/Government_Site_Builder), and it is [based on TYPO3](https://typo3.com/solutions/industries/public-sector/government-site-builder). The evaluation that led there had narrowed the field to [Drupal and TYPO3](https://www.cms-garden.org/de/magazin/der-neue-government-site-builder-powered-by-typo3): the shortlist for the German federal government's standard content management system consisted exclusively of PHP applications. The work was then split. [A consortium led by CPS, with 3pc, brandung, DFAU, in2code, THE BRETTINGHAMS and queo, develops GSB 11 itself](https://www.cps-it.de/aktuelles/open-source-fuer-den-bund) over four years. In March 2025, [a consortium of 17 TYPO3 agencies led by the Materna Group won the migration lot](https://www.pagemachine.de/typo3-cms/government-site-builder-mit-typo3) and will move hundreds of federal websites across.

The most telling detail is not German at all: When Swiss parliamentarians criticised their own federal administration for procuring a closed-source CMS, they held up the German decision as the model to follow: ["Deutschland machts vor"](https://parldigi.ch/de/parldigi-direkt-open-source-in-der-verwaltung-deutschland-machts-vor/), Germany is showing how it's done. A national decision to standardise on a PHP application is now cited in a foreign parliament as best practice.

## The sovereign workplace is a PHP application

In these programmes, digital sovereignty is described in practice by naming specific pieces of software.

The ITZBund's Bundescloud includes the SIB-Box, [built on Nextcloud](https://www.itzbund.de/DE/itloesungen/egovernment/bundescloud/bundescloud.html), serving [roughly 300,000 federal users](https://www.linux-magazin.de/news/bundesverwaltung-setzt-auf-nextcloud/). [openDesk](https://opendesk.eu/blog/opendesk-1-0-veroeffentlicht/), the sovereign workplace built by the Zentrum für Digitale Souveränität, integrates Nextcloud alongside Collabora, Element, Open-Xchange, OpenProject, and XWiki. It is [anchored in the German coalition agreement: by October 2028 the federal administration is to have a digitally sovereign alternative to proprietary IT workplaces](https://bmds.bund.de/themen/digitale-souveraenitaet/digitale-souveraenitaet-in-der-oeffentlichen-verwaltung/souveraener-arbeitsplatz). The state of Baden-Württemberg has already [migrated close to 60,000 teacher workplaces](https://www.btc-ag.com/cloud-blog/der-souveraene-arbeitsplatz-opendesk-nextcloud-workspace/); the Bundeswehr has a framework agreement; the Robert Koch Institute and several ministries run components in production. The International Criminal Court in The Hague intends to adopt it.

Nextcloud Server is a PHP application: versions 33 and 34 [support PHP 8.2 through 8.5](https://github.com/nextcloud/server/wiki/Releases-and-PHP-versions), and the [administration manual](https://docs.nextcloud.com/server/stable/admin_manual/installation/php_configuration.html) still opens the installation chapter with PHP configuration. That claim needs a caveat, because the picture has changed: the Files High Performance Backend is [written in Rust](https://nextcloud.com/blog/nextcloud-faster-than-ever-introducing-files-high-performance-back-end/), and the [ADA engine announced in 2026](https://nextcloud.com/blog/a-new-data-access-architecture-for-nextcloud-introducing-the-ada-engine/) rewrites the file access layer in PHP, Go, and Rust. PHP carries the application and the business logic, but the I/O-bound paths increasingly do not. MediaWiki, which runs Wikipedia, is built the same way.

## The asymmetry

€108 million for one national migration. 770 sites at the European Commission. 370 across the Australian government. Around 300,000 users in the German federal cloud. Tens of thousands of teacher workplaces in one German state alone.

And $730,534 in contributions to The PHP Foundation in 2025, from [536 organisations and individuals, substantially fewer than the previous year, with expenses exceeding donations by roughly $139,000](https://thephp.foundation/blog/2026/05/27/impact-and-transparency-report-2025/), a deliberate choice to maintain technical headcount. [Thirteen contracted engineers](https://thephp.foundation/structure/) maintain the language underneath all of it.

I want to be careful about the conclusion here, because nobody in this story has acted badly. What the numbers show is a structural gap: the institutions most dependent on PHP have no established mechanism by which that dependency turns into maintenance funding. Nobody designed that gap; it is what happens when infrastructure is free at the point of use.

One institution has already built the mechanism. The Sovereign Tech Agency, funded by the German government, commissioned work that produced the [PHP-FPM Web Services Tool](https://thephp.foundation/blog/2024/10/21/web-services-tool-for-php-fpm/) and the [evolution of PHP's stream layer for async, security and performance](https://thephp.foundation/blog/2025/10/30/php-streams-evolution/). Public money went into the substrate and shipped capability came back out. The mechanism exists and it works. What it lacks is the habit of being used.

## What would make it normal

At Drupal4Gov EU, [Tiffany Farriss, now Interim CEO of the Drupal Association, proposed a set of procurement changes](https://www.youtube.com/watch?v=dKBdQMQf1bw&list=PLNubpNMwP36QH5Y3RlbOiV4f9hjlrxCOo&index=15) that translate directly to any language ecosystem. They are worth repeating here because they require no goodwill, only a change to how tenders are scored, and because the first of them fits inside a framework that European procurement already uses:

1. **A sovereignty criterion with real weight:** Twenty percent of tender evaluation points awarded for verified open-source contributions, as a distinct assessment criterion under the MEAT framework, the Most Economically Advantageous Tender. That puts software transparency and digital sovereignty next to the qualitative, environmental and social criteria a tender is already allowed to score.
2. **A maintenance line item:** A share of contract value allocated to upstream maintenance of the components the delivery depends on, budgeted at the outset rather than found later. Farriss deliberately does not fix the number and would rather see one settled in public: her own estimate is 2 to 5 percent, depending on the budget and the duration of the project, and up to 10 percent on complex ones.
3. **A 30-day upstream rule:** Non-sensitive code developed under public contract contributed back within 30 days, so that the next administration inherits it instead of paying for it again.

An administration that adopts these does not need to know or care that its CMS is written in PHP. It only needs to accept that the code it depends on has maintainers, and that maintainers have budgets.

## What we are asking

If you work in or with a public administration: the software your organisation depends on almost certainly includes several PHP applications, and quite possibly the ones your sovereignty strategy is built around. The three proposals above belong in your next tender rather than in your next strategy document.

If you are an agency delivering these contracts: put the line item in the bid. You are in a better position than anyone to make upstream maintenance a normal cost of delivery rather than an act of charity.

And if you know a case we have missed, a ministry, a municipality, a health service, a statistics office running on PHP, tell us. This article covers Europe and one Australian platform because that is as far as the research went. We would like to publish those cases here, written by the people who built them.
