<?php

namespace SymonWhite\PhpUnitTraits\Test\Exception;

use PHPUnit\Framework\TestCase;
use SymonWhite\PhpUnitTraits\Exception\MethodNotFoundException;

/**
 * @class MethodNotFoundExceptionTest
 *
 * @coversDefaultClass \SymonWhite\PhpUnitTraits\Exception\MethodNotFoundException
 */
class MethodNotFoundExceptionTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $instance = new MethodNotFoundException('className', 'propertyName', true);
        $this->assertEquals(
            'Setter-Method not found for property "propertyName" in class "className"',
            $instance->getMessage()
        );

        $instance = new MethodNotFoundException('className', 'propertyName', false);
        $this->assertEquals(
            'Getter-Method not found for property "propertyName" in class "className"',
            $instance->getMessage()
        );
    }
}
