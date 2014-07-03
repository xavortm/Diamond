<?php

/**
 * Functions file
 *
 * For some the main file in a theme. Here we display meta informaion and the
 * header information like menus and logo.
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * @package WordPress
 * @subpackage Diamond
 */

// Include the Diamond Framework
require_once ( 'inc/Diamond_Main.php' );

// Register all the widgets
require_once ( 'inc/widgets/main.php' );

if( ! class_exists( 'Diamond' ) ) :
class Diamond {

	/**
	 * Call all loading functions for the theme. They will be started right after theme setup.
	 * 
	 * @since v1.0.0
	 */
	public function __construct() {

		// Run after instalation setup.
		$this->theme_setup();

		// Register actions using add_actions() custom function.
    	$this->add_actions();

	}

	/**
	 * Initial theme setup
	 * 
	 * Loading scripts and stylesheets. Register custom elements
	 * and functionality in the theme.
	 * 
	 * @uses get_template_directory_uri()
	 * @uses add_theme_support()
	 * @since v1.0.0
	 */
	public function theme_setup() {

		// Add after_setup_theme() for specific functions.
		// The action call is here, because it fits more just for the theme
		// setup, instead for all other actions during using of diamond.
		add_action( 'after_setup_theme', array( $this, 'theme_setup_core' ) );

    	// Set content width for custom media information
    	if ( ! isset( $content_width ) ) $content_width = 900;

	}

	/**
	 * The core functionality that has to be registred after the theme is setted up
	 * 
	 * @since v1.0.1
	 */
	public function theme_setup_core() {

		// Add support for custom header images
		add_theme_support( 'custom-header' ) ;

		// Register the menus.
		register_nav_menus( array( 'primary' 	=> __( 'Main Menu', 'diamond' ) ) );

		// One of the required wordpress supports.
		add_theme_support( 'automatic-feed-links' );

		//  Support post-thubnails as well!
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 'large', 1920, 400, true ); 	// The slider max (and all other big images.)
		set_post_thumbnail_size( 'medium', 760, 350, true ); 	// Default medium size
		set_post_thumbnail_size( 'small', 100, 100, true );		// Small size

		// Theme localization.
		load_theme_textdomain( 'diamond' );
		load_theme_textdomain( 'diamond' , get_template_directory() . '/languages' );

		// Editor style : Throught this, you should make the 
		// wordpress editor look like posts. (in css manner)
		add_editor_style( '/css/editor-style.css');
	}

	/**
	 * Add actions and filters in wordpress theme. All the actions will be here.
	 * 
	 * @uses add_action()
	 * @uses add_filter()
	 * @since v1.0.0
	 */
	public function add_actions() {

		// Register all scripts and styles
		add_action( 'wp_enqueue_scripts', array($this, 'load_scripts_and_styles') );

		// Register our Widgets
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

		// Register custom fonts used in the theme.
		add_action('wp_print_styles', array( $this, 'load_fonts' ));

		// Post title filter.
		add_filter( "wp_title", array( $this, "page_title" ) );

		// Change excerpt lenght
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 10 );

		// Add read more link instead of [...]
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

	}

	/**
	 * Loading scripts and stylesheets for Innocence
	 * The order of initialising bootstrap css files is important
	 * for the theme responsivness work proerly.
	 * 
	 * @uses wp_enqueue_style()
	 * @since v1.0.0
	 */
	public function load_scripts_and_styles() {

		// Get the main stylesheet for the theme.
		wp_enqueue_style( 'stylesheet', get_stylesheet_uri() );

		// Include jQuery from WP Core
		// wp_enqueue_script( "jquery" );

		// My little script addings for jQuery use.
		// wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js' );
		
	}

	public function widgets_init() {

		register_sidebar( array(
			'name'          => __( 'Home Page Widget Area', 'diamond' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Appears on home page', 'diamond' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );


		 /**
		 * Registration for the widgets. Full list of the widgets offered by Diamond framework:
		 * - RecentPosts
		 * - RecentPostsBig
		 *
		 * (choose which to include)
		 * The widgets are included by writing 	register_widget( 'TheWidgetName' );
		 */
		// register_widget( 'yourWidgetClass' );

	}

	/**
	 * Register fonts used in the theme. It is better to include them
	 * from this file instead from hardcoding in header.php
	 * 
	 * @since  v1.0.0
	 */
	public function load_fonts() {
		// wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700');
		// wp_enqueue_style( 'googleFonts');
	}

	/**
	 * Write the theme title. It doesnt return anything.
	 * The simple name comes, because its very natural when call it:
	 * Header::title();
	 * 
	 * @uses get_bloginfo()
	 * @uses wp_title()
	 * @uses is_home()
	 * @uses is_front_page();
	 * 
	 * @since  v1.0.0
	 */
	public function page_title( $title, $sep = ' | ' ) {
		global $page, $paged;

		if ( is_feed() )
			return $title;

		$site_description = get_bloginfo( 'description' );

		$filtered_title = $title . get_bloginfo( 'name' );
		$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? $sep . $site_description: '';
		$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? $sep . sprintf( __( 'Page %s', 'diamond' ), max( $paged, $page ) ) : '';

		return $filtered_title;
	}

	/**
	 * Change the default valued for length of the post excerpt.
	 * @param  int $length The length of desired excerpt. (for all pages and all calls)
	 * @return int         Hardcoded value of the excerpt length
	 */
	public function excerpt_length( $length ) {
		return $length;
	}

	/**
	 * Change the default valued for after the post excerpt.
	 * @param  string $more Not used vcariable, wanted from WP
	 * @return string       Link for the post.
	 */
	public function excerpt_more( $more ) {
		return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More</a>';
	}
}

$Diamond = new Diamond;
endif;