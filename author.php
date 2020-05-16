<?php
/**
 * The template for displaying the author pages
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="author-wrapper">
	<div class="container" id="content" tabindex="-1">
		<div class="row">
            <?php
            if( is_active_sidebar( 'home-970-90-ad' ) ) {
                echo '<div class="col-md-12 text-center mt-2 mb-5">';
                    dynamic_sidebar( 'home-970-90-ad' );
                echo '</div>';
            }
            ?>
            <div class="col-md-8 content-area mobile-padding pr-extra-30" id="primary">
                <main class="site-main author-page" id="main">
                    <header class="page-header authorheader">
                        <div class="section-title">
                            <?php                             

                            $author_first_name  = get_the_author_meta('first_name');
                            $author_last_name   = get_the_author_meta('last_name');                
                            $author_id          = get_the_author_meta('ID');
                            $post_author_page   = get_author_posts_url($author_id);
                            $author_description = get_the_author_meta( 'description' );                           

                            // Author first and last name
                            if( !empty( $author_first_name ) || !empty( $author_last_name ) ) {
                                echo '<h2>'. $author_first_name . ' ' . $author_last_name . '</h2>';
                            }

                            if( get_author_role() ) {
                                echo '<div class="role">';
                                    echo '<h5>' . get_author_role() . '</h5>';
                                echo '</div>';
                            }
                            
                            // Author descripiton
                            if( $author_description ) {
                                echo '<div class="author-description">';
                                    echo '<p>' . $author_description . '</p>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </header><!-- .page-header -->
                    <?php 
                    if( have_posts() ) {
                        $exclude_from_more_stories = [];
                        while( have_posts() ) {
                            the_post();
                            array_push( $exclude_from_more_stories, get_the_ID() );
                            get_template_part( 'loop-templates/content', 'author-post' );
                        }
                    }

                    echo '<div class="author-load-more-post"></div>'; // Load post here

                    $title = 'See More';
                    $class = 'common-btn';
                    $args = array(
                        'posts_per_page' => 5,  
                        'orderby' => 'publish_date',              
                        'post_status' => 'publish',                
                        'template_name' => 'author-post',
                        'exclude' => $exclude_from_more_stories
                    );
                    
                    echo '<div class="load-more-post-btn-wrapper">';
                        apply_filters( 'everstrap_load_more_button', $args, $title, $class );
                    echo '</div>';    
                    ?>
                </main><!-- #main -->                
            </div>
            <?php get_sidebar( '404-search-author' ); ?>
		</div> <!-- .row -->
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
    
</div><!-- #author-wrapper -->

<?php
get_footer();
