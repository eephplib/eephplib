<?php

namespace eelib
{

    use eelib\Exception\ArgumentException;
    use eelib\Exception\ArgumentOutOfRangeException;

    /**
     * https://www.linkedin.com/posts/nikola-kne%C5%BEevi%C4%87_%3F-%3F%3F-%3F%3F%3F-%3F%3F%3F%3F%3F-%3F%3F%3F%3F%3F-activity-7199303871381278720-G6lL/
     */
    class GuardClauses
    {
        public ArgumentException           $ArgumentException;
        public ArgumentOutOfRangeException $ArgumentOutOfRangeException;

        public function __construct()
        {
            $this->ArgumentException           = new ArgumentException;
            $this->ArgumentOutOfRangeException = new ArgumentOutOfRangeException;
        }
    }

    //$GuardClauses = new GuardClauses;
    //$GuardClauses->ArgumentException::ThrowIfNullOrEmpty($string, $string1);

    ArgumentException::ThrowIfNullOrEmpty($string, $string1);
    ArgumentException::ThrowIfNullOrWhiteSpace($string, $string1);

    ArgumentOutOfRangeException::ThrowIfZero($string);
    ArgumentOutOfRangeException::ThrowIfNegative($string);
    ArgumentOutOfRangeException::ThrowIfNegativeOrZero($string);
    ArgumentOutOfRangeException::ThrowIfLessThanOrEqual($string, $value);
    ArgumentOutOfRangeException::ThrowIfLessThan($string, $value);
    ArgumentOutOfRangeException::ThrowIfGreaterThan($string, $value);
    ArgumentOutOfRangeException::ThrowIfGreaterThanOrEqual($string, $value);
    ArgumentOutOfRangeException::ThrowIfEqual($string, $value);
    ArgumentOutOfRangeException::ThrowIfNotEqual($string, $value);
}

