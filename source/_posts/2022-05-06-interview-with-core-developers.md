---
title: Interview with Core Developers
description: The initial group of sponsored developers has now been "at it" for a month, and we thought that you might be interested in who they are and what they work on. I got the opportunity to (virtually) sit down with Derick Rethans, George Peter Banyard, Ilija Tovilo, Jakub Zelenka, and Máté Kocsis for an interview.
layout: post
tags:
    - interview
author:
    name: Sebastian Bergmann
    url: https://github.com/sebastianbergmann
published_at: 6 May 2022
---

The initial group of sponsored developers has now been "at it" for a month, and we thought that you might be interested in who they are and what they work on. I got the opportunity to (virtually) sit down with Derick Rethans, Gina Peter Banyard, Ilija Tovilo, Jakub Zelenka, Máté Kocsis, and Arnaud Le Blanc for an interview.

#### **Sebastian:** Let's start with a round of introductions. Who are you?

**George:** Hello, my name is Gina Peter Banyard. I'm studying pure mathematics at Imperial College London and expected to graduate in October. I'm half German, half British, but grew up in the south of France. During my free time I mostly watch anime or play puzzle games and Richii mahjong.

**Derick:** I am originally from the Netherlands but currently living and enjoying London in the United Kingdom. When I am not behind my computer I will be likely be walking in the countryside or site, with my trusty camera to commit these views to screen.

**Ilija:**  I am from Bern, Switzerland. I grew up here, but also have roots and relatives in Croatia. When I am not working, I enjoy spending time with family and friends, being in the sun, and listening to music. I also enjoy solving puzzles and playing chess.

**Jakub:** I am originally from Prague. I moved to the UK over 10 years ago. I work as a contractor and spend most of my free time with my family. I have got 2 dogs that I often walk.

**Máté:** I am a 31-year-old software developer, based in Hungary. Currently, I work for LastPass, and I am responsible for keeping our PHP backend modern as well as bringing it into the cloud. In my free time, I love riding my bike, walking, travelling. But my greatest hobby is certainly programming.

**Arnaud:** I live in France and work at a SaaS company doing awesome things with PHP. When I'm not working there or on PHP, I tend to be in front of my computer or on a bicycle.

#### **Sebastian:** What motivates you to work on Open Source?

**George:** This might be a strange answer, but I would say laziness. In the sense that if I like something from another project or language, I prefer going through the effort of adding that as a feature to what I already know and use instead of learning a whole new tool and ecosystem.

**Ilija:** Almost all commercial software is built on Open Source. I think that without Open Source, most tech companies could not exist as they do today. Contributing to Open Source is a way for me to give back for the professional opportunities Open Source has given me.

**Arnaud:** To me, Open Source is synonymous with flexibility and freedom. My motivation started maybe 20 years ago, when computers were still very magical to me, and I installed a Linux distro. At some point I discovered that I could download all the magic, hack it, fix it, improve it. This was incredible. Now I'm using mostly Open Source software, so working on Open Source is simultaneously a way to give back and to improve the software I'm using.

**Jakub:** Working on Open Source gives me opportunities to learn new things in a useful way and allows me to give back something to the projects that I use.

**Derick:** Originally it was a great way to learn how to do new things. Most of my early contributions to PHP were things that I needed myself. I have since then continued to scratch my own itch(es), but that has also resulted in me having to maintain some of the more popular projects, such as Xdebug.

**Máté:** My first "major" open source contribution was a tiny little feature in Composer. Then I created a few libraries which also gained some traction. Even considering the limited scale my projects achieved, it was a fantastic experience for me that I did my share to improve the PHP ecosystem, and at least a few people found my work useful. In contrast, being able to improve PHP itself day by day may make the life of millions of developers better, which is a truly satisfying feeling.

#### **Sebastian:** What was your first contribution to PHP?

**Máté:** I have been using PHP since I was 15, and I'm a longtime PHP internals reader. Since finding the mailing list, I have always dreamed about being able to contribute to PHP, even if it is a tiny little change. Then fast-forward to 2019, when Nikita started the so-called "[stubs initiative](https://externals.io/message/106522)". This was a perfect project to get started with my career. By submitting hundreds of PRs, I could learn a lot from Nikita and Christoph, among others, who tirelessly reviewed my code and helped when I was stuck.

**Derick:** Back in 2000, I first tried to add "sub query" support for MySQL. MySQL's query language did not support it, and I came up with a naive way of rewriting the query in C, by doing two queries. My first actual contribution was SWF support in the `getimagesize()` function, followed by adding libmcrypt 2.4 support to the mcrypt extension, which I also ended up mostly rewriting.

**Arnaud:** I first explored the PHP codebase because I needed to use the library of a 3rd party provider in a PHP project. I had to write a small extension. I remember that there was a blog post about `zval`s, it helped me a lot to get started. Later I uploaded another extension on PECL for inotify. After that, I don't remember the exact timeline. I think that I wanted to fix a bug, so I sent a patch on the bug tracker. I also found a TODO on the wiki and decided to go for it. This was in the PHP 5.x era.

**George:** I first started by contributing to the French translation of the PHP documentation before working on the English docs and making my way to php-src to change some very strange behaviour I discovered while maintaining the docs.

**Ilija:** I have been using PHP professionally for 6 years at that point and contributing has crossed my mind a few times. However, most features I could think of seemed daunting, especially since I did not have any experience with C. Then I saw this [tweet](https://twitter.com/nikita_ppv/status/1240309838950866946) from Nikita about how `throw` could be changed to be allowed in expressions. Being bored in the early COVID-19 days, I was looking for a distraction. This seemed simple enough so I gave it a shot. The actual change was a one-liner but there were issues with OpCache which required help from Nikita and others to solve (recurring theme). Nonetheless, this was enough to pull me in and motivate me to keep making RFCs.

**Jakub:** I used to work as a PHP developer and came across an extension for PHP called fann. As it did not really work, I refactored the whole extension. That taught me a bit about PHP's internals. Some time later I wanted to properly learn tools such as bison and re2c. At that time, there was a need for a new JSON parser for PHP due to licensing issues. So I wrote a new JSON parser and became a PHP core contributor.

#### **Sebastian:** What do you plan to work on in your time that is sponsored by The PHP Foundation?

**Máté:** First, I would like to finish my projects which I have already started: readonly classes (needs a successful RFC vote), converting resources to objects, adding constants to the stubs, and doing other groundwork for making our documentation more complete and easier to maintain. Then my plan is to improve the developer experience of the built-in extensions as well as continuing our efforts to make PHP a more consistent and reasonable language.

**George:** I plan to mainly work on the type system as well as refactoring extension code for clarity. For example, I want to continue the effort of converting resources to opaque objects.

**Ilija:** I have a few things that I would like to try to tackle: abstract data types, property accessors, type aliases, to name a few. My biggest goal is gaining a deep understanding of the code base ([increasing the bus factor](https://blog.krakjoe.ninja/2021/05/avoiding-busses.html)), helping with maintenance, and helping others to the same.

**Jakub:** I plan to primarily work on the maintenance and improvements in the areas that I have already been contributing to. Specifically, I would like to use roughly around 50% of my time on the FastCGI Process Manager (FPM), 20% on the OpenSSL extension, 10% on the JSON extension, 10% on the GnuPG extension, and the last 10% on streams as well as possibly other core parts.

**Derick:** To begin, I want to clean up all the date/time bugs and reports, dedicate time to fully understanding and assisting new RFCs, professionalising "security@", doing all the server admin tasks, and coming up with some new features such as perhaps a UString (Unicode String) class with all of its operations to have a much nicer interface compared to the clunky intl extension.

**Arnaud:** I want to help improve the language and its implementation. One feature that I would like to see in PHP is auto-capturing closures, so I'm working on the implementation for that right now. I also want to make some kinds of programming issues easier to debug. For example, some cases of uncontrolled recursion can lead to segmentation faults when the stack overflows, which is not helpful. Another is that memory exhaustion errors do not display a backtrace. I want to fix these kinds of issues, and bugs in general. I also have some interest in the optimizer and the JIT, so I've been fixing bugs in this area. Lastly, I hope to see generics in PHP, so I may want to work on this at some point.

**Sebastian:** Thank you for taking the time to answer my questions. I look forward to seeing your work make PHP better for everyone.
