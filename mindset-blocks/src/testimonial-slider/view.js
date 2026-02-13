import { SwiperInit } from './swiper-init';

document.addEventListener('DOMContentLoaded', () => {
    // Find all instances of this specific block
    const elements = document.querySelectorAll('.wp-block-mindset-blocks-testimonial-slider');

    elements.forEach( ( block ) => {
        const container = block.querySelector('.swiper');
        const optionsData = block.getAttribute('data-options');
        
        if ( container && optionsData ) {
            const options = JSON.parse( optionsData );
            SwiperInit( container, options );
        }
    });
});