<?php
/**
 * Template part for displaying page banner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

$banner_title = (isset($args['banner_title']) && $args['banner_title']!="") ? $args['banner_title'] : get_the_title();

?>

<section id="pageBanner" class="page-banner bg-dark py-4 py-md-5">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="h3 text-white m-0 p-0"><?php echo $banner_title; ?></h1>
			</div>
		</div>
	</div>
</section>