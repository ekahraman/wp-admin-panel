<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( is_sticky() && is_home() ) :
            echo '<i class="dashicons dashicons-format-image" aria-hidden="true"></i>';
		endif;
	?>
	<header class="entry-header">
		<?php
			if ( 'post' === get_post_type() ) :
				echo '<section class="entry-meta">';
					if ( is_single() ) :
						omstema_posted_on();
					else :
						echo omstema_time_link();
						omstema_edit_link();
					endif;
				echo '</section>';
			endif;

			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header>

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<section class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'omstema-featured-image' ); ?>
			</a>
		</section>
	<?php endif; ?>

	<section class="entry-content">

		<?php if ( is_single() || '' === get_the_post_thumbnail() ) :

			// Only show content if is a single post, or if there's no featured image.
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'omstema' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<section class="page-links">' . __( 'Pages:', 'omstema' ),
				'after'       => '</section>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );

		endif; ?>

	</section>

	<?php if ( is_single() ) : ?>
		<?php omstema_entry_footer(); ?>
	<?php endif; ?>

</article>
