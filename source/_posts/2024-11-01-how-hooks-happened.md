---
title: 'PHP 8.4: How Hooks Happened'
layout: post
tags:
  - stories
author:
  - name: Larry Garfield
    url: https://github.com/Crell
published_at: 5 November 2024
---

PHP 8.4 is coming on 21 November this year.  It includes a host of new functionality, but the biggest, in more ways than one, is Property hooks.  Given the excitement around it, as well as its size, the PHP Foundation's Roman Pronsky asked me to write up a bit about the process we went through to produce this beast.

What eventually became the twin RFCs of Property Hooks and Asymmetric Visibility is actually a very old discussion.  We'll look back at the decade-plus saga that got us here, how Ilija Tovilo and I got sucked in, how the design came to be, and how we managed to get it across the finish line.  Here's a teaser: It would not have happened without the PHP Foundation.

## Ancient history

Ilija and I were not the first RFC to propose "property accessors," as they're called in most languages.  In fact, our RFC was the fifth:

1. 2009: [Property get/set syntax](https://wiki.php.net/rfc/propertygetsetsyntax) by Dennis Robinson.  The core concepts and arguments behind it are all there, and haven't really changed in 15 years.  It never went to a vote.
2. 2012: [Property get/set syntax v1.2](https://wiki.php.net/rfc/propertygetsetsyntax-v1.2) by Clint Priest and Nikita Popov.  It didn't pass the 2/3 threshold for a vote, but did pass 50%.
3. 2013: [Property get/set syntax alternate typehinting syntax](https://wiki.php.net/rfc/propertygetsetsyntax-alternative-typehinting-syntax), by Nikita Popov.  An alternate approach that proved very unpopular, failing 3 to 12.  However, it included a shorthand syntax that looks suspiciously like what eventually became property types.
4. 2021: [Property Accessors](https://wiki.php.net/rfc/property_accessors) by Nikita Popov. More of a brainstorm of what property accessors could be, including specific use-case options like `lazy` or `guard`.  It never went to a vote, but Nikita did note that "We could likely get 80% of the value of accessors by supporting read-only properties and 90% by also supporting private-write properties."  (I don't fully agree, but much of the value is in private-write.)

All of these attempts had a few things in common:

* Pseudo-functions that live on properties and intercept get/set operations.
* Asymmetric visibility
* Interface properties

## A new team enters the arena

Fast forward to the summer of 2022.  Ilija Tovilo decided he wanted to take a swing at accessors next, and approached me for help.  Ilija and I had already worked together on the [Enums RFC](https://wiki.php.net/rfc/enumerations), so we knew we worked well together.  In part, that's because we have very different skill sets.  Ilija is rapidly becoming one of the most PHP engine-knowledgeable people around and quite proficient at writing C code, but is, by his own admission, not the most proficient writer of English.  I am a weirdo who enjoys language research, designing away edge cases, and can type fast enough to keep up with the Internals mailing list.  We complement each other well.

Illija is also fully funded by the PHP Foundation to work on the engine, without which this amount of work would have been impossible.  I work on a volunteer basis, and as my employers allow.

(Side note: As of this writing, I am between jobs.  If you're looking for a highly-experienced PHP Staff/Principal Engineer with experience in design, architecture, and leading teams, please [reach out](https://github.com/Crell/) and let's talk!)

## Research, then development

With the initial goal of "making Nikita's proposal work-ish," I started digging into the research and design side.  My [initial brainstorming](https://github.com/Crell/php-rfcs/blob/master/property-hooks/research.md) shows where our thoughts were at the time.  In short:

* There are two models of accessors: In untyped languages without visibility controls – like JavaScript and Python – accessors are methods with funny syntax.  In typed languages with visibility controls – like C#, Swift, and Kotlin – accessors are enhancements to a defined property.  As PHP is, let's face it, a typed language with visibility controls, that was clearly the model to follow (as had all previous RFCs).
* Yes, we really would need asymmetric visibility, accessors, and interface properties.  While technically separate features, they make the most sense in combination.
* The whole scope would be huge, so we needed to break it up where we could.  Splitting Asymmetric visibility off to its own RFC was the most natural place, which would be made easier by using Swift's `private(set)` style syntax.

So in August of 2022 we put forward the first [asymmetric visibility](https://wiki.php.net/rfc/asymmetric-visibility) RFC.  Given there was already a clear appetite for such functionality based on list discussions and on the recent `readonly` addition, which Nikita explicitly intended as a "junior asymmetric visibility," we expected some bikeshedding but overall a straightforward process.

Boy were we wrong.

## Asymmetric support

The Asymmetric Visibility RFC was far more contentious than we expected. Some people hated the idea.  Some wouldn't accept anything but the C#-style syntax.  We ran a poll of various different approaches, and our initial proposal (Swift-style placement and syntax) ended up winning by a slim margin, but disappointingly "the consensus position isn't your position, sorry" didn't really persuade anyone.

Eventually, Asymmetric visibility finally went down in a 14:12 vote in January of 2023.  RFCs need 2/3 majorities to pass, so 14:12, while a simple majority, isn't enough.

## Hooking it up

The failure of asymmetric visibility was a blow to both of us.  In most cases we didn't even know why the people who voted "no" did so, which made addressing their concerns guesswork.  Had we just wasted our time?  Would accessors even be acceptable?  The current RFC process is very bad at providing that kind of actionable feedback.

While no one from the Foundation mentioned it, we were also both acutely aware that Ilija had been working on paid time for a proposal that ended up failing.

Nonetheless, we had split the RFC in two deliberately so that even if only one was successful there was still a benefit.  We therefore turned our attention to the accessor part of the proposal (which included interface properties) and continued working.

The model we developed was essentially a "direct port from Swift, with a few slight renames."

The initial design included:

* `get` - Totally takes over reading, and there's no physical property created.
* `set` - Totally takes over writing, and there's no physical property created.
* `beforeSet` - Intercepts the writing of a property but doesn't change the actual write itself.
* `afterSet` - Called after the property is written, doesn't change the actual write itself.

This is also when we changed the name from "accessors" to "hooks," which seemed a more accurate description given that model.  This later ended up not making sense, but Ilija had already taken the time to rename everything in the patch, so it was too much work to change back.  Sorry.

The RFC text itself grew and grew.  PHP is a very mature (read: complex) language, and so there were lots of nooks and crannies that we had to account for.  Properties touch on almost everything: References, arrays, inheritance, final properties, interfaces, interaction with `readonly`, interaction with `__get`/`__set`, serialization, constructor property promotion, reflection...

PHP is a big language, and we needed to think through and implement every possible edge case to avoid booby traps.

## Some very good Advice

We finally had a working design and implementation by April 2023 or so, but were quite nervous about it.  It was big, and we were both still smarting from the loss of asymmetric visibility.  Roman suggested that he run it past the PHP Foundation's Advisory Board for feedback first before going to the list, which turned out to be the best thing we could do.

The Board came back with mostly positive feedback; they liked the concept, the design, the detail... but having 4 separate hooks felt very clumsy to them.  Especially with get/set wiping the backing property entirely and leaving the developer on their own.

[Insert Foundation ad here]

I don't have the original chat log, but that resulted in a brief exchange that went approximately like this:

```text
Roman: The Advisory Board says three different set-ish hooks are a problem  
Larry: Well, we kinda have to, because you can't access a property 
       from within its own hook, that doesn't make sense.  
Ilija: Er, actually we could do that easily.  
Larry: Wait, what?  That... how... why...  
Larry: *does some research*  
Larry: Well crap, that's exactly what Kotlin does.  
       Why didn't we research Kotlin in the first place?  
Ilija: ¯\_(ツ)_/¯  
Ilija: Well, I just switched it over to that. Looks nicer.
```

And so there we were, with half as many syntaxes for the same functionality, and a feature name (hooks) that no longer made sense.  Oh well.

We finally made a public proposal at the start of May 2023.  Initial feedback was quite positive, though there was some pushback, including around the syntax from people who wanted the Javascript/Python style (naturally).  And the length.  Oh, the length.  If hooks isn't the longest RFC ever proposed, it's close.  But as we reiterated many times, that's because the problem space itself is highly complex.

Sadly, time was not on our side.  Ilija was still working out some implementation edge cases and PHP 8.3’s feature-freeze was rapidly approaching.  So in early July, almost exactly a year after we started working on it, we decided to postpone hooks until 8.4 to give such a large change enough time to settle in and get adjusted if needed.

## Take 2

After many distractions, we were able to bring the topic back up in [February of 2024](https://externals.io/message/122445), with the intent to bring it to a vote quickly, in March.  (We were so naive.)

There was a lot more discussion this time around, though a lot of it was re-hashing edge cases we'd already addressed.  We also spent a considerable amount of time talking with the Foundation's developer team.  They, by and large, represent the most experienced developers of PHP Internals today, and were an invaluable resource.  That we could talk to them in real time via the Foundation's private chat also helped, as that's a far easier way to handle back-and-forth than a mailing list.

There were a few significant changes we did end up making in response to feedback, from both the list and the Foundation team.  Most importantly, Ilija managed to make array properties work, which had been a challenge due to references.  Once again, being able to attack the problem from two directions (design and ergonomics from me, implementation from Ilija) let us improve the overall experience dramatically.

## Down to the wire

Even then, with all the positive feedback, it wasn't clear to us if it would pass.  Many people on the list had expressed support, but a lot of them were non-voters.

Others had expressed essentially "fearful support"; They liked the idea, couldn't find fault with the implementation, but were concerned about just how big and complex the feature was.

Still others, for various reasons, suggested moving certain sub-features to a separate, future RFC. Which is often code for "I don't like this part, but I don't want to vote against the RFC because of it, so please let me vote against it separately."  We explained, repeatedly, that this was already the slimmed down, partial version.  The other part was asymmetric visibility.

After a lot of discussion and with a lot of trepidation, we called the vote in mid-April of 2024.  It passed 42:2.  I don't understand PHP Internals at times.

## Asymmetric Visibility 2: The Wrath of Ilija

Several people pointed out that hooks without asymmetric visibility had significant holes in it.  They were right, which is why we'd originally proposed that first.  We had decided that if hooks pass, we would take a second swing at asymmetric visibility.  So we did.

The only actionable feedback we'd gotten the first time around was that without support for combining `readonly` and asymmetric visibility, the RFC felt "incomplete."  We went through a few variations on how to address that before landing on the final solution: Change `readonly` from being implicitly `private(set)` to implicitly `protected(set)`.  Otherwise, the discussion was mostly a retread of the year before.

We were still stressing out about this one, too.  It hadn't passed before, why would it now?  However, this time it passed 24:7 at the start of August 2024.

Looking at the results, while there were two people who changed from a No to a Yes, the biggest change from the first vote was simply who voted.  Most of the previous No votes... didn't vote this time.  But entirely new people showed up to vote yes.  Showing up to vote matters, folks.

## On to the next adventure

25 months after the process started, PHP now joins the cadre of languages with robust, flexible properties that can do more than just hold dumb values.  It's been a wild ride, and at many points a needlessly stressful one.  The end result, though, is a host of powerful new features that make PHP 8.4 the most exciting PHP release in several years.  Really, they're the best thing since enums...

I hope this tale is a useful insight for folks into how the sausage is made.  Now go enjoy interface properties, hooks, and asymmetric visibility.  Or enjoy not using hooks, but having the option to, which eliminates a lot of code.  Both work.
