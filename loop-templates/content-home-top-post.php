<?php
/**
 * Template for displaying home top post
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'home-top-post' ); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-thumbnail">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php echo get_the_post_thumbnail( get_the_ID(), 'full-thumb' ); ?>
		</a>
	</div>
	<?php } ?>
	<header class="entry-header">
		<?php
		everstrap_post_categories();
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        ?>		
        
		<div class="entry-meta">
			<?php
			everstrap_posted_on();
			?>
        </div>
        
	</header><!-- .entry-header -->
</article><!-- #post-## -->
