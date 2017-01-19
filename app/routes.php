<?php

declare( strict_types = 1 );

/**
 * These variables need to be in scope when this file is included:
 *
 * @var \Silex\Application $app
 */

$app->get(
	'/',
	function() use ( $app ) {
		return $app['twig']->render(
			'pages/home.html',
			array()
		);
	}
);
