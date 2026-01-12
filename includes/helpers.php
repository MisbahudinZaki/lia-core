<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get plugin option safely
 */
function lia_core_get_option( $key, $default = '' ) {
    $options = get_option( 'lia_core_settings', [] );
    return isset( $options[ $key ] ) ? $options[ $key ] : $default;
}

/**
 * Swiper register
 */

function lia_core_register_swiper_assets() {

    wp_register_style(
        'lia-swiper',
        LIA_CORE_URL . 'assets/css/swiper-bundle.min.css',
        [],
        '11.2.10'
    );

    wp_register_script(
        'lia-swiper',
        LIA_CORE_URL . 'assets/js/swiper-bundle.min.js',
        [],
        '11.2.10',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'lia_core_register_swiper_assets' );