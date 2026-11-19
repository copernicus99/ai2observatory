<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function twentyseventeen_body_classes( $classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'twentyseventeen-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'twentyseventeen-front-page';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
		$classes[] = 'has-sidebar';
	}

	// Add class for one or two column page layouts.
	if ( is_page() || is_archive() ) {
		if ( 'one-column' === get_theme_mod( 'page_layout' ) ) {
			$classes[] = 'page-one-column';
		} else {
			$classes[] = 'page-two-column';
		}
	}

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) {
		$classes[] = 'title-tagline-hidden';
	}

	// Get the colorscheme or the default if there isn't one.
	$colors = twentyseventeen_sanitize_colorscheme( get_theme_mod( 'colorscheme', 'light' ) );
	$classes[] = 'colors-' . $colors;

	return $classes;
}
add_filter( 'body_class', 'twentyseventeen_body_classes' );

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function twentyseventeen_panel_count() {

	$panel_count = 0;

	/**
	 * Filter number of front page sections in Twenty Seventeen.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $num_sections integer
	 */
	$num_sections = apply_filters( 'twentyseventeen_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		if ( get_theme_mod( 'panel_' . $i ) ) {
			$panel_count++;
		}
	}

	return $panel_count;
}

/**
 * Checks to see if we're on the homepage or not.
 */

 $args = array(
        'width'              => 1000,
        'height'             => 250,
        'flex-width'         => true,
        'flex-height'        => true,
    );
    add_theme_support( 'custom-header', $args );

    

function twentyseventeen_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

function the_ai2_observatory_logo(){ 
$custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
echo '<img src="'.$image[0].'" width="276" height="116" alt="" border="0">';
}


// Poster file coming from wsi server (see html).....how is that happening!!
function the_ai2_observatory_poster(){ 
if(get_header_image()){
	echo '<img id="posterz" class="poster" src="'.get_header_image().'" />';
}

}


// video upload option
class cc_widget_image extends WP_Widget {
        function cc_widget_image() {
            $widget_ops = array('classname' => 'cc_widget_image', 'description' => __( 'Select and show an image.', 'cc_language' ) );
            $this->WP_Widget('cc_widget_image', '' . __( 'Video Banner Widget', 'cc_language' ), $widget_ops);
        }

        function form($instance) {
            $instance = wp_parse_args( (array) $instance, $defaults );
            $title = $instance['title'];
            $image = $instance['image'];
            if(empty($image)){
            	$instance['image'] = 'http://localhost/wpinstagram/wp-content/themes/aiobservatory/assets/video/vid360.mp4#t=0,48';
            }
            $checkbox = $instance['checkbox'];
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'cc_language'); ?>:
                <input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" /></label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Video Url', 'cc_language'); ?>:
                <input id="<?php echo $this->get_field_id('image'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $instance['image']; ?>" /></label>
            </p>
     
            
            <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;          
                $instance['title'] = strip_tags($new_instance['title']); 
                $instance['image'] = $new_instance['image']; 
            return $instance;
        }

        function widget($args, $instance) {
            extract($args, EXTR_SKIP);

            $title = apply_filters('widget_title', empty($instance['title']) ? __('Image') : $instance['title'], $instance, $this->id_base);

            echo $before_widget;

            // display the widget title 
                if ( $instance['checkbox'] == 'true' ) {
                } else {
                    if ( $title )
                    echo $before_title . $title . $after_title;
                }

            // display the widget content 
                echo the_post_thumbnail(array(220,200));
                if(is_home()){
                echo '<video id="video-jsi" autoplay >
<source src="'.$instance['image'].'" type="video/mp4">  <!-- change FadeAudio() if end time changes -->
</video>';
} else {
	//echo '<div id="video-poster"> <img src="'.get_theme_file_uri('assets/img/bg/video-desktop4.jpg').'" alt=""> </div>';
}

        echo $after_widget;
        }
    }

    add_action( 'widgets_init', create_function('', 'return register_widget("cc_widget_image");') );