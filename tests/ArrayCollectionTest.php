<?php

declare(strict_types=1);

namespace eelib\Tests;

use eelib\ArrayCollection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ArrayCollection::class)]
final class ArrayCollectionTest extends TestCase
{
    public function testToLowercase(): void
    {
        // Case: mixed-case values are the core scenario — proves every element
        // is lowercased via the array_map('strtolower') mapping.
        // Arrange
        $input = ['ABC', 'DeF'];
        // Act
        $result = ArrayCollection::toLowercase($input);
        // Assert
        $this->assertSame(['abc', 'def'], $result);
    }

    public function testToLowercaseEmptyArray(): void
    {
        // Case: empty input is the boundary — mapping over nothing returns [].
        // Arrange
        $input = [];
        // Act
        $result = ArrayCollection::toLowercase($input);
        // Assert
        $this->assertSame([], $result);
    }

    public function testToLowercasePreservesKeys(): void
    {
        // Case: an associative key checks that array_map keeps keys intact and
        // only the value is transformed.
        // Arrange
        $input = ['x' => 'HELLO'];
        // Act
        $result = ArrayCollection::toLowercase($input);
        // Assert
        $this->assertSame(['x' => 'hello'], $result);
    }

    public function testToUppercase(): void
    {
        // Case: mixed-case values are the core scenario for the strtoupper map.
        // Arrange
        $input = ['abc', 'DeF'];
        // Act
        $result = ArrayCollection::toUppercase($input);
        // Assert
        $this->assertSame(['ABC', 'DEF'], $result);
    }

    public function testToUppercaseEmptyArray(): void
    {
        // Case: empty input boundary for the uppercase mapping.
        // Arrange
        $input = [];
        // Act
        $result = ArrayCollection::toUppercase($input);
        // Assert
        $this->assertSame([], $result);
    }

    public function testToUppercasePreservesKeys(): void
    {
        // Case: associative key confirms keys survive the uppercase mapping.
        // Arrange
        $input = ['x' => 'hello'];
        // Act
        $result = ArrayCollection::toUppercase($input);
        // Assert
        $this->assertSame(['x' => 'HELLO'], $result);
    }
}
