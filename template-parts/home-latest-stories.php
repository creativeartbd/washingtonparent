<div class="row">
    <div class="col-md-12">
        <?php 

        // Find the sponsored POST ID to exclude from the latest stories query
        $sponsored_post_args = array(
            'posts_per_page' => 1,            
            'orderby' => 'publish_date',    
            'meta_query' => array(
                array(
                    'key' => 'sponsored_post',
                    'value' => '1',
                    'compare' => '=',
                )
            )
        );        
        $sponsored_post = get_posts( $sponsored_post_args );        
        $exclude_id = '';
        if( $sponsored_post ) {
            $exclude_id = $sponsored_post[0]->ID;
            wp_reset_postdata();        
        }
        
        // Find the sponsored POST ID to exclude from the latest stories query

        // Get latest stories 
        $args = array(
            'posts_per_page' => 5,            
            'orderby' => 'publish_date',
            'exclude' => [ $exclude_id ], 
        );    
        
        $posts = get_posts( $args );
        
        if( $posts ) {
            echo '<div class="row">';            
                echo '<div class="col-md-12">';
                    echo '<article class="home-editors-pick-post">';
                        echo '<div class="home-editors-pick-title">';
                            echo '<h2>';
                                _e( 'Latest Stories', 'everstrap' );
                            echo '</h2>';
                        echo '</div>';
                    echo '</article>';
                echo '</div>';

                $counter = 1;
                $exclude_from_more_stories = [];

                foreach( $posts as $post ) {
                    setup_postdata( $post );
                    echo '<div class="col-md-12">';

                    array_push( $exclude_from_more_stories, get_the_ID() );

                    if( 2 === $counter ) {
                        get_template_part( 'template-parts/home-sponsored-post' );                   
                    } else {                    
                        get_template_part( 'loop-templates/content', 'home-latest-stories' );
                    }                
                    
                    echo '</div>';
                    $counter++;
                }            
            echo '</div>'; // End row
            wp_reset_postdata();

            // Load more stories            
            echo '<div class="author-load-more-post"></div>'; // Load post here

            $title = 'See More';
            $class = 'common-btn';
            $args = array(
                'posts_per_page' => 5,  
                'orderby' => 'publish_date',              
                'post_status' => 'publish',                
                'template_name' => 'home-latest-stories',
                'exclude' => $exclude_from_more_stories
            );
            
            echo '<div class="load-more-post-btn-wrapper hls-load-more">';
                apply_filters( 'everstrap_load_more_button', $args, $title, $class );
            echo '</div>';         

            if( is_active_sidebar( 'ad-320-50' ) ) {
                dynamic_sidebar( 'ad-320-50' );
            }               
            
        }
        ?>
    </div>
</div>