<?php

namespace SymonWhite\PhpUnitTraits;

use PHPUnit\Framework\MockObject\Matcher\InvokedCount;
use PHPUnit\Framework\MockObject\MockObject;

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
        string $methodName,
        array $arguments = [],
        $return = null,
        $invokes = 1,
        $returnSelf = true
    ): self {
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
    protected function getterMock(MockObject $mockObject, string $methodName, $return, int $invokes = 1): self
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
        string $methodName,
        array $argument = [],
        int $invokes = 1,
        bool $returnSelf = true
    ): self {
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
    protected function willReturnMapMock(MockObject $object, string $methodName, array $valueMap): self
    {
        $object->expects(new InvokedCount(count($valueMap)))->method($methodName)->willReturnMap($valueMap);

        return $this;
    }
}
