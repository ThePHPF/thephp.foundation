---
title: "One Month of Ecosystem Security Engineering"
description: "A first-month update on the PHP Foundation's ecosystem security work"
layout: post
tags:
    - security
    - SIGs
author:
  name: Volker Dusch
  url: https://de.linkedin.com/in/volker-dusch
published_at: 22 June 2026
---

Last month I shared with you that the PHP Foundation secured a [grant by Alpha-Omega through the Linux Foundation](https://thephp.foundation/blog/2026/05/18/announcing-ecosystem-security-team/) to help improve the security of the PHP open source ecosystem, and that it is forming a new Ecosystem Security Team. Today I want to update you on the progress so far.

After a brief set-up period, I jumped into three main activities:

- assessing PHP community members' most pressing needs
- assembling a team of volunteers to help
- applying the resources granted to scan PHP ecosystem projects

Setup included getting started with building collaborative toolchains, ensuring access to scanning budgets and models, defining our metrics for reporting, and identifying effective ways to distribute security vulnerability findings and to support maintainers.

So far we talked to 35 project maintainers about our project scanning efforts and the security concerns they have. We shared hundreds of potential security vulnerability findings, leading to nearly a hundred publicly available fixes across the ecosystem already, and many great and useful conversations.

Additionally there were mass fixes of the same finding across many repositories. For example, in one case, we had around 200 repositories apply the same fix to their GitHub Actions as they are managed via a central template. I didn’t want to inflate the numbers so these instances are counted as a single fix.

In total, we scanned and rescanned over 300 of the most downloaded Composer packages and nearly all big frameworks. We got in touch with the respective maintainers or found people to jump in and help address security vulnerabilities where that was needed.

I want to extend a personal thank you to [Graham Campbell](https://github.com/grahamcampbell), who has been very helpful in getting me started with ideas and initial issue validation in the first couple of days of my new role and who has continued to be responsive and helpful with solving issues in other projects.  


## Current efforts

Project scanning for security vulnerabilities continues at a steady pace to make the most use of the resources we've been provided with. We do not only search for vulnerabilities, but also help triage, reproduce issues, help with impact analysis, and where necessary supply fixes by using our access to AI models and their extended “Cyber” capabilities.

I will continue to talk to everyone who approaches me while providing a steady flow of public-facing communication about our efforts.

All maintainers who approached me so far were kind enough to offer to validate the generated findings themselves. I was able to focus primarily on generating reproducers and letting the experts figure out whether a particular finding represents a security issue, a bugfix, or an invalid report. The maintainers in these cases were handling their own reporting and disclosure on their own terms and in a way that fits their timeline.

I’m personally delighted by the great community response, both quantitatively and qualitatively: Nearly everyone has been supportive and I encountered only one negative maintainer interaction and one person we are still looking to get in touch with. I couldn’t be happier with the maturity, readiness and friendliness of the wider community. I didn’t expect anything else from PHP, but it’s great to be proven right.


### Shared tooling: Scrutineer

When scanning many projects, we face challenges: Getting reproducible and reliable outputs, avoiding false positives, and using our resources effectively without duplicating work, all while allowing each person scanning to run multiple agents in parallel without human interaction during the initial scanning process. Security analysis needs to be performed in isolated containerized environments that keep the infrastructure we use for scanning secure.

To pool our efforts, we are working with the Ecosystem Security Engineers from other languages and the Team at Alpha-Omega on shared tooling for this purpose. Specifically we're collaborating on [Scrutineer](https://github.com/alpha-omega-security/scrutineer). I want to give a special shout out to [Alexandre Daubois](https://github.com/alexandre-daubois) from [Les-Tilleuls.coop](https://les-tilleuls.coop). His contributions to Scrutineer have been very valuable in enabling more people to effectively scan PHP projects.

Scrutineer enables more structured results and an easier reporting process. It also helps to let people with access to different, otherwise unavailable, AI models, or with access to more resource capacity, scan projects on our behalf. Using Scrutineer we can tailor the containers used for analysis towards the PHP ecosystem to improve the quality of scanning results through tooling to create and validate reproducers. The report quality would be drastically lower and require more clean-up work without effective automated feedback loops.


### Helping projects with individual approaches

We help projects and maintainers digest reports, create reproducers, deduplicate security vulnerability findings, and suggest and validate fixes.

When I accepted my new role, I was unsure how many projects would reach out for help with these tasks. I've received feedback that the quality of reports maintainers are receiving has gone up significantly in the last couple of months. So I've not received many requests to assist with processing reports and proposed fixes. Many maintainers report that they use their own coding agents to validate and reproduce received security vulnerability findings effectively. But for some more complex issues, currently available AI models cannot help or refuse to help with working on an exploit for a potential vulnerability. In these cases, I can be of help.

Sometimes, the automated scanning doesn’t produce clear results or the threat modeling or attack vectors are not clear enough. In these cases, I spend time with each project to better understand what the AI models should be assessing and steer them in that direction.

A special mention here is the PHP project itself: Many people like to try their new security tools on PHP, due to its popularity. The inherent complexity of a programming language runtime results in significantly lower quality results from agentic security approaches. The reports the PHP project receives are harder to digest than they are in userland PHP libraries with a clearer threat model and attack surface.

I was not yet able to help PHP itself much so far, due to time constraints. I intend to work on core PHP a lot more in the coming months. The communication with the PHP core developer team is great and I’m eager to get properly started and see where I can help them.


### Assembling a team

I was delighted to see that the PHP Foundation is launching [Community Special Interest Groups](https://thephp.foundation/blog/2026/06/11/integrating-community-feedback-into-foundation-strategy-part2/#community-special-interest-groups). One of them is the Ecosystem Security Team, which the PHP Foundation wishes to sustain far beyond the 6 months of the initial grant funding, so I've begun to assemble a team around these security and maintainer support efforts.

If you want to reach out and talk with like-minded people about security, you can find a couple of us in the #ecosystem-security channel on the [phpc Discord](https://discord.com/invite/RYajXKxuuK). The [PHP Community Foundation](https://phpcommunity.org) was kind enough to create a channel for us and #the-php-foundation in general. I’m “@edorian” on there, if you want to say hi.

For sensitive topics, you can always [get in touch](https://thephp.foundation/blog/2026/05/18/announcing-ecosystem-security-team/#:~:text=Get%20in%20touch%20via%20email%3A%20volker%40thephp.foundation.) with me directly.

Next to Alexandre, who I already mentioned above, a name I’ve come across a lot when talking to maintainers was [Ilia Alshanetsky](https://github.com/iliaal). Ilia has been doing a lot of independent work and I asked him to join the Ecosystem Security Team so we can better coordinate our efforts.

## Looking ahead

The goals I set myself for the next month are:

* Scan another 250 projects and report all collected findings
* Perform a dedicated, deeper analysis of core projects and libraries
* Spend more time helping out with php-src and PHP Extensions issues

I will continue to be available to help any project maintainers who reach out.


### Get in touch

To repeat what was already mentioned above: We have capacity to scan and help more maintainers.

Discord: [#ecosystem-security](https://discord.com/channels/356354025865740288/1507370983013744681) on the #phpc community server [(Invite)](https://discord.com/invite/RYajXKxuuK)

Email: [volker@thephp.foundation](mailto:volker@thephp.foundation)
