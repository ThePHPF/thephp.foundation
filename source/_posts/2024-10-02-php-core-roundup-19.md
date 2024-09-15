---
title: 'PHP Core Roundup #19'
layout: post
tags:
  - roundup
author:
  - name: Ayesh Karunaratne
    url: https://aye.sh

  - name: Sergey Panteleev
    url: https://sergeypanteleev.com
published_at: 02 October 2024
---

Welcome back to the PHP Core Roundup series, we cover what's new and changing in PHP and provide an update on the recent proposals to change and discussions around them.

Our last update was almost a year ago, and that was because we felt the PHP Core Roundup posts were getting stale and our previous format was repetitive and had a lot of changes that made the posts excessively long.

## The New PHP Core Roundup Series

Today, we are trying a new format that we got rid of text that looked like a mere changelog, to a post highlighting the general momentum of PHP development. This also means we might not get to celebrate and mention all the contributions from the PHP Foundation members and the other contributors as we did in previous posts.

Maintaining a mature, reliable, and widely used programming language that continues to get new features and improvements for almost 30 years involves a lot of work! Maintaining PHP documentation, php.net infrastructure, translations, triaging issues and security reports, bug fixes, mailing lists, reviewing RFCs, and packaging PHP only to name a few, we have PHP contributors and PHP Foundation members putting a commendable amount of effort into improving PHP!

While these PHP Core Roundup series may not write about these contributions often because we want to keep these posts exciting and resourceful, we want to spread love to all the contributors to the PHP ecosystem 💜.


## PHP Release Cycle Updates

In April, we voted and accepted an [RFC](https://wiki.php.net/rfc/release_cycle_update) to update our Release Cycle policy.

The PHP Core team provided two years of active support, followed by only one year of security fixes. We now have a new release cycle that, from PHP 8.1 (released in 2021 November), all PHP versions now get **two years of security fixes instead of one year**. The two-year active support period remains the same.

Further, we have changed the active-support and End-Of-Life dates to align to December 31st of the calendar year. This makes the support and EOL dates more predictable.

Here are the updated active-support and EOL dates for the current line-up of PHP versions. Dates changed from the previously set dates are in bold.


|PHP version|Release date|Active maintenance until|EOL date|
|:--:|:--:|:--:|:--:|
|PHP 8.1|2021-11-25|2023-11-25|**2025-12-31**|
|PHP 8.2|2022-12-08|**2024-12-31**|**2026-12-31**|
|PHP 8.3|2023-11-23|**2025-12-31**|**2027-12-31**|
|PHP 8.4|2024-11-21|2026-12-31|2028-12-31|
|PHP 8.5|2025-11|2027-12-31|2029-12-31|


## PHP Core Developments

A few days ago, PHP 8.4 reached its feature-freeze. PHP 8.4 is slated to be released on November 21st of this year.

The first release candidate for PHP 8.4 is already out — they are not production-ready, but they are available to try out and test PHP application on, either by compiling from [source](https://github.com/php/php-src/tags), using [Windows binaries](https://windows.php.net/qa/), or in [Docker containers](https://hub.docker.com/_/php/tags?name=8.4-).

### Highlights for PHP 8.4

PHP 8.4 is an important release that brings major new features, several updates to the build dependencies and underlying libraries, and a fair bit of deprecations to iron out some of the legacy and undesirable behaviors and features in legacy PHP versions.

Using various approaches, each PHP version brings a lot of performance improvements and security tightening too. In PHP 8.4, we continue this in this direction with several minor internal improvements as well as noticeable improvements in JIT, and PHP extensions such as mbstring, BCMath, XML extensions, PCRE, and more.

Further, PHP 8.4 unbundles IMAP, Pspell, OCI, and pdo_oci extensions. It means if you wanted to continue using them, you'll have to install via PECL.

### Property Hooks and Asymmetric Visibility

One of the most important features in PHP 8.4 is that you can now use [property hooks](https://wiki.php.net/rfc/property-hooks) and declare property [visibility separately](https://wiki.php.net/rfc/asymmetric-visibility) for get and set operations.

Property hooks allow declaring virtual properties with "hooks" that get executed when the properties are accessed or set, and the hooks get called with the object in context, to run their own logic.

```php
class User {
    public string $emailAddress {
		set {
			if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
				throw new ValueError('emailAddress property must be a valid email address');
			}
            $this->emailAddress = $value;
        }
	}
}

$user = new User();
$user->emailAddress = 'test@example.com'; // Allowed
$user->emailAddress = 'not an email address'; // Throws ValueError
```

Property hooks open up a vast possibilities to leading to less boilerplate code, improve readability, and make PHP classes and their APIs more intuitive.

The [Property Hooks RFC](https://wiki.php.net/rfc/property-hooks) is perhaps our longest RFC ever, detailing use cases and syntax such as short functions, using them in constructor-promoted class properties, how a subclass can override or call parent property hooks, how they work with other mechanics such as readonly, magic methods, references, arrays, etc.

We will be covering more about details and mechaniscs of Property Hooks soon in future posts.

### Asymmetric Visibility

Another useful feature added in PHP 8.4 is the ability to set different visibility scopes for get and set operations. This comes in situations where exposing a class property to be _read_ is desired, but not to _write_.

```php
class User {
    public private(set) int $userId;

    public function __construct() {
        $this->userId = 42; // e.g. set from a database value
    }
}

$user = new User();
echo $user->userId; // 42

$user->userId = 16; // Not allowed
// Error: Cannot modify private(set) property User::$userId from global scope
```

### Improved HTML5 Parser

The DOM Extension in PHP 8.4 received a massive feature-update as well. Previously, the DOM extension only offered libxml2 to parse HTML, which has not kept up with HTML5. The DOM extension now offers new `Dom\HTMLDocument` and `Dom\XMLDocument` classes with the former supporting HTML5-compliant parsing support.

There are lots of new improvements in this space, including not only the [HTML5 parsing support](https://wiki.php.net/rfc/domdocument_html5_parser), but also [DOM spec compliance](https://wiki.php.net/rfc/opt_in_dom_spec_compliance) and several small [additions](https://wiki.php.net/rfc/dom_additions_84) including adding support for CSS selectors.

### BCMath extension getting `Number` class and new functions

The BCMath extension in PHP 8.4 now has classes with support for operator overloading support!

```php
use BCMath\Number;  
  
$num1 = new Number('22');  
$num2 = new Number('7'); 
$num3 = new Number('100');
  
$result = ($num1 / $num2) + $num1 - $num2;
echo $result; // 18.1428571428
```

Now, instead of using BCMath functions such as `bcadd`, `bcsub`, `bcdiv`, etc, you can now simply use standard operators (`+`, `-`, `/`, etc.).

The new `BCMath\Number` class supports operator overloading, which cannot be done by userland PHP classes yet, but the BCMath extension implements it, so you can use them as if they were regular numbers.

The `BCMath\Number` class implements `Stringable` interface, so the objects can be used where a string is expected (like how the example above uses it with an `echo` call). Further, the class implements all `bc*` functions. For example, it's also possible to call `$num->add($num2)` or `$num->add('5')` and it returns a new `BCMath\Number` object without modifying the original object, which makes them immutable.

This comes from Saki Takamachi 💜, one of our new PHP Foundation members. She also made several new improvements including adding new `bcfloor`, `bcceil`, `bcround`, and `bcdivmod` functions.

### ... and more!

PHP 8.4 is shaping up to be an impactful version, with features such as property hooks and asymmetric visibility we mentioned above, and a healthy amount of deprecations including deprecating [implicitly nullable parameter declarations](https://php.watch/versions/8.4/implicitly-marking-parameter-type-nullable-deprecated).

Further, PHP 8.4 will be released after some popular Linux distro versions in server space reach their EOL date (such as Ubuntu 18.04 and RHEL/CentOS 7), so we took this opportunity to bump the minimum required dependency versions for Curl (>= 7.61.0), OpenSSL (>= 1.1.1). The PHP 8.4 mbstring extension is also updated to with the latest Unicode Character Database version 16 data.

See the lengthy [`UPGRADING`](https://github.com/php/php-src/blob/PHP-8.4/UPGRADING) file for a complete list of changes, but we will also be covering the important ones in the upcoming PHP Core Roundup posts.

## What's in the making

On September 30th, PHP 8.4 reached its feature-freeze, which means PHP 8.4 syntax and features are now fixed; PHP 8.4 will get ironed out and the first GA release is scheduled for November 21st.

### PIE : PHP Installer for Extensions

PIE is a new initiative to be an eventual replacement for PECL. It's still under development, but it will be able to download, build, and install PIE-compatible extensions.

### Real-time benchmarking

Máté Kocsis 💜 [was](https://externals.io/message/116323) working on a real-time fully-automated and reproducible [benchmark](https://github.com/kocsismate/php-version-benchmarks?tab=readme-ov-file#introduction) for PHP. It is now active (with daily results available [here](https://github.com/php/real-time-benchmark-data)).

Using these test suits, we now have reliable data on the performance improvements or degradation in each PHP version.

---

## Support PHP Foundation

At The PHP Foundation, we support, promote, and advance the PHP language. We financially support ten PHP core developers to contribute to the PHP project. You can help support PHP Foundation on [OpenCollective](https://opencollective.com/phpfoundation) or via [GitHub Sponsors](https://github.com/sponsors/ThePHPF).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter/X [@ThePHPF](https://twitter.com/thephpf) or  [Mastodon](https://phpc.social/@thephpf) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more.

