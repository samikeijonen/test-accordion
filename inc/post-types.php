<?php
/**
 * Register Post Types.
 *
 * @package TestAccordion
 * @since   1.0.0
 */
 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register Custom Post Type 'participant'.
function test_accordion_participants() {

	$labels = array(
		'name'                  => esc_html_x( 'Participants', 'Post Type General Name', 'test-accordion' ),
		'singular_name'         => esc_html_x( 'Participant', 'Post Type Singular Name', 'test-accordion' ),
		'menu_name'             => esc_html__( 'Participants', 'test-accordion' ),
		'name_admin_bar'        => esc_html__( 'Participant', 'test-accordion' ),
		'archives'              => esc_html__( 'Participant Archives', 'test-accordion' ),
		'parent_item_colon'     => esc_html__( 'Parent Participant:', 'test-accordion' ),
		'all_items'             => esc_html__( 'All Participants', 'test-accordion' ),
		'add_new_item'          => esc_html__( 'Add New Participant', 'test-accordion' ),
		'add_new'               => esc_html__( 'Add New Participant', 'test-accordion' ),
		'new_item'              => esc_html__( 'New Participant', 'test-accordion' ),
		'edit_item'             => esc_html__( 'Edit Participant', 'test-accordion' ),
		'update_item'           => esc_html__( 'Update Participant', 'test-accordion' ),
		'view_item'             => esc_html__( 'View Participant', 'test-accordion' ),
		'search_items'          => esc_html__( 'Search Participant', 'test-accordion' ),
		'not_found'             => esc_html__( 'Not found', 'test-accordion' ),
		'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'test-accordion' ),
		'featured_image'        => esc_html__( 'Participant Image', 'test-accordion' ),
		'set_featured_image'    => esc_html__( 'Set participant image', 'test-accordion' ),
		'remove_featured_image' => esc_html__( 'Remove participant image', 'test-accordion' ),
		'use_featured_image'    => esc_html__( 'Use as participant image', 'test-accordion' ),
		'insert_into_item'      => esc_html__( 'Insert into item', 'test-accordion' ),
		'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'test-accordion' ),
		'items_list'            => esc_html__( 'Participants list', 'test-accordion' ),
		'items_list_navigation' => esc_html__( 'Participants list navigation', 'test-accordion' ),
		'filter_items_list'     => esc_html__( 'Filter participants list', 'test-accordion' ),
	);
	$args = array(
		'label'                 => esc_html__( 'Participant', 'test-accordion' ),
		'description'           => esc_html__( 'Conference participants', 'test-accordion' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-admin-users',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'participant', $args );

}
add_action( 'init', 'test_accordion_participants', 0 );