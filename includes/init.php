<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Load helpers
 */
require_once LIA_CORE_PATH . 'includes/helpers.php';

/**
 * Load Custom Post Types
 */
require_once LIA_CORE_PATH . 'includes/post-types/service.php';
require_once LIA_CORE_PATH . 'includes/post-types/portfolio.php';
require_once LIA_CORE_PATH . 'includes/post-types/team.php';

/**
 * Load Custom Post Meta
 */

require_once LIA_CORE_PATH . 'includes/meta/service-meta.php';
require_once LIA_CORE_PATH . 'includes/meta/portfolio-meta.php';
require_once LIA_CORE_PATH . 'includes/meta/team-meta.php';

/**
 * Load admin settings
 */
if ( is_admin() ) {
    require_once LIA_CORE_PATH . 'includes/admin/settings-page.php';
}


/**
 * Plugin initialization
 */
function lia_core_init() {

    /**
     * Elementor dependency check
     */
    if ( defined( 'ELEMENTOR_VERSION' ) ) {
        require_once LIA_CORE_PATH . 'includes/elementor/elementor-init.php';
    }

}
add_action( 'init', 'lia_core_init' );

function lia_core_output_css_variables() {

    /**
     * Default colors (theme design default)
     */
    $defaults = [
        'primary_color'   => '#ffffff',              // Heading
        'secondary_color' => '#010001',              // Background
        'text_color'      => '#ebddff',              // Paragraph
        'accent_color'    => '#864fff',              // Link / Button
        'card_color'      => '#191919',              // Card
        'gradient_color'  => '#c34aff',              // Gradient accent
        'overlay_color'   => 'rgba(51,51,51,.5)',    // Overlay
    ];

    /**
     * Merge saved options with defaults
     */
    $options = wp_parse_args(
        get_option( 'lia_core_settings', [] ),
        $defaults
    );

    /**
     * Output CSS variables
     */
    echo '<style id="lia-core-variables"><!-- Lia Core Colors -->:root{';

    $map = [
        'primary_color'   => '--primary',
        'secondary_color' => '--secondary',
        'text_color'      => '--text-color',
        'accent_color'    => '--accent-color',
        'card_color'      => '--accent-color-2',
        'gradient_color'  => '--accent-color-3',
        'overlay_color'   => '--accent-overlay',
    ];

    foreach ( $map as $key => $css_var ) {
        echo $css_var . ':' . esc_attr( $options[ $key ] ) . ';';
    }

    /**
     * Hidden / internal variables (not exposed to admin yet)
     */
    echo '
        --accent-transparent: transparent;
        --accent-transparent-2: rgba(0,0,0,.5);
        --accent-color-4: #f96b00;
        --accent-color-5: #ff0000;
    ';

    echo '}</style>';
}
add_action( 'wp_head', 'lia_core_output_css_variables', 20 );