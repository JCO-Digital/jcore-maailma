=== JCORE Maailma ===
Contributors: jcodigital
Tags: global content, reusable content, block, timber, polylang
Requires at least: 6.7
Tested up to: 7.0
Requires PHP: 8.2
Stable tag: 1.6.4
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A global content post type and block for content that is managed once and shown in many places.

== Description ==

JCORE Maailma (Finnish for "world") adds a Global Content post type. Each global content post is a piece of block content, such as a disclaimer, contact details or a promotional banner, that you write once and place anywhere on the site. When you update the post, every place that shows it updates too.

**Editing**

* Global content is managed under the Global Content menu in wp-admin, using the block editor.
* The post slug is generated from the title and kept unique, so it can be used as a stable reference.
* The post list shows a sortable Slug column with a copy button.

**Placing content**

* The **JCORE Global Content** block lets you pick a global content post and renders it in place.
* In PHP, `Jcore\Maailma\get_global_content( $id_or_slug, $translate = true )` returns the rendered content.
* In Timber templates, the `jcore_global_content()` Twig function does the same.

**Polylang**

If Polylang is active, the post type is registered for translation, and content is returned in the current language unless translation is turned off in the function call.

== Installation ==

1. Install the plugin through Composer with `composer require jcodigital/jcore-maailma`, or upload the release zip on the Plugins screen.
2. Activate the plugin.
3. Create content under Global Content and place it with the JCORE Global Content block, or call it from your templates.

Updates are delivered through the JCORE update service.

== Frequently Asked Questions ==

= How do I reference a global content post from code? =

Use the slug shown in the Slug column of the post list. Both the PHP function and the Twig function accept a slug or a post ID.

`{{ jcore_global_content('footer-disclaimer') }}`

= How do I get the original language instead of the translation? =

Pass `false` as the second argument: `get_global_content( 'footer-disclaimer', false )`.

= Is global content visible on its own URL? =

No. The post type is not public. It exists only to be placed in other content or templates.

== Changelog ==

= v1.6.4 (2026-08-24) =

* Maintenance: composer - update jcore-update to v1.2

= v1.6.3 (2026-08-24) =

* Build: composer - update dependencies

= v1.6.2 (2026-06-03) =

* Fix: replace local version fetching with PluginHelper and remove update logic

= v1.6.1 (2026-06-03) =

* Continuous Integration: github - remove build and release steps from push workflow
* Maintenance: build - remove generated build files and ignore directory

= v1.6.0 (2026-06-03) =

* Feature: update - integrate jcore-update for plugin management

= v1.5.4 (2026-05-12) =

* Fix: update - rename JCORE_MAAILMA_RELEASE constant to JCORE_MAAILMA_RELEASE_URL

= v1.5.3 (2026-05-12) =

* Fix: update - improve plugin update logic and caching
* Build: composer - add vendor to ignore and lock dependencies
* Maintenance: phpcs - exclude build directory from analysis

= v1.5.2 (2026-05-12) =

* Fix: plugin - correct case of version key in update logic

= v1.5.1 (2026-05-12) =

* Refactor: update - overhaul plugin update logic and cleanup configurations

= v1.5.0 (2026-05-11) =

* Feature: update - implement automated remote update mechanism

= v1.4.4 (2026-05-11) =

* Continuous Integration: github - enable direct push for version bumping

= v1.4.3 (2026-05-11) =

* Continuous Integration: github - sync version from jcore-maailma.php during release

= v1.4.2 (2026-05-11) =

* Continuous Integration: github - update foonver version and add protected branch push step
* Continuous Integration: github - update release workflow configuration and downgrade version
* Continuous Integration: github - update branch trigger and foonver action version
* Continuous Integration: github - enable auto-push and remove redundant push step
* Continuous Integration: github - replace add-and-commit action with push-protected
* Continuous Integration: workflow - migrate to foonver for releases and update CI configuration

= v1.4.1 (2026-03-10) =

* Fix: global-content - use default import for ServerSideRender

= v1.4.0 (2026-03-09) =

* Feature: global-content - replace SelectControl with ComboboxControl
* Fix: use textContent instead of innerContent for clipboard copy

= v1.3.1 (2026-02-23) =

* Fix: admin - load assets only on the post type list screen
* Fix: maailma - add toast check and handle clipboard write errors
* Fix: slug - ensure save_post hook is restored in update_slug
* Refactor: slug - move cursor style to CSS and add button type
* Refactor: admin - externalize copy-slug styles and scripts
* Documentation: readme - document JCORE_MAAILMA_VERSION constant
* Documentation: readme - update constants and remove filter_content function documentation
* Maintenance: remove version and postversion scripts
* Maintenance: versionSync - update version constant and refactor script

= v1.3.0 (2026-02-18) =

* Feature: post-type - make slug copyable from post list with toast notification
* Feature: post-type - add Slug column to custom post list and make it sortable
* Fix: post-type - insert slug column after title in admin posts list
* Fix: content - generate unique slug and prevent recursive save when updating post_name
* Refactor: content - replace filter_content with render_blocks to render block content
* Documentation: updated readme file
* Build: makefile - add start and stop targets
* Maintenance: plugin - define JCORE_MAAILMA_PLUGIN_FILE and add phpcs.xml coding standards

= v1.2.0 (2025-12-11) =

* Feature: add filter to let Ydin know we are loaded

= v1.1.1 (2025-12-11) =

* Fix: ci - update pre-commit script path from versionSync.mjs to versionSync.js

= v1.1.0 (2025-12-11) =

* Feature: added composer.json and other versioning stuff, some renaming and cleanup
* Fix: ci - add pnpm action setup to workflow
* Fix: ci - rename the commitsar file with yml
* Fix: do not check all commits but be strict
* Continuous Integration: add Commitsar config and PR validation workflow
* Continuous Integration: remove commitsar
* Continuous Integration: fix YAML indentation in .commitsar.yml
* Continuous Integration: set commitsar strict mode to false
* Continuous Integration: update workflow actions to use v2 of jcore-module-actions
* Continuous Integration: add build output for Global Content block
* Continuous Integration: add Commitsar config and update changelog action settings
* Continuous Integration: add GitHub Actions workflows for PR labeling, validation, and release
* Maintenance: ci - just configure the action to not use commitsar for now
* Maintenance: ci - use v2.0.2 of the action
* Refactor: global content retrieval and add editor block styling

= v1.0.0 (2025-12-09) =

* Feature: add Polylang support for global content post type
* Feature: add global content post selection to block editor
* Feature: add global content post type and helper function
* Refactor: global content block and improve content filtering
* Documentation: updated readme
* Style: remove extra blank lines after add_action call
* Maintenance: rename plugin to JCORE Maailma and update namespaces and paths
