<?php

namespace Creativestyle\Utilities\Tests;

use Creativestyle\Utilities\ArrayHelpers;

class ArrayHelpersTest extends \PHPUnit\Framework\TestCase
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
}