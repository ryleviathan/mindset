<?php
/**
 * Post Type and Taxonomy Registrations
 */

function mindset_register_custom_post_types() {
    // 1. Works CPT
    $labels_works = array(
        'name'                     => _x( 'Works', 'post type general name', 'mindset-theme' ),
        'singular_name'            => _x( 'Work', 'post type singular name', 'mindset-theme' ),
        'add_new'                  => _x( 'Add New', 'work', 'mindset-theme' ),
        'add_new_item'             => __( 'Add New Work', 'mindset-theme' ),
        'edit_item'                => __( 'Edit Work', 'mindset-theme' ),
        'all_items'                => __( 'All Works', 'mindset-theme' ),
        'menu_name'                => _x( 'Works', 'admin menu', 'mindset-theme' ),
    );
    $args_works = array(
        'labels'             => $labels_works,
        'public'             => true,
        'show_in_rest'       => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'works' ),
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );
    register_post_type( 'fwd-work', $args_works );

    // 2. Testimonials CPT
    $labels_testimonials = array(
        'name'                  => _x( 'Testimonials', 'post type general name', 'mindset-theme' ),
        'singular_name'         => _x( 'Testimonial', 'post type singular name', 'mindset-theme' ),
        'menu_name'             => _x( 'Testimonials', 'admin menu', 'mindset-theme' ),
        'add_new_item'          => __( 'Add New Testimonial', 'mindset-theme' ),
    );
    $args_testimonials = array(
        'labels'             => $labels_testimonials,
        'public'             => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'editor' ),
    );
    register_post_type( 'fwd-testimonial', $args_testimonials );

    // 3. Job Postings CPT
    $labels_jobs = array(
        'name'          => 'Job Postings',
        'singular_name' => 'Job Posting',
    );
    $args_jobs = array(
        'labels'             => $labels_jobs,
        'public'             => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array( 'title', 'editor' ),
    );
    register_post_type( 'fwd-job-posting', $args_jobs );

    // 4. Services CPT
    $labels_services = array(
        'name'          => 'Services',
        'singular_name' => 'Service',
    );
    $args_services = array(
        'labels'             => $labels_services,
        'public'             => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-chart-bar',
        'supports'           => array( 'title', 'editor' ),
    );
    register_post_type( 'fwd-service', $args_services );
}
add_action( 'init', 'mindset_register_custom_post_types' );

function mindset_register_taxonomies() {
    
    // Taxonomy: Work Categories (for Works)
    register_taxonomy( 'fwd-work-category', array( 'fwd-work' ), array(
        'hierarchical'      => true,
        'labels'            => array( 'name' => 'Work Categories' ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
    ) );

    // Taxonomy: Featured Works (for Works)
    register_taxonomy( 'fwd-featured', array( 'fwd-work' ), array(
        'hierarchical'      => true,
        'labels'            => array( 'name' => 'Featured Works' ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
    ) );

    // Taxonomy: Service Types (for Services)
    register_taxonomy( 'fwd-service-type', array( 'fwd-service' ), array(
        'hierarchical'      => true,
        'labels'            => array( 'name' => 'Service Types' ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
    ) );

    // Taxonomy: Featured Status (for Testimonials)
    $labels_test_feat = array(
        'name'          => 'Featured Status',
        'singular_name' => 'Featured Status',
        'menu_name'     => 'Featured Testimonial',
    );
    $args_test_feat = array(
        'hierarchical'      => true,
        'labels'            => $labels_test_feat,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'featured-testimonial' ),
    );
    register_taxonomy( 'fwd-testimonial-featured', array( 'fwd-testimonial' ), $args_test_feat );
}
add_action( 'init', 'mindset_register_taxonomies' );

/**
 * Flush rewrite rules on theme activation
 */
function mindset_rewrite_flush() {
    mindset_register_custom_post_types();
    mindset_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'mindset_rewrite_flush' );