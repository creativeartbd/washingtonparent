<?php
/**
 * The template for preparing event list
 *
 * @package everstrap
 */

// ecp_get_template( 'lists/listing-start.php',
// 	[
// 		'max_page'    => $max_page,
// 		'paged'       => $paged,
// 		'per_page'    => count( $events ),
// 		'total_event' => ecp_get_event_list( $query_args, true ),
// 		'query_args'  => $query_args
// 	]
// );

$count = 0;

// =====================
// Featured event post
//======================
$sponsored_events_args = array(
	'post_type' => 'pro_event',
	'meta_query' => array(
		array(
			'key' => 'sponsored',
			'value' => 'yes',
			'compare' => '=',
		)
	)
);

$featured_event_posts = get_posts( $sponsored_events_args );

if( $featured_event_posts ) {
	global $post;
	echo '<div class="featured-event-wrapper">';
		echo '<div class="section-title mb-5 text-center"><h2>Featured Events</h2></div>';
		echo '<div class="row">';
			foreach( $featured_event_posts as $post ) {
				setup_postdata( $post );
				echo '<div class="col-md-6 sponsored-content-area">';
					get_template_part( 'loop-templates/content', 'sponsored-event');
					?>
					<div class="see-more-area">
						<a href="<?php echo get_the_permalink(); ?>" class="common-btn">See More</a>
					</div>
					<?php
				echo '</div>';
			}
		echo '</div>';
	echo '</div>';
	wp_reset_postdata();
}

// =============================
// Featured event post end here
//==============================

$total_events = wp_count_posts( 'pro_event' );
$event_count = $total_events->publish;
$per_page = 10;
$offset        = $query_args['offset'];
$showing_start = $offset ? $offset : 1;
$paged = get_query_var( 'paged' ) == '' ? 1 : get_query_var( 'paged' );

echo '<div class="row displaying">';
	echo '<div class="col-md-6"><p>Displaying: <span>All</span></p></div>';
	echo '<div class="col-md-6 text-right">';
		echo '<p>Showing ' . $showing_start . ' - ' . $per_page .  ' of ' .  $event_count . ' results';
	echo '</div>';
echo '</div>';

echo '<div class="row">';
	foreach ( $events as $event ) {
		$count++;
		echo '<div class="col-md-12">';
			ecp_get_template( 'lists/listing-content.php', [ 'event' => $event ] );
		echo '</div>';
	}
echo '</div>';

echo '<div class="row displaying">';
	echo '<div class="col-12 col-sm-6 col-md-6"><p>Page ' . $paged .  ' of ' . $max_page  . '</p></div>';
	echo '<div class="col-12 col-sm-6 col-md-6">';
	ecp_get_template( 'lists/pagination.php',
		[
			'max_page' => $max_page,
			'paged'    => $paged,
		]
	);
	echo '</div>';
echo '</div>';

ecp_get_template( 'lists/listing-end.php' );
get_template_part( 'template-parts/archive', 'event-calendar' );
