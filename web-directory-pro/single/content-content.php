<?php $content = wdp_get_content( $post ); ?>
<?php if ( ! empty( $content ) ): ?>
    <div class="single-listing-section">
        <div class="single-listing-section-title">Description</div>
        <div class="single-listing-section-content">
			<?php echo wdp_get_content( $post ); ?>
        </div>
    </div>
<?php endif; ?>
