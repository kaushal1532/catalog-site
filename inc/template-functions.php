<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package catalog_site
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function catalog_site_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'catalog_site_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function catalog_site_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'catalog_site_pingback_header' );

/**
 * Register a custom post type called "product".
 *
 * @see get_post_type_labels() for label keys.
 */
function catalog_site_product_init() {
    $labels = array(
        'name'                  => _x( 'Products', 'Post type general name', 'kit_theme' ),
        'singular_name'         => _x( 'Product', 'Post type singular name', 'kit_theme' ),
        'menu_name'             => _x( 'Products', 'Admin Menu text', 'kit_theme' ),
        'name_admin_bar'        => _x( 'Product', 'Add New on Toolbar', 'kit_theme' ),
        'add_new'               => __( 'Add New', 'kit_theme' ),
        'add_new_item'          => __( 'Add New Product', 'kit_theme' ),
        'new_item'              => __( 'New Product', 'kit_theme' ),
        'edit_item'             => __( 'Edit Product', 'kit_theme' ),
        'view_item'             => __( 'View Product', 'kit_theme' ),
        'all_items'             => __( 'All Products', 'kit_theme' ),
        'search_items'          => __( 'Search Products', 'kit_theme' ),
        'parent_item_colon'     => __( 'Parent Products:', 'kit_theme' ),
        'not_found'             => __( 'No Products found.', 'kit_theme' ),
        'not_found_in_trash'    => __( 'No Products found in Trash.', 'kit_theme' ),
        'featured_image'        => _x( 'Product Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'kit_theme' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'kit_theme' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'kit_theme' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'kit_theme' ),
        'archives'              => _x( 'Product archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'kit_theme' ),
        'insert_into_item'      => _x( 'Insert into Product', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'kit_theme' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Product', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'kit_theme' ),
        'filter_items_list'     => _x( 'Filter Products list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'kit_theme' ),
        'items_list_navigation' => _x( 'Products list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'kit_theme' ),
        'items_list'            => _x( 'Products list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'kit_theme' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'product' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
		'menu_icon'			 => 'dashicons-cart',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );
 
    register_post_type( 'product', $args );
}
 
add_action( 'init', 'catalog_site_product_init' );

/**
 * Create taxonomies, product category the post type "product".
 *
 * @see register_post_type() for registering custom post types.
 */
function catalog_site_product_taxonomies() {
    
	/* Product Categorie taxonomy */
    $labels = array(
        'name'              => _x( 'Product Categories', 'taxonomy general name', 'kit_theme' ),
        'singular_name'     => _x( 'Product Category', 'taxonomy singular name', 'kit_theme' ),
        'search_items'      => __( 'Search Product Categories', 'kit_theme' ),
        'all_items'         => __( 'All Product Categories', 'kit_theme' ),
        'parent_item'       => __( 'Parent Product Category', 'kit_theme' ),
        'parent_item_colon' => __( 'Parent Product Category:', 'kit_theme' ),
        'edit_item'         => __( 'Edit Product Category', 'kit_theme' ),
        'update_item'       => __( 'Update Product Category', 'kit_theme' ),
        'add_new_item'      => __( 'Add New Product Category', 'kit_theme' ),
        'new_item_name'     => __( 'New Product Category Name', 'kit_theme' ),
        'menu_name'         => __( 'Product Categories', 'kit_theme' ),
    );
 
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-category' ),
    );
 
    register_taxonomy( 'product-category', 'product', $args );
	/* EOF Product Categorie taxonomy */

	unset($labels);
	unset($args);

	/* Product Product Size taxonomy */
    $labels = array(
        'name'                       => _x( 'Product Sizes', 'taxonomy general name', 'kit_theme' ),
        'singular_name'              => _x( 'Product Size', 'taxonomy singular name', 'kit_theme' ),
        'search_items'               => __( 'Search Product Sizes', 'kit_theme' ),
        'popular_items'              => __( 'Popular Product Sizes', 'kit_theme' ),
        'all_items'                  => __( 'All Product Sizes', 'kit_theme' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Product Size', 'kit_theme' ),
        'update_item'                => __( 'Update Product Size', 'kit_theme' ),
        'add_new_item'               => __( 'Add New Product Size', 'kit_theme' ),
        'new_item_name'              => __( 'New Product Size Name', 'kit_theme' ),
        'separate_items_with_commas' => __( 'Separate Product Sizes with commas', 'kit_theme' ),
        'add_or_remove_items'        => __( 'Add or remove Product Sizes', 'kit_theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used Product Sizes', 'kit_theme' ),
        'not_found'                  => __( 'No Product Sizes found.', 'kit_theme' ),
        'menu_name'                  => __( 'Product Sizes', 'kit_theme' ),
    );
 
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'product-size' ),
    );
 
    register_taxonomy( 'product-size', 'product', $args );
	/* EOF Product Size taxonomy */

	unset($labels);
	unset($args);

	/* Product Product Color taxonomy */
    $labels = array(
        'name'                       => _x( 'Product Colors', 'taxonomy general name', 'kit_theme' ),
        'singular_name'              => _x( 'Product Color', 'taxonomy singular name', 'kit_theme' ),
        'search_items'               => __( 'Search Product Colors', 'kit_theme' ),
        'popular_items'              => __( 'Popular Product Colors', 'kit_theme' ),
        'all_items'                  => __( 'All Product Colors', 'kit_theme' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Product Color', 'kit_theme' ),
        'update_item'                => __( 'Update Product Color', 'kit_theme' ),
        'add_new_item'               => __( 'Add New Product Color', 'kit_theme' ),
        'new_item_name'              => __( 'New Product Color Name', 'kit_theme' ),
        'separate_items_with_commas' => __( 'Separate Product Colors with commas', 'kit_theme' ),
        'add_or_remove_items'        => __( 'Add or remove Product Colors', 'kit_theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used Product Colors', 'kit_theme' ),
        'not_found'                  => __( 'No Product Colors found.', 'kit_theme' ),
        'menu_name'                  => __( 'Product Colors', 'kit_theme' ),
    );
 
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'product-color' ),
    );
 
    register_taxonomy( 'product-color', 'product', $args );
	/* EOF Product Color taxonomy */
}

add_action( 'init', 'catalog_site_product_taxonomies', 0 );

function catalog_site_theme_setup() {
    add_image_size( 'product-small-thumb', 285, 140, true );
    add_image_size( 'product-large-thumb', 735, 450, true );
}

add_action( 'after_setup_theme', 'catalog_site_theme_setup' );

function catalog_site_theme_option_page() {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

add_action( 'init', 'catalog_site_theme_option_page' );

add_action("wp_ajax_load_more_blogs", "load_more_blogs_callback");
add_action("wp_ajax_nopriv_load_more_blogs", "load_more_blogs_callback");

function load_more_blogs_callback() {
    $args = array(
        "paged" => $_REQUEST['paged']
    );
    if ( isset($_REQUEST['query_filter']) && $_REQUEST['query_filter']!="" ) {
        $query_filter = $_REQUEST['query_filter'];
        $args = array_merge($args, $query_filter);
    }
    $wp_query = new WP_Query($args);

    if ( !$wp_query->have_posts() ) {
        die();
    }
    ob_start();
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        ?>
        <div class="col-12">
            <?php echo get_template_part( 'template-parts/post', 'card' ); ?>
        </div>
        <?php
    }
    $html = ob_get_contents();
    ob_end_clean();
    die($html);
}