<?php

declare( strict_types = 1 );

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class Routes {

	private $app;

	public function __construct( Application $app ) {
		$this->app = $app;
	}

	public function register() {
		$this->app->get(
			'/',
			function( Request $request ) {
				return $this->renderPage( $request->getBasePath(), 'home' );
			}
		);

		$this->app->get(
			'/{page}',
			function( Request $request, string $page ) {
				return $this->renderPage( $request->getBasePath(), basename( $page ) );
			}
		);

		$this->app->get(
			'/{page}/{sub}',
			function( Request $request, string $page, string $sub ) {
				return $this->renderPage( $request->getBasePath(), basename( $page ) . '/' . basename( $sub ) );
			}
		);
	}

	private function renderPage( string $basePath, string $pageName ): string {
		try {
			return $this->renderTwigTemplate( $basePath, "pages/$pageName.html", $pageName );
		}
		catch ( Twig_Error_Loader $ex ) {
			return $this->renderTwigTemplate( $basePath, 'errors/404.html', '' );
		}
	}

	private function renderTwigTemplate( string $basePath, string $templateName, string $pageName ): string {
		return $this->getTwig()->render(
			$templateName,
			[
				'basepath' => $basePath,
				'page' => $pageName
			]
		);
	}

	private function getTwig(): \Twig_Environment {
		return $this->app['twig'];
	}

}
