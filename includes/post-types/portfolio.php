<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Portfolio CPT
 */
function lia_core_register_portfolio_cpt() {

    $labels = [
        'name'               => __( 'Portfolio', 'lia-core' ),
        'singular_name'      => __( 'Portfolio', 'lia-core' ),
        'menu_name'          => __( 'Portfolio', 'lia-core' ),
        'name_admin_bar'     => __( 'Portfolio', 'lia-core' ),
        'add_new'            => __( 'Add New', 'lia-core' ),
        'add_new_item'       => __( 'Add New Project', 'lia-core' ),
        'edit_item'          => __( 'Edit Project', 'lia-core' ),
        'new_item'           => __( 'New Project', 'lia-core' ),
        'view_item'          => __( 'View Project', 'lia-core' ),
        'all_items'          => __( 'All Projects', 'lia-core' ),
        'search_items'       => __( 'Search Projects', 'lia-core' ),
        'not_found'          => __( 'No projects found.', 'lia-core' ),
        'not_found_in_trash' => __( 'No projects found in Trash.', 'lia-core' ),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => [ 'slug' => 'portfolio' ],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 22,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => [
            'title',
            'editor',
            'excerpt',
            'thumbnail',
        ],
        'show_in_rest'       => true,
    ];

    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'lia_core_register_portfolio_cpt' );

/**
 * Register Portfolio Category Taxonomy
 */
function lia_core_register_portfolio_taxonomy() {

    $labels = [
        'name'          => __( 'Portfolio Categories', 'lia-core' ),
        'singular_name' => __( 'Portfolio Category', 'lia-core' ),
        'search_items'  => __( 'Search Categories', 'lia-core' ),
        'all_items'     => __( 'All Categories', 'lia-core' ),
        'edit_item'     => __( 'Edit Category', 'lia-core' ),
        'add_new_item'  => __( 'Add New Category', 'lia-core' ),
        'menu_name'     => __( 'Categories', 'lia-core' ),
    ];

    $args = [
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => [ 'slug' => 'portfolio-category' ],
        'show_in_rest'      => true,
    ];

    register_taxonomy(
        'portfolio-category',
        [ 'portfolio' ],
        $args
    );
}
add_action( 'init', 'lia_core_register_portfolio_taxonomy' );
