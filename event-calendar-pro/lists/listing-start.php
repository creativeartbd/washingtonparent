<?php
/**
 * The template for listting start part
 *
 * @package everstrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$offset        = $query_args['offset'];
$number        = $query_args['number'];
$paged         = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 0;
$showing_start = $offset ? $offset : 1;
$showing_end   = $paged > 1 ? $offset + $per_page : $number;

?>

<div id="primary" class="col-md-12 content-area b-r-1">
	<?php ecp_get_template( 'lists/lists-filter.php' ); ?>
</div>

<article class="event-search-wrapper">
	<div class="sh-event-search-result">
		<div class="sh-event-result-for">
			<p><span><?php _e( 'Results for:', 'everstrap' ); ?></span> <?php echo date( 'M j, Y' ); ?>-All / stafford</p>
		</div>
		<div class="sh-event-showing">
			<p>showing <?php echo $showing_start; ?> - <?php echo $showing_end; ?> of <?php echo $total_event; ?></p>
		</div>
	</div>
</article>
