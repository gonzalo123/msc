<?php

include __DIR__ . '/../../vendor/autoload.php';

use Silex\Application;

$app = new Application();

$app->get('/hello/{username}', function($username) {
    return "Hello {$username} from silex service";
});

$app->run();