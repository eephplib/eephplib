<?php

declare(strict_types=1);

namespace eelib\Tests;

use eelib\Filter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Filter::class)]
final class FilterTest extends TestCase
{
    public function testValidateEmailAcceptsValid(): void
    {
        // Case: a well-formed address is the positive path — filter_var echoes
        // the input back unchanged on success.
        // Arrange
        $email = 'user@example.com';
        // Act
        $result = Filter::validateEmail($email);
        // Assert
        $this->assertSame('user@example.com', $result);
    }

    public function testValidateEmailRejectsInvalid(): void
    {
        // Case: a string with no '@' domain is the negative path returning false.
        // Arrange
        $email = 'not-an-email';
        // Act
        $result = Filter::validateEmail($email);
        // Assert
        $this->assertFalse($result);
    }

    public function testValidateIpAcceptsValid(): void
    {
        // Case: a valid IPv4 address is the positive path.
        // Arrange
        $ip = '192.168.0.1';
        // Act
        $result = Filter::validateIP($ip);
        // Assert
        $this->assertSame('192.168.0.1', $result);
    }

    public function testValidateIpRejectsInvalid(): void
    {
        // Case: octets > 255 are syntactically IP-shaped but invalid, exercising
        // the rejection path.
        // Arrange
        $ip = '999.999.999.999';
        // Act
        $result = Filter::validateIP($ip);
        // Assert
        $this->assertFalse($result);
    }

    public function testValidateIntegerAcceptsInt(): void
    {
        // Case: a numeric string is coerced to a real int on success (note the
        // int return, not the string input).
        // Arrange
        $value = '123';
        // Act
        $result = Filter::validateInteger($value);
        // Assert
        $this->assertSame(123, $result);
    }

    public function testValidateIntegerAcceptsZero(): void
    {
        // Case: 0 is the classic gotcha — it is a valid integer and must NOT be
        // confused with filter_var's false failure sentinel.
        // Arrange
        $value = 0;
        // Act
        $result = Filter::validateInteger($value);
        // Assert
        $this->assertSame(0, $result);
    }

    public function testValidateIntegerRejectsNonInteger(): void
    {
        // Case: a decimal string is not an integer, exercising the rejection.
        // Arrange
        $value = '12.5';
        // Act
        $result = Filter::validateInteger($value);
        // Assert
        $this->assertFalse($result);
    }
}
