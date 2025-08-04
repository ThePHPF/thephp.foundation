---
title: 'Compile time generics: yay or nay?'
layout: post
tags:
  - stories
author:
  - name: Larry Garfield
    url: https://github.com/Crell
  - name: Gina Banyard
    url: https://github.com/Girgias
published_at: 04 August 2025
---

One of the most sought-after features for PHP is Generics: The ability to have a type that takes another type as a parameter.  It's a feature found in most compiled languages by now, but implementing generics in an interpreted language like PHP, where all the type checking would have to be done at runtime, has always proven Really Really Hard(tm), Really Really Slow(tm), or both.

But, experimentation by the PHP Foundation's dev team suggests we may be able to get 80% of the benefit for 20% of the work.  Is that enough?

## The short, short version

We believe it's possible to implement generics on only interfaces and abstract classes, which would offer a large chunk of the benefit of generics but avoid most of the pitfalls.

In particular, interfaces and abstract classes could declare that they need one or more types specified:

```php
interface Exporter<Thing> { ... }
```

And then classes that implement/extend them would be required to fill in those types:

```php
class WidgetExporter implements Exporter<Widget> { ... }
```

And then anywhere the type `Thing` appeared in `Exporter`, it would turn into `Widget` in `WidgetExporter`.

All of this is done at compile time, which makes it far easier and faster, and many/most errors would be caught at compile time.

Runtime generics, where you could say `$fooExporter = new Exporter<Foo>()`, would still not be possible, but they do not get any harder as a result of going just part way.

**Would you support (and vote in favor of) compile-time-only generics as described below?**


## Prior research

In 2023 and 2024, Arnaud Le Blanc from the Foundation team did [extensive experimentation](https://thephp.foundation/blog/2024/08/19/state-of-generics-and-collections/) on generics, picking up on the previous work from Nikita Popov.  The full result of that experiment is available at that link, but in short, some parts of generics would be possible, even straightforward.  Where the edge cases run into problems, though, they are very big problems.

In particular:

* Union types and generics combine to produce massive performance penalties.
* Many cases would result in a very cumbersome syntax unless we had really good type inference.
* Really good type inference is hard and slow, especially in PHP.

Meanwhile, making arrays generic, and therefore typed, had its own challenges, especially given that PHP variables are not typed.

Arnaud and Larry Garfield did further investigation afterward into introducing [a "module" system](https://github.com/Crell/php-rfcs/blob/master/modules/spec-brainstorm.md) that would help PHP's compiler [see more code at once](https://github.com/arnaud-lb/php-src/pull/10), and thus be able to do type inference more readily, but sadly that also ran into many challenging edge cases.

## Associated Types

In mid-2025, the Foundation's Gina Banyard started working on "associated types," a generics-adjacent feature found in a few languages that happens entirely at compile time. It essentially allows a class or interface to specify that inheritors must specify a type to be used in certain situations.  Initially, it was intended as an alternative to the [`never` parameters](https://wiki.php.net/rfc/never-parameters-v2) RFC, offering a better solution to the case of an interface that doesn't need to specify a particular type, but implementing classes do.

The initial plan looked something like this:

```php
interface ImporterExporter
{
    type T;

    public function import(string $input): T;

    public function export(T $value): string;
}

class ThingImporter implements ImporterExporter
{
    public function import(string $input): Thing { ... }

    public function export(Thing $value): string { ... }
}
```

In which all references to `T` in the interface need to be replaced by the *same* type in the class; it can be any type, as long as it's the same in all cases.

After some discussion with the rest of the team, however, it became apparent that if we just changed the spelling and squinted, associated types look an awful lot like generics.  Or rather, part of generics, as full generics is a very involved bit of functionality with lots of different complimentary parts.

Which begged the question: Could we just do some of those parts, and get most of the benefit?  According to Gina's work, the answer is "Probably!"

## Abstract Generics

What Gina has implemented, though it still needs some polish and extension, is essentially "manually monomorphized generics," implemented at compile time.  "Monomorphization" is an approach to generics (there are others) where a type-specific version of a class is created "on the fly" by the compiler or engine when that type-specific version is used.  By "manual," we mean that it's up to the developer to do so in advance.

Let's see what that looks like in practice.

Consider our previous interface, but spelled this way instead:

```php
interface ImporterExporter<T>
{
    public function import(string $input): T;

    public function export(T $value): string;
}
```

That interface requires that any class implementing it specify what type `T` should be; it can be any type, as long as it's the same type in both places.

```php
class ThingExporter implements ImporterExporter<Thing>
{
    public function import(string $input): Thing { ... }

    public function export(Thing $value): string { ... }
}

class WidgetExporter implements ImporterExporter<Widget>
{
    public function import(string $input): Widget { ... }

    public function export(Widget $value): string { ... }
}
```

This can all be enforced at compile time, where it's much cheaper, and cached by the opcache.

This alone is not full generics capability, but it is in practice a good chunk of it.  It's also possible to specify that the generic type must conform to some other type, like another interface.  For instance:

```php
interface Repository<T: Entity>
{
    public function save(T $entity): bool;

    public function load(int $id): T;
}

class BlogPostRepository implements Repository<BlogPost>
{
    // ...
}
```

This would work, but only if `BlogPost` implements the `Entity` interface.

## A few more parts

Although not yet implemented, Gina is confident that a few natural extensions are also possible and straightforward, if enough time is put into them.  They could probably be included in the initial RFC.

First, allowing abstract classes to be generic as well.  That would allow for:

```php
abstract class BaseRepository<T: Entity>
{ 
    // ...
}

class BlogPostRepository extends BaseRepository<BlogPost> { ... }
```

Of particular note, the inheriting class wouldn't need to actually *do* anything beyond specifying the type.  That would be enough.  The net result is that we may see a proliferation of "empty extending classes" that just specify a type and have no body of their own, as a surrogate for what in other languages would be `$repo = new Repository<BlogPost>()`.  In PHP, that would instead be spelled:

```php
class BlogPostRepository extends BaseRepository<BlogPost> { ... }
$repo = new BlogPostRepository();
```

(That's the "manual monomorphization" we talked about.)  Not ideal, but still much more powerful than the status quo as of PHP 8.4.

Second, type declarations.  It would already be possible to type against `BlogPostRepository`, as that's just a boring old class like we've always known.  What would be a straightforward extension is allowing this:

```php
class DataProcessor
{
    public function __construct(private Repository<UserEntity> $repo) {}
}
```

That is, declare that `$repo` must implement `Repository` *and* specify a type that is itself a child of `UserEntity` (which could be a class or another interface).  In the initial version it may not support a generic as part of a compound type (such as `private Repository<UserEntity>|null $repo`), but that should be feasible to add later, probably.

## Collections

One of the most common uses of generics is for collections, be they typed arrays or objects.  The details vary by language, but a collection known to be of a certain type is very valuable.  The previous blog post (linked above) included a discussion of a collection design by Derick Rethans and Larry Garfield, which included a custom one-off syntax for... essentially the behavior described here.  Updating that design for this syntax would give us three interfaces, or probably base classes:

```php
abstract class Sequence<T>
{
    private array $values = [];

    public function append(T $new): static
    {
        $this->values[] = $new;
        return $this;
    }

    public filter(callable $filter): static
    {
        // ...
    }
}

abstract class Set<T>
{
    // ...
}

abstract class Dict<K, V>
{
    // ...
}
```

And then they could be used like so:

```php
class Articles extends Sequence<Article> {}

class Library extends Set<Book> {}

class YearBooks<int, Book> {}
```

Those concrete classes could have additional methods in them if desired, but that's optional.  The above would be sufficient to have a collection that mapped integers to Book objects, and had syntax-level guarantees those types would hold.

The above design could be implemented either in core or user-space.  There's definite benefit to them being built-in, but the type-control portion at least would be available to user-space code, too.

## Longer term

There's a few more complex features that seem like they are doable, but require enough extra effort that they almost certainly wouldn't make sense in the initial RFC.  They could probably be in their own future RFCs, however, barring any surprises.

### Variance

In the initial version, generic types would be invariant.  `BlogPostRepository` is a child of `BaseRepository`, but just because `FeaturedBlogPost` is a child of `BlogPost` doesn't mean `BlogPostRepository` can accept `FeaturedBlogPost`.  The challenge is that the variance of parameter and return types are in opposite directions, and because a generic type may appear both as a parameter type (which can be seen as a write context) and a return type (which can be seen as a read context) it needs to be invariant, similar to how property types are invariant.  (This is a common challenge in languages with generics.)

However, Kotlin and C# have a feature that we should be able to borrow for PHP.  If a generic type is used exclusively in parameters it can be marked as an `in` type to indicate it is contravariant.  For example:

```php
interface Saver<in Type>
{
    public function save(Type $object): bool;
}

class BlogPostSaver<BlogPost>
{
    public function save(BlogPost $object): bool { ... }
}

$bsaver = new BlogPostSaver();
$bsaver->save(new FeaturedBlogPost());
```

Similarly, if a generic type is used exclusively as a return type, it can be marked `out`:

```php
interface Loader<out Type>
{
    public function load(int $id): Type;
}

class BlogPostLoader<BlogPost>
{
    public function load(int $id): BlogPost { ... }
}

$bloader = new BlogPostLoader();
$post = $bloader->load(5);
// $post could be a FeaturedBlogPost, potentially.
```

There are still a lot of bits to figure out here that may make it even more complex than anticipated.  That's why we're not looking into it in detail yet, and leaving it for future scope.

### Traits

PHP, of course, has another class-esque construct, Traits.  How generics would interact with Traits is still unclear.  It seems likely that something along the lines of the following could be made to work eventually:

```php
trait Tools<T> 
{
    public function useful(T $param): int { ... }
}

class C
{
    use Tools<Book>;
}
```

However, there are some notable challenges here, largely around performance and avoiding code duplication.  They are likely solvable, but sufficiently complex that they won't be in an initial version.

### Generic functions

So far we've only been talking about classes and class-likes.  What about functions?

At least in theory, something like the following should be viable:

```php
function compareThings<Thing>(Thing $thingOne, Thing $thingTwo) { ... };

compareThing<Widget>(new Widget(1), new Widget(2));
```

It's a bit clunky to have to specify the type manually on each call, but making that auto-detectable falls under the category of "type inference," as described below.

There probably aren't a huge number of use cases for this pattern in practice; mainly ensuring that two parameters or a parameter and return have the same unspecified type, which is fairly niche.  It's also unclear what implications it would have for methods.  It seems possible, but maybe not practical.

## What is still hard

Notably absent from the above plan are, well, the Really Really Hard(tm) bits.  At this time, it's still not clear that they would be possible.

### `new` generics

In particular, a syntax like `$blogRepo = new Repository<BlogPost>()` is still not on the table.  The challenge is that the partial approach described here can put all the extra tracking data it needs on the *class*, and do the work at compile time.  Supporting on-the-fly declarations with `new` would require putting the extra tracking data on the *object*, and doing all the work at runtime.  That's an order of magnitude harder.

### Generic compound types

Few if any languages support both generic types and union types.  PHP has had union and intersection types for some time, and made largely judicious use of them.  However, trying to make a class generic over a compound type makes the whole thing exponentially more complex.  This is one of the areas that Arnaud ran into in his earlier research.  Code like the following will likely never be possible, at least not if we care about performance at all:

```php
class SimpleRepository implements Repository<BlogPost|User|Event>
{
    // ...
}

class DataProcessor
{
    public function __construct(private Repository<UserEntity|BlogPost> $repo) {}
}
```

In practice, that's probably fine.  The situations where that would even be useful are few and far between.

As noted above, though, typing against a generic that is part of a union, like `public function setRepository(Repository<UserEntity>|null $repo) {}`, is probably possible in a follow-up RFC.

### Type inference

Type inference is a feature of many heavily typed languages where the compiler or engine can "figure out" what the type of something is supposed to be based on context.  As a trivial example:

```php
function add(int $x, int $y)
{
    return $x + $y;
}
```

It's readily obvious that the return type of that function is `int`, so a type inference engine will fill that in for you automatically.

That would be very helpful for Generics, especially if runtime Generics ever became possible.

```php
class Car<Driver> {
    public function __construct(private Driver $driver) {}
}

// This full version
new Car<StudentDriver>(new StudentDriver());

// Could be abbreviated to this, and the engine would figure out the rest.
new Car(new StudentDriver());
```

A lot of Arnaud's research last year was into the feasibility of type inference to make generic code easier to work with.  This unfortunately remains in the Really Really Hard(tm) realm.  On the flipside, it's also largely irrelevant until and unless runtime generics (like in `new`) become feasible, which are already Really Really Hard(tm).


All of the above remain challenges to a full PHP generics implementation.  Importantly, however, they are not made any harder by Gina's work into just the compile-time parts.  There's no guarantee that they will ever be possible, but they are not made any less possible by adopting the parts of generics we can do.

## So, should we?

This work is still experimental.  As noted above, there's a few additional features still to add, and dozens of edge cases and crufty corners to sort out.  (What happens if you implement two generic interfaces?  Do anonymous classes make anything weirder?  Etc.)  There's much work ahead to bring compile-time generics to a votable state.

The Foundation, of course, wants to be respectful of the time of our development team, the time of the many RFC reviewers, and the pocketbooks of our generous sponsors.  Foundation staff have already sunk quite a bit of time into the question of generics.  Before we sink more time into it, we want to ask the community (and PHP Internals especially)... Is it worth it?

Would a partial-generics approach like that described here be acceptable?  Even if it may not be possible to go all the way to full generics, would "compile time-only generics" be a big enough win to justify spending more time on it?  Our team thinks it is, but PHP is larger than our team, so we want to get feedback from the broader community.

**Would you support (and vote in favor of) compile-time-only generics as described here?**

{{ include('redditify.html', {
url: 'https://www.reddit.com/r/PHP/comments/1mhe7qf/compile_time_generics_yay_or_nay/'
}) }}
