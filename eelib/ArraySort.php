<?php

namespace eelib
{
    use function \sort;

    /**
     * Class ArraySort
     *
     * @package eelib
     * @version 2022.12.05
     */
    class ArraySort
    {
        const REGULAR       = \SORT_REGULAR;        // Compare items normally; the details are described in the comparison operators section.
        const NUMERIC       = \SORT_NUMERIC;        // Compare items numerically.
        const STRING        = \SORT_STRING;         // Compare items as strings.
        const LOCALE_STRING = \SORT_LOCALE_STRING;  // Compare items as strings, based on the current locale. It uses the locale, which can be changed using setlocale().
        const NATURAL       = \SORT_NATURAL;        // Compare items as strings using "natural ordering" like natsort().
        const FLAG_CASE     = \SORT_FLAG_CASE;      // Can be combined (bitwise OR) with SORT_STRING or SORT_NATURAL to sort strings case-insensitively.

        /**
         * Sorts array in place by values in ascending order.
         *
         * @link    https://www.php.net/manual/en/function.sort.php
         *
         * @param   array   $array  The input array to sort.
         * @param   int     $flags  The optional second parameter flags may be used to modify the sorting behavior.
         *
         * @return  array           Returns the an array in ascending order.
         */
        public static function ascending_sort(array $array, int $flags = self::REGULAR): array
        {
            sort($array, $flags);

            return $array;
        }
    }
}
