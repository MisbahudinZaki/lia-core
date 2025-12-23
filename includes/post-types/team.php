<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register CPT Team
 */
function lia_core_register_cpt_team() {

    $labels = array(
        'name'               => __( 'Teams', 'lia-core' ),
        'singular_name'      => __( 'Team Member', 'lia-core' ),
        'menu_name'          => __( 'Team', 'lia-core' ),
        'name_admin_bar'     => __( 'Team Member', 'lia-core' ),
        'add_new'            => __( 'Add Member', 'lia-core' ),
        'add_new_item'       => __( 'Add New Team Member', 'lia-core' ),
        'edit_item'          => __( 'Edit Team Member', 'lia-core' ),
        'new_item'           => __( 'New Team Member', 'lia-core' ),
        'view_item'          => __( 'View Team Member', 'lia-core' ),
        'search_items'       => __( 'Search Team', 'lia-core' ),
        'not_found'          => __( 'No team members found', 'lia-core' ),
        'not_found_in_trash' => __( 'No team members found in Trash', 'lia-core' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'team' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 23,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'thumbnail' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'team', $args );
}
add_action( 'init', 'lia_core_register_cpt_team' );