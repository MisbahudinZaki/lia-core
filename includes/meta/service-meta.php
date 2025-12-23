<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Service Meta Box
 */
function lia_core_add_service_meta_box() {
    add_meta_box(
        'lia_service_settings',
        __( 'Service Settings', 'lia-core' ),
        'lia_core_render_service_meta_box',
        'service',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lia_core_add_service_meta_box' );

function lia_core_render_service_meta_box( $post ) {

    wp_nonce_field( 'lia_service_meta_nonce', 'lia_service_meta_nonce_field' );

    $highlight = get_post_meta( $post->ID, 'lia_service_highlight', true );
    ?>

    <p>
        <label>
            <input
                type="checkbox"
                name="lia_service_highlight"
                value="yes"
                <?php checked( $highlight, 'yes' ); ?>
            />
            <?php esc_html_e( 'Highlight this service', 'lia-core' ); ?>
        </label>
    </p>

    <?php
}

/**
 * Save Service Meta
 */
function lia_core_save_service_meta( $post_id ) {

    if (
        ! isset( $_POST['lia_service_meta_nonce_field'] ) ||
        ! wp_verify_nonce( $_POST['lia_service_meta_nonce_field'], 'lia_service_meta_nonce' )
    ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['lia_service_highlight'] ) ) {
        update_post_meta( $post_id, 'lia_service_highlight', 'yes' );
    } else {
        delete_post_meta( $post_id, 'lia_service_highlight' );
    }
}
add_action( 'save_post_service', 'lia_core_save_service_meta' );