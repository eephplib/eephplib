<?php

namespace eelib\Functions\BinaryString\Extended
{
    use function \strtoupper;

    trait IsEqual
    {
        final public static function isEqual(
            string $firstString,
            string $secondString
        ) : bool
        {
            return (strtoupper($firstString) === strtoupper($secondString));
        }

    }
}
