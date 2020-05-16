<?php

/**
 * The template for displaying the author pages
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
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
                echo '<div class="col-md-12 text-center mb-3">';
                    dynamic_sidebar('home-970-90-ad');
                echo '</div>';
            }
            ?>
            <div class="col-md content-area mobile-padding pr-extra-30 category-content-area" id="primary">
                <main class="site-main" id="main">
                    <div class="row">
                        <?php
                        $counter = 1;
                        $total_post = wp_count_posts();
                        $paged = get_query_var('paged') == 0 ?  1 : get_query_var( 'paged');
                        $posts_per_page = get_option('posts_per_page');
                        $queried_object = get_queried_object();
                        $post_per_page = get_option( 'posts_per_page');

                        // get the category slug & name
                        $category_id = '';
                        $category_name = '';
                        if ($queried_object) {
                            $category_id = $queried_object->term_id;
                            $category_name = $queried_object->name;
                        }

                        echo '<div class="col-md-12"><div class="section-title mb-5"><h2>' . $category_name . '</h2></div></div>';

                        // =====================================
                        // Get 3 sponsored post of this category
                        $sponsored_args = array(
                            'posts_per_page' => 3,
                            'category' => $category_id,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'slug',
                                    'terms' => array(
                                        $queried_object->slug
                                    )
                                )
                            ),
                            'meta_query' => array(
                                array(
                                    'key' => 'sponsored_post',
                                    'value' => '1',
                                    'compare' => '=',
                                )
                            )
                        );

                        $sponsored_posts = get_posts($sponsored_args);
                        $excluded_posts = [];
                        $sponsored_posts_array = [];

                        if ($sponsored_posts) {
                            foreach ($sponsored_posts  as $post) {
                                setup_postdata($post);
                                $excluded_posts[] = get_the_ID();
                                $sponsored_posts_array[] = $post;
                            }
                            wp_reset_postdata();
                        }
                        // =========================================
                        // End Get 3 sponsored post of this category


                        // ===============================
                        // Get all posts of this category
                        $args = array(
                            'posts_per_page' => $post_per_page,
                            'category' => $category_id,
                            'exclude' => $excluded_posts, // exluded sponsored post
                            'paged' => $paged,
                        );

                        $posts = get_posts($args);

                        if ($posts) {
                            $counter = 1;
                            $ad_position_no = 9;
                            $box_post_no = 3; // If there is no sponsored post on 4th loop

                            foreach ($posts as $post) {
                                setup_postdata($post);

                                // Sponsored post
                                if (isset($sponsored_posts_array[0])) {
                                    if (4 == $counter) {
                                        echo '<div class="col-md-6">';
                                        $post_id = $sponsored_posts_array[0]->ID;
                                        if ($post_id) {
                                            everstrap_sponsored_post($post_id, 'medium-thumb', 'home-editors-pick-post', false); // get the post content from this function
                                            $ad_position_no -= 1;
                                        }
                                        echo '</div>';
                                    }
                                } else {
                                    $box_post_no = 4;
                                }

                                if (isset($sponsored_posts_array[1])) {
                                    if (5 == $counter) {
                                        echo '<div class="col-md-12">';
                                        $post_id = $sponsored_posts_array[1]->ID;
                                        if ($post_id) {
                                            everstrap_sponsored_post($post_id, 'small-thumb', 'home-latest-stories', true); // get the post content from this function
                                            $ad_position_no -= 1;
                                        }
                                        echo '</div>';
                                    }
                                }

                                 if (isset($sponsored_posts_array[2])) {
                                    if (7 == $counter) {
                                        echo '<div class="col-md-12">';
                                        $post_id = $sponsored_posts_array[2]->ID;
                                        if ($post_id) {
                                            everstrap_sponsored_post($post_id, 'small-thumb', 'home-latest-stories', true); // get the post content from this function
                                            $ad_position_no -= 1;
                                        }
                                        echo '</div>';
                                    }
                                }
                                // End Sponsored post


                                if ($counter <= $box_post_no) {
                                    echo '<div class="col-sm-6 col-md-6">';
                                    get_template_part('loop-templates/content', 'category-box-post');
                                    echo '</div>';
                                } else {
                                	$separation_class = ( $counter == 4 ) ? "category-list-grid" : "";
                                    echo '<div class="col-md-12 '. $separation_class.'">';
                                    get_template_part('loop-templates/content', 'category-horizental-post');
                                    echo '</div>';
                                }

                                // Show advertisement
                                if ( $ad_position_no == $counter) {
                                    if (is_active_sidebar('ad-728-90')) {
                                        echo '<div class="col-md-12">';
                                        dynamic_sidebar('ad-728-90');
                                        echo '</div>';
                                    }
                                }
                                // end Show advertisement

                                $counter++;


                            }

                            wp_reset_postdata();
                        }

                        // ================
                        // For pagination

                        $category = get_category($category_id);
                        $post_count_exclude_sponsored = $category->category_count - count($excluded_posts);
                        $max = $post_count_exclude_sponsored / $post_per_page;

                        if (is_float($max)) {
                            $max = (int) $max + 1;
                        }

                        echo '<div class="col-md-6">';
                            echo '<div class="total-age">';
                                echo '<p>Page '. $paged .' OF ' . ceil( $post_count_exclude_sponsored / $post_per_page ) . '</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-6">';

                        if (!empty($max)) {
                            everstrap_pagination(array('total' => $max));
                        }
                        echo '</div>';
                        ?>
                    </div>
                </main>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
