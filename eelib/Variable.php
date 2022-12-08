<?php


namespace eelib
{
    use function \empty;

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
         *                          Otherwise returns false.
         */
        public static function isEmpty($var) : bool
        {
            return empty($var);
        }
    }
}
