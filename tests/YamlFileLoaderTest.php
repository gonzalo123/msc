<?php

use MSIC\Loader\YamlFileLoader;


class YamlFileLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoader()
    {
        $container = $this->getMockBuilder('MSIC\Container')->disableOriginalConstructor()->getMock();
        $counter = 0;
        $actual = [
            0 => ['silexServer' => ['base_uri' => 'http://192.168.1.105:8080/']],
            1 => ['flaskServer' => ['base_uri' => 'http://192.168.1.105:5000/']],
        ];

        $container->expects($this->any())->method('addService')->willReturnCallback(function (
            $serviceName,
            $serviceConfig
        ) use ($actual, &$counter) {
            $this->assertEquals(key($actual[$counter]), $serviceName);
            $this->assertEquals(current($actual[$counter]), $serviceConfig);
            $counter++;
        });

        $locator = $this->getMockBuilder('Symfony\Component\Config\FileLocatorInterface')->disableOriginalConstructor()->getMock();
        $locator->expects($this->any())->method('locate')->will($this->returnValue(__DIR__ . '/fixtures/container.yml'));

        $this->assertEquals(0, $counter);
        $loader = new YamlFileLoader($container, $locator);
        $loader->load('container.yml');
        $this->assertEquals(2, $counter);
    }

    public function testSupports()
    {
        $container = $this->getMockBuilder('MSIC\Container')->disableOriginalConstructor()->getMock();
        $locator = $this->getMockBuilder('Symfony\Component\Config\FileLocatorInterface')->disableOriginalConstructor()->getMock();

        $loader = new YamlFileLoader($container, $locator);
        $this->assertTrue($loader->supports("__DIR__ . '/fixtures/container.yml"));
        $this->assertFalse($loader->supports("__DIR__ . '/fixtures/container.xxx"));
    }
}