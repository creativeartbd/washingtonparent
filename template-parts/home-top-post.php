<div class="row">
    <div class="col-md-12">
        <?php        
        $args = array(
            'posts_per_page' => 1,
            'orderby' => 'publish_date',
        );

        $posts = get_posts($args);        

        if ($posts) {            
            foreach ($posts as $post) {
                setup_postdata($post);                
                get_template_part('loop-templates/content', 'home-top-post');
            }
            wp_reset_postdata();
        }
        ?>
    </div>
</div>