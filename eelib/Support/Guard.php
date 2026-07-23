<?php

declare(strict_types=1);

namespace eelib\Support
{
    use Exception;

    /**
     * Class Guard
     *
     * Shared guard-clause helpers for the "return a value or throw" idioms
     * that were previously duplicated inline across the library
     * (e.g. Superglobal, FileSystem, Extended\FileSystem).
     *
     * @package eelib\Support
     */
    final class Guard
    {
        /**
         * Returns $array[$key] when it is set, otherwise throws.
         *
         * Centralises the "$_SERVER['KEY'] ?? throw" idiom with a consistent
         * "{array_name}['{key}'] does not exist" message.
         *
         * @param   array<array-key, mixed> $array
         * @param   string|int              $key
         * @param   string                  $array_name Display name, e.g. "$_SERVER".
         *
         * @return  mixed   The value stored at $key.
         *
         * @throws  Exception   When $key is not set in $array.
         */
        public static function arrayKey(array $array, string|int $key, string $array_name): mixed
        {
            return $array[$key] ?? throw new Exception("{$array_name}['{$key}'] does not exist");
        }

        /**
         * Returns $value when it is truthy, otherwise throws.
         *
         * Centralises the "$value ?: throw" idiom used to guard native
         * functions (e.g. getcwd(), realpath()) that signal failure with false.
         *
         * @param   mixed   $value
         * @param   string  $message
         *
         * @return  mixed   The original truthy $value.
         *
         * @throws  Exception   When $value is falsy.
         */
        public static function truthy(mixed $value, string $message): mixed
        {
            return $value ?: throw new Exception($message);
        }
    }
}
