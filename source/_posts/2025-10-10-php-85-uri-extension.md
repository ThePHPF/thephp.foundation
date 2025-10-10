---
title: 'PHP’s New URI Extension: An Open Source Success Story'
layout: post
tags:
  - stories
author:
  - name: Tim Düsterhus
    url: https://github.com/TimWolla/

published_at: 10 October 2025

---

URLs are a fundamental building block of the Web we rely on every day.

Their familiarity makes them appear deceptively simple: Seemingly clearly
delineated components like scheme, hostname, path, and some others suggest that
it’s trivial to extract information from a URL. In reality, there are thousands
of custom parsers built over the years, each with their own take on details.

For us web developers, there are two main standards specifying how URLs are
supposed to work. [RFC 3986](https://datatracker.ietf.org/doc/html/rfc3986),
which is the original URI standard from 2005; and the [WHATWG URL Living
Standard](https://url.spec.whatwg.org/), which is followed by web browsers.
Because things are not as simple as they appear at first glance, these two
commonly used standards are incompatible with each other\! Mixing and matching
different standards and their parsers, especially when they do not *exactly*
follow the standard, is something that [commonly leads to security
issues](https://daniel.haxx.se/blog/2022/01/10/dont-mix-url-parsers/).

## Why Change Was Needed

Despite the importance of correctly parsing URLs, PHP did not include any
standards-compliant parser within the standard library for the longest time.
There is the
[`parse_url()`](https://www.php.net/manual/en/function.parse-url.php) function,
which has existed since PHP 4, but it does not follow any standard and is
explicitly documented not to be used with untrusted or malformed URLs.
Nevertheless, it is commonly used for lack of a better alternative that is
readily available and also because it appears to work correctly for a majority
of well-formed inputs that developers encounter in day-to-day work. This can
mislead developers to believe that the security issues of `parse_url()` are a
purely theoretical problem rather than something that *will* cause issues
sooner or later.

As an example, the input URL `example.com/example/:8080/foo` is a valid URL
consisting of only a relative path according to RFC 3986\. It is invalid
according to the WHATWG URL standard when not resolved against a base URL.
However, according to `parse_url()` it is a URL for the host `example.com`,
port 8080 and path `/example/:8080/foo`, thus including the 8080 in *two* of
the resulting components:

```php
<?php

var_dump(parse_url('example.com/example/:8080/foo'));

/*
array(3) {
  ["host"]=> string(11) "example.com"
  ["port"]=> int(8080)
  ["path"]=> string(18) "/example/:8080/foo"
}
*/
```

## Introducing a New API

This changes with PHP 8.5. Going forward, PHP will include standards-compliant
parsers for both RFC 3986 and the WHATWG URL standard as an *always-available*
part of its standard library within a new “URI” extension. Not only will this
enable easy, correct, and secure parsing of URLs according to the respective
standard, but the URI extension also includes functionality to modify
individual components of a URL.

```php
<?php

use Uri\Rfc3986\Uri;

$url = new Uri('HTTPS://thephp.foundation:443/sp%6Fnsor/');

$defaultPortForScheme = match ($url->getScheme()) {
    'http' => 80,
    'https' => 443,
    'ssh' => 22,
    default => null,
};

// Remove default ports from URLs.
if ($url->getPort() === $defaultPortForScheme) {
    $url = $url->withPort(null);
}

// Getters normalize the URL by default. The `Raw`
// variants return the input unchanged.

echo $url->toString(), PHP_EOL;
// Prints: https://thephp.foundation/sponsor/
echo $url->toRawString(), PHP_EOL;
// Prints: HTTPS://thephp.foundation/sp%6Fnsor/
```

## Thoughtfully Built to Last

In this post we not only want to showcase the functionality but also tell you
the story of how this project developed and how work gets done in PHP to keep
the language modern and a great choice for web development. There is often more
work behind new PHP features than meets the eye. We hope to provide some
insight into why we prefer doing things right rather than fast.

[Máté Kocsis](https://github.com/kocsismate) from The PHP Foundation’s dev team
initially started discussion for his [RFC of a new URL parsing
API](https://wiki.php.net/rfc/url_parsing_api) in June 2024\. Given PHP’s
strong backwards compatibility promise, the new API needed to get things right
on the first attempt in order to serve the PHP community well for the decade to
come without introducing disruptive changes. Thus, over the course of *almost
one year*, [more than 150 emails on the PHP Internals
list](https://news-web.php.net/php.internals/123997) were sent. Additionally,
several off-list discussions in various chat rooms have been had. Throughout
this process, various experts from the PHP community continuously refined the
RFC. They discussed even seemingly insignificant details, to provide not just a
standards-compliant implementation, but also a clean and robust API that will
guide developers towards the right solution for their use case. We also planned
ahead and made sure that the new URI extension with its dedicated `Uri`
namespace provides a clear path forward to add additional URI/URL-related
functionality in future versions of PHP.

The RFC ultimately went to vote in May 2025 and was accepted with a 30:1 vote.
But work didn’t stop there: The proposed API also had to be implemented and
reviewed. Instead of building a PHP-specific solution, Máté opted to stand on
the shoulders of giants and selected two libraries to perform the heavy
lifting. The [uriparser library](https://uriparser.github.io/) provides the RFC
3986 parser, and the [Lexbor library](https://lexbor.com/), which is already
used by PHP 8.4’s new DOM API, provides the WHATWG parser.

## Open Source Collaboration

As part of the integration, Máté and The PHP Foundation worked together with
the upstream maintainers to include missing functionality in the respective
libraries. As an example, neither library included functionality to cheaply
duplicate the internal data structures, which was necessary to support cloning
the readonly PHP objects representing the parsed URL when attempting to modify
individual components with the so-called with-er methods (e.g.,
`->withPort(8080)`). The uriparser library also did not include any functions
for modifying components of a parsed URL. All this functionality is now
available in the upstream libraries for everyone to use and benefit from.

The review and testing of Máté’s PHP implementation was carried out by PHP
community contributors [Niels Dossche](https://github.com/nielsdos/) and
[Ignace Nyamagana Butera](https://github.com/nyamsprod/). This included
reviewing and testing the new functionality that had been added to the two
upstream libraries. [Tideways, a founding member and Silver
sponsor](https://thephp.foundation/#sponsors_silver) of The PHP Foundation,
also sponsored engineering time; their contribution came in the form of [Tim
Düsterhus](https://github.com/TimWolla/). During the review and testing, these
reviewers discovered several pre-existing bugs in the upstream libraries. They
submitted fixes to the upstream maintainers, [Sebastian
Pipping](https://github.com/hartwork) (uriparser) and [Alexander
Borisov](https://github.com/lexborisov) (Lexbor), who quickly reviewed and
applied them.

## Test It Now

This work paid off, and PHP’s new URI extension with not just one but two
feature-rich and standards-compliant URI implementations is fully available for
testing with PHP 8.5 RC 1\.

If you'd like to see further improvements to PHP’s standard library please
consider [sponsoring The PHP Foundation](https://thephp.foundation/sponsor/).
