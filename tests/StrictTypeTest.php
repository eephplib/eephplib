<?php

declare(strict_types=1);

namespace eelib\Tests;

use eelib\ExtendedStrictType;
use eelib\StrictType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(StrictType::class)]
#[CoversClass(ExtendedStrictType::class)]
final class StrictTypeTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $this->assertTrue(StrictType::isEmpty(''));
        $this->assertTrue(StrictType::isEmpty(0));
        $this->assertTrue(StrictType::isEmpty([]));
        $this->assertFalse(StrictType::isEmpty('x'));
        $this->assertFalse(StrictType::isEmpty([1]));
    }

    public function testIsString(): void
    {
        $this->assertTrue(StrictType::isString('hello'));
        $this->assertFalse(StrictType::isString(42));
    }

    public function testIsFloat(): void
    {
        $this->assertTrue(StrictType::isFloat(1.5));
        $this->assertFalse(StrictType::isFloat(1));
    }

    public function testIsInteger(): void
    {
        $this->assertTrue(StrictType::isInteger(7));
        $this->assertFalse(StrictType::isInteger('7'));
    }

    public function testIsBoolean(): void
    {
        $this->assertTrue(StrictType::isBoolean(true));
        $this->assertFalse(StrictType::isBoolean(0));
    }

    public function testIsObject(): void
    {
        $this->assertTrue(StrictType::isObject(new stdClass()));
        $this->assertFalse(StrictType::isObject('x'));
    }

    public function testIsArray(): void
    {
        $this->assertTrue(StrictType::isArray([1, 2]));
        $this->assertFalse(StrictType::isArray('x'));
    }

    public function testIsStdClass(): void
    {
        $this->assertTrue(ExtendedStrictType::isStdClass(new stdClass()));
        $this->assertFalse(ExtendedStrictType::isStdClass(new \ArrayObject()));
    }

    public function testIsObjectOfClass(): void
    {
        $this->assertTrue(ExtendedStrictType::isObjectOfClass(new \ArrayObject(), \ArrayObject::class));
        $this->assertFalse(ExtendedStrictType::isObjectOfClass(new stdClass(), \ArrayObject::class));
    }

    public function testIsObjectOfClassListMatches(): void
    {
        $this->assertTrue(
            ExtendedStrictType::isObjectOfClassList(new stdClass(), [\ArrayObject::class, stdClass::class])
        );
    }

    public function testIsObjectOfClassListNoMatch(): void
    {
        $this->assertFalse(
            ExtendedStrictType::isObjectOfClassList(new stdClass(), [\ArrayObject::class])
        );
    }

    public function testValidateNotStringThrowsForString(): void
    {
        $this->expectException(\Exception::class);
        ExtendedStrictType::validateNotString('a string');
    }

    public function testValidateNotStringPassesForNonString(): void
    {
        ExtendedStrictType::validateNotString(42);
        $this->expectNotToPerformAssertions();
    }

    public function testValidateNotNullThrowsForNull(): void
    {
        $this->expectException(\Exception::class);
        ExtendedStrictType::validateNotNull(null);
    }

    public function testValidateNotNullPassesForNonNull(): void
    {
        ExtendedStrictType::validateNotNull('x');
        $this->expectNotToPerformAssertions();
    }
}
