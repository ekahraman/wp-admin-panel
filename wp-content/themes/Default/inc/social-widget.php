<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
// Creating the widget
class social_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
// Base ID of your widget
            'social_widget',

// Widget name will appear in UI
            __('Sosyal Iconlar', 'omstema'),

// Widget description
            array( 'description' => __( 'Oms Özel Widget İle Bunu Yapabilirsiniz.', 'omstema' ), )
        );
    }

// Creating widget front-end
// This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output
        $social_medias = get_options('social_media');
        if($social_medias) {
            echo '<ul class="social-network social-circle">';
            foreach($social_medias as $social_media) {
                echo '<li><a href="' . $social_media["sosyal_medya_link"] . '"> <i class="' .$social_media["social_media_links"].' fa-lg"></i></a><li>';
            }
            echo '</ul>';
        }
        echo $args['after_widget'];
    }

// Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'omstema' );
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class social_widget ends here

// Register and load the widget
function social_load_widget() {
    register_widget( 'social_widget' );
}
add_action( 'widgets_init', 'social_load_widget' );