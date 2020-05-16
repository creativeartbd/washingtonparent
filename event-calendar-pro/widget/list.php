<?php

$location   = ecp_get_event_location( $event->ID );
$location   = ecp_get_event_meta( $event->ID, 'location' );
$address    = ecp_get_event_meta( $event->ID, 'address' );
$address2   = ecp_get_event_meta( $event->ID, 'address2' );
$city       = ecp_get_event_meta( $event->ID, 'city' );
$state      = ecp_get_event_meta( $event->ID, 'state' );
$country    = ecp_get_event_meta( $event->ID, 'country' );
$zip        = ecp_get_event_meta( $event->ID, 'zip' );
$start_time = ecp_get_event_meta( $event->ID, 'starttime' );
$end_time   = ecp_get_event_meta( $event->ID, 'endtime' );
$featured   = ecp_get_event_meta( $event->ID, 'featured' );

$month = date("M", strtotime( $event->start_date ) );
$full_month = date("F", strtotime( $event->start_date ) );
$date = date("d", strtotime( $event->start_date ) );
$day = date("D", strtotime( $event->start_date ) );
$event_thumb = get_the_post_thumbnail( $event->ID );
$event_title = get_the_title( $event->ID );
$terms = get_the_terms( $event->ID, 'event_category' );
$event_category = [];
foreach ($terms as $term ) {
	$event_category[] = $term->name;
}
$event_category = implode( ', ', $event_category);
?>

<div class="event-summer-wrapper">
	<div class="event-date">
		<div class="month"><?php echo $month; ?></div>
		<div class="date"><?php echo $date; ?></div>
		<div class="day"><?php echo $day; ?></div>
	</div>
	<div class="event-title">		
		<h6><a href="<?php echo get_the_permalink( $event->ID); ?>"><?php echo $event_title; ?></a></h6>
		<div class="full-date"><?php echo $full_month . ' ' . $date . ' @ ' . $start_time . ' - ' . $end_time;  ; ?></div>
	</div>
</div>
