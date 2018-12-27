<?php
/**
 * The template for displaying category pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri2016
 */

$title = get_the_archive_title();
get_header();


?>

	<main id="main" class="site-main service-main" role="main">

		<?php
		if ( have_posts() ) :
		?>

			<header class="page-header">
				<?php
					print '<h1 class="page-title fullwidth">' . str_replace( 'Category: ', '', $title ) . '</h1>';
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			
			<div class="fullwidth">
				<p class="type-intro">Our communications team upholds the University of Rhode Island brand and all of its promises in being an affordable university with outstanding students, alumni, faculty and staff. We ensure our message is being shared around the world and that it is clear, concise and consistent.</p>
			
				<!--p><a href="/what-we-do/" class="intro-button button">Learn more about what we do.</a></p-->
			</div>
			
			<div class="self-service-wrapper">
				<header>
					<h2>Self-Service Resources</h2>			
					<p>Download URI Logos, Templates, Photos, and style guides.</p>
				</header>
			
				<div class="cl-tiles thirds site">

					<div class="self-service resource-templates">
						<h3>Logos and Templates</h3>
						<ul>
						
							<li><a href="https://today.uri.edu/wp-content/uploads/2018/02/URI-Logo-and-Brandmark.zip">Logo and Tagline (.zip)</a></li>
							<li><a href="https://drive.google.com/drive/folders/0Bx90U6Dr5fnzQ2lmRVhhNHVaREE">More URI Logos</a></li>
							<li><a href="https://drive.google.com/drive/folders/0Bx90U6Dr5fnzM1lIVEJMWHpBYlU">Templates</a></li>
							
						</ul>
					</div>

					<div class="self-service resource-art">
						<h3>Photos</h3>
						<ul>
							<li><a href="https://www.flickr.com/photos/123450604@N07/albums">Campus Photos</a></li>
							<li><a href="https://www.flickr.com/photos/48235974@N05/albums">Event Photos</a></li>
							<li><a href="https://www.flickr.com/photos/urialumni/albums">Alumni Photos</a></li>
						</ul>
					</div>

					<div class="self-service resource-guides">
						<h3>Guides and Policies</h3>
						<ul>
							<li><a href="https://today.uri.edu/what-we-do/policies-and-guidelines/">University Policies and Guidelines</a></li>
							<li><a href="/what-we-do/uri-brand-visual-standards/">Brand Visual Style Guide</a></li>
							<li><a href="/what-we-do/mpa/">Hiring from the Master Price Agreement</a></li>
						</ul>
					</div>

				</div>
			</div>
			


			<div class="categories-wrapper">
				<header>
					<h2>Custom Solutions</h2>
					<p>We're here to help beyond templates and guidelines.  We tailor customized solutions to meet your objectives.</p>
				</header>

				<div class="cl-tiles thirds site">
			
				<?php
					$params = array(
						'child_of' => $wp_query->get_queried_object_id(),
						'echo' => true,
						'order' => 'ASC',
						'orderby' => 'name',
						'show_count' => true,
						'title_li' => '',
					);
					// wp_list_categories($params);
					$categories = get_categories( $params );
					$post_count = 3;
					foreach ( $categories as $c ) {
					$args = array(
						'posts_per_page'   => 3,
						'category'         => $c->term_id,
						'post_type'        => 'post',
						'post_status'      => 'publish',
						'suppress_filters' => true,
					);
				$posts = get_posts( $args );

				?>
						<div class="category-block <?php echo sanitize_html_class( strtolower( str_replace( ' ', '-', html_entity_decode( $c->name ) ) ) ); ?>">
							<h3><?php print $c->name; ?></h3>
							<div class="description"><?php print category_description( $c->term_id ); ?></div>
				<?php
					if ( is_array( $posts ) ) {
						print '<ul>';
						$count = 0;
						foreach ( $posts as $p ) {
							$li = '<li><a href="%s">%s</a></li>';
							print sprintf( $li, esc_url( get_permalink( $p->ID ) ), $p->post_title );
							$count++;
							}
						if ( $count >= $post_count ) {
							print '<li><a href="' . get_category_link( $c->term_id ) . '">All ' . $c->name . ' (' . $c->category_count . ')</a></li>';
							}
						print '</ul>';
						}
					?>
						</div>
					<?php
					}


				?>
				</div>

			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		
	</main><!-- #main -->

<?php
get_footer();
