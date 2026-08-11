---
title: "So You Received a Security Report. Now What?"
description: "A guide for PHP project maintainers, from the PHP Foundation Ecosystem Security Team"
layout: post
tags:
    - security
    - SIGs
author:
  - sebastian-bergmann
published_at: 11 August 2026
---
**A guide for PHP project maintainers, from the PHP Foundation Ecosystem Security Team**

> You maintain a PHP project. Someone (maybe Volker from the PHP Foundation, maybe an
> independent researcher) has just told you that your project may have a security
> vulnerability. You might be feeling overwhelmed, or unsure whether you can trust the
> report, or simply unsure what the correct next step is.
>
> Take a breath. **Nothing bad has happened yet.** A report is not a breach. It is a
> head start: someone is telling you privately about a problem so that you can fix it
> before anyone gets hurt. This guide walks you through the whole process, and it
> ends with concrete steps to make your project more resilient for the next time.
>
> And at any point where you get stuck: **you are not alone.** You can always ask the
> Ecosystem Security Team for help. Contact details are at the [end of this
> guide](#10.-getting-help).

---

## How to use this guide

- **Do not read it front to back.** Jump to the stage you are at. Each section starts
  with a short "You are here if…" signpost.
- **Expect to come back over several days.** Handling a security report properly
  usually takes more than one sitting, and that is fine.
- **If you only have five minutes right now,** read the [Cheatsheet](#cheatsheet) and
  section [1](#1.-do-not-panic-and-do-not-go-public).

A word on your authority before we start: **you are the maintainer.** You decide what
is in scope, what the timeline is, and whether a report is valid. Handling a report
well does not mean dropping everything or working weekends. It means following a small
number of steps in the right order, at a pace you can sustain. You do not owe anyone
heroics; see [Open Source Maintainers Owe You
Nothing](https://mikemcquaid.com/open-source-maintainers-owe-you-nothing/).

---

## Cheatsheet

The whole process on one screen. Details in the numbered sections below.

1. **Don't panic, don't go public.** Keep the vulnerability private until a fix is
   released. → [§1](#1.-do-not-panic-and-do-not-go-public)
2. **Acknowledge the report** within a few days, even before you have assessed it.
   → [§2](#2.-acknowledge-the-report)
3. **Triage:** understand the claim, then decide: valid, invalid, or out of scope.
   → [§3](#3.-triage-the-report)
4. **Reproduce safely.** Never run proof-of-concept code on your own machine; use an
   isolated environment. → [§4](#4.-handle-proof-of-concept-code-safely)
5. **Fix privately.** Use a temporary private fork; do not push to any public branch.
   → [§5](#5.-prepare-the-fix-privately)
6. **Write the advisory.** For Composer packages: ecosystem = **Composer**, package
   name exactly as on Packagist, affected-version ranges precise. Composer will
   actively **block** installation of what you list.
   → [§6](#6.-write-the-github-security-advisory)
7. **Publish in the right order:** merge → tag & release → publish the advisory →
   announce. → [§7](#7.-coordinate-the-release-and-publication)
8. **Wrap up:** credit the reporter, check older branches, do a short retrospective.
   → [§8](#8.-wrap-up)
9. **Improve your posture** so the next report is easier: SECURITY.md, private
   vulnerability reporting, 2FA, hardened CI. → [§9](#9.-improving-your-security-posture-for-the-long-term)
10. **Ask for help** whenever you are unsure. → [§10](#10.-getting-help)

---

## 1. Do not panic and do not go public

*You are here if: a report just landed and your pulse went up.*

The single most important principle is **coordinated disclosure**: the details of a
vulnerability stay private until a fixed version exists and users can protect
themselves. The moment the details are public, every attacker in the world has them,
and your users do not yet have a fix. So until you publish:

- **Do not** open a public issue about it, reference it in a public pull request, or
  mention it in a public commit message.
- **Do not** push a fix to `main` or any public branch. A commit titled "fix SQL
  injection in login handler" *is* the disclosure.
- **Do not** post about it on social media, a blog, or a mailing list. Not even a
  vague "big security release coming soon": teasers invite people to go looking.
- **Do not** go silent on the reporter either. Silence is how well-meaning reporters
  become frustrated reporters who eventually publish on their own.

Also worth internalizing early: **a report is a claim, not a verdict.** It may be a
serious finding, a minor issue, a duplicate, a bug without security impact, or simply
wrong. Part of your job in the next steps is to find out which, and *you* make that
call, ideally in dialogue with the reporter.

If the report came from the PHP Foundation Ecosystem Security Team, it has already
been through triage and usually comes with a reproducer. That raises the odds it is
real, but it does not take the decision away from you.

## 2. Acknowledge the report

*You are here if: you have read the report once and have not replied yet.*

Reply quickly, even if you have nothing substantial to say yet. A short message buys
you time and goodwill:

> Thanks for the report. I've received it and will look into it. I maintain this
> project in my spare time, so please allow up to two weeks for a first assessment.
> I'll get back to you here.

That is genuinely all it takes. Set expectations you can actually meet: "two weeks"
kept is better than "tomorrow" broken. If the report arrived by email but your
repository has [GitHub Private Vulnerability
Reporting](https://docs.github.com/en/code-security/security-advisories/guidance-on-reporting-and-writing-information-about-vulnerabilities/privately-reporting-a-security-vulnerability)
enabled (see [§9](#9.-improving-your-security-posture-for-the-long-term)), this is a
good moment to move the conversation there: it keeps discussion, patch, and timeline
in one private place.

## 3. Triage the report

*You are here if: you have acknowledged the report and now need to decide what it is.*

Read the report carefully and try to answer four questions:

1. **What is the claimed weakness?** (e.g. SQL injection, path traversal, insecure
   deserialization, often given as a [CWE](https://cwe.mitre.org/) identifier)
2. **Who can trigger it, and from where?** Does it require an authenticated admin, or
   can any anonymous user on the internet trigger it? Does it require unusual
   configuration?
3. **What can an attacker actually achieve?** Reading data, modifying data, executing
   code, denial of service?
4. **Which versions are affected?** Including old release branches people still use.

The answers determine everything downstream: severity, urgency, and what the fix and
advisory should say. Three notes from practice:

- **Ask questions.** A good reporter would rather answer three clarifying questions
  than watch you guess. If the threat model is unclear ("is this exploitable if the
  attacker controls that config value? In my project, they never do"), say so. That
  discussion is the most valuable part of triage.
- **"Works as designed" is a legitimate answer.** If exploiting the issue requires the
  attacker to already have capabilities that your documented security model says are
  trusted, it may not be a vulnerability in your project. Explain your reasoning to
  the reporter; if they disagree, the Ecosystem Security Team can act as a neutral
  second opinion.
- **A real bug without security impact is still worth fixing**, just through your
  normal, public process, without an advisory.

If the volume or quality of reports is a problem in itself (for example, a flood of
low-effort AI-generated reports), that is exactly one of the things the Ecosystem
Security Team exists to help with. Forward them; do not let them eat your motivation.

## 4. Handle proof-of-concept code safely

*You are here if: the report includes a script, a payload, a crafted file, or
step-by-step exploitation instructions.*

This section exists because it is the mistake with the worst possible failure mode.

**Never run proof-of-concept code directly on your own machine.** Not "just this
once", not because the reporter seems trustworthy, not because you skimmed the code
and it looked fine. Your development machine holds your SSH keys, your GPG keys, your
Packagist and GitHub credentials, your password manager, and, if you use one, your
authenticated AI coding agent. A malicious or merely careless PoC that runs with your
user account can compromise all of it. For a maintainer, that is not just a personal
problem: **your credentials are a supply-chain attack on everyone who installs your
package.**

And remember what a PoC *is*: a program written by a stranger, designed to break
software. Treat it with exactly the suspicion that description deserves. Even an
honest reporter's PoC may delete files, open network connections, or hammer your CPU
as a side effect of demonstrating the bug.

Instead, reproduce in an **isolated, disposable environment**:

- **A well-secured virtual machine** is the recommended baseline: a fresh VM with a
  current OS, no credentials or personal data inside, no shared folders into your host,
  clipboard sharing disabled, and a snapshot taken *before* you run anything so you can
  roll back afterwards. If the PoC does not need internet access, disable networking
  entirely, or restrict it to host-only.
- **A container** (Docker/Podman) is convenient for typical PHP-level issues and fine
  for most web-application-class vulnerabilities. Be aware that containers share the
  host kernel, so for anything that smells like memory corruption, native extensions,
  or kernel interaction, prefer a real VM.
- **A cloud throwaway** (a short-lived VM at any provider, destroyed afterwards) works
  too, as long as no credentials of yours live on it.

Inside the isolated environment, the workflow is simple: check out the affected
version of your project, install dependencies, run the PoC, observe. Read the PoC
before running it. Not as a substitute for isolation, but because understanding
*how* it triggers the bug is exactly the insight you need for the fix and, later, for
a regression test.

Two closing rules for this section:

- **Crafted input files are code.** A "harmless" `.phar`, image, XML document, or
  serialized payload attached to a report is an exploit delivery vehicle by
  definition. The same isolation rules apply to opening or parsing them.
- **If you cannot reproduce safely, ask for help** instead of taking the shortcut.
  Building reproducers in isolated environments is one of the Ecosystem Security
  Team's core services.

## 5. Prepare the fix privately

*You are here if: the issue is confirmed and you are ready to write code.*

GitHub Security Advisories give you a **temporary private fork** for exactly this
purpose. On the advisory page, click *"Start a temporary private fork"*. Then:

1. Develop the fix in the private fork and open the pull request **there**, never
   against your public repository.
2. Keep commit messages neutral while working; the advisory will tell the full story
   later. (Referencing the GHSA ID in the final commit is fine, since it only resolves
   to something public after publication.)
3. Write a **regression test** that fails on the vulnerable code and passes with the
   fix. This is the part of the work that keeps paying off: the bug can never quietly
   come back. If the PoC helped you understand the issue, distill it into a safe,
   minimal test case. The test should demonstrate the *condition*, not ship a
   working exploit.
4. Invite the reporter as a collaborator on the advisory and let them verify the fix.
   They found the hole; they are the best-qualified person to confirm it is closed.
5. Decide **which release branches** get the fix. If you still support older major
   versions, users on those versions deserve a patched release too, or an explicit
   statement in the advisory that they must upgrade.

Gotchas that bite first-timers:

- CI does not run in temporary private forks. Run your test suite locally (in a safe
  environment) before merging.
- Don't `git push --no-verify` out of habit. Hooks that scan for secrets or enforce
  checks exist for days exactly like this one.
- Publishing the advisory **deletes the temporary private fork**. Make sure everything
  you need (the commits, the discussion outcomes) has landed before you publish.
- **Do not fix silently.** A patch released without an advisory leaves every
  downstream user blind: `composer audit` won't warn them, Dependabot won't open a PR,
  and most will never upgrade. The advisory is not an admission of failure; it is the
  mechanism by which your fix actually reaches people.

## 6. Write the GitHub Security Advisory

*You are here if: the fix exists and you are filling in the advisory form.*

You create the advisory in your repository under **Security → Advisories → New
draft security advisory**. The click-by-click walkthrough of that form (every field,
the CVSS calculator, adding credits, adding multiple affected products) is GitHub's
[Creating a repository security
advisory](https://docs.github.com/en/code-security/how-tos/report-and-fix-vulnerabilities/fix-reported-vulnerabilities/create-repository-advisory).
(If the report arrived via private vulnerability reporting, the draft advisory
already exists; you edit that one rather than creating a new one.) This section
focuses on the part the walkthrough cannot do for you: what to put *into* the fields.

The advisory is a machine-readable document as much as a human-readable one. Tools
across the ecosystem, among them the [GitHub Advisory
Database](https://github.com/advisories), [OSV.dev](https://osv.dev/), Dependabot,
Packagist, and `composer audit`, consume it to warn your users automatically. Getting
the metadata right is what makes that machinery work.

**For PHP packages installable via Composer, the crucial details are:**

- **Ecosystem: select `Composer`.** Not "Other", not "GitHub Actions", not left empty.
  Only advisories filed under the Composer ecosystem are matched against
  `composer.json`/`composer.lock` files, which is what makes `composer audit` and
  Dependabot alerts fire for your users.
- **Package name: the exact Packagist name**, in `vendor/package` form. For example
  `phpunit/phpunit`, not `PHPUnit` and not the GitHub repository slug if it differs.
  A typo here silently breaks the matching.
- **Affected version ranges: precise and Composer-flavored**, e.g.
  `>= 10.0.0, < 10.5.17`, and one *Affected product* entry per affected release
  series if you patched several (a single field cannot hold multiple ranges). The
  exact syntax has non-obvious rules (supported operators, spacing, how suffixes
  like `-beta1` are ordered), documented in GitHub's [Best practices for writing
  repository security advisories](https://docs.github.com/en/code-security/tutorials/fix-reported-vulnerabilities/write-security-advisories),
  which is worth five minutes before you fill in this field. It is what version
  constraint resolution runs against; "all versions before X" prose in the
  description does not replace it. And getting these ranges right matters more than
  it used to, because Composer no longer merely *reports* your advisory. It
  *enforces* it. Read on.

### Composer blocks the versions your advisory lists

Since [Composer 2.9](https://phpunit.expert/articles/the-bouncer-in-the-dependency-resolver.html),
security advisory enforcement lives in the dependency resolver itself, on by default
for every PHP project. When Composer resolves dependencies (`composer update`,
`require`, `remove`), versions covered by a published advisory are removed from the
candidate pool before the solver runs. As far as the resolver is concerned, they
simply do not exist. [Composer
2.10](https://blog.packagist.com/composer-2-10-release/) generalized this into a
unified *dependency policy* framework that also covers packages flagged as malware
(those are blocked even during `composer install` from an existing lock file) and
abandoned packages. This machinery replaced the older `roave/security-advisories`
conflict-package approach. For the full mechanics (pool filtering, `config.policy`
configuration, ignore rules, escape hatches), see [The Bouncer in the Dependency
Resolver](https://phpunit.expert/articles/the-bouncer-in-the-dependency-resolver.html)
and Packagist's [supply chain security
update](https://blog.packagist.com/an-update-on-composer-packagist-supply-chain-security/).

For you as the advisory author, this has three practical consequences:

1. **Your advisory directly protects users, even those who never read it.** This is
   the strongest argument against fixing silently ([§5](#5.-prepare-the-fix-privately)):
   an advisory does not just inform, it actively keeps the vulnerable versions out of
   `vendor/` directories across the ecosystem.
2. **Over-broad version ranges cause real breakage.** Every version your advisory
   covers becomes uninstallable by default, worldwide, within hours. If the ranges
   sweep in versions that were never vulnerable, users of those versions face failing
   builds, and their bug reports will land in *your* inbox. This is not hypothetical:
   for a PHPUnit advisory in April 2026, GitHub silently rewrote the carefully
   specified affected versions (`12.5.21` and `13.1.5`) into broad ranges, which made
   every older PHPUnit version uninstallable overnight, including all of PHPUnit 11,
   which was never affected. The full timeline is documented in [The Bouncer in the
   Dependency Resolver](https://phpunit.expert/articles/the-bouncer-in-the-dependency-resolver.html#a-real-world-example).
3. **Know the correction path.** Packagist aggregates advisories from the GitHub
   Advisory Database *and* from
   [`FriendsOfPHP/security-advisories`](https://github.com/FriendsOfPHP/security-advisories),
   and the FriendsOfPHP data takes precedence. If the published affected-version data
   is wrong (whether through your own mistake or an edit on GitHub's side), a pull
   request to FriendsOfPHP/security-advisories with the correct constraints is the
   fastest way to fix what Composer actually enforces, alongside a correction PR to
   the [GitHub Advisory Database](https://github.com/github/advisory-database).

The flip side is worth telling your *users* about, too (in your announcement or your
documentation): with a current Composer, they are protected by default, and
`composer audit` in CI tells them when an already-locked version has since gained an
advisory.

The rest of the form:

- **Title:** one line, specific, no drama. "SQL injection in report export via
  `sort` parameter" beats "Critical security issue".
- **Description:** enough for a user to understand *whether they are affected* and
  *what to do* (upgrade to which version; workaround if one exists). Aim for the
  middle ground: too much detail hands attackers a ready-made exploit, too little
  starves the tools and the humans reading it. You do not need to include the PoC.
- **CWE:** pick the closest weakness class. The reporter's suggestion is usually right.
- **CVSS / severity:** score honestly. If required conditions lower the practical
  severity (authentication needed, non-default configuration), reflect that in the
  vector rather than in an argument in the description. If CVSS makes your eyes glaze
  over, ask; scoring help is a two-minute favor for the Ecosystem Security Team.
- **CVE:** request a CVE ID through GitHub from the advisory (GitHub is a CNA and
  this is the normal path for Composer packages). Request it once you have *accepted*
  the report: not before you are sure it is valid, and not in a scramble at
  publication time. If a coordinating party such as a CNA has already reserved a CVE
  for this issue, use *"I have an existing CVE ID"* instead of requesting a second one.
- **Credit:** add the reporter (and anyone who helped) in the credits section. It
  costs you nothing and it is a large part of what makes responsible reporting worth
  a researcher's while.

## 7. Coordinate the release and publication

*You are here if: fix ready, advisory drafted, everyone in the private thread agrees.*

Order matters. On the day you have chosen:

1. **Merge** the fix from the private fork.
2. **Tag and release** the fixed version(s), and confirm the release actually shows
   up on Packagist before continuing.
3. **Publish the advisory.** From this moment the vulnerability is public, which is
   fine, because the fix already is too.
4. **Announce** through your normal channels (release notes, Mastodon, Discord, blog),
   linking to the advisory. Keep it factual: what the issue is, who is affected, which
   version to upgrade to.

The gap between step 2 and step 3 should be minutes to hours, not days: a public fix
without an advisory is a window in which attackers can diff your release while your
users have no warning to upgrade.

Two coordination notes:

- If the report came through a coordinator (such as the Ecosystem Security Team or a
  CNA), agree on the publication date with them in advance so CVE publication and any
  wider announcement can happen in step.
- If details leak early (someone tweets, a public issue appears, you spot the bug
  being discussed), the embargo is effectively over. Publish what you have as soon as
  possible, even if the situation is not as tidy as you wanted.

## 8. Wrap up

*You are here if: the advisory is published and the adrenaline is fading.*

- **Verify the pipeline worked:** the advisory appears in the GitHub Advisory
  Database, `composer audit` flags the vulnerable version in a test project, and
  Dependabot alerts fire where expected. If matching does not work, the ecosystem or
  package-name field is the usual suspect ([§6](#6.-write-the-github-security-advisory)).
- **Verify the blocking is not too eager:** in a scratch project, check that the
  *fixed* version and unaffected release series still install and update cleanly.
  Compare the affected-version ranges shown in the [GitHub Advisory
  Database](https://github.com/advisories) against what you wrote (they have been
  known to change during publication), and keep an eye on your issue tracker for
  "cannot install version X" reports in the first days after publishing. The
  correction path is described in [§6](#composer-blocks-the-versions-your-advisory-lists).
- **Thank the reporter** once more, in public if they are comfortable with that.
- **Check your other supported branches** one final time; it is easy to patch the
  current major and forget the LTS branch.
- **Hold a fifteen-minute retrospective with yourself:** How did this bug get in?
  Would a static analyzer, a stricter type, or a test convention have caught it? Is
  there a *class* of similar bugs to sweep for? One structural improvement per
  incident compounds quickly.

## 9. Improving your security posture for the long term

*You are here if: the storm has passed and you want the next one to be smaller. This
section is also the right starting point if no report has arrived yet and you simply
want to prepare.*

You do not need to do all of this in one weekend. The list is roughly ordered by
value-for-effort; even the first three items put you ahead of most projects.

**Make it easy to report to you**

1. **Enable GitHub Private Vulnerability Reporting** (repository → Settings →
   Advanced Security → Private vulnerability reporting → Enable). Without it,
   reporters must choose between emailing you cold and opening a public issue, and
   some will choose the public issue.
2. **Add a `SECURITY.md`** stating how to report (ideally: "use private vulnerability
   reporting on this repository"), which versions you support with security fixes,
   and roughly what response time to expect. Three honest sentences beat a page of
   boilerplate.
3. **Watch your own security tab.** Enable notifications for security advisories and
   Dependabot alerts on your repositories, so the next report does not sit unseen for
   months.

**Protect your accounts and releases**

4. **Strong 2FA/MFA everywhere that can publish:** GitHub, Packagist, your email
   account (which can reset the other two). Prefer passkeys or hardware keys over SMS.
   Audit who else has publish rights and remove stale access. On Packagist this is
   becoming a visible property of your packages, not just private hygiene:
   [Packagist.org will surface maintainer MFA status publicly](https://blog.packagist.com/an-update-on-composer-packagist-supply-chain-security/)
   in its transparency log and on profiles, with mandatory MFA as the stated
   long-term direction. Most of the recent supply-chain attacks in the PHP ecosystem
   began with a taken-over maintainer account.
5. **Protect your release path:** branch protection on `main`, tag protection for
   release tags, and no long-lived personal access tokens with broad scopes lying
   around in CI secrets or on disk.
6. **Never re-tag a released version.** If a release has a problem, ship a new
   version; do not overwrite the tag. Mirrors, scanners, and lock files already hold
   copies of the original, and two variants of "the same" version circulating is a
   mess your users cannot untangle. Packagist.org now
   [enforces this](https://blog.packagist.com/an-update-on-composer-packagist-supply-chain-security/):
   stable versions are immutable, and upstream re-tagging is detected and rejected,
   not least because silently rewritten tags were the core move in recent attacks on
   compromised packages.

**Reduce your attack surface**

7. **Delete what does not need to exist.** Every branch in your repository is a door:
   a target for pull requests that carry along modified workflow files, build
   scripts, or configuration the pipeline will happily execute. This class of attack
   is known as [Poisoned Pipeline Execution](https://owasp.org/www-project-top-10-ci-cd-security-risks/CICD-SEC-04-Poisoned-Pipeline-Execution)
   (OWASP CICD-SEC-4). A branch that does not exist cannot receive a poisoned pull
   request, and no wall you build protects better than the door that was never built.
   Review your branches and remove stale experiments, leftovers from old sprints,
   and "we might still need this" remnants. The same goes for unused workflows,
   third-party actions, and permissions nobody questions anymore. See [The attack
   surface begins in the
   repository](https://phpunit.expert/articles/the-attack-surface-begins-in-the-repository.html)
   for the full argument, including real-world PPE incidents from SolarWinds to
   PyTorch.

**Harden your automation**

8. **Treat your workflow files as security-relevant code.** They run with
   credentials, network access, and write permission to your repository. The five
   weakness classes that show up almost everywhere, PHPUnit's own workflows included
   (52 findings before hardening, zero after):
   - **Template injection:** never interpolate {% verbatim %}`${{ ... }}`{% endverbatim %} expressions (branch
     names, PR titles, and other attacker-controllable values) directly into shell
     scripts; pass them through `env:` variables instead. This is the GitHub Actions
     equivalent of SQL injection.
   - **Credential persistence:** set `persist-credentials: false` on
     `actions/checkout`, so the workflow token does not sit in `.git/config` for
     every later step (or exfiltrated artifact) to read.
   - **Unpinned actions:** pin every action to a full commit SHA with the tag as a
     comment. A floating tag like `@v4` can be repointed at malicious code by anyone
     who compromises the action, which is exactly how the `tj-actions/changed-files`
     attack reached 23,000 repositories. Let Renovate or Dependabot keep the SHAs
     current.
   - **Overly broad permissions:** set `permissions: {}` at the workflow level and
     grant minimal scopes per job, with a comment explaining each grant.
   - **Unnecessary third-party actions:** if the runner's built-in tooling (e.g. the
     `gh` CLI) can do the job, drop the wrapper action. Every action is more code
     running next to your secrets.

   You do not need to memorize this list: run [zizmor](https://docs.zizmor.sh/)
   against `.github/workflows`, fix what it finds, and add it to CI so regressions
   are caught immediately. The worked example (each weakness, its exploit, its fix)
   is in [Hardening GitHub Actions
   workflows](https://phpunit.expert/articles/hardening-github-actions-workflows.html).
   Be especially careful with the `pull_request_target` and `workflow_run` triggers,
   which run with the base repository's permissions against fork contributions.
9. **Run `composer audit` in CI** so you learn about vulnerable dependencies from
   your pipeline rather than from your users, and know that with a current Composer,
   your users' resolvers block advisory-affected and malware-flagged versions of
   *your* dependencies too ([§6](#composer-blocks-the-versions-your-advisory-lists)).
   Add a static analyzer (PHPStan or Psalm) at a level that at least catches the
   classics: unvalidated input flowing into queries, file paths, or `unserialize()`.

**Build habits**

10. **Keep an isolated reproduction environment ready** ([§4](#4.-handle-proof-of-concept-code-safely)),
    so that "spin up the VM" is a two-minute routine rather than a reason to take the
    dangerous shortcut.
11. **Treat security reports as a normal category of work,** with the small process
    from this guide, rather than as emergencies. The calmer the routine, the better
    every individual case goes.
12. **Know who to call.** Which brings us to the final section.

## 10. Getting help

You never have to work through any of this alone. The **PHP Foundation Ecosystem
Security Team** exists precisely to support maintainers like you: with triage,
reproduction of findings in isolated environments, impact analysis, deduplication of
report floods, fix validation, severity scoring, and coordinated disclosure. Asking
early is always better than guessing; there is no question too basic.

- **Email:** [volker@thephp.foundation](mailto:volker@thephp.foundation)
  (Volker Dusch, Ecosystem AI Security Engineer in Residence at the PHP Foundation)
- **Discord:** `#ecosystem-security` on the phpc community server
  ([invite](https://discord.com/invite/RYajXKxuuK)), where Volker is `@edorian`
- **Background on the team:**
  [Announcing the Ecosystem Security Team](https://thephp.foundation/blog/2026/05/18/announcing-ecosystem-security-team/) ·
  [One Month of Ecosystem Security Engineering](https://thephp.foundation/blog/2026/06/23/one-month-of-ecosystem-security-engineering/)

### Further reading

- [The Maintainer's Guide to GitHub Security Advisories](https://alpha-omega-security.github.io/maintainers-security-advisory-guide/)
  (Alpha-Omega): the in-depth, ecosystem-agnostic companion to this document, with a
  cheatsheet, FAQ, and workarounds for GitHub platform limitations
- [GitHub Docs: Privately reporting a security vulnerability](https://docs.github.com/en/code-security/security-advisories/guidance-on-reporting-and-writing-information-about-vulnerabilities/privately-reporting-a-security-vulnerability)
- [GitHub Docs: Creating a repository security advisory](https://docs.github.com/en/code-security/how-tos/report-and-fix-vulnerabilities/fix-reported-vulnerabilities/create-repository-advisory):
  the click-by-click walkthrough of the advisory form, including the CVSS
  calculator and credit types
- [GitHub Docs: Best practices for writing repository security advisories](https://docs.github.com/en/code-security/tutorials/fix-reported-vulnerabilities/write-security-advisories):
  the reference for ecosystem, package name, and affected-version syntax,
  including operators and prerelease-suffix pitfalls
- [Composer: `composer audit`](https://getcomposer.org/doc/03-cli.md#audit) and the
  [dependency policy configuration](https://getcomposer.org/doc/06-config.md#policy)
- [The Bouncer in the Dependency Resolver](https://phpunit.expert/articles/the-bouncer-in-the-dependency-resolver.html)
  (Sebastian Bergmann): how Composer's advisory and malware blocking works under the
  hood, including a real-world case of an advisory blocking too much
- [An update on Composer & Packagist supply chain security](https://blog.packagist.com/an-update-on-composer-packagist-supply-chain-security/)
  and the [Composer 2.10 release announcement](https://blog.packagist.com/composer-2-10-release/)
  (Packagist): the current state and roadmap covering dependency policies, version
  immutability, the transparency log, and MFA
- [The attack surface begins in the repository](https://phpunit.expert/articles/the-attack-surface-begins-in-the-repository.html)
  and [Hardening GitHub Actions workflows](https://phpunit.expert/articles/hardening-github-actions-workflows.html)
  (Sebastian Bergmann): Poisoned Pipeline Execution and the concrete workflow
  weaknesses behind [§9](#9.-improving-your-security-posture-for-the-long-term)
- [CWE (Common Weakness Enumeration)](https://cwe.mitre.org/) and
  [CVSS (Common Vulnerability Scoring System)](https://www.first.org/cvss/)
- [EEF CNA Maintainer Process](https://cna.erlef.org/maintainer-process): the Erlang
  ecosystem's equivalent process, a model for this guide

---

*This is a living guide. If anything was unclear, took too long to figure out, or
turned out to be wrong in practice, please tell us; that feedback directly improves
the experience of the next maintainer. Reach us at the addresses in
[§10](#10.-getting-help), or edit this page on GitHub via the link below.*
