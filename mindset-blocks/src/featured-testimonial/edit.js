import { useBlockProps, ServerSideRender } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit() {
    return (
        <div { ...useBlockProps() }>
            <ServerSideRender
                block="mindset-blocks/featured-testimonial" 
            />
        </div>
    );
}

<ServerSideRender
    block="mindset-blocks/featured-testimonial"
/>