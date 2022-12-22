<?php

namespace eelib
{
    use RuntimeException;

    use function \strspn     as strspn;
    use function \strcspn    as strcspn;
    use function \strcmp     as strcmp;
    use function \strcasecmp as strcasecmp;
    use function \strncmp    as strncmp;
    use function \ucwords    as ucwords;

    require_once 'Extended/BinaryString.php';

    /**
     * Class BinaryString
     *
     * @package eelib
     * @version 2019.03.12
     */
    class BinaryString extends \Extended\BinaryString
    {
        /**
         * Split multibyte string using regular expression pattern.
         *
         * @link    https://php.net/manual/en/function.mb-split.php
         *
         * @param   string      $pattern
         * @param   string      $string
         * @param   int         $limit
         *
         * @return  string[]   The result as an array.
         */
        public static function regular_expression_split(
            string  $pattern,
            string  $string,
            int     $limit = -1
        ) : string
        {
            return \mb_split($pattern, $string, $limit);
        }

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
            ?int    $length
        ) : int
        {
            return strspn($subject, $characters, $offset = 0, $length);
        }

        /**
         * Find the first occurrence of a string.
         *
         * @link    https://www.php.net/manual/en/function.strstr.php
         *
         * @param   string  $haystack       The input string.
         * @param   string  $needle         The needle should either be explicitly cast to string,
         *                                  or an explicit call to chr() should be performed.
         * @param   bool    $before_needle  If true, strstr() returns the part of the haystack before
         *                                  the first occurrence of the needle (excluding the needle).
         *
         *
         * @return  string                  Returns part of haystack string starting from and
         *                                  including the first occurrence  of needle to the end of haystack.
 *
         * @throws RuntimeException
         */
        public static function find_first_occurrence(
            string  $haystack,
            string  $needle,
            bool    $before_needle = false
        ) : string
        {
            $strstr = strstr($haystack, $needle, $before_needle);

            if ($strstr === false) {
                throw new RuntimeException('needle is not found');
            }

            return $strstr;
        }

        /**
         * Translate characters or replace substrings.
         *
         * @link    https://www.php.net/manual/en/function.strtr.php
         *
         * @param   string  $string The string being translated.
         * @param   string  $from   The string being translated to to.
         * @param   string  $to     The string replacing from.
         *
         * @return  string          Returns the translated string.
         */
        public static function replace_substrings(
            string $string,
            string $from,
            string $to
        ) : string
        {

            return strtr($string, $from, $to);
        }

        public static function substr() {}
        public static function strlen() {}
        public static function str_replace() {}
        public static function trim() {}
        public static function strpos() {}
        public static function strtolower() {}
        public static function strtoupper() {}
    }
}
