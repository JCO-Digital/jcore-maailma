<?php
/**
 * Global Content Timber Filter
 *
 * @package Jcore\Maailma
 */

namespace Jcore\Maailma;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter( 'timber/twig', 'Jcore\Maailma\twig' );

/**
 * Adds custom Twig functions to Timber.
 *
 * This function registers the 'global-content' Twig function,
 * which allows templates to access global content via the
 * Jcore\Maailma\get_global_content function.
 *
 * @param \Twig\Environment $twig The Twig environment instance.
 * @return \Twig\Environment Modified Twig environment with custom functions.
 */
function twig( $twig ) {
	// Adding a function.
	$twig->addFunction(
		new \Twig\TwigFunction( 'jcore_global_content', 'Jcore\Maailma\get_global_content' )
	);

	return $twig;
}
