<?php

namespace BookQueryLoopVar;

class Book
{
	public function boot(): void
	{
                add_action( 'init', [ $this, 'register' ] );
	}

	public function register(): void
	{
		register_post_type( 'book', [
			'public'       => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-book',
			'has_archive'  => 'books',
			'supports'     => [
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields'
			],
			'labels'       => [
				'name'                  => __( 'Books' ),
				'singular_name'         => __( 'Book' ),
				'menu_name'             => __( 'Books' ),
				'name_admin_bar'        => __( 'Books' ),
				'add_new'               => __( 'Add New' ),
				'add_new_item'          => __( 'Add New Book' ),
				'edit_item'             => __( 'Edit Book' ),
				'new_item'              => __( 'New Book' ),
				'view_item'             => __( 'View Book' ),
				'search_items'          => __( 'Search Books' ),
				'not_found'             => __( 'No posts found' ),
				'not_found_in_trash'    => __( 'No posts found in trash' ),
				'all_items'             => __( 'All Books' ),
				'featured_image'        => __( 'Featured Image' ),
				'set_featured_image'    => __( 'Set featured image' ),
				'remove_featured_image' => __( 'Remove featured image' ),
				'use_featured_image'    => __( 'Use as featured image' ),
				'insert_into_item'      => __( 'Insert into post' ),
				'uploaded_to_this_item' => __( 'Uploaded to this post' ),
				'views'                 => __( 'Filter posts list' ),
				'pagination'            => __( 'Books list navigation' ),
				'list'                  => __( 'Books list' )
			]
		] );

		// Register custom metadata.
		register_meta( 'post', 'book_author', [
			'object_subtype'    => 'book',
			'type'              => 'string',
			'single'            => true,
			'sanitize_callback' => 'wp_strip_all_tags',
			'show_in_rest'      => true
		] );
	}
}
