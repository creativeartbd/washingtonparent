<?php if ( ! wdp_is_sponsored( $post->ID ) ) {
	wdp_get_template( 'single/claim-btn.php', [ 'post' => $post ] );
} ?>
<?php wdp_get_template( 'single/timing.php', [ 'post' => $post ] ); ?>

