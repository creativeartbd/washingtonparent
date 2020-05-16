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

	<div class="header event-list-page-nav">
		<div class="container">
			<div class="">
				<div class="row">
					<div class="col-12">
						<button class="hamburger-btn">
							<span class="hamburger-icon"></span>
						</button>										
						<?php echo everstrap_site_logo( 'sticky_logo' ); ?>						
						<form method="GET" action="<?php echo site_url( '/' ); ?>" class="search-form">
							<input type="text" name="s" placeholder="Search for...">
						</form>					
						<i class="fa fa-search sticky-mobile-search-box" aria-hidden="true"></i>
					</div>
				</div>
			</div>
		</div>
	</div>	
