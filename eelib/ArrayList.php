<?php

namespace eelib
{
    require_once 'Extended/ArrayList.php';

    /**
     * Class ArrayList
     *
     * @package eelib
     * @version 2019.03.11
     */
    class ArrayList extends \Extended\ArrayList
    {
        /**
         * Gets the first element of an array
         * Note: "??" (or null coalescing) operator requires PHP 7
         *
         * @since   PHP 7
         *
         * @param   array $array
         *
         * @return  mixed|null   Returns the first element of $array
         */
        public static function first(array $array)
        {
            return \array_values($array)[0] ?? NULL;
        }

        /**
         * Gets the last element of an array
         * Note: "??" (or null coalescing) operator requires PHP 7
         *
         * @since   PHP 7
         *
         * @param   array $array
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
         *
         * @link    http://php.net/manual/en/function.array-key-first.php
         * @since   PHP 4|7.3.0
         *
         * @param   array $array
         * @return  mixed|null      Returns the first key of array if the array is not empty; NULL otherwise.
         */
        public static function first_key(array $array)
        {
            if (\function_exists('array_key_first') === TRUE)
            {
                return \array_key_first($array);
            }

            return $array ? \array_keys($array)[0] : NULL;
        }

        /**
         * Get the last key of the given array without affecting the internal array pointer.
         *
         * @link    http://php.net/manual/en/function.array-key-last.php
         * @since   PHP 7|7.3.0
         *
         * @param array $array
         *
         * @return int|mixed|string|null    Returns the last key of array if the array is not empty; NULL otherwise.
         */
        public static function last_key(array $array)
        {
            if (\function_exists('array_key_first') === TRUE)
            {
                return \array_key_last($array);
            }

            return \key(\array_slice($array, -1, 1, TRUE));
        }
    }
}
