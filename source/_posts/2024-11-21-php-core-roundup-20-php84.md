---
title: 'PHP Core Roundup #20: PHP&nbsp;8.4&nbsp;is&nbsp;Released!'
published_at: 21 November 2024
layout: post
tags:
  - roundup
author:
  - name: Ayesh Karunaratne
    url: https://aye.sh

  - name: Sergey Panteleev
    url: https://sergeypanteleev.com
---

We are thrilled to announce that after a year of hard work, dedication, and collaboration, [**PHP 8.4**](https://www.php.net/releases/8.4/) is officially here!

Thanks to the tireless efforts of the PHP Foundation members, the core PHP development team, and an incredible community of contributors, this upcoming version brings major new features and syntax, performance and security enhancements, and a healthy amount of deprecations.

## A Year of Hard Work and Collaboration

The PHP Foundation financially supports ten PHP core developers. The PHP Foundation members, along with a total of **115 contributors**, have made over **2,600 commits** since PHP 8.3 until PHP 8.4.0 release.

PHP 8.4 includes changes from **36 RFCs**. There have also been numerous mailing list discussions and RFCs that were withdrawn, declined, or are still under discussion.

Since PHP 8.0, PHP 8.4 received the highest number of RFCs, and PHP 8.4 brings the changes such as property hooks and asymmetric visibility that received significant community involvement and refinement.

## What PHP 8.4 Brings

PHP 8.4 brings numerous new features and improvements to PHP. We covered some of them in our [previous post](https://thephp.foundation/blog/2024/10/02/php-core-roundup-19) as well, but they are mentioned here as well, for more complete picture.

As we also covered in [PHP Core Roundup #19](https://thephp.foundation/blog/2024/10/02/php-core-roundup-19), Property Hooks and Asymmetric Visibility are two of the highlighted features in PHP 8.4

---

### PHP 8.4 supports Property Hooks!
  
In PHP 8.4, it is possible for a class to declare class properties with "hooks", that get executed when the property is accessed or set, and the hooks can access the object context.

[Property hooks](https://www.php.net/manual/en/language.oop5.property-hooks.php) open up a wide range of use cases that allow classes to declare virtual properties that enable expressive and intuitive APIs, make code readable and simple and avoid boilerplate code.

  
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
 
[Larry Garfield](https://github.com/Crell) wrote in [PHP 8.4: How Property Hooks Happened](/blog/2024/11/01/how-hooks-happened/) about how he and Ilija Tovilo 💜 brought Property Hooks to PHP.
  
### Asymmetric Visibility

PHP 8.4 introduces [asymmetric visibility](https://www.php.net/manual/en/language.oop5.visibility.php#language.oop5.visibility-members-aviz), allowing different access levels for getting and setting class properties. This feature is useful when you want to expose a property for reading but not writing.

```php
class User {  
 public private(set) int $userId;  
 public function __construct() { $this->userId = 42; }  
}  
  
$user = new User();  
echo $user->userId; // 42  
  
$user->userId = 16; // Error: Cannot modify private(set) property  
```

### Lazy Objects

PHP 8.4 brings support for Lazy Objects. Using the Reflection API, it is possible to create class instances in PHP 8.4 that they are initialized only if needed.

The [Lazy Objects documentation](https://www.php.net/manual/en/language.oop5.lazy-objects.php) provides detailed examples and use cases.

### HTML5-compliant parser in DOM Extension

PHP 8.4 upgrades the DOM extension with HTML5-compliant parsing. The new `Dom\HTMLDocument` and `Dom\XMLDocument` classes replace libxml2, which previously lacked HTML5 support. These updates improve DOM spec compliance and add features like CSS selector support.

### BCMath adds operator-overloaded `BcMath\Number` class

The BCMath extension now includes the `BcMath\Number` class, enabling operator overloading for arithmetic operations.

```php
use BcMath\Number;  
  
$num1 = new Number('22');  
$num2 = new Number('7');  
$num3 = new Number('100');  
  
$result = ($num1 / $num2) + $num1 - $num2;  
echo $result; // 18.1428571428
```

You can now use standard operators (`+`, `-`, `/`) with `BcMath\Number` objects, which also support all `bc*` functions.

These objects are immutable and implement the `Stringable` interface, so they can be used in string contexts like `echo $num`.



### New Functions

 - [`array_find`](https://www.php.net/array_find), [`array_find_key`](https://www.php.net/array_find_key), [`array_any`](https://www.php.net/array_any), and [`array_all`](https://www.php.net/array_all)
 - [`bcdivmod`](https://www.php.net/bcdivmod), [`bcround`](https://www.php.net/bcround), [`bcceil`](https://www.php.net/bcceil), and [`bcfloor`](https://www.php.net/bcfloor)
 - [`mb_trim`](https://www.php.net/mb_trim), [`mb_ltrim`](https://www.php.net/mb_ltrim), and [`mb_rtrim`](https://www.php.net/mb_rtrim)
 - [`mb_ucfirst`](https://www.php.net/mb_ucfirst) and [`mb_lcfirst`](https://www.php.net/mb_lcfirst)
 - [`grapheme_str_split`](https://www.php.net/grapheme_str_split)
 - [`fpow`](https://www.php.net/fpow)
 - [`http_get_last_response_headers`](https://www.php.net/http_get_last_response_headers) and [`http_clear_last_response_headers`](https://www.php.net/http_clear_last_response_headers)

### PDO Driver-Specific Subclasses

The [PDO Driver-specific subclasses](https://wiki.php.net/rfc/pdo_driver_specific_subclasses) RFC is implemented in PHP 8.4. Previously, it was voted for PHP 8.3 but was not implemented in PHP 8.3 before its feature-freeze. 

PHP 8.4 now adds `Pdo\Mysql`, `Pdo\Pgsql`, `Pdo\Sqlite`, `Pdo\DbLib`, and `Pdo\Firebird` classes that extend the `PDO` class. Driver-specific methods, properties, and constants are now available in the driver-specific subclass. Driver-specific sub classes also allow APIs to be more expressive and restrictive by allowing the functions and methods only to accept/return driver-specific sub-classes.

### `AEGIS-128L` and `AEGIS256` support in Sodium extension

**AEGIS** is an AES-based family of authenticated encryption algorithms that is faster than AES-GCM. The Sodium extension in PHP 8.4 supports [`AEGIS-128L`](https://www.php.net/manual/en/function.sodium-crypto-aead-aegis128l-encrypt.php) and [`AEGIS256`](https://www.php.net/manual/en/function.sodium-crypto-aead-aegis256-encrypt.php) encryption algorithms if the Sodium extension is compiled with [`libsodium`](https://github.com/jedisct1/libsodium) 1.0.19 or later.

<br/>

Apart from the new features, PHP 8.4 also updates several underlying dependencies and datasets, as well as unbundling three extensions:

### Updated dependencies

 - The Curl extension now requires libcurl 7.61.0 or later, and even capable of making HTTP/3 requests if it is compiled with a supporting TLS library.
 - The PCRE extension ships with PCRE 10.44, which provides support for Unicode 15 characters and character blocks, improved Regular Expression syntax, and performance improvements on certain systems.
 - OpenSSL extension now requires OpenSSL 1.1.1 or later, with improved support for OpenSSL 3.x series. It can now support Curve25519 and Curve448 based keys. Further, OpenSSL can be compiled to provide Argon2 password hashing on OpenSSL 3.2+ on PHP NTS builds.
 - To compile PHP as an Apache module (`mod_php`), PHP 8.4 drops support for the EOL Apache 2.0 and 2.2 series. The minimum required Apache version is now 2.4.
 - The zlib extension now requires zlib version 1.2.11 at minimum.

### Unbundled Extensions

[IMAP, Pspell, OCI8, and PDO_OCI8 extensions](https://wiki.php.net/rfc/unbundle_imap_pspell_oci8) are unbundled from the PHP core, and are now available as PECL extensions, for which [PIE might help](/blog/2024/11/19/pie-pre-release/) to install easily.

### Updated PHP Icon on Windows

PHP 8.4 also brings a minor, yet _very_ overdue change to the PHP icon on Windows executables:

|  ||
|:--:|:--:|
|![old PHP logo in Windows php.exe](/assets/post-images/2024/php84/php-icon-old.png)|![new PHP logo in Windows php.exe](/assets/post-images/2024/php84/php-icon-new.png)|
|Old Icon|New Icon|

## Looking Ahead: PHP 8.4 and Beyond

PHP 8.4 is the first major new PHP releases since the adoption of the new [PHP maintenance policy](/blog/2024/10/02/php-core-roundup-19/#php-release-cycle-updates). PHP 8.4, along with all current active PHP versions, will receive two years of active support and two years of security fixes.

What this means is that PHP 8.4 will receive bug fixes until the end of 2026 and security fixes until the end of 2028.

We just announced the pre-release of [PIE - PHP Installer for Extensions](/blog/2024/11/19/pie-pre-release/). PIE will significantly improve the workflow of downloading and compiling PHP extensions.

PHP 8.5 (in the `master` branch) is currently under active development, and we already have RFCs such as [Support Closures in constant expressions](https://wiki.php.net/rfc/closures_in_const_expr) in voting phase, and [Add RFC3986 and WHATWG compliant URI parsing support](https://wiki.php.net/rfc/url_parsing_api) under discussion.

## Get Ready to Upgrade

[PHP 8.4.1 is now a tagged release](https://github.com/php/php-src/releases/tag/php-8.4.1) on PHP's GitHub repository.

Compiled binaries and container images are available for:

 - Debian and Ubuntu-based Linux distros from [Ondrej Sury's repositories](https://deb.sury.org/).
 - Fedora/RHEL/Rocky/Alma Linux from [Remi's repositories](https://blog.remirepo.net/post/2024/09/27/PHP-on-the-road-to-the-8.4.0-release).
 - MacOS on [MacPorts](https://ports.macports.org/port/php84/) and Homebrew [shivammathur/homebrew-php](https://github.com/shivammathur/homebrew-php) tap.
 - Windows on [windows.php.net](https://windows.php.net/download/).
 - Docker and Podman [Docker Hub](https://hub.docker.com/_/php)

---

## Support PHP Foundation

At The PHP Foundation, we support, promote, and advance the PHP language. We financially support ten PHP core developers to contribute to the PHP project. You can help support PHP Foundation on [OpenCollective](https://opencollective.com/phpfoundation) or via [GitHub Sponsors](https://github.com/sponsors/ThePHPF).

A big thanks to all our sponsors — PHP Foundation is all of us!

Follow us on Twitter/X [@ThePHPF](https://twitter.com/thephpf), [Mastodon](https://phpc.social/@thephpf), [LinkedIn](https://www.linkedin.com/company/phpfoundation/), and [Bluesky](https://bsky.app/profile/thephpf.bsky.social) to get the latest updates from the Foundation.

💜️ 🐘

> PHP Roundup is prepared by Ayesh Karunaratne from **[PHP.Watch](https://php.watch)**, a source for PHP News, Articles, Upcoming Changes, and more.

