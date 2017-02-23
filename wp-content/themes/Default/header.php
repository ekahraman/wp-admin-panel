<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="dns-prefetch" href="//fonts.googleapis.com/">
<link rel="dns-prefetch" href="//ajax.googleapis.com/">
<link rel="dns-prefetch" href="//fonts.gstatic.com/">
<link rel="dns-prefetch" href="//gratavar.com/">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<section id="site" class="<?php layout_class(true); ?>">
    <header id="site-header" class="<?php header_class(true); ?>" role="banner">
        <?php get_template_part( 'templates/header/header', header_template() ); ?>
    </header>
    <section id="content-wrap" class="row<?php content_class(true); ?>">


