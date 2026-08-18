---
title: "How to Contribute to PHP"
description: "An introductory guide to the many ways you can contribute to PHP, both to the language and to the community."
layout: post
tags:
    - contributing
    - community
author:
  - matt-stauffer
published_at: 17 August 2026
---

PHP has powered a huge portion of the web for a *long* time now. It's launched untold numbers of careers and businesses, and many developers attribute their entire careers to the language. But when we find ourselves wanting to give back, it's not always clear how; sure, PHP is open source, but where do we contribute? How?

I've run into that wall before. My immediate issue was that I didn't write C, followed pretty immediately by how overwhelming it felt to learn the entire RFC-and-mailing-list-driven contribution process.

Thankfully, it turns out there are many ways to contribute to PHP, and writing C or proposing an RFC are just two of many options. I'm glad to share I've found *many* other ways to give back, and I'm confident you can as well.

When we talk about "contributing to PHP," there are really two ways: **contributing directly to the PHP project**, and **contributing to the broader PHP ecosystem**. Both are needed and both are valid, so we'll walk through both in this guide. Wherever any potential path gets technical, we'll point you to the canonical instructions rather than duplicate them here.

## PHP, the PHP Foundation, and the ecosystem

Before we go any further, I want to clear up the difference between a few different concepts with "PHP" in their names which we'll be referring to throughout this post:

- **The PHP project** — a language, and the open-source project around it: the implementation, tests, documentation, and releases, and the technical decision-making that guides it all.
- **The PHP ecosystem** — everything else built around PHP: packages, frameworks, tooling, conferences, education, communities, and publications.
- **The PHP Foundation** — an organization that supports the long-term health of PHP, including funding programmers and coordinating and supporting community initiatives.

And to clear up an important governance distinction, since this is posted on the PHP Foundation's blog: the Foundation does not own PHP, it doesn't govern its development, and it doesn't dictate RFCs. PHP is an independent open-source project with its own contributors and its own decision-making process, and we like it that way! The Foundation exists to support that work.

# Part One: Contributing directly to PHP

## Core contribution is broader than you might think

When most people picture the idea of "contributing to PHP core," the first thing that comes to mind is proposing a new language feature. But that's actually the deepest end of that pool, and it's only a small part of the work it takes to run a language.

There are so many other ways people can contribute to the project, including testing releases, reporting bugs, reproducing bugs others have reported, writing tests, improving documentation, reviewing changes, fixing issues, participating in internals discussion, and, yes, RFCs.

Let's walk through these, roughly from the lowest barrier to entry to the highest.

## 1. Test prereleases

Every new major, minor, or patch PHP version ships with a prerelease. Patch versions just get an RC (release candidate), and major/minor versions receive a series of prereleases — alphas, betas, and release candidates — before the final release. These exist so the community can catch problems while they're still cheap to fix. The more real-world code that runs against a prerelease, the more confident everyone can be that the final release won't break things.

If you maintain a package, run its test suite against the next prerelease. If you run a large real-world application, run its tests on the prerelease, or point a local or staging environment at it. When something breaks, you've found either a genuine regression worth reporting or a change you'll need to prepare for, both of which are valuable.

If you want to go a step further, test against PHP's master branch continuously rather than only at prerelease time; projects like PHPUnit and Xdebug already do this, so they catch regressions the moment they land. One caveat: don't gate your CI on it. Let a master-branch build fail without failing your whole suite, since you're deliberately testing against unreleased, in-progress code. PHPUnit's Sebastian Bergmann has written up [how PHP and its ecosystem test each other this way](https://phpunit.expert/articles/how-php-and-its-ecosystem-test-each-other.html).

PHP announces each alpha, beta, and release candidate on [php.net](https://www.php.net/), together with the source downloads and release schedule for that version. You can use your preferred version management or container tooling to install the prerelease, or [build it yourself locally](https://github.com/php/php-src#building-php-source-code), and then run your application's or package's test suite against it. If you find something that looks like a regression in PHP itself, reduce it to the smallest reproduction you can and report it to the [`php-src` issue tracker](https://github.com/php/php-src/issues).

**First step:** Grab the current prerelease and run something you already maintain against it.

## 2. Report and reproduce bugs

A good bug report is itself a contribution, and so is confirming or reproducing someone else's.

Before you file anything, search the [existing `php-src` issues in GitHub](https://github.com/php/php-src/issues); this problem may already be known. If it isn't, the most valuable thing you can do is reduce it to a **minimal reproduction**: the smallest snippet of code that will reliably trigger the undesirable behavior, along with your PHP version, platform, and any other relevant environment details. The [`php-src` contribution guide](https://github.com/php/php-src/blob/master/CONTRIBUTING.md) has additional guidance on filing and working with issues.

And to clear up a common misconception, it's still valuable to report a bug even if you don't know how to fix it.

**First step:** Search the issues, then either file your own issue or try to reproduce someone else's unconfirmed report.

## 3. Improve documentation

PHP's documentation is vast, and like all large (and long-running) documentation projects, it still contains plenty of unclear passages, missing examples, and pages describing behavior that has changed since its writing. Improving any of these helps every developer who lands on that page after you.

For small changes, you don't even need to set up the documentation project locally: the PHP manual's [contribution guide](https://doc.php.net/guide/contributing.md) explains how to propose an edit directly through GitHub. If you're interested in translation work, there's a separate [translation guide](https://doc.php.net/guide/translating.md).

Here are a few concrete examples: clarifying a confusing sentence, adding a clear example to a function that lacks (and needs) one, documenting an edge case you had to discover the hard way, correcting behavior that's drifted over versions, or improving a translation into your language. And "improving the docs" isn't only about what's written: the documentation project also has tooling (CI, linting, etc.) that welcomes contributions.

**First step:** The next time a docs page confuses you, propose a fix instead of just closing the tab in frustration.

## 4. Write tests

PHP has its own test format, called **PHPT**: plain-text files that describe a bit of PHP to run and the output it should produce. They're how the language guards against regressions, and they're a natural bridge between everyday PHP development and working in `php-src`.

A PHPT test is deliberately simple. At its core it's three sections: the description, a section describing the code to run, and a section describing the expected output:

```
--TEST--
strlen() returns the number of bytes in a string
--FILE--
<?php
var_dump(strlen("hello"));
?>
--EXPECT--
int(5)
```

The [`php-src` testing guide](https://php.github.io/php-src/miscellaneous/writing-tests.html) walks through the full PHPT format and how to write useful tests; once you're working from a local PHP build, the [test-running guide](https://php.github.io/php-src/miscellaneous/running-tests.html) explains how to execute them.

Similar to how it's valuable to report an issue even if you don't know how to fix it, it's valuable to write a test for a bug even if you don't know how to fix it. If you can write PHPT that reliably fails on a known bug, you've pinned the problem down precisely and made the process of writing and validating a fix that much easier.

**First step:** Turn a bug you've reproduced into a failing PHPT.

## 5. Fix or review issues in php-src

This is the point where contribution moves into the implementation itself, and where knowing some C starts to matter. It's a bigger step, but still very clear. Here's generally how it works:

1. Get PHP building locally.
2. Find a scoped, well-defined existing problem to work on.
3. Comprehend the problem, and reproduce it for yourself locally.
4. Add or update tests that capture the correct behavior.
5. Implement the fix.
6. Open a pull request.
7. Work through any review with the maintainers.

I know "just get PHP building locally" is doing a lot of work in that first step. The [`php-src` developer documentation](https://php.github.io/php-src/) and [CONTRIBUTING.md](https://github.com/php/php-src/blob/master/CONTRIBUTING.md) are the best places to start with setting up a development environment and understanding the contribution workflow.

There's also the other half of this process: **reviewing and testing someone else's pull request.** Pull down an open PR, build it, check that it does what it claims, and then leave your findings on the PR. And this may actually be simpler than opening your first PR from scratch.

**First step:** Get PHP building locally, then browse the [`php-src` issues](https://github.com/php/php-src/issues) for a narrowly scoped, already-verified bug in an area you understand.

## 6. Participate in internals

Technical discussion about the direction of PHP happens openly on the [internals mailing list](https://www.php.net/mailing-lists.php), PHP's long-running development mailing list. You don't have to write C to follow along, and you don't have to be an established contributor to add value.

In fact, many people participating in internals conversations aren't traditional core developers. That goes both ways: it means you, even as a newcomer, are as welcome to participate as anyone, but it also means not every reply you might receive should carry the same weight. That means a strong objection from one participant can't be seen as the same as a decision; weigh feedback by its reasoning and don't be discouraged by a single dissenting voice.

The internals mailing list also does have a [written guide](https://github.com/php/php-src/blob/master/docs/mailinglist-rules.md), which lays out how to participate. I'd recommend reading the whole thing before you post.

**First step:** Subscribe to the [internals mailing list](https://www.php.net/mailing-lists.php), or browse past and current discussions on [externals.io](https://externals.io/), and just listen for a while.

## 7. RFCs: changing the language itself

RFCs (Requests for Comments) are the processes by which significant changes to the language are formally proposed and decided. They're the part of contributing to core that gets the most attention, so it's worth being clear about what they are and aren't.

First: **not every code change requires an RFC.** Plenty of bug fixes land through ordinary pull requests. RFCs exist for new features and other changes significant enough to need formal decision-making through the RFC process.

Second: **an RFC is much more than an idea.** A proposal that will be taken seriously requires research into prior art, careful design, analysis of backward-compatibility impact, a credible implementation plan (and often an implementation), a period of discussion, revision in response to feedback, a formal vote, and technical review throughout. The idea is the easy part; everything around it is the work.

Two things newcomers often miss:

- **You can contribute to an RFC without being its author.** Testing a proposed implementation, poking holes in the design, surfacing a compatibility problem, or providing real-world use cases all move a proposal forward.
- **An accepted proposal still has to become good software.** A "yes" vote is the beginning of the implementation's real life, not the end.

If you're not ready to author an RFC yourself, a great way to learn the process is to follow one that's currently under discussion. Read the proposal and its linked internals discussion, try the implementation if one is available, and look for places where your own experience can add useful evidence: compatibility concerns, interactions with existing features, real-world use cases, or behavior the proposal may not have considered. You don't need voting privileges to participate in the discussion or test the implementation.

**First step:** Browse the [current RFC list](https://wiki.php.net/rfc), choose one that's under discussion, and follow it end to end. If you're considering proposing your own change, start with the official [How to create an RFC](https://wiki.php.net/rfc/howto) guide.

# Part Two: Contributing to PHP's ecosystem

The PHP project is only part of the story. Most developers spend more of their time in the ecosystem around it — the packages, frameworks, tools, communities, and education that make PHP an ecosystem, not just a language. Contributing here is not a consolation prize for people who can't work on core; for most of the community, it's where their highest-value contributions actually live.

## 1. Help existing open-source projects

The packages, frameworks, and tools you already use are maintained by real people; often very few of them, and often unpaid. They almost all need help: issue triage, pull-request review, documentation, testing against upcoming PHP versions, and general maintenance. Abandoned-but-widely-used projects sometimes need someone to step in and adopt them entirely — and that includes PHP's own bundled extensions, many of which have few or no active maintainers, so a domain you know well may be a genuine gap you can fill.

It's tempting to think the way to contribute is to build something new. But *creating another package is not necessarily more valuable than maintaining one thousands of people already depend on.* In fact, it's often worse. Strengthening what exists is often the more valuable choice.

**First step:** Pick a dependency you rely on and spend an hour in its issue tracker.

## 2. Teach and help developers

Teaching is infrastructure. An ecosystem is only as healthy as its ability to bring new people in and help existing developers level up, and that ability runs almost entirely on people who take the time to explain things.

That includes writing tutorials and documentation, producing upgrade guides, giving talks, mentoring, answering questions in forums and chat, and helping newcomers land their very first contribution. None of this requires permission, and all of it builds on the rest.

**First step:** Write up the last thing you had to figure out the hard way.

## 3. Strengthen PHP communities

The PHP community exists because people build and sustain the spaces it lives in: local meetups, conferences, online communities.

You don't need to start a conference. Consider volunteering to assist a local meetup, or simply working to make a newcomer feel welcome in one. Or, if you haven't attended one yet, just show up!

**First step:** Show up to a local or online PHP community and meet people; if you're already there and want to do more, ask how you can help.

## 4. Help PHP show up outside the PHP bubble

Plenty of the world's developers have formed their impression of PHP from someone else's read on the language from the '90s. The best way to update these impressions is to make sure PHP is represented accurately where non-PHP developers actually are.

That looks like giving PHP talks at general software conferences, contributing PHP SDKs or examples to language-neutral projects, adding modern PHP examples to developer education, publishing case studies from real applications, and improving PHP support in general-purpose developer tooling.

That outward-facing work is exactly what the Foundation's Ambassador Program is built to coordinate.

# Part Three: PHP Foundation opportunities

In addition to everything above, the Foundation explicitly offers some structured ways to plug in. These are intentionally building space for contributions outside of code, like marketing, conference speaking, research, and more.

In 2026, the Foundation is launching six **Special Interest Groups**, covering the following areas: ecosystem security, [PHP advocacy](https://thephp.foundation/blog/2026/06/19/the-php-ambassador-program-is-open/), [onboarding](https://thephp.foundation/blog/2026/08/03/kicking-off-the-php-onboarding-initiative/), cryptography, community events, and accessibility and inclusion. The Foundation also periodically looks for community participation in surveys, consultations, and other initiatives.

And for people or organizations that don't have contributor time to spare, [**financial support** to the Foundation](https://thephp.foundation/sponsor/) is another way to enable this work — funding the contributors and initiatives that keep PHP moving.

## When you get stuck (or hear nothing back)

At some point you'll get stuck in one of these processes, or you'll open a pull request and hear nothing back for a while. Both are normal, and neither means you necessarily did anything wrong. Contribution runs largely based on the work of volunteers, and volunteer attention is limited.

When you need help, there are a few good places to turn:

- **General questions and getting unstuck:** The [PHP Community Discord](https://phpc.chat/) is the most active real-time gathering spot, with channels ranging from beginner questions to core development. There's even a `#php-src-help` channel specifically for this sort of work. For longer-form questions, the [r/PHP subreddit](https://www.reddit.com/r/PHP/) and the [`php` tag on Stack Overflow](https://stackoverflow.com/questions/tagged/php) are both well-trafficked.
- **Core and internals questions:** For questions specific to working on `php-src`, that same Discord has a `#php-internals` channel where core developers hang out, and the [internals mailing list](https://www.php.net/mailing-lists.php) is the canonical venue for development discussion.
- **A `php-src` PR or RFC that's gone quiet:** The internals mailing list is the right place to politely follow up. A short, respectful message linking your PR or proposal is a normal and accepted way to ask for eyes on stalled work.

## Pick one thing

You don't have to try everything in this article. Pick one that fits your current level of experience and available time, and run with it.

- **If you have 30 minutes:** fix a confusing docs page, confirm an open issue, or answer someone's question.
- **If you have an afternoon:** test a prerelease, build a minimal reproducible example, or investigate a bug.
- **If you want a project:** write a test, take on a scoped issue, or help maintain a package you depend on.
- **If you want an ongoing role:** review contributions, maintain software, organize community, or get involved in internals or Foundation work.

Whatever you pick, hold onto this:

**If you write PHP, you are qualified to contribute to PHP.** Don't let anyone tell you otherwise.