<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php omstema_edit_link( get_the_ID() ); ?>
	</header>
	<section class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<section class="page-links">' . __( 'Pages:', 'omstema' ),
				'after'  => '</section>',
			) );
		?>
	</section>
</article>
