<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

function omstema_setup() {

	load_theme_textdomain( 'omstema' , get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_image_size( 'omstema-featured-image', 2000, 1200, true );

	add_image_size( 'omstema-thumbnail-avatar', 100, 100, true );

	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'omstema' ),
		'social' => __( 'Social Links Menu', 'omstema' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	add_theme_support( 'customize-selective-refresh-widgets' );

}
add_action( 'after_setup_theme', 'omstema_setup' );

function omstema_widgets_init() {
    if(get_options('sidebar_column')) {$sidebar = get_options('sidebar_column');} else {$sidebar = 1;}
    for($loop = 1; $loop <= $sidebar; $loop++ ) {
       if( $loop == 1 ) {$turn='Left';} else {$turn='Right';}
        register_sidebar( array(
            'name'          => __( 'Sidebar', 'omstema' ).' '.__( $turn, 'omstema' ),
            'id'            => 'sidebar-'.$loop,
            'description'   => __( 'Add widgets here to appear in your sidebar.', 'omstema' ),
            'before_widget' => '<section id="%1$s" class="widget sidebar-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<section class="panel-heading"><h3 class="panel-title widget-title">',
            'after_title'   => '</h3></section>',
        ) );
    }

    if(get_options('footer_column')) {$footer_column = get_options('footer_column');} else {$footer_column = 4;}
    for($loop = 1; $loop <= $footer_column; $loop++ ) {
        register_sidebar( array(
            'name'          => __( 'Footer', 'omstema' ).' '.$loop,
            'id'            => 'footer-'.$loop,
            'description'   => __( 'Add widgets here to appear in your sidebar.', 'omstema' ),
            'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<section class="panel-heading"><h3 class="panel-title widget-title">',
            'after_title'   => '</h3></section>',
        ) );
    }

    if(get_options('header_top_widget_number')) {$header_top_column = get_options('header_top_widget_number');} else {$header_top_column = 3;}
    for($loop = 1; $loop <= $header_top_column; $loop++ ) {
        register_sidebar( array(
            'name'          => __( 'Header Top', 'omstema' ).' '.$loop,
            'id'            => 'header-top-'.$loop,
            'description'   => __( 'Add widgets here to appear in your sidebar.', 'omstema' ),
            'before_widget' => '<section id="%1$s" class="widget header-top-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<section class="panel-heading"><h3 class="panel-title widget-title">',
            'after_title'   => '</h3></section>',
        ) );
    }
  /*
    if( have_rows('custom_register_sidebar') ):
        while( have_rows('custom_register_sidebar') ): the_row();
            register_sidebar( array(
                'name'          => get_sub_field('widget_name'),
                'id'            => get_sub_field('widget_id'),
                'description'   => get_sub_field('widget_desc'),
                'before_widget' => get_sub_field('widget_before'),
                'after_widget'  => get_sub_field('widget_after'),
                'before_title'  => get_sub_field('widget_title_before'),
                'after_title'   => get_sub_field('widget_title_after'),
            ) );
        endwhile;
    endif;
  */
}
add_action( 'widgets_init', 'omstema_widgets_init' );

add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'emlak',
        array(
            'labels' => array(
                'name' => _x( 'Sabit Yaz&#305;', 'sabit_yazi' ),
                'singular_name' => _x( 'Sabit Yaz&#305;', 'sabit_yazi' ),
                'add_new' => _x( 'Sabit Yaz&#305; Ekle', 'sabit_yazi' ),
                'add_new_item' => _x( 'Yeni Sabit Yaz&#305; Ekle', 'sabit_yazi' ),
                'edit_item' => _x( 'Sabit Yaz&#305;y&#305; D&#252;zenle', 'sabit_yazi' ),
                'new_item' => _x( 'Yeni Sabit Yaz&#305;', 'sabit_yazi' ),
                'view_item' => _x( 'Sabit Yaz&#305;y&#305; G&#246;r&#252;nt&#252;le', 'sabit_yazi' ),
                'search_items' => _x( 'Sabit Yaz&#305; Ara', 'sabit_yazi' ),
                'not_found' => _x( 'Sabit Yaz&#305; Bulunamad&#305;', 'sabit_yazi' ),
                'not_found_in_trash' => _x( '&#199;&#246;p Kutusunu Bo&#351;alt', 'sabit_yazi' ),
                'parent_item_colon' => _x( 'Sabit Konu Hiyerar&#351;isi:', 'sabit_yazi' ),
                'menu_name' => _x( 'Sabit Yaz&#305;', 'sabit_yazi' )
            ),
            'hierarchical' => true,
            'description' => 'Sabit Yazı',
            'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
            'taxonomies' => array( 'category', 'post_tag', 'page-category' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        )
    );
}
function omstema_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'omstema' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'omstema_excerpt_more' );

function omstema_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'omstema_javascript_detection', 0 );

function add_async( $tag, $handle ) {
    if(stripos($handle, 'async') !== FALSE){
        return preg_replace( '/(><\/[a-zA-Z][^0-9](.*)>)$/', ' async=\'async\'$1 ', $tag );
    } elseif(stripos($handle, 'defer') !== FALSE) {
        return preg_replace( '/(><\/[a-zA-Z][^0-9](.*)>)$/', ' defer=\'defer\'$1 ', $tag );
    } else {
        return $tag;
    }
}
add_action( 'script_loader_tag', 'add_async', 10, 2 );

function add_jquery_async ( $url ) {
    if(stripos($url, 'jquery.js') !== FALSE) {
        return "$url' async='async";
    } elseif(stripos($url, 'jquery-migrate.min.js') !== FALSE) {
        return "$url' defer='defer";
    } elseif(stripos($url, 'wp-embed') !== FALSE) {
        return "$url' async='async";
    } else {
        return $url;
    }
}
add_filter( 'clean_url', 'add_jquery_async', 11, 1 );

function omstema_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'omstema_pingback_header' );

function disable_wp_emojicons() {

    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // filter to remove TinyMCE emojis
    add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
    add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'disable_wp_emojicons' );
function disable_emojicons_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

add_action('wp_head', 'css');
function css()
{
    $request = wp_remote_get(get_stylesheet_uri());
    $response = wp_remote_retrieve_body( $request );
    echo "<style type=\"text/css\">".$response."</style>\n";
}

function omstema_scripts() {

	wp_enqueue_style( 'omstema-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'omstema-style' ), null);
	wp_style_add_data( 'omstema-ie8', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), null );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'boostrap-async', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'omstema_scripts' );

function _remove_script_version( $src ){
    $parts = explode( '?ver', $src );
    return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

function omstema_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'omstema_content_image_sizes_attr', 10, 2 );

function omstema_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'omstema_header_image_tag', 10, 3 );

function omstema_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'omstema_post_thumbnail_sizes_attr', 10, 3 );

function omstema_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'omstema_front_page_template' );

require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/arg-functions.php' );

require get_parent_theme_file_path( '/inc/custom-widget.php' );

require get_parent_theme_file_path( '/inc/social-widget.php' );

add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path( $path ) {
    $path = get_stylesheet_directory() . '/plugin/advanced-custom-fields-pro/';
    return $path;
}

add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri() . '/plugin/advanced-custom-fields-pro/';
    return $dir;
}

include_once( get_stylesheet_directory() . '/plugin/advanced-custom-fields-pro/acf.php' );

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> __( 'Oms Theme General Settings', 'omstema' ),
        'menu_title'	=> __( 'Oms Theme Panel', 'omstema' ),
        'menu_slug' 	=> __( 'oms-theme-general-settings', 'omstema' ),
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

}

require get_parent_theme_file_path( '/plugin/acf-google-font-selector-field/acf-google_font_selector.php' );


/*
class WP_HTML_Compression {
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    protected $html;
    public function __construct($html) {
        if (!empty($html)) {
            $this->parseHTML($html);
        }
    }
    public function __toString() {
        return $this->html;
    }
    protected function bottomComment($raw, $compressed) {
        $raw = strlen($raw);
        $compressed = strlen($compressed);
        $savings = ($raw-$compressed) / $raw * 100;
        $savings = round($savings, 2);
        return '<!-- HTML Minify | http://fastwp.de/snippets/html-minify/ | Größe reduziert um '.$savings.'% | Von '.$raw.' Bytes, auf '.$compressed.' Bytes -->';
    }
    protected function minifyHTML($html) {
        $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
        $overriding = false;
        $raw_tag = false;
        $html = '';
        foreach ($matches as $token) {
            $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
            $content = $token[0];
            if (is_null($tag)) {
                if ( !empty($token['script']) ) {
                    $strip = $this->compress_js;
                }
                else if ( !empty($token['style']) ) {
                    $strip = $this->compress_css;
                }
                else if ($content == '<!--wp-html-compression no compression-->') {
                    $overriding = !$overriding;
                    continue;
                }
                else if ($this->remove_comments) {
                    if (!$overriding && $raw_tag != 'textarea') {
                        $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                    }
                }
            }
            else {
                if ($tag == 'pre' || $tag == 'textarea') {
                    $raw_tag = $tag;
                }
                else if ($tag == '/pre' || $tag == '/textarea') {
                    $raw_tag = false;
                }
                else {
                    if ($raw_tag || $overriding) {
                        $strip = false;
                    }
                    else {
                        $strip = true;
                        $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
                        $content = str_replace(' />', '/>', $content);
                    }
                }
            }
            if ($strip) {
                $content = $this->removeWhiteSpace($content);
            }
            $html .= $content;
        }
        return $html;
    }
    public function parseHTML($html) {
        $this->html = $this->minifyHTML($html);
        if ($this->info_comment) {
            $this->html .= "\n" . $this->bottomComment($html, $this->html);
        }
    }
    protected function removeWhiteSpace($str) {
        $str = str_replace("\t", ' ', $str);
        $str = str_replace("\n",  '', $str);
        $str = str_replace("\r",  '', $str);
        while (stristr($str, '  ')) {
            $str = str_replace('  ', ' ', $str);
        }
        return $str;
    }
}
function wp_html_compression_finish($html) {
    return new WP_HTML_Compression($html);
}
function wp_html_compression_start() {
    ob_start('wp_html_compression_finish');
}
//after_setup_theme
add_action('', 'wp_html_compression_start');
*/
if(get_options('html_minify')) {
    class WP_HTML_Compression
    {
        // Settings
        protected $compress_css = true;
        protected $compress_js = true;
        protected $info_comment = true;
        protected $remove_comments = true;

        // Variables
        protected $html;

        public function __construct($html)
        {
            if (!empty($html)) {
                $this->parseHTML($html);
            }
        }

        public function __toString()
        {
            return $this->html;
        }

        protected function minifyHTML($html)
        {
            $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
            preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
            $overriding = false;
            $raw_tag = false;
            // Variable reused for output
            $html = '';
            foreach ($matches as $token) {

                $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
                $content = $token[0];

                if (is_null($tag)) {

                    if (!empty($token['script'])) {

                        $strip = $this->compress_js;

                    } else if (!empty($token['style'])) {

                        $strip = $this->compress_css;

                    } else if ($content == '<!--wp-html-compression no compression-->') {

                        $overriding = !$overriding;
                        // Don't print the comment
                        continue;

                    } else if ($this->remove_comments) {

                        if (!$overriding && $raw_tag != 'textarea') {

                            // Remove any HTML comments, except MSIE conditional comments
                            $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                        }
                    }

                } else {

                    if ($tag == 'pre' || $tag == 'textarea' || $tag == 'script') {

                        $raw_tag = $tag;

                    } else if ($tag == '/pre' || $tag == '/textarea' || $tag == '/script') {

                        $raw_tag = false;

                    } else {

                        if ($raw_tag || $overriding) {

                            $strip = false;

                        } else {

                            $strip = true;

                            // Remove any empty attributes, except:
                            // action, alt, content, src
                            $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);

                            // Remove any space before the end of self-closing XHTML tags
                            // JavaScript excluded
                            $content = str_replace(' />', '/>', $content);
                        }

                    }

                }

                if ($strip) {

                    $content = $this->removeWhiteSpace($content);
                }

                $html .= $content;
            }

            return $html;
        }

        public function parseHTML($html)
        {
            $this->html = $this->minifyHTML($html);
        }

        protected function removeWhiteSpace($str)
        {
            $str = str_replace("\t", ' ', $str);
            $str = str_replace("\n", '', $str);
            $str = str_replace("\r", '', $str);

            while (stristr($str, '  ')) {

                $str = str_replace('  ', ' ', $str);
            }

            return $str;
        }
    }

    function wp_html_compression_finish($html)
    {

        return new WP_HTML_Compression($html);
    }

    function wp_html_compression_start()
    {
        ob_start('wp_html_compression_finish');
    }

    add_action('after_setup_theme', 'wp_html_compression_start');
}
add_action('comment_form_after', 'my_comment_form_after');
