<?php

namespace Creativestyle\Utilities\Tests;

use Creativestyle\Utilities\ArrayHelpers;
use Creativestyle\Utilities\Tests\Dummies\DummyObject;
use PHPUnit\Framework\TestCase;

class ArrayHelpersTest extends TestCase
{
    public function testPickColumn()
    {
        $this->assertEquals(
            ['a1', 'a2', 'a3'],
            ArrayHelpers::pickColumn(
                [
                    ['a' => 'a1', 'b' => 'b1'],
                    ['a' => 'a2', 'b' => 'b2'],
                    ['a' => 'a3', 'b' => 'b3'],
                ],
                'a'
            )
        );

        $this->assertEquals(
            ['b1', null, null],
            ArrayHelpers::pickColumn(
                [
                    ['a' => 'a1', 'b' => 'b1'],
                    [],
                    ['a' => 'a3'],
                ],
                'b'
            )
        );

        $this->assertEquals([], ArrayHelpers::pickColumn([], 'x'));
    }

    public function testPick()
    {
        $this->assertEquals(
            ['b' => 2],
            ArrayHelpers::pick(['b', 'z'], ['a' => 1, 'b' => 2, 'c' => 3])
        );

        $this->assertEquals(
            [],
            ArrayHelpers::pick([], [])
        );
    }


    /**
     * @dataProvider mapMethodStringsArrayProvider
     *
     * @param string[] $inputArray
     * @param string[] $outputArray
     * @param array $methodArguments
     * @param string|null $validateClassName
     */
    public function testMapMethod($inputArray, $outputArray, $methodArguments, $validateClassName)
    {
        $this->assertEquals(
            $outputArray,
            ArrayHelpers::mapMethod(DummyObject::createArrayOf($inputArray), 'getValue', $methodArguments, $validateClassName)
        );
    }

    public function mapMethodStringsArrayProvider()
    {
        return [
            'basic' => [['just', 'a', 'test'], ['just', 'a', 'test'], [], null],
            'args' => [['just', 'a', 'test'], ['just-x', 'a-x', 'test-x'], ['-x'], null],
            'classname' => [['just', 'a', 'test'], ['just', 'a', 'test'], [], DummyObject::class],
        ];
    }

    /**
     * @dataProvider uniqueObjectsArrayProvider
     *
     * @param string[] $nonUniqueValues
     */
    public function testUniqueObjects($nonUniqueValues)
    {
        $uniqueValues = array_unique($nonUniqueValues);
        $uniqueObjects = DummyObject::createArrayOf($uniqueValues);
        $uniqueObjectsByValue = array_combine($uniqueValues, $uniqueObjects);

        $nonUniqueObjects = array_map(
            function($value) use ($uniqueObjectsByValue) { return $uniqueObjectsByValue[$value]; },
            $nonUniqueValues
        );

        $this->assertEquals(
            $uniqueObjects,
            ArrayHelpers::uniqueObjects($nonUniqueObjects)
        );
    }

    public function uniqueObjectsArrayProvider()
    {
        return [
            'basic' => [['a', 'b', 'b', 'c', 'd', 'e']],
            'keys' => [[ 5 => 'x', 0 => 'b', 'x' => 'e', 'e', 'd', 'z' => 'e']],
        ];
    }
}