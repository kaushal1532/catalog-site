<?php
/**
 * Template part for displaying post card in home page and blogs page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

$args = array(
	'banner_title' => 'Blogs'
);
if( is_category() ) {
    $category = get_category( get_query_var( 'cat' ) );
    $args['banner_title'] = "Category";
    if ( ! is_wp_error( $category ) && !empty($category) ) {
        $args['banner_title'].= ": ".$category->name;
    }
}
get_template_part( 'template-parts/page', 'banner', $args );
?>
<!-- Page Content -->
<section id="pageContent" class="page-content py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?php 
                    if ( have_posts() ) { 
                        if( is_archive() || is_home() ) {
                            //archive page
                    ?>
                            <!-- Blog List Section -->
                            <div class="row blogs-data">
                                <?php 
                                    global $wp_query;
                                    $query_filter_data = "";
                                    if( isset($wp_query->query) && !empty($wp_query->query) ) {
                                        $query_filter_data = json_encode($wp_query->query);
                                    }
                                    /* Start the Loop */
                                    while ( have_posts() ) :
                                        the_post();
                                ?>
                                <div class="col-12">
                                    <?php get_template_part( 'template-parts/post', 'card' ); ?>
                                </div>
                                <?php 
                                    endwhile;
                                ?>
                            </div>
                            <!-- EOF Blog List Section -->
                
                            <!-- Load More -->
                            <div class="text-center">
                                <a href="#" class="btn btn-outline-primary load-more-blogs" data-query_filter='<?php echo $query_filter_data; ?>'><?php _e( 'Load More', 'kit_theme' ); ?></a>
                            </div>
                            <!-- EOF Load More -->
                    <?php 
                        } else {
                            //single page

                        }
                    } else {
                        get_template_part( 'template-parts/content', 'none' );			
                    } 
                ?>

            </div>
             <!-- Sidebar -->
             <div class="col-md-3 mb-5 mb-md-0">
                <div class="position-sticky" style="top: 2rem;">
                    <?php get_sidebar(); ?>
                </div>
            </div>
            <!-- EOF Sidebar -->
        </div>
    </div>
</section>
<!-- EOF Page Content -->