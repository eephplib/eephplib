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
        // Validation filters: https://www.php.net/manual/en/filter.filters.validate.php
        public const VALIDATE_EMAIL          = \FILTER_VALIDATE_EMAIL; // Validating email addresses
        public const VALIDATE_IP             = \FILTER_VALIDATE_IP;   // Validating IP addresses
        public const VALIDATE_INT            = \FILTER_VALIDATE_INT;  // Validating integer value from string
        public const FILTER_VALIDATE_BOOLEAN = \FILTER_VALIDATE_BOOLEAN;
        public const FILTER_VALIDATE_DOMAIN  = \FILTER_VALIDATE_DOMAIN;
        public const FILTER_VALIDATE_FLOAT   = \FILTER_VALIDATE_FLOAT;
        public const FILTER_VALIDATE_MAC     = \FILTER_VALIDATE_MAC;
        public const FILTER_VALIDATE_URL     = \FILTER_VALIDATE_URL;

        // Sanitize filters: https://www.php.net/manual/en/filter.filters.sanitize.php
        public const FILTER_SANITIZE_EMAIL              = \FILTER_SANITIZE_EMAIL;
        public const FILTER_SANITIZE_ENCODED            = \FILTER_SANITIZE_ENCODED;
        public const FILTER_SANITIZE_ADD_SLASHES        = \FILTER_SANITIZE_ADD_SLASHES;
        public const FILTER_SANITIZE_NUMBER_FLOAT       = \FILTER_SANITIZE_NUMBER_FLOAT;
        public const FILTER_SANITIZE_NUMBER_INT         = \FILTER_SANITIZE_NUMBER_INT;
        public const FILTER_SANITIZE_SPECIAL_CHARS      = \FILTER_SANITIZE_SPECIAL_CHARS;
        public const FILTER_SANITIZE_FULL_SPECIAL_CHARS = \FILTER_SANITIZE_FULL_SPECIAL_CHARS;
        public const FILTER_SANITIZE_STRING             = \FILTER_SANITIZE_STRING;
        public const FILTER_SANITIZE_STRIPPED           = \FILTER_SANITIZE_STRIPPED;
        public const FILTER_SANITIZE_URL                = \FILTER_SANITIZE_URL;
        public const FILTER_UNSAFE_RAW                  = \FILTER_UNSAFE_RAW;

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
         * @see https://www.tutorialspoint.com/filter-validate-int-constant-in-php
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
