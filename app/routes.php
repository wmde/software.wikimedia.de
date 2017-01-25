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
				return $this->renderPage( 'home' );
			}
		);

		$this->app->get(
			'/{page}',
			function( $page ) {
				return $this->renderPage( $page );
			}
		);
	}

	private function renderPage( string $pageName ): string {
		try {
			return $this->renderTwigTemplate( "pages/$pageName.html", $pageName );
		}
		catch ( Twig_Error_Loader $ex ) {
			return $this->renderTwigTemplate( 'errors/404.html', '' );
		}
	}

	private function renderTwigTemplate( string $templateName, string $pageName ): string {
		return $this->getTwig()->render(
			$templateName,
			[
				'basepath' => '',
				'page' => $pageName
			]
		);
	}

	private function getTwig(): \Twig_Environment {
		return $this->app['twig'];
	}

}
