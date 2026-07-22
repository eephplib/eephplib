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
        // Case: an already-unsorted list is the core scenario — proves values
        // come back in ascending order rather than input order.
        // Arrange
        $input = [5, 10, 8];
        // Act
        $result = ArraySort::ascending_sort($input);
        // Assert
        $this->assertSame([5, 8, 10], $result);
    }

    public function testAscendingSortReindexesKeys(): void
    {
        // Case: gapped custom keys confirm sort() discards keys and re-indexes
        // from 0 (a documented side effect worth pinning).
        // Arrange
        $input = [2 => 3, 5 => 1, 9 => 2];
        // Act
        $result = ArraySort::ascending_sort($input);
        // Assert
        $this->assertSame([1, 2, 3], $result);
    }

    public function testAscendingSortEmptyArray(): void
    {
        // Case: empty input is the boundary condition — sorting nothing must
        // safely yield an empty array.
        // Arrange
        $input = [];
        // Act
        $result = ArraySort::ascending_sort($input);
        // Assert
        $this->assertSame([], $result);
    }

    public function testAscendingSortWithStringFlag(): void
    {
        // Case: numeric strings + SORT_STRING flag prove the $flags parameter is
        // forwarded — string comparison orders '10' before '2', unlike numeric.
        // Arrange
        $input = ['10', '2', '1'];
        // Act
        $result = ArraySort::ascending_sort($input, ArraySort::STRING);
        // Assert
        $this->assertSame(['1', '10', '2'], $result);
    }

    public function testAscendingSortFromKeySortsByKey(): void
    {
        // Case: shuffled keys verify ksort orders by key while keeping each
        // key bound to its own value.
        // Arrange
        $input = ['c' => 3, 'a' => 1, 'b' => 2];
        // Act
        $result = ArraySort::ascending_sort_from_key($input);
        // Assert
        $this->assertSame(['a' => 1, 'b' => 2, 'c' => 3], $result);
    }

    public function testAscendingSortFromKeyPreservesValues(): void
    {
        // Case: distinct value strings make it obvious that key-sorting does NOT
        // reorder or re-index values (contrast with ascending_sort above).
        // Arrange
        $input = [3 => 'three', 1 => 'one', 2 => 'two'];
        // Act
        $result = ArraySort::ascending_sort_from_key($input);
        // Assert
        $this->assertSame([1 => 'one', 2 => 'two', 3 => 'three'], $result);
    }
}
