<?php global $post; ?>
<?php $post_type_object = get_post_type_object( $post->post_type ); ?>
<div class="wdp-single-listing">

	<?php
	$show_on_mobile = apply_filters( 'wdp_single_listing_map_on_mobile', ( ! wp_is_mobile() ) );
	if ( $show_on_mobile ) {
		wdp_get_template( 'single/map.php' );
	}
	?>
    <div class="wpa-single-listing-contents">
        <div class="container">
            <div class="row">
                <div class="<?php echo is_active_sidebar( 'single-directory' ) ? 'col-md-9' : 'col-md-12'; ?>">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="wdp-single-main">
								<?php wdp_get_template( 'single/thumbnail.php', [ 'post' => $post ] ); ?>
								<?php if ( wdp_is_top_listing( $post ) ) { ?>
                                    <span class="wdp-top-badge">Top <?php echo $post_type_object->labels->singular_name; ?></span>
								<?php } ?>
								<?php wdp_get_template( 'single/title.php', [ 'post' => $post ] ); ?>
								<?php wdp_get_template( 'single/address.php', [ 'post' => $post ] ); ?>
								<?php wdp_get_template( 'single/phone.php', [ 'post' => $post ] ); ?>
								<?php wdp_get_template( 'single/website.php', [ 'post' => $post ] ); ?>
								<?php wdp_get_template( 'single/social-icons.php', [ 'post' => $post ] ); ?>
								<?php wdp_get_template( 'single/taxonomy-section.php', [ 'post' => $post ] ); ?>
								<?php wdp_get_template( 'single/content-content.php', [ 'post' => $post ] ); ?>
								<?php do_action( 'wdp_singling_listing_after_content', $post ); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="wdp-single-side">
								<?php wdp_get_template( 'single/aside.php', [ 'post' => $post ] ); ?>
                            </div>
                        </div>
                    </div>
                </div>
				<?php if ( is_active_sidebar( 'single-directory' ) ) { ?>
                    <div class="col-md-3 widget-area" id="secondary" role="complementary">
						<?php dynamic_sidebar( 'single-directory' ); ?>
                    </div><!-- #secondary -->
				<?php } ?>
            </div>
        </div>
    </div>

</div>
<?php do_action( 'wdp_single_listing_end', $post ); ?>
