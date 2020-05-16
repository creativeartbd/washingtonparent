<?php

/**
 * The template for displaying all single posts
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
?>
<div class="wrapper" id="single-wrapper">
    <div class="container single-post-page" id="content" tabindex="-1">
        <div class="row">
            <?php
            if (is_active_sidebar('home-970-90-ad')) {
                echo '<div class="col-md-12 text-center">';
                dynamic_sidebar('home-970-90-ad');
                echo '</div>';
            }
            ?>
            <div class="col-md-8 content-area mobile-padding pr-extra-30" id="primary">
                <main class="site-main" id="main">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            $GLOBALS['exclude_from_more_stories_id'] = get_the_ID();
                            get_template_part('loop-templates/content', 'single');
                        }
                        get_template_part('template-parts/single-more-stories');
                    }
                    ?>
                    <?php //apply_filters( 'everstrap_infinite_scroll_nav', get_the_ID() ); 
                    ?>
                </main><!-- #main -->
            </div>
            <?php get_sidebar(); ?>
        </div><!-- .row -->
    </div><!-- #content -->
    
    <div class="container">
        <?php
        if (is_active_sidebar('home-970-90-ad')) {
            echo '<div class="row">';
                echo '<div class="col-md-12 text-center mt-5">';
                    dynamic_sidebar('home-970-90-ad');
                echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div><!-- #single-wrapper -->
<?php
get_footer();
