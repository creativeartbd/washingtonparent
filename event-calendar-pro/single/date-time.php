<?php
/**
 * Displaying event date and time part
 *
 * @package everstrap
 */

global $post;

$startdate = ecp_get_event_meta( $post->ID, 'startdate' );
$enddate   = ecp_get_event_meta( $post->ID, 'enddate' );
$starttime = ecp_get_event_meta( $post->ID, 'starttime' );
$endtime   = ecp_get_event_meta( $post->ID, 'endtime' );
$until     = ! empty( $endtime ) ? ' until' : '';
?>


