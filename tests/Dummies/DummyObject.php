<?php

namespace Creativestyle\Utilities\Tests\Dummies;

class DummyObject
{
    /**
     * @var string 
     */
    private $value;
    
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $concat
     * @return string
     */
    public function getValue(string $concat = ''): string
    {
        return $this->value . $concat;
    }

    /**
     * @param string[] $values
     * @return DummyObject[]
     */
    public static function createArrayOf(array $values): array
    {
        return array_map(function(string $value) {
            return new DummyObject($value);
        }, $values);
    }

    public function __toString()
    {
        return static::class . '(' . $this->value . ')';
    }
}