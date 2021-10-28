
   
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
		?>
	<!-- Home Banner -->
	<section id="homeHero" class="home-hero-section bg-dark text-secondary py-5 text-center" <?php echo $banner_image_url; ?>>
		<div class="container py-5">
			<div class="row">
				<div class="col-md-8 col-lg-6 mx-auto">
					<span class="text-light"><?php echo $banner_title_text_above; ?></span>6
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
				<div class="col-md-5 order-md-2 mb-3 mb-md-0 text-center text-md-end">
					<img src="https://dummyimage.com/450x260/f8f9fa/6c757d.jpg" alt="About Us" class="img-fluid">
				</div>
				<div class="col-md-7 order-md-1">
					<h3>About Us</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in nunc purus. Cras ut tempus diam, nec convallis mauris. Etiam a mollis odio.</p>
					<p>Suspendisse blandit leo molestie eleifend vehicula. Integer quis bibendum lacus, vitae ultricies ante. Cras et tortor vel nulla luctus auctor.</p>
					<p>Nullam egestas libero elit, quis elementum tortor tincidunt eu. Vivamus consequat orci erat, et eleifend mi posuere nec. Vestibulum ultricies ornare feugiat.</p>
					<a href="./about-us.html" class="btn btn-outline-primary">Read More</a>
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
					<h3 class="p-0 m-0">Why Choose Us</h3>
				</div>
				<div class="col-md-4 mb-2 mb-md-0">
					<div class="h1 d-inline-block">
						<i class="bi-alarm"></i>
					</div>
					<h4>On Time Delivery</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in nunc purus. Cras ut tempus diam, nec convallis mauris. Etiam a mollis odio.</p>
				</div>
				<div class="col-md-4 mb-2 mb-md-0">
					<div class="h1 d-inline-block">
						<i class="bi bi-key"></i>
					</div>
					<h4>Safe and secure</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in nunc purus. Cras ut tempus diam, nec convallis mauris. Etiam a mollis odio.</p>
				</div>
				<div class="col-md-4 mb-2 mb-md-0">
					<div class="h1 d-inline-block">
						<i class="bi bi-headset"></i>
					</div>
					<h4>Excellent Customer Support</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in nunc purus. Cras ut tempus diam, nec convallis mauris. Etiam a mollis odio.</p>
				</div>
				<div class="col-12 mt-0 mt-md-3 text-center">
					<a href="./products.html" class="btn btn-outline-primary">Explore Our Products</a>
				</div>
			</div>
		</div>
	</section>
	<!-- EOF Home Why Choose Us -->

	<!-- Home Featured Products -->
	<section id="homeFeaturedProducts" class="home-featured-products py-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3 class="mb-4">Featured Products</h3>
				</div>
				<!-- Featured Products List -->
				<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
					<div class="card shadow rounded-0">
						<a href="./product.html">
							<img src="https://dummyimage.com/285x140/f8f9fa/6c757d.jpg" class="card-img-top" alt="Product title">
						</a>
						<div class="card-body">
							<a href="./product.html" class="text-dark text-decoration-none">
								<h5 class="card-title text-capitalize">Product Title</h5>
							</a>
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<small class="text-muted">
									<b>Price:</b><span class="float-end">$12.00</span>
								</small>
							</li>
							<li class="list-group-item">
								<small class="text-muted">
									<b>Color:</b><span class="float-end">Red</span>
								</small>
							</li>
							<li class="list-group-item">
								<small class="text-muted">
									<b>Size:</b><span class="float-end">XL</span>
								</small>
							</li>
						</ul>
						<div class="card-body">
							<a href="./product.html" class="btn btn-outline-primary">View Product</a>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
					<div class="card shadow rounded-0">
						<a href="./product.html">
							<img src="https://dummyimage.com/285x140/f8f9fa/6c757d.jpg" class="card-img-top" alt="Product title">
						</a>
						<div class="card-body">
							<a href="./product.html" class="text-dark text-decoration-none">
								<h5 class="card-title text-capitalize">Product Title</h5>
							</a>
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<small class="text-muted">
									<b>Price:</b><span class="float-end">$12.00</span>
								</small>
							</li>
							<li class="list-group-item">
								<small class="text-muted">
									<b>Color:</b><span class="float-end">Red</span>
								</small>
							</li>
							<li class="list-group-item">
								<small class="text-muted">
									<b>Size:</b><span class="float-end">XL</span>
								</small>
							</li>
						</ul>
						<div class="card-body">
							<a href="./product.html" class="btn btn-outline-primary">View Product</a>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
					<div class="card shadow rounded-0">
						<a href="./product.html">
							<img src="https://dummyimage.com/285x140/f8f9fa/6c757d.jpg" class="card-img-top" alt="Product title">
						</a>
						<div class="card-body">
							<a href="./product.html" class="text-dark text-decoration-none">
								<h5 class="card-title text-capitalize">Product Title</h5>
							</a>
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<small class="text-muted">
									<b>Price:</b><span class="float-end">$12.00</span>
								</small>
							</li>
							<li class="list-group-item">
								<small class="text-muted">
									<b>Color:</b><span class="float-end">Red</span>
								</small>
							</li>
							<li class="list-group-item">
								<small class="text-muted">
									<b>Size:</b><span class="float-end">XL</span>
								</small>
							</li>
						</ul>
						<div class="card-body">
							<a href="./product.html" class="btn btn-outline-primary">View Product</a>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
					<div class="card shadow rounded-0">
						<a href="./product.html">
							<img src="https://dummyimage.com/285x140/f8f9fa/6c757d.jpg" class="card-img-top" alt="Product title">
						</a>
						<div class="card-body">
							<a href="./product.html" class="text-dark text-decoration-none">
								<h5 class="card-title text-capitalize">Product Title</h5>
							</a>
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<small class="text-muted">
									<b>Price:</b><span class="float-end">$12.00</span>
								</small>
							</li>
							<li class="list-group-item">
								<small class="text-muted">
									<b>Color:</b><span class="float-end">Red</span>
								</small>
							</li>
							<li class="list-group-item">
								<small class="text-muted">
									<b>Size:</b><span class="float-end">XL</span>
								</small>
							</li>
						</ul>
						<div class="card-body">
							<a href="./product.html" class="btn btn-outline-primary">View Product</a>
						</div>
					</div>
				</div>                    
				<!-- EOF Featured Products List -->
				<div class="col-12 mt-4 text-center">
					<a href="./products.html" class="btn btn-outline-primary">View All Products</a>
				</div>
			</div>
		</div>
	</section>
	<!-- EOF Home Featured Products -->

	<!-- Featured Blogs -->
	<section id="homeFeaturedBlogs" class="home-featured-blogs bg-light py-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3 class="mb-4">Featured Blogs</h3>
					<div class="row">
						<div class="col-md-5">
							<div class="card shadow rounded-0">
								<a href="./blog.html">
									<img src="https://dummyimage.com/550x330/f8f9fa/6c757d.jpg" class="card-img-top" alt="post title">
								</a>
								<div class="card-body">
									<strong class="d-inline-block mb-2 text-primary">Category Name</strong>
									<a href="./blog.html" class="text-dark text-decoration-none">
										<h5 class="card-title text-capitalize mb-0">Post Title</h5>
									</a>
									<div class="mb-1 text-muted">Nov 12</div>
									<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in nunc purus. Cras ut tempus diam, nec convallis mauris. Etiam a mollis odio.</p>
									<a href="./blog.html" class="btn btn-outline-primary">Read More</a>
								</div>
							</div>
						</div>
						<div class="col-md-7">
							<div class="card shadow rounded-0 mb-4">
								<div class="row g-0">
									<div class="col-md-4">
										<a href="./blog.html">
											<img src="https://dummyimage.com/250x250/f8f9fa/6c757d.jpg" class="img-fluid w-100 h-100" alt="post title">
										</a>
									</div>
									<div class="col-md-8">
										<div class="card-body">
											<strong class="d-inline-block mb-2 text-primary">Category Name</strong>
											<a href="./blog.html" class="text-dark text-decoration-none">
												<h5 class="card-title text-capitalize mb-0">Post Title</h5>
											</a>
											<div class="mb-1 text-muted">Nov 12</div>
											<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in nunc purus. Cras ut tempus diam, nec convallis mauris. Etiam a mollis odio.</p>
											<a href="./blog.html" class="btn btn-outline-primary">Read More</a>
										</div>
									</div>
								</div>
							</div>
							<div class="card shadow rounded-0">
								<div class="row g-0">
									<div class="col-md-4">
										<a href="./blog.html">
											<img src="https://dummyimage.com/250x250/f8f9fa/6c757d.jpg" class="img-fluid w-100 h-100" alt="post title">
										</a>
									</div>
									<div class="col-md-8">
										<div class="card-body">
											<strong class="d-inline-block mb-2 text-primary">Category Name</strong>
											<a href="./blog.html" class="text-dark text-decoration-none">
												<h5 class="card-title text-capitalize mb-0">Post Title</h5>
											</a>
											<div class="mb-1 text-muted">Nov 12</div>
											<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in nunc purus. Cras ut tempus diam, nec convallis mauris. Etiam a mollis odio.</p>
											<a href="./blog.html" class="btn btn-outline-primary">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 mt-4 text-center">
							<a href="./blogs.html" class="btn btn-outline-primary">View All Blogs</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- EOF Featured Blogs -->

	<!-- Newsletter -->
	<section id="newsLetter" class="catalog-newsletter my-5">
		<div class="container">
			<div class="py-5 bg-light text-center">
				<div class="row">
					<div class="col-11 col-md-8 col-lg-5 mx-auto">
						<span>Subscribe to Our</span>
						<h3>Newsletter</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in nunc purus. Cras ut tempus diam, nec convallis mauris.</p>
						<form method="post">
							<div class="input-group mb-3">
								<input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="button-addon2">
								<span class="input-group-text">
									<button class="btn" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- EOF Newsletter -->
		<?php
	endwhile;
get_footer();
