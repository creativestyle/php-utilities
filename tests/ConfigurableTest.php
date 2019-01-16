<?php

namespace Creativestyle\Utilities\Tests;

class ConfigurableTest extends \PHPUnit\Framework\TestCase
{
    public function testIfConfigurable()
    {
        $c = new ConfigurableTestClass([
            'test' => 'working'
        ]);

        $this->assertEquals([
            'test' => 'working',
            'working' => 'yes',
        ], $c->getOptionsPublic());
    }

    public function testGetExistingOption()
    {
        $c = new ConfigurableTestClass();

        $this->assertEquals('yes', $c->getOptionPublic('working'));
    }

    public function testGetNotExistingOption()
    {
        $c = new ConfigurableTestClass();

        $this->expectException(\LogicException::class);

        $c->getOptionPublic('does_not_exist');
    }
}