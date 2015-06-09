Simple Microservice container
======

Silex Service
=====
```php
use Silex\Application;

$app = new Application();

$app->get('/hello/{username}', function($username) {
    return "Hello {$username} from silex service";
});

$app->run();
```

Slim Service
=====
```php
use Slim\Slim;

$app = new Slim();

$app->get('/hello/:username', function ($username) {
    echo "Hello {$username} from slim service";
});

$app->run();
```

Flask Service
=====
```python
from flask import Flask, jsonify
app = Flask(__name__)

@app.route('/hello/<username>')
def show_user_profile(username):
    return "Hello %s from flask service" % username

if __name__ == "__main__":
    app.run(debug=True, host='0.0.0.0', port=5000)
```

Example
=====

```php
use Symfony\Component\Config\FileLocator;
use MSIC\Loader\YamlFileLoader;
use MSIC\Container;

$container = new Container();

$ymlLoader = new YamlFileLoader($container, new FileLocator(__DIR__));
$ymlLoader->load('container.yml');

echo $container->getService('flaskServer')->get('/hello/Gonzalo')->getBody() . "\n";
echo $container->getService('silexServer')->get('/hello/Gonzalo')->getBody() . "\n";
echo $container->getService('slimServer')->get('/hello/Gonzalo')->getBody() . "\n";
```



