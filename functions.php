<?php
/**
 * URI Modern News functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uri-modern-news
 */

/**
 * Enqueue scripts and styles.
 */
function uri_modern_news_enqueues() {

	$parent_style = 'uri-modern-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

	wp_enqueue_style( 'uri-modern-news-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get( 'Version' ) );

	wp_enqueue_script( 'uri-next', get_stylesheet_directory_uri() . '/js/uri-next.js', array(), wp_get_theme()->get( 'Version' ), true );

}
add_action( 'wp_enqueue_scripts', 'uri_modern_news_enqueues' );





/**
 * Fail less wihtout the ACF plugin
 *
 * @todo: implement the $single functionality for parity with ACF's get_field()
 */
function uri_modern_news_get_field( $field_name, $post_id, $single = false ) {
	$post_meta = get_post_meta( $post_id, $field_name, $single );

	if ( count( $post_meta ) == 1 ) {
		return $post_meta[0];
	} else {
		return null;
	}

}


/**
 * Custom fields
 */
require get_stylesheet_directory() . '/inc/custom-fields.php';

/**
 * Handy one-liner display helpers for the template files
 */
require get_stylesheet_directory() . '/inc/template-tags.php';


