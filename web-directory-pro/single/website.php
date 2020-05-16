<?php
$website = get_post_meta(get_the_ID(), '_website', true );
if(!empty($website)):?>
<p class="wdp-website-link">
	<a href="<?php echo esc_url( $website );?>" target="_blank">Visit Website</a>
</p>
<?php
endif;
