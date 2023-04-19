<?php

declare(strict_types=1);

namespace eelib;

use Serializable;

class ArrayCollection implements Serializable
{

    public function __construct()
    {
    }

    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize(string $data)
    {
        // TODO: Implement unserialize() method.
    }

    public static function toLowercase(array $array): array
    {
        return array_map('strtolower', $array);
    }

    public static function toUppercase(array $array): array
    {
        return array_map('strtoupper', $array);
    }
}

// To Review and discuss:
// https://dev.to/fahrenholz/collection-objects-in-php-1cbk
// self::offsetSet() = $value can be assigned on the constructor as second parameter (optional) for strict data types