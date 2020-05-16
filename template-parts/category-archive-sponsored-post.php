
<?php 
global $post;

$queried_object = get_queried_object();
//print_r($queried_object );
print_r( $queried_object->slug );

$args = array(
    'posts_per_page' => 1,
    'orderby' => 'publish_date',
    // 'tax_query' => array(
    //     array(
    //         'taxonomy' => 'category',
    //         'field' => 'slug',
    //         'terms' => array(
    //             $queried_object->slug
    //         )
    //     )
    // ),
    // 'meta_query' => array(
    //     array(
    //         'key' => 'sponsored_post',
    //         'value' => '1',
    //         'compare' => '=',
    //     )
    // )
);

$posts = get_posts( $args );
echo count( $posts );
wp_reset_postdata();
// if( $posts ) {
//      foreach ( $posts as $post ) {
//          setup_postdata( $post );
//          the_title();
//      }
//      wp_reset_postdata();
// }
?>
