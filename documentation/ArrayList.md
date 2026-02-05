# ArrayList

- [**first()**](#ArrayList::first)
- [**last()**](#ArrayList::last)
- [**firstKey()**](#ArrayList::firstkey)
- [**lastKey()**](#ArrayList::lastkey)
- [**differentValues()**](#ArrayList::differentvalues)
- [**sameValues()**](#ArrayList::samevalues)
- [**findValue()**](#ArrayList::findvalue)
- [**reindexValues()**](#ArrayList::reindexvalues)

**Extended**

- [**push()**](#push)
- [**pushAssociative()**](#pushassociative)

----

### ArrayList::first()
Gets the first element of an array
```php
public static function first(array $array): array
```

### ArrayList::last()
Gets the last element of an array
```php
public static function last(array $array): array
```

### ArrayList::firstKey()
Get the first key of the given array without affecting the internal array pointer.
Returns the first key of array if the array is not empty; NULL otherwise.
```php
public static function firstKey(array $array) : ?array
```

### ArrayList::lastKey()
Get the last key of the given array without affecting the internal array pointer.
Returns the last key of array if the array is not empty; NULL otherwise.
```php
public static function lastKey(array $array) : int|string
```

### ArrayList::differentValues()
https://www.php.net/manual/en/function.array-diff.php - has no expectations
```php
public static function differentValues(array $array, array ...$arrays) : array
```

### ArrayList::sameValues()
https://www.php.net/manual/en/function.array-intersect.php - has no expectations
```php
public static function sameValues(array $array, array ...$arrays) : array
```

### ArrayList::findValue()
Searches the array for a given value and returns the first corresponding key if successful
```php
public static function findValue(mixed $needle, array $haystack, bool $strict = false): bool|int|string
```

### ArrayList::reindexValues()
A numeric re-indexing of all the values of an array.
```php
public static function reindexValues(array $array): array
```

## Extended

### ArrayList::push()
Push one or more elements onto the end of array
http://php.net/manual/en/function.array-push.php
```php
final public static function push($array, $values): array
```

### ArrayList::pushAssociative()
Push one or more elements onto the end of array with the associated key.
```php
public static function pushAssociative(&$arr): int
```