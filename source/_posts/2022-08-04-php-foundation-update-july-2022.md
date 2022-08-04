---
title: PHP Foundation Update, July 2022
layout: post
tags:
    - update
author:
    name: Roman Pronskiy
    url: https://twitter.com/pronskiy
published_at: 4 August 2022
---
```<?php echo 'Hello world!';```

Last month, the PHP foundation members continued the work on PHP 8.2 release and more. We are prepared to give a few talks this autumn. Also, besides core developers, we have a growing community of volunteers who help the PHP foundation. Read on to learn more.


## Meet us at the conferences

This autumn, you will be able to talk to the foundation administration members and developers at real-life events!

**[Forum PHP, Paris – October 13-14](https://event.afup.org/afup-day-2022/)**

**Sebastian Bergmann and Roman Pronskiy** will give a talk about the past, the present, and the future of PHP. They will share the status of the Foundation, what has been accomplished in the first year, share some plans, and, of course, answer questions and expect feedback.

<blockquote class="twitter-tweet"><p lang="en" dir="ltr">I look forward to talk about <a href="https://twitter.com/ThePHPF?ref_src=twsrc%5Etfw">@ThePHPF</a> at <a href="https://twitter.com/afup?ref_src=twsrc%5Etfw">@afup</a> <a href="https://twitter.com/hashtag/ForumPHP?src=hash&amp;ref_src=twsrc%5Etfw">#ForumPHP</a> together with <a href="https://twitter.com/pronskiy?ref_src=twsrc%5Etfw">@pronskiy</a>!<br><br>We’re eager to answer your questions and look forward to hearing your suggestions! <a href="https://t.co/2x8id0mDZ5">pic.twitter.com/2x8id0mDZ5</a></p>&mdash; Sebastian Bergmann (@s_bergmann) <a href="https://twitter.com/s_bergmann/status/1544184297115947010?ref_src=twsrc%5Etfw">July 5, 2022</a></blockquote>

<br>

**George P. Banyard**, one of the PHP Foundation’s developers, will talk about PHP’s type system internals.

<blockquote class="twitter-tweet"><p lang="fr" dir="ltr">Nous sommes ravis d&#39;accueillir pour la première fois <a href="https://twitter.com/Girgias?ref_src=twsrc%5Etfw">@Girgias</a>, jeune et talentueux core-contributeur à PHP, pour un talk sur les rouages du typage lors du Forum PHP 2022.<br>🎤 &quot;Typage en PHP comment ça fonctionne ?&quot; - Forum PHP 2022 - 13&amp;14/10, Disneyland Paris <a href="https://t.co/dB0pWflmKB">pic.twitter.com/dB0pWflmKB</a></p>&mdash; AFUP (@afup) <a href="https://twitter.com/afup/status/1546423801998708736?ref_src=twsrc%5Etfw">July 11, 2022</a></blockquote>

<br>

**[SymfonyCon, Paris – November 17-18](https://live.symfony.com/2022-paris-con/)**

At this conference, you’ll be able to catch up with Sebastian Bergmann, Roman Pronskiy, and Nicolas Grekas.

**[International PHP Conference, Munich – October 23-24](https://phpconference.com/)**

Sebastian Bergmann and Derick Rethans will each talk at the IPC this year.

_Where else would you like to see us?_


### **Swag!**

By the way, we’d like to have stickers and other swag for conference attendees. If you would like to help with the design or sponsor the production, please reach out to [contact@thephp.foundation](http://contact@thephp.foundation).


## Website updates

Thanks to Sergey Panteleev, one of the PHP 8.2 release managers, we have a few nice additions to our website.



* A new **[structure page](https://thephp.foundation/structure/)** where you can see all the people currently actively involved in the PHP Foundation activities.
* Every post has a nicely generated preview image — please, share the links to the PHP Foundation to help spread the word.

The [website is open-source](https://github.com/ThePHPF/thephp.foundation) and built with [Sculpin](https://github.com/sculpin/sculpin) and [Tailwind CSS](https://tailwindcss.com/). So if you stumbled upon a bug, please do not hesitate to report or submit a PR.


## PHP Core Roundup

In July, we marked the feature-freeze for PHP 8.2, and this next version of PHP is being shaped by PHP Foundation members and all the contributors to be an exciting release!

Catch up to this month's PHP Core changes on the **[PHP Core Roundup #4](https://thephp.foundation/blog/2022/07/28/php-core-roundup-4/)** post by Ayesh, where you can find a detailed log of what's been done and discussed regarding the PHP engine.

**What if our proposal did not make it?**

Among many fixes and improvements, some suggestions did not pass the RFC voting barrier. For instance, that happened to the [Short Closures 2.0](https://wiki.php.net/rfc/auto-capture-closure) proposal.

We consider this a good experience in any case, and developers might reconsider, improve, and suggest it in the next release cycle, i.e., PHP 8.3.

We also consider it to be a good thing that it's difficult to change the language, as these changes are forever.

**What about deprecations?**

PHP has a long 25-year history, and no wonder it has some old quirks. One of them relates to DateTime and DateTimeImmutable confusion.

Derrick Rethans, a core developer of the PHP Foundation, asks for an opinion about in which way this confusion should be resolved; if it should:

<blockquote class="twitter-tweet"><p lang="en" dir="ltr">Making PHP&#39;s DateTime class mutable was one of the bigger mistakes of the Date/Time APIs. I&#39;m considering to change DateTime to be immutable by default in PHP 9, and to drop DateTimeImmutable altogether (or make it an alias). This is likely going to break some code. Opinions?</p>&mdash; Derick Rethans (@derickr) <a href="https://twitter.com/derickr/status/1551611856007069696?ref_src=twsrc%5Etfw">July 25, 2022</a></blockquote>

Let Derick know what you think.

> You can find more insights on PHP core development process in&nbsp;**[PHP&nbsp;Roundup&nbsp;Series](https://thephp.foundation/blog/tag/roundup/)**.
> 
> Tweet at us: [@ThePHPF](https://twitter.com/thephpf), [@Ayeshlive](https://twitter.com/Ayeshlive), [@pronskiy](https://twitter.com/pronskiy).

<br>

## Thank you to our sponsors

This month we are glad to welcome a new major sponsor who joined the PHP Foundation’s sponsors herd:

**[Cybozu, Inc](https://opencollective.com/cybozu)**

Thank you for supporting PHP!

Shout-out to [everyone](https://thephp.foundation/#sponsors) for your continued support – the PHP Foundation is all of us!

---
<br>

That’s all for today. Follow us on Twitter [@ThePHPF](https://twitter.com/thephpf) to get the latest updates from the Foundation.

💜🐘

<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
