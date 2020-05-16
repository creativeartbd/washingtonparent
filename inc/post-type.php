<?php



//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// Register taxonomy for Issues
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

function register_post_issue_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Issues', 'everstrap' ),
		'singular_name'              => _x( 'Issue', 'everstrap' ),
		'search_items'               => _x( 'Search Issue', 'everstrap' ),
		'popular_items'              => _x( 'Popular Issue', 'everstrap' ),
		'all_items'                  => _x( 'All Issues', 'everstrap' ),
		'parent_item'                => _x( 'Parent Issue', 'everstrap' ),
		'parent_item_colon'          => _x( 'Parent Issue:', 'everstrap' ),
		'edit_item'                  => _x( 'Edit Issue', 'everstrap' ),
		'update_item'                => _x( 'Update Issue', 'everstrap' ),
		'add_new_item'               => _x( 'Add New Issue', 'everstrap' ),
		'new_item_name'              => _x( 'New Issue', 'everstrap' ),
		'separate_items_with_commas' => _x( 'Separate partners with commas', 'everstrap' ),
		'add_or_remove_items'        => _x( 'Add or remove partners', 'everstrap' ),
		'choose_from_most_used'      => _x( 'Choose from most used partners', 'everstrap' ),
		'menu_name'                  => _x( 'Issues', 'everstrap' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'show_admin_column' => true,
		'rewrite'           => array(
			'slug'       => 'issues',
			'with_front' => true
		),
		'query_var'         => true
	);

	register_taxonomy( 'issues', array( 'post' ), $args );
}

add_action( 'init', 'register_post_issue_taxonomy' );


