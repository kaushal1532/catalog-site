<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package catalog_site
 */

get_header();
$args = array(
    'banner_title' => __( 'Product', 'kit_theme' )
);
get_template_part( 'template-parts/page', 'banner', $args );
?>
<!-- Page Content -->
<section id="pageContent" class="page-content py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php 
                    if ( have_posts() ) { 
                        $product_image_args = array(
                            "class" => 'img-fluid mb-3'
                        );
                        $product_default_image = get_field( 'product_default_image', 'option' );
						if ( $product_default_image!="" ) {
							$product_default_image = wp_get_attachment_image( $product_default_image, 'product-large-thumb', false, $product_image_args );
						}
                        while ( have_posts() ) {
                            the_post();
                            $product_id = get_the_ID();
                           
                            $product_image = get_the_post_thumbnail( $product_id, 'product-large-thumb', $product_image_args );
                            if ( $product_image=="" ) {
                                $product_image = $product_default_image;
                            }

                            $product_price = get_field( 'price', $product_id );
                            if( $product_price !="" ) {
                                $product_price = $product_currency.$product_price;
                            }

                            $product_colors_terms = get_the_terms( $product_id, 'product-color' );
                            $product_colors = array();
                            if( !is_wp_error( $product_colors_terms ) && !empty( $product_colors_terms ) ) {
                                foreach ( $product_colors_terms as $product_color_term ) {
                                    $product_colors[] = $product_color_term->name;
                                }
                                $product_colors = implode( ", ", $product_colors );
                            }

                            $product_sizes_terms = get_the_terms( $product_id, 'product-size' );
                            $product_sizes = array();
                            if( !is_wp_error( $product_sizes_terms ) && !empty( $product_sizes_terms ) ) {
                                foreach ( $product_sizes_terms as $product_color_term ) {
                                    $product_sizes[] = $product_color_term->name;
                                }
                                $product_sizes = implode( ", ", $product_sizes );
                            }

                            $product_category_terms = get_the_terms( $product_id, 'product-category' );
                            $product_category = array();
                            if( !is_wp_error( $product_category_terms ) && !empty( $product_category_terms ) ) {
                                foreach ( $product_category_terms as $product_color_term ) {
                                    $product_category[] = $product_color_term->name;
                                }
                                $product_category = implode( ", ", $product_category );
                            }
                           
                ?>
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-md-8">
                        <?php echo $product_image; ?>
                    </div>
                    <!-- EOF Product Image -->

                    <!-- Product Meta Data -->
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h1><?php the_title(); ?></h1>
                        <h5 class="text-muted"><?php echo $product_category; ?></h5>
                        <p><?php the_excerpt(); ?></p>
                        <ul class="list-group rounded-0 mb-3">
                            <li class="list-group-item">
                                <small class="text-muted">
                                    <b><?php _e( 'Price', 'kit_theme' )?>:</b><span class="float-end"><?php echo $product_price; ?></span>
                                </small>
                            </li>
                            <?php if ( $product_colors!="" ) { ?>
                            <li class="list-group-item">
                                <small class="text-muted">
                                    <b><?php _e( 'Color', 'kit_theme' )?>:</b><span class="float-end"><?php echo $product_colors; ?></span>
                                </small>
                            </li>
                            <?php } if ( $product_sizes!="" ) { ?>
                            <li class="list-group-item">
                                <small class="text-muted">
                                    <b><?php _e( 'Size', 'kit_theme' )?>:</b><span class="float-end"><?php echo $product_sizes; ?></span>
                                </small>
                            </li>
                            <?php } ?>
                        </ul>
                        
                       
                       
                     <a href="<?php echo get_page_url_by_template( 'templates/template-contact-us.php' ); ?>" class="btn btn-outline-primary"><?php _e( 'Inquiry Now', 'kit_theme' ); ?></a>
                     
                    </div>


                  
                    <!-- EOF Product Meta Data -->

                    <!-- Product Description -->
                    <div class="col-lg-8 mx-auto">
                        <h3><?php _e( 'Description', 'kit_theme' ); ?></h3>
                        <?php the_content(); ?>
                    </div>
                    <!-- EOF Product Description -->
                </div>
                <?php
             
          
                        } 
                    } else {
                        get_template_part( 'template-parts/content', 'none' );
                    }                    
                ?>
                
                
            </div>
        </div>
    </div>
</section>
<!-- EOF Page Content -->
<?php
get_footer();
