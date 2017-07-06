<?php

declare( strict_types = 1 );

ini_set('display_errors', '0');

require_once __DIR__.'/../vendor/autoload.php';

/**
 * @var Silex\Application $app
 */
$app = require __DIR__.'/../app/bootstrap.php';
$app['http_cache']->run();
$app->run();
