/**
* Imports.
*/
import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps, PanelColorSettings } from '@wordpress/block-editor';
import { PanelBody, PanelRow, ToggleControl } from '@wordpress/components';

/**
* Export.
*/
export default function Edit( {attributes, setAttributes} ) {
    // Destructure attributes
    const { navigation, pagination, backgroundColor, arrowColor } = attributes;
    
    // Create const with CSS custom property (Requirement)
    const blockStyles = {
        backgroundColor: backgroundColor,
        '--arrow-color': arrowColor
    };

    return (
        <>
            <InspectorControls>
                <PanelBody title={ __( 'Settings', 'testimonial-slider' ) }>
                    <PanelRow>
                        <ToggleControl
                            label={ __( 'Navigation', 'testimonial-slider' ) }
                            checked={ navigation }
                            onChange={ ( value ) => setAttributes( { navigation: value } ) }
                        />
                    </PanelRow>
                    <PanelRow>
                        <ToggleControl
                            label={ __( 'Pagination', 'testimonial-slider' ) }
                            checked={ pagination }
                            onChange={ ( value ) => setAttributes( { pagination: value } ) }
                        />
                    </PanelRow>
                </PanelBody>

                <PanelColorSettings
                    title={ __( 'Color Settings', 'testimonial-slider' ) }
                    colorSettings={ [
                        {
                            value: backgroundColor,
                            onChange: ( value ) => setAttributes( { backgroundColor: value } ),
                            label: __( 'Background Color', 'testimonial-slider' ),
                        },
                        {
                            value: arrowColor,
                            onChange: ( value ) => setAttributes( { arrowColor: value } ),
                            label: __( 'Arrow Color', 'testimonial-slider' ),
                        },
                    ] }
                />
            </InspectorControls>

            {/* Use the blockStyles const here (Requirement) */}
            <div { ...useBlockProps({ style: blockStyles }) }>
                <div className="swiper">
                    <div className="swiper-wrapper">
                        <div className="swiper-slide">
                            <div className="testimonial-content">
                                <p>“Sample testimonial preview content.”</p>
                                <cite>— Author Name</cite>
                            </div>
                        </div>
                    </div>
                </div>

                { pagination && (
                    <div className="swiper-pagination">
                        <span className="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                    </div>
                ) }

                { navigation && (
                    <>
                        <div className="swiper-button-prev">
                            <svg width="11" height="20" viewBox="0 0 11 20" fill="none">
                                {/* Use custom property for fill (Requirement) */}
                                <path 
                                    d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3473 0.654131 20.3473 0.38296 20.0762Z" 
                                    fill="var(--arrow-color)" 
                                />
                            </svg>
                        </div>
                        <div className="swiper-button-next">
                            <svg width="11" height="20" viewBox="0 0 11 20" fill="none">
                                <path 
                                    d="M10.4341 20.0762C10.7053 19.805 10.7053 19.3654 10.4341 19.0942L1.61944 10.2796L10.4341 1.46497C10.7053 1.19379 10.7053 0.754138 10.4341 0.482966C10.1629 0.211794 9.72327 0.211794 9.45209 0.482966L0.382914 9.55214C-0.0188435 9.9539 -0.0188435 10.6053 0.382914 11.007L9.45209 20.0762C9.72327 20.3473 10.1629 20.3473 10.4341 20.0762Z" 
                                    fill="var(--arrow-color)" 
                                />
                            </svg>
                        </div>
                    </>
                ) }
            </div>
        </>
    );
}