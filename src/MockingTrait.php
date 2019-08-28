<?php

namespace SymonWhite\PhpUnitTraits;

use PHPUnit_Framework_MockObject_Matcher_InvokedCount as InvokedCount;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Class MockingTrait
 */
trait MockingTrait
{
    /**
     * @param MockObject $mockObject
     * @param string $methodName
     * @param array $arguments
     * @param null $return
     * @param int $invokes
     * @param bool $returnSelf
     *
     * @return $this
     */
    protected function mockFunction(
        MockObject $mockObject,
        $methodName,
        array $arguments = [],
        $return = null,
        $invokes = 1,
        $returnSelf = true
    ) {
        $invocationMocker = $mockObject->expects(new InvokedCount($invokes))
            ->method($methodName)
            ->with(...$arguments);

        if ($return === null && $returnSelf) {
            $invocationMocker->willReturnSelf();
        }

        if ($return !== null) {
            $invocationMocker->willReturn($return);
        }

        return $this;
    }

    /**
     * @param MockObject $mockObject
     * @param string     $methodName
     * @param mixed      $return
     * @param int        $invokes
     *
     * @return $this
     */
    protected function getterMock(MockObject $mockObject, $methodName, $return, $invokes = 1)
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
    ) {
        $this->mockFunction($mockObject, $methodName, $argument, null, $invokes, $returnSelf);

        return $this;
    }

    /**
     * @param MockObject $object
     * @param string     $methodName
     * @param array      $valueMap
     *
     * @return $this
     */
    protected function willReturnMapMock(MockObject $object, $methodName, array $valueMap)
    {
        $object->expects(new InvokedCount(count($valueMap)))->method($methodName)->willReturnMap($valueMap);

        return $this;
    }
}
