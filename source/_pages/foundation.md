---
title: What we do
permalink: foundation
layout: page
---

## Governance

The PHP Foundation operates with a structured governance model designed to ensure transparency, accountability, and effective stewardship of resources dedicated to the PHP language.

Our governance structure consists of four key entities:

* **Board of Directors** – Provides strategic oversight, sets the Foundation's goals, and makes final decisions on major matters. The Board consists of 5-10 members representing platinum sponsors, other sponsors, and community representatives.
* **Executive Director** – Manages day-to-day operations, implements the approved strategy, and serves as the bridge between the Board and staff.
* **Advisory Board** – Provides high-value input and strategic foresight from major sponsors (Silver tier and above), founding companies, and community leaders.
* **Developers (Staff)** – Execute technical work, maintain the PHP codebase, and support community needs.

The Board of Directors meets monthly and makes decisions by consensus when possible, moving to formal votes when needed. All board members and staff are expected to abide by the [Code of Conduct](/code-of-conduct).

To promote transparency, we operate as a [collective on the Open Collective platform](https://opencollective.com/phpfoundation), through which we manage activities such as selection and financing of PHP core developers. The Foundation operates through Open Source Collective as its fiscal host.

**Important:** The Request for Comments (RFC) process is not affiliated with the PHP Foundation. Language decisions remain the matter of the PHP Internals community.

Learn more about our [governance model](/governance).

## Foundation Activities

The primary task of the PHP Foundation is to fund developers to work on PHP. Funds collected
through the Open Collective platform may be used in the first place to engage the services of
PHP developers to further advance the development and maintenance of the language.

PHP’s Request for Comments (RFC) process operates independently of the PHP Foundation. Decisions regarding the language are made through this community-driven process, as outlined [here](https://wiki.php.net/rfc/howto).

## Team Timeline

We established the following timeline for team review. 

* January 2024: Developers start work according to the new contracts.  
* May 2024: Evaluate new developers, contracts are extended, expanded, or terminated after the first 6 months.  
* September 2024: Open applications for new developers, evaluate performance of the current group of developers.  
* October 2024: Evaluate applications, work out updates to compensation, decide on a budget.  
* November 2024: Renew contracts with existing developers, potentially sign contracts with new developers.  

And in 2025 we start the cycle again.

## Talks

<div class="my-16 gap-8 flex flex-col">
    {{ include('presentations-item.html', {
        iframe: 'https://www.youtube.com/embed/ltoPWEzPqEQ',
        date: 'Jun 09, 2026',
        place: 'Amsterdam, Netherlands',
        conference: 'JetBrains PHPverse 2026',
        title: 'Getting to Know The PHP Foundation',
        description: 'Many know The PHP Foundation exists; few know what it actually does. In this talk, Elizabeth explains why the Foundation was founded, what it works on, and how it supports the PHP ecosystem.',
        team: ['elizabeth-barron']
    }) }}

    {{ include('presentations-item.html', {
        iframe: 'https://www.youtube.com/embed/XE4g1Tl6RQw',
        date: 'Feb 05-06, 2024',
        place: 'Amsterdam, Netherlands',
        conference: 'Laracon EU 2024',
        title: 'The PHP Foundation',
        description: 'The PHP Foundation is a non-profit organization formed in 2021 by well-known PHP folks as well as major companies from the PHP ecosystem. What we have achieved since then and what we are planning next.',
        team: ['roman-pronskiy']
    }) }}

    {{ include('presentations-item.html', {
        iframe: 'https://speakerdeck.com/player/a151df6d6f35473589cebb7b17caa92d',
        date: 'Dec 07-08, 2023',
        place: 'Brussels, Belgium',
        conference: 'SymfonyCon 2023',
        title: 'Symfony, PHP and its Foundation',
        description: 'The PHP Foundation supports PHP\'s growth and core developers, emphasizing its vital link with Symfony to ensure the language\'s evolution and relevance.',
        team: ['nicolas-grekas'],
    }) }}

    {{ include('presentations-item.html', {
        iframe: 'https://media.ccc.de/v/froscon2023-2859-the_php_foundation/oembed',
        date: 'Aug 05-06, 2023',
        place: 'Sankt Augustin, Germany',
        conference: 'FrOSCon 2023',
        title: 'The PHP Foundation',
        description: 'The PHP Foundation is a non-profit organization formed in 2021 by well-known PHP folks as well as major companies from the PHP ecosystem. What we have achieved since then and what we are planning next.',
        team: ['sebastian-bergmann'],
    }) }}

    {{ include('presentations-item.html', {
        iframe: 'https://www.youtube.com/embed/JBPtPy9iSP0',
        date: 'Oct 13-14, 2022',
        place: 'Paris, France',
        conference: 'Forum PHP 2022',
        title: 'The PHP Foundation: The Past, the Present, and the Future',
        description: 'A complex saga of developers scattered around the world, all living under the rule of the elePHPant technology.',
        team: ['roman-pronskiy', 'sebastian-bergmann'],
    }) }}
</div>
