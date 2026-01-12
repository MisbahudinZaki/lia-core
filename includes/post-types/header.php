<?php
/**
 * Register Header Builder Post Type
 *
 * @package lia-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function lia_register_header_post_type() {

	$labels = array(
		'name'               => esc_html__( 'Header Builder', 'lia-core' ),
		'singular_name'      => esc_html__( 'Header', 'lia-core' ),
		'add_new'            => esc_html__( 'Add Header', 'lia-core' ),
		'add_new_item'       => esc_html__( 'Add New Header', 'lia-core' ),
		'edit_item'          => esc_html__( 'Edit Header', 'lia-core' ),
		'new_item'           => esc_html__( 'New Header', 'lia-core' ),
		'view_item'          => esc_html__( 'View Header', 'lia-core' ),
		'search_items'       => esc_html__( 'Search Headers', 'lia-core' ),
		'not_found'          => esc_html__( 'No Headers Found', 'lia-core' ),
		'not_found_in_trash' => esc_html__( 'No Headers Found in Trash', 'lia-core' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 58,
		'menu_icon'          => 'dashicons-editor-kitchensink',

		'supports'           => array( 'title', 'editor' ),

		'exclude_from_search'=> true,
		'publicly_queryable' => true,
		'show_in_nav_menus'  => false,

		'rewrite'            => array(
			'slug' => 'lia-header',
			'with_front' => false,
		),

		'show_in_rest'       => true,
	);


	register_post_type( 'lia-header', $args );
}

add_action( 'init', 'lia_register_header_post_type' );
