<?php

namespace BookQueryLoopVar;

class Variation
{
	/**
	 * Name of the variation should match that in `src/index.js`.
	 */
	const VARIATION_NAME = 'book-query-loop-variation';

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

		// Below filters not needed unless rolling out custom query vars.

		// Front end.
		add_filter( 'pre_render_block', [ $this, 'preRender' ], 10, 2 );

		// Editor.
	//	add_filter( 'rest_book_query', [ $this, 'query' ], 10 , 2 );
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

	public function preRender( $pre_render, $parsed_block )
	{
		if ( self::VARIATION_NAME === $parsed_block['attrs']['namespace'] ) {
			add_filter(
				'query_loop_block_query_vars',
				function( $query, $block ) use ( $parsed_block ) {

					return $query;
				},
				10,
				2
			);
		}

		return $pre_render;
	}

	public function query( $args, $request )
	{
		// Access custom parameters via $request->get_param( $name );
		return $args;
	}
}
