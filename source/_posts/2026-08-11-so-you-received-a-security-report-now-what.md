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
> Take a breath. **Nothing bad has happened.** A report is not a breach. It is a
> head start: someone is telling you privately about a potential problem. You have
> time to validate it, assess it, and you get to decide what to do next. This guide
> walks you through the whole process, and it ends with concrete steps to make your
> project more resilient for the next time.
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
6. **Write the advisory.** For Composer packages, three fields decide whether the
   tooling works: set the ecosystem to **Composer**, use the exact Packagist package
   name, and give precise affected-version ranges. Composer will actively **block**
   installation of the versions you list.
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
- **Do not** post the details on social media, a blog, or a mailing list, and be
  careful with vague teasers, which invite people to go looking. Announcing an
  upcoming security release is a legitimate practice that many projects follow, so
  that users can plan to update quickly; if you do it, keep the announcement to the
  date and the fact that a security release is coming, never the component, the
  symptom, or the versions involved.
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

> Thanks for the report. I've received it and will look into it as soon as I can.
> I maintain this project in my spare time. I'll get back to you here.

That is genuinely all it takes. If you already know you can keep a commitment, adding
a timeframe ("please allow up to two weeks for a first assessment") is a courtesy to
the reporter, but only promise what you can meet: "two weeks" kept is better than
"tomorrow" broken. If the report arrived by email but your
repository has [GitHub Private Vulnerability
Reporting](https://docs.github.com/en/code-security/security-advisories/guidance-on-reporting-and-writing-information-about-vulnerabilities/privately-reporting-a-security-vulnerability)
enabled (see [§9](#9.-improving-your-security-posture-for-the-long-term)), this is a
good moment to move the conversation there: it keeps the discussion and the patch in
one private place. Do not expect it to do your release planning, though — an advisory
has no field for an embargo or a disclosure date, so the timeline is something you and
the reporter agree on in the conversation and then keep to.

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
4. **Which versions are affected?** Including older major and minor versions that
   people still use.

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

Instead, reproduce in an **isolated, disposable environment**. The best one is the one
you will actually use, so start at the top of this list and only move down if the
issue demands it:

- **A microVM sandbox** is the sweet spot: roughly as convenient as a container, but
  running its own kernel instead of sharing the host's, so the boundary is enforced by
  hardware. [Docker Sandboxes](https://docs.docker.com/ai/sandboxes/) (`sbx`) gives
  each sandbox its own filesystem, network stack, and Docker daemon, with network
  access denied by default. Benjamin Eberlei describes [a ready-made sbx setup with
  PHP, Composer, and the usual
  extensions](https://www.beberlei.de/post/sbx-sandboxed-claude-complete-with-php-and-tools)
  that you can lift straight into this workflow.
- **A container** (Docker/Podman) is convenient for typical PHP-level issues and fine
  for most web-application-class vulnerabilities. How much isolation you get depends
  on where you run it: on Linux, containers share the host kernel, so anything that
  smells like memory corruption, native extensions, or kernel interaction deserves a
  stronger boundary. On macOS and Windows, Docker Desktop and OrbStack already run
  your containers inside a lightweight Linux VM, so a kernel boundary sits between the
  container and your actual machine.
- **A well-secured virtual machine** is the belt-and-braces option: a fresh VM with a
  current OS, no credentials or personal data inside, no shared folders into your host,
  clipboard sharing disabled, and a snapshot taken *before* you run anything so you can
  roll back afterwards. If the PoC does not need internet access, disable networking
  entirely, or restrict it to host-only.
- **A cloud throwaway** (a short-lived VM at any provider, destroyed afterwards) works
  too, as long as no credentials of yours live on it.

Inside the isolated environment, the workflow is simple: check out the affected
version of your project, install dependencies, run the PoC, observe. Read the PoC
before running it. Not as a substitute for isolation, but because understanding
*how* it triggers the bug is exactly the insight you need for the fix and for the
regression test. In fact, this is the natural moment to turn the reproducer into a
failing test ([§5](#5.-prepare-the-fix-privately)). Many maintainers treat "I have a
test that fails" as the point at which they accept a report, on the grounds that you
cannot accept what you cannot reproduce.

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

1. Do all of the work in the private fork and open the pull request **there**, never
   against your public repository.
2. **Write the regression test first.** A test that fails on the vulnerable code is
   the proof that you have really understood and reproduced the issue, and once the
   fix is in you can no longer watch it fail. If you built a reproducer during triage
   ([§4](#4.-handle-proof-of-concept-code-safely)), you already have most of it;
   distill it into a safe, minimal test case that demonstrates the *condition* rather
   than shipping a working exploit. This is the part of the work that keeps paying
   off: the bug can never quietly come back.
3. **Then write the fix**, and keep commit messages neutral while working; the
   advisory will tell the full story later. (Referencing the GHSA ID in the final
   commit is fine, since it only resolves to something public after publication.)
4. **Sweep for the same class of bug** before you go any further. Publishing an
   advisory puts a spotlight on that weakness class, for human readers and for the
   people pointing LLMs at your code, so you want to be reasonably confident that the
   same mistake is not sitting three files over, waiting to be found the day after
   you publish.
5. Invite the reporter as a collaborator on the advisory and let them verify the fix.
   They already have a working reproducer, so it costs them little. How much weight
   their confirmation carries is your judgement call: a researcher who handed you a
   precise reproducer is the best-qualified person to confirm the hole is closed,
   while a report generated in bulk by a tool is not.
6. Decide **which versions** get the fix. If you still support older major versions,
   users on those versions deserve a patched release too, or an explicit statement in
   the advisory that they must upgrade. Severity, the age of the older version, and
   the effort a backport would take should all feed into that decision.

Gotchas that bite first-timers:

- CI does not run in temporary private forks. Run your test suite locally (in a safe
  environment) before merging.
- Don't `git push --no-verify` out of habit. Hooks that scan for secrets or enforce
  checks exist for days exactly like this one.
- The temporary private fork **does not outlive the advisory**: depending on where you
  are in the process, publishing removes it, or GitHub asks you to delete it before it
  lets you publish. Either way, make sure everything you need (the commits, the
  discussion outcomes) has landed somewhere permanent first.
- **Do not fix silently.** A patch released without an advisory leaves every
  downstream user blind: `composer audit` won't warn them, Dependabot won't open a PR,
  and most people do not update their dependencies often, so they stay vulnerable
  until they happen to. The advisory is not an admission of failure; it is the
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
  A typo here silently breaks the matching. The check takes five seconds: append what
  you typed to `https://packagist.org/packages/` and it must land on your package,
  the way [packagist.org/packages/phpunit/phpunit](https://packagist.org/packages/phpunit/phpunit)
  does.
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
- **Patched version: the version you are about to release**, the one you want users to
  move to. It is what the tooling offers people as the way out, so it belongs in the
  form even though you have not tagged it yet at the time you draft the advisory.

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
2. **Overbroad version ranges cause real breakage.** Every version your advisory
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
  vector rather than in an argument in the description. Keep this in proportion,
  though: the score is far less important than the advisory itself. If CVSS makes your
  eyes glaze over, an LLM will produce a reasonable first vector for you, and the
  Ecosystem Security Team will happily check it; scoring help is a two-minute favor.
  Do not let the number hold up the publication.
- **CVE:** you can request a CVE ID through GitHub from the advisory (GitHub is a CNA
  and this is the normal path for Composer packages). Be clear about what it buys you.
  A CVE ID is a stable identifier for people outside your immediate ecosystem: Linux
  distributions shipping your code, corporate vulnerability management, other CNAs
  coordinating a shared issue. What actually protects the average user of your package
  is the GHSA, which is what Composer, `composer audit`, and Dependabot act on. CVE
  requests through GitHub currently take weeks to come back, so treat the ID as
  something that arrives when it arrives: request it once you have *accepted* the
  report, and never delay the fix, the release, or the advisory while waiting for it.
  If a coordinating party such as a CNA has already reserved a CVE for this issue, use
  *"I have an existing CVE ID"* instead of requesting a second one.
- **Credit:** add the reporter (and anyone who helped) in the credits section. It
  costs you nothing and it is a large part of what makes responsible reporting worth
  a researcher's while.

## 7. Coordinate the release and publication

*You are here if: fix ready, advisory drafted, everyone in the private thread agrees.*

Order matters. On the day you have chosen for your release, follow these steps:

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

- If the report came through a coordinator such as a CNA, agree on the publication
  date with them in advance so CVE publication and any wider announcement can happen
  in step. The Ecosystem Security Team does not normally ask you to coordinate your
  release with us; if a particular case ever calls for it, we will say so explicitly.
  We do not want to stand between a report and a fix.
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
  Would a static analyzer, a stricter type, or a test convention have caught it? The
  sweep for siblings of this bug should already be behind you at this point
  ([§5](#5.-prepare-the-fix-privately)); what you are looking for here is the one
  structural change that stops the whole class from recurring. One such improvement
  per incident compounds quickly.

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
3. **Watch your own security tab.** Two different things land there and both are worth
   a notification: *security advisories*, which is where a report about **your** code
   arrives, and *Dependabot alerts*, which tell you that a dependency **you** use has
   a published vulnerability. Make sure you are notified about both: watch the
   repository with security alerts enabled, and check the notification settings on
   your GitHub account, so that neither sits unseen for months.

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
   request, and no door protects better than the one that was never built.
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
   - **Template injection:** never interpolate
     {% verbatim %}`${{ ... }}`{% endverbatim %} expressions (branch names, PR titles,
     and other attacker-controllable values) directly into shell scripts; pass them
     through `env:` variables instead. This is the GitHub Actions equivalent of SQL
     injection.
   - **Credential persistence:** set `persist-credentials: false` on
     `actions/checkout`, so the workflow token does not sit in `.git/config` for
     every later step (or exfiltrated artifact) to read.
   - **Unpinned actions:** pin every action to a full commit SHA with the tag as a
     comment. A floating tag like `@v4` can be repointed at malicious code by anyone
     who compromises the action, which is exactly how the `tj-actions/changed-files`
     attack reached 23,000 repositories. Let Renovate or Dependabot keep the SHAs
     current.
   - **Overly broad permissions:** set `permissions: {}` at the workflow level and
     grant minimal scopes per job, with a comment explaining each grant. Set the
     baseline for the whole repository, too: under Settings → Actions → General →
     Workflow permissions, choose read-only, so that a workflow which forgets to
     declare `permissions:` does not start out with write access to your repository.
   - **Unnecessary third-party actions:** if the runner's built-in tooling (e.g. the
     `gh` CLI) can do the job, drop the wrapper action. Every action is more code
     running next to your secrets, and one more upstream that can be compromised to
     reach you.

   You do not need to memorize this list: run [zizmor](https://docs.zizmor.sh/)
   against `.github/workflows`, fix what it finds, and add it to CI so regressions
   are caught immediately. A full walkthrough, taking each weakness in turn with an
   example exploit and its fix, is in [Hardening GitHub Actions
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

*If anything here was unclear, took too long to figure out, or turned out to be wrong
in practice, please tell us; that feedback directly improves the experience of the
next maintainer. You can reach us at the addresses in [§10](#10.-getting-help).*
