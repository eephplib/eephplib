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
        // Case: needle present in the middle — default mode returns the needle
        // and everything after it.
        // Arrange
        $haystack = 'hello world';
        // Act
        $result = BinaryString::find_first_occurrence($haystack, 'wor');
        // Assert
        $this->assertSame('world', $result);
    }

    public function testFindFirstOccurrenceBeforeNeedle(): void
    {
        // Case: same input with $before_needle=true isolates that flag — it
        // must return the portion preceding the needle instead.
        // Arrange
        $haystack = 'hello world';
        // Act
        $result = BinaryString::find_first_occurrence($haystack, 'wor', true);
        // Assert
        $this->assertSame('hello ', $result);
    }

    public function testFindFirstOccurrenceThrowsWhenMissing(): void
    {
        // Case: absent needle drives the strstr()===false branch, which the
        // method converts into a RuntimeException (its documented contract).
        // Arrange
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('needle is not found');
        // Act
        BinaryString::find_first_occurrence('hello', 'z');
        // Assert: exception expectation above
    }

    public function testReplaceSubstrings(): void
    {
        // Case: two-char from/to maps verify strtr does per-character
        // translation (e->i, o->e), not whole-substring replacement.
        // Arrange
        $string = 'hello';
        // Act
        $result = BinaryString::replace_substrings($string, 'eo', 'ie');
        // Assert
        $this->assertSame('hille', $result);
    }

    public function testFindInitMaskLength(): void
    {
        // Case: string starting with digits then a space — strspn counts the
        // leading run ('42' => 2) before the first non-mask char.
        // Arrange
        $subject = '42 is the answer';
        // Act
        $result = BinaryString::FindInitMaskLength($subject, '1234567890');
        // Assert
        $this->assertSame(2, $result);
    }

    public function testFindInitNotMaskLength(): void
    {
        // Case: complement of the above — counts leading chars NOT in the mask.
        // 'he' precede the first 'l'/'o' from the mask 'ol', giving 2.
        // Arrange
        $subject = 'hello world';
        // Act
        $result = BinaryString::FindInitNotMaskLength($subject, 'ol');
        // Assert
        $this->assertSame(2, $result);
    }

    public function testCompareEqual(): void
    {
        // Case: identical strings must produce strcmp's 0 (the equality signal).
        // Arrange
        $a = 'abc';
        $b = 'abc';
        // Act
        $result = BinaryString::Compare($a, $b);
        // Assert
        $this->assertSame(0, $result);
    }

    public function testCompareLessThan(): void
    {
        // Case: 'abc' < 'abd' verifies ordering sign; we assert < 0 rather than
        // a magic number since strcmp's magnitude is platform-defined.
        // Arrange
        $a = 'abc';
        $b = 'abd';
        // Act
        $result = BinaryString::Compare($a, $b);
        // Assert
        $this->assertLessThan(0, $result);
    }

    public function testCompareCaseInsensitive(): void
    {
        // Case: strings differing only by case must be "equal" (0) — this is the
        // whole point of the case-insensitive variant.
        // Arrange
        $a = 'Hello';
        $b = 'hello';
        // Act
        $result = BinaryString::CompareCaseInsensitive($a, $b);
        // Assert
        $this->assertSame(0, $result);
    }

    public function testCompareFirstCharacters(): void
    {
        // Case: two strings sharing a 3-char prefix but differing at char 6
        // prove the $len bound — equal within 3, unequal within 6.
        // Arrange
        $a = 'foobar';
        $b = 'foobaz';
        // Act
        $equalPrefix   = BinaryString::CompareFirstCharacters($a, $b, 3);
        $fullComparison = BinaryString::CompareFirstCharacters($a, $b, 6);
        // Assert
        $this->assertSame(0, $equalPrefix);
        $this->assertNotSame(0, $fullComparison);
    }

    public function testUpperCaseWords(): void
    {
        // Case: an explicit single-space delimiter isolates the intended
        // behaviour (title-casing each word) without the surprising default
        // delimiter set that also treats letters like 'r'/'t' as separators.
        // Arrange
        $string = 'hello world';
        // Act
        $result = BinaryString::UpperCaseWords($string, ' ');
        // Assert
        $this->assertSame('Hello World', $result);
    }

    public function testSubstringExtract(): void
    {
        // Case: a space token verifies strtok returns only the first token up
        // to the delimiter.
        // Arrange
        $string = 'Hello world';
        // Act
        $result = BinaryString::SubstringExtract($string, ' ');
        // Assert
        $this->assertSame('Hello', $result);
    }

    public function testIsHexadecimalDigitTrue(): void
    {
        // Case: a mixed-case valid hex string is the positive path for
        // ctype_xdigit.
        // Arrange
        $text = '1aF9';
        // Act
        $result = BinaryString::isHexadecimalDigit($text);
        // Assert
        $this->assertTrue($result);
    }

    public function testIsHexadecimalDigitFalse(): void
    {
        // Case: letters beyond a-f ('xyz') are the negative path.
        // Arrange
        $text = 'xyz';
        // Act
        $result = BinaryString::isHexadecimalDigit($text);
        // Assert
        $this->assertFalse($result);
    }

    public function testIsColorHexSixDigit(): void
    {
        // Case: a leading '#' plus 6 hex digits is the most common CSS colour —
        // also proves the '#' is stripped before validation.
        // Arrange
        $color = '#ffcc00';
        // Act
        $result = BinaryString::isColorHex($color);
        // Assert
        $this->assertTrue($result);
    }

    public function testIsColorHexThreeDigit(): void
    {
        // Case: 3-digit shorthand (no '#') is the second accepted length branch.
        // Arrange
        $color = 'fc0';
        // Act
        $result = BinaryString::isColorHex($color);
        // Assert
        $this->assertTrue($result);
    }

    public function testIsColorHexRejectsInvalidLength(): void
    {
        // Case: 4 hex digits are valid hex but an invalid colour length,
        // isolating the length check from the hex check.
        // Arrange
        $color = '#ffcc';
        // Act
        $result = BinaryString::isColorHex($color);
        // Assert
        $this->assertFalse($result);
    }

    public function testIsColorHexRejectsNonHex(): void
    {
        // Case: correct length (6) but non-hex chars isolates the hex check
        // from the length check.
        // Arrange
        $color = '#gggggg';
        // Act
        $result = BinaryString::isColorHex($color);
        // Assert
        $this->assertFalse($result);
    }

    public function testIsEqualIgnoresCase(): void
    {
        // Case: same letters differing by case — the method upper-cases both
        // sides, so this must be equal.
        // Arrange
        $a = 'Hello';
        $b = 'HELLO';
        // Act
        $result = BinaryString::isEqual($a, $b);
        // Assert
        $this->assertTrue($result);
    }

    public function testIsEqualDifferent(): void
    {
        // Case: genuinely different words are the negative path.
        // Arrange
        $a = 'foo';
        $b = 'bar';
        // Act
        $result = BinaryString::isEqual($a, $b);
        // Assert
        $this->assertFalse($result);
    }

    public function testSplitSingleCharacters(): void
    {
        // Case: default split_length=1 is the simplest chunking behaviour.
        // Arrange
        $string = 'abc';
        // Act
        $result = BinaryString::split($string);
        // Assert
        $this->assertSame(['a', 'b', 'c'], $result);
    }

    public function testSplitMultibyteChunks(): void
    {
        // Case: a Cyrillic string with split_length=2 proves multibyte safety —
        // it must split by characters, not raw bytes (this is the class's raison
        // d'être over str_split).
        // Arrange
        $string = 'победа';
        // Act
        $result = BinaryString::split($string, 2, 'UTF-8');
        // Assert
        $this->assertSame(['по', 'бе', 'да'], $result);
    }

    public function testSplitReturnsFalseForInvalidLength(): void
    {
        // Case: split_length < 1 drives the guard branch returning FALSE.
        // Arrange
        $string = 'abc';
        // Act
        $result = BinaryString::split($string, 0);
        // Assert
        $this->assertFalse($result);
    }

    public function testSearchStringAllocatorFiltersShortKeywords(): void
    {
        // Case: a messy query with punctuation and short words exercises the
        // full pipeline — lowercasing, punctuation stripping, and dropping
        // tokens shorter than the default safe length (e.g. 'is', 'my').
        // Arrange
        $query = 'this is my name.is cool - name-caller';
        // Act
        $result = BinaryString::searchStringAllocator($query);
        // Assert
        $this->assertSame(['this', 'name', 'cool', 'name', 'caller'], $result);
    }

    public function testSearchStringAllocatorReturnsEmptyWhenBelowSafeLength(): void
    {
        // Case: input shorter than the safe length skips the whole processing
        // block, returning an empty array (the early-out branch).
        // Arrange
        $query = 'ab';
        // Act
        $result = BinaryString::searchStringAllocator($query);
        // Assert
        $this->assertSame([], $result);
    }
}
