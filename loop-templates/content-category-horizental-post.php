<?php
/**
 * Template for displaying home latest stories / post
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'home-latest-stories' ); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-thumbnail">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php echo get_the_post_thumbnail( get_the_ID(), 'small-thumb' ); ?>
		</a>
	</div>
	<?php } ?>
	<header class="entry-header">
		<?php
		$sponsored_post = get_post_meta( get_the_ID(), 'sponsored_post' );
		if( $sponsored_post ) {
			if( in_array( 1, $sponsored_post ) ) {
				echo '<div class="sponsored-post">Sponsored Post</div>';
			}
		} else {
			everstrap_post_categories();
		}		

		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        ?>	

        <div class="entry-content">
            <?php 
            $excerpt = get_the_excerpt(); 
            echo '<p>' . substr( $excerpt, 0, 170 ) . '</p>';
            ?>
		</div>
        
		<div class="entry-meta">
			<?php
			everstrap_posted_on();
			?>
        </div>
        
	</header><!-- .entry-header -->
</article><!-- #post-## -->
