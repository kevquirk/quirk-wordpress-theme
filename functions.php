<?php
/**
 * Susty WP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Susty
 */

if ( ! function_exists( 'susty_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function susty_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Susty WP, use a find and replace
		 * to change 'susty' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'susty', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'susty' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'susty_custom_background_args', array(
			'default-color' => 'fffefc',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add support for custom colour pallette in Gutenberg.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => __( 'blue', 'themeLangDomain' ),
				'slug' => 'blue',
				'color' => '#226997',
			),
			array(
				'name' => __( 'green', 'themeLangDomain' ),
				'slug' => 'green',
				'color' => '#345f41',
			),
			array(
				'name' => __( 'orange', 'themeLangDomain' ),
				'slug' => 'orange',
				'color' => '#ffa800',
			),
			array(
				'name' => __( 'red', 'themeLangDomain' ),
				'slug' => 'red',
				'color' => '#c1392b',
			),
			array(
				'name' => __( 'grey', 'themeLangDomain' ),
				'slug' => 'grey',
				'color' => '#333333',
			),
			array(
				'name' => __( 'white', 'themeLangDomain' ),
				'slug' => 'white',
				'color' => '#ffffff',
			),
		) );

	}
endif;
add_action( 'after_setup_theme', 'susty_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function susty_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'susty_content_width', 640 );
}
add_action( 'after_setup_theme', 'susty_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function susty_scripts() {
	wp_enqueue_style( 'susty-style', get_stylesheet_uri() );

	wp_deregister_script( 'wp-embed' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'susty_scripts' );

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

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function susty_nav_rewrite_rule() {
	add_rewrite_rule( 'menu', 'index.php?menu=true', 'top' );
}

add_action( 'init', 'susty_nav_rewrite_rule' );

function susty_register_query_var( $vars ) {
	$vars[] = 'menu';

	return $vars;
}

add_filter( 'query_vars', 'susty_register_query_var' );

add_filter( 'template_include', function( $path ) {
	if ( get_query_var( 'menu' ) ) {
		return get_template_directory() . '/menu.php';
	}
	return $path;
});

// Remove dashicons in frontend for unauthenticated users
add_action( 'wp_enqueue_scripts', 'susty_dequeue_dashicons' );
function susty_dequeue_dashicons() {
	if ( ! is_user_logged_in() ) {
		wp_deregister_style( 'dashicons' );
	}
}

// Remove website field from comment
add_filter('comment_form_default_fields', 'unset_url_field');
function unset_url_field($fields){
    if(isset($fields['url']))
       unset($fields['url']);
       return $fields;
}

/**
 * Comment Form Placeholder Comment Field
 */
 function placeholder_comment_form_field($fields) {
    $replace_comment = __('What would you like to say?', 'yourdomain');

    $fields['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.$replace_comment.'" aria-required="true"></textarea></p>';

    return $fields;
 }
add_filter( 'comment_form_defaults', 'placeholder_comment_form_field' );

/**
 * Comment Form Placeholder Author & Email
 */
 function placeholder_author_email_url_form_fields($fields) {
    $replace_author = __('Your name (required)', 'yourdomain');
    $replace_email = __('Your email (required)', 'yourdomain');

    $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'yourdomain' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="author" name="author" type="text" placeholder="'.$replace_author.'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . $aria_req . ' /></p>';

    $fields['email'] = '<p class="comment-form-email"><label for="email">' . __( 'Email', 'yourdomain' ) . '</label> ' .
    ( $req ? '<span class="required">*</span>' : '' ) .
    '<input id="email" name="email" type="text" placeholder="'.$replace_email.'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>';

    return $fields;
}
add_filter('comment_form_default_fields','placeholder_author_email_url_form_fields');

// Stop Google Fonts loading in Editor.
function deregister_google_font() {
    // deregister google font.
    wp_deregister_style( 'wp-editor-font' );
    // reregister blank file so dependency exists.
    wp_register_style( 'wp-editor-font', get_stylesheet_directory() . '/an-empty.css' );
}
add_action( 'admin_enqueue_scripts', 'deregister_google_font', 11 );

// Gutenberg custom stylesheet
add_theme_support('editor-styles');
add_editor_style( 'style-editor.css' );

// Remove notes category from homepage
function exclude_category_home( $query ) {
if ( $query->is_home ) {
$query->set( 'cat', '-51' );
}
return $query;
}

add_filter( 'pre_get_posts', 'exclude_category_home' );

// Add syntax highlighting with Prism
function add_prism()
{
    wp_enqueue_style( 'prism-css',  get_stylesheet_directory_uri() . '/prism.css' );
    wp_enqueue_script( 'prism-js',  get_stylesheet_directory_uri() . '/prism.js', [], false, true );
}
add_action( 'wp_enqueue_scripts', 'add_prism' );
