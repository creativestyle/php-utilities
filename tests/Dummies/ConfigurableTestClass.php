<?php

namespace Creativestyle\Utilities\Tests\Dummies;

use Creativestyle\Utilities\Configurable;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurableTestClass
{
    use Configurable;

    public function __construct(array $options = [])
    {
        $this->resolveConfiguration($options);
    }

    public function getOptionPublic($name)
    {
        return $this->getOption($name);
    }

    public function getOptionsPublic()
    {
        return $this->getOptions();
    }

    protected function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefault('working', 'yes');
        $optionsResolver->setDefault('test', 'not_working');
    }
}