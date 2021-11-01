<?php
/**
 * Template part for displaying phone app in template-home.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

/* List of all apps */
$catalog_site_paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
$catalog_site_args  = array(
	'post_type'  => 'phone-apps',
	'paged'      => $catalog_site_paged,
	'order'      => 'DESC',
	'orderby'    => 'ID',
);
if ( isset( $_REQUEST['operating_system'] ) && '' !== $_REQUEST['operating_system'] ) {
	$catalog_site_args['tax_query'] = array(
		array(
			'taxonomy' => 'operating-systems',
			'field'    => 'slug',
			'terms'    => wp_unslash( $_REQUEST['operating_system'] ),
		),
	);
}
$catalog_site_phone_apps = new WP_Query( $catalog_site_args );
if ( $catalog_site_phone_apps->have_posts() ) { 
	?>
<div id="phoneAppsList" class="row g-0 mb-3">
	<?php 
	while ( $catalog_site_phone_apps->have_posts() ) :
		$catalog_site_phone_apps->the_post();
		get_template_part( 'template-parts/content', 'phone-app' );
	endwhile;

	/* pagination */
	$catalog_site_big                 = 999999999; // need an unlikely integer.
	$catalog_site_paginate_links_args = array(
		'base'      => str_replace( 
			$catalog_site_big, 
			'%#%', 
			esc_url( get_pagenum_link( $catalog_site_big ) )
		),
		'format'    => '?paged=%#%',
		'current'   => max( 1, $catalog_site_paged ),
		'total'     => $catalog_site_phone_apps->max_num_pages,
	);
	echo paginate_links( $catalog_site_paginate_links_args );
	/* EOF pagination */

	wp_reset_postdata();
	?>
</div>
<?php } /* EOF List of all apps */ else { ?>
	<div class="alert alert-warning" role="alert">
		<?php esc_html_e( 'Phone Apps Not Found', 'kit_theme' ); ?>
	</div>
	<?php 
} 
