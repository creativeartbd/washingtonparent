<?php
/**
 * This template is using for displaying sponsored event post
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php
$startdate           = ecp_get_event_meta( get_the_ID(), 'startdate' );
$enddate             = ecp_get_event_meta( get_the_ID(), 'enddate' );
$starttime           = ecp_get_event_meta( get_the_ID(), 'starttime' );
$endtime             = ecp_get_event_meta( get_the_ID(), 'endtime' );

$startdate_strtotime = strtotime(  $startdate );
$enddate_strtotime   = strtotime(  $enddate );

$start_month         = date('M', $startdate_strtotime );
$start_date          = date('d', $startdate_strtotime );

$end_month           = date('M', $enddate_strtotime );
$end_date            = date('d', $enddate_strtotime );

?>
<article <?php post_class( 'sponosred-event' ); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-thumbnail">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php echo get_the_post_thumbnail( get_the_ID(), 'featured-event-thumb' ); ?>
		</a>
	</div>
	<?php } ?>
	<header class="entry-header">
        <div class="sponosred">Sponsored</div>
		<?php
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        ?>
        <div class="entry-meta">
            <p>
                <?php
                    echo $start_month . ' ' . $start_date . ' - ' . $end_month . ' '  . $end_date . ' @ ' . $starttime;
                ?>
            </p>
        </div>
		<div class="entry-content">
            <?php
            $excerpt = get_the_excerpt();
            echo '<p>' . substr( $excerpt, 0, 100 ) . '</p>';
            ?>
        </div>

	</header><!-- .entry-header -->
</article><!-- #post-## -->
