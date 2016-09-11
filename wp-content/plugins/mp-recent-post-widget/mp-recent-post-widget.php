<?php
	/**
	 * Plugin Name:  MP Recent Post Widget
	 * Plugin URI:   https://wordpress.org/plugins/mp-recent-post-widget/
	 * Description:  Recent Blog Post Widget
	 * Version:      1.0.0
	 * Author:       MediumPixel
	 * Author URI:   https://mediumpixel.com
	 * License:      GPLv2.0+
	 * License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
	 *
	 * Text Domain:  mp-recent-post-widget
	 * Domain Path:  /languages/
	 */

	defined( 'ABSPATH' ) or die( 'Keep Quit' );


	if ( ! class_exists( 'MP_Recent_Post_Widget_Init' ) ):

		class MP_Recent_Post_Widget_Init {

			public function __construct() {
				$this->constants();
				$this->includes();
				$this->hooks();

				do_action( 'mp_recent_post_widget_loaded', $this );
			}

			public function constants() {
				define( 'MP_RPW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
				define( 'MP_RPW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
				define( 'MP_RPW_PLUGIN_DIRNAME', dirname( plugin_basename( __FILE__ ) ) );
				define( 'MP_RPW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
				define( 'MP_RPW_PLUGIN_FILE', __FILE__ );
			}

			public function includes() {
				include_once( 'includes/template-functions.php' );
				include_once( 'includes/class-mp-recent-post-widget-settings.php' );
				include_once( 'includes/class-mp-recent-post-widget.php' );
			}

			public function hooks() {
				add_action( 'after_setup_theme', array( $this, 'setup_environment' ) );
				add_action( 'init', array( $this, 'init' ), 0 );
				add_action( 'widgets_init', array( $this, 'register_widgets' ) );
			}

			public function register_widgets() {
				if ( class_exists( 'MP_Recent_Post_Widget' ) ) {
					register_widget( 'MP_Recent_Post_Widget' );
				}
			}

			public function init() {
				// Before init action.
				do_action( 'before_mp_recent_post_widget_init' );

				load_plugin_textdomain( 'mp-recent-post-widget', FALSE, MP_RPW_PLUGIN_DIRNAME . '/languages' );

				do_action( 'mp_recent_post_widget_init' );
			}

			public function setup_environment() {
				$size = get_option( 'mp_recent_post_widget_option', array(
					'width'  => '300',
					'height' => '200'
				) );

				$size[ 'width' ]  = isset( $size[ 'width' ] ) ? $size[ 'width' ] : '300';
				$size[ 'height' ] = isset( $size[ 'height' ] ) ? $size[ 'height' ] : '200';
				$size[ 'crop' ]   = isset( $size[ 'crop' ] ) ? TRUE : FALSE;

				$size = apply_filters( 'mp_recent_post_widget_thumbnail_size', $size );

				add_image_size( 'mp_recent_post_widget_thumbnail', $size[ 'width' ], $size[ 'height' ], $size[ 'crop' ] );
			}
		}

		new MP_Recent_Post_Widget_Init();

	endif;