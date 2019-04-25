<?php

namespace SymonWhite\PhpUnitTraits\Exception;

use Exception;
use Throwable;

/**
 * @class MethodNotFoundException
 */
class MethodNotFoundException extends Exception
{
    protected const MESSAGE = '%s-Method not found for property "%s" in class "%s"';

    /**
     * MethodNotFoundException constructor.
     *
     * @param string         $className
     * @param string         $propertyName
     * @param bool           $isSetter
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($className, $propertyName, $isSetter, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf(
                self::MESSAGE,
                $isSetter ? 'Setter' : 'Getter',
                $propertyName,
                $className
            ),
            $code,
            $previous
        );
    }
}
