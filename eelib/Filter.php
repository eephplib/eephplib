<?php

# https://www.php.net/manual/en/book.filter.php
# https://www.php.net/manual/en/filter.filters.php
# https://www.php.net/manual/en/function.filter-var.php
# https://www.php.net/manual/en/filter.constants.php

namespace eelib
{
    use function \filter_var;

    class Filter
    {
        public const VALIDATE_EMAIL = \FILTER_VALIDATE_EMAIL; // Validating email addresses
        public const VALIDATE_IP    = \FILTER_VALIDATE_IP; // Validating IP addresses
        public const VALIDATE_INT   = \FILTER_VALIDATE_INT; // Validating integer value from string

        /**
         * @see https://www.w3schools.com/php/filter_validate_email.asp
         *
         * @param   string  $email
         * @param   int     $options
         *
         * @return  mixed
         */
        final public static function validateEmail(string $email, int $options = 0)
        {
            return filter_var($email, self::VALIDATE_EMAIL, $options);
        }

        /**
         *  Validating IP address value from string
         *
         * @param   string  $ip_address
         * @param   int     $options
         *
         * @return  mixed
         */
        final public static function validateIP(string $ip_address, int $options = 0)
        {
            return filter_var($ip_address, self::VALIDATE_IP, $options);
        }

        /**
         * Validating integer value
         *
         * @see https://www.w3schools.com/php/filter_validate_int.asp
         * @see https://www.php.net/manual/en/filter.filters.validate.php
         * #see https://www.tutorialspoint.com/filter-validate-int-constant-in-php
         * @see https://www.plus2net.com/php_tutorial/filter_validate_int.php
         *
         * @param   string|int|float    $integer
         * @param   int                 $options
         *
         * @return  mixed
         */
        final public static function validateInteger(string|int|float $integer, int $options = 0)
        {
            return filter_var($integer, self::VALIDATE_INT, $options);
        }
    }
}
