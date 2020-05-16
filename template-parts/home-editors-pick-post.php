<div class="row">
    <div class="col-md-12">
        <?php 
        $args = array(
            'posts_per_page' => 2,            
            'orderby' => 'publish_date',
            'meta_query' => array(
                array(
                    'key' => 'mark_as_editors_pick_post',
                    'value' => '1',
                    'compare' => '=',
                )
            )      
        );
        
        $posts = get_posts( $args );
        
        if( $posts ) {
            echo '<div class="row">';
            
            echo '<div class="col-md-12">';
                echo '<article class="home-editors-pick-post">';
                    echo '<div class="home-editors-pick-title">';
                        echo '<h2>';
                            _e( 'Editor\'s Pick', 'everstrap');
                        echo '</h2>';
                    echo '</div>';
                echo '</article>';
            echo '</div>';

            foreach( $posts as $post ) {
                setup_postdata( $post );
                echo '<div class="col-6 col-sm-6 col-md-6">';
                    get_template_part( 'loop-templates/content', 'home-editors-pick-post' );
                echo '</div>';
            }
            echo '</div>';
            wp_reset_postdata();
        }
        ?>
    </div>
</div>