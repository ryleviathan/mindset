window.addEventListener('load', function() {
    const button = document.getElementById('scroll-top');

    if (button) {
        // 1. Make the button's actual square box invisible
        button.style.backgroundColor = 'transparent';
        button.style.border = 'none';
        button.style.outline = 'none';

        // 2. Target the SVG triangle and make it orange
        const svgPath = button.querySelector('path');
        if (svgPath) {
            svgPath.style.fill = '#ff5733';
        }
        
        console.log('Targeted the SVG path directly.');
    }
});