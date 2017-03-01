<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
function get_options($arg) {
    if(get_field($arg,'option')) {
        return get_field($arg,'option');
    } else {
        return false;
    }
}
function the_options($arg) {
    if(get_field($arg,'option')) {
        echo get_field($arg,'option');
    } else {
        return false;
    }
}