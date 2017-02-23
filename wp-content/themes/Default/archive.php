<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

get_header(); ?>

<?php if (is_active_sidebar( 'sidebar-1' ) ) {get_sidebar('left');} ?>

<main id="main" class="<?php sidebar_content_class(); ?> site-main" role="main">

    <?php if ( have_posts() ) : ?>
    <header class="page-header">
        <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="taxonomy-description">', '</div>' );
        ?>
    </header>
    <?php endif; ?>

    <?php
    if ( have_posts() ) : ?>
        <?php

        while ( have_posts() ) : the_post();

            get_template_part( 'templates/post/content', get_post_format() );

        endwhile;

        the_posts_pagination( array(
            'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'omstema' ) . '</span>',
            'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'omstema' ) . '</span>',
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'omstema' ) . ' </span>',
        ) );

    else :

        get_template_part( 'templates/post/content', 'none' );

    endif; ?>

</main>

<?php if (is_active_sidebar( 'sidebar-2' ) ) {get_sidebar('right');} ?>

<?php get_footer();
