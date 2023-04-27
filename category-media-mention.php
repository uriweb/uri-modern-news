<?php
/**
 * The template for displaying Media Mention archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri-modern-news
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :
			?>

			<header class="page-header">
				<?php
					print '<h1 class="page-title">All media mentions</h1>';
				?>
			</header><!-- .page-header -->

			<div class="archive-list media-mentions">


				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					$id = get_the_ID();
					if ( $post ) {
						$id = $post->ID;
					}

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

					$title = '<h2><a class="title" href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';

					$output = '<div class="listing-item">' . $date . $outlet_markup . $title . '</div>';

					echo $output;

				endwhile;

				?>

			</div>

				<?php

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

</main><!-- #main -->

<?php
get_footer();
