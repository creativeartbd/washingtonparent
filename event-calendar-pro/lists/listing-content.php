<?php
/**
 * The template for displaying all event list
 *
 * @package everstrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class( 'event-listing' ) ?>>
	<div class="wp-event-item">
		<div class="wp-event-thumb">
			<a href="<?php echo get_the_permalink( $event->ID ); ?>">
				<?php echo get_the_post_thumbnail( $event->ID, 'event-thumb' ); ?>
			</a>
		</div>
		<div class="wp-event-content">
			<div class="wp-event-category">
				<?php
				$categories = ecp_get_event_categories( $event->ID );
				if ( ! empty( $categories ) ) {
					$categories       = wp_list_pluck( $categories, 'name', 'term_id' );
					$event_categories = [];
					foreach ( $categories as $term_id => $name ) {
						$event_categories[] = sprintf( '<a href="%s">%s</a>', add_query_arg( array( 'event_category' => $term_id ), get_the_permalink() ), $name );
					}
					echo implode( ', &nbsp;', $event_categories );
				}
				?>
			</div>
			<div class="wp-event-title">
				<a href="<?php echo get_the_permalink( $event->ID ); ?>"><?php echo apply_filters( 'the_title', $event->post_title ); ?></a>
			</div>
			<div class="wp-event-date">
				<?php
				$date_output = '';

				if ( ! empty( $event->start_date ) ) {

					$timing      = '';
					$date_format = get_option( 'date_format' );
					$time_format = get_option( 'time_format' );

					if ( $event->end_date ) {
						$timing .= date( $date_format, strtotime( $event->end_date ) );
					}

					if ( $event->start_time ) {
						$timing .= ' @ ' . date( $time_format, strtotime( $event->start_time ) );
						$timing .= ' - ' . date( $time_format, strtotime( $event->end_time ) );
					}

					if ( ! empty( $timing ) ) {
						$date_output .= $timing;
					}
				}

				$location         = ecp_get_event_meta( $event->ID, 'location' );
				if ( $location ) {
					$date_output .= '<br/><span class="location">' . $location .'</span>';
				}

				echo '<span>' . $date_output . '</span>';
				?>
			</div>
			<div class="wp-event-view">
				<a href="<?php echo get_the_permalink( $event->ID ); ?>">
					<button class="common-btn"><?php _e( 'View Details', 'everstrap' ); ?></button>
				</a>
			</div>

		</div>
	</div>
</article>
