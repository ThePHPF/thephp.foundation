---
title: "One Month of Ecosystem Security Engineering"
layout: post
tags:
    - security
    - SIGs
author:
  name: Volker Dusch
  url: https://de.linkedin.com/in/volker-dusch
published_at: 22 June 2026
---

Last month I shared with you that, thanks to the PHP Foundation, we were able to secure a [grant by Alpha-Omega through the Linux Foundation](https://thephp.foundation/blog/2026/05/18/announcing-ecosystem-security-team/) that allows us to help improve the security of the PHP open source ecosystem. Today I want to update you on the progress so far.

After getting set up with the role, I quickly jumped into three main topics: assess people's most pressing needs, assemble a team of volunteers for help and start using the tools and resources we’ve been given to scan projects. From there it was figuring out collaborative toolchains, access, budgets, reporting, and effective ways to distribute findings and support maintainers.

From talking to 35 project maintainers about our project scanning efforts and the security concerns they have, we shared hundreds of potential findings, leading to nearly a hundred fixes across the ecosystem already, and many great and useful conversations.

What I didn’t include in these numbers are mass fixes of the same finding across many repos. For example, in one case, we had around 200 repos apply the same fix to their GitHub Actions as they are managed via a central template. I didn’t want to inflate the numbers so these instances are counted as “one” fix.

In total, we scanned and rescanned over 300 of the most downloaded Composer packages and nearly all big frameworks, got in touch with maintainers or found people to jump in and help address findings where that was needed.

I want to extend a personal thanks to [Graham Campbell](https://github.com/grahamcampbell ), who has been very helpful in getting me started with ideas and initial issue validation in the first couple of days of my new role and who’s continued to be responsive and helpful with solving issues in other projects.  


## Current efforts

To best make use of the resources we’ve been given, project scanning continues at a steady pace. Using the access to AI models and extended “Cyber” capabilities we’ve been given to not only find, but also help triage and reproduce issues, help with impact analysis and, where needed, fixes.

I will continue to talk to everyone who approaches me while working to ensure there is a steady flow of public-facing communication to ensure people know what’s going on.

All maintainers that approached me so far were kind enough to offer to validate the tooling's findings themselves; meaning I could focus on generating reproducers and letting the experts figure out if something is a security issue, a bugfix, or an invalid report, with the maintainers doing their own reporting and disclosure on their terms and in a way that fits their timeline.

I’m personally delighted by the great community response, both quantitatively and qualitatively, nearly everyone has been supportive and with only one negative maintainer interaction and one person we’re still looking to get in touch with, I couldn’t be happier with the maturity, readiness and friendliness of the wider community. I didn’t expect anything else from PHP, but it’s great to be proven right. 

I want to highlight three areas of work going forward, automated scanning, custom efforts and the volunteers that gathered around this effort so far.


### Shared tooling: Scrutineer

When scanning many projects, one challenge is to scale that effort, get reproducible and reliable outputs, avoid false positives, and use the resources we have effectively without duplicating work, all while allowing each person that does the scanning to run multiple agents in parallel without human interaction during the initial scanning process. This work should also be done in containerized environments that ensure the infrastructure we use for scanning is secure.

To pool our efforts, we are working with the Security Engineers from other languages and the Team at Alpha-Omega on shared tooling that allows for that.

The tool in question is [https://github.com/alpha-omega-security/scrutineer](https://github.com/alpha-omega-security/scrutineer/pulls) and here I want to give a special shoutout to [Alexandre Daubois](https://github.com/alexandre-daubois) from [les-tilleuls.coop](http://les-tilleuls.coop) as the work he is doing there is proving very valuable.

Not only does this enable us to have more structured results and an easier reporting process, it also helps to get scanning work by people with access to different, otherwise unavailable, models or more resource capacity. Using Scrutineer this way we can tailor the used containers towards the PHP ecosystem to improve the quality of the results by allowing the tooling to create and validate reproducers easily. Without these feedback loops, the report quality would be drastically lower and require more clean-up work.


### Custom work

The other big goal we started out with is to be available for helping projects and maintainers with digesting reports, creating reproducers, deduplicating findings and suggesting and validating fixes.

When getting started with the role, I was not sure how many projects would reach out regarding these problems. What I’m hearing these days is that the quality of reports they are getting has been going up significantly in the last couple of months, so I’ve not been getting many requests.  From talking to maintainers about the topic, many use their own coding agents to validate and reproduce these findings effectively, but sometimes, for more complex issues, the path from a potential vulnerability to an exploit can be something that currently available models don’t find or refuse to help with; in these cases, I could be of help.

Additionally, sometimes, the automated scanning doesn’t produce clean results or the threat modeling or attack vectors are not clear enough, in these cases I spend time with each project to better understand what the models should be assessing and steer them in that direction.

A special mention here is the PHP project itself. Due to its popularity, it’s always been a place for many people to try their new security tooling out. With agentic security approaches, the nature as a programming language and the inherent complexity that comes with it make it so that the average lower quality is a lot lower, and that reports are harder to digest there than they are in userland libraries with a clearer threat model and surface.

I wasn’t able to do much for PHP itself yet due to time constraints, and will hopefully be working on that more in the coming months. The communication with the team is great and I’m eager to get properly started and see where I can be of help there.


### Assembling a team

We want this effort to be sustainable past the 6 months of the grant, and I was delighted to see that the Foundation is launching [Community Special Interest Groups](https://thephp.foundation/blog/2026/06/11/integrating-community-feedback-into-foundation-strategy-part2/#community-special-interest-groups). We started assembling a team around the security and maintainer support efforts.

If you want to reach out and talk with like-minded people about security, you can find a couple of us in the #ecosystem-security channel on the [phpc Discord](https://discord.com/invite/RYajXKxuuK), who were kind enough to have a channel for us and #the-php-foundation in general. I’m “@edorian” on there, if you want to say hi.

For sensitive topics, you can always [get in touch](https://thephp.foundation/blog/2026/05/18/announcing-ecosystem-security-team/#:~:text=Get%20in%20touch%20via%20email%3A%20volker%40thephp.foundation.) with me directly.

Next to Alexandre, who I already mentioned above, a name I’ve been coming across a lot when talking to maintainers was Ilia Alshanetsky. Ilia has been doing a lot of independent work and I asked him to join so we can better coordinate efforts.


### Challenges

The first couple weeks of the new role have been a rather dynamic affair, from [uncertainties around model access](https://www.anthropic.com/news/fable-mythos-access) and scanning budget, to coordinating with the SEIRs (Security Engineers in Residence) from other languages and finding ways of collaboration and setting ourselves shared goals to the vastness of our own ecosystem and getting in touch with everyone to pausing my previous job to make time for this effort, the work has been interesting. I want to especially thank the folks at [Alpha-Omega](https://alpha-omega.dev/) and Elizabeth Barron, Nils Aderman and Benjamin Eberlei who have been a massive help in making this process easy and quick so I could jump directly into the work.  


## Looking ahead

To summarize the goals I set myself for the next month:

* Scan another 250 projects and report all collected findings
* Perform a dedicated, deeper analysis of core projects and libraries
* Spend more time helping out with php-src and PHP Extensions issues

I will continue to be available for help for any project maintainers that are reaching out.


### Get in touch

To repeat what was already mentioned above: we have capacity for scanning and helping more maintainers.

Discord: [https://discord.com/channels/356354025865740288/1507370983013744681](https://discord.com/channels/356354025865740288/1507370983013744681)

Email: [volker@thephp.foundation](mailto:volker@thephp.foundation)
