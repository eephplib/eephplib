<?php

declare(strict_types=1);

// https://www.php.net/manual/en/class.iteratoraggregate.php#112432
namespace eelib
{

    use function array_diff;
    use function array_key_first;
    use function array_key_last;
    use function array_keys;
    use function array_search;
    use function array_slice;
    use function array_values;
    use function function_exists;
    use function key;

    require_once 'Extended/ArrayList.php';

    /**
     * Class ArrayList
     *
     * @package eelib
     * @version 2022.10.16
     */
    class ArrayList extends \Extended\ArrayList
    {
        public ArraySort $sort;
        public ArrayIterate $iterate;

        public function __construct()
        {
            $this->sort = new ArraySort;
            $this->iterate = new ArrayIterate;
        }
        /**
         * Gets the first element of an array
         *
         * @return  array   Returns the first element of $array
         */
        public static function first(array $array): array
        {
            return array_values($array)[0] ?? [];
        }

        /**
         * Gets the last element of an array
         *
         * @return  array   Returns the last element of $array
         */
        public static function last(array $array): array
        {
            return array_values(array_slice($array, -1))[0] ?? [];
        }

        /**
         * Get the first key of the given array
         * without affecting the internal array pointer.
         * Returns the first key of array if the array is not empty; NULL otherwise.
         *
         * @link http://php.net/manual/en/function.array-key-first.php
         * @return  mixed|null      
         */
        public static function firstKey(array $array) : ?array
        {
            if (function_exists('array_key_first') === TRUE)
            {
                return array_key_first($array);
            }

            return $array ? array_keys($array)[0] : NULL;
        }

        /**
         * Get the last key of the given array without affecting the internal array pointer.
         * Returns the last key of array if the array is not empty; NULL otherwise.
         *
         * @link http://php.net/manual/en/function.array-key-last.php
         */
        public static function lastKey(array $array) : int|string
        {
            if (function_exists('array_key_first') === TRUE)
            {
                return array_key_last($array);
            }

            return key(array_slice($array, -1, 1, TRUE));
        }
        
        // https://www.php.net/manual/en/function.array-diff.php - has no expectations
        public static function differentValues(array $array, array ...$arrays) : array
        {
            return array_diff($array, $arrays);
        }
        
        // https://www.php.net/manual/en/function.array-intersect.php - has no expectations
        public static function sameValues(array $array, array ...$arrays) : array
        {
            return array_diff($array, $arrays);
        }

        /**
         * Searches the array for a given value and returns the first corresponding key if successful
         *
         * @link    https://www.php.net/manual/en/function.array-search.php
         *
         * @param   mixed   $needle
         * @param   array   $haystack
         * @param   bool    $strict
         *
         * @return  false|int|string
         */
        public static function findValue(mixed $needle, array $haystack, bool $strict = false): bool|int|string
        {
            return array_search($needle, $haystack, $strict);
        }


        /**
         * A numeric re-indexing of all the values of an array.
         *
         * @link    https://www.php.net/manual/en/function.array-values
         *
         * @param array $array
         *
         * @return array    All the values from the array and indexes the array numerically.
         */
        public static function reindexValues(array $array): array
        {
            return array_values($array);
        }
    }
}
