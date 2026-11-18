<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'twentyseventeen' ),
		'social' => __( 'Social Links Menu', 'twentyseventeen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 276,
		'height'      => 116,
		'flex-width'  => true,
		'flex-height'    => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Home', 'twentyseventeen' ),
		'id'            => 'home-widget-sidebar',
		'description'   => __( 'Add widgets here to appear in your home menu.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	

	register_sidebar( array(
		'name'          => __( 'Subscriber', 'twentyseventeen' ),
		'id'            => 'home-subscriber-sidebar',
		'description'   => __( 'Add widgets here to appear in your newsletter menu.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Services', 'twentyseventeen' ),
		'id'            => 'home-services-sidebar',
		'description'   => __( 'Add widgets here to appear in your service menu.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Contact', 'twentyseventeen' ),
		'id'            => 'home-contact-sidebar',
		'description'   => __( 'Add widgets here to appear in your contact menu.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Video Banner', 'twentyseventeen' ),
		'id'            => 'home-header-sidebar',
		'description'   => __( 'Add widgets here to appear in your background video.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */




/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
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
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'twentyseventeen_front_page_template' );

/**
 * Implement the Custom Header feature.
 */
//require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/** theme setting **/
require get_parent_theme_file_path( '/inc/theme-setting.php' );

// custom post type
function dd($str){
echo '<pre>';
print_r($str);
}
// home widget 
class home_widget extends WP_Widget {
function __construct() {
parent::__construct(
// Base ID of your widget
'wpb_h_widget', 

// Widget name will appear in UI
__('Home Widget', 'wpb_h_widget_domain'), 

// Widget description
array( 'description' => __( 'Home Widget', 'wpb_h_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$home_title = apply_filters( 'home_title', $instance['home_title'] );
$home_description = apply_filters( 'home_description', $instance['home_description'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];


// This is where you run the code and display the output
echo '<div class="col-md-12">
              <!-- section title -->
              <div class="section-heading">
                <h1 class="section-title animated" 
                  data-animation="fadeInDown" 
                  data-delay="0">
                '.get_aio_style_title($home_title).'
                </h1>
                
                
                <p class="animated" 
                  data-animation="fadeInUp" 
                  data-delay="100">
                 '.$home_description .'</p>
              </div>
              <!-- /section title -->
              <!-- countdown -->
              <ul id="countdown" class="row">
                <li class="time-wrap col-xs-6 col-sm-3 animated" 
                  data-animation="fadeInUp" 
                  data-delay="200">
                  <span class="time days"></span>
                  <p class="unit days_ref shuffle" 
                  data-shuffle="7000"></p>
                </li>
                <li class="time-wrap col-xs-6 col-sm-3 animated" 
                  data-animation="fadeInUp" 
                  data-delay="300">
                  <span class="time hours"></span>
                  <p class="unit hours_ref shuffle" 
                  data-shuffle="11000"></p>
                </li>
                <li class="time-wrap col-xs-6 col-sm-3 animated" 
                  data-animation="fadeInUp" 
                  data-delay="400">
                  <span class="time minutes"></span>
                  <p class="unit minutes_ref shuffle" 
                  data-shuffle="13000"></p>
                </li>
                <li class="time-wrap col-xs-6 col-sm-3 animated" 
                  data-animation="fadeInUp" 
                  data-delay="500">
                  <span class="time seconds"></span>
                  <p class="unit seconds_ref shuffle" 
                  data-shuffle="8000"></p>
                </li>
              </ul>
              <!-- /countdown -->
              
              <div class="home-btn-wrapper">
               <!-- btn-white to make white....I liked it transparant -->
                <a class="btn btn-transparent animated" href="'.site_url('overview').'" title="observatory" 
                  data-animation="fadeInUp" 
                  data-delay="600">Observatory</a>
                  
                <a class="btn btn-transparent animated" href="#" title="newsletter" data-move-to="2"
                  data-animation="fadeInUp" 
                  data-delay="600">Newsletter</a>
                  
                <a class="btn btn-transparent animated" href="#" title="our services" data-move-to="3"
                  data-animation="fadeInUp" 
                  data-delay="600">Services</a>
              </div>
            </div>';
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'home_title' ] ) ) {
$home_title = $instance[ 'home_title' ];
}
else {
$home_title = __( 'APPLIED ASTRONOMY', 'wpb_h_widget_domain' );
}

if ( isset( $instance[ 'home_description' ] ) ) {
$home_description = $instance[ 'home_description' ];
}
else {
$home_description = __( 'unlimited horizons', 'wpb_h_widget_domain' );
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'home_title' ); ?>"><?php _e( 'Heading:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'home_title' ); ?>" name="<?php echo $this->get_field_name( 'home_title' ); ?>" type="text" value="<?php echo esc_attr( $home_title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'home_description' ); ?>"><?php _e( 'Description:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'home_description' ); ?>" name="<?php echo $this->get_field_name( 'home_description' ); ?>" type="text" value="<?php echo esc_attr( $home_description ); ?>" />
</p>

<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['home_title'] = ( ! empty( $new_instance['home_title'] ) ) ? strip_tags( $new_instance['home_title'] ) : '';
$instance['home_description'] = ( ! empty( $new_instance['home_description'] ) ) ? strip_tags( $new_instance['home_description'] ) : '';

return $instance;
}
} // home ends here

// contact widget 
class contact_widget extends WP_Widget {
function __construct() {
parent::__construct(
// Base ID of your widget
'wpb_c_widget', 

// Widget name will appear in UI
__('Contact Widget', 'wpb_c_widget_domain'), 

// Widget description
array( 'description' => __( 'Contact Widget', 'wpb_c_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$contact_title = apply_filters( 'contact_title', $instance['contact_title'] );
$contact_description = apply_filters( 'contact_description', $instance['contact_description'] );
// before and after widget arguments are defined by themes
//echo $args['before_widget'];


// This is where you run the code and display the output
echo '<div class="col-md-12">
              <!-- section title -->
              <div class="section-heading">
                <h2 class="section-title animated" 
                  data-animation="fadeInDown" 
                  data-delay="0">
                  '.get_aio_style_title($contact_title) .'</h2>
                <p class="animated" 
                  data-animation="fadeInUp" 
                  data-delay="100">
                  '.$contact_description.'</p>
              </div>
              <!-- /section title -->
            </div>
            <!-- contact form -->
            ';
//echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'contact_title' ] ) ) {
$contact_title = $instance[ 'contact_title' ];
}
else {
$contact_title = __( 'CONTACT US', 'wpb_c_widget_domain' );
}

if ( isset( $instance[ 'contact_description' ] ) ) {
$contact_description = $instance[ 'contact_description' ];
}
else {
$contact_description = __( 'any enquiries or say hello', 'wpb_c_widget_domain' );
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'contact_title' ); ?>"><?php _e( 'Heading:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'contact_title' ); ?>" name="<?php echo $this->get_field_name( 'contact_title' ); ?>" type="text" value="<?php echo esc_attr( $contact_title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'contact_description' ); ?>"><?php _e( 'Description:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'contact_description' ); ?>" name="<?php echo $this->get_field_name( 'contact_description' ); ?>" type="text" value="<?php echo esc_attr( $contact_description ); ?>" />
</p>

<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['contact_title'] = ( ! empty( $new_instance['contact_title'] ) ) ? strip_tags( $new_instance['contact_title'] ) : '';
$instance['contact_description'] = ( ! empty( $new_instance['contact_description'] ) ) ? strip_tags( $new_instance['contact_description'] ) : '';

return $instance;
}
} // home ends here

// service widget

class service_widget extends WP_Widget {
function __construct() {
parent::__construct(
// Base ID of your widget
'wpb_widget', 

// Widget name will appear in UI
__('Service Widget', 'wpb_widget_domain'), 

// Widget description
array( 'description' => __( 'Service Widget', 'wpb_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$service_title = apply_filters( 'service_title', $instance['service_title'] );
$service_description = apply_filters( 'service_description', $instance['service_description'] );
	// service 1
$service1_title = apply_filters( 'service1_title', $instance['service1_title'] );
$service1_description = apply_filters( 'service1_description', $instance['service1_description'] );
$service1_icon = apply_filters( 'service1_icon', $instance['service1_icon'] );
	// service 2
$service2_title = apply_filters( 'service2_title', $instance['service2_title'] );
$service2_description = apply_filters( 'service2_description', $instance['service2_description'] );
$service2_icon = apply_filters( 'service2_icon', $instance['service2_icon'] );
	// service 3
$service3_title = apply_filters( 'service3_title', $instance['service3_title'] );
$service3_description = apply_filters( 'service3_description', $instance['service3_description'] );
$service3_icon = apply_filters( 'service3_icon', $instance['service3_icon'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];


// This is where you run the code and display the output
echo '<div class="container">
          <div class="row">
            <div class="col-md-12">
              <!-- section title -->
              <div class="section-heading">
                <h2 class="section-title animated" 
                  data-animation="fadeInDown" 
                  data-delay="0">
                '.get_aio_style_title($service_title).'</h2>
                <p class="animated" 
                  data-animation="fadeInUp" 
                  data-delay="100">
                  '.$service_description.'</p>
              </div>
              <!-- /section title -->
            </div>
          </div>
          <div class="row">
            <!-- service list -->
            <div class="service-wrapper clearfix">
            
              <div class="service col-md-4 animated" 
                data-animation="fadeInUp" 
                data-delay="200">
                <i class="'.$service1_icon.'"></i> <!-- service icon -->
                <h3>'.$service1_title.'</h3> <!-- service title -->
                <p>'.$service1_description.'</p> <!-- service content -->
              </div>
              
              <div class="service col-md-4 animated" 
                data-animation="fadeInUp" 
                data-delay="300">
                <i class="'.$service2_icon.'"></i> <!-- service icon -->
                <h3>'.$service2_title.'</h3> <!-- service title -->
                <p>'.$service2_description.'</p> <!-- service content -->
              </div>
              
              <div class="service col-md-4 animated" 
                data-animation="fadeInUp" 
                data-delay="400">
                <i class="'.$service3_icon.'"></i> <!-- service icon -->
                <h3>'.$service3_title.'</h3> <!-- service title -->
                <p>'.$service3_description.'</p> <!-- service content -->
              </div>
            </div>
            <!-- /service list -->
          </div>
        </div>';
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'service_title' ] ) ) {
$service_title = $instance[ 'service_title' ];
}
else {
$service_title = __( 'OBSERVATORY SERVICES', 'wpb_widget_domain' );
}

if ( isset( $instance[ 'service_description' ] ) ) {
$service_description = $instance[ 'service_description' ];
}
else {
$service_description = __( 'our current pursuits', 'wpb_widget_domain' );
}

if ( isset( $instance[ 'service1_title' ] ) ) {
$service1_title = $instance[ 'service1_title' ];
}
else {
$service1_title = __( 'RESEARCH', 'wpb_widget_domain' );
}

if ( isset( $instance[ 'service1_description' ] ) ) {
$service1_description = $instance[ 'service1_description' ];
}
else {
$service1_description = __( 'Specializing in Spectroscopy,
Photometry, Catalog proofs and Data collection', 'wpb_widget_domain' );
}

if ( isset( $instance[ 'service1_icon' ] ) ) {
$service1_icon = $instance[ 'service1_icon' ];
}
else {
$service1_icon = 'icon-chemistry icons';
}
// service 2
if ( isset( $instance[ 'service2_title' ] ) ) {
$service2_title = $instance[ 'service2_title' ];
}
else {
$service2_title = __( 'ASTROPHOTOGRAPHY', 'wpb_widget_domain' );
}

if ( isset( $instance[ 'service2_description' ] ) ) {
$service2_description = $instance[ 'service2_description' ];
}
else {
$service2_description = __( 'Filtered config for Planetary, Deepsky and everything in-between', 'wpb_widget_domain' );
}

if ( isset( $instance[ 'service2_icon' ] ) ) {
$service2_icon = $instance[ 'service2_icon' ];
}
else {
$service2_icon = 'icon-camera icons';
}
// service 3
if ( isset( $instance[ 'service3_title' ] ) ) {
$service3_title = $instance[ 'service3_title' ];
}
else {
$service3_title = __( 'ROBOTIC SCOPES', 'wpb_widget_domain' );
}

if ( isset( $instance[ 'service3_description' ] ) ) {
$service3_description = $instance[ 'service3_description' ];
}
else {
$service3_description = __( 'Fully remote controlled telescopes for amateurs and professionals', 'wpb_widget_domain' );
}

if ( isset( $instance[ 'service3_icon' ] ) ) {
$service3_icon = $instance[ 'service3_icon' ];
}
else {
$service3_icon = 'icon-feed icons';
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'service_title' ); ?>"><?php _e( 'Heading:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service_title' ); ?>" name="<?php echo $this->get_field_name( 'service_title' ); ?>" type="text" value="<?php echo esc_attr( $service_title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'service_description' ); ?>"><?php _e( 'Description:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service_description' ); ?>" name="<?php echo $this->get_field_name( 'service_description' ); ?>" type="text" value="<?php echo esc_attr( $service_description ); ?>" />
</p>

<!---- service start -->
<h2>First box</h2>
<p>
<label for="<?php echo $this->get_field_id( 'service1_title' ); ?>"><?php _e( 'Service title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service1_title' ); ?>" name="<?php echo $this->get_field_name( 'service1_title' ); ?>" type="text" value="<?php echo esc_attr( $service1_title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'service1_description' ); ?>"><?php _e( 'Service description:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service1_description' ); ?>" name="<?php echo $this->get_field_name( 'service1_description' ); ?>" type="text" value="<?php echo esc_attr( $service1_description ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'service1_icon' ); ?>"><?php _e( 'Service icon:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service1_icon' ); ?>" name="<?php echo $this->get_field_name( 'service1_icon' ); ?>" type="text" value="<?php echo esc_attr( $service1_icon ); ?>" />
</p>
<!---- 2nd ---->
<h2>2nd box</h2>
<p>
<label for="<?php echo $this->get_field_id( 'service2_title' ); ?>"><?php _e( 'Service title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service2_title' ); ?>" name="<?php echo $this->get_field_name( 'service2_title' ); ?>" type="text" value="<?php echo esc_attr( $service2_title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'service2_description' ); ?>"><?php _e( 'Service description:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service2_description' ); ?>" name="<?php echo $this->get_field_name( 'service2_description' ); ?>" type="text" value="<?php echo esc_attr( $service2_description ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'service2_icon' ); ?>"><?php _e( 'Service icon:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service2_icon' ); ?>" name="<?php echo $this->get_field_name( 'service2_icon' ); ?>" type="text" value="<?php echo esc_attr( $service2_icon ); ?>" />
</p>
<!---- 3rd ---->
<h2>3rd box</h2>
<p>
<label for="<?php echo $this->get_field_id( 'service3_title' ); ?>"><?php _e( 'Service title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service3_title' ); ?>" name="<?php echo $this->get_field_name( 'service3_title' ); ?>" type="text" value="<?php echo esc_attr( $service3_title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'service3_description' ); ?>"><?php _e( 'Service description:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service3_description' ); ?>" name="<?php echo $this->get_field_name( 'service3_description' ); ?>" type="text" value="<?php echo esc_attr( $service3_description ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'service3_icon' ); ?>"><?php _e( 'Service icon:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'service3_icon' ); ?>" name="<?php echo $this->get_field_name( 'service3_icon' ); ?>" type="text" value="<?php echo esc_attr( $service3_icon ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['service_title'] = ( ! empty( $new_instance['service_title'] ) ) ? strip_tags( $new_instance['service_title'] ) : '';
$instance['service_description'] = ( ! empty( $new_instance['service_description'] ) ) ? strip_tags( $new_instance['service_description'] ) : '';

$instance['service1_title'] = ( ! empty( $new_instance['service1_title'] ) ) ? strip_tags( $new_instance['service1_title'] ) : '';
$instance['service1_description'] = ( ! empty( $new_instance['service1_description'] ) ) ? strip_tags( $new_instance['service1_description'] ) : '';
$instance['service1_icon'] = ( ! empty( $new_instance['service1_icon'] ) ) ? strip_tags( $new_instance['service1_icon'] ) : '';

$instance['service2_title'] = ( ! empty( $new_instance['service2_title'] ) ) ? strip_tags( $new_instance['service2_title'] ) : '';
$instance['service2_description'] = ( ! empty( $new_instance['service2_description'] ) ) ? strip_tags( $new_instance['service2_description'] ) : '';
$instance['service2_icon'] = ( ! empty( $new_instance['service2_icon'] ) ) ? strip_tags( $new_instance['service2_icon'] ) : '';

$instance['service3_title'] = ( ! empty( $new_instance['service3_title'] ) ) ? strip_tags( $new_instance['service3_title'] ) : '';
$instance['service3_description'] = ( ! empty( $new_instance['service3_description'] ) ) ? strip_tags( $new_instance['service3_description'] ) : '';
$instance['service3_icon'] = ( ! empty( $new_instance['service3_icon'] ) ) ? strip_tags( $new_instance['service3_icon'] ) : '';

return $instance;
}
} // Class wpb_widget ends here
function wpb_load_widget() {
	register_widget( 'service_widget' );
	register_widget( 'home_widget' );
	register_widget( 'contact_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
function ai2_observatory_menu(){

  $menu_name = 'Main Menu';
  $menu = wp_get_nav_menu_object($menu_name);
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
  //echo '<pre>';
  //print_r($menuitems);

?>
<ul>
    <?php
    $id = get_the_ID();
    $count = 0;
    $submenu = false;

    foreach( $menuitems as $item ):
        $link = $item->url;
        $title = $item->title;
        // item does not have a parent so menu_item_parent equals 0 (false)
        if ( !$item->menu_item_parent ):
        // save this id for later comparison with sub-menu items
        $parent_id = $item->ID;
    ?>

    <li>
        <a href="<?php echo $link; ?>" class="<?php echo ($item->object_id==$id)? 'active':'';?>"><span></span>
           
        </a>
        <div class="fp-tooltip left"> <?php echo $title; ?></div>
    <?php endif; ?>

        <?php if ( $parent_id == $item->menu_item_parent ): ?>

            <?php if ( !$submenu ): $submenu = true; ?>
            <ul class="sub-menu">
            <?php endif; ?>
                    <a class="btn <?php echo ($item->object_id==$id)? 'btn-nontransparent':'btn-transparent';?> animated in fadeInUp" href="<?php echo $link; ?>" data-animation="fadeInUp" data-delay="600" ><?php echo $title; ?></a>
               
            <?php if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ): ?>
            </ul>
            <?php $submenu = false; endif; ?>

        <?php endif; ?>

    <?php if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ): ?>
    </li>                           
    <?php $submenu = false; endif; ?>

<?php $count++; endforeach; ?>

</ul>
<?php
}









