<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Elementor Widgets
 */
function lia_core_register_elementor_widgets( $widgets_manager ) {

    require_once LIA_CORE_PATH . 'includes/elementor/widgets/service-card.php';

    $widgets_manager->register( new \Lia_Service_Card_Widget() );
}
add_action( 'elementor/widgets/register', 'lia_core_register_elementor_widgets' );

/**
 * Register Elementor Category
 */
function lia_core_register_elementor_category( $elements_manager ) {

    $elements_manager->add_category(
        'lia-elements',
        [
            'title' => __( 'Lia Elements', 'lia-core' ),
            'icon'  => 'fa fa-plug',
        ]
    );
}
add_action( 'elementor/elements/categories_registered', 'lia_core_register_elementor_category' );
