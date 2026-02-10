<?php
/**
 * Post Type and Taxonomy Registrations
 */

function mindset_register_custom_post_types() {
    // Register Works Custom Post Type
    $labels = array(
        'name'                     => _x( 'Works', 'post type general name', 'mindset-theme' ),
        'singular_name'            => _x( 'Work', 'post type singular name', 'mindset-theme' ),
        'add_new'                  => _x( 'Add New', 'work', 'mindset-theme' ),
        'add_new_item'             => __( 'Add New Work', 'mindset-theme' ),
        'edit_item'                => __( 'Edit Work', 'mindset-theme' ),
        'new_item'                 => __( 'New Work', 'mindset-theme' ),
        'view_item'                => __( 'View Work', 'mindset-theme' ),
        'view_items'               => __( 'View Works', 'mindset-theme' ),
        'search_items'             => __( 'Search Works', 'mindset-theme' ),
        'not_found'                => __( 'No works found.', 'mindset-theme' ),
        'not_found_in_trash'       => __( 'No works found in Trash.', 'mindset-theme' ),
        'all_items'                => __( 'All Works', 'mindset-theme' ),
        'menu_name'                => _x( 'Works', 'admin menu', 'mindset-theme' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'rewrite'            => array( 'slug' => 'works' ),
        'has_archive'        => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );
    register_post_type( 'fwd-work', $args );

    // Register Testimonial Custom Post Type
    $labels_testimonial = array(
        'name'                  => _x( 'Testimonials', 'post type general name', 'mindset-theme' ),
        'singular_name'         => _x( 'Testimonial', 'post type singular name', 'mindset-theme' ),
        'menu_name'             => _x( 'Testimonials', 'admin menu', 'mindset-theme' ),
        'add_new'               => _x( 'Add New', 'testimonial', 'mindset-theme' ),
        'add_new_item'          => __( 'Add New Testimonial', 'mindset-theme' ),
    );

    $args_testimonial = array(
        'labels'             => $labels_testimonial,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'editor' ),
        'template'           => array( array( 'core/pullquote' ) ),
        'template_lock'      => 'all'
    );
    register_post_type( 'fwd-testimonial', $args_testimonial );

    // Register Job Postings Custom Post Type
    $labels_jobs = array(
        'name'                  => _x( 'Job Postings', 'post type general name', 'mindset-theme' ),
        'singular_name'         => _x( 'Job Posting', 'post type singular name', 'mindset-theme' ),
        'menu_name'             => _x( 'Job Postings', 'admin menu', 'mindset-theme' ),
    );
    $args_jobs = array(
        'labels'             => $labels_jobs,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'rewrite'            => array( 'slug' => 'careers' ),
        'has_archive'        => true,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array( 'title', 'editor' ),
    );
    register_post_type( 'fwd-job-posting', $args_jobs );

    // Register Service Custom Post Type
    $labels_services = array(
        'name'                     => _x( 'Services', 'post type general name', 'mindset-theme' ),
        'singular_name'            => _x( 'Service', 'post type singular name', 'mindset-theme' ),
        'add_new'                  => _x( 'Add New', 'service', 'mindset-theme' ),
        'add_new_item'             => __( 'Add New Service', 'mindset-theme' ),
        'edit_item'                => __( 'Edit Service', 'mindset-theme' ),
        'all_items'                => __( 'All Services', 'mindset-theme' ),
        'menu_name'                => _x( 'Services', 'admin menu', 'mindset-theme' ),
    );
    $args_services = array(
        'labels'             => $labels_services,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'rewrite'            => array( 'slug' => 'services' ),
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-chart-bar',
        'supports'           => array( 'title', 'editor' ),
    );
    register_post_type( 'fwd-service', $args_services );
}
add_action( 'init', 'mindset_register_custom_post_types' );

function mindset_register_taxonomies() {
    // Work Category taxonomy
    $labels_work_cat = array(
        'name'          => _x( 'Work Categories', 'taxonomy general name', 'mindset-theme' ),
        'singular_name' => _x( 'Work Category', 'taxonomy singular name', 'mindset-theme' ),
    );
    $args_work_cat = array(
        'hierarchical'      => true,
        'labels'            => $labels_work_cat,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'work-categories' ),
    );
    register_taxonomy( 'fwd-work-category', array( 'fwd-work' ), $args_work_cat );

    // Featured taxonomy
    $labels_feat = array(
        'name'          => _x( 'Featured', 'taxonomy general name', 'mindset-theme' ),
        'singular_name' => _x( 'Featured', 'taxonomy singular name', 'mindset-theme' ),
    );
    $args_feat = array(
        'hierarchical'      => true,
        'labels'            => $labels_feat,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'featured' ),
    );
    register_taxonomy( 'fwd-featured', array( 'fwd-work' ), $args_feat );

    // Service Types Taxonomy
    $service_type_labels = array(
        'name'              => _x( 'Service Types', 'taxonomy general name', 'mindset-theme' ),
        'singular_name'     => _x( 'Service Type', 'taxonomy singular name', 'mindset-theme' ),
        'search_items'      => __( 'Search Service Types', 'mindset-theme' ),
        'all_items'         => __( 'All Service Types', 'mindset-theme' ),
        'edit_item'         => __( 'Edit Service Type', 'mindset-theme' ),
        'update_item'       => __( 'Update Service Type', 'mindset-theme' ),
        'add_new_item'      => __( 'Add New Service Type', 'mindset-theme' ),
        'new_item_name'     => __( 'New Service Type Name', 'mindset-theme' ),
        'menu_name'         => __( 'Service Types', 'mindset-theme' ),
    );

    $service_type_args = array(
        'hierarchical'      => true,
        'labels'            => $service_type_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'service-type' ),
    );
    register_taxonomy( 'fwd-service-type', array( 'fwd-service' ), $service_type_args );
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