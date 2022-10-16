<?php

namespace eelib
{
    require_once 'Extended/ArrayList.php';

    /**
     * Class ArrayList
     *
     * @package eelib
     * @version 2022.10.16
     */
    class ArrayList extends \Extended\ArrayList
    {
        /**
         * Gets the first element of an array
         *
         * @return  mixed|null   Returns the first element of $array
         */
        public static function first(array $array)
        {
            return \array_values($array)[0] ?? NULL;
        }

        /**
         * Gets the last element of an array
         *
         * @return  mixed|null   Returns the last element of $array
         */
        public static function last(array $array)
        {
            return \array_values(\array_slice($array, -1))[0] ?? NULL;
        }

        /**
         * Get the first key of the given array
         * without affecting the internal array pointer.
         * Returns the first key of array if the array is not empty; NULL otherwise.
         *
         * @link http://php.net/manual/en/function.array-key-first.php
         * @return  mixed|null      
         */
        public static function firstKey(array $array) : array
        {
            if (\function_exists('array_key_first') === TRUE)
            {
                return \array_key_first($array);
            }

            return $array ? \array_keys($array)[0] : NULL;
        }

        /**
         * Get the last key of the given array without affecting the internal array pointer.
         * Returns the last key of array if the array is not empty; NULL otherwise.
         *
         * @link http://php.net/manual/en/function.array-key-last.php
         */
        public static function lastKey(array $array) : array
        {
            if (\function_exists('array_key_first') === TRUE)
            {
                return \array_key_last($array);
            }

            return \key(\array_slice($array, -1, 1, TRUE));
        }
        
        // https://www.php.net/manual/en/function.array-diff.php - has no expectations
        public static function differentValues(array $array, array ...$arrays) : array
        {
            return \array_diff($array, $arrays);
        }
        
        // https://www.php.net/manual/en/function.array-intersect.php - has no expectations
        public static function sameValues(array $array, array ...$arrays) : array
        {
            return \array_diff($array, $arrays);
        }
    }
}
