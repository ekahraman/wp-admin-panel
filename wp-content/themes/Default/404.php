<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

get_header(); ?>

<?php if (is_active_sidebar( 'sidebar-1' ) ) {get_sidebar('left');} ?>

<main id="main" class="<?php sidebar_content_class(); ?> site-main" role="main">

    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'omstema' ); ?></h1>
        </header>
        <section class="page-content">
            <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'omstema' ); ?></p>

            <?php get_search_form(); ?>

        </section>
    </section>
</main>

<?php if (is_active_sidebar( 'sidebar-2' ) ) {get_sidebar('right');} ?>

<?php get_footer();
