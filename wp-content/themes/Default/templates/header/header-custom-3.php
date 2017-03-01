<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?>
<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
    <aside id="aside-header-top-widgets" class="row">
        <?php
        if(get_options('header_top_widget_number')) {$column = column_calc(get_options('header_top_widget_number'));}
        for($loop = 1; $loop < $column; $loop++) { ?>
            <section id="header-top-widget-<?php echo $loop; ?>" class="col-md-<?php echo $column; ?>">
                <?php dynamic_sidebar( 'header-top-'.$loop ); ?>
            </section>
        <?php } ?>
    </aside>
<?php } ?>
<?php if ( has_nav_menu( 'top' ) ) : ?>
    <?php
// Do not allow directly accessing this file.
    if ( ! defined( 'ABSPATH' ) ) {
        exit( 'Direct script access denied.');
    }
    ?>
    <div class="row">
        <div class="col-md-6">
            <?php
            $logo           = get_options('logo_image');
            $mobile_logo    = get_options('mobile_logo');
            /**
             * Logo
             */
            if( !empty($logo) ): ?>
                <img class="hidden-xs" src="<?php echo $logo['url']; ?>" />
            <?php endif; ?>
            <?php
            /**
             * Mobile Logo
             */
            if( !empty($mobile_logo) ): ?>
                <img class="visible-xs" src="<?php echo $mobile_logo['url']; ?>" />
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control"  placeholder="Search" >
                        <span class="input-group-addon">
                        <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <nav id="site-navigation" class="navbar navbar-default <?php menu_class(true); ?>" role="navigation" aria-label="<?php _e( 'Top Menu', 'omstema' ); ?>">
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
    <?php
    /**
     * Custom CSS and JS
     */
    $custom_css = get_options('css_kodu');
    $custom_js = get_options('js_code');

    echo  '<style type="text/css">';
    echo  strip_tags($custom_css);
    echo '</style>';

    echo '<script type="text/javascript">';
    echo strip_tags($custom_js);
    echo '</script>';
    ?>
<?php endif; ?>
