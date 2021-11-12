<?php
/**
 * Template part for displaying post card in home page and blogs page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */


$is_featured = (isset($args['post_card_type']) && $args['post_card_type']=="featured") ? true : false;

$post_image_args = array(
    "class" => ($is_featured) ? "card-img-top rounded-0" : "img-fluid w-100 h-100"
);

$post_size = array(250, 250);
if ( $is_featured ) {
    $post_size = array(550, 330);
}

$post_id = get_the_ID();
$post_link = get_the_permalink();
$post_image = get_the_post_thumbnail( $post_id, $post_size, $post_image_args );
$post_category_terms = get_the_terms( $post_id, 'category' );
$post_category = array();
if( !is_wp_error( $post_category_terms ) && !empty( $post_category_terms ) ) {
    foreach ( $post_category_terms as $post_category_term ) {
        $post_category[] = $post_category_term->name;
    }
    $post_category = implode( ", ", $post_category );
}
$post_title = get_the_title();
$post_data = get_the_date( 'M y' );
$post_excerpt = get_the_excerpt();
if( strlen( $post_excerpt ) > 100 ) {
    $post_excerpt = substr( $post_excerpt, 0, 97 )."...";
}
?>

<div class="card shadow rounded-0 mb-4">
    <?php if( !$is_featured ) { ?>
    <div class="row g-0">
        <div class="col-md-4">
            <?php } ?>
            <a href="<?php echo $post_link; ?>">
                <?php echo $post_image; ?>
            </a>
            <?php if( !$is_featured ) { ?>
        </div>
        <div class="col-md-8">
        <?php } ?>
            <div class="card-body">
                <?php if ( $post_category!=="" ) { ?>
                <strong class="d-inline-block mb-2 text-primary"><?php echo $post_category; ?></strong>
                <?php } ?>
                <a href="<?php echo $post_link; ?>" class="text-dark text-decoration-none">
                    <h5 class="card-title text-capitalize mb-0"><?php echo $post_title; ?></h5>
                </a>
                <div class="mb-1 text-muted"><?php echo $post_data; ?></div>
                <p class="card-text"><?php echo $post_excerpt; ?></p>
                <a href="<?php echo $post_link; ?>" class="btn btn-outline-primary"><?php _e( 'Read More', 'kit_theme' ); ?></a>
            </div>
            <?php if( !$is_featured ) { ?>
        </div>
    </div>
    <?php } ?>
</div>