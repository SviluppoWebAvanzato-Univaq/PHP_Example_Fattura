<?php

date_default_timezone_set("Europe/Rome");

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

//(da composer)
require __DIR__ . '/../vendor/autoload.php';

//applicazione slim
$settings = require __DIR__ . '/../src/slim_settings.php';
$app = new \Slim\App($settings);

//dipendenze slim (in questo caso solo Monolog)
require __DIR__ . '/../src/slim_dependencies.php';

//eventuale middleware slim
require __DIR__ . '/../src/slim_middleware.php';

//routes slim = RESTful paths
require __DIR__ . '/../src/slim_routes.php';

//run!
$app->run();
