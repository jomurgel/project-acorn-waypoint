<?php
/**
 * Custom post types and/or taxonomies.
 *
 * @package Acorn Theme
 */

/**
 * Register Custom Post Types
 */
function acorn_theme_register_custom_post_types() {

	$custom_post_types = array(
		array(
			'slug'       => __( 'custom-post-type', 'acorn' ),
			'name'       => __( 'Custom Post Type', 'acorn' ),
			'short_name' => __( 'CPT', 'acorn' ),
			'dashicon'   => 'dashicons-editor-code',
		),
	);

	foreach ( $custom_post_types as $cpt ) {

		$labels = array(
			'name'                  => $cpt['name'],
			'singular_name'         => $cpt['name'],
			'menu_name'             => $cpt['name'],
			'name_admin_bar'        => $cpt['name'],
			'archives'              => $cpt['name'] . __( ' Archives', 'acorn' ),
			'attributes'            => $cpt['name'] . __( ' Attributes', 'acorn' ),
			'parent_item_colon'     => __( 'Parent ', 'acorn' ) . $cpt['name'] . ':',
			'all_items'             => __( 'All ', 'acorn' ) . $cpt['name'],
			'add_new_item'          => __( 'Add ', 'acorn' ) . $cpt['short_name'],
			'add_new'               => __( 'Add New ', 'acorn' ) . $cpt['short_name'],
			'new_item'              => __( 'New ', 'acorn' ) . $cpt['short_name'],
			'edit_item'             => __( 'Edit ', 'acorn' ) . $cpt['short_name'],
			'update_item'           => __( 'Update ', 'acorn' ) . $cpt['short_name'],
			'view_item'             => __( 'View ', 'acorn' ) . $cpt['short_name'],
			'view_items'            => __( 'View ', 'acorn' ) . $cpt['short_name'],
			'search_items'          => __( 'Search ', 'acorn' ) . $cpt['short_name'],
			'not_found'             => __( 'Not found', 'acorn' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'acorn' ),
			'featured_image'        => __( 'Featured Image', 'acorn' ),
			'set_featured_image'    => __( 'Set featured image', 'acorn' ),
			'remove_featured_image' => __( 'Remove featured image', 'acorn' ),
			'use_featured_image'    => __( 'Use as featured image', 'acorn' ),
			'insert_into_item'      => __( 'Insert into item', 'acorn' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'acorn' ),
			'items_list'            => __( 'Items list', 'acorn' ),
			'items_list_navigation' => __( 'Items list navigation', 'acorn' ),
			'filter_items_list'     => __( 'Filter items list', 'acorn' ),
		);

		$args = array(
			'label'               => $cpt['name'],
			'description'         => $cpt['name'] . __( ' projects', 'acorn' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail', 'page-attributes', 'excerpt' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => $cpt['dashicon'],
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
		);
		register_post_type( $cpt['slug'], $args );
	}
}
add_action( 'init', 'acorn_theme_register_custom_post_types', 0 );