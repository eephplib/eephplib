<?php

declare(strict_types=1);

namespace eelib\Tests;

use eelib\BinaryString;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[CoversClass(BinaryString::class)]
#[CoversClass(\Extended\BinaryString::class)]
final class BinaryStringTest extends TestCase
{
    public function testFindFirstOccurrence(): void
    {
        $this->assertSame('world', BinaryString::find_first_occurrence('hello world', 'wor'));
    }

    public function testFindFirstOccurrenceBeforeNeedle(): void
    {
        $this->assertSame('hello ', BinaryString::find_first_occurrence('hello world', 'wor', true));
    }

    public function testFindFirstOccurrenceThrowsWhenMissing(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('needle is not found');

        BinaryString::find_first_occurrence('hello', 'z');
    }

    public function testReplaceSubstrings(): void
    {
        $this->assertSame('hille', BinaryString::replace_substrings('hello', 'eo', 'ie'));
    }

    public function testFindInitMaskLength(): void
    {
        $this->assertSame(2, BinaryString::FindInitMaskLength('42 is the answer', '1234567890'));
    }

    public function testFindInitNotMaskLength(): void
    {
        $this->assertSame(2, BinaryString::FindInitNotMaskLength('hello world', 'ol'));
    }

    public function testCompareEqual(): void
    {
        $this->assertSame(0, BinaryString::Compare('abc', 'abc'));
    }

    public function testCompareLessThan(): void
    {
        $this->assertLessThan(0, BinaryString::Compare('abc', 'abd'));
    }

    public function testCompareCaseInsensitive(): void
    {
        $this->assertSame(0, BinaryString::CompareCaseInsensitive('Hello', 'hello'));
    }

    public function testCompareFirstCharacters(): void
    {
        $this->assertSame(0, BinaryString::CompareFirstCharacters('foobar', 'foobaz', 3));
        $this->assertNotSame(0, BinaryString::CompareFirstCharacters('foobar', 'foobaz', 6));
    }

    public function testUpperCaseWords(): void
    {
        $this->assertSame('Hello World', BinaryString::UpperCaseWords('hello world', ' '));
    }

    public function testSubstringExtract(): void
    {
        $this->assertSame('Hello', BinaryString::SubstringExtract('Hello world', ' '));
    }

    public function testIsHexadecimalDigitTrue(): void
    {
        $this->assertTrue(BinaryString::isHexadecimalDigit('1aF9'));
    }

    public function testIsHexadecimalDigitFalse(): void
    {
        $this->assertFalse(BinaryString::isHexadecimalDigit('xyz'));
    }

    public function testIsColorHexSixDigit(): void
    {
        $this->assertTrue(BinaryString::isColorHex('#ffcc00'));
    }

    public function testIsColorHexThreeDigit(): void
    {
        $this->assertTrue(BinaryString::isColorHex('fc0'));
    }

    public function testIsColorHexRejectsInvalidLength(): void
    {
        $this->assertFalse(BinaryString::isColorHex('#ffcc'));
    }

    public function testIsColorHexRejectsNonHex(): void
    {
        $this->assertFalse(BinaryString::isColorHex('#gggggg'));
    }

    public function testIsEqualIgnoresCase(): void
    {
        $this->assertTrue(BinaryString::isEqual('Hello', 'HELLO'));
    }

    public function testIsEqualDifferent(): void
    {
        $this->assertFalse(BinaryString::isEqual('foo', 'bar'));
    }

    public function testSplitSingleCharacters(): void
    {
        $this->assertSame(['a', 'b', 'c'], BinaryString::split('abc'));
    }

    public function testSplitMultibyteChunks(): void
    {
        $this->assertSame(['по', 'бе', 'да'], BinaryString::split('победа', 2, 'UTF-8'));
    }

    public function testSplitReturnsFalseForInvalidLength(): void
    {
        $this->assertFalse(BinaryString::split('abc', 0));
    }

    public function testSearchStringAllocatorFiltersShortKeywords(): void
    {
        $this->assertSame(
            ['this', 'name', 'cool', 'name', 'caller'],
            BinaryString::searchStringAllocator('this is my name.is cool - name-caller')
        );
    }

    public function testSearchStringAllocatorReturnsEmptyWhenBelowSafeLength(): void
    {
        $this->assertSame([], BinaryString::searchStringAllocator('ab'));
    }
}
