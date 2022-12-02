<?php

namespace BookQueryLoopVar;

function plugin( string $abstract = '' )
{
        static $bindings = [];

	if ( [] === $bindings ) {
		$bindings = [
			'book'      => new Book(),
			'variation' => new Variation(
				untrailingslashit( __DIR__ . '/..' ),
				untrailingslashit( plugins_url( '/..', __FILE__ ) )
			)
		];

		foreach ( $bindings as $binding ) {
			$binding->boot();
		}
	}

	return '' === $abstract ? $bindings : $bindings[ $abstract ];
}
