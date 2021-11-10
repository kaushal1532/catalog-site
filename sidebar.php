<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package catalog_site
 */

 $args = array(
	'taxonomy' => 'category',
	'hide_empty' => false
 );
 $categories = get_terms($args);
?>

<!-- Search -->
<div class="card mb-3 rounded-0">
	<div class="card-header bg-light"><?php _e( 'Search', 'kit_theme' ); ?></div>
	<div class="card-body">
		<form method="get" class="input-group ">
			<input type="text" name="s" class="form-control" placeholder="<?php _e( 'Enter Text', 'kit_theme' ); ?>" aria-describedby="button-addon2">
			<input type="hidden" name="post_type" value="post">
			<span class="input-group-text bg-light">
				<button class="btn m-0 p-0" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
			</span>
		</form>
	</div>
</div>
<!-- EOF Search -->

<?php 
	if ( ! is_wp_error( $categories ) && ! empty($categories) ) {
?>
<!-- Category Filter -->
<div class="card mb-3 rounded-0">
	<div class="card-header bg-light">
		<?php _e( 'Category', 'kit_theme' ); ?>
	</div>
	<div class="list-group border-0 rounded-0">
		<?php 
			foreach ( $categories as $category ) {
		?>
		<a href="<?php echo get_term_link( $category ); ?>" class="list-group-item list-group-item-action"><?php echo $category->name ?></a>
		<?php 
			} 
		?>
	</div>
</div>
<!-- EOF Category Filter -->
<?php
	}
if ( is_active_sidebar( 'sidebar-1' ) ) {
	?>
	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->
	<?php
}