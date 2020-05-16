<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'everstrap_wp_body_open' ); ?>

<div class="site" id="page">

    <!--.nav-drawer-->
	<div id="nav-drawer" class="nav-drawer">
		<div class="nav-drawer-inner">
			
			<button type="button" class="nav-drawer-close"></button>
			
			<div class="drawer-logo">
				<?php echo everstrap_site_logo( 'footer_logo' ); ?>
			</div>

			<?php  
			wp_nav_menu(
				array(
					'theme_location'  => 'header-bottom-menu',
					'container_class' => 'menu-container',
					'container_id'    => 'header-bottom-menu-container',
					'menu_class'      => 'header-bottom-menu',
					'fallback_cb'     => '',
					'menu_id'         => '',
					'depth'           => 2,
					'walker'          => new WP_Bootstrap_Navwalker(),
				)
			);
			?>
			
			<?php  
			wp_nav_menu(
				array(
					'theme_location'  => 'header-top-menu',
					'container_class' => 'menu-container',
					'container_id'    => 'header-top-menu-container',
					'menu_class'      => 'header-top-menu',
					'fallback_cb'     => '',
					'menu_id'         => '',
					'depth'           => 2,
					'walker'          => new WP_Bootstrap_Navwalker(),
				)
			);
			?>			

			<?php 
			// Social links				
			$socials = everstrap_get_field( 'social_links', 'option' ); 
			if( $socials ) {
				echo '<div class="footer-socials">';
					foreach ( $socials as $social ) {					
						$social_link_address = $social['social_link_address'];
						$css_class_name = $social['css_class_name'];
						printf( '<a href="%s"><i class="%s" aria-hidden="true"></i></a>', $social_link_address, $css_class_name );
					}	
				echo '</div>';
			}				
			?>

			<!-- Footer search form -->
			<div class="drawer-search">				
				<div class="footer-search-form">
					<form method="GET" action="<?php echo site_url( '/' ); ?>">						 
		                <input type="text" name="s" class="form-control" placeholder="Search for...">
		                <i class="fa fa-search"></i>			           
					</form>
				</div>
			</div>
			
		</div>
	</div>
	<!--.nav-drawer -->

    <div class="header sticky-directory-page">
		<div class="container">
            <div class="wp-directory-nav">
                <div class="logo-container">
                    <div class="sticky-directory-contents">
                        <button class="hamburger-btn">
                            <span class="hamburger-icon"></span>
                        </button>                    
                        <?php echo everstrap_site_logo( 'sticky_logo' ); ?>						
                    </div>			
                </div>
                <div class="directory-category">
                    <h3>Category</h3>
                    <i class="fa fa-angle-down" id="header-dropdown-opener"></i></span>
                    <div class="category-dropdown">
                        <p class="category-dropdown-subtitle">Search Our Directories:</p>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'directories-dropdown',
                        ) );
                        ?>
                    </div>
                </div> 
                <?php if ( class_exists( 'WebDirectoryPro' ) ) { ?>
                    <div class="directory-header-search">
                        <form action="<?php if ( is_single() ) {
                            global $post;
                            $listing_type = $post->post_type;
                            echo wpa_get_listing_page_url( $listing_type );
                        } else {
                            preg_match( '/^\[wdp_listing listing_type="([a-zA-Z]+)"]?/', $post->post_content, $m );
                            $listing_type = isset( $m[ 1 ] ) && $m[ 1 ] ? $m[ 1 ] : 'education';
                            echo get_the_permalink();
                        } ?>" method="get" id="wdp-search-form">
                            <div class="wdp-filter">
                                <?php
                                $taxonomies = array();
                                global $wp_taxonomies;

                                foreach ( $wp_taxonomies as $taxonomy ) {
                                    if ( ! in_array( $listing_type, $taxonomy->object_type ) || 'yst_prominent_words' == $taxonomy->name ) {
                                        continue;
                                    }

                                    $taxonomies[ $taxonomy->name ] = $taxonomy;
                                }


                                $taxonomies = apply_filters( 'wdp_listing_filters', $taxonomies, $listing_type );
                                $taxonomies = array_slice( $taxonomies, 0, 3 );

                                foreach ( $taxonomies as $key => $taxonomy ) {

                                    $terms = get_terms( $taxonomy->name, apply_filters( 'wdp_listing_taxonomy_terms', array(
                                        'hide_empty' => true,
                                    ), $taxonomy->name, $listing_type ) );

                                    if ( empty( $terms ) ) {
                                        continue;
                                    }
                                    ?>
                                    <select name="<?php echo sanitize_key( $taxonomy->name ); ?>[]"
                                            id="<?php echo sanitize_key( $taxonomy->name ); ?>"
                                            class="medical-award"
                                            multiple="multiple"
                                            data-label="<?php echo esc_html( $taxonomy->label ); ?>">
                                        <?php foreach ( $terms as $term ) {

                                            if ( in_array( $key, array(
                                                'medical_award',
                                                'dental_award',
                                                'lawyer_award'
                                            ) ) ) {
                                                if ( ! preg_match( apply_filters( 'wdp_award_taxonomy_term_filter_regex', '/^(\d{4}) top (.*)/i' ), $term->name ) ) {
                                                    continue;
                                                }

                                                $term->name = apply_filters( 'wdp_award_taxonomy_term', $term->name );

                                            }

                                            ?>
                                            <option value="<?php echo $term->slug; ?>" <?php echo ! empty( $_GET[ $taxonomy->name ] ) && is_array( $_GET[ $taxonomy->name ] ) && in_array( $term->slug, $_GET[ $taxonomy->name ] ) ? ' selected="selected" ' : ''; ?>><?php echo esc_html( $term->name ); ?></option>
                                        <?php } ?>
                                    </select>

                                <?php } ?>
                            </div>
                            <div class="wdp-address-search-wrap">
                                <input name="address" class="wdp-search wdp-address-search" type="text"
                                        placeholder="Address, City, Zip"
                                        value="<?php echo empty( $_GET[ 'address' ] ) ? '' : $_GET[ 'address' ]; ?>">
                                <span class="wdp-location-picker"
                                        data-ip="<?php echo wdp_get_client_ip(); ?>"><i
                                            class="fa fa-map-marker"></i></span>
                            </div>
                            <div class="keyword-search">
                            <input name="keyword" class="wdp-search" type="text"
                                    placeholder="Keyword Search"
                                    value="<?php echo empty( $_GET[ 'keyword' ] ) ? '' : $_GET[ 'keyword' ]; ?>">
                                    <i class="fa fa-search keyword-=search" aria-hidden="true"></i>
                            </div>

                            <input type="hidden" class="wdp-lat" name="lat"
                                    value="<?php echo empty( $_GET[ 'lat' ] ) ? '' : sanitize_text_field( $_GET[ 'lat' ] ); ?>">
                            <input type="hidden" class="wdp-lon" name="lon"
                                    value="<?php echo empty( $_GET[ 'lon' ] ) ? '' : sanitize_text_field( $_GET[ 'lon' ] ); ?>">
                            <input type="hidden" class="wdp-order_by" name="order_by"
                                    value="<?php echo empty( $_GET[ 'order_by' ] ) ? '' : sanitize_text_field( $_GET[ 'order_by' ] ); ?>">
                            <input type="submit" value="filter">
                        </form>
                    </div>

                    <?php do_action( 'wdp_search_bar_submit_btn' );

                } ?>               
            </div>			
		</div>
	</div>	
