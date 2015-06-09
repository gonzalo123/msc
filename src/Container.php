<?php

namespace MSIC;

use GuzzleHttp\Client;

class Container
{
    private $container;

    public function addService($serviceName, array $serviceConfig=[])
    {
        $this->container[$serviceName] = new Client($serviceConfig);
    }

    /**
     * @param string $serviceName
     * @return \GuzzleHttp\Client
     */
    public function getService($serviceName)
    {
        return $this->container[$serviceName];
    }
}