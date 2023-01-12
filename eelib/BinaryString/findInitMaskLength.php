<?php

namespace eelib\Functions\BinaryString
{
    trait findInitMaskLength
    {
        /**
         * Finds the length of the initial segment of a string consisting entirely
         * of characters contained within a given mask.
         *
         * @link    http://php.net/manual/en/function.strspn.php
         *
         * @example http://www.w3resource.com/php/function-reference/strspn.php
         * @example https://www.w3schools.com/php/func_string_strspn.asp
         *
         * @param   string      $subject
         * @param   string      $characters
         * @param   int         $offset
         * @param   int|null    $length Default: null
         *
         * @return  int         Returns the length of the initial segment of string which consists entirely
         *                      of characters in characters.
         */
        final public static function findInitMaskLength(
            string  $subject,
            string  $characters,
            int     $offset = 0,
            ?int    $length = NULL
        ) : int
        {
            return \strspn($subject, $characters, $offset = 0, $length);
        }

    }
}