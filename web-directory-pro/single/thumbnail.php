<?php if ( has_post_thumbnail( $post ) ): ?>
    <div class="wdp-listing-img-wrap">
		<?php echo get_the_post_thumbnail( $post, 'directory-single-thumb' ); ?>
    </div>
	<?php
	$caption = get_the_post_thumbnail_caption( $post );
	if ( $caption ) {
		echo sprintf( '<p class="thumb-caption">%s</p>', esc_html( $caption ) );
	}
	?>
<?php endif; ?>