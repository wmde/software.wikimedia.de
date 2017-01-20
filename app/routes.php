<?php

declare( strict_types = 1 );

use Silex\Application;

class Routes {

	private $app;

	public function __construct( Application $app ) {
		$this->app = $app;
	}

	public function register() {
		$this->app->get(
			'/',
			function() {
				return $this->renderTwigTemplate( 'home.html' );
			}
		);
	}

	private function renderTwigTemplate( $templateName ): string {
		return $this->getTwig()->render(
			'pages/' . $templateName,
			[
				'basepath' => ''
			]
		);
	}

	private function getTwig(): \Twig_Environment {
		return $this->app['twig'];
	}

}
