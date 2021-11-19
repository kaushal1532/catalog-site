<?php
/**
 * Template part for displaying product card in home page and products page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

$product_link = get_the_permalink();
$product_id = get_the_ID();

$product_image_args = (isset($args['product_image_args']) && $args['product_image_args']!="") ? $args['product_image_args'] : array(
    "class" => "card-img-top rounded-0"
);
$product_default_image = (isset($args['product_default_image']) && $args['product_default_image']!="") ? $args['product_default_image'] : "";
$product_title_length = (isset($args['product_title_length']) && $args['product_title_length']!="") ? $args['product_title_length'] : 20;
$product_excerpt_length = (isset($args['product_excerpt_length']) && $args['product_excerpt_length']!="") ? $args['product_excerpt_length'] : 60;
$product_currency = (isset($args['product_currency']) && $args['product_currency']!="") ? $args['product_currency'] : "$";
$product_col_class = (isset($args['product_col_class']) && $args['product_col_class']!="") ? $args['product_col_class'] : "col-md-6 col-lg-3 mb-4 mb-lg-0";



$product_title = get_the_title();
if( strlen( $product_title ) > $product_title_length ) {
    $product_title = substr( $product_title, 0, $product_title_length-3 )."...";
}

$product_image = get_the_post_thumbnail( $product_id, 'product-small-thumb', $product_image_args );
if ( $product_image=="" ) {
    $product_image = $product_default_image;
}

$product_excerpt = get_the_excerpt();
if( strlen( $product_excerpt ) > $product_excerpt_length ) {
    $product_excerpt = substr( $product_excerpt, 0, $product_excerpt_length-3 )."...";
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
?>
<div class="<?php echo $product_col_class; ?>">
    <div class="card shadow rounded-0">
        <a href="<?php echo $product_link; ?>">
            <?php echo $product_image; ?>
        </a>
        <div class="card-body">
            <a href="<?php echo $product_link; ?>" class="text-dark text-decoration-none">
                <h5 class="card-title text-capitalize"><?php echo $product_title; ?></h5>
            </a>
            <p class="card-text"><?php echo $product_excerpt; ?></p>
        </div>
        <ul class="list-group list-group-flush">
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
        <div class="card-body">
            <a href="<?php echo $product_link; ?>" class="btn btn-outline-primary"><?php _e( 'View Product', 'kit_theme' ); ?></a>
        </div>
    </div>
</div>
