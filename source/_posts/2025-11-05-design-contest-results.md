---
title: 'Design Contest Results and Lessons Learned'
layout: post
tags:
  - news
author:
  - name: Roman Pronskiy
    url: https://twitter.com/pronskiy

published_at: 5 November 2025

---

Over the last few weeks we ran a focused community contest to refresh the **PHP 8.5 release page**. Thank you to everyone who submitted, reviewed, voted, and discussed.

> **Note about future redesigns**  
> This contest was an experiment for a single release page. We might **not** use the same approach for a broader homepage redesign. If we did run a contest again, we would separate tracks (on-brand update vs blue-sky concept), use a dedicated voting tool or randomized ordering, keep log-damped voting, and set a 50/50 jury/community split with clearer criteria and a small shortlist honorarium.

## **Results**

### **Winner:** **Nuno Guerra [@nunowar](https://github.com/nunowar)** – [*PHP is Awesome 🔥*](https://github.com/php/web-php/issues/1539)

<a href="https://nunoguerra.com/dev/php/" target="_blank" rel="noopener noreferrer"><img src="/assets/post-images/2025/design-contest/nunowar.png" class="shadow-md rounded-lg"/></a>

**Prizes:** **$1,000  + AI Ultimate License from [JetBrains](https://www.jetbrains.com/phpstorm/)**·+ **$1,000 from [Rector](https://getrector.com/)**

At JetBrains, we decided to support other contestants with gifts as well.

### **Runner-up: Hanna Stelmakh [@hastelmakh](https://github.com/hastelmakh)** – [*PHP 8.5 Release Page Design Contest Submission*](https://github.com/php/web-php/issues/1534)

<a href="https://www.figma.com/proto/82kDxx1bh6ngC8Pv2Z2jUW/PHP-Release-8.5?page-id=0%3A1\&node-id=449-2387\&viewport=-7617%2C246%2C0.13\&t=f2P7pJOdSAEOKLDY-1" target="_blank" rel="noopener noreferrer"><img src="/assets/post-images/2025/design-contest/hastelmakh.png" class="shadow-md rounded-lg"/></a>

**Prize:** **$500 + AI Ultimate License from [JetBrains](https://www.jetbrains.com/phpstorm/)**

### **Shortlist:**

[@ben-joostens](https://github.com/ben-joostens)**,** [@tao](https://github.com/tao), [@lumnn](https://github.com/lumnn), [@thiagoolivier](https://github.com/thiagoolivier), [@mcpad2025-crypto](https://github.com/mcpad2025-crypto), [@minlivalievs-eng](https://github.com/minlivalievs-eng), [@giodi](https://github.com/giodi), [@everlastedSE](https://github.com/everlastedSE), [@asterd](https://github.com/asterd), [@ad-1984](https://github.com/ad-1984), [@Ayesh](https://github.com/Ayesh), [@StillMoe](https://github.com/StillMoe), [@KarinCheng](https://github.com/KarinCheng), [@christian-acceseo](https://github.com/christian-acceseo)

**Shortlist thank-you:** [**PhpStorm**](https://www.jetbrains.com/phpstorm/) **/ [AI Ultimate License](https://www.jetbrains.com/ai-ides/buy/) from JetBrains** for all shortlisted participants.

## **A little fun along the way** <img style="display:inline;" width="40" src="https://ftp.ntu.edu.tw/php/images/ele-running.gif"/>

Of course, no PHP contest would be complete without a bit of humor. Among all the serious submissions, one playful entry [from X/Twitter](https://x.com/jon_bossenger/status/1983140310826795201) stood out:

<a href="https://php-85-hyperactive.vercel.app/" target="_blank" rel="noopener noreferrer"><img src="/assets/post-images/2025/design-contest/php-85-hyperactive.png" class="shadow-md rounded-lg"/></a>

It didn’t quite meet the “accessible and lightweight” brief, but it earned an honorary mention for spirit and commitment to vintage web aesthetics. 

## **Next steps**

We will collaborate with Nuno Guerra to polish the winning design and may incorporate ideas from other entries where they improve clarity or accessibility. And finally we’ll adapt it to [php.net](http://php.net)’s stack.

In the spirit of PHP, contributions are welcome! We encourage all participants to join the [**implementation thread**](https://github.com/php/web-php/issues/1592) and help refine the final page.

## **How the scoring worked**

We combined a jury score with a community vote and **used a logarithmic transform** to reduce social-media spikes. We counted **👍 during the voting window** for each shortlisted entry and **ignored 👎** and other reactions.

* **Jury (40%)**  
  Judges scored four criteria from 0 to 5. For each entry we averaged judges into `J` in the range 0–25.  
  Normalization: `J_norm = J / 25`.

* **Community vote (60%), log-damped**  
  For entry *i* with `V_i` upvotes and `T = Σ V_i` across the shortlist:  
  `V′_i = log(1 + V_i)` and `V_logshare = V′_i / Σ V′_k`.

* **Final score**  
  Final `= 0.4 × J_norm + 0.6 × V_logshare`

We will publish the full table with anonymized jury subtotals and final scores.

## **Lessons learned**

We might not run this contest format again. **But if we did, here’s what we would fix:**

### **1) Scope & brief: on-brand update vs full rework**

The scope was the **PHP 8.5 release page** with an **on-brand** constraint. Some entries explored broader rebrands.

**Next time we would**

* Be more explicit on on-brand requirement.
* Potentially Split into **two tracks** judged and presented **separately**:

    * **Track A:** on-brand update of the specific page.  
      **Track B:** blue-sky concept for future reference.

### **2) “Spec work” concerns**

We kept scope small, didn’t require code, and recognized more than one entry (runner-up, third place, and shortlist thanks).

**Next time we would:**

* Prepare a more detailed brief with the community.
* Offer a **paid shortlist honorarium**.
* Cap deliverables (mock-ups plus optional tiny HTML/CSS), no heavy code.

### **3) Voting & balance (order bias, social reach, weights)**

Order bias and social amplification are real. In this contest we **ignored downvotes** and **used log damping** on upvotes.

**Next time we would also:**

* Use a dedicated voting tool that shuffles candidates.
* Optionally hide aggregate reaction counts until voting closes.
* Set a 50/50 split between jury and community.
* Publish the full calculation sheet upfront for auditability.

## **Thank you**

Thanks to all participants, voters, reviewers, and to the jury and design advisors for careful evaluations. Special thanks to [**JetBrains**](https://www.jetbrains.com/) and [**Rector**](https://getrector.com/) for supporting the community with prizes and encouragement.

If you want to follow implementation, join the thread here: [**php/web-php/issues/1592**](https://github.com/php/web-php/issues/1592).

🐘💜
