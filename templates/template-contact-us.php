<?php
/**
 * Template Name: Contact Us
 * 
 * The template for displaying Contact Us
 *
 * This is the template that displays Contact Us by default.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package catalog_site
 */

get_header();

	while ( have_posts() ) :
		the_post();
			$post_id = get_the_ID();
            $map_iframe = get_field( 'map_iframe', $post_id );
            $contact_us_from_shortcode = get_field( 'contact_us_from_shortcode', $post_id );
            $email = get_field( 'email', 'option' );
            $phone_number = get_field( 'phone_number', 'option' );
            $address = get_field( 'address', 'option' );
            $social_media = get_field( 'social_media', 'option' );
            get_template_part( 'template-parts/page', 'banner' );
?>

    <!-- Page Content -->
    <section id="ContactPageContent" class="contact-page-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <?php if ( $map_iframe != "" ) { ?>
                    <div class="mapouter mb-5">
                        <?php echo $map_iframe; ?>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="mb-4"><?php _e( 'Get In Touch', 'kit_theme' ); ?></h3>
                                    <ul class="list-unstyled mb-5">
                                        <?php if ( $email != "" ) { ?>
                                        <li class="mb-3">
                                            <span class="h4 mb-0 align-bottom d-inline-block" style="width: 30px;"><i class="bi bi-envelope"></i></span>
                                            <a href="mailto:<?php echo $email; ?>" class="text-decoration-none text-dark align-text-bottom"><?php echo $email; ?></a>
                                        </li>
                                        <?php } if ( $phone_number != "" ) { ?>
                                        <li class="mb-3">
                                            <span class="h4 mb-0 align-bottom d-inline-block" style="width: 30px;"><i class="bi bi-telephone"></i></span>
                                            <a href="tel:<?php echo $phone_number; ?>" class="text-decoration-none text-dark align-text-bottom"><?php echo $phone_number; ?></a>
                                        </li>
                                        <?php } if ( ! empty($address) && isset( $address['address_text'] ) && isset( $address['address_map_url'] ) && $address['address_text'] !="" && $address['address_map_url'] !="" ) { ?>
                                        <li>
                                            <span class="h4 mb-0 align-bottom d-inline-block" style="width: 30px;"><i class="bi bi-map"></i></span>
                                            <a href="<?php echo $address['address_map_url']; ?>" target="_blank" class="text-decoration-none text-dark align-text-bottom"><?php echo $address['address_text']; ?></a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <?php if ( !empty($social_media) ) { ?>
                                    <h3 class="mb-4"><?php _e( 'Follow Us', 'kit_theme' ); ?></h3>
                                    <ul class="list-inline">
                                        <?php 
                                            foreach ( $social_media as $data ) { 
                                                if ( !isset( $data['url'] ) || $data['url'] =="" ) {
                                                    continue;
                                                }
                                                $social_media_url = $data['url'];
                                                $social_media_icon_class = "";
                                                switch ( $data['type'] ) {
                                                    case "facebook":
                                                        $social_media_icon_class = "bi bi-facebook";
                                                    break;
                                                    case "instagram":
                                                        $social_media_icon_class = "bi bi-instagram";
                                                    break;
                                                    case "twitter":
                                                        $social_media_icon_class = "bi bi-twitter";
                                                    break;
                                                    case "linkedin":
                                                        $social_media_icon_class = "bi bi-linkedin";
                                                    break;
                                                }
                                        ?>
                                        <li class="list-inline-item">
                                            <a href="<?php echo $social_media_url; ?>" target="_blank" class="h4 m-0 text-decoration-none text-dark"><i class="<?php echo $social_media_icon_class; ?>"></i></a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <?php } ?>
                                </div>
                                <!-- Form section -->
                                <div class="col-md-6">
                                    <h3 class="mb-4"><?php _e( 'Say Hello!', 'kit_theme' ); ?></h3>
                                    <div class="card bg-light shadow rounded-0">
                                        <div class="card-body">
                                            <?php echo do_shortcode( $contact_us_from_shortcode ); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- EOF Form section -->
                            </div>
                        </div>
                    </div>
                </div>                    
            </div>
        </div>
    </section>
    <!-- EOF Page Content -->
<?php
	endwhile;
get_footer();
