<?php
/**
 * Displaying event page content part
 *
 * @package everstrap
 */

global $post;

$id               = $post->ID;
$photodescription = ecp_get_event_meta( $post->ID, 'photodescription' );
$startdate        = ecp_get_event_meta( $post->ID, 'startdate' );
$enddate          = ecp_get_event_meta( $post->ID, 'enddate' );
$starttime        = ecp_get_event_meta( $post->ID, 'starttime' );
$endtime          = ecp_get_event_meta( $post->ID, 'endtime' );
$until            = ! empty( $endtime ) ? ' until': '';
$location         = ecp_get_event_meta( $post->ID, 'location' );
$address          = ecp_get_event_meta( $post->ID, 'address' );
$address2         = ecp_get_event_meta( $post->ID, 'address2' );
$city             = ecp_get_event_meta( $post->ID, 'city' );
$state            = ecp_get_event_meta( $post->ID, 'state' );
$country          = ecp_get_event_meta( $post->ID, 'country' );
$zip              = ecp_get_event_meta( $post->ID, 'zip' );
$name             = ecp_get_event_meta( $post->ID, 'name' );
$phone            = ecp_get_event_meta( $post->ID, 'phone' );
$contactname      = ecp_get_event_meta( $post->ID, 'contactname' );
$contactmail      = ecp_get_event_meta( $post->ID, 'contactmail' );
$url              = ecp_get_event_meta( $post->ID, 'url' );
$age              = ecp_get_event_meta( $post->ID, 'age' );
$buy_ticket       = ecp_get_event_meta( $id, 'buy_ticket' );
$cost             = ecp_get_event_meta( $id, 'cost' );
$cost_door        = ecp_get_event_meta( $id, 'cost_door' );
$terms            = get_the_terms( $id, 'event_category' );
$featured         = ecp_get_event_meta($post->ID, 'featured');
$sponsored        = ecp_get_event_meta($post->ID, 'sponsored');
$eventtype		  = ecp_get_event_meta( $id, 'eventtype' );
$featured_description = ecp_get_event_meta( $id, 'featured_description' );

$startdate_strtotime = strtotime(  $startdate );
$enddate_strtotime = strtotime(  $enddate );

$start_month = date('M', $startdate_strtotime );
$start_date = date('d', $startdate_strtotime );

$end_month = date('M', $enddate_strtotime );
$end_date = date('d', $enddate_strtotime );

$event_category    = [];
foreach ($terms as $term ) {
	
	$term_id = $term->term_id;
	$term_link = get_term_link( $term_id );

	$event_category[] = "<a href='$term_link'>".$term->name . "</a>";
}
$event_category    = implode( ', ', $event_category);
?>

<div class="event-content-section">
	<div class="row">
		<div class="col-md-12">		
			<?php everstrap_post_social_share(get_the_ID(), [ 'instagram', 'twitter', 'facebook', 'reddit-alien', 'linkedin', 'print', 'envelope', 'link'], 'Share This'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?php
			if( $sponsored ) {
				echo '<div class="sponsored">sponsored</div>';
			} else {
				echo '<div class="event-category">';
					echo $event_category;
				echo '</div>';
			}
			?>
			
			<div class="event-title">
				<h2><?php echo get_the_title(); ?></h2>
			</div>
			<div class="event-meta">
				<p>
					<?php 
					echo $start_month . ' ' . $start_date . ' - ' . $end_month . ' '  . $end_date . ' @ ' . $starttime;
					?>
				</p>
				<p>
					<?php echo $location; ?>
				</p>
			</div>
			<div class="event-content">
				<p>Alit aut omnihillecte illa que dolo to modiscimus, vidigende sitaqui dolor alis mo estiis dolor saeperit excerum quasit veliaep edicima ximolumet eium voluptatum volutecatum volupietur mos alitas ut doles estem velles esequuntur? Repudandus eate solorestis etur a ni sus aut aut aut mos anit explanimilis as estiore si totatiis et occusciendia qui ium vendebistias ducias .</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="event-thumb">
				<?php echo get_the_post_thumbnail( $id ); ?>
				<?php 
				if (get_the_post_thumbnail_caption()) {
					echo '<div class="thumb-caption">';
						echo get_the_post_thumbnail_caption();
					echo '</div>';
				}	
				?>			
			</div>
		</div>
	</div>

	<div class="event-location">
		<div class="row">
			<div class="col-md-6">
				<h2>Location</h2>
				<p><strong><?php echo $location; ?></strong></p>
				<p><?php echo $address; ?></p>	
				<p><?php echo $city . ', ' . $state . ' ' . $zip; ?></p>
			</div>
			<div class="col-md-6 text-right">			
				<a class="common-btn" target="_blank" href="http://maps.google.com/maps?q=<?php echo urlencode( ecp_get_full_address( $id ) ); ?>" class="map-btn pull-right" target="_blank">View map</a>
			</div>
		</div>
	</div>

	<?php if( $cost || $cost_door ) : ?>
	<div class="event-cost">
		<div class="row">
			<div class="col-md-6">
				<h2>Cost</h2>
				<?php if( $cost) :  ?>
					<p><?php echo $cost . ' per couple in advance.'; ?></p>
				<?php endif; ?>
				<?php if( $cost_door ) :  ?>
					<p><?php echo $cost_door . ' at the door.'; ?></p>
				<?php endif; ?>
			</div>
			<div class="col-md-6 text-right">
				<?php if( $buy_ticket ) : ?>
					<a href="<?php echo $buy_ticket ?>" target="_blank" class="common-btn">Buy Tickets</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="event-addition-information">
		<div class="row">
			<div class="col-md-12">
				<h2>Aditional Information</h2>
				<p><b>Contact:</b><?php echo $contactname; ?></p>
				<p><b>Phone:</b><?php echo $phone; ?></p>
				<p><b>Email:</b><?php echo $contactmail; ?></p>
				<p><b>Website:</b><?php echo $url; ?></p>
				<p><b>Event Type:</b><?php echo $eventtype; ?></p>
			</div>		
		</div>
	</div>

	<div class="event-description">
		<div class="row">
			<div class="col-md-12">			
				<h3>Description</h3>
				<?php echo wpautop( get_the_content( $id ) ); ?>
			</div>		
		</div>
	</div>

	<?php if( $featured_description ) : ?>
	<div class="event-featured-description">
		<div class="row">
			<div class="col-md-12">			
				<h3>Featured description (From the owner)</h3>
				<p><?php echo $featured_description; ?></p>
			</div>		
		</div>
	</div>
	<?php endif; ?>
	

	<div class="event-message">
		<p>We make every effort to ensure the accuracy of this information. However, you should always call ahead to confirm dates, times, location, and other information.</p>
	</div>

	<div class="event-map">
		<div class="row">
			<div class="col-md-12">				
			</div>		
		</div>
	</div>

</div>





