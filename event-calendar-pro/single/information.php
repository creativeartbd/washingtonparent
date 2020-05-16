<?php
/**
 * Displaying event page information
 *
 * @package everstrap
 */

global $post;

$name        = ecp_get_event_meta( $post->ID, 'name' );
$phone       = ecp_get_event_meta( $post->ID, 'phone' );
$contactname = ecp_get_event_meta( $post->ID, 'contactname' );
$contactmail = ecp_get_event_meta( $post->ID, 'contactmail' );
$url         = ecp_get_event_meta( $post->ID, 'url' );
$age         = ecp_get_event_meta( $post->ID, 'age' );
?>
<div class="ecp-single-event-info" itemprop="sponsor" itemtype="http://schema.org/Organization">
    <h3>Additional Information</h3>
	<?php echo ! empty( $name ) ? '<p class="sponsor"><h4>Sponsor</h4><span itemprop="name">' . $name . '</span></p>' : '' ?>
	<?php echo ! empty( $phone ) ? '<div class="phone"><h4>Phone</h4><span itemprop="telephone">' . $phone . '</span></div>' : '' ?>
	<?php echo ! empty( $contactmail ) ? '<div class="email"><h4>Email</h4><span itemprop="email">' . $contactmail . '</span></div>' : '' ?>
	<?php echo ! empty( $contactname ) ? '<div class="contactname"><h4>Name</h4><span itemprop="contactname">' . $contactname . '</span></div>' : '' ?>
	<?php echo ! empty( $url ) ? '<div class="url"><h4>Website</h4><span><a itemprop="url" href="' . $url . '">' . $url . '</a></span></div>' : '' ?>
	<?php echo ! empty( $cost ) ? '<div class="cost" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><h4>Cost</h4><span itemprop="price" content="' . $cost . '">' . $cost . '</span></div>' : '' ?>
	<?php echo ! empty( $age ) ? '<div class="age"><h4>Ages</h4><span>' . $age . '</span></div>' : '' ?>
</div>
