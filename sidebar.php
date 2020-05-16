<?php
/**
 * The sidebar containing the main widget area
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<div class="col-md-4 widget-area custom-sidebar" id="secondary" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</div><!-- #secondary -->
