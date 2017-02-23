<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

global $omstemacounter;

?>

<article id="panel<?php echo $omstemacounter; ?>" <?php post_class( 'omstema-panel ' ); ?> >

	<?php if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'omstema-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail[2] / $thumbnail[1] * 100;
		?>

		<section class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<section class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></section>
		</section>

	<?php endif; ?>

	<section class="panel-content">
		<section class="wrap">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

				<?php omstema_edit_link( get_the_ID() ); ?>

			</header>

			<section class="entry-content">
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'omstema' ),
						get_the_title()
					) );
				?>
			</section>

			<?php
			// Show recent blog posts if is blog posts page (Note that get_option returns a string, so we're casting the result as an int).
			if ( get_the_ID() === (int) get_option( 'page_for_posts' )  ) : ?>

				<?php // Show four most recent posts.
				$recent_posts = new WP_Query( array(
					'posts_per_page'      => 3,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				) );
				?>

		 		<?php if ( $recent_posts->have_posts() ) : ?>

					<section class="recent-posts">

						<?php
						while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
							get_template_part( 'templates/post/content', 'excerpt' );
						endwhile;
						wp_reset_postdata();
						?>
					</section>
				<?php endif; ?>
			<?php endif; ?>
		</section>
	</section>
</article>
