<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Portfolio Meta Box
 */
function lia_core_add_portfolio_meta_box() {
    add_meta_box(
        'lia_portfolio_details',
        __( 'Project Details', 'lia-core' ),
        'lia_core_render_portfolio_meta_box',
        'portfolio',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lia_core_add_portfolio_meta_box' );


/**
 * Render Portfolio Meta Box
 */
function lia_core_render_portfolio_meta_box( $post ) {

    wp_nonce_field( 'lia_portfolio_meta_nonce', 'lia_portfolio_meta_nonce_field' );

    $client = get_post_meta( $post->ID, 'lia_portfolio_client', true );
    $date   = get_post_meta( $post->ID, 'lia_portfolio_date', true );
    ?>

    <table class="form-table">
        <tr>
            <th>
                <label for="lia_portfolio_client"><?php esc_html_e( 'Client Name', 'lia-core' ); ?></label>
            </th>
            <td>
                <input
                    type="text"
                    id="lia_portfolio_client"
                    name="lia_portfolio_client"
                    value="<?php echo esc_attr( $client ); ?>"
                    class="regular-text"
                />
            </td>
        </tr>

        <tr>
            <th>
                <label for="lia_portfolio_date"><?php esc_html_e( 'Project Date', 'lia-core' ); ?></label>
            </th>
            <td>
                <input
                    type="date"
                    id="lia_portfolio_date"
                    name="lia_portfolio_date"
                    value="<?php echo esc_attr( $date ); ?>"
                />
            </td>
        </tr>
    </table>

    <?php
}

/**
 * Save Portfolio Meta
 */
function lia_core_save_portfolio_meta( $post_id ) {

    // Nonce check
    if (
        ! isset( $_POST['lia_portfolio_meta_nonce_field'] ) ||
        ! wp_verify_nonce( $_POST['lia_portfolio_meta_nonce_field'], 'lia_portfolio_meta_nonce' )
    ) {
        return;
    }

    // Autosave check
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Permission check
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save Client Name
    if ( isset( $_POST['lia_portfolio_client'] ) ) {
        update_post_meta(
            $post_id,
            'lia_portfolio_client',
            sanitize_text_field( $_POST['lia_portfolio_client'] )
        );
    }

    // Save Project Date
    if ( isset( $_POST['lia_portfolio_date'] ) ) {
        update_post_meta(
            $post_id,
            'lia_portfolio_date',
            sanitize_text_field( $_POST['lia_portfolio_date'] )
        );
    }
}
add_action( 'save_post_portfolio', 'lia_core_save_portfolio_meta' );