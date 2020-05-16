<div class="row d-flex">
	<?php
	if ( have_rows( 'directory_list' ) ) {
		while ( have_rows( 'directory_list' ) ) {
			the_row();
			$dir_name  = get_sub_field( 'directory_name' );
			$dir_url   = get_sub_field( 'directory_url' );
			$dir_thumb = get_sub_field( 'directory_thumbnail' ); ?>
            <article class="single-dir col-md-3">
				<?php
				echo sprintf( '<a href="%s" class="directory-thumb">%s</a>', esc_url( $dir_url ), wp_get_attachment_image( $dir_thumb, 'directory-list-thumb' ) );
				echo sprintf( '<a href="%s" class="directory-name">%s</a>', esc_url( $dir_url ), esc_html( $dir_name ) );
				?>
            </article>
			<?php
		}
	}
	?>
</div>