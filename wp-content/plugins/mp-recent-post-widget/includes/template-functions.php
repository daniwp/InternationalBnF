<?php

	defined( 'ABSPATH' ) or die( 'Keep Quit' );

	function mp_rpw_locate_template( $template_name ) {

		$template_path = apply_filters( 'mp_rpw_template_dir', 'mp-widgets' );
		$default_path  = apply_filters( 'mp_rpw_template_path', untrailingslashit( MP_RPW_PLUGIN_DIR ) . '/templates/' );

		// Look within passed path within the theme - this is priority.
		$template = locate_template(
			array(
				trailingslashit( $template_path ) . $template_name,
				'mp-widget-template-' . $template_name
			)
		);

		// Get default template
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}

		// Return what we found.
		return apply_filters( 'mp_rpw_locate_template', $template, $template_name, $template_path );
	}


	/***
	 * Get Template
	 *
	 * @param       $template_name
	 * @param array $template_args
	 *
	 * @usages:
	 *        function mp_rpw_get_template( $attr, $contents = '' ) {
	 *            $attributes = shortcode_atts( array(
	 *            'editor_contents' => '',
	 *            'button' => '',
	 *            'image'  => ''
	 *            ), $attr );
	 *            ob_start();
	 *            mp_rpw_get_template( 'showcase.php', compact( 'attributes', 'contents' ) );
	 *
	 *            return ob_get_clean();
	 * }
	 */

	function mp_rpw_get_template( $template_name, $template_args = array() ) {

		$located = apply_filters( 'mp_rpw_get_template', mp_rpw_locate_template( $template_name ), $template_name );

		do_action( 'mp_rpw_before_get_template', $template_name, $template_args );

		extract( $template_args );
		include $located;

		do_action( 'mp_rpw_after_get_template', $template_name, $template_args );
	}
