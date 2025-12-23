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
