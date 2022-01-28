<?php
/**
 * bake functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bake
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function baketheme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on bake, use a find and replace
		* to change 'baketheme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'baketheme', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'baketheme' ),
		)
	);

	
	// scondary menu
	if(! class_exists('WooCommerce')){
		register_nav_menus(
		array(
			'menu-2' => esc_html__( 'secondary', 'baketheme' ),
		)
		);
	}
	

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'baketheme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'baketheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function baketheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'baketheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'baketheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function baketheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'baketheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'baketheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'footer-social', 'baketheme' ),
			'id'            => 'footer-socail-1',
			'description'   => esc_html__( 'Add soial media block here.', 'baketheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s social">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'baketheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function baketheme_scripts() {

	

	wp_enqueue_script( 'baketheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'baketheme-search', get_template_directory_uri() . '/js/search.js', array(), _S_VERSION, true );
	// ------------------
			// Registering Bootstrap style
		// wp_enqueue_style( 'bootstrap_min0', get_template_directory_uri().'/css/bootstrap.min.css' );
		
		// wp_enqueue_script( 'bootstrap_min1',get_template_directory_uri().'/js/jquery-3.6.0.js' );
		
		// wp_enqueue_script( 'bootstrap_min3', get_template_directory_uri() . '/js/bootstrap.min.js','jquery');
	
		// -------------------------
		if(is_front_page()){
			wp_enqueue_style('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
		wp_enqueue_script( 'boot1','https://code.jquery.com/jquery-3.3.1.slim.min.js', array( 'jquery' ),'',true );
		wp_enqueue_script( 'boot2','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array( 'jquery' ),'',true );
		wp_enqueue_script( 'boot3','https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array( 'jquery' ),'',true );
		wp_enqueue_script( 'bootstrap_min4', get_template_directory_uri() . '/js/carousel.js' ,'bootstrap.min.js');
		}
		
		// -------------------------
		// wp_enqueue_style('bootstrap4','https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
		// wp_enqueue_script( 'boot1','https://code.jquery.com/jquery-3.6.0.slim.min.js', array( 'jquery' ),'',true );
		// wp_enqueue_script( 'boot2','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array( 'jquery' ),'',true );
		// wp_enqueue_script( 'boot3','https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', array( 'jquery' ),'',true );
		// ------------------------------
			wp_enqueue_style( 'baketheme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'baketheme-google-fonts','href="https://fonts.googleapis.com/css2?family=Abel&family=Spartan:wght@100;200;300;400&display=swap', array(), _S_VERSION );
	wp_style_add_data( 'baketheme-style', 'rtl', 'replace' );
	// ------------------


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'baketheme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
	// echo('woo');
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);
/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {

	require get_template_directory() . '/inc/woocommerce2.php';
}
function ww_load_dashicons(){
	wp_enqueue_style('dashicons');
 }
 add_action('wp_enqueue_scripts', 'ww_load_dashicons', 999);