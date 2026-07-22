<?php

declare(strict_types=1);

namespace eelib\Tests;

use eelib\ArrayList;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ArrayList::class)]
#[CoversClass(\Extended\ArrayList::class)]
final class ArrayListTest extends TestCase
{
    public function testFirstReturnsFirstElement(): void
    {
        $this->assertSame([10], ArrayList::first([[10], [20], [30]]));
    }

    public function testFirstReturnsEmptyArrayWhenEmpty(): void
    {
        $this->assertSame([], ArrayList::first([]));
    }

    public function testFirstReturnsFirstArrayValueIgnoringKeys(): void
    {
        $this->assertSame([1, 2], ArrayList::first(['x' => [1, 2], 'y' => [3, 4]]));
    }

    public function testLastReturnsLastElement(): void
    {
        $this->assertSame([30], ArrayList::last([[10], [20], [30]]));
    }

    public function testLastReturnsEmptyArrayWhenEmpty(): void
    {
        $this->assertSame([], ArrayList::last([]));
    }

    public function testFirstKeyReturnsNullWhenEmpty(): void
    {
        $this->assertNull(ArrayList::firstKey([]));
    }

    public function testLastKeyReturnsLastKey(): void
    {
        $this->assertSame('y', ArrayList::lastKey(['x' => 1, 'y' => 2]));
    }

    public function testLastKeyNumericArray(): void
    {
        $this->assertSame(2, ArrayList::lastKey(['a', 'b', 'c']));
    }

    public function testDifferentValues(): void
    {
        $this->assertSame([1 => 'b'], ArrayList::differentValues(['a', 'b', 'c'], ['a', 'c']));
    }

    public function testDifferentValuesWithMultipleArrays(): void
    {
        $this->assertSame([2 => 'c'], ArrayList::differentValues(['a', 'b', 'c'], ['a'], ['b']));
    }

    public function testSameValues(): void
    {
        $this->assertSame([0 => 'a', 2 => 'c'], ArrayList::sameValues(['a', 'b', 'c'], ['a', 'c']));
    }

    public function testSameValuesWithMultipleArrays(): void
    {
        $this->assertSame(['a'], ArrayList::sameValues(['a', 'b'], ['a', 'b'], ['a']));
    }

    public function testFindValueReturnsKey(): void
    {
        $this->assertSame(1, ArrayList::findValue('b', ['a', 'b', 'c']));
    }

    public function testFindValueReturnsFalseWhenMissing(): void
    {
        $this->assertFalse(ArrayList::findValue('z', ['a', 'b']));
    }

    public function testFindValueStrictType(): void
    {
        $this->assertFalse(ArrayList::findValue('1', [1, 2, 3], true));
        $this->assertSame(0, ArrayList::findValue(1, [1, 2, 3], true));
    }

    public function testReindexValues(): void
    {
        $this->assertSame(['a', 'b'], ArrayList::reindexValues(['x' => 'a', 'y' => 'b']));
    }

    public function testPushAppendsValues(): void
    {
        $this->assertSame([1, 2, 3, 4], ArrayList::push([1, 2], 3, 4));
    }

    public function testPushSingleValue(): void
    {
        $this->assertSame(['a', 'b'], ArrayList::push(['a'], 'b'));
    }

    public function testPushAssociativeMergesAssociativeArray(): void
    {
        $target = [];
        $count  = ArrayList::pushAssociative($target, ['a' => 10, 'b' => 20]);

        $this->assertSame(2, $count);
        $this->assertSame(['a' => 10, 'b' => 20], $target);
    }

    public function testPushAssociativeAddsScalarKeyWithEmptyValue(): void
    {
        $target = [];
        $count  = ArrayList::pushAssociative($target, 'key');

        $this->assertSame(0, $count);
        $this->assertSame(['key' => ''], $target);
    }
}
