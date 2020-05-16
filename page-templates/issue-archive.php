<?php

	/**
	 * Template Name: Issue Archive
	 *
	 * @package everstrap
	 */

// Exit if accessed directly.
	defined( 'ABSPATH' ) || exit;

	get_header();
?>

    <div class="wrapper" id="index-wrapper">
        <div class="container back-issues issue-archive-wrapper" id="content" tabindex="-1">
            <div class="row mb-40">

	            <?php if ( is_active_sidebar( 'home-970-90-ad' ) ) : ?>
                    <div class="col-md-12 text-center mt-5">
			            <?php dynamic_sidebar( 'home-970-90-ad' ); ?>
                    </div>
	            <?php endif; ?>

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2 class="issue-title"><?php echo get_the_title(); ?></h2>
                    </div>
                </div>

                <form action="" class="issues-search" method="GET">
                    <div class="row">
                        <div class="col">
                            <select class="form-control issue-select" name="select-issue-year" id="issue_year">

								<?php
									$_value = '';
									if ( isset( $_GET['select-issue-year'] ) ) {
										$_value = $_GET['select-issue-year'];
									}
									$_last_year    = 2006;
									$_current_year = (int) date( 'Y' );

									for ( $i = $_current_year; $i >= $_last_year; $i -- ) {
										?>
                                        <option <?php echo( $_value == $i ? 'selected' : '' ); ?>
                                                value="<?php echo esc_attr( $i ) ?>"><?php echo esc_html__( $i, 'everstrap' ) ?></option>
										<?php
									}
								?>

                            </select>
                        </div>
                        <div class="col">
                            <input type="submit" name="submit" value="Search" class="btn issue-btn">
                        </div>
                    </div>
                </form>
            </div>

            <div class="row issue-archive-inner mb-50">
				<?php

					$args = array(
						'taxonomy' => 'issues',
						'orderby'  => 'term_id',
						'order'    => 'DESC',
						'number'   => 12,
						'search'   => isset( $_GET['select-issue-year'] ) ? $_GET['select-issue-year'] : ''
					);

					$issues = get_terms( $args );

					if ( ! empty( $issues ) ) {
						foreach ( $issues as $issue ) {
							$attachment_id = get_term_meta( $issue->term_id, 'issue_thumbnail', true );
							$attachment    = wp_get_attachment_image_src( $attachment_id, 'issue-thumb' );
							?>

                            <div class="col-lg-3 col-6 mb-4">
                                <article>
                                    <div class="post-thumbnail"
                                         style="background: url(<?php echo esc_url( $attachment[0] ) ?>)">
                                        <a class="post-link"
                                           href="<?php echo get_term_link( $issue->term_id ) ?>"></a>
                                    </div>
                                    <div class="entry-content">
                                        <div class="entry-header text-center">
                                            <h2 class="entry-title">
                                                <a href="<?php echo get_term_link( $issue->term_id ); ?>"><?php echo $issue->name; ?></a>
                                            </h2>

                                            <a class="btn btn-issue common-btn"
                                               href="<?php echo get_term_link( $issue->term_id ) ?>">
												<?php echo esc_html__( 'View Issue', 'everstrap' ); ?>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
							<?php
						}
					} else {
						?>
                        <div class="col-12">
                            <p><?php echo esc_html__( 'No Issue Found!', 'everstrap' ); ?></p>
                        </div>
						<?php
					}
				?>
            </div>


            <div class="row">
				<?php if ( is_active_sidebar( 'home-970-90-ad' ) ) : ?>
                    <div class="col-md-12 text-center mt-5">
						<?php dynamic_sidebar( 'home-970-90-ad' ); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>

<?php
get_footer();
