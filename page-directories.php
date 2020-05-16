<?php

/**
 * The template for displaying all directories
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header( 'directory' );
?>
<div class="wrapper" id="single-wrapper">
    <div class="container" id="content" tabindex="-1">
        <div class="row">
            <div class="col-md-12 content-area mobile-padding pr-extra-30" id="primary">
                <header class="directory-page-title">
                    <?php echo esc_html( get_the_title() ); ?>
                </header>
                <main class="site-main" id="main">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
						}
					}
					?>
                </main><!-- #main -->
            </div>
        </div><!-- .row -->
		<?php get_template_part( 'template-parts/content', 'directories' ) ?>
    </div><!-- #content -->

    <div class="container">
		<?php if ( is_active_sidebar( 'home-970-90-ad' ) ) { ?>
            <div class="row">
                <div class="col-md-12 text-center mt-5">
					<?php dynamic_sidebar( 'home-970-90-ad' ); ?>
                </div>
            </div>
		<?php } ?>
    </div>
</div><!-- #single-wrapper -->
<?php
get_footer();
?>
