---
title: 'PHP 8.6 kicks off with partial function application'
layout: post
tags:
  - stories
author:
  - name: Larry Garfield
    url: https://github.com/Crell

published_at: 08 December 2025
---

PHP 8.5 is still warm, but the work to push PHP forward continues.  The latest major feature for PHP 8.6 has just been approved: [Partial Function Application](https://wiki.php.net/rfc/partial_function_application_v2) (PFA).

## The gist

In PHP 8.6, it will be possible to create a closure that simply delegates to another function without writing out the whole closure.

```php
// This
$underscore = str_replace(' ', '_', ?);

// Is effectively the same as this:
$underscore = fn(string $s): string => str_replace(' ' , '_', $s);
```

Both lines will produce nearly identical opcodes, but the former is much easier to both write and to read, as it doesn't require messing about with redeclaring all the types and variable names.

Any function (or method) call may use one of two placeholders, `?` or `...`, to indicate that it is only "partially invoking" that function.  Or "partially applying arguments to it."  It works with both positional and named arguments, too!

```php
function complex(int $a, int $b, int $c, int $d): string { ... }

// This creates a closure that takes 2 ints and returns a string.
$f = complex(?, 2, ?, 4);

// This creates the same closure, but with named arguments.
$f = complex(b: 2, d: 4, ...);

// This reverses the order of the parameters, $f needs $c first, then $a.
$f = complex(b: 2, d: 4, c: ?, a: ?);

// Keep all arguments unbound. Hey look, first-class-callables!
$f = complex(...);

// This creates a zero argument closure, which just calls complex() when invoked!
$f = complex(1, 2, 3, 4, ...);
```

PFA supports a wide variety of complex use cases and features, like parameter reordering, named arguments, variadics, etc.  In practice, however, we expect most uses to be reducing a function down to a single remaining argument (that is, currying).  That makes it perfect to use as a callback.  Most of PHP's functions that take callbacks expect a single argument, and the few remaining take two (such as a value and a key).  PFA makes using arbitrarily complex, contextually aware functions in those cases trivially easy.

```php
// This
$result = array_map(in_array(?, $legal, strict: true), $input);

// is much nicer than this
$result = array_map(fn(string $s): bool => in_array($s, $legal, strict: true), $input);
```

By design, it's also the perfect complement for the new [pipe operator](https://www.php.net/manual/en/language.operators.functional.php).  To reuse some examples from the [Pipe RFC](https://wiki.php.net/rfc/pipe-operator-v3):

```php
$numberOfAdmins = getUsers()
    |> array_filter(?, isAdmin(...))
    |> count(...);

$result = "Hello World"
    |> htmlentities(...)
    |> str_split(...)
    |> array_map(strtoupper(...), ?)
    |> array_filter(?, fn($v) => $v != 'O')
;
```

What's more, optimizations around the pipe operator mean the closure doesn't even need to be created in those cases, so there's zero performance overhead.

The RFC has more details on all the ins and outs of the new syntax.

## The long view

If all of this sounds a lot like an extended version of "first class callables," it should.  Or rather, "first class callables," are the training wheels version of partial function application.

PFA was [first proposed](https://wiki.php.net/rfc/partial_function_application) way back in 2021, by a team of Joe Watkins, Levi Morrison, Paul Crovella, and myself.  That version was largely similar on the surface, but had a different implementation that caused some consternation.  In particular, Nikita Popov (at the time still PHP's de facto lead developer) felt that it introduced too much complexity in the engine.  His hesitancy convinced many others to reject it at the time, though there was still a lot of interest and support.

There was enough support, however, that Nikita asked "couldn't we just do `foo(...)` to delay all the variables, and skip the rest of the RFC?"  The result of that was the [First Class Callables](https://wiki.php.net/rfc/first_class_callable_syntax) RFC, released in PHP 8.1.

I've been looking to take a second swing at PFA since then, but needed the right time and right collaborators.  FCC has clearly shown itself to be a huge boon to the language, so why not go all the way?  It wasn't until the Pipes RFC passed earlier this year, though, that I was able to snare the PHP Foundation's Arnaud Le Blanc into working on a second version with me.  It didn't quite make it into PHP 8.5 for timing reasons, but it's now available in 8.6.

So what changed?  One, FCC ended up already including a lot of the underlying engine trickery that was needed for this version of PFA.  We were able to leverage that.  For another, the implementation is a bit different.  Rather than creating a special kind of pseudo-closure that can be extra-optimized, the new approach just creates a normal closure object like we've had for years.  That makes it much simpler to implement and solve a ton of edge-case questions.  Three, now we have pipes.

And oh boy is this an exciting combination.

## A long time coming

PFA for PHP really began even before 2021.  As discussed in the [Pipes blog post](https://thephp.foundation/blog/2025/07/11/php-85-adds-pipe-operator/) from July, way back in 2016 Sara Golemon proposed porting Hack/HHVM's pipe syntax to PHP:

```php
$result = $arr
    |> array_column($$, 'tags')
    |> array_merge(...$$)
    |> array_unique($$)
    |> array_values($$)
;
```

That was never approved, but led us to try splitting the syntax in two: The pipe operator itself, and partial function application instead of `$$`.  We tried in 2021 to get both, but both failed.  Now we have both.

One of the chief criticisms I've seen about the new pipe operator is the need to wrap up multi-parameter functions into an inline arrow function, and then wrap that in `()` to keep the parser happy.  Which is a fair criticism!  And the perfect fix for that criticism is... partial function application.  Which we now have.  The twins have been reunited.

## PHP breaks the mold

I've often seen PHP criticized for just stealing features from other languages and piling them in willy-nilly.  Frankly that's not always a bad thing: PHP, much like English, evolves by finding good ideas in other languages and *ahem* borrowing them, and making it our own.

Partial function application is not a new concept.  It's been the foundation of many functional languages for decades.  Haskell, for instance, implicitly uses partial application for literally every function call.  Any function call can just omit its right-most arguments and poof, it becomes a partial application.

What I have not seen in any language, however, is the ability to partially apply arbitrary parameters.  That's important for PHP, because while Haskell's entire standard library was built around the assumption of right-most partial application, PHP's most definitely was not.  We needed to be able to turn arbitrary functions into unary (single-argument) functions to allow most parts of the standard library to work with... pipes.  Or as callbacks.

And now we can.  I do not know of any other language that has as flexible, powerful, and compact a partial function application syntax as PHP 8.6 will have.  Here, PHP would seem to be the innovator.

Rock on, ElePHPants!

## What comes next?

There's one more major piece of the puzzle still to come: [Function composition](https://wiki.php.net/rfc/function-composition).  Where pipe executes immediately, function composition creates a new function by sticking two functions end-to-end.  Sara Golemon helpfully got it started, but it still needs some work before it can be formally proposed.

That would complete the trifecta of "Functional Features" we've been trying to get into PHP for years to allow a much more natural use of functional techniques.

Each of these RFCs is, on its own, useful but not earth-shattering.  Taken together... "synergy" may be a dirty word outside of management consulting, but in this case it applies.  We are very close to blowing open PHP's functional capabilities in much the way that PHP 5.2 finally blew open its object-oriented capabilities.  And as a multi-paradigm language, we'll be able to freely mix and match OOP and FP approaches where they make the most sense.

I can't wait!
