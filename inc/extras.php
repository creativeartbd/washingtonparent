<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package everstrap
 */

//phpcs:ignore PHPCompatibility.Syntax.NewShortArray.Found

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Everstrap sponsored category post
 */

if( !function_exists( 'everstrap_sponsored_post' ) ) {

	function everstrap_sponsored_post( $post_id, $image_size, $post_class, $show_content = null ) {

		if( empty( $post_id ) || empty( $image_size ||  empty( $post_class ) ) ) {
			return;
		}				

		$category = get_the_category( $post_id );
		$thumbnail = get_the_post_thumbnail( $post_id, $image_size );
		$post_permalink = get_post_permalink( $post_id );
		$category_name = $category[0]->name;
		$category_id = $category[0]->term_id;
		$category_url = get_term_link( $category_id );
			

		?>
		<article <?php post_class( $post_class ); ?> id="post-<?php echo $post_id; ?>">
			<?php if ( $thumbnail ) { ?>
			<div class="post-thumbnail">
				<a href="<?php echo $post_permalink; ?>">
					<?php echo $thumbnail; ?>
				</a>
			</div>
			<?php } ?>
			<header class="entry-header">
				<?php
				echo '<div class="post-category">';
					echo '<div class="sponsored-post">';
						echo 'sponsored content';
					echo '</div>';
				echo '</div>';				
				
				echo '<h2 class="entry-title">';
					echo '<a href="'. $post_permalink.'">';
						echo get_the_title( $post_id );
					echo '</a>';
				echo '</h2>';
				
				?>				
				<div class="entry-meta">
					<?php
					//everstrap_posted_on();
					?>
				</div>

				<?php 
				if( true === $show_content ) {
					echo '<div class="post-content">';					
						$excerpt = get_the_excerpt(); 
						echo '<p>' . substr( $excerpt, 0, 170 ) . '</p>';					
					echo '</div>';
				}
				?>
				
			</header><!-- .entry-header -->
			</article><!-- #post-## -->
		<?php
	}
}

/*
 * Get post by category slug
 */

if( !function_exists( 'everstrap_get_post_by_cat_slug' ) ) {

	function everstrap_get_post_by_cat_slug( $args )	{

		global $post;

		$args = wp_parse_args( $args , [
			'post_type' => 'post',
			'posts_per_page' => 2,
			'orderby' => 'publish_date',			
		]);
		
		$posts = get_posts( $args );

		if( $posts ) {		
			echo '<div class="category-post-wrapper">';
				echo '<div class="row">';

					$category = get_category_by_slug( $args['category_name'] );
					$category_name = $category->name;
					$category_link = get_category_link( $category->term_id );
					
					echo '<div class="col-md-12">';
						echo '<article class="home-editors-pick-post">'; 
							echo '<div class="section-title-wrapper">';
								echo '<div class="section-title">';
									echo '<h2>';
										echo '<a href="'.$category_link.'">'.$category_name.'</a>';
									echo '</h2>';
								echo '</div>';
								echo '<div class="see-more text-right">';
									echo '<a href="'. $category_link .'">See More ></a>';
								echo '</div>';
							echo '</div>';
						echo '</article>';
					echo '</div>';
					
					foreach( $posts as $post ) {
						setup_postdata( $post );					
						echo '<div class="col-md-6">';
							get_template_part( 'loop-templates/content', 'home-category-post' );
						echo '</div>';					
					}					
					
				echo '</div>';
			echo '</div>';
			
			wp_reset_postdata();
		}
	}
}

/*
 * Custom function for ACF
 */

if( !function_exists( 'everstrap_get_field' ) ) {

	function everstrap_get_field( $field_name, $id = null )	{

		if (class_exists('acf')) {

			if (empty($field_name)) {
				return;
			}

			$data = get_field($field_name);

			if ( $id ) {
				$data = get_field( $field_name, $id );
			}

			if ( $data ) {
				//return do_shortcode($data);
				return $data;
			} else {
				return false;
			}
		}
	}
}


/**
 * Everstrap site Logo
 */

if( !function_exists( 'everstrap_site_logo' ) ) {
	function everstrap_site_logo( $acf_field_name ) {

		if( ! $acf_field_name )
			return false;

		$get_logo = everstrap_get_field( $acf_field_name, 'option' );

		$site_url = site_url( '/' );

		if( !$get_logo )
			return false;

		$logo_size =  $get_logo['sizes'][$acf_field_name];

		if( $logo_size ) 
			return sprintf( '<a href="%s" class="%s"><img src="%s"></a>', $site_url, $acf_field_name, $logo_size );
	}
}


add_filter( 'body_class', 'everstrap_body_classes' );

if ( ! function_exists( 'everstrap_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function everstrap_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter( 'body_class', 'everstrap_adjust_body_class' );

if ( ! function_exists( 'everstrap_adjust_body_class' ) ) {
	/**
	 * Setup body classes.
	 *
	 * @param string $classes CSS classes.
	 *
	 * @return mixed
	 */
	function everstrap_adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( 'tag' === $value ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;

	}
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'everstrap_change_logo_class' );

if ( ! function_exists( 'everstrap_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return mixed
	 */
	function everstrap_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}
}

/**
 * Display navigation to next/previous post when applicable.
 */

if ( ! function_exists( 'everstrap_post_nav' ) ) {
	/**
	 * Prints post navigation
	 */
	function everstrap_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="container navigation post-navigation">
			<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'everstrap' ); ?></h2>
			<div class="row nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'everstrap' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'everstrap' ) );
				}
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'everstrap_pingback' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function everstrap_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'everstrap_pingback' );

if ( ! function_exists( 'everstrap_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function everstrap_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'everstrap_mobile_web_app_meta' );


/**
 * Primary Taxonomy Function
 *
 * @param bool $post_id
 * @param string $taxonomy
 *
 * @return array|bool|null|WP_Error|WP_Term
 */
if ( ! function_exists( 'everstrap_get_primary_term' ) ) {
	function everstrap_get_primary_term( $post_id = false, $taxonomy = 'category' ) {
		if ( ! $taxonomy ) {
			return false;
		}

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			if ( $wpseo_primary_term ) {
				return get_term( $wpseo_primary_term );
			}
		}

		$terms = get_the_terms( $post_id, $taxonomy );

		if ( ! $terms || is_wp_error( $terms ) ) {
			return false;
		}

		return $terms[0];
	}
}


/**
 * Social Share Function
 *
 * @param $post_id
 * @param $type
 *
 * @return string
 */
if ( ! function_exists( 'everstrap_get_share_link' ) ) {
	function everstrap_get_share_link( $post_id, $type ) {
		$url = '';
		switch ( $type ) {
			case 'facebook':
				$url = add_query_arg(
					[
						'u'       => get_the_permalink( $post_id ),
						'[title]' => apply_filters( 'everstrap_share_fb_title', get_the_title( $post_id ) ),
					],
					'http://www.facebook.com/sharer.php'
				);
				break;

			case 'twitter':
				$url = add_query_arg(
					[
						'url'  => get_the_permalink( $post_id ),
						'text' => apply_filters( 'everstrap_share_twitter_text', get_the_title( $post_id ) ),
						'via'  => '',
					],
					'http://twitter.com/share'
				);
				break;

			case 'linkedin':
				$url = add_query_arg(
					[
						'url'     => get_the_permalink( $post_id ),
						'title'   => apply_filters( 'everstrap_share_twitter_text', wp_strip_all_tags( get_the_title( $post_id ) ) ),
						'summary' => get_post_field( 'the_excerpt', $post_id ),
					],
					'https://www.linkedin.com/shareArticle?mini=true'
				);
				break;

			case 'email':
				$url = add_query_arg(
					[
						'subject' => 'I thought you might be interested in this article',
						'body'    => sprintf( 'Check out this site %s ', get_the_permalink( $post_id ) ),
					],
					'mailto:'
				);
				break;
		}

		return $url;
	}


}

/**
 * Update event calendar pro new metabox value
 */

function everstrap_save_event_meta( $post_id, $posted ) {

	$sponsored       = ! empty( $posted['sponsored'] ) ? sanitize_text_field( $posted['sponsored'] ): '';
	$featured        = ! empty( $posted['featured'] ) ? sanitize_text_field( $posted['featured'] )  : '';
	$readersubmitted = ! empty( $posted['readersubmitted'] ) ? sanitize_text_field( $posted['readersubmitted'] ) : '';
	
	
	$buy_ticket             = ! empty( $posted['buy_ticket'] ) ? sanitize_text_field( $posted['buy_ticket'] ) : '';
	$featured_description   = ! empty( $posted['featured_description'] ) ? $posted['featured_description'] : '';
	$cost_door              = ! empty( $posted['cost_door'] ) ? sanitize_text_field( $posted['cost_door'] ) : '';

	update_post_meta( $post_id, 'sponsored', $sponsored );
	update_post_meta( $post_id, 'featured', $featured );
	update_post_meta( $post_id, 'readersubmitted', $readersubmitted );

	update_post_meta( $post_id, 'buy_ticket', $buy_ticket );
	update_post_meta( $post_id, 'featured_description', $featured_description );
	update_post_meta( $post_id, 'cost_door', $cost_door );
}

add_action( 'event_calendar_pro_event_saved', 'everstrap_save_event_meta', 11, 2 );

/**
 * Get lat and long by given address
 */
// function to get  the address
function get_lat_long($address){

    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=AIzaSyBfv6xa1-HwWw_KQEG7nFNdP6k1Td_a-oA");
	$json = json_decode($json);
	
	// echo '<pre>';
	// 	print_r( $json );
	// echo '</pre>';

    // $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    // $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    // return $lat.','.$long;
}

function ecp_get_event_list_extended( $args = array(), $count = false ) {
	global $wpdb;

	$post_type = 'pro_event';

	$args = wp_parse_args( $args, array(
		'number'     => get_option( 'posts_per_page' ),
		'offset'     => 0,
		'search'     => '',
		'date'       => date( 'Y-m-d', current_time( 'timestamp' ) ),
		'start_date' => '',
		'end_date'   => '',
		'location'   => '',
		'categories' => '',
		'orderby'    => 'events.start_date',
		'order'      => 'DESC',
		'meta_query' => array()
	) );

	if ( empty( $args['start_date'] ) && empty( $args['date'] ) ) {
		$args['date'] = date( 'Y-m-d', current_time( 'timestamp' ) );
	}

	if ( $args['orderby'] == 'id' ) {
		$args['orderby'] = 'p.ID';
	}

	if ( $args['orderby'] == 'title' ) {
		$args['orderby'] = 'p.post_title';
	}

	if ( $args['number'] < 1 ) {
		$args['number'] = 9999999;
	}

	$where = ' WHERE 1=1 ';
	$join  = "LEFT JOIN {$wpdb->prefix}ecp_events events on events.post_id=p.ID ";

	// Specific id
	if ( ! empty( $args['id'] ) ) {

		if ( is_array( $args['id'] ) ) {
			$ids = implode( ',', array_map( 'intval', $args['id'] ) );
		} else {
			$ids = intval( $args['id'] );
		}

		$where .= " AND p.ID IN( {$ids} ) ";
	}

	// exclude id
	if ( ! empty( $args['not_in'] ) ) {

		if ( is_array( $args['not_in'] ) ) {
			$ids = implode( ',', array_map( 'intval', $args['not_in'] ) );
		} else {
			$ids = intval( $args['not_in'] );
		}

		$where .= " AND p.ID NOT IN( {$ids} ) ";
	}

	if ( ! empty( $args['search'] ) ) {
		$where .= " AND ( p.post_title LIKE '%%" . esc_sql( $args['search'] ) . "%%' OR p.post_content LIKE '%%" . esc_sql( $args['search'] ) . "%%' OR ms.meta_value LIKE '%%" . esc_sql( $args['search'] ) . "%%')";
	}

	// Meta Value Query

	if( isset( $args['meta_query'] ) && ! empty( $args['meta_query'] ) ){	
		foreach( $args['meta_query'] as $key => $value ){
			if( isset( $key ) && isset( $value ) ){
				if(! empty( $key ) && ! empty( $value ) ){
					$join .= " LEFT JOIN $wpdb->postmeta mq_$key ON mq_$key.post_id = p.ID ";
					$where .= " AND mq_$key.meta_key = '$key' AND mq_$key.meta_value = '$value' ";
				}
			}
		}		
	}

	// Meta Value Query

	//Default list query (Select all events, which enddate is >= currentdate)
	if ( ! empty( $args['date'] ) ) {
		$where .= " AND date(events.start_date) >= date('{$args['date']}') ";
	}

	if ( ! empty( $args['start_date'] ) && ! empty( $args['end_date'] ) ) {
		$where .= " AND date(events.start_date) >= date('{$args['start_date']}') AND  date(events.start_date) <= date('{$args['end_date']}') ";
	} else {

		if ( ! empty( $args['start_date'] ) ) {
			//$where .= " AND date(events.start_date) = date('{$args['start_date']}') ";
		}

		if ( ! empty( $args['end_date'] ) ) {
			$where .= " AND date(events.start_date) <= date('{$args['end_date']}') ";
		}

	}

	if ( ! empty( $args['categories'] ) ) {
		if ( is_array( $args['categories'] ) ) {
			$categories = implode( ',', array_map( 'intval', $args['categories'] ) );
		} else {
			$categories = intval( $args['categories'] );
		}

		$join  .= " INNER JOIN $wpdb->term_relationships tr on tr.object_id=p.ID";
		$where .= " AND tr.term_taxonomy_id IN ('$categories') ";
	}

	if ( ! empty( $args['featured'] ) ) {
		$join .= " LEFT JOIN $wpdb->postmeta featured ON featured.post_id = p.ID ";
	}

	$join .= " LEFT JOIN $wpdb->postmeta m ON m.post_id = p.ID ";
	$join .= " LEFT JOIN $wpdb->postmeta ms ON ms.post_id = p.ID ";
	$join = apply_filters( 'ecp_sql_join', $join, $args );

	$meta_key = apply_filters( 'ecp_select_meta_key', 'startdate' );
	$where    .= " AND m.meta_key = '$meta_key' ";
	$where    .= " AND ms.meta_key IN ('location', 'address', 'zip', 'city') ";

	if ( ! empty( $args['location'] ) ) {
		$like  = '%' . $wpdb->esc_like( $args['location'] ) . '%';
		$where .= ' AND ' . $wpdb->prepare( "ms.meta_value LIKE %s", $like );
	}

	$where .= " AND p.post_status = 'publish' AND p.post_type = '{$post_type}' ";

	if ( ! empty( $args['featured'] ) ) {
		$where .= " AND featured.meta_key = 'featured' AND featured.meta_value = 'yes' ";
	}

	$where = apply_filters( 'ecp_sql_where', $where, $args );	

	$args['orderby'] = esc_sql( $args['orderby'] );
	$args['order']   = esc_sql( $args['order'] );	

	//if count
	if ( $count ) {
		$total = $wpdb->get_col( "select p.ID FROM $wpdb->posts p $join $where GROUP BY p.ID " );

		return count( $total );
	}

	$distinct = apply_filters( 'ecp_select_distinct_event', null );
	$group_by = apply_filters( 'ecp_group_by_event', ' GROUP BY p.ID ' );
	
	$sql = $wpdb->prepare( "SELECT {$distinct} m.meta_value, p.ID, p.post_title, p.post_content, p.post_excerpt, events.start_date, events.end_date, events.start_time, events.end_time FROM $wpdb->posts p $join $where {$group_by} ORDER BY  {$args['orderby']} {$args['order']} , events.start_time ASC LIMIT %d,%d ; ", absint( $args['offset'] ), absint( $args['number'] ) );
	

	return $wpdb->get_results( $sql );
}
