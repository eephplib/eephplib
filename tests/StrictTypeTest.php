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
        // Case: cover the several PHP values considered "empty" ('', 0, [])
        // plus clear non-empty values, since empty() has many falsy inputs.
        // Arrange / Act / Assert
        $this->assertTrue(StrictType::isEmpty(''));
        $this->assertTrue(StrictType::isEmpty(0));
        $this->assertTrue(StrictType::isEmpty([]));
        $this->assertFalse(StrictType::isEmpty('x'));
        $this->assertFalse(StrictType::isEmpty([1]));
    }

    public function testIsString(): void
    {
        // Case: pair a string with a non-string (int) so both is_string
        // branches are exercised.
        // Arrange / Act / Assert
        $this->assertTrue(StrictType::isString('hello'));
        $this->assertFalse(StrictType::isString(42));
    }

    public function testIsFloat(): void
    {
        // Case: 1.5 vs 1 — an int must NOT be reported as float (distinct types
        // in strict checking).
        // Arrange / Act / Assert
        $this->assertTrue(StrictType::isFloat(1.5));
        $this->assertFalse(StrictType::isFloat(1));
    }

    public function testIsInteger(): void
    {
        // Case: int 7 vs numeric string '7' — the string must fail, proving no
        // type juggling occurs.
        // Arrange / Act / Assert
        $this->assertTrue(StrictType::isInteger(7));
        $this->assertFalse(StrictType::isInteger('7'));
    }

    public function testIsBoolean(): void
    {
        // Case: true vs 0 — a falsy int must not be treated as boolean.
        // Arrange / Act / Assert
        $this->assertTrue(StrictType::isBoolean(true));
        $this->assertFalse(StrictType::isBoolean(0));
    }

    public function testIsObject(): void
    {
        // Case: an object instance vs a scalar string covers both branches.
        // Arrange / Act / Assert
        $this->assertTrue(StrictType::isObject(new stdClass()));
        $this->assertFalse(StrictType::isObject('x'));
    }

    public function testIsArray(): void
    {
        // Case: an array vs a string covers both branches of is_array.
        // Arrange / Act / Assert
        $this->assertTrue(StrictType::isArray([1, 2]));
        $this->assertFalse(StrictType::isArray('x'));
    }

    public function testIsStdClass(): void
    {
        // Case: a real stdClass vs another object (ArrayObject) proves the check
        // is specific to stdClass, not "any object".
        // Arrange / Act / Assert
        $this->assertTrue(ExtendedStrictType::isStdClass(new stdClass()));
        $this->assertFalse(ExtendedStrictType::isStdClass(new \ArrayObject()));
    }

    public function testIsObjectOfClass(): void
    {
        // Case: matching vs non-matching class name exercises both instanceof
        // outcomes.
        // Arrange / Act / Assert
        $this->assertTrue(ExtendedStrictType::isObjectOfClass(new \ArrayObject(), \ArrayObject::class));
        $this->assertFalse(ExtendedStrictType::isObjectOfClass(new stdClass(), \ArrayObject::class));
    }

    public function testIsObjectOfClassListMatches(): void
    {
        // Case: target class appears later in the list — proves the loop keeps
        // scanning and returns true on any match.
        // Arrange
        $object    = new stdClass();
        $classList = [\ArrayObject::class, stdClass::class];
        // Act
        $result = ExtendedStrictType::isObjectOfClassList($object, $classList);
        // Assert
        $this->assertTrue($result);
    }

    public function testIsObjectOfClassListNoMatch(): void
    {
        // Case: no class in the list matches — the loop must fall through to
        // the final `return false`.
        // Arrange
        $object    = new stdClass();
        $classList = [\ArrayObject::class];
        // Act
        $result = ExtendedStrictType::isObjectOfClassList($object, $classList);
        // Assert
        $this->assertFalse($result);
    }

    public function testValidateNotStringThrowsForString(): void
    {
        // Case: a string input is (counter-intuitively named but) the throwing
        // path of validateNotString.
        // Arrange
        $this->expectException(\Exception::class);
        // Act
        ExtendedStrictType::validateNotString('a string');
        // Assert: exception expectation above
    }

    public function testValidateNotStringPassesForNonString(): void
    {
        // Case: a non-string (int) must pass silently; expectNotToPerform
        // assertions documents that "no exception" is the success signal.
        // Arrange / Act
        ExtendedStrictType::validateNotString(42);
        // Assert
        $this->expectNotToPerformAssertions();
    }

    public function testValidateNotNullThrowsForNull(): void
    {
        // Case: null is the throwing path of validateNotNull.
        // Arrange
        $this->expectException(\Exception::class);
        // Act
        ExtendedStrictType::validateNotNull(null);
        // Assert: exception expectation above
    }

    public function testValidateNotNullPassesForNonNull(): void
    {
        // Case: a non-null value must pass without throwing.
        // Arrange / Act
        ExtendedStrictType::validateNotNull('x');
        // Assert
        $this->expectNotToPerformAssertions();
    }
}
