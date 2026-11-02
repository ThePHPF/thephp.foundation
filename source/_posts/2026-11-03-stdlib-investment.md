---
title: 'Designed Once, Usable Everywhere: An Investment in PHP’s Standard Library'
layout: post
tags:
  - stories
author:
  - tim-dusterhus
published_at: 3 November 2026
---

All PHP projects have one thing in common, regardless of whether they are built
on a full-stack framework, on a microservice framework with carefully selected
standalone libraries, or as an extension for a CMS: the PHP standard library.
Functions such as `str_replace()` or `array_map()` and classes like
`DateTimeImmutable` or `Uri\Rfc3986\Uri` from PHP 8.5 are always available,
always work the same, and always have the same meaning. This makes PHP’s
standard library a “lingua franca”, enabling specialized standalone libraries
to seamlessly integrate into full-stack frameworks and allowing developers to
transfer knowledge and experience across the different parts of PHP’s
ecosystem.

After the Random extension in PHP 8.2, the new DOM API in PHP 8.4 and the [URI
extension in PHP
8.5](https://thephp.foundation/blog/2025/10/10/php-85-uri-extension/), PHP 8.6
continues to expand the vocabulary of its standard library by adding a
[`SortDirection` enum](https://wiki.php.net/rfc/sort_direction_enum) and the
[`Time\Duration` class](https://wiki.php.net/rfc/duration_class) amongst
others. Both of these are small and intentionally so. This post explores why
their value greatly exceeds their size.

## Everyone Reinvents the Wheel

When a concept as common as measuring elapsed time or sorting things in
different directions has no type in the standard library, every project tends
to invent its own solution to this common problem. Looked at individually each
of these inventions makes sense. But combining them into a coherent application
means that glue code needs to be added whenever crossing a boundary between two
different libraries. It also means that every developer needs to learn which
“dialect” a given library speaks.

PHP itself is no exception.

To pass an “amount of time”, PHP’s own standard library uses seconds
(`sleep()`), milliseconds (`CURLOPT_TIMEOUT_MS`), microseconds (`usleep()`),
nanoseconds (`hrtime()`), pairs of integers indicating seconds \+ a number of
fractional seconds (`stream_set_timeout()`), and floats (`microtime(true)`).

For indicating the direction of sorting the situation is similar. In PHP’s
standard library there are integer constants `SORT_ASC` and
`SCANDIR_SORT_ASCENDING` that only work with specific functions, without any
type level indication. For sorting arrays there are pairs of functions that
only differ in the sort direction. Userland libraries use strings like `'ASC'`
or `bool` parameters to describe the same idea and libraries targeting PHP 8.1
created their own enum. A GitHub search for `SortDirection` revealed more than
150 different \- incompatible with each other \- hits, not counting differently
named enums such as Doctrine’s `Order` enum.

## Two New Dictionary Entries

`SortDirection` is an enum with exactly two cases (`Ascending` and
`Descending`) and no associated behavior. It is fully described by four lines
of PHP code:

```php
enum SortDirection {
    case Ascending;
    case Descending;
}
```

Implementing it in one’s own library is trivial, but using it across libraries
that each implement their own `SortDirection` enum would require complicated
babelfishes that map between the different enums. Since `SortDirection` is
guaranteed to always be available in PHP 8.6, libraries can use it in their
public APIs, only needing to translate it to a different representation when
serializing it for use in a SQL query or HTTP API.

```php
$query->orderBy('created_at', SortDirection::Descending);
```

`Time\Duration` represents a period of time as measured by a stopwatch, from a
single nanosecond up to more than a hundred years with nanosecond precision
across the entire range. Its named constructors include the desired unit in
their name and do exactly what they say on the tin, so there is no more
guessing whether a `$timeout` parameter expects seconds, milliseconds, or moon
phases.

Reading the value uses a pair of properties called `->seconds` and
`->nanoseconds` with an explicit `->negative` flag, similarly avoiding the
“magic number” problem. The new polling API that was developed as part of the
“[Streams
Project](https://thephp.foundation/blog/2025/10/30/php-streams-evolution/)” and
that is also included starting with PHP 8.6 is the first one to accept it.

```php
$events = $pollContext->wait(Time\Duration::fromMilliseconds(250));
```

## A Foundation for More to Come

`Time\Duration` is already usable by itself, but is only intended to be the
first building block of a new date and time API built with the capabilities of
modern PHP. The next part of this new API is [already under
discussion](https://news-web.php.net/php.internals/132588). The [Time\\Instant
and Time\\Clock RFC](https://wiki.php.net/rfc/time_instant_class) proposes a
`Time\Instant` class representing points in time, together with a `Time\Clock`
interface to make testing time-dependent functionality easier. The distance
between two `Time\Instant`s is a `Time\Duration` and moving the point in time
takes a `Time\Duration` as input, building on the foundation already built and
fitting together like two well-oiled gears.

## The Standard Library Is Worth the Investment

An enum that can be written in just four lines of PHP and a class with three
properties and a handful of methods might not look like they deserve a
potentially lengthy RFC discussion on the PHP Internals mailing list when you
could build them yourself in less than an afternoon without coordinating with
anyone else. I think they are exactly the work that pays off the most in the
long run, because they give the ecosystem something new to rely on that
replaces custom implementations, rather than just a different way to write what
already exists.

The demand for these types was already there. There were more than 150
different hits for the 4-line enum and there are multiple userland libraries
and extensions that provide a class to measure stopwatch time. They are all
well-intentioned solutions to the same common problem. They are also all
incompatible with each other. A single design discussion on PHP Internals, even
if it comes with a higher initial investment, replaces all these efforts and
gives the ecosystem something to converge on.

Having the discussion is important, since getting the design right matters more
for the standard library than for any userland package. PHP’s strong backwards
compatibility promise means that there rarely is a second attempt. Once
something has made it into a stable release even the tiniest break in
compatibility means thousands of affected users at PHP’s scale.

The introduction of namespaces to PHP after a large part of PHP’s existing
standard library was built provided a rare opportunity for a second attempt by
allowing us to build the replacement API in an empty namespace without touching
the behavior of the existing API that PHP developers have come to rely on.
Users are then able to migrate to the new API at their own pace. This
methodology was previously used for the Random extension (`Random\*` replacing
`mt_rand()`, `shuffle()` et al), the DOM extension (`Dom\*` replacing `DOM*`)
and the URI extension (`Uri\*` replacing `parse_url()`) mentioned in the
introduction.

To make the most of this opportunity the RFCs are deliberately taking small
steps, with a clearly spelled out future scope to allow for long-term planning
without committing to decisions too early. Keeping PHP internally consistent
means that every decision we make today constrains the ones that follow and
potentially rules out some paths entirely. A small API that is correct and
built with future evolution in mind is easy to extend. A large API that is
slightly wrong will be a nuisance for decades to come.

The `Time\Duration` RFC showed how this looks in practice. Derick Rethans,
ext/date maintainer and a PHP Foundation contractor, and I wanted the new
polling API to take a `Time\Duration` timeout instead of a `$timeoutSeconds`
and `$timeoutMicroseconds` pair before the PHP 8.6 feature freeze made its
signature permanent. This left us with about two months from when we first
proposed the RFC. A sub-optimal API in a single method is a localized problem.
Replacing it with a reusable building block that is not quite right would fix a
small problem and create a big one. That’s why our proposal was limited to two
kinds of functionality: the first being the parts that we were confident about,
erring on the side of caution, the second being functionality that future
additions would rely on, but that could not be added later without breaking
existing expectations, such as support for negative durations. We also clearly
communicated this when starting the discussion, asking the PHP Internals
community to focus on real issues in their review rather than optional
convenience functionality, leaving those as future scope. The result is a new
class representing a generic concept that is useful *today* even if future
parts do not materialize, while leaving room for `Time\Instant` and whatever
follows.

All this work is not free. Building functionality that unites the ecosystem
requires RFC authors doing research, coming up with a design and managing the
discussion. It also requires reviewers that are willing to spend their time
reading the RFC, providing insight based on their experience and use case and
potentially discussing naming for the third time until an agreement is reached.
The implementation of the discussion results needs to be written, reviewed and
maintained for long after. In the interest of transparency, [I work at
Tideways](https://tideways.com/open-source), which is a founding member and
silver sponsor of The PHP Foundation, and which sponsored part of my time
working on the `SortDirection`, `Time\Duration` and the current `Time\Instant`
RFCs. The PHP Foundation funds developers, like my co-author Derick, to do this
kind of work and it is a large part of why PHP’s standard library has kept
getting better in the last few years.

Here’s how *you* can help:

1. Try it: [Test PHP versions during their pre-release
period](https://thephp.foundation/blog/2026/08/17/how-to-contribute-to-php/#1.-test-prereleases),
focusing on new functionality, such as `Time\Duration`, and report any issues
you find, to help the feature make a good first impression on the community at
large after the stable release.
2. Accept it: Where possible, widen APIs in libraries you maintain to accept
the new types. A union type in a parameter allows you to do so without a
breaking change. This allows PHP developers to benefit from the clearer
terminology provided by the new classes, while continuing to rely on their
trusted libraries.
3. Shape it: Participate in the discussion of RFCs, such as [the one for
Time\\Instant](https://news-web.php.net/php.internals/132588). Any opinion, big
or small, provides value.
4. Fund it: If you cannot spend the time for (1) to (3) yourself, you can pay
others to spend the time, for example by convincing your employer to [sponsor
The PHP Foundation](https://thephp.foundation/sponsor/). Any improvement to PHP
itself will be paid back multiple times in improved developer experience.
