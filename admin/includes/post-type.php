<?php
if ( ! function_exists('firetree_plugin_repo_post_type') ) {

// Register Custom Post Type
function firetree_plugin_repo_post_type() {

	$labels = array(
		'name'                => _x( 'Plugin Repo', 'Post Type General Name', 'firetree-plugin-repo' ),
		'singular_name'       => _x( 'Plugin Repo', 'Post Type Singular Name', 'firetree-plugin-repo' ),
		'menu_name'           => __( 'Plugin Repo', 'firetree-plugin-repo' ),
		'parent_item_colon'   => __( 'Parent Repo:', 'firetree-plugin-repo' ),
		'all_items'           => __( 'All Plugins', 'firetree-plugin-repo' ),
		'view_item'           => __( 'View Plugin', 'firetree-plugin-repo' ),
		'add_new_item'        => __( 'Add New Plugin', 'firetree-plugin-repo' ),
		'add_new'             => __( 'Add New', 'firetree-plugin-repo' ),
		'edit_item'           => __( 'Edit Plugin', 'firetree-plugin-repo' ),
		'update_item'         => __( 'Update Plugin', 'firetree-plugin-repo' ),
		'search_items'        => __( 'Search Plugins', 'firetree-plugin-repo' ),
		'not_found'           => __( 'Not found', 'firetree-plugin-repo' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'firetree-plugin-repo' ),
	);
	$args = array(
		'label'               => __( 'firetree_plugin_repo', 'firetree-plugin-repo' ),
		'description'         => __( 'Host your own plugin repository.', 'firetree-plugin-repo' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'author', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-update',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
	);
	register_post_type( 'firetree_plugin_repo', $args );

}

// Hook into the 'init' action
add_action( 'init', 'firetree_plugin_repo_post_type', 0 );

}
?>