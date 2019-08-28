<?php


namespace SymonWhite\PhpUnitTraits;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Trait InstanceTrait
 */
trait InstanceTrait
{
    /**
     * @param TestCase $testCase
     * @param string $className
     * @param array $constructArgs
     * @param array $methods
     *
     * @return MockObject|$className
     */
    protected function getInstance(
        TestCase $testCase,
        string $className,
        array $constructArgs,
        array $methods = []
    ) {
        if (!empty($methods)) {
            return (new MockBuilder($testCase, $className))
                ->setConstructorArgs($constructArgs)
                ->setMethods($methods)
                ->getMock();
        }

        return new $className(...$constructArgs);
    }
}