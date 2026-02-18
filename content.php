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
 * Retrieves global content by ID or slug.
 *
 * This function fetches the content of a 'jcore-global-content' post by its numeric ID or slug.
 * If a slug is provided, it attempts to resolve it to a post ID. If Polylang is active and translation
 * is enabled, it retrieves the translated post ID. The function then gets the post content and applies
 * content filters before returning it.
 *
 * @param int|string $id        The post ID or slug of the global content.
 * @param bool       $translate Whether to retrieve the translated version if available. Default true.
 * @return string               The filtered post content, or an empty string if not found.
 */
function get_global_content( $id, $translate = true ) {
	if ( empty( $id ) ) {
		return '';
	} elseif ( is_numeric( $id ) ) {
		$post_id = $id;
	} else {
		$content_post = get_page_by_path( $id, OBJECT, JCORE_MAAILMA_POST_TYPE );
		if ( ! $content_post ) {
			return '';
		}
		$post_id = $content_post->ID;
	}
	if ( $translate && function_exists( 'pll_get_post' ) ) {
		$pll_id = pll_get_post( $post_id );
		if ( $pll_id ) {
			$post_id = $pll_id;
		}
	}
	if ( empty( $post_id ) ) {
		return '';
	}

	$content = get_the_content( null, false, $post_id );

	return render_blocks( $content );
}

/**
 * Renders block content.
 *
 * This function takes a string containing block-encoded content, parses it into
 * individual blocks, and renders each one into HTML.
 *
 * @param string $content The block-encoded content to render.
 * @return string         The rendered HTML content.
 */
function render_blocks( $content ) {
	$blocks = parse_blocks( $content );
	if ( empty( $blocks ) ) {
		return '';
	}

	$block_content = '';
	foreach ( $blocks as $block_item ) {
		$rendered_block = render_block( $block_item );
		if ( empty( $rendered_block ) ) {
			continue;
		}
		$block_content .= $rendered_block;
	}
	return $block_content;
}
