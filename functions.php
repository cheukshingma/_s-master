<?php
/**
 * terra motive functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package terra motive
 */

if ( ! function_exists( 'terra_motive_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function terra_motive_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on terra motive, use a find and replace
	 * to change 'terra-motive' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'terra-motive', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'terra-motive' ),
		'social'  => esc_html__( 'Social Menu', 'terra-motive'),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5 markup.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'terra_motive_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // terra_motive_setup
add_action( 'after_setup_theme', 'terra_motive_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function terra_motive_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'terra_motive_content_width', 600 ); /*pixels*/
}
add_action( 'after_setup_theme', 'terra_motive_content_width', 0 );

/**
 * Register sidebar/widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function terra_motive_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'terra-motive' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Content- Sidebar', 'terra-motive' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'terra-motive' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'terra_motive_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function terra_motive_scripts() {
	wp_enqueue_style( 'terra-motive-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'terra-motive-content-sidebar', get_template_directory_uri() . '/layouts/content-sidebar.css' );	
	
	wp_enqueue_style( 'terra-motive-google-fonts', 'http://fonts.googleapis.com/css?family=Orbitron:400,500|Play|Roboto:400,100italic' );
	
	wp_enqueue_style( 'terra-motive-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	
	wp_enqueue_script( 'terra-motive-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'terra-motive-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'terra_motive_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*
* Amount of words to excerpt
*/
	function custom_excerpt_length( $length ) {
		return 50;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length');
	
/* My First Custom Post Type */
function my_post_type_slider() {
	register_post_type( 'slider',
                array( 
				'label' => __('Slides'), 
				'singular_label' => __('Slide', 'my_framework'),
				'_builtin' => false,
				'exclude_from_search' => true, // Exclude from Search Results
				'capability_type' => 'page',
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'rewrite' => array(
					'slug' => 'slide-view',
					'with_front' => FALSE,
				),
				'query_var' => "slide", // This goes to the WP_Query schema
				'menu_icon' => get_template_directory_uri() . '/inc/images/slides.png',
				'supports' => array(
						'title',
						'custom-fields',
						'editor',
            					'thumbnail')
					) 
				);
}

add_action('init', 'my_post_type_slider');

add_action( 'init', 'mytheme_setup' );
add_theme_support( 'post-thumbnails' );
function mytheme_setup() {
add_image_size ('slides', 760, 300, true); // Slider Thumbnail
}

// Call the file that controls the theme options 
//(Class 8 - Building an Option Page - Link inc/option.php)
require get_stylesheet_directory().'/inc/options.php';

/*
 * Adding Audio Files/PLaylist into Sidebar/Widget 
 */
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );
add_filter( 'widget_text', 'do_shortcode');


/*
 * My Custom News Widget 
 */
function my_postsbycategory() {
// The Custom News Widget Query
$the_query = new WP_Query( array( 'category_name' => 'news', 'posts_per_page' => 3 ) );
	//Category Name = WP Category Slug
	//Post Per Page = Number of Post on Widget 

// The Cust News Widget Loop
if ( $the_query->have_posts() ) {
	$string .= '<ul class="postsbycategory widget_recent_entries">';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
			if ( has_post_thumbnail() ) {
			$string .= '<li>';
			$string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail($post_id, array( 75, 75) ) . get_the_title() .'</a></li>';
			} else { 
			// If the image featured is not found
			$string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';
			}
			}
	} else {
	// If no posts are found
}


return $string;

/* Restore original Post Data */
wp_reset_postdata();
}

// Add a Shortcode - (WP > Appearance > Widget > Text > Add Shortcode)
add_shortcode('categoryposts', 'my_postsbycategory');

// Enable Shortcodes in Text Widgets
add_filter('widget_text', 'do_shortcode');
