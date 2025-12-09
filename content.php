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
 * Handles the saving of a 'jcore-global-content' post.
 *
 * This function is hooked to the 'save_post_jcore-global-content' action and is triggered
 * whenever a post of type 'jcore-global-content' is saved. It sanitizes the post title to
 * generate a slug, assigns it to the post's 'post_name', and updates the post in the database.
 *
 * @param int     $post_id The ID of the post being saved.
 * @param WP_Post $post    The post object.
 * @param bool    $update  Whether this is an existing post being updated or not.
 */
function update_slug( $post_id, $post, $update ) {
	if ( $update ) {
		$new_slug = sanitize_title( $post->post_title );
		if ( $new_slug !== $post->post_name ) {
			wp_update_post(
				array(
					'ID'        => $post_id,
					'post_name' => $new_slug,
				)
			);
		}
	}
}
add_action( 'save_post_jcore-global-content', 'Jcore\Maailma\update_slug', 10, 3 );

/**
 * Retrieves the content of a global content post by its name.
 *
 * This function queries for a post of type JCORE_MAAILMA_POST_TYPE with the specified
 * title ($name) and returns its post content. If no such post is found, it returns null.
 *
 * @param string|int $id The title of the global content post to retrieve.
 * @return string|null The post content if found, or null if not found.
 */
function get_global_content( $id ) {
	if ( is_int( $id ) ) {
		$post_id = $id;
	} else {
		$post = get_page_by_path( $id, OBJECT, JCORE_MAAILMA_POST_TYPE );
		if ( ! $post ) {
			return null;
		}
		$post_id = $post->ID;
	}
	if ( function_exists( 'pll_get_post' ) ) {
		$post_id = pll_get_post( $post_id );
	}
	$post = get_post( $post_id );
	if ( ! $post ) {
		return null;
	}

	return filter_content( $post->post_content );
}

/**
 * Filters and formats post content.
 *
 * This function applies the 'the_content' filter to the provided content,
 * and replaces occurrences of ']]>' with ']]&gt;'. This ensures that the
 * content is processed in the same way as standard WordPress post content,
 * including shortcode and embed handling.
 *
 * @param string $content The raw post content to filter.
 * @return string The filtered and formatted post content.
 */
function filter_content( $content ) {
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	return $content;
}
