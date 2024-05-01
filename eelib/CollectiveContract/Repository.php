<?php namespace eelib\CollectiveContract;

/**
 * Master Interface Repository
 * @link https://twitter.com/garyclarketech/status/1782365985095471384
 * @link https://twitter.com/Dave_DotNet/status/1782433303108235768
 */
interface Repository
{
    public static function list(): array;
    public static function get(string $id): mixed;
    public static function has(string $id): bool;
    public static function delete(string $id): void; // remove
    public static function insert(array|object $entities): void; // add / append
    public static function update(array|object $entities): void;
    public static function upsert(array|object $entities): void;
    public static function save(): void;
}
