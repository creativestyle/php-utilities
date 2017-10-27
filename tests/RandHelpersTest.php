<?php

namespace CS\Utilities\Tests;

use CS\Utilities\RandHelpers;

class RandHelpersTest extends \PHPUnit_Framework_TestCase
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

    public function testSampleReturnsProperNumberOfResults()
    {
        $this->assertEquals(1, count(RandHelpers::sample(['a', 'b', 'c', 'd', 'e'], 1)));
        $this->assertEquals(0, count(RandHelpers::sample(['a', 'b', 'c', 'd', 'e'], 0)));
        $this->assertEquals(5, count(RandHelpers::sample(['a', 'b', 'c', 'd', 'e'], 5)));
        $this->assertEquals(5, count(RandHelpers::sample(['a', 'b', 'c', 'd', 'e'], 10)));
    }

    public function testSampleDoesntRepeatResults()
    {
        $result = RandHelpers::sample(['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k'], 7);

        $this->assertEquals(count(array_unique($result)), 7);
    }

}