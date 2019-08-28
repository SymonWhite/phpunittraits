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
     * TestEntity constructor.
     *
     * @param string $id
     * @param array|int[] $tests
     */
    public function __construct(string $id = '', array $tests = [])
    {
        $this->id = $id;
        $this->tests = $tests;
    }

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
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }
    /**
     * @param int $test
     *
     * @return $this
     */
    public function addTest(int $test): self
    {
        $this->tests[] = $test;

        return $this;
    }

    /**
     * @return array|int[]
     */
    public function getTests(): array
    {
        return $this->tests;
    }
}
