<?php

declare(strict_types=1);

namespace eelib\Tests;

use eelib\ArraySort;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ArraySort::class)]
final class ArraySortTest extends TestCase
{
    public function testAscendingSortReordersValues(): void
    {
        $this->assertSame([5, 8, 10], ArraySort::ascending_sort([5, 10, 8]));
    }

    public function testAscendingSortReindexesKeys(): void
    {
        $this->assertSame([1, 2, 3], ArraySort::ascending_sort([2 => 3, 5 => 1, 9 => 2]));
    }

    public function testAscendingSortEmptyArray(): void
    {
        $this->assertSame([], ArraySort::ascending_sort([]));
    }

    public function testAscendingSortWithStringFlag(): void
    {
        $this->assertSame(['1', '10', '2'], ArraySort::ascending_sort(['10', '2', '1'], ArraySort::STRING));
    }

    public function testAscendingSortFromKeySortsByKey(): void
    {
        $this->assertSame(
            ['a' => 1, 'b' => 2, 'c' => 3],
            ArraySort::ascending_sort_from_key(['c' => 3, 'a' => 1, 'b' => 2])
        );
    }

    public function testAscendingSortFromKeyPreservesValues(): void
    {
        $this->assertSame(
            [1 => 'one', 2 => 'two', 3 => 'three'],
            ArraySort::ascending_sort_from_key([3 => 'three', 1 => 'one', 2 => 'two'])
        );
    }
}
