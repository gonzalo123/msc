<?php

include __DIR__ . '/../../vendor/autoload.php';

use Slim\Slim;

$app = new Slim();

$app->get('/hello/:username', function ($username) {
    echo "Hello {$username} from slim service";
});

$app->run();