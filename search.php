<?php
/**
 * The template for displaying search results pages
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="search-wrapper">
	<div class="container" id="content" tabindex="-1">
		<div class="row">
            <div class="col-md-8 content-area mobile-padding pr-extra-30" id="primary">
                <main class="site-main search-page" id="main">
                    <form action="<?php echo site_url( '/' ) ?>" method="GET">
                        <div class="search-wrapper">
                            <label for="">Your Search for:</label>
                            <div class="input-group">
                                <input type="text" name="s" class="form-control search-input" placeholder="Search here..." value="<?php echo get_search_query(); ?>">
                                <span class="search-icon"><i class="fa fa-search"></i></span>
                                <input type="submit" name="submit" value="Enter" class="btn btn-success search-btn">
                            </div>
                        </div>
                    </form>
                    <?php                     
                    if( have_posts() ) {

                        $exclude_from_more_stories = [];                    

                        while( have_posts() ) {
                            the_post();        
                            array_push( $exclude_from_more_stories, get_the_ID() );
                            get_template_part( 'loop-templates/content', 'author-post' );
                        }   

                        // Read more button
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

                    } else {
                        echo '<div class="alert alert-warning mt-5">';
                            echo '<h4>';
                                _e( 'No result found!', 'everstrap' );
                            echo '</h4>';
                        echo '</div>';
                    }
                    ?>
                </main><!-- #main -->
            </div>
            <?php get_sidebar( '404-search-author' ); ?>
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
    
</div><!-- #search-wrapper -->

<?php
get_footer();
