<?php
global $listing_type;
$paged     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$limit     = $listing_query->get( 'posts_per_page' );
$offset    = ( $paged - 1 ) * $limit;
$post_from = $offset + 1;
$post_to   = '';
$total     = $listing_query->found_posts;
if ( $total > $limit ) {
	$post_to = $offset + $limit;
	if ( $post_to > $total ) {
		$post_to = $total;
	}
} else {
	$post_to = $total;
}
$post_type_object = get_post_type_object( $listing_type );
?>
<div class="wdp-listing-results">
	<div class="sm-half">
		<div class="text-left">
			<span class="result-text"><?php echo apply_filters( 'wdp_result_text', sprintf( 'Displaying: <span class="dir-name">%s</span>', $post_type_object->label ) ); ?></span>
			<!-- <div class="clear-filter-mobile-device">
				<a href="#" class="search-clear-button clear-filters" style="display: inline-block;"><i class="fa fa-close"></i>Clear Filters</a>
			</div> -->
		</div>
	</div>

	<div class="sm-half">
		<div class="text-right">
			<span class="result-number"><?php echo sprintf( 'Showing %s - %s of %s Results', $post_from, $post_to, $total ); ?></span>
		</div>
	</div>
</div>
