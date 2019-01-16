<?php

namespace Creativestyle\Utilities;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Provides configuration by array feature.
 *
 * Remember to call ::resolveConfiguration with the user supplied options.
 */
trait Configurable
{
    /**
     * Array of resolved options.
     *
     * Private so nobody directly messes with this stuff.
     *
     * @var array
     */
    private $options;

    /**
     * Returns array of resolved options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return $this->options;
    }

    /**
     * Returns an option by name.
     *
     * @param $name
     * @throws \LogicException
     * @return mixed
     */
    protected function getOption($name)
    {
        if (!$this->hasOption($name)) {
            throw new \LogicException("Requested an option '{$name}' which does not exist.");
        }

        return $this->options[$name];
    }

    /**
     * Checks whether the option exists.
     *
     * @param string $name
     * @return bool
     */
    protected function hasOption($name)
    {
        return array_key_exists($name, $this->options);
    }

    /**
     * Resolves the configuration and stores the resulting option array.
     *
     * @param array $options
     */
    protected function resolveConfiguration(array $options)
    {
        $optionResolver = new OptionsResolver();

        $this->configureOptions($optionResolver);
        $this->options = $optionResolver->resolve($options);
    }

    /**
     * Configures the options resolver setting default options, etc.
     *
     * @param OptionsResolver $optionsResolver
     */
    abstract protected function configureOptions(OptionsResolver $optionsResolver);
}