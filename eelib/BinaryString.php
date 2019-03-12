<?php

namespace eelib
{
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
         * @return  string[]    The result as an array.
         */
        public static function regular_expression_split(string $pattern , string $string, int $limit = -1)
        {
            return \mb_split($pattern, $string, $limit);
        }
    }
}
