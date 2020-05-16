<?php
/**
 * EverStrap enqueue scripts
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'everstrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function everstrap_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' ) . time();
		wp_enqueue_style( 'everstrap-styles', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version );
		// If user logged in then
		if( is_user_logged_in() )  {
			$styles = "
			@media screen and ( max-width: 600px ) {
				.sticky-header {
					top: 32px;
				}
				#nav-drawer {
					top: 32px;
				}
			} ";
			wp_add_inline_style( 'everstrap-styles', $styles );
		}

		wp_enqueue_script( 'everstrap-scripts', get_template_directory_uri() . '/assets/js/bundle.js', array( 'jquery' ), $theme_version, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'everstrap_scripts' );
