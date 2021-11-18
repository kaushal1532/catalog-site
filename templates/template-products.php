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

    /* get product categories, color and size in one function */
    $product_terms = get_terms( array(
        'taxonomy' => array(
            'product-category',
            'product-size',
            'product-color'
        )
    ) );
    $product_category = $product_size = $product_color = array();
    if ( !is_wp_error( $product_terms ) && !empty( $product_terms ) ) {
        foreach ($product_terms as $product_term) {
            if ( isset($product_term->taxonomy) ) {
                switch ($product_term->taxonomy) {
                    case 'product-category':
                        $product_category[] = $product_term;
                    break;
                    case 'product-size':
                        $product_size[] = $product_term;
                    break;
                    case 'product-color':
                        $product_color[] = $product_term;
                    break;
                }
            }
        }
    }
    /* EOF get product categories, color and size in one function */

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array(
		"post_type" => "product",
        "orderby"   => "ID",
        "order"     => "DESC",
        "paged"     => $paged
	);

    /* Filter process */
    $is_product_filter = ( isset( $_GET['product_filter'] ) && $_GET['product_filter'] == "1" ) ? true : false;
    $filter_url_args = array();
    if( $is_product_filter ) {

        /* Product Search args */
        $product_search = ( isset( $_GET['product_search'] ) && $_GET['product_search'] != "" ) ? $_GET['product_search'] : false;
        if ( $product_search !== false ) {
            $args["s"] = $product_search;
            $filter_url_args['product_search'] = $product_search;
        }
        /* EOF Product Search args */

        /* Product price filter args */
        $price_min = ( isset( $_GET['price_min'] ) && $_GET['price_min'] != "" ) ? $_GET['price_min'] : false;
        $price_max = ( isset( $_GET['price_max'] ) && $_GET['price_max'] != "" ) ? $_GET['price_max'] : false;

        if ( $price_min !== false || $price_max !== false ) {
            $args["meta_query"] = array(
                array(
                    'key'       => 'price',
                    'type'      => 'numeric',
                )
            );

            if ( $price_min !== false && $price_max === false ) {
                $args["meta_query"][0]["value"] = $price_min;
                $args["meta_query"][0]["compare"] = '<=';
                $filter_url_args['price_min'] = $price_min;
            } elseif( $price_min === false && $price_max !== false ) {
                $args["meta_query"][0]["value"] = $price_max;
                $args["meta_query"][0]["compare"] = '>=';
                $filter_url_args['price_max'] = $price_max;
            } elseif( $price_min !== false && $price_max !== false ) {
                $args["meta_query"][0]["value"] = array(
                    $price_min,
                    $price_max
                );
                $args["meta_query"][0]["compare"] = 'BETWEEN';
                $filter_url_args['price_min'] = $price_min;
                $filter_url_args['price_max'] = $price_max;
            }
        }
        /* EOF Product price filter args */

        /* Product categories filter args */
        $product_category_filter = ( isset( $_GET['product_category'] ) && ! empty( $_GET['product_category'] ) ) ? $_GET['product_category'] : false;
        $product_category_tax_query = array();
        if ( $product_category_filter !== false ) {
            $product_category_tax_query = array(
                'taxonomy' => 'product-category',
                'field'    => 'slug',
                'terms'    => $product_category_filter
            );
            $filter_url_args['product_category'] = $product_category_filter;
        }
        /* EOF Product categories filter args */

        /* Product color filter args */
        $product_color_filter = ( isset( $_GET['product_color'] ) && ! empty( $_GET['product_color'] ) ) ? $_GET['product_color'] : false;
        $product_color_tax_query = array();
        if ( $product_color_filter !== false ) {
            $product_color_tax_query = array(
                'taxonomy' => 'product-color',
                'field'    => 'slug',
                'terms'    => $product_color_filter
            );
            $filter_url_args['product_color'] = $product_color_filter;
        }
        /* EOF Product color filter args */

        /* Product size filter args */
        $product_size_filter = ( isset( $_GET['product_size'] ) && ! empty( $_GET['product_size'] ) ) ? $_GET['product_size'] : false;
        $product_size_tax_query = array();
        if ( $product_size_filter !== false ) {
            $product_size_tax_query = array(
                'taxonomy' => 'product-size',
                'field'    => 'slug',
                'terms'    => $product_size_filter
            );
            $filter_url_args['product_size'] = $product_size_filter;
        }
        /* EOF Product size filter args */

        /* Apply tax query in args */
        if ( ! empty( $product_category_tax_query ) || ! empty( $product_color_tax_query ) || ! empty( $product_size_tax_query ) ) {
            if ( ! empty( $product_category_tax_query ) ) {
                $args['tax_query'][] = $product_category_tax_query;
            }

            if ( ! empty( $product_color_tax_query ) ) {
                $args['tax_query'][] = $product_color_tax_query;
            }

            if ( ! empty( $product_size_tax_query ) ) {
                $args['tax_query'][] = $product_size_tax_query;
            }
            
            if ( count( $args['tax_query'] ) > 1 ) {
                $args['tax_query']['relation'] = 'AND';
            }
        }
        /* EOF Apply tax query in args */

    }
    /* EOF Filter process */

    /* Sorting process */
    $product_sort = ( isset( $_GET['product_sort'] ) && ( $_GET['product_sort'] == "price_low_to_high" || $_GET['product_sort'] == "price_high_to_low" ) ) ? $_GET['product_sort'] : false;
    if ( $product_sort !== false ) {
        $args['orderby'] = "meta_value_num";
        $args['meta_key'] = "price";
        $args['order'] = ( $product_sort == "price_high_to_low" ) ? 'DESC' : 'ASC';
    }
    /* EOF Sorting process */

	$products = new WP_Query( $args );

    $big = 999999999; // need an unlikely integer
    $products_paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $products->max_num_pages,
        'next_text' => '<span class="page-link"><i class="bi bi-chevron-compact-right"></i></span>',
        'prev_text' => '<span class="page-link"><i class="bi bi-chevron-compact-left"></i></span>',
        'before_page_number' => '<span class="page-link">',
        'after_page_number' => '</span>',
        'type' => 'array'
    ) );

	while ( have_posts() ) :
		the_post();
			$post_id = get_the_ID();
            $page_url = get_permalink( $post_id );
            get_template_part( 'template-parts/page', 'banner' );
?>

        <!-- Page Content -->
        <section id="pageContent" class="page-content py-5">
            <div class="container">
                <div class="row">
                    <!-- Products Sidebar -->
                    <div class="col-md-3 mb-5 mb-md-0">
                        <h3 class="mb-4"><?php _e( 'Filter By', 'kit_theme' ); ?></h3>

                        <form action="<?php echo $page_url; ?>" method="get">

                            <!-- Product Search -->
                            <div class="card mb-3 rounded-0">
                                <div class="card-header bg-light"><?php _e( 'Product Search', 'kit_theme' ); ?></div>
                                <div class="card-body">
                                    <input type="text" class="form-control" name="product_search" placeholder="<?php _e( 'Enter Product Search', 'kit_theme' ); ?>" value="<?php echo ( isset($filter_url_args['product_search']) ) ? $filter_url_args['product_search'] : ''; ?>" >
                                </div>
                              </div>
                            <!-- EOF Product Search -->

                            <!-- Price Filter -->
                            <div class="card mb-3 rounded-0">
                                <div class="card-header bg-light">
                                <?php _e( 'Price', 'kit_theme' ); ?>
                                </div>
                                <div class="card-body">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="price_min" placeholder="<?php _e( 'Min', 'kit_theme' ); ?>" value="<?php echo ( isset($filter_url_args['price_min']) ) ? $filter_url_args['price_min'] : ''; ?>">
                                        <input type="number" class="form-control" name="price_max" placeholder="<?php _e( 'Max', 'kit_theme' ); ?>" value="<?php echo ( isset($filter_url_args['price_max']) ) ? $filter_url_args['price_max'] : ''; ?>">
                                    </div>
                                </div>
                              </div>
                            <!-- EOF Price Filter -->

                            <?php if ( isset( $product_category ) && !empty( $product_category ) ) { ?>
                            <!-- Category Filter -->
                            <div class="card mb-3 rounded-0">
                                <div class="card-header bg-light">
                                    <?php _e( 'Category', 'kit_theme' ); ?>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <?php 
                                        foreach ($product_category as $term) {
                                            $is_checked = "";
                                            if ( isset( $filter_url_args['product_category'] ) && in_array( $term->slug, $filter_url_args['product_category'] )) {
                                                $is_checked = 'checked="checked"';
                                            }
                                    ?>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" name="product_category[]" value="<?php echo $term->slug ?>" <?php echo $is_checked; ?>>
                                        <?php echo $term->name ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <!-- EOF Category Filter -->
                            <?php } if ( isset( $product_color ) && !empty( $product_color ) ) { ?>
                            <!-- Color Filter -->
                            <div class="card mb-3 rounded-0">
                                <div class="card-header bg-light"><?php _e( 'Color', 'kit_theme' ); ?></div>
                                <ul class="list-group list-group-flush">
                                    <?php 
                                        foreach ($product_color as $term) {
                                            $is_checked = "";
                                            if ( isset( $filter_url_args['product_color'] ) && in_array( $term->slug, $filter_url_args['product_color'] )) {
                                                $is_checked = 'checked="checked"';
                                            }
                                    ?>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" name="product_color[]" value="<?php echo $term->slug ?>" <?php echo $is_checked; ?>>
                                        <?php echo $term->name ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <!-- EOF Color Filter -->
                            <?php } if ( isset( $product_size ) && !empty( $product_size ) ) { ?>
                            <!-- Size Filter -->
                            <div class="card mb-3 rounded-0">
                                <div class="card-header bg-light"><?php _e( 'Size', 'kit_theme' ); ?></div>
                                <ul class="list-group list-group-flush">
                                    <?php 
                                        foreach ($product_size as $term) {
                                            $is_checked = "";
                                            if ( isset( $filter_url_args['product_size'] ) && in_array( $term->slug, $filter_url_args['product_size'] )) {
                                                $is_checked = 'checked="checked"';
                                            }
                                    ?>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" name="product_size[]" value="<?php echo $term->slug ?>" <?php echo $is_checked; ?>>
                                        <?php echo $term->name ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <!-- EOF Size Filter -->
                            <?php } ?>

                            <button type="submit" class="btn btn-outline-primary"><?php _e( 'Apply Filter', 'kit_theme' ); ?></button>
                            <input type="hidden" name="product_filter" value="1">
                            <?php 
                                foreach ($_GET as $key => $value) {
                                    $not_allowed_url_keys = array(
                                        'product_filter',
                                        'product_search',
                                        'price_min',
                                        'price_max',
                                        'product_category',
                                        'product_color',
                                        'product_size'
                                    );
                                    if ( in_array( $key, $not_allowed_url_keys ) ) {
                                        continue;
                                    }
                                    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
                                }
                            ?>
                        </form>
                    </div>
                    <!-- EOF Products Sidebar -->

                    <!-- Products List Section -->
                    <div class="col-md-9">
                        <!-- Sort by -->
                        <h3 class="mb-4 d-inline-block"><?php _e( 'Short By', 'kit_theme' ); ?></h3>
                        <div class="d-inline-block float-end">
                            <div class="dropdown">
                                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php 
                                        switch ($product_sort) {
                                            case 'price_low_to_high':
                                                _e( 'Price Low to High', 'kit_theme' );
                                            break;
                                            case 'price_high_to_low':
                                                _e( 'Price High to Low', 'kit_theme' );
                                            break;
                                            default:
                                                _e( 'Newest First', 'kit_theme' ); 
                                            break;
                                        }
                                    ?>
                                </a>
                                <?php
                                    $sord_url_args = $_GET;
                                    $sord_url_args['product_sort'] = 'price_low_to_high';
                                    $sord_url_price_low_to_high = add_query_arg( $sord_url_args, $page_url );
                                    $sord_url_args['product_sort'] = 'price_high_to_low';
                                    $sord_url_price_high_to_low = add_query_arg( $sord_url_args, $page_url );
                                ?>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item" href="<?php echo $page_url; ?>">
                                            <?php _e( 'Newest First', 'kit_theme' ); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo $sord_url_price_low_to_high; ?>">
                                            <?php _e( 'Price Low to High', 'kit_theme' ); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo $sord_url_price_high_to_low; ?>">
                                            <?php _e( 'Price High to Low', 'kit_theme' ); ?>
                                        </a>
                                    </li>
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

                        <?php 
                            if( isset ( $products_paginate_links ) && ! empty ($products_paginate_links) ) {
                        ?>
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination mb-0">
                                <?php foreach ($products_paginate_links as $paginate_link) { ?>
                                <li class="page-item">
                                    <?php echo $paginate_link; ?>
                                </li>
                                <?php } ?>
                            </ul>
                        </nav>
                        <!-- EOF Pagination -->
                        <?php } ?>
                    </div>
                    <!-- EOF Products List Section -->
                </div>
            </div>
        </section>
        <!-- EOF Page Content -->
<?php
	endwhile;
get_footer();