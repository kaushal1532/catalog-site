<?php
/**
 * Template Name: Products Page
 * 
 * The template for displaying products page
 *
 * This is the template that displays products page by default.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

get_header();

	$args = array(
		"post_type" => "product"
	);
	$products = new WP_Query( $args );

	while ( have_posts() ) :
		the_post();
			$post_id = get_the_ID();
?>
		<!-- Banner -->
        <section id="pageBanner" class="page-banner bg-dark py-4 py-md-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="h3 text-white m-0 p-0">Products</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- EOF Banner -->

        <!-- Page Content -->
        <section id="pageContent" class="page-content py-5">
            <div class="container">
                <div class="row">
                    <!-- Products Sidebar -->
                    <div class="col-md-3 mb-5 mb-md-0">
                        <h3 class="mb-4">Filter By</h3>

                        <form method="get">

                            <!-- Product Search -->
                            <div class="card mb-3 rounded-0">
                                <div class="card-header bg-light">Product Search</div>
                                <div class="card-body">
                                    <input type="text" class="form-control" placeholder="Enter Product Search">
                                </div>
                              </div>
                            <!-- EOF Product Search -->

                            <!-- Price Filter -->
                            <div class="card mb-3 rounded-0">
                                <div class="card-header bg-light">
                                  Price
                                </div>
                                <div class="card-body">
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="Min">
                                        <input type="number" class="form-control" placeholder="Max">
                                    </div>
                                </div>
                              </div>
                            <!-- EOF Price Filter -->

                            <!-- Category Filter -->
                            <div class="card mb-3 rounded-0">
                                <div class="card-header bg-light">
                                  Category
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="">
                                        Category 1
                                    </li>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="">
                                        Category 2
                                    </li>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="">
                                        Category 3
                                    </li>
                                </ul>
                            </div>
                            <!-- EOF Category Filter -->

                            <!-- Color Filter -->
                            <div class="card mb-3 rounded-0">
                                <div class="card-header bg-light">Color</div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                      <input class="form-check-input me-1" type="checkbox" value="">
                                      Red
                                    </li>
                                    <li class="list-group-item">
                                      <input class="form-check-input me-1" type="checkbox" value="">
                                      Green
                                    </li>
                                    <li class="list-group-item">
                                      <input class="form-check-input me-1" type="checkbox" value="">
                                      Blue
                                    </li>
                                </ul>
                            </div>
                            <!-- EOF Color Filter -->

                            <!-- Size Filter -->
                            <div class="card mb-3 rounded-0">
                                <div class="card-header bg-light">Size</div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="">
                                        S
                                    </li>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="">
                                        M
                                    </li>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="">
                                        L
                                    </li>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="">
                                        XL
                                    </li>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="">
                                        XXL
                                    </li>
                                </ul>
                            </div>
                            <!-- EOF Size Filter -->

                            <button type="submit" class="btn btn-outline-primary">Apply Filter</button>
                        </form>
                    </div>
                    <!-- EOF Products Sidebar -->

                    <!-- Products List Section -->
                    <div class="col-md-9">
                        <!-- Sort by -->
                        <h3 class="mb-4 d-inline-block">Short By</h3>
                        <div class="d-inline-block float-end">
                            <div class="dropdown">
                                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                  Newest First
                                </a>
                              
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                  <li><a class="dropdown-item" href="#">Newest First</a></li>
                                  <li><a class="dropdown-item" href="#">Price Low to High</a></li>
                                  <li><a class="dropdown-item" href="#">Price High to Low</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- EOF Sort by -->

                        <!-- Products List Section -->
                        <div class="row">
							<?php 
								if( $products->have_posts() ) {
									$product_image_args = array(
										"class" => "card-img-top rounded-0"
									);
									$product_default_image = get_field( 'product_default_image', 'option' );
									if ( $product_default_image!="" ) {
										$product_default_image = wp_get_attachment_image( $product_default_image, 'product-small-thumb', false, $product_image_args );
									}
			
									$product_title_length = get_field( 'product_title_length', 'option' );
									$product_excerpt_length = get_field( 'product_excerpt_length', 'option' );
									$product_currency = get_field( 'product_currency', 'option' );
			
									$args = array(
										"product_image_args" => $product_image_args,
										"product_default_image" => $product_default_image,
										"product_title_length" => $product_title_length,
										"product_excerpt_length" => $product_excerpt_length,
										"product_currency" => $product_currency,
										"product_col_class" => "col-md-6 col-lg-4 mb-4"
									);
			
									while( $products->have_posts() ) { 
										$products->the_post();
										get_template_part( 'template-parts/product', 'card', $args );
									} 
								} 
								wp_reset_postdata(); 
							?>
                        </div>
                        <!-- EOF Products List Section -->

                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="bi bi-chevron-compact-left"></i></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="bi bi-chevron-compact-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                        <!-- EOF Pagination -->
                    </div>
                    <!-- EOF Products List Section -->
                </div>
            </div>
        </section>
        <!-- EOF Page Content -->
<?php
	endwhile;
get_footer();