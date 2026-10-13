<?php
/**
 * Render template for global content block.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 * @package Jcore\Maailma
 */

namespace Jcore\Maailma;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// The slug finds the same item on every site, the id is the fallback for
// blocks saved before the slug was stored.
$slug    = sanitize_title( $attributes['selectedSlug'] ?? '' );
$content = '' !== $slug ? get_global_content( $slug ) : '';
if ( '' === $content ) {
	$content = get_global_content( (int) ( $attributes['selectedPostId'] ?? 0 ) );
}

// The content is rendered blocks, the same output WordPress prints for post
// content. Filtering it with wp_kses_post() would strip forms, inputs and
// embeds from the global content.
// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo $content;
