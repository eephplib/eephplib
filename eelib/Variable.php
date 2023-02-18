<?php


namespace eelib
{
    use function \empty;
    use function \is_string;
    use function \is_float;
    use function \is_int;
    use function \is_bool;
    use function \is_object;
    use function \is_array;

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
         * Finds whether the type of the given variable is string.
         *
         * https://www.php.net/manual/en/function.is-string.php
         *
         * @param mixed $value  The variable being evaluated.
         *
         * @return bool         Returns true if value is of type string, false otherwise.

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

        /**
         * https://www.php.net/manual/en/function.is-object.php
         *
         * @param $value
         *
         * @return bool
         */
        public static function isObject($value) : bool
        {
            return is_object($value);
        }

        /**
         * https://www.php.net/manual/en/function.is-array.php

         *
         * @param $value
         *
         * @return bool
         */
        public static function isArray($value) : bool
        {
            return is_array($value);
        }
    }
}
