<?php

use MSIC\Container;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testContainer()
    {
        $container = new Container();
        $container->addService('service', []);
        $this->assertInstanceOf('GuzzleHttp\Client', $container->getService('service'));
    }
}