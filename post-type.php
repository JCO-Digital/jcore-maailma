<?php
/**
 * Global Content Post Type
 *
 * @package Jcore\Maailma
 */

namespace Jcore\Maailma;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action(
	'init',
	function () {
		register_post_type(
			JCORE_MAAILMA_POST_TYPE,
			array(
				'labels'           => array(
					'name'                     => __( 'Global Content', 'jcore' ),
					'singular_name'            => __( 'Global Content', 'jcore' ),
					'menu_name'                => __( 'Global Content', 'jcore' ),
					'all_items'                => __( 'All Global Content', 'jcore' ),
					'edit_item'                => __( 'Edit Global Content', 'jcore' ),
					'view_item'                => __( 'View Global Content', 'jcore' ),
					'view_items'               => __( 'View Global Content', 'jcore' ),
					'add_new_item'             => __( 'Add New Global Content', 'jcore' ),
					'add_new'                  => __( 'Add New Global Content', 'jcore' ),
					'new_item'                 => __( 'New Global Content', 'jcore' ),
					'parent_item_colon'        => __( 'Parent Global Content:', 'jcore' ),
					'search_items'             => __( 'Search Global Content', 'jcore' ),
					'not_found'                => __( 'No global content found', 'jcore' ),
					'not_found_in_trash'       => __( 'No global content found in Trash', 'jcore' ),
					'archives'                 => __( 'Global Content Archives', 'jcore' ),
					'attributes'               => __( 'Global Content Attributes', 'jcore' ),
					'insert_into_item'         => __( 'Insert into global content', 'jcore' ),
					'uploaded_to_this_item'    => __( 'Uploaded to this global content', 'jcore' ),
					'filter_items_list'        => __( 'Filter global content list', 'jcore' ),
					'filter_by_date'           => __( 'Filter global content by date', 'jcore' ),
					'items_list_navigation'    => __( 'Global Content list navigation', 'jcore' ),
					'items_list'               => __( 'Global Content list', 'jcore' ),
					'item_published'           => __( 'Global Content published.', 'jcore' ),
					'item_published_privately' => __( 'Global Content published privately.', 'jcore' ),
					'item_reverted_to_draft'   => __( 'Global Content reverted to draft.', 'jcore' ),
					'item_scheduled'           => __( 'Global Content scheduled.', 'jcore' ),
					'item_updated'             => __( 'Global Content updated.', 'jcore' ),
					'item_link'                => __( 'Global Content Link', 'jcore' ),
					'item_link_description'    => __( 'A link to a global content.', 'jcore' ),
				),
				'public'           => false,
				'show_ui'          => true,
				'supports'         => array( 'title', 'editor', 'revisions', 'show_in_rest' ),
				'show_in_rest'     => true,
				'menu_icon'        => 'dashicons-admin-site-alt3',
				'rewrite'          => false,
				'delete_with_user' => false,
			)
		);
	}
);
