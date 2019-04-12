<?php


namespace SymonWhite\PhpUnitTraits\Test;

use ReflectionException;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use SymonWhite\PhpUnitTraits\ConstructorTrait;

/**
 * @class ConstructorTraitTest
 *
 * @coversDefaultClass \SymonWhite\PhpUnitTraits\ConstructorTrait
 */
class ConstructorTraitTest extends TestCase
{
    /**
     * @covers ::doConstructorTest
     *
     * @throws ReflectionException
     */
    public function testDoConstructorTest()
    {
        $class = $this->createMock(\stdClass::class);
        $propertyName = 'name';
        $propertyValue = 'value';

        $instance = $this->getMockForTrait(ConstructorTrait::class);

        $instance->expects($this->once())
            ->method('getPropertyValue')
            ->with($class, $propertyName)
            ->willReturn($propertyValue);

        $instance->expects($this->once())
            ->method('assertEquals')
            ->with($propertyValue, $propertyValue);

        $this->assertEquals(
            $instance,
            $this->executeMethod($instance, 'doConstructorTest', $class, [$propertyName => $propertyValue])
        );
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
     * @return mixed
     *
     * @throws ReflectionException
     */
    protected function executeMethod($class, $name, ...$params)
    {
        return $this->getMethod($class, $name)->invoke($class, ...$params);
    }
}
