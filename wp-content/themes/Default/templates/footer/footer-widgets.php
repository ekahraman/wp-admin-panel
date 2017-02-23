<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?>
<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
<aside id="footer-widgets">
    <?php
    if(get_options('footer-column')) {$column = column_calc(get_options('footer-column'));$many = get_options('footer-column');}else{$column = column_calc(4);$many = false;}
    for($loop = 1; $loop <= $column + 1; $loop++) {
   $many = '';
    if($many == 5) {if($loop == 1) {$many5='col-md-offset-1';}}?>
    <section id="footer-widget-<?php echo $loop; ?>" class="col-md-<?php echo $column; ?> <?php echo $many5; ?>">
        <?php dynamic_sidebar( 'footer-'.$loop ); ?>
    </section>
    <?php } ?>
</aside>
<?php } ?>