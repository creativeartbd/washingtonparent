<?php
global $post;
$_street_address        = get_post_meta( $post->ID, '_street_address', true );
$_street_address_line_2 = get_post_meta( $post->ID, '_street_address_line_2', true );
$_city                  = get_post_meta( $post->ID, '_city', true );
$_state                 = get_post_meta( $post->ID, '_state', true );
$_zip                   = get_post_meta( $post->ID, '_zip', true );
$_country               = get_post_meta( $post->ID, '_country', true );

$address = '';
$address1 = '';

if ( $_street_address ) {
	$address .= $_street_address;
}
if ( $_street_address_line_2 ) {
	$address .= ( $address ) ? ', ' . $_street_address_line_2 : $_street_address_line_2;
}
if ( $_city ) {
	$address1 .= $_city;
}
if ( $_state ) {
	$address1 .= ( $address1 ) ? ', ' . $_state : $_state;
}
if ( $_zip ) {
	$address1 .= ( $address1 ) ? ', ' . $_zip : $_zip;
}
if ( $_country ) {
	$address1 .= ( $address1 ) ? ', ' . $_country : $_country;
}

if ( $address || $address1 ) {
	?>

	<div class="wdp-listing-address">
		<?php if ( $address ) {
			echo $address;
		}
		if ( $address && $address1 ) {
			echo "<br>";
		}
		if ( $address1 ) {
			echo esc_html( $address1 );
		} ?>
	</div>

<?php } ?>
