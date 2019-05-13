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
     * @var array|int[]
     */
    protected $tests = [];

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param int $test
     *
     * @return $this
     */
    public function addTest($test)
    {
        $this->tests[] = $test;

        return $this;
    }

    /**
     * @return array|int[]
     */
    public function getTests()
    {
        return $this->tests;
    }
}
