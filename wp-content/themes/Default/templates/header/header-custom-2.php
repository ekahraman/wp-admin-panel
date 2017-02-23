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
    <?php get_template_part( 'templates/navigation/navigation', 'top' ); ?>
<?php endif; ?>
