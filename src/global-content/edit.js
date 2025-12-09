import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const { copyrightShow, copyrightText, copyrightYear, copyrightToCurrent } = attributes;
	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'lohko')}></PanelBody>
			</InspectorControls>

			<ServerSideRender
				block="jco/global-content"
				attributes={{ ...attributes, preview: true }}
			/>
		</>
	);
}
