# Changelog

### 1.4.8 (2026-05-11)

### Misc
- v1.4.7 (fc5df67)

### v1.4.7 (2026-05-11)

### Misc
- v1.4.6 (bd7d74b)

### v1.4.6 (2026-05-11)

### Misc
- v1.4.5 (76b6926)

### v1.4.5 (2026-05-11)

### Misc
- v1.4.4 (c047cbb)

### v1.4.4 (2026-05-11)

### Misc
- v1.4.3 (b2a29db)

### v1.4.3 (2026-05-11)

#### Maintenance

- blocks: build blocks for release [skip ci] (08bbc2f)

### Misc
- v1.4.2 (0db0879)

### v1.4.2 (2026-05-11)

#### Continuous Integration

- github: replace add-and-commit action with push-protected (7f8c13c)
- workflow: migrate to foonver for releases and update CI configuration (2406c54)

### v1.4.1 (2026-03-10)

#### Bug Fixes

- global-content: use default import for ServerSideRender (146c68c)

#### Maintenance

- release: v1.4.1 [skip ci] (f6326d1)
- blocks: build blocks for release [skip ci] (0f24c16)

## v1.4.0 (2026-03-09)

#### Features

- global-content: replace SelectControl with ComboboxControl (e7eacc1)

#### Bug Fixes

- use textContent instead of innerContent for clipboard copy (83f7693)

#### Maintenance

- release: v1.4.0 [skip ci] (db9d7a0)
- blocks: build blocks for release [skip ci] (4f5a66c)

### v1.3.1 (2026-02-23)

#### Bug Fixes

- admin: load assets only on the post type list screen (3509d29)
- maailma: add toast check and handle clipboard write errors (a9d1b30)
- slug: ensure save_post hook is restored in update_slug (484135e)

#### Refactor

- slug: move cursor style to CSS and add button type (5d8e03a)
- admin: externalize copy-slug styles and scripts (f272716)

#### Documentation

- readme: document JCORE_MAAILMA_VERSION constant (80aefaa)
- readme: update constants and remove filter_content function documentation (d89cd27)

#### Maintenance

- release: v1.3.1 [skip ci] (7d7262a)
- remove version and postversion scripts (bb955cf)
- versionSync: update version constant and refactor script (cc86403)

## v1.3.0 (2026-02-18)

#### Features

- post-type: make slug copyable from post list with toast notification (b67639a)
- post-type: add Slug column to custom post list and make it sortable (cd7530d)

#### Bug Fixes

- post-type: insert slug column after title in admin posts list (3c68806)
- content: generate unique slug and prevent recursive save when updating post_name (c984834)

#### Refactor

- content: replace filter_content with render_blocks to render block content (d851bbc)
- content: replace filter_content with render_blocks to render block content (af771a3)

#### Documentation

- updated readme file. (46fbce6)

#### Build System

- makefile: add start and stop targets (96939af)

#### Maintenance

- release: v1.3.0 [skip ci] (45f675f)
- plugin: define JCORE_MAAILMA_PLUGIN_FILE and add phpcs.xml coding standards (6111e8c)
- plugin: define JCORE_MAAILMA_PLUGIN_FILE and add phpcs.xml coding standards (4acaa35)

## v1.2.0 (2025-12-11)

#### Features

- Add filter to let Ydin know we are loaded. (03c928f)

#### Maintenance

- release: v1.2.0 [skip ci] (720c84e)

### v1.1.1 (2025-12-11)

#### Bug Fixes

- ci: update pre-commit script path from versionSync.mjs to versionSync.js (d103ee1)

#### Maintenance

- release: v1.1.1 [skip ci] (bc7bdde)

## v1.1.0 (2025-12-11)

#### Features

- added composer.json and other versioning stuff + some renaming and cleanup (ffd2968)

#### Bug Fixes

- ci: add pnpm action setup to workflow (8d1e619)
- ci: rename the commitsar file with yml (6cd51cd)
- do not check all commits but be strict (6c0d7cd)

#### Continuous Integration

- Add Commitsar config and PR validation workflow (5ce9ef7)
- remove commitsar (7cb0d83)
- Fix YAML indentation in .commitsar.yml (fdfde45)
- Set commitsar strict mode to false (978d463)
- Update workflow actions to use v2 of jcore-module-actions (eea0d1d)
- Add build output for Global Content block (3856e5a)
- Add Commitsar config and update changelog action settings (eb8c092)
- Add GitHub Actions workflows for PR labeling, validation, and release (1e85a52)

#### Maintenance

- release: v1.1.0 [skip ci] (220cf89)
- ci: just configure the action to not use commitsar for now (a4cdb7e)
- ci: use v2.0.2 of the action (8e572e0)

### Misc
- Update .github/workflows/label.yml (2151dbd)
- Refactor global content retrieval and add editor block styling (91058a7)

## v1.0.0 (2025-12-09)

#### Features

- Add Polylang support for global content post type (fecf6da)
- Add global content post selection to block editor (7534e7a)
- Add global content post type and helper function (5fc99b5)

#### Refactor

- global content block and improve content filtering (34715a0)

#### Documentation

- Updated readme (abe1826)

#### Styles

- Remove extra blank lines after add_action call (c8e6ad7)

#### Maintenance

- Rename plugin to JCORE Maailma and update namespaces and paths (bce232d)

### Misc
- Initial commit (b1e1ca6)

