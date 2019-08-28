<?php


namespace SymonWhite\PhpUnitTraits\Test;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;
use SymonWhite\PhpUnitTraits\ReflectionTrait;

/**
 * @class ReflectionTraitTest
 *
 * @coversDefaultClass \SymonWhite\PhpUnitTraits\ReflectionTrait
 */
class ReflectionTraitTest extends TestCase
{
    /**
     * @covers ::getProperty
     *
     * @throws ReflectionException
     */
    public function testGetProperty()
    {
        $class = new TestEntity();
        $name = 'id';
        $instance = $this->getMockForTrait(ReflectionTrait::class);

        $property = new ReflectionProperty($class, $name);
        $property->setAccessible(true);
        $this->assertEquals(
            $property,
            $this->executeMethod($instance, 'getProperty', $class, $name)
        );
    }

    /**
     * @covers ::getPropertyValue
     *
     * @throws ReflectionException
     */
    public function testGetPropertyValue()
    {
        $class = new TestEntity();
        $name = 'id';
        $instance = $this->getMockForTrait(ReflectionTrait::class, [], '', true, true, true, ['getProperty']);

        $property = $this->createMock(ReflectionProperty::class);
        $instance->expects($this->once())
            ->method('getProperty')
            ->with($class, $name)
            ->willReturn($property);

        $value = 'value';
        $property->expects($this->once())
            ->method('getValue')
            ->with($class)
            ->willReturn($value);

        $this->assertEquals($value, $this->executeMethod($instance, 'getPropertyValue', $class, $name));
    }

    /**
     * @covers ::setPropertyValue
     *
     * @throws ReflectionException
     */
    public function testSetPropertyValue()
    {
        $class = new TestEntity();
        $name = 'id';
        $value = 'value';
        $instance = $this->getMockForTrait(ReflectionTrait::class, [], '', true, true, true, ['getProperty']);

        $property = $this->createMock(ReflectionProperty::class);
        $instance->expects($this->once())
            ->method('getProperty')
            ->with($class, $name)
            ->willReturn($property);

        $property->expects($this->once())
            ->method('setValue')
            ->with($class, $value);

        $this->assertEquals($instance, $this->executeMethod($instance, 'setPropertyValue', $class, $name, $value));
    }

    /**
     * @covers ::getMethod
     *
     * @throws ReflectionException
     */
    public function testGetMethod()
    {
        $class = new TestEntity();
        $name = 'getId';
        $instance = $this->getMockForTrait(ReflectionTrait::class);

        $method = new ReflectionMethod($class, $name);
        $method->setAccessible(true);
        $this->assertEquals(
            $method,
            $this->executeMethod($instance, 'getMethod', $class, $name)
        );
    }

    /**
     * @covers ::executeMethod
     *
     * @throws ReflectionException
     */
    public function testExecuteMethod()
    {
        $class = new TestEntity();
        $name = 'getId';
        $params = ['test'];
        $instance = $this->getMockForTrait(ReflectionTrait::class, [], '', true, true, true, ['getMethod']);

        $method = $this->createMock(ReflectionMethod::class);
        $instance->expects($this->once())
            ->method('getMethod')
            ->with($class, $name)
            ->willReturn($method);

        $result = 'result';
        $method->expects($this->once())
            ->method('invoke')
            ->with($class, ...$params)
            ->willReturn($result);

        $this->assertEquals($result, $this->executeMethod($instance, 'executeMethod', $class, $name, ...$params));
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
