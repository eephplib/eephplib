<?php

namespace eelib\Exception;

use InvalidArgumentException;

class ArgumentOutOfRangeException extends InvalidArgumentException
{
    public static function ThrowIfZero($string): void
    {
        throw new ArgumentException('ThrowIfZero');
    }

    public static function ThrowIfNegative($string): void
    {
        throw new ArgumentException('ThrowIfNegative');
    }

    public static function ThrowIfLessThanOrEqual($string, $value): void
    {
        throw new ArgumentException('ThrowIfLessThanOrEqual');
    }

    public static function ThrowIfLessThan($string, $value): void
    {
        throw new ArgumentException('ThrowIfLessThan');
    }

    public static function ThrowIfGreaterThan($string, $value): void
    {
        throw new ArgumentException('ThrowIfGreaterThan');
    }

    public static function ThrowIfGreaterThanOrEqual($string, $value): void
    {
        throw new ArgumentException('ThrowIfGreaterThanOrEqual');
    }

    /**
     * @see https://learn.microsoft.com/en-us/dotnet/api/system.argumentoutofrangeexception.throwifequal
     */
    public static function ThrowIfEqual($string): void
    {
        throw new ArgumentException('ThrowIfEqual');
    }

    public static function ThrowIfNotEqual($string, $value): void
    {
        throw new ArgumentException('ThrowIfNotEqual');
    }

    public static function ThrowIfNegativeOrZero($string): void
    {
        throw new ArgumentException('ThrowIfNegativeOrZero');
    }
}
