---
title: "PHP Through a Screen Reader: Small Syntax Choices That Matter"
layout: post
tags:
    - update
author:
  name: André Polykanine
  url: https://oire.org/about
published_at: 05 June 2026
---

I'm a backend developer, and PHP is my main language; it is also my favorite one. I've been developing in PHP since 2008, and today, when I start a web project, I choose PHP proudly, because I know what works well for me.

There is one particularity in my developer experience: I'm totally blind from birth. So I use a [screen reader](https://www.visionaustralia.org/technology-products/resources/beginner-guides/introduction-to-screen-readers), a tool that sends information to speech and/or a [Braille display](https://www.sightadvicefaq.org.uk/technology/Reading-and-writing/Braille-Display).

Of course, blind programmers are not a single organism with a shared configuration file. We use different tools and tolerance levels for punctuation spoken at 500 miles per hour. Still, PHP has many qualities that make it comfortable to read and write non-visually.

## Syntax as landmarks

Accessibility in programming is often discussed through tools, and tools matter a lot; but the language itself matters too, because syntax is something we hear, search, remember, and sometimes read on a Braille display.

As we all know, every variable in PHP starts with `$`, and although this is often treated as one of those old PHP quirks people love to mention, for a screen reader user it is rather a practical landmark. I do not need to infer whether `user` is a variable, a constant, a class name, a function, or something else, because `$user` announces itself immediately. Without that marker, something like `User user = new User()` becomes, in speech, “user user equals new user left parenthesis right parenthesis”, or in my birdspeak, “user user equal new user left right”; this is understandable, yes, but it still requires a tiny effort to decrypt. A thousand tiny little efforts a day, actually.

Functions also have a clear marker: the `function` keyword, and arrow functions have `fn`. These words are searchable, predictable anchors in a file, especially because not every blind developer lives inside a large visual IDE. Many of us use code or even text editors, command-line tools and search where they work well, so if I want to jump through functions in a file, the word `function` is my friend.

PHP’s modern object-oriented syntax also has a pleasant rhythm:

```php
public function getDisplayName(): string
```

Maybe because I come from a linguistics background, it matters to me that this is a good phrase to hear and read: it has full words, it has structure — visibility, `function`, name, parameter list, colon, return type. I do not want to start a language war — well, not today — but when code is read linearly through speech or Braille, explicit syntax can be more comfortable than compact syntax.

The same is true for braces and semicolons: a closing brace tells me that a block has ended, a semicolon tells me that a statement has ended, and both save me from reconstructing structure from indentation alone. Indentation is useful, of course, but braces act as milestones: block ended, period, go further.

Naming conventions matter too. In PHP, we commonly see `camelCase`, `PascalCase`, and `UPPER_SNAKE_CASE`. For me, `camelCase` is convenient because screen readers often separate the words naturally, while `UPPER_SNAKE_CASE` constants are noticeable, especially in Braille. The ordinary snake case is harder: if punctuation is enabled, — and it is while writing code\! — `my_very_descriptive_variable_name` may become “my underscore very underscore descriptive underscore variable underscore name”. You can tune punctuation settings, and I have done it, but it still adds work.

PHP is not perfect; no language is. But accessibility is not only elegance: sometimes it is predictability, explicitness, and being able to search for `function`, hear a friendly `$`, distinguish a constant on a Braille display, and know that a block ended because there is a `}`.

## What about learning?

The second part of the story is learning. The PHP language itself can be friendly to assistive technology, but programming education is much more uneven. Many tutorials today are video-first, visually dense, and full of phrases like “click here”, “as you can see”, or “now we get this result”. That is fine if the important information is also spoken or written, but it becomes a barrier when the tutorial depends on visual context that is never explained.

Here is a simple rule of thumb: close your eyes and try to understand what is happening in a course or conference talk. If you cannot, the blind part of your audience is immediately excluded. A blind learner cannot use “this button here” if “here” only means the instructor’s mouse pointer, cannot copy code from a screenshot, and cannot easily follow a refactoring if the teacher silently selects a block and says, “now we just fix it this way”.

And this is not only about blindness. Clear teaching helps everyone: beginners, people learning in a second language, people watching on a phone, and people returning to a tutorial six months later.

So here is my practical wish for people teaching PHP: provide the code as text, ideally in a Git repository. Say what file you are editing, say what function you are in, and do not rely only on “as you can see”. If something changes on screen, describe the change; if you show an error, read the important part of the error; if you use a diagram, briefly explain what it means. If you publish slides, make sure code examples are real text, and not just images, and consider publishing a transcript.

Good written material also matters. PHP has always had a strong culture of documentation and examples, and that is not just convenient; it is an accessibility feature.

## Conclusion

Accessibility is essential for users, but developers need accessibility too. For me, part of PHP’s approachability is that the code gives me landmarks: it speaks in a structure I can follow, lets me search, and marks important parts in ways that are not only visual.

These are small things, but programming is made of small things repeated many times, and when those small things reduce friction, they let more people build.  
