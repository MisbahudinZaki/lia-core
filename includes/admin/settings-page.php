<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Lia Settings menu
 */
function lia_core_add_settings_menu() {
    add_menu_page(
        __( 'Lia Settings', 'lia-core' ),
        __( 'Lia Settings', 'lia-core' ),
        'manage_options',
        'lia-settings',
        'lia_core_render_settings_page',
        'dashicons-admin-customizer',
        61
    );
}
add_action( 'admin_menu', 'lia_core_add_settings_menu' );

/**
 * Register settings
 */
function lia_core_register_settings() {

    register_setting(
        'lia_core_settings_group',
        'lia_core_settings',
        'lia_core_sanitize_settings'
    );

    add_settings_section(
        'lia_core_branding_section',
        __( 'Branding Colors', 'lia-core' ),
        '__return_false',
        'lia-settings'
    );

    $fields = [
        'primary_color'   => 'Primary Color',
        'secondary_color' => 'Secondary Color',
        'text_color'      => 'Text Color',
        'accent_color'    => 'Accent Color',
        'card_color'      => 'Card Background Color',
        'gradient_color'  => 'Gradient Accent Color',
        'overlay_color'   => 'Overlay Color',
    ];

    foreach ( $fields as $key => $label ) {
        add_settings_field(
            $key,
            __( $label, 'lia-core' ),
            'lia_core_color_field_callback',
            'lia-settings',
            'lia_core_branding_section',
            [
                'key' => $key,
            ]
        );
    }

}
add_action( 'admin_init', 'lia_core_register_settings' );

/**
 * Color default
 */

function lia_core_get_default_colors() {
    return [
        'primary_color'   => '#ffffff',
        'secondary_color' => '#010001',
        'text_color'      => '#ebddff',
        'accent_color'    => '#864fff',
        'card_color'      => '#191919',
        'gradient_color'  => '#c34aff',
        'overlay_color'   => 'rgba(51,51,51,.5)',
    ];
}


/**
 * Color field callback
 */
function lia_core_color_field_callback( $args ) {

    $defaults = lia_core_get_default_colors();
    $options  = wp_parse_args(
        get_option( 'lia_core_settings', [] ),
        $defaults
    );

    $key   = $args['key'];
    $value = $options[ $key ];

    echo '<input 
        type="text"
        class="lia-color-field"
        name="lia_core_settings[' . esc_attr( $key ) . ']"
        value="' . esc_attr( $value ) . '"
        data-default-color="' . esc_attr( $defaults[ $key ] ) . '"
    />';
}

/**
 * Sanitize settings
 */
function lia_core_sanitize_settings( $input ) {
    $output = [];

    foreach ( $input as $key => $value ) {
        $output[ $key ] = sanitize_text_field( $value );
    }

    return $output;
}

/**
 * Render settings page
 */
function lia_core_render_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Lia Settings', 'lia-core' ); ?></h1>

        <form method="post" action="options.php">
            <?php
                settings_fields( 'lia_core_settings_group' );
                do_settings_sections( 'lia-settings' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Enqueue color picker
 */
function lia_core_admin_assets( $hook ) {
    if ( $hook !== 'toplevel_page_lia-settings' ) {
        return;
    }

    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script(
        'lia-core-admin',
        LIA_CORE_URL . 'assets/js/admin.js',
        [ 'wp-color-picker' ],
        LIA_CORE_VERSION,
        true
    );
}
add_action( 'admin_enqueue_scripts', 'lia_core_admin_assets' );
