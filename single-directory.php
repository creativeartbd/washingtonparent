<?php

get_header( 'directory' );

?>
<?php

if ( have_posts() ) {
	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		the_content();
	}
}
if ( is_active_sidebar( 'home-970-90-ad' ) ) { ?>
    <div class="container">
        <div class="col-md-12 text-center mt-5" id="secondary">
			<?php dynamic_sidebar( 'home-970-90-ad' ); ?>
        </div>
    </div>
<?php }
get_footer(); ?>
