<?php
/**
 * Cell functions and definitions
 *
 * @package Cell
 */

if ( ! function_exists( 'cell_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cell_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Cell, use a find and replace
	 * to change 'cell' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cell', get_template_directory() . '/languages' );

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
	 * Enable support for custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 580,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Theme Image Sizes
	add_image_size( 'cell-featured', 768, 768, true );

	// This theme uses wp_nav_menu() in four locations.
	register_nav_menus( array (
		'header-menu'        => esc_html__( 'Header Menu', 'cell' ),
	) );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array ( 'css/editor-style.css', cell_fonts_url() ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array (
		'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cell_custom_background_args', array (
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif; // cell_setup
add_action( 'after_setup_theme', 'cell_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cell_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cell_content_width', 705 );
}
add_action( 'after_setup_theme', 'cell_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function cell_widgets_init() {

	// Widget Areas
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'cell' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'cell_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cell_scripts() {

	/**
	 * Enqueue JS files
	 */

	// Enquire
	wp_enqueue_script( 'cell-enquire', get_template_directory_uri() . '/js/enquire.js', array( 'jquery' ), '2.1.2', true );

	// Superfish Menu
	wp_enqueue_script( 'cell-hover-intent', get_template_directory_uri() . '/js/hover-intent.js', array( 'jquery' ), 'r7', true );
	wp_enqueue_script( 'cell-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '1.7.5', true );

	// Comment Reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Keyboard image navigation support
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'cell-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20140127', true );
	}

	// Custom Script
	wp_enqueue_script( 'cell-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );

	/**
	 * Enqueue CSS files
	 */

	// Bootstrap
	wp_enqueue_style( 'cell-bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );

	// Fontawesome
	wp_enqueue_style( 'cell-fontawesome', get_template_directory_uri() . '/css/font-awesome.css' );

	// Fonts
	wp_enqueue_style( 'cell-fonts', cell_fonts_url(), array(), null );

	// Theme Stylesheet
	wp_enqueue_style( 'cell-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'cell_scripts' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
