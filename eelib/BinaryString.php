<?php

namespace eelib
{
    require_once 'Extended/BinaryString.php';
    require_once 'BinaryString/findInitMaskLength.php';

    use eelib\Functions\BinaryString\findInitMaskLength;

    use function \strspn     as strspn;
    use function \strcspn    as strcspn;
    use function \strcmp     as strcmp;
    use function \strcasecmp as strcasecmp;
    use function \strncmp    as strncmp;
    use function \ucwords    as ucwords;
    use function \strtok     as strtok;

    use RuntimeException;


    /**
     * Class BinaryString
     *
     * @package eelib
     * @version 2019.03.12
     */
    abstract class BinaryString extends \Extended\BinaryString
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
        final public static function regular_expression_split(
            string  $pattern,
            string  $string,
            int     $limit = -1
        ) : string
        {
            return \mb_split($pattern, $string, $limit);
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
        final public static function find_first_occurrence(
            string  $haystack,
            string  $needle,
            bool    $before_needle = false
        ) : string
        {
            $stringValue = strstr($haystack, $needle, $before_needle);

            if ($stringValue === false) {
                throw new RuntimeException('needle is not found');
            }

            return $stringValue;
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
        final public static function replace_substrings(
            string $string,
            string $from,
            string $to
        ) : string
        {

            return strtr($string, $from, $to);
        }

        /**
         * Finds the length of the initial segment of a string consisting entirely of characters contained within a given mask.
         *
         * @link http://php.net/manual/en/function.strspn.php
         * @link http://www.w3resource.com/php/function-reference/strspn.php
         * @link https://www.w3schools.com/php/func_string_strspn.asp
         *
         * @param string $subject
         * @param string $mask
         * @param int    $start   Default: null
         * @param int    $length  Default: null
         *
         * @return int
         */
        final public static function FindInitMaskLength($subject, $mask, $start = NULL, $length = NULL)
        {
            return strspn($subject, $mask, $start, $length);
        }

        /**
         * Find length of initial segment not matching mask
         *
         * @link http://php.net/manual/en/function.strcspn.php
         * @link http://www.w3resource.com/php/function-reference/strcspn.php
         * @link https://www.w3schools.com/php/func_string_strcspn.asp
         *
         * @param string $str1
         * @param string $str2
         * @param int    $start  Default: null
         * @param int    $length Default: null
         *
         * @return int
         */
        final public static function FindInitNotMaskLength($str1, $str2, $start = NULL, $length = NULL)
        {
            return strcspn($str1, $str2, $start, $length);
        }

        /**
         * Binary safe string comparison
         *
         * @link http://php.net/manual/en/function.strcmp.php
         *
         * @param string $str1
         * @param string $str2
         *
         * @return int
         */
        final public static function Compare($str1, $str2)
        {
            return strcmp($str1, $str2);
        }

        /**
         * Binary safe case-insensitive string comparison
         *
         * @link http://php.net/manual/en/function.strcasecmp.php
         *
         * @param string $str1
         * @param string $str2
         *
         * @return int
         */
        final public static function CompareCaseInsensitive($str1, $str2)
        {
            return strcasecmp($str1, $str2);
        }

        /**
         * Binary safe string comparison of the first n characters
         *
         * @link http://php.net/manual/en/function.strncmp.php
         *
         * @param string $str1
         * @param string $str2
         * @param int    $len
         *
         * @return int
         */
        final public static function CompareFirstCharacters($str1, $str2, $len)
        {
            return strncmp($str1, $str2, $len);
        }

        /**
         * Uppercase the first character of each word in a string
         *
         * @link http://php.net/manual/en/function.ucwords.php
         *
         * @param $string
         * @param string $delimiters
         *
         * @return string
         */
        final public static function UpperCaseWords($string, $delimiters = ' \t\r\n\f\v')
        {
            return ucwords($string, $delimiters);
        }

        /**
         * @param   $string
         * @param   $token
         * @return  false|string
         */
        final public static function SubstringExtract($string, $token)
        {
            return strtok($string, $token);
        }

        /**
         * Checks if all of the characters in the provided string text are hexadecimal 'digits'.
         *
         * @link http://php.net/manual/en/function.ctype-xdigit.php
         *
         * @param $text
         *
         * @return bool
         */
        final public static function isHexadecimalDigit($text)
        {
            return ctype_xdigit($text);
        }

        final public static function substr() {}
        final public static function strlen() {}
        final public static function str_replace() {}
        final public static function trim() {}
        final public static function strpos() {}
        final public static function strtolower() {}
        final public static function strtoupper() {}
    }
}

// TODO:
// ctype_alnum
// ctype_alpha
// ctype_cntrl
// ctype_digit
// ctype_graph
// ctype_lower
// ctype_print
// ctype_punct
// ctype_space
// ctype_upper