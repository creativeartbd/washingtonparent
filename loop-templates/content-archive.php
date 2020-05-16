<?php
	/**
	 * Post rendering content archive
	 *
	 * @package everstrap
	 */

	// Exit if accessed directly.
	defined( 'ABSPATH' ) || exit;

	$post_thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) { ?>
        <div class="post-thumbnail" style="background: url(<?php echo esc_url( $post_thumbnail ) ?>)">
            <a href="<?php echo esc_url( get_permalink() ); ?>"></a>
        </div>
	<?php } ?>
    <header class="entry-header">
		<?php
			everstrap_post_categories();
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?>
        <div class="entry-content">
			<?php
				if ( ! has_excerpt() ) :
					echo wp_trim_words( wp_strip_all_tags( get_the_content() ), 30, '' );
				else :
					echo wp_strip_all_tags( get_the_excerpt() );
				endif;
			?>
        </div>
        <div class="entry-meta">
			<?php
				everstrap_posted_on();
			?>
        </div>

    </header><!-- .entry-header -->

</article><!-- #post-## -->
