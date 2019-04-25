<?php

namespace SymonWhite\PhpUnitTraits;

use PHPUnit_Framework_MockObject_MockObject as MockObject;
use PHPUnit_Framework_MockObject_Matcher_InvokedCount as InvokedCount;

/**
 * Trait MockTrait
 */
trait MockTrait
{
    /**
     * @param MockObject    $mockObject
     * @param string        $methodName
     * @param array|mixed[] $arguments
     * @param array|mixed[] $return
     * @param int           $invokes
     * @param bool          $returnSelf
     *
     * @return $this
     */
    protected function mockFunction(
        MockObject $mockObject,
        $methodName,
        array $arguments = [],
        array $return = [],
        $invokes = 1,
        $returnSelf = true
    ): self {
        $invocationMocker = $mockObject->expects(new InvokedCount($invokes))
            ->method($methodName)
            ->with(...$arguments);

        if (empty($return) && $returnSelf) {
            $invocationMocker->willReturnSelf();
        }

        if (!empty($return)) {
            $invocationMocker->willReturn(...$return);
        }

        return $this;
    }

    /**
     * @param MockObject    $mockObject
     * @param string        $methodName
     * @param array|mixed[] $return
     * @param int           $invokes
     *
     * @return $this
     */
    protected function getterMock(MockObject $mockObject, $methodName, array $return = [], $invokes = 1): self
    {
        $this->mockFunction($mockObject, $methodName, [], $return, $invokes);

        return $this;
    }

    /**
     * @param MockObject    $mockObject
     * @param string        $methodName
     * @param array|mixed[] $argument
     * @param int           $invokes
     * @param bool          $returnSelf
     *
     * @return $this
     */
    protected function setterMock(
        MockObject $mockObject,
        $methodName,
        array $argument = [],
        $invokes = 1,
        $returnSelf = true
    ): self {
        $this->mockFunction($mockObject, $methodName, $argument, [], $invokes, $returnSelf);

        return $this;
    }

    /**
     * @param MockObject $object
     * @param string     $methodName
     * @param array      $valueMap
     *
     * @return $this
     */
    protected function willReturnMapMock(MockObject $object, $methodName, array $valueMap): self
    {
        $object->expects(new InvokedCount(count($valueMap)))->method($methodName)->willReturnMap($valueMap);

        return $this;
    }
}
