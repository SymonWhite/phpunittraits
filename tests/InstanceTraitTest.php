<?php

namespace SymonWhite\PhpUnitTraits\Test;

use PHPUnit_Framework_MockObject_MockObject as MockObject;
use PHPUnit\Framework\TestCase;
use SymonWhite\PhpUnitTraits\InstanceTrait;
use SymonWhite\PhpUnitTraits\ReflectionTrait;

/**
 * Class InstanceTraitTest
 */
class InstanceTraitTest extends TestCase
{
    use ReflectionTrait;

    /**
     * @throws \ReflectionException
     */
    public function testGetInstanceMock()
    {
        $testCase = $this->createMock(TestCase::class);
        $className = TestEntity::class;

        $instance = $this->getMockForTrait(InstanceTrait::class);

        $actual = $this->executeMethod($instance, 'getInstance', $testCase, $className, ['id', [1]], ['getId']);

        $this->assertInstanceOf($className, $actual);
        $this->assertInstanceOf(MockObject::class, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetInstance()
    {
        $testCase = $this->createMock(TestCase::class);
        $className = TestEntity::class;

        $instance = $this->getMockForTrait(InstanceTrait::class);

        $this->assertInstanceOf(
            $className,
            $this->executeMethod($instance, 'getInstance', $testCase, $className, ['id', [1]], [])
        );
    }
}
