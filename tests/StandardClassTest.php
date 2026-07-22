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
        $this->assertTrue(StandardClass::has_property(StandardClassTestFixture::class, 'id'));
    }

    public function testHasPropertyFalse(): void
    {
        $this->assertFalse(StandardClass::has_property(StandardClassTestFixture::class, 'missing'));
    }

    public function testHasPropertyOnInstance(): void
    {
        $this->assertTrue(StandardClass::has_property(new StandardClassTestFixture(), 'id'));
    }

    public function testUsedTraitsReturnsTraitNames(): void
    {
        $this->assertSame(
            [StandardClassTestTrait::class => StandardClassTestTrait::class],
            StandardClass::usedTraits(StandardClassTestFixture::class)
        );
    }

    public function testUsedTraitsThrowsWhenNoTraits(): void
    {
        $this->expectException(RuntimeException::class);
        StandardClass::usedTraits(new \stdClass());
    }

    public function testCountCountsObjectProperties(): void
    {
        $object      = new \stdClass();
        $object->a   = 1;
        $object->b   = 2;

        $this->assertSame(2, \Extended\StandardClass::count($object));
    }
}
