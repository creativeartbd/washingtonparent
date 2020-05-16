<?php
global $post;

$post_id = !empty($_REQUEST['child_id']) ? intval($_REQUEST['child_id']) : $post->ID;

$phone = get_post_meta( $post_id, '_phone', true );
$fax = get_post_meta( $post_id, '_fax', true );

if ( ! empty( $phone ) ) { ?>
	<div class="wdp-listing-contact-number">
		<span>P: </span> <a href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
	</div>
<?php }

if ( ! empty( $fax ) ) { ?>
	<div class="wdp-listing-contact-number">
		<span>F: </span> <a href="fax:<?php echo $fax ?>"><?php echo $fax ?></a>
	</div>
<?php }
