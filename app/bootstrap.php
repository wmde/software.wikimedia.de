<?php

declare( strict_types = 1 );

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());

$app['twig.path'] = [ __DIR__.'/templates' ];

$app->error(function ( \Exception $e, Request $request, $code ) use ($app) {
    if ($app['debug']) {
        return;
    }

    $codeString = (string)$code;

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = [
        'errors/' . $codeString . '.html',
        'errors/' . substr( $codeString, 0, 2 ) . 'x.html',
        'errors/' . substr( $codeString, 0, 1 ) . 'xx.html',
        'errors/default.html',
    ];

    return new Response($app['twig']->resolveTemplate($templates)->render(
    	[ 'code' => $code, 'basepath' => $request->getBasePath()] ),
		$code
	);
});

( new Routes( $app ) )->register();

return $app;
