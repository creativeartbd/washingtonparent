<?php

/**
 * This template is using for single post more stories
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<div class="section-title mb-5">
    <h2>More Stories</h2>
</div>

<?php

$querie_object       =  get_queried_object();
$category_id         =  $querie_object->term_id;
$exclude_id          =  isset($GLOBALS['exclude_from_more_stories_id']) ? $GLOBALS['exclude_from_more_stories_id']: '';

$args                =  array(
    'posts_per_page' => 4,
    'category'       => $category_id,
    'exclude'        => $exclude_id,
);

$posts               =  get_posts($args);

if ($posts) {
    echo '<div class="row">';
    foreach ($posts as $post) {
        echo '<div class="col-6 col-sm-3 col-md-3">';
        get_template_part('loop-templates/content', 'more-stories');
        echo '</div>';
        setup_postdata($post);
    }
    echo '</div>';
    wp_reset_postdata();
}
