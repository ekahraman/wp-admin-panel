<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<section class="entry-meta">
				<?php
					echo omstema_time_link();
					omstema_edit_link();
				?>
			</section>
		<?php elseif ( 'page' === get_post_type() && get_edit_post_link() ) : ?>
			<section class="entry-meta">
				<?php omstema_edit_link(); ?>
			</section>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>

	<section class="entry-summary">
		<?php the_excerpt(); ?>
	</section>
</article>
