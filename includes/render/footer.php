<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render active footer builder
 *
 * Called from theme footer.php
 */
function lia_render_footer_builder(){
    $active_footer_id = get_option( 'lia_active_footer' );
    
    // Safety checks
	if ( ! $active_footer_id ) {
		return;
	}

	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		return;
	}

	// Ensure post exists & published
	if ( 'publish' !== get_post_status( $active_footer_id ) ) {
		return;
	}

    echo '<div class="lia-footer-builder">';

	echo \Elementor\Plugin::instance()->frontend
		->get_builder_content_for_display( $active_footer_id, true );

	echo '</div>';
}