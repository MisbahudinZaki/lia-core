<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render active header builder
 *
 * Called from theme header.php
 */
function lia_render_header_builder() {

	$active_header_id = get_option( 'lia_active_header' );

	// Safety checks
	if ( ! $active_header_id ) {
		return;
	}

	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		return;
	}

	// Ensure post exists & published
	if ( 'publish' !== get_post_status( $active_header_id ) ) {
		return;
	}

	echo '<div class="lia-header-builder">';

	echo \Elementor\Plugin::instance()->frontend
		->get_builder_content_for_display( $active_header_id, true );

	echo '</div>';
}