<?php

declare( strict_types = 1 );

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Routes {

	private $app;

	public function __construct( Application $app ) {
		$this->app = $app;
	}

	public function register() {
		$this->app->get(
			'/',
			function( Request $request ) {
				return $this->renderPage( $request, 'home' );
			}
		);

		$this->app->get(
			'/{page}',
			function( Request $request, string $page ) {
				return $this->renderPage( $request, basename( $page ) );
			}
		);

		$this->app->get(
			'/{page}/{sub}',
			function( Request $request, string $page, string $sub ) {
				return $this->renderPage( $request, basename( $page ) . '/' . basename( $sub ) );
			}
		);
	}

	private function renderPage( Request $request, string $pageName ): Response {
		try {
			$response = new Response(
				$this->renderTwigTemplate(
					$request,
					"pages/$pageName.html",
					$pageName
				)
			);

			$response->setTtl( 1800 );

			return $response;
		}
		catch ( Twig_Error_Loader $ex ) {
			return new Response(
				$this->renderTwigTemplate(
					$request,
					'errors/404.html',
					''
				),
				404
			);
		}
	}

	private function renderTwigTemplate( Request $request, string $templateName, string $pageName ): string {
		return $this->getTwig()->render(
			$templateName,
			[
				'basepath' => $this->getBasePath( $request ),
				'filepath' => $request->getBasePath(),
				'page' => $pageName
			]
		);
	}

	private function getBasePath( Request $request ): string {
		if ( $request->getScriptName() === '/index.dev.php' ) {
			return $request->getBasePath() . $request->getScriptName();
		}

		return $request->getBasePath();
	}

	private function getTwig(): \Twig_Environment {
		return $this->app['twig'];
	}

}
