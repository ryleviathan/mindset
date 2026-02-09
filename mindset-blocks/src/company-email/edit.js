import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { useEntityProp } from '@wordpress/core-data';
import { PanelBody, PanelRow, ToggleControl } from '@wordpress/components';

export default function Edit( {attributes, setAttributes} ) {
	const postID = 17;
	const [meta, setMeta] = useEntityProp('postType', 'page', 'meta', postID);
	const { company_email } = meta;
 
	const updateMeta = ( key, value ) => {
		setMeta( { ...meta, [key]: value } );
	};
 
	const { svgIcon } = attributes;
 
	return (
		<>
			<div { ...useBlockProps() }>
				{ svgIcon && 
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Email Icon">
						<path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
					</svg>
				}
				<RichText
					placeholder={ __( 'Enter company email...', 'company-email' ) }
					tagName="p"
					value={ company_email }
					onChange={ ( nextValue ) => updateMeta("company_email", nextValue) }
				/>
			</div>
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'company-email' ) }>
					<PanelRow>
						<ToggleControl
							label={ __( 'Show SVG Icon', 'company-email' ) }
							checked={ svgIcon }
							onChange={ ( value ) =>
								setAttributes( { svgIcon: value } )
							}
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
		</>
	);
}
