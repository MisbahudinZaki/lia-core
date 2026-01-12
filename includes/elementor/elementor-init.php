<?php
/**
 * Elementor Init
 *
 * @package lia-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Bail early if Elementor not loaded
 */
if ( ! did_action( 'elementor/loaded' ) ) {
    return;
}

/**
 * -------------------------------------------------
 * 1. Register Elementor Widgets
 * -------------------------------------------------
*/
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    
    require_once LIA_CORE_PATH . 'includes/elementor/widgets/header.php';
    $widgets_manager->register( new \Lia_Header_Widget() );
    
    require_once LIA_CORE_PATH . 'includes/elementor/widgets/footer.php';
    $widgets_manager->register( new \Lia_Footer_Widget() );
    
    require_once LIA_CORE_PATH . 'includes/elementor/widgets/service-card.php';
    $widgets_manager->register( new \Lia_Service_Card_Widget() );

    require_once LIA_CORE_PATH . 'includes/elementor/widgets/portfolio-list.php';
    $widgets_manager->register( new \Lia_Portfolio_List_Widget() );

    require_once LIA_CORE_PATH . 'includes/elementor/widgets/team-card.php';
    $widgets_manager->register( new \Lia_Team_Card_Widget() );

    require_once LIA_CORE_PATH . 'includes/elementor/widgets/title.php';
    $widgets_manager->register( new \Lia_Title_Widget() );

    require_once LIA_CORE_PATH . 'includes/elementor/widgets/button.php';
    $widgets_manager->register( new \Lia_Button_Widget() );

    require_once LIA_CORE_PATH . 'includes/elementor/widgets/about.php';
    $widgets_manager->register( new \Lia_About_Widget() );

    require_once LIA_CORE_PATH . 'includes/elementor/widgets/achievement.php';
    $widgets_manager->register( new \Lia_Achievement_Widget() );

    require_once LIA_CORE_PATH . 'includes/elementor/widgets/whychooseus.php';
    $widgets_manager->register( new \Lia_Why_Choose_Us_Widget() );

    require_once LIA_CORE_PATH . 'includes/elementor/widgets/featured.php';
    $widgets_manager->register( new \Lia_Featured_Widget() );

    require_once LIA_CORE_PATH . 'includes/elementor/widgets/contact-cta.php';
    $widgets_manager->register( new \Lia_Contact_CTA_Widget() );

});


/**
 * -------------------------------------------------
 * 2. Allow Elementor for Header Builder CPT
 * -------------------------------------------------
 */

/**
 * a) Make Elementor detect the CPT
 */
add_filter( 'elementor/utils/get_public_post_types', function( $post_types ) {

    if ( ! in_array( 'lia-header', $post_types, true ) ) {
        $post_types[] = 'lia-header';
    }

    return $post_types;
});

/**
 * b) Enable "Edit with Elementor" button
 */
add_filter( 'elementor/editor/post_types', function( $post_types ) {

    if ( ! in_array( 'lia-header', $post_types, true ) ) {
        $post_types[] = 'lia-header';
    }

    return $post_types;
});


/**
 * -------------------------------------------------
 * 3. Register Elementor Category
 * -------------------------------------------------
 */
add_action( 'elementor/elements/categories_registered', function( $elements_manager ) {

    $elements_manager->add_category(
        'lia-elements',
        [
            'title' => __( 'Lia Elements', 'lia-core' ),
            'icon'  => 'fa fa-plug',
        ]
    );

});
