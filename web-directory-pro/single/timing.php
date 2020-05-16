<?php
$timing_disabled = wdp_get_settings( 'timing', 'on' );
$timings         = array(
	'Sunday'    => wdp_get_post_meta( $post->ID, '_sunday' ),
	'Monday'    => wdp_get_post_meta( $post->ID, '_monday' ),
	'Tuesday'   => wdp_get_post_meta( $post->ID, '_tuesday' ),
	'Wednesday' => wdp_get_post_meta( $post->ID, '_wednesday' ),
	'Thursday'  => wdp_get_post_meta( $post->ID, '_thursday' ),
	'Friday'    => wdp_get_post_meta( $post->ID, '_friday' ),
	'Saturday'    => wdp_get_post_meta( $post->ID, '_saturday' ),
);
?>

<?php if ( ! empty( array_filter($timings) ) && $timing_disabled != 'on' && wdp_is_sponsored($post->ID)) { ?>
	<div class="single-listing-section">
		<h4 class="single-listing-section-title">Hours</h4>
		<ul class="single-listing-list unstyled timing-list">
			<?php foreach ( $timings as $day => $time ) {
				if ( empty( $time ) ) {
					$time = '<span class="closed">Closed</span>';
				}
				echo sprintf( '<li class="time"><span class="bold">%s:</span><br><span>%s</span></li>', $day, $time );
			} ?>
		</ul>
	</div>
<?php } ?>
