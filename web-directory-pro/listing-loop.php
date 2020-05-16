<?php $sponsored = wdp_is_sponsored( $post->ID ) ? 'sponsored' : ''; ?>
<?php
$link = get_the_permalink( $post->ID );

if ( $post->post_parent !== 0 ) {
	$link = get_the_permalink( $post->post_parent );
	$link = add_query_arg( array(
		'child_id' => $post->ID
	), $link );
}

$_street_address        = get_post_meta( $post->ID, '_street_address', true );
$_street_address_line_2 = get_post_meta( $post->ID, '_street_address_line_2', true );
$_city                  = get_post_meta( $post->ID, '_city', true );
$_state                 = get_post_meta( $post->ID, '_state', true );
$_zip                   = get_post_meta( $post->ID, '_zip', true );
$_country               = get_post_meta( $post->ID, '_country', true );
$_website               = get_post_meta( $post->ID, '_website', true );
$_phone                 = get_post_meta( $post->ID, '_phone', true );

$address = '';

if ( $_street_address ) {
	$address .= $_street_address;
}
if ( $_street_address_line_2 ) {
	$address .= ( $address ) ? ' ' . $_street_address_line_2 : $_street_address_line_2;
}

if ( $_city ) {
	$address .= ( $address ) ? ', ' . $_city : $_city;
}
if ( $_state ) {
	$address .= ( $address ) ? ', ' . $_state : $_state;
}

?>

<?php $pinned = isset( $post->pinned ) && $post->pinned; ?>
<?php $post_type_object = get_post_type_object( $post->post_type ); ?>

<?php global $counter, $listing_taxonomies ?>
<?php $primary_taxonomy = wp_list_filter( $listing_taxonomies, [ 'primary' => true ] ); ?>
<li class="wdp-listing-item <?php echo $pinned ? 'sponsored' : ''; ?>" data-postid="<?php echo $post->ID; ?>">
    <div class="wdp-listing">
		<?php if ( has_post_thumbnail( $post ) ): ?>
            <div class="wdp-listing-thumb ever-col-5 no-padding">
                <a href="<?php echo $link; ?>"><?php echo get_the_post_thumbnail( $post, 'directory-list-thumb' ); ?></a>
            </div>
		<?php endif; ?>
        <div class="wdp-listing-body <?php echo has_post_thumbnail( $post ) ? 'ever-col-7' : 'ever-col-12'; ?> no-padding">
			<?php if ( $pinned ) { ?>
                <div class="sponsored-badge">
                    <span>sponsored content</span>

					<?php
					$tooltip_msg = apply_filters( 'wdp_sponsored_tooltip_message', wdp_get_settings( 'sponsored_tooltip', '', 'wdp_general' ), $post );

					if ( ! empty( $tooltip_msg ) ) {
						echo '<span class="tooltip-text">' . $tooltip_msg . '</span>';
					}

					?>


                </div>
			<?php } ?>

            <!--			<span class="wdp-listing-distance"> -->
			<?php //echo isset( $post->distance ) && ! empty( $post->distance ) ? ceil( $post->distance ) . ' mi' : ''; ?><!-- </span>-->

            <div class="wdp-listing-header">
                <a href="<?php echo $link; ?>">
                    <h2 class="listing-title">
						<?php if ( $pinned ) {
							echo '<i class="fa fa-asterisk"></i>';
						} else {
							echo '<span class="wdp-listing-counter">' . $counter . '</span>';
						} ?>

						<?php echo get_the_title( ( $post->post_parent === 0 ? $post->ID : $post->post_parent ) ); ?>
                    </h2>
                </a>

				<?php if ( is_array( $primary_taxonomy ) && ! empty( $primary_taxonomy ) ) :
					$primary_taxonomy = array_pop( $primary_taxonomy );
					$terms = wp_get_post_terms( $post->ID, $primary_taxonomy->name, apply_filters( 'wdp_listing_primary_taxonomy_query_args', array(
						'hide_empty' => true,
						'number'     => '2',
					) ) );

					if ( ! empty( $terms ) ) { ?>
                        <ul class="wdp-listing-primary-tax-terms">
							<?php foreach ( $terms as $term ): ?><?php global $wp; ?><?php $link = add_query_arg( array( "$term->taxonomy[]" => $term->slug ), site_url( $wp->request ) ); ?>
                                <li><a href="<?php echo esc_url( $link ); ?>"><?php echo $term->name; ?></a></li>
							<?php endforeach; ?>
                        </ul>
					<?php } endif; ?>

				<?php


				if ( wdp_is_top_listing( $post ) ) { ?>
                    <div class="wdp-badge">
                        <span>Top <?php echo $post_type_object->labels->singular_name; ?></span>

						<?php
						$tooltip_msg = apply_filters( 'wdp_top_listing_tooltip_message', wdp_get_settings( 'top_tooltip', '', 'wdp_general' ), $post );

						if ( ! empty( $tooltip_msg ) ) {
							echo '<span class="tooltip-text">' . $tooltip_msg . '</span>';
						}

						?>

                    </div>
				<?php } ?>
            </div>

            <div class="wdp-listing-content">
                <p><?php echo wpa_get_excerpt( $post, 20 ); ?></p>
            </div>
            <div class="wdp-location-website-phone">
				<?php if ( $address ) {
					echo sprintf( '<p>%s</p>', $address );
				}
				if ( $_phone ) {
					echo sprintf( '<p>%s</p>', $_phone );
				}
				if ( $_website ) {
					echo sprintf( '<p><a href="%s" target="_blank">%s</a></p>', esc_url( $_website ), esc_url( $_website ) );
				} ?>
            </div>
        </div>

    </div>
</li>
