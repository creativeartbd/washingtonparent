<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$queried_object = get_queried_object();
$post_content = $queried_object->post_content;

$is_event_page = false;
if( has_shortcode( $post_content, 'event_calendar_pro_event_list' ) || has_shortcode( $post_content, 'event_calendar_pro_event_submit' ) ) {
    $is_event_page = true;;
    get_header( 'calendar' );
    get_header( 'calendar-search' );
} else {
    get_header();
}
?>

<div class="wrapper" id="page-wrapper">
	<div class="container" id="content" tabindex="-1">
		<div class="row">
            <div class="col-md-8 content-area mobile-padding pr-extra-30" id="primary">
                <main class="site-main" id="main">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <?php get_template_part( 'loop-templates/content', 'page' ); ?>                       
                    <?php endwhile; // end of the loop. ?>                                        
                </main><!-- #main -->
            </div>
            <?php 
            if( $is_event_page ) {
                get_sidebar( 'calendar' );
            } else {
                get_sidebar();
            }
            ?>            
		</div><!-- .row -->
	</div><!-- #content -->

    <div class="container-fluid bg-ash">
        <?php 
        if( $is_event_page ) {
            get_header( 'calendar-search-2' );    
        }                        
        ?>               
    </div>

    <div class="container">
        <div class="row">            
            <?php 
            if( is_active_sidebar( 'home-970-90-ad' ) ) {
                echo '<div class="col-md-12 text-center mt-5">';
                    dynamic_sidebar( 'home-970-90-ad' );
                echo '</div>';
            }
            ?>
        </div>
    </div>   


</div><!-- #page-wrapper -->

<?php
get_footer();
