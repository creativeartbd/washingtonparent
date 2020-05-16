<div class="row">   
    <div class="col-md-12">
        <?php         
        $args_2 = array(
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
        
        $posts_2 = get_posts( $args_2 );
        
        if( $posts_2 ) {
            echo '<div class="row">';            
                foreach( $posts_2 as $post ) {
                    setup_postdata( $post );
                    echo '<div class="col-md-12">';
                        get_template_part( 'loop-templates/content', 'home-latest-stories' );
                    echo '</div>';                
                }            
            echo '</div>';
            wp_reset_postdata();
        }
        ?>
    </div>
</div>