<?php
/**
 * The template for displaying 404 page content
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

					<div class="section-title text-center mb-5">
						<h1>404 Error</h1>
					</div>

                    <form action="<?php echo site_url( '/' ) ?>" method="GET">
                        <div class="search-wrapper">
                            <label for="">Sorry, we can’t seem to find the page you are looking for</label>
                            <div class="input-group">
                                <input type="text" name="s" class="form-control search-input" placeholder="Maybe Try A Search?" value="<?php echo get_search_query(); ?>">
                                <span class="search-icon"><i class="fa fa-search"></i></span>
                                <input type="submit" name="submit" value="Enter" class="btn btn-success search-btn">
							</div>
							<label for="" class="mt-4">Or take a look at some of or most recent articles:</label>
                        </div>
                    </form>
					<?php        
					                                 
					// Get recent posts
					$args = [
						'posts_per_page' => 10,
            			'orderby' => 'publish_date',
					];

					$posts = get_posts( $args );

					if( $posts ) {

						$exclude_from_more_stories = [];          

						foreach( $posts as $post ) {

							setup_postdata( $post );

							array_push( $exclude_from_more_stories, get_the_ID() );
                            get_template_part( 'loop-templates/content', 'author-post' );
						}

						wp_reset_postdata();
					}

					 // Read more button
					 echo '<div class="author-load-more-post"></div>'; // Load post here

					 $title = 'See More';
					 $class = 'common-btn';
					 $args = array(
						 'posts_per_page' => 10,
						 'orderby' => 'publish_date',               
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
