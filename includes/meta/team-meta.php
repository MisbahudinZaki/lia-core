<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Team Meta Box
 */
function lia_core_add_team_meta_box() {
    add_meta_box(
        'lia_team_details',
        __( 'Member Details', 'lia-core' ),
        'lia_core_render_team_meta_box',
        'team',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lia_core_add_team_meta_box' );

function lia_core_render_team_meta_box( $post ) {

    wp_nonce_field( 'lia_team_meta_nonce', 'lia_team_meta_nonce_field' );

    $position = get_post_meta( $post->ID, 'lia_team_position', true );
    $facebook = get_post_meta( $post->ID, 'lia_team_facebook', true );
    $twitter  = get_post_meta( $post->ID, 'lia_team_twitter', true );
    $linkedin = get_post_meta( $post->ID, 'lia_team_linkedin', true );
    ?>

    <table class="form-table">
        <tr>
            <th><label><?php esc_html_e( 'Position / Title', 'lia-core' ); ?></label></th>
            <td>
                <input type="text" name="lia_team_position" value="<?php echo esc_attr( $position ); ?>" class="regular-text">
            </td>
        </tr>

        <tr>
            <th><label>Facebook URL</label></th>
            <td>
                <input type="url" name="lia_team_facebook" value="<?php echo esc_url( $facebook ); ?>" class="regular-text">
            </td>
        </tr>

        <tr>
            <th><label>Twitter / X URL</label></th>
            <td>
                <input type="url" name="lia_team_twitter" value="<?php echo esc_url( $twitter ); ?>" class="regular-text">
            </td>
        </tr>

        <tr>
            <th><label>LinkedIn URL</label></th>
            <td>
                <input type="url" name="lia_team_linkedin" value="<?php echo esc_url( $linkedin ); ?>" class="regular-text">
            </td>
        </tr>
    </table>

    <?php
}

/**
 * Save Team Meta
 */
function lia_core_save_team_meta( $post_id ) {

    if (
        ! isset( $_POST['lia_team_meta_nonce_field'] ) ||
        ! wp_verify_nonce( $_POST['lia_team_meta_nonce_field'], 'lia_team_meta_nonce' )
    ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array(
        'lia_team_position' => 'sanitize_text_field',
        'lia_team_facebook' => 'esc_url_raw',
        'lia_team_twitter'  => 'esc_url_raw',
        'lia_team_linkedin' => 'esc_url_raw',
    );

    foreach ( $fields as $key => $sanitize ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, call_user_func( $sanitize, $_POST[ $key ] ) );
        }
    }
}
add_action( 'save_post_team', 'lia_core_save_team_meta' );