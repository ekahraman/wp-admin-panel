<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?>
<nav id="site-navigation" class="navbar navbar-default" role="navigation" aria-label="<?php _e( 'Top Menu', 'omstema' ); ?>">
    <section class="container-fluid">
        <section class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"><?php _e( 'Menu', 'omstema' ); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </section>
        <section id="navbar" class="navbar-collapse collapse">
            <?php
            wp_nav_menu( array(
                    'menu'              => 'top',
                    'theme_location'    => 'top',
                    'depth'             => 2,
                    'container'         => 'section',
                    'container_class'   => 'collapse navbar-collapse',
                    'container_id'      => 'navbar',
                    'menu_class'        => 'nav navbar-nav',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker()
            ) ); ?>
        </section>
    </section>
</nav>
