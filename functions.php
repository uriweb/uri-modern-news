<?php
/**
 * URI Modern News functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uri-modern-news
 */


/**
 * Returns only press releases in search results
 * i.e. no people, no advisories, no pages.
 */
function uri_modern_news_limit_search( $query ) {
	if ( $query->is_search && ! is_admin() ) {
		$query->set( 'post_type', array( 'post', 'page' ) );
		$query->set( 'cat', array( 2, 2320 ) );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'uri_modern_news_limit_search' );


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
 * Display Posts Output Filter
 *
 * @see https://displayposts.com/docs/the-output-filter/
 */
function uri_modern_news_output_filter( $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class, $author, $category_display_text ) {

	// The default output
	$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $image . $title . $date . $author . $category_display_text . $excerpt . $content . '</' . $inner_wrapper . '>';

	if ( $post ) {
		$id = $post->ID;
	} else {
		$id = get_the_ID();
	}

	$categories = wp_get_post_categories( $id, array( 'fields' => 'slugs' ) );

	// Only show a few things for Media Mention posts
	if ( in_array( 'media-mention', $categories ) ) {

		// If we have a publication date, use that instead of the post date
		$pubdate = uri_modern_news_get_field( 'publication_date', $id, false );
		if ( ! empty( $pubdate ) ) {
			$pubdate = date_create( $pubdate );
			$date = '<span class="date">' . date_format( $pubdate, 'F j, Y' ) . '</span>';
		}

		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $date . $excerpt . $title . '</' . $inner_wrapper . '>';
	}

	return $output;

}
add_filter( 'display_posts_shortcode_output', 'uri_modern_news_output_filter', 10, 11 );


/**
 * Excerpt Filter
 */
function uri_modern_news_get_excerpt( $excerpt, $post = null ) {

	if ( $post ) {
		$id = $post->ID;
	} else {
		$id = get_the_ID();
	}

	// Inject the media outlet, if there is one
	$outlet = uri_modern_news_get_field( 'media_outlet', $id, false );
	if ( ! empty( $outlet ) ) {
		$excerpt = '<span class="outlet">' . $outlet . '</span>';
	}

	// Inject the lead, if there is one
	$lead = uri_modern_news_get_field( 'lead', $id, false );
	if ( ! empty( $lead ) ) {
		$excerpt = '<span class="excerpt">' . $lead . '</span>';
	}

	return $excerpt;

}
add_filter( 'get_the_excerpt', 'uri_modern_news_get_excerpt', 999 );


/**
 * Display only sticky posts
 *
 * @see https://displayposts.com/2019/01/09/display-or-hide-sticky-posts/
 */
function uri_modern_news_dps_display_only_sticky_posts( $args, $atts ) {

	$sticky_variations = array( 'sticky_posts', 'sticky-posts', 'sticky posts' );
	if ( ! empty( $atts['id'] ) && in_array( $atts['id'], $sticky_variations ) ) {
		$sticky_posts = get_option( 'sticky_posts' );
		$args['post__in'] = $sticky_posts;
	}

	if ( ! empty( $atts['exclude'] ) && in_array( $atts['exclude'], $sticky_variations ) ) {
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

/**
 * Style the Simple Lighbox plugin
 */
require get_stylesheet_directory() . '/inc/simple-lightbox-theme.php';



