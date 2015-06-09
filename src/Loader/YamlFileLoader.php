<?php

namespace MSIC\Loader;

use MSIC\Container;
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

class YamlFileLoader extends FileLoader
{
    private   $container;
    protected $locator;

    public function __construct(Container $container, FileLocatorInterface $locator)
    {
        $this->container = $container;
        $this->locator = $locator;

        parent::__construct($locator);
    }

    public function load($file, $type = null)
    {
        $path = $this->locator->locate($file);
        $config = Yaml::parse($path);

        if (null === $config) {
            $config = [];
        }

        if (!is_array($config)) {
            throw new \InvalidArgumentException(sprintf('The file "%s" must contain a YAML array.', $file));
        }

        foreach ($config as $serviceName => $serviceConfig) {
            $this->container->addService($serviceName, $serviceConfig);
        }
    }

    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo($resource,
            PATHINFO_EXTENSION) && (!$type || 'yaml' === $type);
    }
}