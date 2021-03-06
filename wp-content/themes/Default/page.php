<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

get_header(); ?>

<?php if (is_active_sidebar( 'sidebar-1' ) ) {get_sidebar('left');} ?>

<main id="main" class="<?php sidebar_content_class(); ?> site-main" role="main">

    <?php
    while ( have_posts() ) : the_post();

        get_template_part( 'templates/page/content', 'page' );

        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile;
    ?>

</main>

<?php if (is_active_sidebar( 'sidebar-2' ) ) {get_sidebar('right');} ?>

<?php get_footer();
