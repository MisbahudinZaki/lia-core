<?php
/**
 * Plugin Name: Lia Core
 * Plugin URI:  #
 * Description: Core functionality for Lia - Digital Marketing Agency theme.
 * Version:     1.0.0
 * Author:      Creed Creatives
 * Author URI:  https://creedcreatives.net/
 * Text Domain: lia-core
 * Domain Path: 
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Plugin constants
 */
define( 'LIA_CORE_VERSION', '1.0.0' );
define( 'LIA_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'LIA_CORE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load textdomain
 */
function lia_core_load_textdomain() {
    load_plugin_textdomain(
        'lia-core',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages'
    );
}
add_action( 'plugins_loaded', 'lia_core_load_textdomain' );

/**
 * Init plugin
 */
require_once LIA_CORE_PATH . 'includes/init.php';
