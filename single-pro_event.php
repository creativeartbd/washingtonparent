<?php

/**
 * The template for displaying all single posts
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header( 'calendar');
get_header( 'calendar-search' );
?>
<div class="wrapper" id="single-wrapper">
    <div class="container events-list-page" id="content" tabindex="-1">
        <div class="row">            
            <div class="col-md-8 content-area mobile-padding pr-extra-30" id="primary">
                <main class="site-main" id="main">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();  
                            the_content();                          
                        }                        
                    }
                    ?>                    
                </main><!-- #main -->
            </div>
            <?php get_sidebar( 'calendar' ); ?>
        </div><!-- .row -->
    </div><!-- #content -->
    
     <div class="container-fluid bg-ash">
        <?php get_header( 'calendar-search-2' ); ?>               
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

</div><!-- #single-wrapper -->
<?php
get_footer();
