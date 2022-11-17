<?php

namespace Extended
{
    /**
     * Class BinaryString Extended
     * Custom User Functions
     */
    class BinaryString
    {
        /**
         * Convert a multibyte string to an array.
         *
         * @link    http://php.net/manual/en/function.str-split.php
         *
         * @param   string        $string
         * @param   int           $split_length
         * @param   string|null   $encoding
         *
         * @return  array|bool      If the optional split_length parameter is specified,
         *                          the returned array will be broken down into chunks with
         *                          each being split_length in length,
         *                          otherwise each chunk will be one character in length.
         *
         *                          ELSE is returned if split_length is less than 1.
         *                          If the split_length length exceeds the length of string,
         *                          the entire string is returned as the first (and only) array element.
         */
        public static function split(
            string  $string,
            int     $split_length = 1,
            string  $encoding = NULL
        ) : array
        {
            if (\is_null($encoding))
            {
                $encoding = \mb_internal_encoding();
            }

            if ($split_length < 1)
            {
                return FALSE;
            }

            $return_value  = array();
            $string_length = \mb_strlen($string, $encoding);

            for ($i = 0; $i < $string_length; $i += $split_length)
            {
                $return_value[] = \mb_substr($string, $i, $split_length, $encoding);
            }

            return $return_value;
        }
    }
}

