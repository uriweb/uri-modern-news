<?php
/**
 * Customize the appearance of the Simple Lighbox
 *
 * @package uri-modern-news
 */

/**
 * Init lightbox
 */
function uri_modern_news_slb_theme_init( $themes ) {
	$properties = array(
		'id' => 'uri-modern-lightbox',
		'name' => 'URI Modern',
		'parent' => 'slb_baseline',
		'styles' => array(
			array( 'core', get_stylesheet_directory_uri() . '/simple-lightbox-theme/styles.css' ),
		),
	);
	$themes->add( 'uri-modern-lightbox', $properties );
}

add_action( 'slb_themes_init', 'uri_modern_news_slb_theme_init' );
