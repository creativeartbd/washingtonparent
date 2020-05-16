<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper footer-area" id="wrapper-footer">

	<div class="container text-center">
		<div class="row">
			<div class="col-md-12">
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
			</div>
			<div class="col-md-12">
				<!-- Footer logo -->
				<?php

				if( everstrap_site_logo( 'footer_logo' ) ) {
					echo '<div class="footer-logo">';
						echo everstrap_site_logo( 'footer_logo' );
					echo '</div>';
				}

				// Footer nav				
				wp_nav_menu(
					array(
						'theme_location'  => 'footer-menu',
						'container_class' => 'menu-container',
						'container_id'    => '',
						'menu_class'      => 'header-bottom-menu',
						'fallback_cb'     => '',
						'menu_id'         => '',
						'depth'           => 2,
						'walker'          => new WP_Bootstrap_Navwalker(),
					)
				);
				?>
			</div>

			<!-- Footer search form -->
			<div class="col-md-4 offset-md-4">				
				<div class="footer-search-form">
					<form method="GET" action="<?php echo site_url( '/' ); ?>">						 
		                <input type="text" name="s" class="form-control" placeholder="Search for...">
		                <i class="fa fa-search"></i>			           
					</form>
				</div>
			</div>

			<!-- Footer copyright -->			
			<?php  
			if( is_active_sidebar( 'footer-copyright' ) ) {
				echo '<div class="col-md-12">';
					dynamic_sidebar( 'footer-copyright' );
				echo '</div>';
			}
			?>			
		</div><!-- row end -->
	</div><!-- container end -->
</div><!-- wrapper end -->
</div><!-- #page we need this extra closing tag here -->
<?php wp_footer(); ?>


<!-- Modal -->
<div class="bs-example">
    <!-- Modal HTML -->
    <div id="newsletterModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                    
				</div>
				<?php 
                if( everstrap_site_logo( 'header_logo' ) ) {
					echo '<div class="header-logo">';
						echo everstrap_site_logo( 'header_logo' );
					echo '</div>';
				}
				?>

				<h2>Join our mailing list and get exclusive giveaways, tips, family-friendly events and more. We look forward to keeping you informed!</h2>

				<form action="">
					<div class="form-group">
						<input type="text" placeholder="Email Address" name="email" class="form-control newsletter-input" required>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<input type="text" placeholder="First Name" name="first_name" class="form-control newsletter-input" required>
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Zip Code" name="zip" class="form-control newsletter-input" required>
							</div>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>     

</body>
</html>

