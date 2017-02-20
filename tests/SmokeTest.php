<?php

declare( strict_types = 1 );

use Silex\Application;
use Silex\WebTestCase;

class SmokeTest extends WebTestCase {

	public function createApplication(): Application {
		$app = require __DIR__ . '/../app/bootstrap.php';
		$app['debug'] = true;
		return $app;
	}

	public function testRootPageRespondsWithHttp200() {
		$client = $this->createClient();

		$client->request( 'GET', '/' );

		$this->assertSame( 200, $client->getResponse()->getStatusCode() );
	}

	public function testRootPageContainsWikimedia() {
		$client = $this->createClient();

		$client->request( 'GET', '/' );

		$this->assertContains( 'Wikimedia', $client->getResponse()->getContent() );
	}

	public function testPageNotFound() {
		$this->app = require __DIR__ . '/../app/bootstrap.php';
		$client = $this->createClient();

		$client->request( 'GET', '/kittens' );

		$this->assertContains(
			'images/errors/404.jpg',
			$client->getResponse()->getContent()
		);
	}

	/**
	 * @dataProvider pageNameProvider
	 */
	public function testAllPagesReturnHttp200( string $pageName ) {
		$client = $this->createClient();

		$client->request( 'GET', $pageName );

		$this->assertSame( 200, $client->getResponse()->getStatusCode() );
	}

	public function pageNameProvider(): array {
		return array_map(
			function( $v ): array {
				return [ $v ];
			},
			$this->getPageNames()
		);
	}

	private function getPageNames(): array {
		return array_map(
			function( SplFileInfo $fileInfo ): string {
				$pathParts = explode( '/pages/', $fileInfo->getPathname(), 2 );
				return substr( $pathParts[1], 0, -5 );
			},
			$this->getHtmlPagePaths()
		);
	}

	private function getHtmlPagePaths(): array {
		return array_filter(
			iterator_to_array( new RecursiveIteratorIterator( new RecursiveDirectoryIterator(  __DIR__ . '/../app/templates/pages' ) ) ),
			function( string $fileName ): bool {
				return substr( $fileName, -5 ) === '.html';
			}
		);
	}

}