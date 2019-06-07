<?php

namespace SymonWhite\PhpUnitTraits;

/**
 * @class TestCaseBridgeTrait
 */
trait TestCaseBridgeTrait
{
    /**
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     */
    protected function thisAssertEquals(
        $expected,
        $actual,
        string $message = ''
    ): void {
        self::assertEquals($expected, $actual, $message);
    }

    /**
     * Asserts that two variables are equal.
     *
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     * @param float  $delta
     * @param int    $maxDepth
     * @param bool   $canonicalize
     * @param bool   $ignoreCase
     */
    abstract public static function assertEquals(
        $expected,
        $actual,
        string $message = '',
        float $delta = 0.0,
        int $maxDepth = 10,
        bool $canonicalize = false,
        bool $ignoreCase = false
    ): void;
}
