<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

get_header();
/*
* Include the Post-Type-specific template for the content.
* If you want to override this in a child theme, then include a file
* called content-___.php (where ___ is the Post Type name) and that will be used instead.
*/
get_template_part( 'template-parts/content', get_post_type() );
get_footer();
