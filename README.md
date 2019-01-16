[![Build Status](https://travis-ci.org/creativestyle/php-utilities.svg?branch=master)](https://travis-ci.org/creativestyle/php-utilities)

Common PHP Utilities Library
============================

A collection of utility methods for Strings, Arrays and Numbers. A must-have in most projects.

## Installation

```
composer require creativestyle/utilities
```

## ArrayHelpers

### `pickColumn(array $table, $column)`

Assuming that you've got an array of associate arrays (`$table`) this method
will return a single-dimensional array with values of the selected key (`$column`).

### `pick(array $keys, array $subject)`

Picks selected `$keys` from the `$subject` associative array.

### `map(array $arr, $callback)`

Maps the array allowing you to change the keys.

Callback is called with (`$key`, `$value`) parameters and shall return a `[$newkey => $newvalue]` array.

It's possible to map a single entry to multiple by returning more than one item from the `$callback`.

### `average(array $arr, $key = null)`

Averages array values.
If key is set then the column indicated by key is averaged.


## RandHelpers

### `seed()`

Returns long string of digits.

### `randBool($trueChance)`

Returns random bool with `$trueChance` [0, 1] of returning `true`.

### `arrayRand(array $array)`

Returns random array element.

### `sample(array $array, $count = 1)`

Returns `$count` unique random elements from the `$array`.

If the desired number of results is equal or greater to the array size then the array is shuffled.
If it's less or equal to 0, then empty array is returned.

### `gaussianRand($mu, $sigma)`

Returns a random number from gaussian distribution with desired params.

### `normalProbabilityDensity($x, $mu, $sigma)`

Returns a random number from normal distribution with desired params.


## StringHelpers

### `urlize($text)`

Transliterates the text keeping only alphanumeric characters and `-`.
Whitespace is collapsed and transformed to `-`.

### `slugify($text)`

Alias to `urlize()`.

### `joinNotEmpty(array $elements, $delimiter = ', ')`

Behaves the same way as `implode` but skips empty array elements.

### `endsWith($haystack, $needle)`

Checks if `$haystack` ends with `$needle`.

### `startsWith($haystack, $needle)`

Checks if `$haystack` starts with `$needle`.

### `convertToTitleCase($string)`

Converts the string To The Title Case.

### `capitalize($string)`

Capitalizes the string (same as `ucfirst`) in a multibyte-safe manner.

### `humanize($text)`

Humanizes a camelCase variable name. For example `virtualRealityInterposer` will become `Virtual reality interposer`.

### `humanizeConst($constName)`

Works similar to `humanize` but converts const names like `VIRTUAL_REALITY_INTERPOSER`.

### `isCoercibleToString($value)`

Returns true if the value can be converted to string (is a scalar or has `__toString` method).
