<?php

namespace SymonWhite\PhpUnitTraits;

use ReflectionException;

/**
 * @class ConstructorTrait
 */
trait ConstructorTrait
{
    use ReflectionTrait, TestCaseBridgeTrait;

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
            $this->thisAssertEquals($value, $this->getPropertyValue($class, $name));
        }

        return $this;
    }
}
