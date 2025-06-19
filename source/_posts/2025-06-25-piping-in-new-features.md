---
title: 'Piping in new features'
layout: post
tags:
  - stories
author:
  - name: Larry Garfield
    url: https://github.com/Crell
published_at: 25 June 2025
---

In May, another long-time-coming feature landed in PHP and will ship in PHP 8.5 this fall: The [pipe operator](https://wiki.php.net/rfc/pipe-operator-v3).  For such a simple feature it was a long and winding road to get here, with this being the third RFC to attempt it, but it is definitely a feature that punches above its weight.

## Flexible pipes

The pipe operator, spelled `|>`, is deceptively simple.  A feature common to many functional languages, the pipe operator takes the value on its left side and passes it as the single argument to a function (or in PHP's case, `callable`) on its right side.  That is, the following two lines mean the same thing:

```php
$result = "Hello World" |> strlen(...)

$result = strlen("Hello World");
```

On it's own, that is not all that interesting.  Where it becomes interesting is when it is repeated, or chained, to form a "pipeline."  For example, here's real code from a real project I've worked on, recast to use pipes:

```php
$arr = [
  new Widget(tags: ['a', 'b', 'c']),
  new Widget(tags: ['c', 'd', 'e']),
  new Widget(tags: ['x', 'y', 'a']),
];

$result = $arr
    |> fn($x) => array_column($x, 'tags') // Gets an array of arrays
    |> fn($x) => array_merge(...$x)       // Flatten into one big array
    |> array_unique(...)                  // Remove duplicates
    |> array_values(...)                  // Reindex the array.
;

// $result is ['a', 'b', 'c', 'd', 'e', 'x', 'y']
```

The same code without pipes would require either this horribly ugly nest of evil:

```php
array_values(array_unique(array_merge(...array_column($arr, 'tags'))));
```

Or manually creating a temporary variable for each step.  While temp variables are not the worst thing in the world, they are extra mental overhead, and mean that a chain like that cannot be used in a single-expression context, like a `match()` block.  A pipe chain can.

Anyone who has worked on the Unix/Linux command line will likely recognize the similarity to the shell pipe, `|`.  That's very deliberate, as it is effectively the same thing: Use the output from the left side as the input on the right side.

## Where did it come from?

The `|>` operator appears in many languages, mostly in the functional world.  F# has essentially the exact same operator, as does OCaml.  Elixir has a slightly fancier version (which we considered but ultimately decided against for now).  Numerous PHP libraries exist in the wild that offer similar capability with many extra expensive steps, including my own [Crell/fp](https://github.com/Crell/fp/).

The story for PHP pipes, though, begins with Hack/HHVM, Facebook's PHP fork nee competitive implementation.  Hack included many features beyond what PHP 5 of the day offered; many of them eventually ended up in later PHP versions.  One of its features was a unique spin on a pipe operator.

In 2016, Sara Golemon, long-time PHP contributor and former Open Source lead on the HHVM project, proposed porting [Hack's pipes](https://wiki.php.net/rfc/pipe-operator) to PHP directly.  In that RFC, the right side of a pipe wasn't a `callable` but an expression, and used a magic `$$` token (lovingly called `T_BLING`, at least according to yours truly) to inject the left-side result into it.  In that case, the example above would look like this:

```php
$result = $arr
    |> array_column($$, 'tags')
    |> array_merge(...$$)
    |> array_unique($$)
    |> array_values($$)
;
```

While powerful, it was also somewhat limiting.  It was very non-standard, unlike any other language.  It also meant a weird, one-off syntax for partially-calling functions that worked only when paired with pipes.

That RFC didn't go as far as a vote.  Nothing much happened for several years, until 2020/2021.  That's when I, fresh off of writing a book on functional programming in PHP that talked about function composition, decided to take a swing at it.  In particular, I partnered with a team to work on [Partial Function Application](https://wiki.php.net/rfc/partial_function_application) (PFA) as a separate RFC from a more [traditional pipe](https://wiki.php.net/rfc/pipe-operator-v2).  The idea was that turning a multi-parameter function (like `array_column()` above) into the single-parameter function that `|>` needed was a useful feature on its own, and should be usable elsewhere.  The syntax was a bit different than the Hack version, in order to make it more flexible: `some_function(?, 5, ?, 3, ...)`, which would take a 5-or-more parameter function and turn it into a 3 parameter function.

Sadly, PFA didn't pass due to some engine complexity issues, and that largely undermined the v2 Pipe RFC, too.  However, we did get a consolation prize out of it: [First Class Callables](https://wiki.php.net/rfc/first_class_callable_syntax) (the `array_values(...)` syntax), courtesy Nikita Popov, were by design a "junior", degenerate version of partial function application.

Fast forward to 2025, and I was sufficiently bored to take another swing at pipes.  This time with a better implementation with lots of hand-holding from Ilija Tovilo and Arnaud Le Blanc, both part of the PHP Foundation dev team, I was able to get it through.

Third time's the charm.

## The implications

Above, we described pipes as "deceptively simple."  The implementation itself is almost trivial; it's just syntax sugar for the temp variable version, effectively.  However, the best features are the ones that can combine with others or be used in novel ways to punch above their weight.

We saw above how a long array manipulation process could now be condensed into a single chained expression.  Now imagine using that in places where only a single expression is allowed, such as a `match()`:

```php
$string = 'something GoesHERE';

$newString = match ($format) {
    'snake_case' => $string
        |> splitString(...)
        |> fn($x) => implode('_', $x)
        |> strtolower(...),
    'lowerCamel' => $string
        |> splitString(...),
        |> fn($x) => array_map(ucfirst(...), $x)
        |> fn($x) => implode('', $x)
        |> lcfirst(...),
    // Other case options here.
};
```

Or, consider that the right-side can also be a function call that returns a `Closure`.  That means with a few functions that return functions:

```php
$profit = [1, 4, 5] 
    |> loadSeveral(...)
    |> filter(isOnSale(...))
    |> map(sellWidget(...))
    |> array_sum(...);
```

Which... gives us mostly the same thing as the long-discussed scalar methods!  Only pipes are more flexible as you can use any function on the right-side, not just those that have been blessed by the language designers as methods.

At this point, pipe comes very close to being "extension functions", a feature of Kotlin and C# that allows writing functions that look like methods on an object, but are actually just stand-alone functions.  It's spelled a bit differently (`|` instead of `-`), but it's 75% of the way there, for free.

Or take it a step further.  What if some steps in the pipe may return `null`?  We can, with a single function, "lift" the elements of our chain to handle `null` values in the same fashion as null-safe methods.

```php
function maybe(\Closure $c): \Closure
{
	return fn(mixed $arg) => $arg === null ? null : $c($arg);
}

$profit = [1, 4, 5] 
    |> maybe(loadSeveral(...))
    |> maybe(filter(isOnSale(...)))
    |> maybe(map(sellWidget(...)))
    |> maybe(array_sum(...));
```

That's right, we just implemented a Maybe Monad with a pipe and a single-line function.

Now, think about that for streams...

```php
fopen('pipes.md', 'rb') // No variable, so it will close automatically when GCed.
    |> decode_rot13(...)
    |> lines_from_charstream(...)
    |> map(str_getcsv(...))
    |> map(Product::create(...))
    |> map($repo->save(...))
;
```

The potential is absolutely huge.  I don't think it's immodest to say that the pipe operator has one of the highest "bangs for the buck" of any feature in recent memory, alongside such niceties as constructor property promotion.  And all thanks to a little syntax sugar.

## Where to from here?

Although pipes are a major milestone, we're not done.  There is active work on not one but two follow up RFCs.  Neither one looks likely to make it into PHP 8.5, but are strong contenders for PHP 8.6 that will fully flesh out what pipes started.

The first is a [function composition operator](https://wiki.php.net/rfc/function-composition).  Where pipe executes immediately, function composition creates a new function by sticking two functions end-to-end.  That would mean the streams example above could be further optimized by combining the `map()` calls:

```php
fopen('pipes.md', 'rb')
    |> decode_rot13(...)
    |> lines_from_charstream(...)
    |> map(str_getcsv(...) + Product::create(...) + $repo->save(...))
;
```

The other is a second attempt at Partial Function Application.  This is a larger lift, but with first-class callables already bringing in much of the necessary plumbing, which simplifies the implementation, and pipes now providing a natural use case, it's worth a second attempt.

I won't promise either one is going to happen.  But they're the next logical step on this journey, so it's worth shooting for.  Stay tuned.
