<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

get_header();
	while ( have_posts() ) :
		the_post(); 
		get_template_part( 'template-parts/page', 'banner' );
		?>
		<section id="pageContent" class="page-content py-5">
			<div class="container">
				<div class="row">
					<div class="col-md-8 mx-auto">
						<?php 
							
							get_template_part( 'template-parts/content', 'page' );
							
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>
					</div>
				</div>
			</div>
		</section>
		<?php
	endwhile; // End of the loop.
get_footer();
