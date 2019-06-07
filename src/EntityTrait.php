<?php

namespace SymonWhite\PhpUnitTraits;

use ReflectionException;
use SymonWhite\PhpUnitTraits\Exception\MethodNotFoundException;

/**
 * Trait EntityTrait
 */
trait EntityTrait
{
    /**
     * @param object $class
     * @param array  $propertyValuesByName
     *
     * @return $this
     *
     * @throws ReflectionException
     * @throws MethodNotFoundException
     */
    protected function doSetterTest($class, array $propertyValuesByName): self
    {
        foreach ($propertyValuesByName as $name => $value) {
            $this->setterTest($class, $name, $value);
            $this->assertEquals($value, $this->getPropertyValue($class, $name));
        }

        return $this;
    }

    /**
     * @param object $class
     * @param array  $propertyValuesByName
     *
     * @return $this
     *
     * @throws ReflectionException
     * @throws MethodNotFoundException
     */
    protected function doGetterTest($class, array $propertyValuesByName): self
    {
        foreach ($propertyValuesByName as $name => $value) {
            $this->setPropertyValue($class, $name, $value);
            $this->getterTest($class, $name, $value);
        }

        return $this;
    }

    /**
     * @param object $class
     * @param array  $propertyValuesByName
     *
     * @return $this
     *
     * @throws MethodNotFoundException
     */
    protected function doGetterAndSetterTest($class, array $propertyValuesByName): self
    {
        foreach ($propertyValuesByName as $name => $value) {
            $this->setterTest($class, $name, $value);
            $this->getterTest($class, $name, $value);
        }

        return $this;
    }

    /**
     * @param object $class
     * @param string $name
     * @param mixed  $value
     *
     * @throws MethodNotFoundException
     */
    protected function setterTest($class, $name, $value): void
    {
        $ucfName = ucfirst($name);
        $methodNames = [
            'set' . $ucfName => $value,
            'add' . rtrim($ucfName, 's') => is_array($value) ? array_shift($value): $value
        ];

        foreach ($methodNames as $methodName => $methodValue) {
            if (method_exists($class, $methodName)) {
                $this->assertEquals($class, $class->{$methodName}($methodValue));
                return;
            }
        }

        throw new MethodNotFoundException(get_class($class), $name, true);
    }

    /**
     * @param object $class
     * @param string $name
     * @param mixed  $value
     *
     * @throws MethodNotFoundException
     */
    protected function getterTest($class, $name, $value): void
    {
        $ucfName = ucfirst($name);
        $methodNames = [
            'get' . $ucfName => is_array($value) && !empty($value) ? [array_shift($value)]: $value,
            'is' . $ucfName => $value
        ];

        foreach ($methodNames as $methodName => $methodValue) {
            if (method_exists($class, $methodName)) {
                $this->assertEquals($methodValue, $class->{$methodName}());
                return;
            }
        }

        throw new MethodNotFoundException(get_class($class), $name, false);
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
     * @param object $class
     * @param string $name
     * @param mixed|object|string|int|float $value
     *
     * @return $this
     *
     * @throws ReflectionException
     */
    abstract protected function setPropertyValue($class, $name, $value): self;

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
