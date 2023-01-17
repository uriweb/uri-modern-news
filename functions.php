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
		$query->set( 'cat', array( 'archives' ) );
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

	if ( $post ) {
		$id = $post->ID;
	} else {
		$id = get_the_ID();
	}

	// Only show a few things for Media Mention posts
	if ( has_category( 'media-mention' ) ) {

		// If we have a publication date, use that instead of the post date
		$pubdate = uri_modern_news_get_field( 'publication_date', $id, false );
		if ( ! empty( $pubdate ) ) {
			$pubdate = date_create( $pubdate );
			$date = '<span class="date">' . date_format( $pubdate, 'F j, Y' ) . '</span>';
		}

		// Use the media outlet, if there is one
		$outlet_markup = '';
		$outlet = uri_modern_news_get_field( 'media_outlet', $id, false );
		if ( ! empty( $outlet ) ) {
			$outlet_markup = '<span class="outlet">' . $outlet . '</span>';
		}

		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $date . $outlet_markup . $title . $excerpt . '</' . $inner_wrapper . '>';
	}

	// COMPONENTS
	// @todo: ideally, this should filter the featured image and
	// use the component library display posts extension,
	// but we're just going to hard-code it here for now
	if ( ! empty( $original_atts['news_component'] ) ) {

		if ( 'card' == $original_atts['news_component'] ) {

			$alternate_image = uri_modern_news_get_field( 'horizontal_image', $id, false );
			$img_src = get_the_post_thumbnail_url( null, $original_atts['image_size'] );

			// If there's a horizontal image set, prefer that
			if ( ! empty( $alternate_image ) ) {
				$img_src = wp_get_attachment_image_src( $alternate_image, 'original' )[0];
			}

			if ( function_exists( 'uri_cl_shortcode_card' ) ) {
				$sc = '[cl-card title="' . uri_modern_news_escape_brackets( get_the_title() ) . '" body="' . uri_modern_news_escape_brackets( get_the_excerpt() ) . '" link="' . get_the_permalink() . '" img="' . $img_src . '" button="Read More"]';
				$output = do_shortcode( $sc );
			}
		}

		if ( 'panel' == $original_atts['news_component'] ) {

			$alternate_image = uri_modern_news_get_field( 'vertical_image', $id, false );
			$img_src = get_the_post_thumbnail_url( null, $original_atts['image_size'] );

			// If there's a vertical image set, prefer that
			if ( ! empty( $alternate_image ) ) {
				$img_src = wp_get_attachment_image_src( $alternate_image, 'original' )[0];
			}

			if ( function_exists( 'uri_cl_shortcode_panel' ) ) {
				$sc = '[cl-panel format="super" title="' . uri_modern_news_escape_brackets( get_the_title() ) . '" img="' . $img_src . '"]';
				$sc .= uri_modern_news_escape_brackets( get_the_excerpt() );

				$panel_link = '<a href="' . get_the_permalink() . '">Read More</a>';
				if ( function_exists( 'uri_cl_shortcode_button' ) ) {
					$panel_link = '[cl-button link="' . get_the_permalink() . '" text="Read More"]';
				}

				$sc .= '<p>' . $panel_link . '</p>';
				$sc .= '[/cl-panel]';

				$output = do_shortcode( $sc );
			}
		}

		if ( 'hero' == $original_atts['news_component'] ) {

			$alternate_image = uri_modern_news_get_field( 'horizontal_image', $id, false );
			$img_src = get_the_post_thumbnail_url( null, $original_atts['image_size'] );

			// If there's a horizontal image set, prefer that
			if ( ! empty( $alternate_image ) ) {
				$img_src = wp_get_attachment_image_src( $alternate_image, 'original' )[0];
			}

			if ( function_exists( 'uri_cl_shortcode_hero' ) ) {
				$sc = '[cl-hero headline="' . uri_modern_news_escape_brackets( get_the_title() ) . '" subhead="' . uri_modern_news_escape_brackets( get_the_excerpt() ) . '" link="' . get_the_permalink() . '" img="' . $img_src . '" button="Read More"]';
				$output = do_shortcode( $sc );
			}
		}
	}

	return $output;

}
add_filter( 'display_posts_shortcode_output', 'uri_modern_news_output_filter', 10, 11 );


/**
 * Helper function to excape square brackets in text that would otherwise appear in shortcodes
 *
 * @param str $input is the input string.
 * @return str
 */
function uri_modern_news_escape_brackets( $input ) {
	return str_replace( array( '[', ']' ), array( '&#91;', '&#93;' ), $input );
}

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



