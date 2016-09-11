<?php

	defined( 'ABSPATH' ) or die( 'Keep Quit' );

	if ( ! class_exists( 'MP_Recent_Post_Widget_Settings' ) && is_admin() ):

		class MP_Recent_Post_Widget_Settings {

			private $mp_recent_post_widget_options;

			public function __construct() {
				add_action( 'admin_menu', array( $this, 'add_menu' ) );
				add_action( 'admin_init', array( $this, 'add_settings' ) );
				add_filter( 'plugin_action_links_' . MP_RPW_PLUGIN_BASENAME, array( $this, 'settings_link' ), 999 );

				$this->mp_recent_post_widget_options = get_option( 'mp_recent_post_widget_option', array(
					'width'  => '300',
					'height' => '200'
				) );
			}

			public function settings_link( $links ) {

				if ( is_plugin_active( MP_RPW_PLUGIN_BASENAME ) ) {
					$action_links = apply_filters( 'mp_rpw_action_links', array(
						'settings' => sprintf( '<a href="' . esc_url( apply_filters( 'mp_rpw_settings_url', admin_url( 'options-general.php?page=%1$s' ) ) ) . '" title="' . esc_attr__( 'Settings', 'mp-toolkit' ) . '">' . esc_html__( 'Settings', 'mp-toolkit' ) . '</a>', MP_RPW_PLUGIN_DIRNAME ),
					) );

					return array_merge( $action_links, $links );
				}

				return (array) $links;
			}

			public function add_menu() {

				add_submenu_page(
					'options-general.php',
					esc_html__( 'MP Recent Post Widget', 'mp-recent-post-widget' ), // page_title
					esc_html__( 'MP Recent Post', 'mp-recent-post-widget' ), // menu_title
					'manage_options', // capability
					MP_RPW_PLUGIN_DIRNAME, // menu_slug
					array( $this, 'add_form' ) // function
				);
			}

			public function add_form() {
				?>
				<div class="wrap">
					<h2><?php echo esc_html( get_admin_page_title() ) ?></h2>
					<p><?php esc_html_e( 'Recent post widget thumbnail size settings', 'mp-recent-post-widget' ) ?></p>
					<form method="post" action="options.php">
						<?php
							settings_fields( 'mp_recent_post_widget_option_group' );
							do_settings_sections( 'mp-recent-post-widget-admin' );
							submit_button();
						?>
					</form>
				</div>
			<?php }

			public function add_settings() {

				register_setting(
					'mp_recent_post_widget_option_group', // option_group
					'mp_recent_post_widget_option', // option_name
					array( $this, 'sanitize' ) // sanitize_callback
				);

				add_settings_section(
					'mp_recent_post_widget_setting_section', // id
					'Thumbnail Settings', // title
					array( $this, 'section_info' ), // callback
					'mp-recent-post-widget-admin' // page
				);

				add_settings_field(
					'thumbnail', // id
					'Thumbnail Size', // title
					array( $this, 'thumbnail_sizes_callback' ), // callback
					'mp-recent-post-widget-admin', // page
					'mp_recent_post_widget_setting_section' // section
				);
			}

			public function sanitize( $input ) {

				$sanitary_values = array();

				if ( isset( $input[ 'width' ] ) ) {
					$sanitary_values[ 'width' ] = sanitize_text_field( $input[ 'width' ] );
				}

				if ( isset( $input[ 'height' ] ) ) {
					$sanitary_values[ 'height' ] = sanitize_text_field( $input[ 'height' ] );
				}

				if ( isset( $input[ 'crop' ] ) ) {
					$sanitary_values[ 'crop' ] = $input[ 'crop' ];
				}

				return $sanitary_values;
			}

			public function section_info() {
				printf( __( 'After changing these settings you may need to <a target="_blank" href="%s">regenerate your thumbnails</a>.', 'mp-recent-post-widget' ), esc_url( 'https://wordpress.org/plugins/regenerate-thumbnails/' ) );
			}

			public function thumbnail_sizes_callback() {

				$disabled = has_filter( 'mp_recent_post_widget_thumbnail_size' );

				printf(
					'<input placeholder="width" class="small-text" min="1" type="number" name="mp_recent_post_widget_option[width]" id="width" value="%s" %s> &times; ',
					isset( $this->mp_recent_post_widget_options[ 'width' ] ) ? esc_attr( $this->mp_recent_post_widget_options[ 'width' ] ) : '',
					$disabled ? 'disabled' : ''
				);

				printf(
					'<input placeholder="height" class="small-text" min="1" type="number" name="mp_recent_post_widget_option[height]" id="height" value="%s" %s>px ',
					isset( $this->mp_recent_post_widget_options[ 'height' ] ) ? esc_attr( $this->mp_recent_post_widget_options[ 'height' ] ) : '',
					$disabled ? 'disabled' : ''
				);

				printf(
					'<input type="checkbox" name="mp_recent_post_widget_option[crop]" id="crop" value="1" %s %s> <label for="crop"> Hard Crop? </label>',
					( isset( $this->mp_recent_post_widget_options[ 'crop' ] ) && $this->mp_recent_post_widget_options[ 'crop' ] === '1' ) ? 'checked' : '',
					$disabled ? 'disabled' : ''
				);

				if ( $disabled ) {
					echo '<p><em>' . esc_html__( 'The settings of this image size have been disabled because its values are being overwritten by a filter.', 'mp-recent-post-widget' ) . '</em></p>';
				}
			}
		}

		new MP_Recent_Post_Widget_Settings();
	endif;