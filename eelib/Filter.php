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
        const VALIDATE_EMAI = \FILTER_VALIDATE_EMAIL; // Validating email addresses
        const VALIDATE_IP   = \FILTER_VALIDATE_IP; // Validating IP addresses
        const VALIDATE_INT  = \FILTER_VALIDATE_INT; // Validating integer value from string

        /**
         * @see https://www.w3schools.com/php/filter_validate_email.asp
         *
         * @param   string  $email
         * @param int $options
         *
         * @return  mixed
         */
        public static function validateEmail(string $email, int $options = 0)
        {
            return filter_var($email, self::VALIDATE_EMAIL, $options);
        }
    }

}