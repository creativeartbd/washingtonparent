<?php
/**
 * The template for displaying event pagination
 *
 * @package everstrap
 */

$range = 4;
// We need the pagination only if there is more than 1 page

if ( $max_page > 1 ) {
	if ( ! $paged ) {
		$paged = 1;
	}

	echo '<div class="event-pagination-wrapper">';
	echo '<ul class="pagination event">';

	// To the previous page
	echo '<li class="page-item prev">';
		previous_posts_link( '< Prev' );
	echo '</li>';

	if ( $max_page > $range + 1 ) :
		if ( $paged >= $range ) {
			echo '<li class="page-item">';
				echo '<a class="page-link" href="' . get_pagenum_link( 1 ) . '">1</a>';
			echo '</li>';
		}
		if ( $paged >= ( $range + 1 ) ) {
			echo '<li class="page-item">';
				echo '<span class="page-link">&hellip;</span>';
			echo '</li>';
		}
	endif;

	// We need the sliding effect only if there are more pages than is the sliding range
	if ( $max_page > $range ) {
		// When closer to the beginning
		if ( $paged < $range ) {
			for ( $i = 1; $i <= ( $range + 1 ); $i ++ ) {
				$active = $paged == $i ? 'active' : '';
				echo "<li class='page-item {$active}'>";
					echo ( $i == $paged ) ? '<span class="page-link">' . $i . '</span>' : '<a class="page-link" href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';
				echo '</li>';
			}
			// When closer to the end
		} elseif ( $paged >= ( $max_page - ceil( ( $range / 2 ) ) ) ) {
			for ( $i = $max_page - $range; $i <= $max_page; $i ++ ) {
				$active = $paged == $i ? 'active' : '';
				echo "<li class='page-item {$active}'>";
					echo ( $i == $paged ) ? '<span class="page-link">' . $i . '</span>' : '<a class="page-link" href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';
				echo '</li>';
			}
			// Somewhere in the middle
		} elseif ( $paged >= $range && $paged < ( $max_page - ceil( ( $range / 2 ) ) ) ) {
			for ( $i = ( $paged - ceil( $range / 2 ) ); $i <= ( $paged + ceil( ( $range / 2 ) ) ); $i ++ ) {
				$active = $paged == $i ? 'active' : '';
				echo "<li class='page-item {$active}'>";
					echo ( $i == $paged ) ? '<span class="page-link">' . $i . '</span>' : '<a class="page-link" href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';
				echo '</li>';
			}
		}
		// Less pages than the range, no sliding effect needed
	} else {
		for ( $i = 1; $i <= $max_page; $i ++ ) {
			$active = $paged == $i ? 'active' : '';
			echo "<li class='page-item {$active}'>";
				echo ( $i == $paged ) ? '<span class="page-link">' . $i . '</span>' : '<a class="page-link" href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';
			echo '</li>';
		}
	}
	if ( $max_page > $range + 1 ) :
		// On the last page, don't put the Last page link
		if ( $paged <= $max_page - ( $range - 1 ) ) {
			$active = $paged == $i ? 'active' : '';
			echo "<li class='page-item {$active}'>";
				echo '<a class="page-link" href="' . get_pagenum_link( $max_page ) . '">' . $max_page . '</a>';
			echo '</li>';
		}
	endif;

	// Next page
	echo '<li class="page-item next">';
		next_posts_link( '&nbsp;Next >', $max_page );
	echo '</li>';

	echo '</ul><!-- postpagination -->';
	echo '</div>';
}
