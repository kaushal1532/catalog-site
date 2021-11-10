<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

get_header();

$args = array(
	'banner_title' => 'Blogs'
);
get_template_part( 'template-parts/page', 'banner', $args );
?>


	<!-- Page Content -->
	<section id="pageContent" class="page-content py-5">
		<div class="container">
			<div class="row">

				<!-- Post List Section -->
				<div class="col-md-9">

					<?php if ( have_posts() ) : ?>
					<!-- Blog List Section -->
					<div class="row blogs-data">
						<?php 
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
						?>
						<div class="col-12">
							<?php 
								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								get_template_part( 'template-parts/content', get_post_type() );
							?>
						</div>
						<?php 
							endwhile;
						?>
					</div>
					<!-- EOF Blog List Section -->

					<!-- Load More -->
					<div class="text-center">
						<a href="#" class="btn btn-outline-primary load-more-blogs"><?php _e( 'Load More', 'kit_theme' ); ?></a>
					</div>
					<!-- EOF Load More -->

					<?php
					else :
						get_template_part( 'template-parts/content', 'none' );			
					endif;
					?>
				</div>
				<!-- EOF Post List Section -->

				<!-- Sidebar -->
				<div class="col-md-3 mb-5 mb-md-0">
					<div class="position-sticky" style="top: 2rem;">
						<?php get_sidebar(); ?>
					</div>
				</div>
				<!-- EOF Sidebar -->
			</div>
		</div>
	</section>
	<!-- EOF Page Content -->
<?php
get_footer();