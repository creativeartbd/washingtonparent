<div class="ecp-calendar-filter">
	<form action="<?php echo ecp_get_page_url( 'events_page' ); ?>" method="get">
		<div class="form-group">
			<input type="search" name="search_keyword" placeholder="Search for..." value="<?php echo ( ! empty( $_GET['search_keyword'] ) ) ? $_GET['search_keyword'] : ''; ?>">			
			<i class="fa fa-search"></i>
		</div>
		<div class="form-check">
			<input type="checkbox" class="form-check-input" id="exampleCheck1" checked="checked">
			<label class="form-check-label" for="exampleCheck1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View reader submitted</label>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-sucess btn-block search-event" value="Search">
		</div>
	</form>
</div>
<div class="ecp-calendar-buttons clearfix">
	<a href="<?php echo ecp_get_page_url( 'event_submit_page' ); ?>" class="btn btn-default event-btn">Post</a>
	<a href="<?php echo ecp_get_page_url( 'events_page' ); ?>" class="btn btn-default event-btn">View</a>
</div>
