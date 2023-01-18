<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package uri-modern-news
 */

/**
 * Prints HTML with meta information for the current post-date/time
 */
function uri_modern_news_posted_on() {
	$posted_on = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	$posted_on = sprintf(
		$posted_on,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$posted_on = sprintf( esc_html_x( 'Posted on %s', 'post date', 'uri' ), $posted_on );

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$updated_on = '<time class="updated" datetime="%1$s">%2$s</time>';
		$updated_on = sprintf(
			$updated_on,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$updated_on = sprintf( esc_html_x( 'Updated on %s', 'post date', 'uri' ), $updated_on );
	}

	$output = '<div class="post-date"><span class="posted-on">' . $posted_on . '</span> <span class="updated-on">' . $updated_on . '</span></div>';

	echo $output;

}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function uri_modern_news_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		// Translators: used between list items, there is a space after the comma
// do not generate the category list
// $categories_list = get_the_category_list( esc_html__( ', ', 'uri2016' ) );
// if ( $categories_list && uri_modern_news_categorized_blog() ) {
// printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'uri2016' ) . '</span>', $categories_list ); // WPCS: XSS OK.
// }
		// Translators: used between list items, there is a space after the comma
		// print uri_modern_news_tag_list();
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'uri' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'uri' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Prints a list of tags
 */
function uri_modern_news_tag_list() {
	$tags_list = get_the_tag_list( '', esc_html__( ', ', 'uri' ) );
	if ( $tags_list ) {
		return sprintf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'uri' ) . '</span>', $tags_list ); // WPCS: XSS OK.
	}
	return '';
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function uri_modern_news_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'uri_modern_news_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			 array(
				 'fields'     => 'ids',
				 'hide_empty' => 1,
				 // We only need to know if there is more than one category.
				 'number'     => 2,
			 )
			);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'uri_modern_news_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so uri_modern_news_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so uri_modern_news_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in uri_modern_news_categorized_blog.
 */
function uri_modern_news_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'uri_modern_news_categories' );
}
add_action( 'edit_category', 'uri_modern_news_category_transient_flusher' );
add_action( 'save_post', 'uri_modern_news_category_transient_flusher' );


/**
 * Print the Media Contact
 */

/*
// I don't think this is used anymore - BF
function uri_modern_news_media_contact( $post ) {
	if ( empty( $post ) ) {
		return false;
	}

	$field = uri_modern_news_get_field( 'media_contact', $post->ID );

  if ( ! empty( $field ) ) {
		echo $field;
  }
}
*/


/**
 * Print the featured image caption
 */
function uri_modern_news_thumbnail_caption( $post ) {
  echo uri_modern_news_get_thumbnail_caption();
}

/**
 * Get the featured image caption
 */
function uri_modern_news_get_thumbnail_caption( $post ) {
	if ( empty( $post ) ) {
		return false;
	}

  $thumbnail_id    = get_post_thumbnail_id( $post->ID );
	$thumbnail_image = get_posts(
	   array(
		   'p' => $thumbnail_id,
		   'post_type' => 'attachment',
	   )
	  );

  if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		return nl2br( $thumbnail_image[0]->post_excerpt );
  }
  return '';
}


/**
 * Customize the previous / next links at the bottom of the page
 */
function uri_modern_news_post_navigation() {
	$navigation = '';
	$previous   = get_previous_post_link( '<div class="nav-previous">%link</div>', '%title', true );
	$next       = get_next_post_link( '<div class="nav-next">%link</div>', '%title', true );

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		$navigation = _navigation_markup( $previous . $next, 'post-navigation' );
	}

	echo $navigation;
}

/**
 * Get the media contact
 */
function uri_modern_news_get_media_contacts( $post ) {
	$media_contact_ids = uri_modern_news_get_field( 'media_contact', $post->ID );
	if ( is_numeric( $media_contact_ids ) ) {
		$media_contact_ids = array( $media_contact_ids );
	}
	$media_contacts = array();
	if ( ! empty( $media_contact_ids ) ) {
		foreach ( $media_contact_ids as $id ) {
			$media_contacts[] = array(
				'first' => uri_modern_news_get_field( 'firstname', $id ),
				'last' => uri_modern_news_get_field( 'lastname', $id ),
				'telephone' => uri_modern_news_get_field( 'telephone', $id ),
				'email' => uri_modern_news_get_field( 'email', $id ),
			);
		}
	}

	if ( ! empty( $media_contacts ) ) {
		return $media_contacts;
	} else {
		return false;
	}
}
