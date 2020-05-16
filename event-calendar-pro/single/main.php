<?php
/**
 * Displaying event page all data
 *
 * @package everstrap
 */

global $post;

ecp_get_template( 'single/start.php' );
echo ecp_get_recurrence_message( $post->ID );
ecp_get_template( 'single/content.php' );
ecp_get_template( 'single/end.php' );
