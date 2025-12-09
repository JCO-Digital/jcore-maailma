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

$content = get_global_content( 'example' );

echo $content;
