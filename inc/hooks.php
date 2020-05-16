<?php
	/**
	 * Custom hooks
	 *
	 * @package everstrap
	 */

// Exit if accessed directly.
	defined( 'ABSPATH' ) || exit;

	if ( ! function_exists( 'everstrap_site_info' ) ) {
		/**
		 * Add site info hook to WP hook library.
		 */
		function everstrap_site_info() {
			do_action( 'everstrap_site_info' );
		}
	}

	if ( ! function_exists( 'everstrap_add_site_info' ) ) {
		add_action( 'everstrap_site_info', 'everstrap_add_site_info' );

		/**
		 * Add site info content.
		 */
		function everstrap_add_site_info() {
			$the_theme   = wp_get_theme();
			$curent_year = date( 'Y' );

			$site_info = sprintf(
				'<p class="site-info-text">%1$s<span class="sep"> | </span>%2$s</p>',
				sprintf(
					esc_html__( '© %1$s Magazine ' . $curent_year . ', All rights reserved.', 'everstrap' ),
					'<a href="' . esc_url( __( site_url( '/' ), 'everstrap' ) ) . '">' . $the_theme->get( 'Name' ) . '</a>'
				),
				sprintf(
					esc_html__( 'Website by %1$s .', 'everstrap' ),
					'<a href="' . esc_url( __( 'https://webpublisherpro.com/', 'everstrap' ) ) . '">Web Publisher PRO</a>'
				)
			);

			echo apply_filters( 'everstrap_site_info_content', $site_info );
		}
	}


	add_filter( 'everstrap_posted_on', 'everstrap_posted_on_func' );

	function everstrap_posted_on_func( $data ) {

		$data = '';

		$fname     = get_the_author_meta( 'first_name' );
		$lname     = get_the_author_meta( 'last_name' );
		$full_name = '';

		if ( ! empty( $fname ) || ! empty( $lname ) ) {
			$full_name = "{$fname} {$lname}";
		} else {
			$full_name = get_the_author();

		}

		$data .= $full_name;
		$data .= ' / ';

		return sprintf( "<a href='%s'>%s</a>", get_author_posts_url( get_the_author_meta( 'ID' ) ), $data );
	}

	add_filter( 'everstrap_posted_by', 'everstrap_posted_by_func' );

	function everstrap_posted_by_func( $data ) {
		$data = get_the_date();

		return $data;
	}