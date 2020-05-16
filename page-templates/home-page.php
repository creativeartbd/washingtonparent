<?php

/**
 * Template Name: Home Page
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<div class="wrapper" id="index-wrapper">
    <div class="container" id="content" tabindex="-1">
        <div class="row">
            
            <?php
            if (is_active_sidebar('home-970-90-ad')) {                
                echo '<div class="col-md-12 text-center mb-4">';
                    dynamic_sidebar('home-970-90-ad');            
                echo '</div>';
            }
            ?>

            <div class="col-md-8 content-area mobile-padding pr-extra-30" id="primary">
                <!-- Home page top post -->
                <?php get_template_part('template-parts/home-top-post'); ?>
                <!-- Home page editor's pick post -->
                <?php get_template_part('template-parts/home-editors-pick-post'); ?>
                <!-- Home page latest stories post -->
                <?php get_template_part('template-parts/home-latest-stories'); ?>

            </div>
            <?php get_sidebar(); ?>
        </div><!-- .row -->
    </div><!-- #content -->

    
    <?php
    if (is_active_sidebar('home-970-90-ad')) {
        echo '<div class="container" id="content" tabindex="-1">';
            echo '<div class="row">';
                echo '<div class="col-md-12 text-center mt-5 mb-4">';
                    dynamic_sidebar('home-970-90-ad');
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
    ?>

    <div class="container" id="content" tabindex="-1">
        <div class="row">
            <div class="col-12 content-area mobile-padding directory-container pr-extra-30" id="primary">
                <div class="section-title text-center">
                    <h2>directories</h2>
                </div>
                <?php
                $page = get_page_by_path( 'directories' );                
                $page_id = $pege_permalink = '';
                if( $page ) {
                    $page_id = $page->ID;
                    $pege_permalink = get_the_permalink( $page_id );
                }

                $directories = everstrap_get_field( 'directory_list', $page_id );
                if( $directories ) {
                    echo '<div class="row">';
                        $counter = 1;                        
                        foreach( $directories as $directory ) {
                            $directory_name      = $directory['directory_name'];
                            $directory_url       = $directory['directory_url'];
                            $directory_thumbnail = $directory['directory_thumbnail'];                                                                                 
                            $thumbnail_src       = wp_get_attachment_image_src( $directory_thumbnail, 'extra-small-thumb' );
                            $thumbnail           = $thumbnail_src[0];

                            echo '<article class="col-6 col-sm-4 col-md-4 col-lg-2">'; 
                                if( $thumbnail ) {
                                    echo '<img src="'.$thumbnail.'"/>';
                                }
                                echo '<div class="directory-name">';
                                    echo '<h3><a href="'.$directory_url.'">' . $directory_name . '</a></h3>';
                                echo '</div>';
                            echo '</article>';

                            if( 6 == $counter ) {
                                break;
                            }
                            $counter++;
                        }
                        echo '<div class="col-md-12 text-center">';
                            echo '<a href="'.$pege_permalink.'" class="common-btn">See More</a>';
                        echo '</div>';
                    echo '</div>';
                }
                ?>               
            </div>
        </div>
    </div>
            

    <div class="container" id="content" tabindex="-1">
        <div class="row">
            <div class="col-md-8 content-area mobile-padding pr-extra-30 homepage-category-posts" id="primary">
                <!-- Home page categories post -->
                <?php
                $category_slugs = ['eat', 'play', 'learn', 'discover'];
                foreach ($category_slugs as $category_slug) {
                    everstrap_get_post_by_cat_slug(
                        [
                            'category_name' =>  $category_slug,
                            'posts_per_page' => 2,
                        ]
                    );
                }
                ?>
            </div>
            <?php get_sidebar('right-bottom'); ?>
        </div><!-- .row -->
    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
