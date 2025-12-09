<?php
/**
 * Global Content Helper Functions
 *
 * @package Jcore\Maailma
 */

namespace Jcore\Maailma;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Retrieves the content of a global content post by its name.
 *
 * This function queries for a post of type JCORE_MAAILMA_POST_TYPE with the specified
 * title ($name) and returns its post content. If no such post is found, it returns null.
 *
 * @param string $name The title of the global content post to retrieve.
 * @return string|null The post content if found, or null if not found.
 */
function get_global_content( $name ) {
	$params = array(
		'post_type'      => JCORE_MAAILMA_POST_TYPE,
		'post_title'     => $name,
		'posts_per_page' => 1,
	);
	$query  = new \WP_Query( $params );

	if ( $query->have_posts() ) {
		foreach ( $query->posts as $post ) {
			return $post->post_content;
		}
	}
}
