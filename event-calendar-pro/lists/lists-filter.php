<?php
/**
 * Displaying event search filter section
 *
 * @package everstrap
 */

?>

<?php
require WPECP_INCLUDES . '/class-ics.php';

$keyword    = ! empty( $_GET['search_keyword'] ) ? wp_unslash( $_GET['search_keyword'] ) : '';
$category   = ! empty( $_GET['event_category'] ) ? sanitize_key( $_GET['event_category'] ) : '';
$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$start_date = ! empty( $_GET['start_date'] ) ? sanitize_key( $_GET['start_date'] ) : '';
$end_date   = ! empty( $_GET['end_date'] ) ? sanitize_key( $_GET['end_date'] ) : '';
$date       = ! empty( $_GET['date'] ) ? sanitize_key( $_GET['date'] ) : '';
$perpage    = 10;

$query_args = apply_filters( 'ecp_events_output_query_args', [
	'offset'     => ! empty( $paged ) ? ( $paged - 1 ) * $perpage : 0,
	'categories' => ! empty( $category ) ? $category : null,
	'search'     => ! empty( $keyword ) ? $keyword : null,
	'start_date' => $start_date,
	'end_date'   => $end_date,
	'date'       => $date,
	'number'     => $perpage,
] );

$events = ecp_get_event_list( $query_args );

if ( $events ) {
	$ics = [];
	foreach ( $events as $post ) {
		setup_postdata( $post );
		$startdate = ecp_get_event_meta( $post->ID, 'startdate' );
		$enddate   = ecp_get_event_meta( $post->ID, 'enddate' );
		$starttime = ecp_get_event_meta( $post->ID, 'starttime' );
		$endtime   = ecp_get_event_meta( $post->ID, 'endtime' );
		$location  = ecp_get_event_meta( $post->ID, 'location' );
		$url       = ecp_get_event_meta( $post->ID, 'url' );

		$ics[] = new \WebPublisherPro\EventCalendarPro\ECP_ICS( array(
			'location'    => $location,
			'description' => esc_html( get_the_excerpt( $post ) ),
			'dtstart'     => $startdate,
			'dtend'       => $enddate,
			'summary'     => sanitize_text_field( get_the_title( $post ) ),
			'url'         => $url,
		) );

	}

	$ics_string = '';
	foreach ( $ics as $ic ) {
		$ics_string .= $ic->to_string() . "\n";
	}
}

?>
<div class="row">
	<div class="col-md-12 p-0">
		<div class="ecp-widget-event-filter event-listing">

			<div class="event-community">
				<div class="event-community-title">
					<h4 class="title"><?php _e( 'Potomac Local Events', 'everstrap' ); ?></h4>
				</div>
				<div class="event-community-btn">
					<a href="<?php echo ecp_get_page_url( 'event_submit_page' ) ?>">
						<button class="event-common-btn bg-blue">
							<?php _e( 'post event', 'everstrap' ); ?>
						</button>
					</a>
					<a href="<?php echo ecp_get_page_url( 'events_page' ) ?>">
						<button class="event-common-btn bg-blue">
							<?php _e( 'View All', 'everstrap' ); ?>
						</button>
					</a>
				</div>
			</div>

			<form action="<?php echo ecp_get_page_url( 'events_page' ); ?>" method="get">
				<div class="form-row">
					<div class="form-group start-icon col-md-4">
						<label for="start_date"><?php _e( 'Start Date:', 'everstrap' ); ?></label>
						<input type='text' class="ecp-date-calendar form-control" name="start_date"
							   placeholder="<?php echo date( 'Y-m-d' ) ?>" value="<?php echo $start_date; ?>"/>
						<i class="fa fa-table" aria-hidden="true"></i>
					</div>
					<div class="form-group end-icon col-md-4">
						<label for="end_date"><?php _e( 'End Date:', 'everstrap' ); ?></label>
						<input type='text' class="ecp-date-calendar form-control" name="end_date"
							   placeholder="<?php echo date( 'Y-m-d' ) ?>" value="<?php echo $end_date; ?>"/>
						<i class="fa fa-table" aria-hidden="true"></i>
					</div>
					<div class="form-group ecp-search-filter col-md-4">
						<label for="end_date"><?php _e( 'Keyword:', 'everstrap' ); ?></label>
						<input type="search" name="search_keyword" class="form-control" placeholder="Search for."
							   value="<?php echo ( ! empty( $_GET['search_keyword'] ) ) ? wp_unslash( $_GET['search_keyword'] ) : ''; ?>">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="event_location"><?php _e( 'Location', 'everstrap' ); ?></label>
						<select name="event_location" id="event_location" class="form-control">
							<option value="">All</option>
							<?php

							global $wpdb;
							$query = "SELECT DISTINCT pm.meta_value AS cities FROM wp_posts AS p LEFT JOIN wp_postmeta AS pm ON p.ID = pm.post_id LEFT JOIN wp_postmeta AS pm1 ON p.ID = pm1.post_id WHERE p.post_type = 'pro_event' AND pm.meta_key = 'city' AND pm1.meta_key = 'enddate' AND DATEDIFF( CURDATE(), pm1.meta_value ) <= 0 ORDER BY pm.meta_value ASC";

							$results   = $wpdb->get_results( $query );
							$locations = wp_list_pluck( $results, 'cities' );

							if ( ! empty( $locations ) ) {
								foreach ( $locations as $loc => $location ) {
									if ( $location ) {
										echo sprintf( '<option value="%s" %s>%s</option>', $location, selected( $location, $location_id ), $location );
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="event_category"><?php _e( 'Event Type:', 'everstrap' ); ?></label>
						<select name="event_category" id="event_category" class="form-control">
							<option value="">All</option>
							<?php foreach ( ecp_get_all_event_categories( 'term_id' ) as $term_id => $name ) {
								echo sprintf( '<option value="%s" %s >%s</option>', $term_id, $category === $term_id ? 'selected' : '', $name );
							} ?>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="">&nbsp;</label>
						<button class="btn btn-default event-search" type="submit">Search</button>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>
