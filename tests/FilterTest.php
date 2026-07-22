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
        $this->assertSame('user@example.com', Filter::validateEmail('user@example.com'));
    }

    public function testValidateEmailRejectsInvalid(): void
    {
        $this->assertFalse(Filter::validateEmail('not-an-email'));
    }

    public function testValidateIpAcceptsValid(): void
    {
        $this->assertSame('192.168.0.1', Filter::validateIP('192.168.0.1'));
    }

    public function testValidateIpRejectsInvalid(): void
    {
        $this->assertFalse(Filter::validateIP('999.999.999.999'));
    }

    public function testValidateIntegerAcceptsInt(): void
    {
        $this->assertSame(123, Filter::validateInteger('123'));
    }

    public function testValidateIntegerAcceptsZero(): void
    {
        $this->assertSame(0, Filter::validateInteger(0));
    }

    public function testValidateIntegerRejectsNonInteger(): void
    {
        $this->assertFalse(Filter::validateInteger('12.5'));
    }
}
