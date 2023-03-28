<?php
/**
 * The template for displaying Community Message archive pages
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
					print '<h1 class="page-title">All updates</h1>';
				?>
			</header><!-- .page-header -->

			<div class="community-messages">


				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					$id = get_the_ID();
					if ( $post ) {
						$id = $post->ID;
					}

					$date = '<div class="date">' . get_the_date() . '</div>';

					$title = '<a class="title" href="' . get_the_permalink() . '">' . get_the_title() . '</a>';

					$output = '<div class="listing-item">' . $date . $title . '</div>';

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
