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
        return [['a'], ['aa'], ['0123456789'], ["#!@ -"], ["\n\r"], ['0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'], ['ąęśćżźłóń']];
    }

    /**
     * @param string $chars
     * @dataProvider getRandStringCharacterData
     */
    public function testProperRandStringCharacters($chars)
    {
        $result = RandHelpers::randString(20, $chars);

        for ($i = 0; $i < mb_strlen($result); ++$i) {
            $this->assertContains($result[$i], $chars, 'Character not in list');
        }
    }

}