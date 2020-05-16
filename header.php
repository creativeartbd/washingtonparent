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

    <?php
	    $logo_src = get_template_directory_uri() . '/images/logo.png';
    ?>
    <!--.nav-drawer-->
    <div id="nav-drawer" class="nav-drawer">
        <div class="nav-drawer-inner">

            <button type="button" class="nav-drawer-close"></button>

            <div class="drawer-logo">
				<?php
					if ( everstrap_site_logo( 'header_logo' ) ) {
						echo everstrap_site_logo( 'header_logo' );
					} else {
						?>
                        <a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
                           title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
                            <img class="site-logo" src="<?php echo esc_url( $logo_src ) ?>"
                                 alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
                        </a>
						<?php
					}
				?>
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
				if ( $socials ) {
					echo '<div class="footer-socials">';
					foreach ( $socials as $social ) {
						$social_link_address = $social['social_link_address'];
						$css_class_name      = $social['css_class_name'];
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

    <div class="header clearfix">
        <div class="container">
            <div class="on-mobile">
                <div class="row">
                    <div class="col-2">
                        <button class="hamburger-btn">
                            <span class="hamburger-icon"></span>
                        </button>
                    </div>
                    <div class="col-8 text-center">
						<?php
							if ( everstrap_site_logo( 'sticky_logo' ) ) {
								echo everstrap_site_logo( 'sticky_logo' );
							} else {
								?>
                                <a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
                                    <img class="site-logo" src="<?php echo esc_url( $logo_src ) ?>"
                                         alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
                                </a>
								<?php
							}
						?>
                        <form method="GET" action="<?php echo site_url( '/' ); ?>" class="search-form">
                            <input type="text" name="s" placeholder="Search for...">
                        </form>
                    </div>
                    <div class="col-2 text-right">
                        <i class="fa fa-search explore-mobile-search-box" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="without-mobile">
                <div class="menu-inner">

                    <div class="header-logo">
                        <button class="hamburger-btn">
                            <span class="hamburger-icon"></span>
                        </button>
						<?php
							if ( everstrap_site_logo( 'header_logo' ) ) {
								echo everstrap_site_logo( 'header_logo' );
							} else {
								?>
                                <a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
                                    <img class="site-logo" src="<?php echo esc_url( $logo_src ) ?>"
                                         alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
                                </a>
								<?php
							}
						?>
                    </div>
                    <div class="header-menu">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="header-search">
                                    <i class="fa fa-search explore-search-box" aria-hidden="true"></i>
                                    <form method="GET" action="<?php echo site_url( '/' ); ?>">
                                        <input type="text" name="s" placeholder="Search for...">
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12 d-none d-lg-block">
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
                            </div>
                            <div class="col-md-12 d-none d-lg-block">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sticky-nav">
                <div class="row">
                    <div class="col-12">
                        <button class="hamburger-btn">
                            <span class="hamburger-icon"></span>
                        </button>
						<?php
//                            echo everstrap_site_logo( 'sticky_logo' );

							if ( everstrap_site_logo( 'sticky_logo' ) ) {
								echo everstrap_site_logo( 'sticky_logo' );
							} else {
								?>
                                <a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
                                    <img class="site-logo" src="<?php echo esc_url( $logo_src ) ?>"
                                         alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
                                </a>
								<?php
							}

						?>
                        <form method="GET" action="<?php echo site_url( '/' ); ?>" class="search-form">
                            <input type="text" name="s" placeholder="Search for...">
                        </form>
                        <i class="fa fa-search sticky-mobile-search-box" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
