<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( ! class_exists( 'MP_Recent_Post_Widget' ) ):

		class MP_Recent_Post_Widget extends WP_Widget {

			public function __construct() {

				$widget_ops = array(
					'classname'                   => 'mp-recent-post',
					'description'                 => esc_html__( 'Show recent posts with date, author and thumbnail', 'mp-recent-post-widget' ),
					'customize_selective_refresh' => TRUE,
				);
				parent::__construct( 'mp-recent-post', esc_html__( 'MP Recent Posts', 'mp-recent-post-widget' ), $widget_ops );


				if ( is_active_widget( FALSE, FALSE, $this->id_base ) ) {
					add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
				}

			}

			public function enqueue_scripts() {

				wp_register_style( 'mp-recent-post-widget', MP_RPW_PLUGIN_URL . 'assets/css/style.css' );

				wp_enqueue_style( 'mp-recent-post-widget' );
			}

			public function form_fields( $instance ) {

				$form_fields = array();

				$form_fields[ 'title' ] = sprintf( '<p><label for="%1$s">%2$s</label><input class="widefat" id="%1$s" name="%3$s" type="text" value="%4$s"></p>',
				                                   $this->get_field_id( 'title' ),
				                                   esc_html__( 'Title: ', 'mp-recent-post-widget' ),
				                                   $this->get_field_name( 'title' ),
				                                   esc_attr( $instance[ 'title' ] ) );

				$form_fields[ 'number' ] = sprintf( '<p><label for="%1$s">%2$s</label><input class="tiny-text" id="%1$s" name="%3$s" type="number" step="1" min="1" value="%4$s"></p>',
				                                    $this->get_field_id( 'number' ),
				                                    esc_html__( 'Number of posts to show: ', 'mp-recent-post-widget' ),
				                                    $this->get_field_name( 'number' ),
				                                    esc_attr( $instance[ 'number' ] ) );

				$form_fields[ 'word_limit' ] = sprintf( '<p><label for="%1$s">%2$s</label><input class="tiny-text" id="%1$s" name="%3$s" type="number" step="1" min="1" value="%4$s"></p>',
				                                        $this->get_field_id( 'word_limit' ),
				                                        esc_html__( 'Title word limit: ', 'mp-recent-post-widget' ),
				                                        $this->get_field_name( 'word_limit' ),
				                                        esc_attr( $instance[ 'word_limit' ] ) );


				$form_fields[ 'show_meta' ] = sprintf( '<p><input class="checkbox" type="checkbox" ' . checked( $instance[ 'show_meta' ], TRUE, FALSE ) . ' id="%1$s" name="%3$s"><label for="%1$s">%2$s</label></p>',
				                                       $this->get_field_id( 'show_meta' ),
				                                       esc_html__( 'Show post meta: ', 'mp-recent-post-widget' ),
				                                       $this->get_field_name( 'show_meta' ) );


				$form_fields[ 'show_thumbnail' ] = sprintf( '<p><input class="checkbox" type="checkbox" ' . checked( $instance[ 'show_thumbnail' ], TRUE, FALSE ) . ' id="%1$s" name="%3$s"><label for="%1$s">%2$s</label></p>',
				                                            $this->get_field_id( 'show_thumbnail' ),
				                                            esc_html__( 'Show thumbnail: ', 'mp-recent-post-widget' ),
				                                            $this->get_field_name( 'show_thumbnail' ) );

				return apply_filters( 'mp_recent_post_widget_form_fields', $form_fields, $instance );
			}

			public function form( $instance ) {

				$defaults = array(
					'title'          => '',
					'number'         => '5',
					'word_limit'     => '25',
					'show_meta'      => TRUE,
					'show_thumbnail' => TRUE
				);

				$instance = apply_filters( 'mp_recent_post_widget_form_data', wp_parse_args( (array) $instance, $defaults ) );

				?>

				<?php do_action( 'before_mp_recent_post_widget_form', $instance ) ?>

				<?php echo implode( '', $this->form_fields( $instance ) ) ?>

				<?php do_action( 'after_mp_recent_post_widget_form', $instance ) ?>

			<?php }

			public function update( $new_instance, $old_instance ) {

				$instance                     = array();
				$instance[ 'title' ]          = ( ! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
				$instance[ 'number' ]         = ( ! empty( $new_instance[ 'number' ] ) ) ? strip_tags( $new_instance[ 'number' ] ) : '5';
				$instance[ 'word_limit' ]     = ( ! empty( $new_instance[ 'word_limit' ] ) ) ? strip_tags( $new_instance[ 'word_limit' ] ) : '25';
				$instance[ 'show_meta' ]      = isset( $new_instance[ 'show_meta' ] ) ? TRUE : FALSE;
				$instance[ 'show_thumbnail' ] = isset( $new_instance[ 'show_thumbnail' ] ) ? TRUE : FALSE;

				return apply_filters( 'mp_recent_post_widget_update_data', $instance, $new_instance, $old_instance );
			}

			public function widget( $widget_args, $instance ) {

				if ( ! isset( $widget_args[ 'widget_id' ] ) ) {
					$widget_args[ 'widget_id' ] = $this->id;
				}

				echo $widget_args[ 'before_widget' ];

				$query_args = apply_filters( 'mp_recent_post_widget_query_args', array(
					'post_type'           => 'post',
					'posts_per_page'      => absint( $instance[ 'number' ] ),
					'post_status'         => 'publish',
					'no_found_rows'       => TRUE,
					'ignore_sticky_posts' => TRUE
				), $instance );

				mp_rpw_get_template( 'mp-recent-post-widget.php', compact( 'widget_args', 'query_args', 'instance' ) );

				echo $widget_args[ 'after_widget' ];
			}
		}

	endif;