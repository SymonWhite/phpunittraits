<?php

namespace SymonWhite\PhpUnitTraits\Test;

/**
 * @class TestEntity
 */
class TestEntity
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}
