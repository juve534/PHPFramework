<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// find environment file
$envFile = __DIR__. '/../.env';
if (is_readable($envFile)) {
     $dotEnv = new Dotenv\Dotenv(__DIR__ . '/../');
     $dotEnv->load();
}
// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Require blog routes
require __DIR__ . '/../src/routes/blog.php';

// Require mackerel routes
require __DIR__ . '/../src/routes/mackerel.php';

// Require twitter Library
require __DIR__ . '/../vendor/abraham/twitteroauth/autoload.php';

// Run app
$app->run();