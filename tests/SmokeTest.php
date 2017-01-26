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

	public function testRootPageContainsHello() {
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

}