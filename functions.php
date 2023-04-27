<?php
/**
 * URI Modern News functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uri-modern-news
 */


/**
 * Returns only news and media mention posts in search results
 */
function uri_modern_news_limit_search( $query ) {
	if ( $query->is_search && ! is_admin() ) {

		$tax_query = array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => 'archives'
			),
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => 'media-mention'
			),
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => 'community-message'
			)
			);
		
		$query->set( 'tax_query', $tax_query );
		
	}
	return $query;
}
add_filter( 'pre_get_posts', 'uri_modern_news_limit_search' );


/**
 * Orders the media mention archive by 'publication_date' custom field
 * instead of the post's publication date
 */
function uri_modern_news_order_media_mentions( $query ) {

	// do not modify queries in the admin
	if ( is_admin() ) {
		return $query;
	}

	// only modify queries for 'media-mention' post category
	if ( isset( $query->query_vars['category_name'] ) && 'media-mention' == $query->query_vars['category_name'] && $query->is_main_query() ) {

		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'publication_date' );
		$query->set( 'order', 'DEC' );
	}
	// return
	return $query;
}
add_action( 'pre_get_posts', 'uri_modern_news_order_media_mentions' );


/**
 * Enqueue scripts and styles.
 */
function uri_modern_news_enqueues() {

	$parent_style = 'uri-modern-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

	wp_enqueue_style( 'uri-modern-news-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get( 'Version' ) );

	wp_enqueue_script( 'uri-modern-news-js', get_stylesheet_directory_uri() . '/js/script.min.js', array(), wp_get_theme()->get( 'Version' ), true );

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
 * Display posts extensions
 */
require get_stylesheet_directory() . '/inc/display-posts.php';

/**
 * Handy one-liner display helpers for the template files
 */
require get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Style the Simple Lighbox plugin
 */
require get_stylesheet_directory() . '/inc/simple-lightbox-theme.php';
