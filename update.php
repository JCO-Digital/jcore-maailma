<?php
/**
 * Global Content Update Mechanism
 *
 * @package Jcore\Maailma
 */

namespace Jcore\Maailma;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter( 'plugins_api', '\Jcore\Maailma\info', 20, 3 );
add_filter( 'site_transient_update_plugins', '\Jcore\Maailma\update' );
add_action( 'upgrader_process_complete', '\Jcore\Maailma\cleanup', 10, 2 );

/**
 * Provide plugin information for the update modal.
 *
 * @param \stdClass|bool $res    The response object.
 * @param string         $action The action being performed.
 * @param object         $args   The arguments for the action.
 *
 * @return \stdClass|bool
 */
function info( $res, $action, $args ) {

	// do nothing if you're not getting plugin information right now
	if ( 'plugin_information' !== $action ) {
		return $res;
	}

	// do nothing if it is not our plugin
	if ( plugin_basename( __DIR__ ) !== $args->slug ) {
		return $res;
	}

	// get updates
	$remote = fetch();

	if ( ! $remote ) {
		return $res;
	}

	$res = new \stdClass();

	$res->name           = $remote->name ?? 'JCORE Maailma';
	$res->slug           = $remote->slug ?? 'jcore-maailma';
	$res->version        = $remote->version;
	$res->tested         = $remote->tested ?? '6.7';
	$res->requires       = $remote->requires ?? '6.7';
	$res->author         = $remote->author ?? 'J&Co Digital';
	$res->author_profile = $remote->author_profile ?? 'https://jco.fi';
	$res->download_link  = $remote->download_url;
	$res->trunk          = $remote->download_url;
	$res->requires_php   = $remote->requires_php ?? '8.2';
	$res->last_updated   = $remote->last_updated ?? date( 'Y-m-d H:i:s' );

	$res->sections = array(
		'description'  => $remote->sections->description ?? ( $remote->description ?? '' ),
		'installation' => $remote->sections->installation ?? 'Automatic update via WordPress dashboard.',
		'changelog'    => $remote->sections->changelog ?? 'Updates and improvements.',
	);

	if ( ! empty( $remote->banners ) ) {
		$res->banners = array(
			'low'  => $remote->banners->low ?? '',
			'high' => $remote->banners->high ?? '',
		);
	}

	return $res;
}

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

	$remote = fetch();

	if (
		$remote
		&& isset( $remote->version )
		&& version_compare( JCORE_MAAILMA_VERSION, $remote->version, '<' )
	) {
		$res = new \stdClass();
		$res->slug        = $remote->slug ?? 'jcore-maailma';
		$res->plugin      = plugin_basename( JCORE_MAAILMA_PLUGIN_FILE );
		$res->new_version = $remote->version;
		$res->tested      = $remote->tested ?? '6.7';
		$res->package     = $remote->download_url;

		$transient->response[ $res->plugin ] = $res;
	}

	return $transient;
}

/**
 * Fetch the latest release data.
 *
 * @return \stdClass|bool
 */
function fetch() {
	$remote = get_transient( 'jcore_maailma_upgrade' );

	if ( false !== $remote ) {
		return $remote;
	}

	// Fetch package.json from the latest release asset
	$response = wp_remote_get(
		'https://github.com/JCO-Digital/jcore-maailma/releases/latest/download/package.json',
		array(
			'timeout' => 10,
			'headers' => array(
				'Accept'     => 'application/json',
				'User-Agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . get_bloginfo( 'url' ),
			),
		)
	);

	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return false;
	}

	$content = wp_remote_retrieve_body( $response );
	$remote  = json_decode( $content );

	if ( ! $remote || ! isset( $remote->version ) ) {
		return false;
	}

	// Standardize fields for info() and update()
	if ( ! isset( $remote->slug ) ) {
		$remote->slug = 'jcore-maailma';
	}

	if ( ! isset( $remote->download_url ) ) {
		// Assuming the release asset is named jcore-maailma.zip
		$remote->download_url = 'https://github.com/JCO-Digital/jcore-maailma/releases/latest/download/jcore-maailma.zip';
	}

	// Ensure sections exist for info()
	if ( ! isset( $remote->sections ) ) {
		$remote->sections = (object) array(
			'description'  => $remote->description ?? '',
			'installation' => 'Automatic update via WordPress dashboard.',
			'changelog'    => 'Updates and improvements.',
		);
	}

	set_transient( 'jcore_maailma_upgrade', $remote, DAY_IN_SECONDS );

	return $remote;
}


/**
 * Cleanup after update.
 *
 * @param object $upgrader The upgrader object.
 * @param array  $options  The options array.
 *
 * @return void
 */
function cleanup( $upgrader, $options ) {
	if ( isset( $options['action'] ) && 'update' === $options['action'] && isset( $options['type'] ) && 'plugin' === $options['type'] && isset( $options['plugins'] ) ) {
		foreach ( $options['plugins'] as $plugin ) {
			if ( $plugin === plugin_basename( JCORE_MAAILMA_PLUGIN_FILE ) ) {
				delete_transient( 'jcore_maailma_upgrade' );
			}
		}
	}
}
