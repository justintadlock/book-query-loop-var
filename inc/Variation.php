<?php

namespace BookQueryLoopVar;

class Variation
{
	protected string $path;
	protected string $url;

	public function __construct( string $path, string $url )
	{
		$this->path = $path;
		$this->url  = $url;
	}

	public function boot(): void
	{
		add_action( 'enqueue_block_editor_assets', [ $this, 'assets' ] );
	}

	public function assets(): void
	{
		$assets_file = "{$this->path}/build/index.asset.php";

		if ( file_exists( $assets_file ) ) {
			$assets = include $assets_file;

			wp_enqueue_script(
				'book-query-loop-var',
				"{$this->url}/build/index.js",
				$assets['dependencies'],
				$assets['version'],
				true
			);
		}
	}
}
