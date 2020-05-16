<?php
/**
 * Template for displaying home category post
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'home-editors-pick-post' ); ?> id="post-<?php the_ID(); ?>">	
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-thumbnail">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php echo get_the_post_thumbnail( get_the_ID(), 'medium-thumb' ); ?>
		</a>
	</div>
	<?php } ?>
	<header class="entry-header">
		<?php
		everstrap_post_categories();
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        ?>	
    </header><!-- .entry-header -->
    
</article><!-- #post-## -->
