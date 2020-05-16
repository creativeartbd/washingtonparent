<?php
function wdp_wpa_register_post_types() {
	// Special Needs
	$args = array(
		'labels'             => wpa_get_post_labels( 'Special Needs', 'Special Need', 'Special Needs' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'special-needs' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'special_need', $args );

	// Education
	$args = array(
		'labels'             => wpa_get_post_labels( 'Education', 'Education', 'Education' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'education' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'education', $args );

	// family wellness
	$args = array(
		'labels'             => wpa_get_post_labels( 'Family Wellness', 'Family Wellness', 'Family Wellness' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'family-wellness' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'family_wellness', $args );

	// parent & child
	$args = array(
		'labels'             => wpa_get_post_labels( 'Parent and Child', 'Parent and Child', 'Parent and Child' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'parent-child' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'parent_child', $args );

	// art
	$args = array(
		'labels'             => wpa_get_post_labels( 'Arts', 'Art', 'Arts' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'arts' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'art', $args );

	// party & family fun
	$args = array(
		'labels'             => wpa_get_post_labels( 'Party & Family fun', 'Party', 'Parties' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'party-and-family-fun' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'party', $args );

	// child care fun
	$args = array(
		'labels'             => wpa_get_post_labels( 'Child Care', 'Child Care', 'Child Care' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'child-care' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'child_care', $args );

	// enrichment
	$args = array(
		'labels'             => wpa_get_post_labels( 'Enrichment', 'Enrichment', 'Enrichments' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'enrichment' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'enrichment', $args );

	// explorations
	$args = array(
		'labels'             => wpa_get_post_labels( 'Explorations', 'Exploration', 'Explorations' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'explorations' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'exploration', $args );

	// montessori schools
	$args = array(
		'labels'             => wpa_get_post_labels( 'Montessori Schools', 'Montessori School', 'Montessori Schools' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'montessori-schools' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'montessori_schools', $args );

	// New parents
	$args = array(
		'labels'             => wpa_get_post_labels( 'New parents', 'Parent', 'New parents' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'new-parents' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'new_parents', $args );

	// Open houses
	$args = array(
		'labels'             => wpa_get_post_labels( 'Open houses', 'Open house', 'Open houses' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'open-houses' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'open_house', $args );

	// sleep away camp
	$args = array(
		'labels'             => wpa_get_post_labels( 'Sleep Away Camp', 'Camp', 'Sleep Away Camp' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'sleep-away-camp' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'sleepaway_camp', $args );

	// Spring Break camp
	$args = array(
		'labels'             => wpa_get_post_labels( 'Spring Break Camp', 'Camp', 'Spring Break Camp' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'spring-break-camp' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'springbreak_camp', $args );

	// summer camp
	$args = array(
		'labels'             => wpa_get_post_labels( 'Summer Camp', 'Camp', 'Summer Camp' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'summer-camp' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'summer_camp', $args );

	// winter break camp
	$args = array(
		'labels'             => wpa_get_post_labels( 'Winter Break Camp', 'Camp', 'Winter Break Camp' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'winter-break-camp' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'winter_camp', $args );

	// tutor
	$args = array(
		'labels'             => wpa_get_post_labels( 'Tutors', 'Tutor', 'Tutors' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-category',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'tutors' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'tutor', $args );
}

add_action( 'init', 'wdp_wpa_register_post_types' );

function wdp_wpa_register_taxonomies() {
	/* special needs category */
	register_taxonomy( 'needs_category', array( 'special_need' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'special-needs-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* education category */
	register_taxonomy( 'education_category', array( 'education' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'education-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* family wellness category */
	register_taxonomy( 'wellness_category', array( 'family_wellness' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'family-wellness-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* parent & child category */
	register_taxonomy( 'parentchild_category', array( 'parent_child' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'parent-child-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* art category */
	register_taxonomy( 'art_category', array( 'art' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'art-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* party category */
	register_taxonomy( 'party_category', array( 'party' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'party-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* child care category */
	register_taxonomy( 'childcare_category', array( 'child_care' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'child-care-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* enrichment category */
	register_taxonomy( 'enrichment_category', array( 'enrichment' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'enrichment-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* enrichment category */
	register_taxonomy( 'exploration_category', array( 'exploration' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'exploration-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* montessori schools category */
	register_taxonomy( 'montessori_category', array( 'montessori_schools' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'montessori-schools-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* new parents category */
	register_taxonomy( 'newparents_category', array( 'new_parents' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'new-parents-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* open house category */
	register_taxonomy( 'house_category', array( 'open_house' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'house-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* sleep away camp category */
	register_taxonomy( 'sacamp_category', array( 'sleepaway_camp' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'sleep-away-camp-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* spring break camp category */
	register_taxonomy( 'spbcamp_category', array( 'springbreak_camp' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'spring-break-camp-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* summer camp category */
	register_taxonomy( 'summercamp_category', array( 'summer_camp' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'summer-camp-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* winter break camp category */
	register_taxonomy( 'wincamp_category', array( 'winter_camp' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'winter-break-camp-category',
		'query_var'         => true,
		'primary'           => true,
	) );

	/* tutor category */
	register_taxonomy( 'tutor_category', array( 'tutor' ), array(
		'hierarchical'      => true,
		'labels'            => wpa_get_taxonomy_label( 'Categories', 'Category', 'Categories' ),
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => 'tutor-category',
		'query_var'         => true,
		'primary'           => true,
	) );

}

add_action( 'init', 'wdp_wpa_register_taxonomies' );

function wpa_get_post_labels( $menu_name, $singular, $plural, $type = 'plural' ) {
	$labels = array(
		'name'               => 'plural' == $type ? $plural : $singular,
		'all_items'          => sprintf( __( "All %s", 'wp-radio' ), $plural ),
		'singular_name'      => $singular,
		'add_new'            => sprintf( __( 'Add New %s', 'wp-radio' ), $singular ),
		'add_new_item'       => sprintf( __( 'Add New %s', 'wp-radio' ), $singular ),
		'edit_item'          => sprintf( __( 'Edit %s', 'wp-radio' ), $singular ),
		'new_item'           => sprintf( __( 'New %s', 'wp-radio' ), $singular ),
		'view_item'          => sprintf( __( 'View %s', 'wp-radio' ), $singular ),
		'search_items'       => sprintf( __( 'Search %s', 'wp-radio' ), $plural ),
		'not_found'          => sprintf( __( 'No %s found', 'wp-radio' ), $plural ),
		'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'wp-radio' ), $plural ),
		'parent_item_colon'  => sprintf( __( 'Parent %s:', 'wp-radio' ), $singular ),
		'menu_name'          => $menu_name,
	);

	return $labels;
}

function wpa_get_taxonomy_label( $menu_name, $singular, $plural ) {
	$labels = array(
		'name'              => sprintf( _x( '%s', 'taxonomy general name', 'wp-radio' ), $plural ),
		'singular_name'     => sprintf( _x( '%s', 'taxonomy singular name', 'wp-radio' ), $singular ),
		'search_items'      => sprintf( __( 'Search %', 'wp-radio' ), $plural ),
		'all_items'         => sprintf( __( 'All %s', 'wp-radio' ), $plural ),
		'parent_item'       => sprintf( __( 'Parent %s', 'wp-radio' ), $singular ),
		'parent_item_colon' => sprintf( __( 'Parent %s:', 'wp-radio' ), $singular ),
		'edit_item'         => sprintf( __( 'Edit %s', 'wp-radio' ), $singular ),
		'update_item'       => sprintf( __( 'Update %s', 'wp-radio' ), $singular ),
		'add_new_item'      => sprintf( __( 'Add New %s', 'wp-radio' ), $singular ),
		'new_item_name'     => sprintf( __( 'New % Name', 'wp-radio' ), $singular ),
		'menu_name'         => __( $menu_name, 'wp-radio' ),
	);

	return $labels;
}

//directory post type listing
function add_wpa_directory_listing_post_type( $listings ) {
	$listings = array_merge( $listings, array(
		'education',
		'special_need',
		'family_wellness',
		'parent_child',
		'art',
		'party',
		'child_care',
		'enrichment',
		'exploration',
		'montessori_schools',
		'new_parents',
		'open_house',
		'sleepaway_camp',
		'springbreak_camp',
		'summer_camp',
		'winter_camp',
		'tutor',
	) );

	return $listings;
}

add_filter( 'wdp_listing_post_types', 'add_wpa_directory_listing_post_type' );
