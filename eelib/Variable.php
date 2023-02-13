<?php


namespace eelib
{
    use function \empty;
    use function \is_string;
    use function \is_float;
    use function \is_int;
    use function \is_bool;

    class Variable
    {
        /**
         * Determine whether a variable is considered to be empty.
         * A variable is considered empty if it does not exist
         * or if its value equals false.
         *
         * @link    https://php.net/manual/en/function.empty
         * @example https://www.php.net/manual/en/function.empty.php#114267
         *
         * @param   mixed   $var    Variable to be checked.
         *
         * @return  bool            Returns true if var does not exist or
         *                          has a value that is empty or equal to zero,
         *                          known as false-like; see conversion to boolean.
         *                          Otherwise, returns false.
         */
        public static function isEmpty($var) : bool
        {
            return empty($var);
        }

        /**
         * https://www.php.net/manual/en/function.is-string.php
         *
         * @param $value
         *
         * @return bool
         */
        public static function isString($value) : bool
        {
            return is_string($value);
        }

        /**
         * https://www.php.net/manual/en/function.is-float.php
         *
         * @param $value
         *
         * @return bool
         */
        public static function isFloat($value) : bool
        {
            return is_float($value);
        }

        /**
         * https://www.php.net/manual/en/function.is-int.php
         *
         * @param $value
         *
         * @return bool
         */
        public static function isInteger($value) : bool
        {
            return is_int($value);
        }

        /**
         * https://www.php.net/manual/en/function.is-bool.php
         *
         * @param $value
         *
         * @return bool
         */
        public static function isBoolean($value) : bool
        {
            return is_bool($value);
        }

        // is_object()  https://www.php.net/manual/en/function.is-object.php
        // is_array()   https://www.php.net/manual/en/function.is-array.php

    }
}
