<?php

namespace SymonWhite\PhpUnitTraits;

use ReflectionMethod;
use ReflectionProperty;
use ReflectionException;

/**
 * @trait ReflectionTrait
 */
trait ReflectionTrait
{
    /**
     * @param object $class
     * @param string $name
     *
     * @return ReflectionProperty
     *
     * @throws ReflectionException
     */
    protected function getProperty($class, $name)
    {
        $property = new ReflectionProperty($class, $name);
        $property->setAccessible(true);

        return $property;
    }

    /**
     * @param object $class
     * @param string $name
     *
     * @return mixed|object|string|int|float|null
     *
     * @throws ReflectionException
     */
    protected function getPropertyValue($class, $name)
    {
        return $this->getProperty($class, $name)->getValue($class);
    }

    /**
     * @param object $class
     * @param string $name
     * @param mixed|object|string|int|float $value
     *
     * @return $this
     *
     * @throws ReflectionException
     */
    protected function setPropertyValue($class, $name, $value)
    {
        $this->getProperty($class, $name)->setValue($class, $value);

        return $this;
    }

    /**
     * @param object $class
     * @param string $name
     *
     * @return ReflectionMethod
     *
     * @throws ReflectionException
     */
    protected function getMethod($class, $name)
    {
        $method = new ReflectionMethod($class, $name);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * @param object $class
     * @param string $name
     * @param mixed|object|string|int|float|null ...$params
     *
     * @return mixed|object|string|int|float
     *
     * @throws ReflectionException
     */
    protected function executeMethod($class, $name, ...$params)
    {
        return $this->getMethod($class, $name)->invoke($class, ...$params);
    }
}
