<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Service Custom Post Type
 */
function lia_core_register_service_cpt() {

    $labels = [
        'name'               => __( 'Services', 'lia-core' ),
        'singular_name'      => __( 'Service', 'lia-core' ),
        'menu_name'          => __( 'Services', 'lia-core' ),
        'name_admin_bar'     => __( 'Service', 'lia-core' ),
        'add_new'            => __( 'Add New', 'lia-core' ),
        'add_new_item'       => __( 'Add New Service', 'lia-core' ),
        'new_item'           => __( 'New Service', 'lia-core' ),
        'edit_item'          => __( 'Edit Service', 'lia-core' ),
        'view_item'          => __( 'View Service', 'lia-core' ),
        'all_items'          => __( 'All Services', 'lia-core' ),
        'search_items'       => __( 'Search Services', 'lia-core' ),
        'not_found'          => __( 'No services found.', 'lia-core' ),
        'not_found_in_trash' => __( 'No services found in Trash.', 'lia-core' ),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => [ 'slug' => 'service' ],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-admin-tools',
        'supports'           => [
            'title',        // Title
            'editor',       // Detail Content
            'excerpt',      // Description
            'thumbnail',    // Icon / image
        ],
        'show_in_rest'       => true, // Gutenberg & Elementor friendly
    ];

    register_post_type( 'service', $args );
}
add_action( 'init', 'lia_core_register_service_cpt' );
