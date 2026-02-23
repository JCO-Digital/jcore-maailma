# JCORE Maailma

A WordPress plugin that provides a global content post type and block for reusable content across your site.

## Description

JCORE Maailma (Finnish for "world") enables you to create reusable content blocks that can be inserted anywhere on your WordPress site. Perfect for content that needs to appear in multiple locations like disclaimers, contact information, promotional banners, or any other content you want to manage from a single location.

## Features

- **Global Content Post Type**: Create and manage reusable content pieces
- **Gutenberg Block**: Easy-to-use block for inserting global content
- **Polylang Integration**: Built-in support for multilingual content
- **Timber/Twig Integration**: Custom Twig function for use in templates
- **PHP Helper Functions**: Programmatically access global content
- **Automatic Slug Generation**: Post slugs are automatically generated from titles

## Requirements

- WordPress 6.7 or higher
- PHP 8.2 or higher

## Installation

1. Upload the plugin files to `/wp-content/plugins/jcore-maailma/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Start creating global content under the "Global Content" menu in WordPress admin

## Usage

### Creating Global Content

1. Navigate to **Global Content** in the WordPress admin menu
2. Click **Add New Global Content**
3. Enter a title (this will be used as the slug for referencing)
4. Add your content using the block editor
5. Publish the content

### Using the Gutenberg Block

1. In the block editor, add a new block
2. Search for "JCORE Global Content"
3. Select the global content post from the dropdown in the block settings
4. The content will be displayed in the editor and on the frontend

### Using PHP Functions

#### Get Global Content by ID or Slug

```php
<?php
use function Jcore\Maailma\get_global_content;

// By slug (recommended)
echo get_global_content( 'footer-disclaimer' );

// By post ID
echo get_global_content( 123 );

// Without translation (useful when you want the original language)
echo get_global_content( 'footer-disclaimer', false );
?>
```

**Parameters:**

- `$id` (int|string): The post ID or slug of the global content
- `$translate` (bool): Whether to retrieve the translated version if available (default: true)

**Returns:** (string) The filtered post content, or an empty string if not found

### Using in Timber/Twig Templates

The plugin provides a custom Twig function for use in Timber templates:

```twig
{# By slug #}
{{ jcore_global_content('footer-disclaimer') }}

{# By post ID #}
{{ jcore_global_content(123) }}

{# Without translation #}
{{ jcore_global_content('footer-disclaimer', false) }}
```

## Polylang Integration

If you have Polylang installed, JCORE Maailma automatically:

- Registers the global content post type for translation
- Returns translated content based on the current language (when `$translate` is true)
- Allows you to manage translations through the Polylang interface

## Constants

The plugin defines the following constants that can be used in your code:

- `JCORE_MAAILMA_PLUGIN_FILE`: Path to the plugin file
- `JCORE_MAAILMA_BUILD_DIR`: Path to the build directory
- `JCORE_MAAILMA_MANIFEST`: Path to the blocks manifest file
- `JCORE_MAAILMA_POST_TYPE`: The post type slug (`jcore-global-content`)

## Hooks and Filters

### Actions

- `jcore_plugins_loaded`: Notifies other JCORE plugins that this plugin is loaded

### Filters

- `pll_get_post_types`: Registers the global content post type with Polylang
- `timber/twig`: Adds custom Twig functions to Timber

## Development

### Build Commands

```bash
# Install dependencies
pnpm install

# Development mode with hot reload
pnpm start

# Build for production
pnpm build

# Watch mode
pnpm watch

# Linting
pnpm lint:js
pnpm lint:css

# Create translation files
pnpm make-pot
pnpm make-json
```

### Local Development Environment

```bash
# Start local WordPress environment
pnpm env:start

# Stop local WordPress environment
pnpm env:stop
```

## File Structure

```
jcore-maailma/
├── build/                  # Compiled assets
│   └── global-content/     # Global content block
├── src/                    # Source files
│   └── global-content/     # Global content block source
│       ├── block.json      # Block configuration
│       ├── edit.js         # Block editor component
│       ├── index.js        # Block registration
│       ├── render.php      # Server-side render
│       └── editor.scss     # Editor styles
├── languages/              # Translation files
├── jcore-maailma.php      # Main plugin file
├── post-type.php          # Post type registration
├── content.php            # Helper functions
├── timber.php             # Timber integration
└── readme.md              # This file
```

## Examples

### Example 1: Footer Disclaimer

Create a global content item with slug `footer-disclaimer`:

```php
<?php
// In your footer template
use function Jcore\Maailma\get_global_content;
?>
<footer>
    <div class="disclaimer">
        <?php echo get_global_content( 'footer-disclaimer' ); ?>
    </div>
</footer>
```

### Example 2: Promotional Banner

Create a global content item with slug `promo-banner` and use it in a Timber template:

```twig
{# In your Twig template #}
<div class="promotional-banner">
	{{ jcore_global_content('promo-banner') }}
</div>
```

### Example 3: Conditional Display

```php
<?php
use function Jcore\Maailma\get_global_content;

$seasonal_message = get_global_content( 'seasonal-message' );
if ( ! empty( $seasonal_message ) ) {
    echo '<div class="seasonal-alert">' . $seasonal_message . '</div>';
}
?>
```

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for a detailed version history.

## Author

**J&Co Digital**

- Website: [https://jco.fi](https://jco.fi)
- Email: support@jco.fi

## License

GPL-2.0-or-later

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

## Support

For issues, questions, or contributions, please visit the [GitHub repository](https://github.com/JCO-Digital/jcore-maailma).
