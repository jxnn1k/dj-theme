<?php
/**
 * dj functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dj
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
function dj_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on dj, use a find and replace
		* to change 'dj' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'dj', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'dj' ),
		)
	);

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

}
add_action( 'after_setup_theme', 'dj_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dj_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'dj' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'dj' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dj_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dj_scripts() {
	wp_enqueue_style( 'derbestyles', get_stylesheet_directory_uri() .'/dist/styles/main.css' );
	wp_enqueue_script('dj/app.js', get_stylesheet_directory_uri().'/dist/scripts/app.js', [], null, true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dj_scripts' );

/**
    *   Image sizes
    */
    
	add_action('after_setup_theme', function () { 
		// 1:1
		add_image_size( 'nk-square', 256, 256, array( 'center', 'top' ));
		add_image_size( 'nk-square-sm', 128, 128, array( 'center', 'top' ));
		add_image_size( 'nk-square-md', 512, 512, array( 'center', 'top' ));
		add_image_size( 'nk-square-lg', 1024, 1024, array( 'center', 'top' ));
		
		//16:9
		add_image_size( 'nk-16by9', 512, 288, array( 'center', 'center' ));
		add_image_size( 'nk-16by9-md', 640, 360, array( 'center', 'center' ));
		add_image_size( 'nk-16by9-lg', 1024, 576, array( 'center', 'center' ));
		add_image_size( 'nk-16by9-xl', 1200, 675, array( 'center', 'center' ));
	});
	// Mit dem folgenden Code sind die neuen Bildgrößen im Gutenberg-Editor verfügbar:
	add_filter('image_size_names_choose', function($sizes){
		$custom_sizes = array(
			'nk-square-lg' => 'Quadrat Responsive',
			'nk-16by9-lg' => '16:9 responsive'
		);
		return array_merge( $sizes, $custom_sizes );
	});



	add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
	register_block_type( __DIR__ . '/blocks/latest-posts' );
	register_block_type( __DIR__ . '/blocks/headline' );
}

function kb_svg ( $svg_mime ){
	$svg_mime['svg'] = 'image/svg+xml';
	return $svg_mime;
}

add_filter( 'upload_mimes', 'kb_svg' );


/* ------------------ */
/* theme options page */
/* ------------------ */

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

// Einstellungen registrieren (http://codex.wordpress.org/Function_Reference/register_setting)
function theme_options_init(){
	register_setting( 'kb_options', 'kb_theme_options', 'kb_validate_options' );
}

// Seite in der Dashboard-Navigation erstellen
function theme_options_add_page() {
	add_theme_page('Optionen', 'Optionen', 'edit_theme_options', 'theme-optionen', 'kb_theme_options_page' ); // Seitentitel, Titel in der Navi, Berechtigung zum Editieren (http://codex.wordpress.org/Roles_and_Capabilities) , Slug, Funktion 
}

// Optionen-Seite erstellen
function kb_theme_options_page() {
global $select_options, $radio_options;
if ( ! isset( $_REQUEST['settings-updated'] ) )
	$_REQUEST['settings-updated'] = false; 
	
}?>

<?php
	if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
}
?>


<?php 

function get_reviews() {

	$api_key	=	get_field('api_key', 'options');
	$place_id	=	get_field('place_id', 'options');
	//$api_data	=	get_field('api_data', 'options');
	//$get_data		=	file_get_contents($api_url);

	$api_url 	=	"https://maps.googleapis.com/maps/api/place/details/json?placeid={$place_id}&key={$api_key}";

	$json_get = wp_remote_get($api_url);
	$json_result = wp_remote_retrieve_body( $json_get );
	
	
	update_field('api_data', $json_result, 'options' );

	
} 

?>
<?php

function display_data() {

	$raw_json = get_field('api_data', 'options');
	$res = json_decode($raw_json);

	$reviews = $res['result']['reviews'];
	var_dump($res);
	
	
	foreach ($reviews as $review) {

		if(!empty($review)) {

			echo 'Hello';

		}

		else {
			echo 'Nein.';
		}


	}
	

}

?>


