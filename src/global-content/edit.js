import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import ServerSideRender from '@wordpress/server-side-render';
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const { selectedPostId, copyrightShow, copyrightText, copyrightYear, copyrightToCurrent } =
		attributes;

	// Fetch posts of type 'jcore-global-content'
	const posts = useSelect(
		(select) =>
			select('core').getEntityRecords('postType', 'jcore-global-content', { per_page: -1 }),
		[]
	);

	const postOptions = posts
		? posts.map((post) => ({
				label: post.title.rendered || `#${post.id}`,
				value: post.id,
			}))
		: [{ label: __('Loading...', 'jcore-maailma'), value: 0 }];

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'jcore-maailma')}>
					<SelectControl
						label={__('Select Global Content', 'jcore-maailma')}
						value={selectedPostId || 0}
						options={[
							{ label: __('Select a post', 'jcore-maailma'), value: 0 },
							...postOptions,
						]}
						onChange={(value) => setAttributes({ selectedPostId: parseInt(value, 10) })}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}>
				<ServerSideRender
					block="jco/global-content"
					attributes={{ ...attributes, preview: true }}
				/>
			</div>
		</>
	);
}
