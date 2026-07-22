<?php

declare(strict_types=1);

namespace eelib\Tests;

use eelib\Exception\ArgumentException;
use eelib\Exception\ArgumentOutOfRangeException;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ArgumentException::class)]
#[CoversClass(ArgumentOutOfRangeException::class)]
final class ExceptionTest extends TestCase
{
    public function testArgumentExceptionIsInvalidArgumentException(): void
    {
        $this->assertInstanceOf(InvalidArgumentException::class, new ArgumentException());
    }

    public function testThrowIfNullOrEmptyThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ArgumentException');
        ArgumentException::ThrowIfNullOrEmpty('', '');
    }

    public function testThrowIfNullOrWhiteSpaceThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfNullOrWhiteSpace');
        ArgumentException::ThrowIfNullOrWhiteSpace('', '');
    }

    public function testArgumentOutOfRangeExceptionIsInvalidArgumentException(): void
    {
        $this->assertInstanceOf(InvalidArgumentException::class, new ArgumentOutOfRangeException());
    }

    public function testThrowIfZeroThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfZero');
        ArgumentOutOfRangeException::ThrowIfZero(0);
    }

    public function testThrowIfNegativeThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfNegative');
        ArgumentOutOfRangeException::ThrowIfNegative(-1);
    }

    public function testThrowIfNegativeOrZeroThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfNegativeOrZero');
        ArgumentOutOfRangeException::ThrowIfNegativeOrZero(0);
    }

    public function testThrowIfLessThanOrEqualThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfLessThanOrEqual');
        ArgumentOutOfRangeException::ThrowIfLessThanOrEqual(1, 2);
    }

    public function testThrowIfLessThanThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfLessThan');
        ArgumentOutOfRangeException::ThrowIfLessThan(1, 2);
    }

    public function testThrowIfGreaterThanThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfGreaterThan');
        ArgumentOutOfRangeException::ThrowIfGreaterThan(3, 2);
    }

    public function testThrowIfGreaterThanOrEqualThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfGreaterThanOrEqual');
        ArgumentOutOfRangeException::ThrowIfGreaterThanOrEqual(3, 2);
    }

    public function testThrowIfEqualThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfEqual');
        ArgumentOutOfRangeException::ThrowIfEqual(2);
    }

    public function testThrowIfNotEqualThrows(): void
    {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfNotEqual');
        ArgumentOutOfRangeException::ThrowIfNotEqual(1, 2);
    }
}
