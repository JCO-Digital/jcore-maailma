<?php
/**
 * Global Content Update Mechanism
 *
 * @package Jcore\Maailma
 */

namespace Jcore\Maailma;

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // Exit if accessed directly.
}

define(
	'JCORE_MAAILMA_RELEASE',
	'https://github.com/JCO-Digital/jcore-maailma/releases/latest/download',
);

add_filter( 'pre_set_site_transient_update_plugins', "\Jcore\Maailma\update" );

/**
 * Check for updates and add them to the transient.
 *
 * @param object $transient The transient object.
 *
 * @return object
 */
function update( $transient ) {
	if ( empty( $transient->checked ) ) {
		return $transient;
	}

	$update      = create_plugin_object();
	$plugin_data = get_data();

	if (
		isset( $update->new_version ) &&
		version_compare( $plugin_data['Version'], $update->new_version, '<' )
	) {
		$transient->response[ $plugin_data['plugin'] ] = $update;
	} else {
		$transient->no_update[ $plugin_data['plugin'] ] = $update;
	}

	return $transient;
}

function create_plugin_object(): \stdClass {
	$plugin_data = get_data();

	$remote = fetch();

	if ( ! $remote ) {
		return (object) array();
	}

	$item = (object) array(
		'id'            => $plugin_data['id'],
		'slug'          => $plugin_data['slug'],
		'plugin'        => $plugin_data['plugin'],
		'new_version'   => $remote->version,
		'url'           => $remote->download_url ?? '',
		'package'       => '',
		'icons'         => array(),
		'banners'       => array(),
		'banners_rtl'   => array(),
		'tested'        => '',
		'requires_php'  => '',
		'compatibility' => new \stdClass(),
	);
	return $item;
}

function get_data(): array {
	static $data = array();

	if ( ! empty( $plugin_data ) ) {
		return $data;
	}

	$map = array(
		'name'    => 'Plugin Name',
		'version' => 'Version',
	);

	$data           = get_file_data( JCORE_MAAILMA_PLUGIN_FILE, $map );
	$data['id']     = plugin_basename( JCORE_MAAILMA_PLUGIN_FILE );
	$data['slug']   = basename( JCORE_MAAILMA_PLUGIN_FILE, '.php' );
	$data['plugin'] = plugin_basename( JCORE_MAAILMA_PLUGIN_FILE );

	return $data;
}

/**
 * Fetch the latest release data.
 *
 * @return \stdClass|bool
 */
function fetch() {
	// Fetch package.json from the latest release asset
	$response = wp_remote_get(
		JCORE_MAAILMA_RELEASE . '/package.json',
		array(
			'timeout' => 10,
			'headers' => array(
				'Accept'     => 'application/json',
				'User-Agent' =>
					'WordPress/' . get_bloginfo( 'version' ) . '; ' . get_bloginfo( 'url' ),
			),
		)
	);

	if (
		is_wp_error( $response ) ||
		200 !== wp_remote_retrieve_response_code( $response )
	) {
		return false;
	}

	$content = wp_remote_retrieve_body( $response );
	$remote  = json_decode( $content );

	if ( ! $remote || ! isset( $remote->version ) ) {
		return false;
	}

	$remote->download_url = JCORE_MAAILMA_RELEASE . '/' . $remote->name . 'zip';

	return $remote;
}
