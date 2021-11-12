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
    $args['banner_title'] = __( 'Category', 'kit_theme' );
    if ( ! is_wp_error( $category ) && !empty($category) ) {
        $args['banner_title'].= ": ".$category->name;
    }
} elseif ( is_search() ) {
    $args['banner_title'] = __( 'Search Results for:', 'kit_theme' ).' '. get_search_query();
} else {
    $args['banner_title'] = get_the_title();
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
                        if( is_archive() || is_home() || is_search() ) {
                            //archive page
                    ?>
                            <!-- Blog List Section -->
                            <div class="row blogs-data">
                                <?php 
                                    global $wp_query;
                                    $query_filter_data = "";
                                    $max_num_pages = $wp_query->max_num_pages;
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
                
                            <?php if ( $max_num_pages>1 ) { ?>
                            <!-- Load More -->
                            <div class="text-center">
                                <a href="#" class="btn btn-outline-primary load-more-blogs" data-query_filter='<?php echo $query_filter_data; ?>'><?php _e( 'Load More', 'kit_theme' ); ?></a>
                            </div>
                            <!-- EOF Load More -->
                            <?php } ?>
                    <?php 
                        } else {
                            //single page
                            the_post_thumbnail( array(855,350), array( "class" => "img-fluid w-100 mb-3" ) );
                            $categories = get_categories();
                            $post_category = array();
                            if( !is_wp_error( $categories ) && !empty( $categories ) ) {
                                foreach ( $categories as $category ) {
                                    $post_category[] = $category->name;
                                }
                                $post_category = implode( ", ", $post_category );
                            }
                            if ( !empty($post_category) ) {
                            ?>
                            <strong class="d-inline-block mb-2 text-primary"><?php echo $post_category; ?></strong>
                            <?php } ?>
                            <div class="mb-1 text-muted"><?php echo get_the_date( 'M y' );?></div>
                            <?php
                            the_content();
                            the_post_navigation(
                                array(
                                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'kit_theme' ) . '</span> <span class="nav-title">%title</span>',
                                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'kit_theme' ) . '</span> <span class="nav-title">%title</span>',
                                )
                            );
                
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
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