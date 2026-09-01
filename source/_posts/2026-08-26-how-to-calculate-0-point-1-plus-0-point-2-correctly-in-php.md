---
title: "How to Calculate 0.1 Plus 0.2 Correctly in PHP?"
description: "A guide to correct floating-point and integer calculations in PHP"
layout: post
tags:
    - stories
author:
  - weilin-du
published_at: 26 August 2026
---

Quick quiz before you read:

```php
<?php
var_dump(0.1 + 0.2 === 0.3);
```

[This returns false](https://3v4l.org/Qimvu). Now, as developers who proudly know [IEEE's floating rules](https://en.wikipedia.org/wiki/IEEE_754), many of you may take a sip of your coffee and say: Hey, that's not news anymore. We all know this classic case that warns generations of junior developers that calculating directly with floats might cause bugs.

However, let's see this case here (64-bit):

```php
<?php
var_dump((9223372036854775808 - 1) === 9223372036854775807);
```

Well, obviously this is an integer calculation. This is surely not affected by any strange floating-point behavior and should return true. We don't need to consider using any high-precision math extensions (BCMath, GMP) here, right?

Right?

# How PHP floats work

PHP's `float` type is platform-dependent, but it normally uses the IEEE 754 binary64 format which has a sign, an exponent and 53 bits of binary precision. The [PHP manual](https://www.php.net/manual/en/language.types.float.php) describes the practical result as roughly 14 decimal digits of precision and a maximum relative rounding error on the order of `1.11e-16`.

The important word is **binary**. A float represents a finite sum of powers of two. Fractions such as `0.5` (`1/2`) and `0.125` (`1/8`) have finite binary representations, so they can be stored exactly. `0.1` (`1/10`) cannot: its binary representation repeats forever, just as `1/3` repeats forever in decimal.

PHP therefore stores the nearest representable binary value. We can make those approximations visible by printing enough digits:

```php
<?php
printf("%.17g\n", 0.1);         // 0.10000000000000001
printf("%.17g\n", 0.2);         // 0.20000000000000001
printf("%.17g\n", 0.1 + 0.2);   // 0.30000000000000004
```

# Where precision gets lost

## Playing with floats

Both sides of the original comparison are floats, but they arrive at different nearby binary values:

```php
<?php
$sum = 0.1 + 0.2; // float(0.30000000000000004)

var_dump($sum === 0.3);              // false
var_dump(abs($sum - 0.3) < 1e-12);   // true
```

## Playing with big integers

PHP integers are signed and platform-dependent. The maximum value of an integer is given by [`PHP_INT_MAX`](https://www.php.net/manual/en/reserved.constants.php#constant.php-int-max).

On a 64-bit build, their range normally ends at `9223372036854775807`. According to the manual's [integer overflow rules](https://www.php.net/manual/en/language.types.integer.php#language.types.integer.overflow), a literal or operation outside the integer range becomes a float:

```php
<?php
var_dump(PHP_INT_MAX);       // int(9223372036854775807)
var_dump(PHP_INT_MAX + 1);   // float(9.223372036854776E+18)
```

Bingo! A binary64 float has enough range to hold a number of this magnitude, but not enough precision to distinguish every integer around it. So, let's go back to the example at the beginning.

```php
<?php
var_dump(((PHP_INT_MAX + 1) - 1) === PHP_INT_MAX);           // false
var_dump((9223372036854775808 - 1) === 9223372036854775807); // false (64-bit)
```

Once an integer has overflowed into a float, converting it back cannot recover the lost low-order digits.

# How to calculate floats in PHP correctly

Fine fine fine, floats are strange, many may say. But, is there a way in PHP to do those calculations correctly? Surely yes!

## Working safely with native floats

Floats are compact, fast, and well suited to approximate quantities. Using them correctly means accepting that their last digits are not exact. Here are some recommendations to work with PHP's native floats correctly:

### Do not blindly cast floats to integers!

Quiz time again! What does the following code output?

```php
<?php

$value = 0.58 * 100;

echo $value, "\n";
var_dump(intval($value));
var_dump((int) $value);
```

The output value is:

```
58
int(57)
int(57)
```

Interesting, isn't it? `intval()` and an `(int)` cast do not round to the nearest integer. They discard the fractional part by rounding towards zero. If this particular calculation is supposed to produce the nearest whole number, calling [`round()`](https://www.php.net/manual/en/function.round.php) first gives the expected result:

```php
<?php
$value = 0.58 * 100;
$result = (int) round($value);

var_dump($result); // int(58)
```

*So be careful when casting a float to an integer.*

One may ask: wait, why does `echo $value, "\n";` return `58` in this case? That leads to the second question:

### The INI setting `precision` does NOT fix the calculation

```php
<?php
ini_set('precision', '14'); // 14 is the default value.

$value = 0.58 * 100;

echo $value, "\n";        // 58
var_dump(intval($value)); // int(57)
```

Why can the same value, displayed as `58` by echo, be converted to `57` here? Printing the value with `echo` uses the configured `precision` that "hides" the final digits. Integer conversion does not use that rounded text obviously. It reads the stored float directly, and the stored value is slightly smaller than `58`.

The [`precision` php.ini directive](https://www.php.net/manual/en/ini.core.php#ini.precision) only controls how many digits are used when a float is converted to a string. It does not change the value in memory or the arithmetic performed by the processor:

```php
<?php
$sum = 0.1 + 0.2;

ini_set('precision', '17');
echo $sum, "\n"; // 0.30000000000000004

ini_set('precision', '14');
echo $sum, "\n"; // 0.3

var_dump($sum === 0.3); // bool(false)
```

Both `echo` statements read the same float. One representation hides the final digits and the other reveals them, but neither changes the result of the strict comparison.

PHP also has a separate `serialize_precision` directive. Despite its name, it controls the textual representation of floats produced not only by `serialize()`, but also by functions such as `json_encode()` and `var_dump()`. It does not affect the arithmetic that produced them. *They are NOT math features.*

### Comparing floats for equality based on tolerance

When approximate values are appropriate, the PHP manual recommends comparing them using an acceptable error bound instead of direct equality. The simple check shown earlier works when all values have a similar and known scale:

```php
<?php
$actual = 0.1 + 0.2;
$expected = 0.3;

var_dump(abs($actual - $expected) < 1e-12); // bool(true)
```

The tolerance must come from the domain. `1e-12` is suitable for this small demo, but it is certainly not a magic value that fits every calculation.

[`PHP_FLOAT_EPSILON`](https://www.php.net/manual/en/reserved.constants.php#constant.php-float-epsilon) describes the spacing between representable floats around `1.0`; it is not automatically the right tolerance for every magnitude or every application. See the manual's guidance on [comparing floats](https://www.php.net/manual/en/language.types.float.php#language.types.float.comparison) for the basic epsilon approach.

### Exact fixed-scale arithmetic with integers

When a value has a fixed smallest unit, storing that unit as an integer avoids binary fractions completely. For example, money is often stored as cents:

```php
<?php
$unitPriceInCents = 58;
$quantity = 3;
$totalInCents = $unitPriceInCents * $quantity;

var_dump($totalInCents); // int(174)
```

The conversion into minor units must also be exact. Do not receive `0.58` as a float and assume `(int) ($value * 100)` is safe; that is the same conversion bug we saw above. Parse a validated decimal string or use decimal arithmetic at the input boundary.

Native integers still have the `PHP_INT_MAX` limit. If the scaled values may exceed it, use an arbitrary-precision representation from the start.

## Core extensions can help!

Yelk. I don't want to remember these rules nor convert all my floats to integers by changing the units for precision. Well, here come the core extensions that might help you.

## Playing with floats? Use BCMath

[BCMath](https://www.php.net/manual/en/book.bc.php) performs arbitrary-precision decimal arithmetic. Its traditional functions receive and return strings, so the decimal input does not pass through a binary float first:

```php
<?php
$sum = bcadd('0.1', '0.2', 1);
$scaled = bcmul('0.58', '100', 0);

var_dump($sum);    // string(3) "0.3"
var_dump($scaled); // string(2) "58"
```

PHP 8.4 and later also provide the immutable [`BcMath\Number`](https://www.php.net/manual/en/class.bcmath-number.php) object with support for ordinary arithmetic operators:

```php
<?php
use BcMath\Number;

$sum = new Number('0.1') + new Number('0.2');

echo $sum, "\n"; // 0.3
```

The quotation marks are important. Construct the calculation from decimal strings such as `'0.1'`, but NOT from floats that may have already lost precision. Converting an approximate float to a BCMath value later cannot reconstruct the original exact decimal input.

BCMath is a good fit for prices, balances, rates, and other values where decimal places have an exact meaning.

## Playing with big integers? Use GMP

The [GMP extension](https://www.php.net/manual/en/book.gmp.php) works with arbitrary-length integers. It is not enabled by default and requires the external GMP library. It can calculate the large-integer example from the beginning without overflowing into a float:

```php
<?php
$number = gmp_init('9223372036854775808', 10);
$result = gmp_sub($number, '1');

echo gmp_strval($result), "\n"; // 9223372036854775807
```

Likewise, large inputs must be strings. Writing `9223372036854775808` as a PHP numeric literal first would allow PHP to convert it to a float before GMP receives it, which is already too late.

GMP represents integers rather than decimal fractions, so it cannot directly store `0.1`. It can handle fixed-scale values if the application represents every amount as an integer number of minor units. BCMath is usually clearer when the decimal scale itself is part of the data.

# Conclusion

## How to calculate 0.1 plus 0.2 correctly in PHP?

So, how should PHP calculate `0.1 + 0.2`? If the values are approximate, native float addition is already performing the expected binary calculation. Compare the result with an appropriate tolerance and format it for display. If the answer must be the exact decimal `0.3`, start with a decimal representation:

```php
<?php
echo bcadd('0.1', '0.2', 1); // 0.3
```

There is no `php.ini` switch that changes a binary float into an exact decimal. Correctness comes from choosing the representation before the calculation begins.

## Still evolving

Both BCMath and GMP are in active development. For example, PHP 8.6 adds two new functions to GMP: `gmp_prev_prime` and `gmp_powm_sec`. Those are useful functions! The PHP language is moving fast to make every PHP developer's life easier.

The PHP language is alive forever, with all the passion, work and pure love our dear contributors put in. Thank you for reading and using PHP!
