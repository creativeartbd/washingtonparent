<?php

/**
 * Single post partial template
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class('single-post'); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<?php 
		$is_sponsored = everstrap_get_field( 'sponsored_post', get_the_ID() );
		if( $is_sponsored ) {
			echo '<div class="sponsored-wrapper">';
				echo '<div class="sponsored-post">Sponsored Content</div>';
				$sponsored_logo = everstrap_get_field( 'sponsored_logo', get_the_ID() );				
				if( $sponsored_logo ) {
					$sponsored_logo_size = $sponsored_logo['sizes']['sponsored-logo'];
					echo '<img src="'. $sponsored_logo_size .'" />';
				}
			echo '</div>';
		}
		everstrap_post_categories();		
		?>
		
		<?php the_title('<h2 class="entry-title">', '</h2>'); ?>
		<div class="entry-meta">
			<div class="excerpt">
				<?php echo get_the_excerpt(); ?>
			</div>
			<?php
			$author_first_name = get_the_author_meta('first_name');
			$author_last_name  = get_the_author_meta('last_name');

			$author_id         = get_the_author_meta('ID');
			$post_author_page  = get_author_posts_url($author_id);
			?>
			<p>By <a href="<?php echo $post_author_page ?>"><?php echo $author_first_name . ' ' . $author_last_name; ?></a> and Edgard Segura, MD <br /> <?php echo get_the_date(); ?></p>

		</div><!-- .entry-meta -->
		<?php everstrap_post_social_share(get_the_ID(), ['twitter', 'facebook', 'print', 'envelope', 'link']); ?>

	</header><!-- .entry-header -->

	<div class="entry-content" id="entry-content">
		<?php
		if (has_post_thumbnail()) {
			echo '<div class="post-thumbnail">';
			echo get_the_post_thumbnail($post->ID, 'medium-thumb');
			if (get_the_post_thumbnail_caption()) {
				echo '<div class="thumb-caption">';
				echo get_the_post_thumbnail_caption();
				echo '</div>';
			}
			echo '</div>';
		}
		?>

		<?php the_content(); ?>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __('Pages:', 'everstrap'),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php everstrap_post_social_share(get_the_ID(), ['twitter', 'facebook', 'print', 'envelope', 'link'], 'Share This'); ?>
		<div class="post-authors-wrapper">
			<div class="post-author">
				<div class="author-thumb">
					<?php
					echo get_avatar(get_the_author_meta('ID'), 64);
					?>
				</div>
				<div class="author-meta">
					<h2><a href="<?php echo $post_author_page ?>"><?php echo $author_first_name . ' ' . $author_last_name; ?></a></h2>
					<p><?php echo get_the_author_meta('description'); ?></p>
				</div>
			</div>
		</div>
		<?php everstrap_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<div class="post-comment">
		<?php
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
		?>
	</div>
</article><!-- #post-## -->