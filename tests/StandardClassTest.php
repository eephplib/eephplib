<?php

declare(strict_types=1);

namespace eelib\Tests;

use eelib\StandardClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use RuntimeException;

trait StandardClassTestTrait
{
}

class StandardClassTestFixture
{
    use StandardClassTestTrait;

    public int $id = 1;
}

#[CoversClass(StandardClass::class)]
#[CoversClass(\Extended\StandardClass::class)]
final class StandardClassTest extends TestCase
{
    public function testHasPropertyTrue(): void
    {
        // Case: a class name string + an existing property is the positive path;
        // a local fixture gives us a stable, known property to assert on.
        // Arrange
        $class = StandardClassTestFixture::class;
        // Act
        $result = StandardClass::has_property($class, 'id');
        // Assert
        $this->assertTrue($result);
    }

    public function testHasPropertyFalse(): void
    {
        // Case: a property that doesn't exist exercises the negative branch.
        // Arrange
        $class = StandardClassTestFixture::class;
        // Act
        $result = StandardClass::has_property($class, 'missing');
        // Assert
        $this->assertFalse($result);
    }

    public function testHasPropertyOnInstance(): void
    {
        // Case: passing an *instance* (not a class-string) proves the
        // object|string union parameter works both ways.
        // Arrange
        $object = new StandardClassTestFixture();
        // Act
        $result = StandardClass::has_property($object, 'id');
        // Assert
        $this->assertTrue($result);
    }

    public function testUsedTraitsReturnsTraitNames(): void
    {
        // Case: a fixture that uses exactly one known trait lets us assert the
        // full class_uses map (name => name) deterministically.
        // Arrange
        $class = StandardClassTestFixture::class;
        // Act
        $result = StandardClass::usedTraits($class);
        // Assert
        $this->assertSame(
            [StandardClassTestTrait::class => StandardClassTestTrait::class],
            $result
        );
    }

    public function testUsedTraitsThrowsWhenNoTraits(): void
    {
        // Case: a plain stdClass uses no traits, driving the empty-result guard
        // that throws RuntimeException.
        // Arrange
        $this->expectException(RuntimeException::class);
        // Act
        StandardClass::usedTraits(new \stdClass());
        // Assert: exception expectation above
    }

    public function testCountCountsObjectProperties(): void
    {
        // Case: a stdClass with two dynamic properties verifies count() reports
        // the number of public members via ArrayIterator.
        // Arrange
        $object    = new \stdClass();
        $object->a = 1;
        $object->b = 2;
        // Act
        $result = \Extended\StandardClass::count($object);
        // Assert
        $this->assertSame(2, $result);
    }
}
