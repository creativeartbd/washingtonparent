<?php
/**
 * Template Name: Directory Listing Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published
 *
 * @package themeplate
 */

get_header( 'directory' ); ?>

<div class="wpa-directory-listing-wrapper" id="page-wrapper">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; ?>

</div>

<?php get_footer(); ?>
