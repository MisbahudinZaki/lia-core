<?php
/**
 * Register Footer Builder Post Type
 *
 * @package lia-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function lia_register_footer_post_type() {

    $labels = array(
        'name'               => esc_html__( 'Footer Builder', 'lia-core' ),
		'singular_name'      => esc_html__( 'Footer', 'lia-core' ),
		'add_new'            => esc_html__( 'Add Footer', 'lia-core' ),
		'add_new_item'       => esc_html__( 'Add New Footer', 'lia-core' ),
		'edit_item'          => esc_html__( 'Edit Footer', 'lia-core' ),
		'new_item'           => esc_html__( 'New Footer', 'lia-core' ),
		'view_item'          => esc_html__( 'View Footer', 'lia-core' ),
		'search_items'       => esc_html__( 'Search Footers', 'lia-core' ),
		'not_found'          => esc_html__( 'No Footers Found', 'lia-core' ),
		'not_found_in_trash' => esc_html__( 'No Footers Found in Trash', 'lia-core' ),
    );

    $args = array(
        'labels'             => $labels,
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 59,
		'menu_icon'          => 'dashicons-editor-kitchensink',

		'supports'           => array( 'title', 'editor' ),

		'exclude_from_search'=> true,
		'publicly_queryable' => true,
		'show_in_nav_menus'  => false,

		'rewrite'            => array(
			'slug' => 'lia-footer',
			'with_front' => false,
		),

		'show_in_rest'       => true,
    );

    register_post_type( 'lia-footer', $args );
}

add_action( 'init', 'lia_register_footer_post_type' );