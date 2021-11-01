<?php
/**
 * Template part for displaying phone app in template-home.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'col-sm-6 mb-4' ); ?>>
	<article class="app-box">
		<a href="<?php the_permalink(); ?>">
			<?php 
				the_post_thumbnail(
					array( 483, 302 ),
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
		</a>
		<div class="title-outer d-inline-block">
			<a href="<?php the_permalink(); ?>">
				<?php the_title( '<h3 class="my-2 mb-0">', '</h3>' ); ?>
			</a>
			<?php the_excerpt(); ?>
		</div>
		<div class="icon-outer d-inline-block pt-3">
			<a href="#">
				<i class="far fa-thumbs-up"></i>
			</a>
		</div>
	</article>
</div><!-- #post-<?php the_ID(); ?> -->
