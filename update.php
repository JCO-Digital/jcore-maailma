<?php
/**
 * Global Content Update Mechanism
 *
 * @package Jcore\Maailma
 */

namespace Jcore\Maailma;

if (!defined("ABSPATH")) {
	exit(); // Exit if accessed directly.
}

if (!defined("JCORE_MAAILMA_RELEASE")) {
	define(
		"JCORE_MAAILMA_RELEASE",
		"https://github.com/JCO-Digital/jcore-maailma/releases/latest/download",
	);
}

add_filter("pre_set_site_transient_update_plugins", __NAMESPACE__ . "\\update");

/**
 * Check for updates and add them to the transient.
 *
 * @param mixed $transient The transient object.
 *
 * @return mixed
 */
function update($transient)
{
	if (!is_object($transient) || empty($transient->checked)) {
		return $transient;
	}

	$plugin_data = get_data();
	$update = create_plugin_object($plugin_data);

	if (empty($update->new_version)) {
		return $transient;
	}

	if (version_compare($plugin_data["version"], $update->new_version, "<")) {
		$transient->response[$plugin_data["plugin"]] = $update;
	} else {
		$transient->no_update[$plugin_data["plugin"]] = $update;
	}

	return $transient;
}

/**
 * Build a plugin update payload object for WordPress.
 *
 * @param array $plugin_data Local plugin metadata.
 *
 * @return \stdClass
 */
function create_plugin_object(array $plugin_data): \stdClass
{
	$remote = fetch();

	if (!$remote) {
		return (object) [];
	}

	return (object) [
		"id" => $plugin_data["id"],
		"slug" => $plugin_data["slug"],
		"plugin" => $plugin_data["plugin"],
		"new_version" => $remote->version,
		"url" => $remote->download_url ?? "",
		"package" => $remote->download_url ?? "",
		"icons" => [],
		"banners" => [],
		"banners_rtl" => [],
		"tested" => "",
		"requires_php" => "",
		"compatibility" => new \stdClass(),
	];
}

/**
 * Get plugin metadata from the plugin header.
 *
 * @return array
 */
function get_data(): array
{
	static $data = [];

	if (!empty($data)) {
		return $data;
	}

	$map = [
		"name" => "Plugin Name",
		"version" => "Version",
	];

	$data = get_file_data(JCORE_MAAILMA_PLUGIN_FILE, $map);
	$data["id"] = plugin_basename(JCORE_MAAILMA_PLUGIN_FILE);
	$data["slug"] = basename(JCORE_MAAILMA_PLUGIN_FILE, ".php");
	$data["plugin"] = plugin_basename(JCORE_MAAILMA_PLUGIN_FILE);

	return $data;
}

/**
 * Fetch the latest release data.
 *
 * @return \stdClass|bool
 */
function fetch()
{
	static $cached_remote = null;

	if (null !== $cached_remote) {
		return $cached_remote;
	}

	$response = wp_remote_get(JCORE_MAAILMA_RELEASE . "/package.json", [
		"timeout" => 10,
		"headers" => [
			"Accept" => "application/json",
			"User-Agent" =>
				"WordPress/" . get_bloginfo("version") . "; " . get_bloginfo("url"),
		],
	]);

	if (
		is_wp_error($response) ||
		200 !== wp_remote_retrieve_response_code($response)
	) {
		$cached_remote = false;
		return $cached_remote;
	}

	$remote = json_decode(wp_remote_retrieve_body($response));

	if (!$remote || !isset($remote->version)) {
		$cached_remote = false;
		return $cached_remote;
	}

	if (!empty($remote->name)) {
		$remote->download_url =
			JCORE_MAAILMA_RELEASE . "/" . $remote->name . ".zip";
	} else {
		$remote->download_url = "";
	}

	$cached_remote = $remote;
	return $cached_remote;
}
