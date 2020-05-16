<?php
/**
 * get list excerpt
 *
 * @param null $post
 * @param int $length
 *
 * @return string
 * @since 1.0.0
 *
 */
function wpa_get_excerpt( $post = null, $length = 40 ) {

	$excerpt = wp_trim_words( get_the_excerpt( $post->ID ), $length );

	if ( empty( $excerpt ) ) {
		$excerpt = wp_trim_words( strip_shortcodes( $post->post_content ), $length );
	}

	return $excerpt;
}

function wpa_get_listing_page_url( $post_type ) {
	global $wpdb;
	$page_id = $wpdb->get_var( $wpdb->prepare( "select ID from {$wpdb->posts} where post_content like %s AND post_status='publish' AND post_type='page'", '%[wdp_listing listing_type="' . $post_type . '"%' ) );
	if ( $page_id ) {
		return get_the_permalink( $page_id );
	}

	return false;
}

//filter post template
function wpa_filter_template( $template ) {

	if ( function_exists( 'wdp_get_listing_post_types' ) ) {
		if ( is_single() && in_array( get_post_type(), wdp_get_listing_post_types() ) ) {
			$template = get_template_directory() . '/single-directory.php';
		}
	}

	return $template;
}

add_filter( 'template_include', 'wpa_filter_template' );

function wpa_listing_output( $output ) {
	ob_start();
	?>
	<script>
        jQuery(document).ready(function ($) {
            var items = $('.wdp-listing-items .wdp-listing-item').not('.sponsored');
            var inListAd1 = $('#pm1.wpa-in-list-ad').html();
            var inListAd2 = $('#pm2.wpa-in-list-ad').html();
            if (!items.length) {
                return false;
            }

            items.each(function (index, item) {
                if (index === 5) {
                    $(inListAd1).insertAfter(item);
                }
                if (index === 12) {
                    $(inListAd2).insertAfter(item);
                }
            });
        });
	</script>
	<div class="wpa-in-list-ad" id="pm1" style="display: none;">
		<li class="wdp-listing-item promotion text-center">
			<img src="http://placehold.it/300x250" alt="">
		</li>
	</div>

	<div class="wpa-in-list-ad" id="pm2" style="display: none;">
		<li class="wdp-listing-item promotion text-center">
			<div id='http://placehold.it/300x250' style='width:300px;margin: 0 auto;'></div>
		</li>
	</div>

	<?php
	$output .= ob_get_contents();
	ob_get_clean();

	return $output;
}

add_filter( 'wdp_listing_output', 'wpa_listing_output' );