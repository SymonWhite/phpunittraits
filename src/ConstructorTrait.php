<?php

namespace SymonWhite\PhpUnitTraits;

use ReflectionException;

/**
 * @class ConstructorTrait
 */
trait ConstructorTrait
{
    /**
     * @param object $class
     * @param array  $propertyValuesByName
     *
     * @return $this
     *
     * @throws ReflectionException
     */
    protected function doConstructorTest($class, array $propertyValuesByName): self
    {
        foreach ($propertyValuesByName as $name => $value) {
            $this->assertEquals($value, $this->getPropertyValue($class, $name));
        }

        return $this;
    }

    /**
     * @param object $class
     * @param string $name
     *
     * @return mixed|object|string|int|float|null
     *
     * @throws ReflectionException
     */
    abstract protected function getPropertyValue($class, $name);

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
    abstract public function assertEquals(
        $expected,
        $actual,
        $message = '',
        $delta = 0.0,
        $maxDepth = 10,
        $canonicalize = false,
        $ignoreCase = false
    );
}
