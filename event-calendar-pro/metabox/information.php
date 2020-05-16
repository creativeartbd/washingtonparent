<?php

global $post;

$buy_ticket             = ecp_get_event_meta( $post->ID, 'buy_ticket' );
$cost                   = ecp_get_event_meta( $post->ID, 'cost' );
$cost_door              = ecp_get_event_meta( $post->ID, 'cost_door' );
$age                    = ecp_get_event_meta( $post->ID, 'age' );
$sponsored              = ecp_get_event_meta( $post->ID, 'sponsored' );
$featured               = ecp_get_event_meta( $post->ID, 'featured' );
$readersubmitted        = ecp_get_event_meta( $post->ID, 'readersubmitted' );
$featured_description   = ecp_get_event_meta( $post->ID, 'featured_description' );

?>
<div class="ecp-information-meta-data">

	<div class="ecp-row">
		<div class="form-group">
			<label for="buy_ticket"><?php _e( 'Ticket Purchase Link:', 'event-calendar-pro' ); ?></label>
			<input type="text" name="buy_ticket" id="buy_ticket" class="form-table form-control"
				   value="<?php echo $buy_ticket; ?>">
		</div>
	</div>

	<div class="ecp-row">
		<div class="form-group">
			<label for="cost"><?php _e( 'Cost Per Couple:', 'event-calendar-pro' ); ?></label>
			<input type="text" name="cost" id="cost" class="form-table form-control" value="<?php echo $cost; ?>">
		</div>
	</div>

    <div class="ecp-row">
        <div class="form-group">
            <label for="cost_door"><?php _e( 'Cost At Door:', 'event-calendar-pro' ); ?></label>
            <input type="text" name="cost_door" id="cost_door" class="form-table form-control" value="<?php echo $cost_door; ?>">
        </div>
    </div>

	<div class="ecp-row">
		<div class="form-group">
			<label for="age"><?php _e( 'Ages:', 'event-calendar-pro' ); ?></label>
			<input type="text" name="age" id="age" class="form-table form-control" value="<?php echo $age; ?>">
		</div>
	</div>
	<div class="">
		<p><strong>Featured Description</strong></p>
		<?php

		$content = $featured_description ? $featured_description : '';
		$editor_id = 'featured_description';
		$settings = array( 'media_buttons' => false );
		wp_editor( $content, $editor_id, $settings);
		?>
	</div>


	<?php do_action( 'ecp_information_meta_field', $post->ID ); ?>

	<?php if ( is_admin() ) { ?>
		<div class="ecp-row">
			<label class="control-label">Sponsored:&emsp;</label> <span class="param-value yesno">
			<input type="radio" name="sponsored" value="no" <?php echo( $sponsored != 'yes' ? 'checked' : '' ); ?>>
			<label class="radio-label">No</label>
			<input type="radio" name="sponsored" value="yes" <?php echo( $sponsored == 'yes' ? 'checked' : '' ); ?>>
			<label class="radio-label">Yes</label>
		</span>
		</div>
		<div class="ecp-row">
			<label class="control-label">Featured:&emsp;</label> <span class="param-value yesno">
			<input type="radio" name="featured" value="no" <?php echo( $featured != 'yes' ? 'checked' : '' ); ?>>
			<label class="radio-label">No</label>
			<input type="radio" name="featured" value="yes" <?php echo( $featured == 'yes' ? 'checked' : '' ); ?>>
			<label class="radio-label">Yes</label>
		</span>
		</div>

		<div class="ecp-row">
			<label class="control-label">Reader submitted:&emsp;</label> <span class="param-value yesno">
			<input type="radio" name="readersubmitted"
				   value="no" <?php echo( $readersubmitted != 'yes' ? 'checked' : '' ); ?>>
			<label class="radio-label">No</label>
			<input type="radio" name="readersubmitted"
				   value="yes" <?php echo( $readersubmitted == 'yes' ? 'checked' : '' ); ?>>
			<label class="radio-label">Yes</label>
		</span>
		</div>

	<?php } else {
		echo '<input type="hidden" name="readersubmitted" value="no">';
	} ?>

</div>




