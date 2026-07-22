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
        $this->assertSame(['abc', 'def'], ArrayCollection::toLowercase(['ABC', 'DeF']));
    }

    public function testToLowercaseEmptyArray(): void
    {
        $this->assertSame([], ArrayCollection::toLowercase([]));
    }

    public function testToLowercasePreservesKeys(): void
    {
        $this->assertSame(['x' => 'hello'], ArrayCollection::toLowercase(['x' => 'HELLO']));
    }

    public function testToUppercase(): void
    {
        $this->assertSame(['ABC', 'DEF'], ArrayCollection::toUppercase(['abc', 'DeF']));
    }

    public function testToUppercaseEmptyArray(): void
    {
        $this->assertSame([], ArrayCollection::toUppercase([]));
    }

    public function testToUppercasePreservesKeys(): void
    {
        $this->assertSame(['x' => 'HELLO'], ArrayCollection::toUppercase(['x' => 'hello']));
    }
}
