<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri-modern-news
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
				uri_modern_news_posted_on();

				// Use the media outlet, if there is one
				$outlet = uri_modern_news_get_field( 'media_outlet', $id, false );
				if ( ! empty( $outlet ) ) {
				echo '<div class="outlet">' . $outlet . '</div>';
				}
			?>
		</div>
		<?php endif; ?>
		<?php the_title( sprintf( '<h2 class="entry-title"><a class="title" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
