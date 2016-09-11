<?php

	defined( 'ABSPATH' ) or die( 'Keep Quit' );

	$title = apply_filters( 'widget_title', trim( $instance[ 'title' ] ), $instance, $widget_args[ 'widget_id' ] );
	if ( ! empty( $title ) ) {
		echo $widget_args[ 'before_title' ] . $title . $widget_args[ 'after_title' ];
	}

?>

<div class="mp-recent-post-wrapper">
	<?php

		$the_query = new WP_Query( $query_args );

		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) :
				$the_query->the_post(); ?>

				<div class="mp-recent-post">

					<?php if ( $instance[ 'show_thumbnail' ] && has_post_thumbnail() ) : ?>
						<div class="mp-recent-post-thumbnail">
							<a class="post-thumbnail" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'mp_recent_post_widget_thumbnail' ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="mp-recent-post-elements">
						<?php if ( $instance[ 'show_meta' ] ) : ?>
							<div class="entry-meta">
								<ul class="list-inline">
									<li>
                                         <span class="post-date entry-date">
	                                         <a href="<?php the_permalink(); ?>"><?php the_date(); ?></a>
                                         </span>
									</li>
									<li>
                                        <span class="post-author">
                                            <?php esc_html_e( 'by', 'mp-recent-post-widget' ); ?><?php printf( '<a class="url fn n" href="%1$s"> %2$s </a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ) ?>
                                        </span>
									</li>
								</ul>
							</div> <!-- .entry-meta -->
						<?php endif; ?>

						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), absint( $instance[ 'word_limit' ] ) ); ?></a>
						</h3>
					</div> <!-- .recent-post-elements -->

				</div> <!-- .mp-recent-post -->

			<?php endwhile;
		else : ?>
			<p><?php esc_html_e( 'No Recent Post Found!', 'mp-recent-post-widget' ) ?></p>
		<?php endif;

		wp_reset_postdata();
	?>
</div> <!-- .mp-recent-post-wrapper -->