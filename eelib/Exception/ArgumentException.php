<?php

namespace eelib\Exception;

use InvalidArgumentException;

class ArgumentException extends InvalidArgumentException {

    public static function ThrowIfNullOrEmpty($string, $string1): void
    {
        throw new ArgumentException('ArgumentException');
    }

    public static function ThrowIfNullOrWhiteSpace($string, $string1): void
    {
        throw new ArgumentException('ThrowIfNullOrWhiteSpace');
    }
}
