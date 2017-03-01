<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'omstema-panel ' ); ?> >

	<?php if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'omstema-featured-image' );

		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );

		$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'omstema-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail_attributes[2] / $thumbnail_attributes[1] * 100;
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
			</section
		</section>
	</section>
</article>
