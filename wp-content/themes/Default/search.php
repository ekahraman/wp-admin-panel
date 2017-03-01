<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

get_header(); ?>

<?php if (is_active_sidebar( 'sidebar-1' ) ) {get_sidebar('left');} ?>

<main id="main" class="<?php sidebar_content_class(); ?> site-main" role="main">
	<header class="page-header">
		<?php if ( have_posts() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'omstema' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e( 'Nothing Found', 'omstema' ); ?></h1>
		<?php endif; ?>
	</header>

    <?php
    if ( have_posts() ) :

        while ( have_posts() ) : the_post();

            get_template_part( 'templates/post/content', 'excerpt' );

        endwhile;

        the_posts_pagination( array(
            'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'omstema' ) . '</span>',
            'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'omstema' ) . '</span>',
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'omstema' ) . ' </span>',
        ) );

    else : ?>

        <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'omstema' ); ?></p>
        <?php
            get_search_form();

    endif;
    ?>

</main>

<?php if (is_active_sidebar( 'sidebar-2' ) ) {get_sidebar('right');} ?>

<?php get_footer();
