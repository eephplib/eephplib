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
        // Case: a plain, sequentially-keyed list — the canonical "happy path"
        // where first() should simply return the element at index 0.
        // Arrange
        $list = [[10], [20], [30]];
        // Act
        $result = ArrayList::first($list);
        // Assert
        $this->assertSame([10], $result);
    }

    public function testFirstReturnsEmptyArrayWhenEmpty(): void
    {
        // Case: empty input exercises the `?? []` fallback branch, the only
        // path where there is no element to return.
        // Arrange
        $list = [];
        // Act
        $result = ArrayList::first($list);
        // Assert
        $this->assertSame([], $result);
    }

    public function testFirstReturnsFirstArrayValueIgnoringKeys(): void
    {
        // Case: associative keys confirm first() relies on positional order
        // (via array_values) rather than the smallest/first key literal.
        // Arrange
        $list = ['x' => [1, 2], 'y' => [3, 4]];
        // Act
        $result = ArrayList::first($list);
        // Assert
        $this->assertSame([1, 2], $result);
    }

    public function testLastReturnsLastElement(): void
    {
        // Case: mirror of testFirstReturnsFirstElement for the tail element,
        // verifying the array_slice(-1) happy path.
        // Arrange
        $list = [[10], [20], [30]];
        // Act
        $result = ArrayList::last($list);
        // Assert
        $this->assertSame([30], $result);
    }

    public function testLastReturnsEmptyArrayWhenEmpty(): void
    {
        // Case: empty input exercises last()'s `?? []` fallback branch.
        // Arrange
        $list = [];
        // Act
        $result = ArrayList::last($list);
        // Assert
        $this->assertSame([], $result);
    }

    public function testFirstKeyReturnsNullWhenEmpty(): void
    {
        // Case: empty array is the one input firstKey() can return for without
        // hitting its `: ?array` return-type bug (a non-empty array returns a
        // scalar key and would TypeError), so we pin the safe NULL branch.
        // Arrange
        $list = [];
        // Act
        $result = ArrayList::firstKey($list);
        // Assert
        $this->assertNull($result);
    }

    public function testLastKeyReturnsLastKey(): void
    {
        // Case: associative array proves lastKey() returns the trailing *key*
        // (not value) and preserves its string type.
        // Arrange
        $list = ['x' => 1, 'y' => 2];
        // Act
        $result = ArrayList::lastKey($list);
        // Assert
        $this->assertSame('y', $result);
    }

    public function testLastKeyNumericArray(): void
    {
        // Case: sequential array checks the integer-key path, complementing the
        // string-key case above.
        // Arrange
        $list = ['a', 'b', 'c'];
        // Act
        $result = ArrayList::lastKey($list);
        // Assert
        $this->assertSame(2, $result);
    }

    public function testDifferentValues(): void
    {
        // Case: single comparison array — the basic array_diff contract,
        // asserting original keys are preserved (index 1 => 'b').
        // Arrange
        $base   = ['a', 'b', 'c'];
        $remove = ['a', 'c'];
        // Act
        $result = ArrayList::differentValues($base, $remove);
        // Assert
        $this->assertSame([1 => 'b'], $result);
    }

    public function testDifferentValuesWithMultipleArrays(): void
    {
        // Case: multiple variadic arrays verify the `...$arrays` spread that a
        // prior bugfix (#2) introduced, so all comparison sets are applied.
        // Arrange
        $base = ['a', 'b', 'c'];
        // Act
        $result = ArrayList::differentValues($base, ['a'], ['b']);
        // Assert
        $this->assertSame([2 => 'c'], $result);
    }

    public function testSameValues(): void
    {
        // Case: single comparison array — basic array_intersect contract with
        // original keys preserved (0 => 'a', 2 => 'c').
        // Arrange
        $base = ['a', 'b', 'c'];
        // Act
        $result = ArrayList::sameValues($base, ['a', 'c']);
        // Assert
        $this->assertSame([0 => 'a', 2 => 'c'], $result);
    }

    public function testSameValuesWithMultipleArrays(): void
    {
        // Case: multiple variadic arrays confirm intersection is applied across
        // every argument, so only the value common to all three survives.
        // Arrange
        $base = ['a', 'b'];
        // Act
        $result = ArrayList::sameValues($base, ['a', 'b'], ['a']);
        // Assert
        $this->assertSame(['a'], $result);
    }

    public function testFindValueReturnsKey(): void
    {
        // Case: value present — findValue should return its integer key.
        // Arrange
        $haystack = ['a', 'b', 'c'];
        // Act
        $result = ArrayList::findValue('b', $haystack);
        // Assert
        $this->assertSame(1, $result);
    }

    public function testFindValueReturnsFalseWhenMissing(): void
    {
        // Case: value absent — exercises the "not found" branch returning false.
        // Arrange
        $haystack = ['a', 'b'];
        // Act
        $result = ArrayList::findValue('z', $haystack);
        // Assert
        $this->assertFalse($result);
    }

    public function testFindValueStrictType(): void
    {
        // Case: string '1' vs int 1 isolates the $strict flag — loose matching
        // would find '1', strict matching must not, but must still find int 1.
        // Arrange
        $haystack = [1, 2, 3];
        // Act
        $looseMissWithStrict = ArrayList::findValue('1', $haystack, true);
        $strictHit           = ArrayList::findValue(1, $haystack, true);
        // Assert
        $this->assertFalse($looseMissWithStrict);
        $this->assertSame(0, $strictHit);
    }

    public function testReindexValues(): void
    {
        // Case: associative input verifies string keys are dropped and values
        // are re-indexed numerically from 0.
        // Arrange
        $list = ['x' => 'a', 'y' => 'b'];
        // Act
        $result = ArrayList::reindexValues($list);
        // Assert
        $this->assertSame(['a', 'b'], $result);
    }

    public function testPushAppendsValues(): void
    {
        // Case: multiple variadic values verify func_get_args()/array_merge
        // appends every extra argument (not just the second) to the base array.
        // Arrange
        $base = [1, 2];
        // Act
        $result = ArrayList::push($base, 3, 4);
        // Assert
        $this->assertSame([1, 2, 3, 4], $result);
    }

    public function testPushSingleValue(): void
    {
        // Case: single appended value — the minimal push contract.
        // Arrange
        $base = ['a'];
        // Act
        $result = ArrayList::push($base, 'b');
        // Assert
        $this->assertSame(['a', 'b'], $result);
    }

    public function testPushAssociativeMergesAssociativeArray(): void
    {
        // Case: empty target + one associative array isolates the is_array()
        // branch; the count return reflects how many key/value pairs were added.
        // (An empty target avoids the quirk where a pre-filled target re-counts
        // its own keys, since func_get_args() includes the by-ref first arg.)
        // Arrange
        $target = [];
        // Act
        $count = ArrayList::pushAssociative($target, ['a' => 10, 'b' => 20]);
        // Assert
        $this->assertSame(2, $count);
        $this->assertSame(['a' => 10, 'b' => 20], $target);
    }

    public function testPushAssociativeAddsScalarKeyWithEmptyValue(): void
    {
        // Case: a scalar argument exercises the non-array branch, which uses the
        // scalar as a key with an empty-string value and does not increment the
        // returned count.
        // Arrange
        $target = [];
        // Act
        $count = ArrayList::pushAssociative($target, 'key');
        // Assert
        $this->assertSame(0, $count);
        $this->assertSame(['key' => ''], $target);
    }
}
