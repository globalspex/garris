<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function astra_post_title() { 
	  $post_types = array('page','post'); 
	 
	  // bail early if the current post type if not the one we want to customize. 
	  if ( ! in_array( get_post_type(), $post_types ) ) { return; } 
	 
	  // Disable title. 
	  add_filter( 'astra_the_title_enabled', '__return_false' ); 
}
add_action( 'wp', 'astra_post_title' );

function gx_login_logo() {
?>
	<style type="text/css">
	  #login h1 a, .login h1 a {
			  background-image: url('/garris/wp-content/uploads/2023/01/globalspex-250-75.png');
			  height: 65px;
			  width: 320px;
			  background-size: 320px 94px;
			  background-repeat: no-repeat;
			  padding-bottom: 30px;
	  }
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'gx_login_logo' );

// module enqueued google fonts
add_filter( 'fl_builder_google_fonts_pre_enqueue', function( $fonts ) {
	return array();
} );

// takes care of theme enqueues
add_action( 'wp_enqueue_scripts', function() {
	global $wp_styles;
	if ( isset( $wp_styles->queue ) ) {
		 foreach ( $wp_styles->queue as $key => $handle ) {
			  if ( false !== strpos( $handle, 'fl-builder-google-fonts-' ) ) {
					unset( $wp_styles->queue[ $key ] );
			  }
		 }
	}
}, 101 );