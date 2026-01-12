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
require_once LIA_CORE_PATH . 'includes/post-types/header.php';
require_once LIA_CORE_PATH . 'includes/post-types/footer.php';
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
 * Load render settings
 */

require_once LIA_CORE_PATH . 'includes/render/header.php';

/**
 * Load admin settings
 */
if ( is_admin() ) {
    require_once LIA_CORE_PATH . 'includes/admin/settings-page.php';
}

/**
 * Plugin initialization
 */
add_action( 'elementor/init', function() {
    require_once LIA_CORE_PATH . 'includes/elementor/elementor-init.php';
});

function lia_core_output_css_variables() {

    if ( ! get_option( 'lia_core_settings' ) ) {
        return;
    }

    if ( ! function_exists( 'lia_core_get_default_colors' ) ) {
        return;
    }

    $defaults = lia_core_get_default_colors();

    $options = wp_parse_args(
        get_option( 'lia_core_settings', [] ),
        $defaults
    );

    $map = [
        'primary_color'   => '--primary',
        'secondary_color' => '--secondary',
        'text_color'      => '--text-color',
        'accent_color'    => '--accent-color',
        'card_color'      => '--accent-color-2',
        'gradient_color'  => '--accent-color-3',
        'overlay_color'   => '--accent-transparent-2',
    ];

    ob_start();
    ?>
    <style id="lia-core-variables">
        :root {
            <?php foreach ( $map as $key => $css_var ) : ?>
                <?php echo esc_html( $css_var ); ?>: <?php echo esc_html( $options[ $key ] ); ?>;
            <?php endforeach; ?>

            /* Internal / reserved variables */
            --accent-transparent: transparent;
            --accent-color-4: #f96b00;
            --accent-color-5: #ff0000;
        }
    </style>
    <?php
    echo ob_get_clean();
}
add_action( 'wp_head', 'lia_core_output_css_variables', 20 );
