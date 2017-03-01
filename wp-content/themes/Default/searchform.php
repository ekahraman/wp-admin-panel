<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search input-group" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'omstema' ); ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'omstema' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    <span class="input-group-btn">
	    <button type="submit" class="btn btn-info btn-lg"><i class="fa fa-search" aria-hidden="true"></i><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'omstema' ); ?></span></button>
    </span>
</form>
