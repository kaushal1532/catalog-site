<?php
/**
 * Template Name: Home Page
 * 
 * The template for displaying home page
 *
 * This is the template that displays home page by default.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

get_header();

	while ( have_posts() ) :
		the_post();
			$post_id = get_the_ID();

			/* Banner section data */
			$banner_image = get_field('banner_image', $post_id);
			$banner_image_url = "";
			if(isset($banner_image) && $banner_image!="") {
				$banner_image_url = wp_get_attachment_image_url($banner_image, array(1903, 413));
				$banner_image_url = 'style="background-image: url('.$banner_image_url.'); background-size: cover;background-position: center;"';
			}
			$banner_name = get_field('banner_name', $post_id);
			$banner_title_text_above = get_field('banner_title_text_above', $post_id);
			$banner_title = get_field('banner_title', $post_id);
			$banner_button = get_field('banner_button', $post_id);
			$banner_content = get_field('banner_content', $post_id);
			/* EOF Banner section data */

			/* About Us section data */
			$about_us_image = get_field('about_us_section_image', $post_id);
			if( $about_us_image!="" ) {
				$about_us_image = wp_get_attachment_image($about_us_image, array(450, 260), false, array( "class" => "img-fluid" ));
			}
			$about_us_title = get_field('about_us_section_title', $post_id);
			$about_us_button = get_field('about_us_section_button', $post_id);
			$about_us_content = get_field('about_us_section_content', $post_id);
			/* EOF About Us section data */

			/* Why Choose Us section data */
			$why_choose_us_title = get_field('why_choose_us_section_title', $post_id);
			$why_choose_us_cta_button = get_field('why_choose_us_section_cta_button', $post_id);
			$why_choose_us_key_factors = get_field('why_choose_us_section_key_factors', $post_id);
			/* EOF Why Choose Us section data */

			/* Featured Products section data */
			$featured_products_ids = get_field('featured_products', $post_id);
			if( !empty($featured_products_ids) ) {
				$featured_products_section_title = get_field('featured_products_section_title', $post_id);
				if( $featured_products_section_title=="" ) {
					$featured_products_section_title = __( 'Featured Products', 'kit_theme' );
				}
				$featured_products_cta_button = get_field('featured_products_cta_button', $post_id);

				$args = array(
					"post__in" 	=> $featured_products_ids,
					"post_type" => "product"
				);
				$featured_products = new WP_Query( $args );
			}			
			/* EOF Featured Products section data */

			/* Featured Blogs section data */
			$featured_blogs_ids = get_field('featured_blogs', $post_id);
			if( !empty($featured_blogs_ids) ) {
				$featured_blogs_section_title = get_field('featured_blogs_section_title', $post_id);
				if( $featured_blogs_section_title=="" ) {
					$featured_blogs_section_title = __( 'Featured Blogs', 'kit_theme' );
				}
				$featured_blogs_cta_button = get_field('featured_blogs_cta_button', $post_id);

				$args = array(
					"post__in" 	=> $featured_blogs_ids,
					"post_type" => "post"
				);
				$featured_blogs = new WP_Query( $args );
			}			
			/* EOF Blogs Products section data */

			/* Newsletter section data */
			$newsletter_title_text_above = get_field('newsletter_title_text_above', $post_id);
			$newsletter_title = get_field('newsletter_title', $post_id);
			$newsletter_content = get_field('newsletter_content', $post_id);
			$newsletter_form_shortcode = get_field('newsletter_form_shortcode', $post_id);
			/* EOF Newsletter section data */
		?>
	<!-- Home Banner -->
	<section id="homeHero" class="home-hero-section bg-dark text-secondary py-5 text-center" <?php echo $banner_image_url; ?>>
		<div class="container py-5">
			<div class="row">
				<div class="col-md-8 col-lg-6 mx-auto">
					<span class="text-light"><?php echo $banner_title_text_above; ?></span>
					<h1 class="display-5 fw-bold text-uppercase text-white"><?php echo $banner_title; ?></h1>
					<?php echo $banner_content; ?>
					<?php 
						if(isset($banner_button['url'])) {
							$banner_button_title = (isset($banner_button['title']) && $banner_button['title']!="") ? $banner_button['title'] : __( 'Explore Our Products', 'kit_theme' );
							$banner_button_url = (isset($banner_button['url']) && $banner_button['url']!="") ? $banner_button['url'] : '#';
							$banner_button_target = (isset($banner_button['target']) && $banner_button['target']!="") ? 'target="'.$banner_button['target'].'"' : '';
					?>
					<div class="d-grid gap-2 d-sm-flex justify-content-center">
						<a href="<?php echo $banner_button_url; ?>" class="btn btn-outline-primary btn-lg fw-bold" <?php echo $banner_button_target; ?>><?php echo $banner_button_title; ?></a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<!-- EOF Home Banner -->

	<!-- Home About Us -->
	<section id="homeAboutUs" class="home-about-us-section py-5">
		<div class="container">
			<div class="row">
				<?php if( $about_us_image!="" ) { ?>
				<div class="col-md-5 order-md-2 mb-3 mb-md-0 text-center text-md-end">
					<?php echo $about_us_image; ?>
				</div>
				<?php } ?>
				<div class="col-md-7 order-md-1">
					<h3><?php echo $about_us_title; ?></h3>
					<?php echo $about_us_content; ?>
					<?php 
						if(isset($about_us_button['url'])) {
							$about_us_button_title = (isset($about_us_button['title']) && $about_us_button['title']!="") ? $about_us_button['title'] : __( 'Read More', 'kit_theme' );
							$about_us_button_url = (isset($about_us_button['url']) && $about_us_button['url']!="") ? $about_us_button['url'] : '#';
							$about_us_button_target = (isset($about_us_button['target']) && $about_us_button['target']!="") ? 'target="'.$about_us_button['target'].'"' : '';
					?>
						<a href="<?php echo $about_us_button_url; ?>" class="btn btn-outline-primary"<?php echo $about_us_button_target; ?>><?php echo $about_us_button_title; ?></a>
					<?php } ?>
					
				</div>
			</div>
		</div>
	</section>
	<!-- EOF Home About Us -->

	<!-- Home Why Choose Us -->
	<section id="homeWhyChooseUs" class="home-why-choose-us-section py-5 bg-light">
		<div class="container">
			<div class="row">
				<div class="col-12 mb-4 text-center">
					<h3 class="p-0 m-0"><?php echo $why_choose_us_title; ?></h3>
				</div>
				<?php 
					if( !empty($why_choose_us_key_factors) ) {
						foreach( $why_choose_us_key_factors as $key_factor ) {
							$key_factor_icon = isset($key_factor['why_choose_us_key_factors_icon_html']) && $key_factor['why_choose_us_key_factors_icon_html']!="" ? $key_factor['why_choose_us_key_factors_icon_html'] : "";
							$key_factor_title = $key_factor['why_choose_us_key_factors_title'];
							$key_factor_description = $key_factor['why_choose_us_key_description'];
							?>
				<div class="col-md-4 mb-2 mb-md-0">
					<?php if( $key_factor_icon!="" ) { ?>
					<div class="h1 d-inline-block">
						<?php echo $key_factor_icon; ?>
					</div>
					<?php } ?>
					<h4><?php echo $key_factor_title; ?></h4>
					<p><?php echo $key_factor_description; ?></p>
				</div>
							<?php
						}
					}
				?>
				
				
				<div class="col-12 mt-0 mt-md-3 text-center">
					<?php 
						if(isset($why_choose_us_cta_button['url'])) {
							$why_choose_us_cta_button_title = (isset($why_choose_us_cta_button['title']) && $why_choose_us_cta_button['title']!="") ? $why_choose_us_cta_button['title'] : __( 'Explore Our Products', 'kit_theme' );
							$why_choose_us_cta_button_url = (isset($why_choose_us_cta_button['url']) && $why_choose_us_cta_button['url']!="") ? $why_choose_us_cta_button['url'] : '#';
							$why_choose_us_cta_button_target = (isset($why_choose_us_cta_button['target']) && $why_choose_us_cta_button['target']!="") ? 'target="'.$why_choose_us_cta_button['target'].'"' : '';
					?>
						<a href="<?php echo $why_choose_us_cta_button_url; ?>" class="btn btn-outline-primary"<?php echo $why_choose_us_cta_button_target; ?>><?php echo $why_choose_us_cta_button_title; ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<!-- EOF Home Why Choose Us -->

	<?php if( !empty($featured_products_ids) ) { ?>
	<!-- Home Featured Products -->
	<section id="homeFeaturedProducts" class="home-featured-products py-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3 class="mb-4"><?php echo $featured_products_section_title; ?></h3>
				</div>

				<!-- Featured Products List -->
				<?php 
					if( $featured_products->have_posts() ) {
						$product_image_args = array(
							"class" => "card-img-top rounded-0"
						);
						$product_default_image = get_field( 'product_default_image', 'option' );
						if ( $product_default_image!="" ) {
							$product_default_image = wp_get_attachment_image( $product_default_image, 'product-small-thumb', false, $product_image_args );
						}

						$product_title_length = get_field( 'product_title_length', 'option' );
						$post_excerpt_length = get_field( 'post_excerpt_length', 'option' );
						$product_currency = get_field( 'product_currency', 'option' );

						$args = array(
							"product_image_args" => $product_image_args,
							"product_default_image" => $product_default_image,
							"product_title_length" => $product_title_length,
							"post_excerpt_length" => $post_excerpt_length,
							"product_currency" => $product_currency,
							"product_col_class" => "col-md-6 col-lg-3 mb-4 mb-lg-0"
						);

						while( $featured_products->have_posts() ) { 
							$featured_products->the_post();
							get_template_part( 'template-parts/product', 'card', $args );
						} 
					} 
					wp_reset_postdata(); 
				?>
				<!-- EOF Featured Products List -->
				<?php 
					if(isset($featured_products_cta_button['url'])) {
						$featured_products_cta_button_title = (isset($featured_products_cta_button['title']) && $featured_products_cta_button['title']!="") ? $featured_products_cta_button['title'] : __( 'View All Products', 'kit_theme' );
						$featured_products_cta_button_url = (isset($featured_products_cta_button['url']) && $featured_products_cta_button['url']!="") ? $featured_products_cta_button['url'] : '#';
						$featured_products_cta_button_target = (isset($featured_products_cta_button['target']) && $featured_products_cta_button['target']!="") ? 'target="'.$featured_products_cta_button['target'].'"' : '';
					?>
				<div class="col-12 mt-4 text-center">
						<a href="<?php echo $featured_products_cta_button_url; ?>" class="btn btn-outline-primary"<?php echo $featured_products_cta_button_target; ?>><?php echo $featured_products_cta_button_title; ?></a>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<!-- EOF Home Featured Products -->
	<?php } ?>

	<?php if( !empty($featured_blogs_ids) || $featured_blogs->have_posts()) { 
			$post_image_args = array(
				"class" => "card-img-top rounded-0"
			);
		?>
	<!-- Featured Blogs -->
	<section id="homeFeaturedBlogs" class="home-featured-blogs bg-light py-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3 class="mb-4"><?php echo $featured_blogs_section_title; ?></h3>
					<div class="row">
						<div class="col-md-5">
							<?php 
								while ($featured_blogs->have_posts()) {
									$featured_blogs->the_post();
									$args = array(
										'post_card_type' => 'featured'
									);
									get_template_part( 'template-parts/post', 'card', $args );
									break;
								}
							?>
						</div>
						<div class="col-md-7">
							<?php 
								$i = 0;
								while ($featured_blogs->have_posts()) {
									$featured_blogs->the_post();
									get_template_part( 'template-parts/post', 'card' );
									$i++; 
								}
							?>
						</div>

						<?php 
							if(isset($featured_blogs_cta_button['url'])) {
								$featured_blogs_cta_button_title = (isset($featured_blogs_cta_button['title']) && $featured_blogs_cta_button['title']!="") ? $featured_blogs_cta_button['title'] : __( 'View All Blogs', 'kit_theme' );
								$featured_blogs_cta_button_url = (isset($featured_blogs_cta_button['url']) && $featured_blogs_cta_button['url']!="") ? $featured_blogs_cta_button['url'] : '#';
								$featured_blogs_cta_button_target = (isset($featured_blogs_cta_button['target']) && $featured_blogs_cta_button['target']!="") ? 'target="'.$featured_blogs_cta_button['target'].'"' : '';
							?>
						<div class="col-12 mt-4 text-center">
								<a href="<?php echo $featured_blogs_cta_button_url; ?>" class="btn btn-outline-primary"<?php echo $featured_blogs_cta_button_target; ?>><?php echo $featured_blogs_cta_button_title; ?></a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- EOF Featured Blogs -->
	<?php } wp_reset_postdata();  ?>

	<!-- Newsletter -->
	<section id="newsLetter" class="catalog-newsletter my-5">
		<div class="container">
			<div class="py-5 bg-light text-center">
				<div class="row">
					<div class="col-11 col-md-8 col-lg-5 mx-auto">
						<span><?php echo $newsletter_title_text_above; ?></span>
						<h3><?php echo $newsletter_title; ?></h3>
						<p><?php echo $newsletter_content; ?></p>
						<?php 
							echo do_shortcode($newsletter_form_shortcode);
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- EOF Newsletter -->
		<?php
	endwhile;
get_footer();