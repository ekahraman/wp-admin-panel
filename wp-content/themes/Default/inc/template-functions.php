<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function omstema_body_classes($classes)
{
    // Add class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    // Add class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Add class on front page.
    if (is_front_page() && 'posts' !== get_option('show_on_front')) {
        $classes[] = 'omstema-front-page';
    }

    // Add a class if there is a custom header.
    if (has_header_image()) {
        $classes[] = 'has-header-image';
    }

    // Add class if sidebar is used.
    if (is_active_sidebar('sidebar-1') && !is_page()) {
        $classes[] = 'has-sidebar-1';
    }

    // Add class if sidebar is used.
    if (is_active_sidebar('sidebar-2') && !is_page()) {
        $classes[] = 'has-sidebar-2';
    }

    // Add class for one or two column page layouts.
    if (is_page() || is_archive()) {
        if ('one-column' === get_theme_mod('page_layout')) {
            $classes[] = 'page-one-column';
        } else {
            $classes[] = 'page-two-column';
        }
    }

    return $classes;
}

add_filter('body_class', 'omstema_body_classes');

add_action('wp_head', 'customization_css');
function customization_css()
{
    $response = '';
    $response .= body_background(false, true);
    $response .= content_class(false, true);
    $response .= layout_class(false, true);
    $response .= header_class(false, true);
    $response .= footer_class(false, true);
    $response .= menu_class(false, true);
    $response .= dropdown_class(false, true);
    $response .= font_class(false, true);

    echo "<style type=\"text/css\">" . $response . "</style>\n";
}

function layout_class($class = false, $style = false)
{
    $add_class = "";
    if ($class) {
        if (get_options('tema_duzeni')) {
            $add_class .= 'container';
        } else {
            $add_class .= 'container-fluid';
        }
        if (get_options('sablon_top_padding') || get_options('sablon_bottom_padding') || get_options('sablon_left_padding') || get_options('sablon_right_padding')) {
            $add_class .= ' layout-class';
        }
        echo $add_class;
    } elseif ($style) {
        $add_style = '';
        if (get_options('sablon_top_padding') || get_options('sablon_bottom_padding') || get_options('sablon_left_padding') || get_options('sablon_right_padding')) {
            if (get_options('sablon_top_padding')) {
                $add_style .= 'padding-top:' . get_options('sablon_top_padding') . 'px;';
            }
            if (get_options('sablon_bottom_padding')) {
                $add_style .= 'padding-bottom:' . get_options('sablon_bottom_padding') . 'px;';
            }
            if (get_options('sablon_left_padding')) {
                $add_style .= 'padding-left:' . get_options('sablon_left_padding') . 'px;';
            }
            if (get_options('sablon_right_padding')) {
                $add_style .= 'padding-right:' . get_options('sablon_right_padding') . 'px;';
            }
            return '.layout-class{' . $add_style . '}';
        }
    }
}

function header_class($class = false, $style = false)
{
    $add_class = "";
    if ($class) {
        if (get_options('header_duzeni')) {
            $add_class .= 'container';
        } else {
            $add_class .= 'container-fluid';
        }
        if (get_options('header_background_image') || get_options('header_background_color') || get_options('header_top_padding') || get_options('header_bottom_padding') || get_options('header_border_size') || get_options('header_border_color')) {
            $add_class .= ' header-class';
        }
        echo $add_class;
    } elseif ($style) {
        $add_style = "";
        $add_border_style = 'border-bottom:';
        if (get_options('header_background_image') || get_options('header_background_color') || get_options('header_top_padding') || get_options('header_bottom_padding') || get_options('header_border_size') || get_options('header_border_color') || get_options('header_border_on_off')) {
            if (get_options('header_background_image')) {
                $add_style .= 'background-image:url(\'' . get_options('header_background_image') . '\');';
            }
            if (get_options('header_background_color')) {
                $add_style .= 'background-color:' . get_options('header_background_color') . ';';
            }
            if (get_options('header_background_image')) {
                if (get_options('header_background_repeat')) {
                    $add_style .= 'background-repeat:' . get_options('header_background_repeat') . ';';
                }
                if (get_options('header_background_position')) {
                    $add_style .= 'background-position:' . get_options('header_background_position') . ';';
                }
                if (get_options('header_background_attachment')) {
                    $add_style .= 'background-attachment:' . get_options('header_background_attachment') . ';';
                }
                if (get_options('header_background_size')) {
                    $add_style .= 'background-size:' . get_options('header_background_size') . ';';
                }
            }
            if (get_options('header_top_padding')) {
                $add_style .= 'padding-top:' . get_options('header_top_padding') . 'px;';
            }
            if (get_options('header_bottom_padding')) {
                $add_style .= 'padding-bottom:' . get_options('header_bottom_padding') . 'px;';
            }
            if (get_options('header_border_size')) {
                $add_border_style .= get_options('header_border_size') . 'px';
            }
            if (get_options('header_border_style')) {
                $add_border_style .= ' ' . get_options('header_border_style');
            }
            if (get_options('header_border_color')) {
                $add_border_style .= ' ' . get_options('header_border_color') . ';';
            }
            return '.header-class{' . $add_style . $add_border_style . '}';
        }
    }
}

function footer_class($class = false, $style = false)
{
    $add_class = "";
    if ($class) {
        if (get_options('footer_duzeni')) {
            $add_class .= 'container';
        } else {
            $add_class .= 'container-fluid';
        }
        if (get_options('footer_background_image') || get_options('footer_background_color') || get_options('footer_padding_top') || get_options('footer_padding_bottom') || get_options('footer_padding_left') || get_options('footer_padding_right') || get_options('footer_border_size') || get_options('footer_border_color')) {
            $add_class .= ' footer-class';
        }
        echo $add_class;
    } elseif ($style) {
        $add_border_style = 'border-top:';
        $add_style = "";
        if (get_options('footer_background_image') || get_options('footer_background_color') || get_options('footer_padding_top') || get_options('footer_padding_bottom') || get_options('footer_padding_left') || get_options('footer_padding_right') || get_options('footer_border_size') || get_options('footer_border_color') || get_options('footer_border_on_off')) {
            if (get_options('footer_background_image')) {
                $add_style .= 'background-image:url(\'' . get_options('footer_background_image') . '\');';
            }
            if (get_options('footer_background_color')) {
                $add_style .= 'background-color:' . get_options('footer_background_color') . ';';
            }
            if (get_options('footer_background_image')) {
                if (get_options('footer_background_repeat')) {
                    $add_style .= 'background-repeat:' . get_options('footer_background_repeat') . ';';
                }
                if (get_options('footer_background_position')) {
                    $add_style .= 'background-position:' . get_options('footer_background_position') . ';';
                }
                if (get_options('footer_background_attachment')) {
                    $add_style .= 'background-attachment:' . get_options('footer_background_attachment') . ';';
                }
                if (get_options('footer_background_size')) {
                    $add_style .= 'background-size:' . get_options('footer_background_size') . ';';
                }
            }
            if (get_options('footer_padding_top')) {
                $add_style .= 'padding-top:' . get_options('footer_padding_top') . 'px;';
            }
            if (get_options('footer_padding_bottom')) {
                $add_style .= 'padding-bottom:' . get_options('footer_padding_bottom') . 'px;';
            }
            if (get_options('footer_padding_left')) {
                $add_style .= 'padding-left:' . get_options('footer_padding_left') . 'px;';
            }
            if (get_options('footer_padding_right')) {
                $add_style .= 'padding-right:' . get_options('footer_padding_right') . 'px;';
            }
            if (get_options('footer_border_size')) {
                $add_border_style .= get_options('footer_border_size') . 'px';
            }
            if (get_options('footer_border_style')) {
                $add_border_style .= ' ' . get_options('footer_border_style');
            }
            if (get_options('footer_border_color')) {
                $add_border_style .= ' ' . get_options('footer_border_color') . ';';
            }
            return '.footer-class{' . $add_style . $add_border_style . '}';
        }
    }
}

/**
 * @param bool $class
 * @param bool $style
 * @return string
 */
function menu_class ($class = false, $style = false)
{
    $add_class = "";


    if ($class) {
        if (get_options('menu_layout')) {
            $add_class .= 'container';
        } else {
            $add_class .= 'container-fluid';
        }
        if (
            get_options('menu_background_image') ||
            get_options('menu_background_color') ||
            get_options('menu_padding_top') ||
            get_options('menu_padding_bottom') ||
            get_options('menu_padding_left') ||
            get_options('menu_padding_right')
        ) {
            $add_class .= ' menu-class';
        }
        echo $add_class;
    }

    if ($style) {
        $add_style = "";
        if (
            get_options('menu_background_image') ||
            get_options('menu_background_color') ||
            get_options('menu_padding_top') ||
            get_options('menu_padding_bottom') ||
            get_options('menu_padding_left') ||
            get_options('menu_padding_right')
        ) {
            if (get_options('menu_background_image')) {
                $add_style .= 'background-image:url(\'' . get_options('menu_background_image') . '\');';
            }
            if (get_options('menu_background_color')) {
                $add_style .= 'background-color:' . get_options('menu_background_color') . ';';
            }
            if (get_options('menu_background_image')) {
                if (get_options('menu_background_repeat')) {
                    $add_style .= 'background-repeat:' . get_options('menu_background_repeat') . ';';
                }
                if (get_options('menu_background_position')) {
                    $add_style .= 'background-position:' . get_options('menu_background_position') . ';';
                }
                if (get_options('menu_background_attachment')) {
                    $add_style .= 'background-attachment:' . get_options('menu_background_attachment') . ';';
                }
                if (get_options('menu_background_size')) {
                    $add_style .= 'background-size:' . get_options('menu_background_size') . ';';
                }
            }
            if (get_options('menu_padding_top')) {
                $add_style .= 'padding-top:' . get_options('menu_padding_top') . 'px;';
            }
            if (get_options('menu_padding_bottom')) {
                $add_style .= 'padding-bottom:' . get_options('menu_padding_bottom') . 'px;';
            }
            if (get_options('menu_padding_left')) {
                $add_style .= 'padding-left:' . get_options('menu_padding_left') . 'px;';
            }
            if (get_options('footer_padding_right')) {
                $add_style .= 'padding-right:' . get_options('menu_padding_right') . 'px;';
            }
            return '.menu-class{' . $add_style . '}';
        }
    }
}

/**
 * @param bool $class
 * @param bool $style
 * @return string
 */
function dropdown_class ($class = false, $style = false)
{
    $add_class = "dropdown_class";

    if ($style) {
        $add_style = "";
            if (get_options('menu_dropdown_background_hover_color')) {
                $add_style .= 'background-color:' . get_options('menu_dropdown_background_hover_color') . ';';
            }
            if (get_options('menu_dropdown_background_color')) {
                $add_style .= 'background-color:' . get_options('menu_dropdown_background_color') . ';';
            }
            return '.dropdown_class{' . $add_style . '}';
        }
}

function font_class($class=false, $style=false) {
    $add_class = "font-class";

    if ($style) {
        $add_style = "";
        $field = get_options('font_sec', 'option');
        if ($field) {
            $add_style .= 'font-family:' . $field['font']  . ';';
        }
        return '.font-class{' . $add_style . '}';
    }
}
function sidebar_content_class()
{
    if (is_active_sidebar('sidebar-3')) {
        echo 'col-md-8';
    } else {
        echo 'col-md-9';
    }
}

function header_template()
{
    $class = 1;
    if (get_options('tema_sec')) {
        $class = get_options('tema_sec');
    }
    return 'custom-' . $class;
}

function body_background($class = false, $style = false)
{
    if ($class) {
        return false;
    } elseif ($style) {
        $child = '';
        if (get_options('sablon_background_image') || get_options('sablon_background_color')) {
            if (get_options('sablon_background_image')) {
                $child .= 'background-image:url(\'' . get_options('sablon_background_image') . '\');';
            }
            if (get_options('sablon_background_color')) {
                $child .= 'background-color:' . get_options('sablon_background_color') . ';';
            }
            if (get_options('sablon_background_repeat')) {
                $child .= 'background-repeat:' . get_options('sablon_background_repeat') . ';';
            }
            if (get_options('sablon_background_position')) {
                $child .= 'background-position:' . get_options('sablon_background_position') . ';';
            }
            if (get_options('sablon_background_attachment')) {
                $child .= 'background-attachment:' . get_options('sablon_background_attachment') . ';';
            }
            if (get_options('sablon_background_size')) {
                $child .= 'background-size:' . get_options('sablon_background_size') . ';';
            }
            return 'body{' . $child . '}';
        }
    }
}

function content_class($class = false, $style = false)
{
    if ($class) {
        echo ' content-class';
    } elseif ($style) {
        $child = '';
        if (get_options('ust_bosluk') || get_options('alt_bosluk')) {
            if (get_options('ust_bosluk')) {
                $child .= 'padding-top:' . get_options('ust_bosluk') . 'px;';
            }
            if (get_options('alt_bosluk')) {
                $child .= 'padding-bottom:' . get_options('alt_bosluk') . 'px;';
            }
            return '.content-class{' . $child . '}';
        }
    }
}

function omstema_panel_count()
{

    $panel_count = 0;

    $num_sections = apply_filters('omstema_front_page_sections', 4);

    for ($i = 1; $i < (1 + $num_sections); $i++) {
        if (get_theme_mod('panel_' . $i)) {
            $panel_count++;
        }
    }

    return $panel_count;
}

function column_calc($istek)
{
    return floor(12 / $istek);
}

class Main_Walker_Nav_Menu extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $tabs = str_repeat("\t", $depth);
        $sub = '';
        if ($depth > 0) {
            $sub = ' sub-menu';
        }
        $output .= "\n{$tabs}<ul class=\"dropdown-menu" . $sub . " level-" . $depth . "\">\n";
        return;
    }

    function end_lvl(&$output, $depth = 0, $args = array())
    {
        if ($depth == 0) {

            $output .= '<!--.dropdown-->';
        }
        $tabs = str_repeat("\t", $depth);
        $output .= "\n{$tabs}</ul>\n";
        return;
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array)$item->classes;

        if ($item->hasChildren) {
            $classes[] = 'dropdown';
            if ($depth == 1) {
                $classes[] = 'dropdown-submenu';
            }
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = ' class="' . esc_attr($class_names) . '"';
        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $item_output = $args->before;

        if ($item->hasChildren) {
            $item_output .= '<a' . $attributes . ' class="dropdown-toggle" data-toggle="dropdown">';
        } else {
            $item_output .= '<a' . $attributes . '>';
        }

        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;

        if ($item->hasChildren) {
            $item_output .= ' <b class="caret"></b></a>';
        } else {
            $item_output .= '</a>';
        }

        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        return;
    }

    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= '</li>';
        return;
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

class Widget_Output_Filters
{

    private static $instance = null;

    public static function get_instance()
    {

        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct()
    {

        add_filter('dynamic_sidebar_params', array($this, 'filter_dynamic_sidebar_params'), 9);
    }

    public function filter_dynamic_sidebar_params($sidebar_params)
    {

        if (is_admin()) {
            return $sidebar_params;
        }

        global $wp_registered_widgets;
        $current_widget_id = $sidebar_params[0]['widget_id'];

        $wp_registered_widgets[$current_widget_id]['original_callback'] = $wp_registered_widgets[$current_widget_id]['callback'];
        $wp_registered_widgets[$current_widget_id]['callback'] = array($this, 'display_widget');

        return $sidebar_params;
    }

    public function display_widget()
    {

        global $wp_registered_widgets;
        $original_callback_params = func_get_args();

        $widget_id = $original_callback_params[0]['widget_id'];
        $original_callback = $wp_registered_widgets[$widget_id]['original_callback'];

        $wp_registered_widgets[$widget_id]['callback'] = $original_callback;

        $widget_id_base = $original_callback[0]->id_base;
        $sidebar_id = $original_callback_params[0]['id'];

        if (is_callable($original_callback)) {

            ob_start();
            call_user_func_array($original_callback, $original_callback_params);
            $widget_output = ob_get_clean();

            echo apply_filters('widget_output', $widget_output, $widget_id_base, $widget_id, $sidebar_id);
        }
    }
}

Widget_Output_Filters::get_instance();
function wp_bootstrap_widget_output_filters($widget_output, $widget_type, $widget_id, $sidebar_id)
{

    switch ($widget_type) {

        case 'categories' :
            $widget_output = str_replace('<ul>', '<ul class="list-group">', $widget_output);
            $widget_output = str_replace('<li class="cat-item cat-item-', '<li role="presentation" class="list-group-item cat-item cat-item-', $widget_output);
            $widget_output = str_replace('(', '<span class="badge cat-item-count"> ', $widget_output);
            $widget_output = str_replace(')', ' </span>', $widget_output);
            break;
        case 'calendar' :
            $widget_output = str_replace('calendar_wrap', 'calendar_wrap table-responsive', $widget_output);
            $widget_output = str_replace('<table id="wp-calendar', '<table class="table table-condensed" id="wp-calendar', $widget_output);
            break;
        case 'tag_cloud' :
            $regex = "/(<a[^>]+?)( style='font-size:.+pt;'>)([^<]+?)(<\/a>)/"; //clean up
            $replace_with = "$1><span class='label label-primary'>$3</span>$4";
            $widget_output = preg_replace($regex, $replace_with, $widget_output);
            break;
        case 'archives' :
            $widget_output = str_replace('<ul>', '<ul class="list-group">', $widget_output);
            $widget_output = str_replace('<li>', '<li role="presentation" class="list-group-item">', $widget_output);
            $widget_output = str_replace('(', '<span class="badge cat-item-count"> ', $widget_output);
            $widget_output = str_replace(')', ' </span>', $widget_output);
            break;
        case 'meta' :
            $widget_output = str_replace('<ul>', '<ul class="list-group">', $widget_output);
            $widget_output = str_replace('<li>', '<li role="presentation" class="list-group-item">', $widget_output);
            break;
        case 'recent-posts' :
            $widget_output = str_replace('<ul>', '<ul class="list-group">', $widget_output);
            $widget_output = str_replace('<li>', '<li role="presentation" class="list-group-item">', $widget_output);
            $widget_output = str_replace('class="post-date"', 'class="post-date text-muted small"', $widget_output);
            break;
        case 'recent-comments' :
            $widget_output = str_replace('<ul id="recentcomments">', '<ul id="recentcomments" class="list-group">', $widget_output);
            $widget_output = str_replace('<li class="recentcomments">', '<li role="presentation" class="recentcomments list-group-item">', $widget_output);
            break;
        case 'pages' :
            $widget_output = str_replace('<ul>', '<ul class="nav nav-stacked nav-pills">', $widget_output);
            break;
        case 'nav_menu' :
            $widget_output = str_replace(' class="menu"', ' class="menu nav nav-stacked nav-pills"', $widget_output);
            break;
        default:
            $widget_output = $widget_output;
    }
    $widget_output = str_replace('<div', '<section', $widget_output);
    $widget_output = str_replace('</div', '</section', $widget_output);
    return $widget_output;
}

add_filter('widget_output', 'wp_bootstrap_widget_output_filters', 10, 4);

/**
 * Checks to see if we're on the homepage or not.
 */
function omstema_is_frontpage()
{
    return (is_front_page() && !is_home());
}

// Comment Form
add_filter('comment_form_default_fields', 'bootstrap3_comment_form_fields');
function bootstrap3_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter();

    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    $html5 = current_theme_supports('html5', 'comment-form') ? 1 : 0;

    $fields = array(
        'author' => '<section class="form-group comment-form-author">' . '<label for="author">' . __('Name') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
            '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></section>',
        'email' => '<section class="form-group comment-form-email"><label for="email">' . __('Email') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
            '<input class="form-control" id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></section>',
        'url' => '<section class="form-group comment-form-url"><label for="url">' . __('Website') . '</label> ' .
            '<input class="form-control" id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></section>'
    );

    return $fields;
}

add_filter('comment_form_defaults', 'bootstrap3_comment_form');
function bootstrap3_comment_form($args)
{
    $args['comment_field'] = '<section class="form-group comment-form-comment">
            <label for="comment">' . _x('Comment', 'noun') . '</label> 
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </section>';
    $args['class_submit'] = 'btn btn-default';

    return $args;
}

//Comment Section
if (!function_exists('bootstrapwp_comment')) :
    function bootstrapwp_comment($comment, $args, $depth)
    {

        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                <p><?php _e('Pingback:', 'omstema'); ?><?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'omstema'), '<span class="ping-meta"><span class="edit-link">', '</span></span>'); ?></p>
                <?php
                break;
            default :
                ?>
            <li id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                    <section class="comment-author vcard pull-left">
                        <?php echo get_avatar($comment, 80); ?>
                    </section>
                    <section class="comment-details">
                        <header class="comment-meta">
                            <cite class="fn"><?php comment_author_link(); ?></cite>
                            <section class="comment-date">
                                <?php
                                printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                    esc_url(get_comment_link($comment->comment_ID)),
                                    get_comment_time('c'),
                                    sprintf(_x('%1$s, %2$s', '1: date, 2: time', 'omstema'), get_comment_date(), get_comment_time())
                                );
                                edit_comment_link(__(null, 'omstema'), ' <span class="edit-link">', '<span>'); ?>
                            </section>
                        </header>
                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'omstema'); ?></p>
                        <?php endif; ?>
                        <section class="comment-content">
                            <?php comment_text(); ?>
                        </section>
                        <section class="reply">
                            <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'omstema') . ' &rarr;', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </section>
                    </section>
                </article>
                <?php
                break;
        endswitch;
    }
endif;

// Boostrap Walker Nav
class wp_bootstrap_navwalker extends Walker_Nav_Menu
{
    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu multi-level dropdown_class\">\n";
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        /**
         * Dividers, Headers or Disabled
         * =============================
         * Determine whether the item is a Divider, Header, Disabled or regular
         * menu item. To prevent errors we use the strcasecmp() function to so a
         * comparison that is not case sensitive. The strcasecmp() function returns
         * a 0 if the strings are equal.
         */
        if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr($item->title);
        } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr($item->title) . '</a>';
        } else {
            $class_names = $value = '';
            $classes = empty($item->classes) ? array() : (array)$item->classes;
            $classes[] = 'menu-item-' . $item->ID;
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            if ($args->has_children)
                $class_names .= ' dropdown';
            if (in_array('current-menu-item', $classes))
                $class_names .= ' active';
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';
            $output .= $indent . '<li' . $id . $value . $class_names . '>';
            $atts = array();
            $atts['title'] = !empty($item->title) ? $item->title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
            // If item has_children add atts to a.
            if ($args->has_children && $depth === 0) {
                $atts['href'] = '#';
                $atts['data-toggle'] = 'dropdown';
                $atts['class'] = 'dropdown-toggle';
                $atts['aria-haspopup'] = 'true';
            } else {
                $atts['href'] = !empty($item->url) ? $item->url : '';
            }
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);
            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            $item_output = $args->before;
            /*
             * Glyphicons
             * ===========
             * Since the the menu item is NOT a Divider or Header we check the see
             * if there is a value in the attr_title property. If the attr_title
             * property is NOT null we apply it as the class name for the glyphicon.
             */
            if (!empty($item->attr_title))
                $item_output .= '<a' . $attributes . '><span class="glyphicon ' . esc_attr($item->attr_title) . '"></span>&nbsp;';
            else
                $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= ($args->has_children && 0 === $depth) ? ' <span class="caret"></span></a>' : '</a>';
            $item_output .= $args->after;
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
    }

    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth.
     *
     * This method shouldn't be called directly, use the walk() method instead.
     *
     * @see Walker::start_el()
     * @since 2.5.0
     *
     * @param object $element Data object
     * @param array $children_elements List of elements to continue traversing.
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of current element.
     * @param array $args
     * @param string $output Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
        if (!$element)
            return;
        $id_field = $this->db_fields['id'];
        // Display this element.
        if (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function fallback($args)
    {
        if (current_user_can('manage_options')) {
            extract($args);
            $fb_output = null;
            if ($container) {
                $fb_output = '<' . $container;
                if ($container_id)
                    $fb_output .= ' id="' . $container_id . '"';
                if ($container_class)
                    $fb_output .= ' class="' . $container_class . '"';
                $fb_output .= '>';
            }
            $fb_output .= '<ul';
            if ($menu_id)
                $fb_output .= ' id="' . $menu_id . '"';
            if ($menu_class)
                $fb_output .= ' class="' . $menu_class . '"';
            $fb_output .= '>';
            $fb_output .= '<li><a href="' . admin_url('nav-menus.php') . '">' . __('Add a menu', 'wp-bootstrap-navwalker') . '</a></li>';
            $fb_output .= '</ul>';
            if ($container)
                $fb_output .= '</' . $container . '>';
            echo $fb_output;
        }
    }
}

function cc_the_post_navigation()
{
    echo cc_get_post_navigation($args = array());
}

function cc_get_post_navigation($args = array())
{
    $args = wp_parse_args($args, array(
        'prev_text' => '<span class="screen-reader-text">' . __('Previous Post', 'omstema') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Previous', 'omstema') . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"></span>%title</span>',
        'next_text' => '<span class="screen-reader-text">' . __('Next Post', 'omstema') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Next', 'omstema') . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper"></span></span>',
        'in_same_term' => false,
        'excluded_terms' => '',
        'taxonomy' => 'category',
        'screen_reader_text' => __('Post navigation'),
    ));

    $navigation = '';

    $previous = get_previous_post_link(
        '<li class="previous">%link</li>',
        $args['prev_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );

    $next = get_next_post_link(
        '<li class="next">%link</li>',
        $args['next_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );

    // Only add markup if there's somewhere to navigate to.
    if ($previous || $next) {
        $navigation = _cc_navigation_markup($previous . $next, 'post-navigation', $args['screen_reader_text']);
    }

    return $navigation;
}

function _cc_navigation_markup($links, $class = 'posts-navigation', $screen_reader_text = '')
{
    if (empty($screen_reader_text)) {
        $screen_reader_text = __('Posts navigation');
    }

    $template = '
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<ul class="pager">%3$s</ul>
	</nav>';

    /**
     * Filters the navigation markup template.
     *
     * Note: The filtered template HTML must contain specifiers for the navigation
     * class (%1$s), the screen-reader-text value (%2$s), and placement of the
     * navigation links (%3$s):
     *
     *     <nav class="navigation %1$s" role="navigation">
     *         <h2 class="screen-reader-text">%2$s</h2>
     *         <div class="nav-links">%3$s</div>
     *     </nav>
     *
     * @since 4.4.0
     *
     * @param string $template The default template.
     * @param string $class The class passed by the calling function.
     * @return string Navigation template.
     */
    $template = apply_filters('navigation_markup_template', $template, $class);

    return sprintf($template, sanitize_html_class($class), esc_html($screen_reader_text), $links);
}

function my_comment_form_before()
{
    ob_start();
}

add_action('comment_form_before', 'my_comment_form_before');

function my_comment_form_after()
{
    $html = ob_get_clean();
    $html = preg_replace(
        '/div/',
        'section',
        $html
    );
    echo $html;
}
