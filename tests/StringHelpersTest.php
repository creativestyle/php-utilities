<?php

namespace CS\Utilities\Tests;

use CS\Utilities\StringHelpers;
use Prophecy\Util\StringUtil;

class StringHelpersTest extends \PHPUnit_Framework_TestCase
{
    public function testEndsWith()
    {
        $this->assertTrue(
            StringHelpers::endsWith('this is just a test string', 'test string')
        );

        $this->assertFalse(
            StringHelpers::endsWith('another test string for testing', 'something else')
        );

        $this->assertFalse(
            StringHelpers::endsWith('short string', 'string longer than the short one')
        );

        $this->assertFalse(
            StringHelpers::endsWith('it contained nothing', 'contained')
        );
    }

    public function testTitleCase()
    {
        $this->assertEquals(
            'Świeży Ćwierkający Ówcześnie Łącznik',
            StringHelpers::convertToTitleCase('świeży ćwierkający ówcześnie łącznik')
        );

        $this->assertEquals(
            '',
            StringHelpers::convertToTitleCase('')
        );
    }

    public function testJoinNotEmpty()
    {
        $this->assertEquals(
            'This is just a test',
            StringHelpers::joinNotEmpty(['This', 'is', '', 'just', null, 0, 'a', 'test'], ' ')
        );

        $this->assertEquals(
            '',
            StringHelpers::joinNotEmpty([''])
        );
    }

    public function testUrlize()
    {
        $this->assertEquals(
            'swierkowa-laka',
            StringHelpers::urlize(' Świerkowa & łąka')
        );

        $this->assertEquals(
            'strasse',
            StringHelpers::urlize('Straße')
        );

        $this->assertEquals(
            'script-a',
            StringHelpers::urlize("<script>\r\n\na\n ")
        );
    }

    public function testStartsWith()
    {
        $this->assertTrue(StringHelpers::startsWith('john likes oranges', 'john lik'));
        $this->assertTrue(StringHelpers::startsWith('marie loves tomatoes', 'mar'));
        $this->assertNotTrue(StringHelpers::startsWith('marie loves tomatoes', 'loves'));
        $this->assertNotTrue(StringHelpers::startsWith('jenkins, how are you', 'you'));
    }
}