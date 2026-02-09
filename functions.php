<?php
function mindset_enqueues() {
    wp_enqueue_style( 
        'mindset-normalize', 
        'https://unpkg.com/@csstools/normalize.css', 
        array(), 
        '12.1.0'
    );

    // Load style.css on the front-end
    wp_enqueue_style( 
        'mindset-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' ),
        'all'
    );
    
    // Original Scroll to Top Script
    wp_enqueue_script(
        'mindset-scroll-to-top', 
        get_theme_file_uri( 'assets/js/scroll-to-top.js' ), 
        array(), 
        wp_get_theme()->get( 'Version' ), 
        array( 'strategy' => 'defer' ) 
    );

    // NEW: Enqueue color-change JS ONLY on the Contact Page
    // Dependency: 'mindset-scroll-to-top'
    if ( is_page( 'contact' ) ) {
        wp_enqueue_script(
            'mindset-contact-scroll-color', 
            get_theme_file_uri( 'assets/js/contact-scroll-color.js' ), 
            array( 'mindset-scroll-to-top' ), 
            wp_get_theme()->get( 'Version' ), 
            array( 'strategy' => 'defer' )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'mindset_enqueues' );

function mindset_setup() {
    //Load styles.css in the block editor
    add_editor_style( get_stylesheet_uri() );

    // Image Sizes
    add_image_size( '400x500', 400, 500, true );
    add_image_size( '200x250', 200, 250, true );
    add_image_size( '800x400', 800, 400, true );
    add_image_size( '400x200', 400, 200, true );
}
add_action( 'after_setup_theme', 'mindset_setup' );

// Make custom sizes selectable from WordPress admin.
function mindset_add_custom_image_sizes( $size_names ) {
    $new_sizes = array(
        '400x500' => __( '400x500', 'mindset-theme' ),
        '200x250' => __( '200x250', 'mindset-theme' ),
        '800x400' => __( '800x400', 'mindset-theme' ),
        '400x200' => __( '400x200', 'mindset-theme' ),
    );
    return array_merge( $size_names, $new_sizes );
}
add_filter( 'image_size_names_choose', 'mindset_add_custom_image_sizes' );

// Load custom blocks.
require get_theme_file_path() . '/mindset-blocks/mindset-blocks.php';

/**
 * Register Custom Meta for Company Blocks
 */
function mindset_register_meta() {
    // Register the Email Meta
    register_post_meta( 'page', 'company_email', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
    ) );

    // IMPORTANT: Make sure the Address meta is also registered 
    // if you are still using the original block too!
    register_post_meta( 'page', 'company_address', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
    ) );
}
add_action( 'init', 'mindset_register_meta' );