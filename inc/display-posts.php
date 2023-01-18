<?php
/**
 * Display posts extensions
 *
 * @package uri-modern-news
 */

/**
 * Display Posts Output Filter
 *
 * @see https://displayposts.com/docs/the-output-filter/
 */
function uri_modern_news_output_filter( $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class, $author, $category_display_text ) {

	$id = get_the_ID();
	if ( $post ) {
		$id = $post->ID;
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

		$horizontal_img_src = uri_modern_news_get_display_image( 'horizontal', $id );
		$vertical_img_src = uri_modern_news_get_display_image( 'vertical', $id );
		$post_headline = uri_modern_news_get_display_headline( $id );

		// Default
		if ( 'default' == $original_atts['news_component'] ) {

			// Set a default
			if ( ! empty( $original_atts['default_component'] ) ) {
				$original_atts['news_component'] = $original_atts['default_component'];
			}

			// Otherwise, use what's specified in the post
			$homepage_format = uri_modern_news_get_field( 'homepage_format', $id, false );
			if ( ! empty( $homepage_format ) ) {
				$original_atts['news_component'] = $homepage_format;
			}
}

		// Cards
		if ( 'card' == $original_atts['news_component'] && function_exists( 'uri_cl_shortcode_card' ) ) {
			$sc = '[cl-card title="' . uri_modern_news_escape_brackets( $post_headline ) . '" body="' . uri_modern_news_escape_brackets( get_the_excerpt() ) . '" link="' . get_the_permalink() . '" img="' . $horizontal_img_src . '" button="Read More"]';
			$output = do_shortcode( $sc );
		}

		// Panels
		if ( 'panel' == $original_atts['news_component'] && function_exists( 'uri_cl_shortcode_panel' ) ) {
			$sc = '[cl-panel format="super" title="' . uri_modern_news_escape_brackets( $post_headline ) . '" img="' . $vertical_img_src . '"]';
			$sc .= uri_modern_news_escape_brackets( get_the_excerpt() );

			$panel_link = '<a href="' . get_the_permalink() . '">Read More</a>';
			if ( function_exists( 'uri_cl_shortcode_button' ) ) {
				$panel_link = '[cl-button link="' . get_the_permalink() . '" text="Read More"]';
			}

			$sc .= '<p>' . $panel_link . '</p>';
			$sc .= '[/cl-panel]';

			$output = do_shortcode( $sc );
		}

		// Heroes
		if ( 'hero' == $original_atts['news_component'] && function_exists( 'uri_cl_shortcode_hero' ) ) {
			$sc = '[cl-hero format="super" headline="' . uri_modern_news_escape_brackets( $post_headline ) . '" subhead="' . uri_modern_news_escape_brackets( get_the_excerpt() ) . '" link="' . get_the_permalink() . '" img="' . $horizontal_img_src . '" button="Read More"]';
			$output = do_shortcode( $sc );
		}
	}

	return $output;

}
add_filter( 'display_posts_shortcode_output', 'uri_modern_news_output_filter', 10, 11 );


/**
 * Display only sticky posts
 *
 * Keeping this here for legacy compatibility, since
 * we're going to move to categories instead of sticky posts -- BF
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
 * Get the specified alternate featured image, if it exists
 */
function uri_modern_news_get_display_image( $format, $id ) {
	$alternate_image = uri_modern_news_get_field( $format . '_image', $id, false );
	$img_src = get_the_post_thumbnail_url( null, $original_atts['image_size'] );

	if ( ! empty( $alternate_image ) ) {
		$img_src = wp_get_attachment_image_src( $alternate_image, 'original' )[0];
	}
	return $img_src;
}


/**
 * Get the alternate headline, if it exists
 */
function uri_modern_news_get_display_headline( $id ) {
	$short_headline = uri_modern_news_get_field( 'short_headline', $id, false );
	$post_headline = get_the_title();

	// If there's an alternate headline, prefer that
	if ( ! empty( $short_headline ) ) {
		$post_headline = $short_headline;
	}
	return $post_headline;
}


/**
 * Helper function to excape square brackets in text that would otherwise appear in shortcodes
 *
 * @param str $input is the input string.
 * @return str
 */
function uri_modern_news_escape_brackets( $input ) {
	return str_replace( array( '[', ']' ), array( '&#91;', '&#93;' ), $input );
}
