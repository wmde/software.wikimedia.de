<?php

declare( strict_types = 1 );

class BlogTwigExtension extends \Twig_Extension {

	private $app;

	public function __construct( $app ) {
		$this->app = $app;
	}

	public function getFunctions(): array {
		return [
			new Twig_Function(
				'getBlogPosts',
				function( string $url, int $max = 0 ): array {
					return array_map(
						$this->getPostToResponseModelFunction(),
						$this->getBlogPostsFromUrl( $url, $max )
					);
				}
			)
		];
	}

	private function getPostToResponseModelFunction() {
		return function( SimplePie_Item $item ) {
			return [
				'title' => $item->get_title(),
				'link' => $item->get_permalink(),
				'date' => $item->get_date()
			];
		};
	}

	private function getBlogPostsFromUrl( string $url, int $max = 0, int $offset = 0 ): array {
		if ( $this->app['debug'] ) {
			return [];
		}

		$rssReader = new SimplePie();

		$rssReader->set_feed_url( $url );
		$rssReader->init();
		$rssReader->handle_content_type();

		return $rssReader->get_items( $offset, $max );
	}

}