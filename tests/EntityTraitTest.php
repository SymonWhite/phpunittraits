<?php

namespace SymonWhite\PhpUnitTraits\Test;

use ReflectionException;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use SymonWhite\PhpUnitTraits\EntityTrait;
use SymonWhite\PhpUnitTraits\Exception\MethodNotFoundException;
use SymonWhite\PhpUnitTraits\ReflectionTrait;

/**
 * @class EntityTraitTest
 *
 * @coversDefaultClass \SymonWhite\PhpUnitTraits\EntityTrait
 */
class EntityTraitTest extends TestCase
{
    use ReflectionTrait;

    /**
     * @covers ::doSetterTest
     *
     * @throws ReflectionException
     */
    public function testDoSetterTest(): void
    {
        $class = $this->createMock(\stdClass::class);
        $propertyName = 'name';
        $propertyValue = 'value';
        $instance = $this->getMockForTrait(
            EntityTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['setterTest', 'getPropertyValue', 'assertEquals']
        );

        $instance->expects($this->once())
            ->method('setterTest')
            ->with($class, $propertyName, $propertyValue);

        $instance->expects($this->once())
            ->method('getPropertyValue')
            ->with($class, $propertyName)
            ->willReturn($propertyValue);

        $instance->expects($this->once())
            ->method('assertEquals')
            ->with($propertyValue, $propertyValue);

        $this->assertEquals(
            $instance,
            $this->executeMethod($instance, 'doSetterTest', $class, [$propertyName => $propertyValue])
        );
    }

    /**
     * @covers ::doGetterTest
     *
     * @throws ReflectionException
     */
    public function testDoGetterTest(): void
    {
        $class = $this->createMock(\stdClass::class);
        $propertyName = 'name';
        $propertyValue = 'value';
        $instance = $this->getMockForTrait(
            EntityTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['setPropertyValue', 'getterTest']
        );

        $instance->expects($this->once())
            ->method('setPropertyValue')
            ->with($class, $propertyName, $propertyValue)
            ->willReturnSelf();

        $instance->expects($this->once())
            ->method('getterTest')
            ->with($class, $propertyName, $propertyValue);

        $this->assertEquals(
            $instance,
            $this->executeMethod($instance, 'doGetterTest', $class, [$propertyName => $propertyValue])
        );
    }

    /**
     * @covers ::doGetterAndSetterTest
     *
     * @throws ReflectionException
     */
    public function testDoGetterAndSetterTest(): void
    {
        $class = $this->createMock(\stdClass::class);
        $propertyName = 'name';
        $propertyValue = 'value';
        $instance = $this->getMockForTrait(
            EntityTrait::class,
            [],
            '',
            true,
            true,
            true,
            ['setterTest', 'getterTest']
        );

        $instance->expects($this->once())
            ->method('setterTest')
            ->with($class, $propertyName, $propertyValue);

        $instance->expects($this->once())
            ->method('getterTest')
            ->with($class, $propertyName, $propertyValue);

        $this->assertEquals(
            $instance,
            $this->executeMethod($instance, 'doGetterAndSetterTest', $class, [$propertyName => $propertyValue])
        );
    }

    /**
     * @covers ::setterTest
     *
     * @throws ReflectionException
     */
    public function testTestSetter(): void
    {
        $class = $this->createMock(TestEntity::class);
        $propertyName = 'id';
        $propertyValue = 'value';
        $instance = $this->getMockForTrait(EntityTrait::class, [], '', true, true, true, ['assertEquals']);

        $class->expects($this->once())
            ->method('setId')
            ->with($propertyValue)
            ->willReturnSelf();

        $instance->expects($this->once())
            ->method('assertEquals')
            ->with($class, $class);

        $this->executeMethod($instance, 'setterTest', $class, $propertyName, $propertyValue);

        $this->expectException(MethodNotFoundException::class);
        $this->executeMethod($instance, 'setterTest', $class, 'name', $propertyValue);
    }

    /**
     * @covers ::setterTest
     *
     * @throws ReflectionException
     */
    public function testSetterTestArray(): void
    {
        $class = $this->createMock(TestEntity::class);
        $propertyName = 'tests';
        $propertyValue = [1];
        $instance = $this->getMockForTrait(EntityTrait::class, [], '', true, true, true, ['assertEquals']);

        $class->expects($this->once())
            ->method('addTest')
            ->with(1)
            ->willReturnSelf();

        $instance->expects($this->once())
            ->method('assertEquals')
            ->with($class, $class);

        $this->executeMethod($instance, 'setterTest', $class, $propertyName, $propertyValue);
    }

    /**
     * @covers ::getterTest
     *
     * @throws ReflectionException
     */
    public function testTestGetter(): void
    {
        $class = $this->createMock(TestEntity::class);
        $propertyName = 'id';
        $propertyValue = 'value';
        $instance = $this->getMockForTrait(EntityTrait::class, [], '', true, true, true, ['assertEquals']);


        $class->expects($this->once())
            ->method('getId')
            ->willReturn($propertyValue);

        $instance->expects($this->once())
            ->method('assertEquals')
            ->with($propertyValue, $propertyValue);

        $this->executeMethod($instance, 'getterTest', $class, $propertyName, $propertyValue);

        $this->expectException(MethodNotFoundException::class);
        $this->executeMethod($instance, 'getterTest', $class, 'name', $propertyValue);
    }

    /**
     * @covers ::getterTest
     *
     * @throws ReflectionException
     */
    public function testGetterTestArray(): void
    {
        $class = $this->createMock(TestEntity::class);
        $propertyName = 'tests';
        $propertyValue = [1];
        $instance = $this->getMockForTrait(EntityTrait::class, [], '', true, true, true, ['assertEquals']);


        $class->expects($this->once())
            ->method('getTests')
            ->willReturn($propertyValue);

        $instance->expects($this->once())
            ->method('assertEquals')
            ->with($propertyValue, $propertyValue);

        $this->executeMethod($instance, 'getterTest', $class, $propertyName, $propertyValue);
    }

    /**
     * @covers ::getterTest
     *
     * @throws ReflectionException
     */
    public function testGetterTestEmptyArray(): void
    {
        $class = $this->createMock(TestEntity::class);
        $propertyName = 'tests';
        $propertyValue = [];
        $instance = $this->getMockForTrait(EntityTrait::class, [], '', true, true, true, ['assertEquals']);


        $class->expects($this->once())
            ->method('getTests')
            ->willReturn($propertyValue);

        $instance->expects($this->once())
            ->method('assertEquals')
            ->with($propertyValue, $propertyValue);

        $this->executeMethod($instance, 'getterTest', $class, $propertyName, $propertyValue);
    }

    /**
     * @param object $class
     * @param string $name
     *
     * @return ReflectionMethod
     *
     * @throws ReflectionException
     */
    protected function getMethod($class, $name): ReflectionMethod
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
