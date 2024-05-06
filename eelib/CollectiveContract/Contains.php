<?php namespace eelib\CollectiveContract;

/**
 * Used specifically for string data types:
 * Validates if a string contains the defined string value
 */
interface Contains
{
    public static function contains(string $value): bool;
}
