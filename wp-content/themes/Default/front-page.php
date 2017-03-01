<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

get_header(); ?>

<?php if (is_active_sidebar( 'sidebar-1' ) ) {get_sidebar('left');} ?>

<main id="main" class="<?php sidebar_content_class(); ?> site-main" role="main">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            get_template_part( 'templates/page/content', 'front-page' );
        endwhile;
    else :
        get_template_part( 'templates/post/content', 'none' );
    endif; ?>

    <?php
    if ( 0 !== omstema_panel_count() || is_customize_preview() ) :

        $num_sections = apply_filters( 'omstema_front_page_sections', 4 );
        global $omstemacounter;

        for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
            $omstemacounter = $i;
            omstema_front_page_section( null, $i );
        }

endif;  ?>

</main>

<?php if (is_active_sidebar( 'sidebar-2' ) ) {get_sidebar('right');} ?>

<?php get_footer();
