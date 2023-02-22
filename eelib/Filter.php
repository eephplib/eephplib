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
        /**
         * @see https://www.w3schools.com/php/filter_validate_email.asp
         *
         * @param   string  $email
         * @param           $options
         *
         * @return  mixed
         */
        public static function validateEmail(string $email, $options = 0)
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL, $options);
        }
    }

}