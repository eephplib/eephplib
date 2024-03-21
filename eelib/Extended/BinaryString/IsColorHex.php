<?php

namespace eelib\Functions\BinaryString\Extended
{
    use function \ctype_xdigit;
    use function \ltrim;
    use function \strlen;

    trait IsColorHex
    {
        /**
         * Checks if enter string is a hexadecimal color code by W3C standard.
         */
        final public static function isColorHex(string $colorCode): bool
        {
            $colorCode          = ltrim($colorCode, '#');
            $isHexadecimalDigit = ctype_xdigit($colorCode);
            $isThreeDigitHex    = (strlen($colorCode) === 3);
            $isSixDigitHex      = (strlen($colorCode) === 6);

            return (
                $isHexadecimalDigit && ($isSixDigitHex || $isThreeDigitHex)
            );
        }
    }
}
