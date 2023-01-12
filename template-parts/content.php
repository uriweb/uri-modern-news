<?php
/**
 * Template part for displaying news posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri-modern-news
 */

	$additional_classes = array();
	$show_media_box = false;
	if ( ! is_single() ) {
	$additional_classes[] = 'excerpt';
	}

	$smbv = uri_modern_news_get_field( 'show_the_media_box', $post->ID );
	if ( ! empty( $smbv ) && is_single() ) {
	$show_media_box = true;
	}

	$media_contacts = uri_modern_news_get_media_contacts( $post );

// echo '<pre>', print_r( $media_contacts, TRUE), '</pre>';
//
// $name = 'Todd McLeish';
//
// function get_media_contact_id_by_name( $name ) {
// $last = array_pop( explode( ' ', $name ) );
//
// $args = array(
// 'meta_key' => 'lastname',
// 'meta_value' => $last,
// );
// $mc_post = get_posts( $args );
// $media_contact_id = $mc_post[0]->ID;
//
// if( empty( $media_contact_id ) ) {
// $media_contact_id = 51;
// }
// return $media_contact_id;
// echo '<pre>', print_r( $media_contact_id, TRUE), '</pre>';
// }
// echo '<pre>', print_r( get_media_contact_id_by_name( 'Todd McLeish' ), TRUE), '</pre>';
	// get the deck; empty it if it's just a copy of the title.
	$deck = uri_modern_news_get_field( 'deck', $post->ID );
	if ( get_the_title() == $deck ) {
	$deck = '';
	}


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">

	<?php if ( is_single() && is_array( $media_contacts ) ) : ?>
	<aside class="news-post-detail">
		<?php if ( count( $media_contacts ) > 0 ) : ?>
			<span class="contacts">Media Contact<?php print ( count( $media_contacts ) == 1 ) ? '' : 's'; ?>:</span>
			<?php foreach ( $media_contacts as $c ) : ?>
				<div class="contact">
				<span class="media-name"><a href="mailto:<?php print $c['email']; ?>"><?php print $c['first'] . ' ' . $c['last']; ?></a></span>
				<span class="media-phone"><?php print $c['telephone']; ?></span>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php uri_modern_news_posted_on(); ?>
		<?php echo do_shortcode( '[cl-share]' ); ?>
		
	</aside>
	<?php endif; ?>


	<div class="fullwidth">

	<?php

	if ( is_single() ) {
		if ( ! uri_modern_get_field( 'pagetitle' ) ) {
			the_title( '<h1 class="entry-title fullwidth">', '</h1>' );
		}

		if ( ! empty( $deck ) ) {
			print '<p class="type-intro deck">' . $deck . '</p>';
		}
	} else {

		the_title( '<h2 class="entry-title fullwidth"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		uri_modern_news_posted_on();

	}

	?>
	</div>
	</header><!-- .entry-header -->
	
	<?php
	if ( is_single() && ! uri_modern_get_field( 'uri_modern_hide_featured_image' ) && ! has_post_format( 'video' ) ) {
		get_template_part( 'template-parts/featured-image' );
	}
	?>

	<div class="entry-content">
		<?php
		if ( ( is_single() || is_page() ) ) {
			$continue = sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( '<span class="continue-reading">Continue reading %s <span class="meta-nav">&rarr;</span></span>', 'uri' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			);
			the_content( $continue );

			if ( has_category( 'news', $post ) ) {
				get_template_part( 'template-parts/more-links' );
			}
		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php uri_modern_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
