<?php

include __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use MSIC\Loader\YamlFileLoader;
use MSIC\Container;

$container = new Container();

$ymlLoader = new YamlFileLoader($container, new FileLocator(__DIR__));
$ymlLoader->load('container.yml');

echo $container->getService('flaskServer')->get('/hello/Gonzalo')->getBody() . "\n";
echo $container->getService('silexServer')->get('/hello/Gonzalo')->getBody() . "\n";
echo $container->getService('slimServer')->get('/hello/Gonzalo')->getBody() . "\n";
