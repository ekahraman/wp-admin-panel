<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

/**
 * Prevent switching to Twenty Seventeen on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Twenty Seventeen 1.0
 */
function omstema_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'omstema_upgrade_notice' );
}
add_action( 'after_switch_theme', 'omstema_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Twenty Seventeen on WordPress versions prior to 4.7.
 *
 * @since Twenty Seventeen 1.0
 *
 * @global string $wp_version WordPress version.
 */
function omstema_upgrade_notice() {
	$message = sprintf( __( 'Twenty Seventeen requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'omstema' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Twenty Seventeen 1.0
 *
 * @global string $wp_version WordPress version.
 */
function omstema_customize() {
	wp_die( sprintf( __( 'Twenty Seventeen requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'omstema' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'omstema_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Twenty Seventeen 1.0
 *
 * @global string $wp_version WordPress version.
 */
function omstema_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Twenty Seventeen requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'omstema' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'omstema_preview' );
