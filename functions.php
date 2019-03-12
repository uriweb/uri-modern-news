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
 * Display Posts Output Filter
 * @see https://displayposts.com/docs/the-output-filter/
 *
 */
// function uri_modern_news_dps_output_customization( $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class, $author, $category_display_text ) {
// 
// 	$lead = uri_modern_news_get_field( 'lead', get_the_ID(), FALSE );
// 	
// 	if ( ! empty( $lead ) ) {
// 		$excerpt = '<span class="excerpt">' . $lead . '</span>';
// 	}
// 	
//   $output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $image . $title . $date . $author . $category_display_text . $excerpt . $content . '</' . $inner_wrapper . '>';
//   return $output;
// }
// add_filter( 'display_posts_shortcode_output', 'uri_modern_news_dps_output_customization', 9, 11 );


function uri_modern_news_get_excerpt( $excerpt, $post=NULL ) {

	if ( $post ) {
		$id = $post->ID;
	} else {
		$id = get_the_ID();
	}
		
	$lead = uri_modern_news_get_field( 'lead', $id, FALSE );
	
	if ( ! empty( $lead ) ) {
		$excerpt = '<span class="excerpt">' . $lead . '</span>';
	}
	
	return $excerpt;
	
}
add_filter( 'get_the_excerpt', 'uri_modern_news_get_excerpt', 999 );


/**
 * Display only sticky posts
 * @see https://displayposts.com/2019/01/09/display-or-hide-sticky-posts/
 *
 */
function uri_modern_news_dps_display_only_sticky_posts( $args, $atts ) {

	$sticky_variations = array( 'sticky_posts', 'sticky-posts', 'sticky posts' );
	if( !empty( $atts['id'] ) && in_array( $atts['id'], $sticky_variations ) ) {
		$sticky_posts = get_option( 'sticky_posts' );
		$args['post__in'] = $sticky_posts;
	}

	if( !empty( $atts['exclude'] ) && in_array( $atts['exclude'], $sticky_variations ) ) {
		$sticky_posts = get_option( 'sticky_posts' );
		$args['post__not_in'] = $sticky_posts;
	}
	
	return $args;
}
add_filter( 'display_posts_shortcode_args', 'uri_modern_news_dps_display_only_sticky_posts', 10, 2 );


/**
 * Custom fields
 */
require get_stylesheet_directory() . '/inc/custom-fields.php';

/**
 * Handy one-liner display helpers for the template files
 */
require get_stylesheet_directory() . '/inc/template-tags.php';


