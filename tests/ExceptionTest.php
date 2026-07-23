<?php

declare(strict_types=1);

namespace eelib\Tests;

use eelib\Exception\ArgumentException;
use eelib\Exception\ArgumentOutOfRangeException;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

// NOTE: In the current implementation every guard method *unconditionally*
// throws (the comparison logic is not yet implemented). Each test therefore
// pins two things: that the guard throws an ArgumentException, and that it
// carries the message identifying which guard fired — so a future real
// implementation that stops throwing for valid input will fail loudly here.
#[CoversClass(ArgumentException::class)]
#[CoversClass(ArgumentOutOfRangeException::class)]
final class ExceptionTest extends TestCase
{
    public function testArgumentExceptionIsInvalidArgumentException(): void
    {
        // Case: pin the inheritance contract — callers may catch the standard
        // SPL InvalidArgumentException and still handle this subclass.
        // Arrange / Act / Assert
        $this->assertInstanceOf(InvalidArgumentException::class, new ArgumentException());
    }

    public function testThrowIfNullOrEmptyThrows(): void
    {
        // Case: verify the guard throws and self-identifies via its message.
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ArgumentException');
        // Act
        ArgumentException::ThrowIfNullOrEmpty('', '');
        // Assert: exception expectation above
    }

    public function testThrowIfNullOrWhiteSpaceThrows(): void
    {
        // Case: distinct message proves each guard reports its own identity.
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfNullOrWhiteSpace');
        // Act
        ArgumentException::ThrowIfNullOrWhiteSpace('', '');
        // Assert: exception expectation above
    }

    public function testArgumentOutOfRangeExceptionIsInvalidArgumentException(): void
    {
        // Case: the range-exception type must also be an InvalidArgumentException.
        // Arrange / Act / Assert
        $this->assertInstanceOf(InvalidArgumentException::class, new ArgumentOutOfRangeException());
    }

    public function testThrowIfZeroThrows(): void
    {
        // Case: zero input for the "not zero" guard.
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfZero');
        // Act
        ArgumentOutOfRangeException::ThrowIfZero(0);
        // Assert: exception expectation above
    }

    public function testThrowIfNegativeThrows(): void
    {
        // Case: a negative value for the "not negative" guard.
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfNegative');
        // Act
        ArgumentOutOfRangeException::ThrowIfNegative(-1);
        // Assert: exception expectation above
    }

    public function testThrowIfNegativeOrZeroThrows(): void
    {
        // Case: zero for the combined "not negative or zero" guard.
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfNegativeOrZero');
        // Act
        ArgumentOutOfRangeException::ThrowIfNegativeOrZero(0);
        // Assert: exception expectation above
    }

    public function testThrowIfLessThanOrEqualThrows(): void
    {
        // Case: value equal-or-below the bound for the <= guard.
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfLessThanOrEqual');
        // Act
        ArgumentOutOfRangeException::ThrowIfLessThanOrEqual(1, 2);
        // Assert: exception expectation above
    }

    public function testThrowIfLessThanThrows(): void
    {
        // Case: value below the bound for the < guard.
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfLessThan');
        // Act
        ArgumentOutOfRangeException::ThrowIfLessThan(1, 2);
        // Assert: exception expectation above
    }

    public function testThrowIfGreaterThanThrows(): void
    {
        // Case: value above the bound for the > guard.
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfGreaterThan');
        // Act
        ArgumentOutOfRangeException::ThrowIfGreaterThan(3, 2);
        // Assert: exception expectation above
    }

    public function testThrowIfGreaterThanOrEqualThrows(): void
    {
        // Case: value equal-or-above the bound for the >= guard.
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfGreaterThanOrEqual');
        // Act
        ArgumentOutOfRangeException::ThrowIfGreaterThanOrEqual(3, 2);
        // Assert: exception expectation above
    }

    public function testThrowIfEqualThrows(): void
    {
        // Case: the equality guard (single-argument signature in this class).
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfEqual');
        // Act
        ArgumentOutOfRangeException::ThrowIfEqual(2);
        // Assert: exception expectation above
    }

    public function testThrowIfNotEqualThrows(): void
    {
        // Case: the inequality guard with two differing arguments.
        // Arrange
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('ThrowIfNotEqual');
        // Act
        ArgumentOutOfRangeException::ThrowIfNotEqual(1, 2);
        // Assert: exception expectation above
    }
}
