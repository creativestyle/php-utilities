<?php

namespace Creativestyle\Utilities\Tests;

use Creativestyle\Utilities\RandHelpers;

class RandHelpersTest extends \PHPUnit\Framework\TestCase
{

    public function getRandStringLengthData()
    {
        return [[0], [1], [20], [1000]];
    }

    /**
     * @param int $len
     * @dataProvider getRandStringLengthData
     */
    public function testProperRandStringLength($len)
    {
        $this->assertEquals($len, strlen(RandHelpers::randString($len)));
    }

    public function getRandStringCharacterData()
    {
        return [
            // Single character cannot produce randomness and breaks random-lib
            // ['x'], 
            ['aa'], 
            ['0123456789'], 
            ["#!@ -"], 
            ["\n\r"], 
            ['0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'], 
            // random-lib seems to mangle UTF-8 characters
            // ['ąęśćżźłóń']
        ];
    }

    /**
     * @param string $chars
     * @dataProvider getRandStringCharacterData
     */
    public function testProperRandStringCharacters($chars)
    {
        $result = RandHelpers::randString(20, $chars);

        $this->assertEquals(20, mb_strlen($result), 'String has proper length');

        for ($i = 0; $i < mb_strlen($result); ++$i) {
            $this->assertContains($result[$i], $chars, 'Character not in list');
        }
    }

}