<?php
/**
 * Plugin Name: Mindset Blocks
 * Description: Custom Gutenberg blocks for the Mindset theme.
 * Version: 1.0.0
 * Author: FWD
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the blocks
 */
function mindset_blocks_init() {

    // 1. Featured Testimonial
    // We only need the path. WordPress reads the render.php automatically from block.json
    register_block_type( __DIR__ . '/build/featured-testimonial' );

    // 2. Services Jump Links
    register_block_type( __DIR__ . '/build/company-services', array(
        'render_callback' => 'mindset_render_services_jump_links',
    ) );

    // 3. Company Address
    register_block_type( __DIR__ . '/build/company-address', array(
        'render_callback' => 'mindset_render_company_address',
    ) );

    // 4. Company Email
    register_block_type( __DIR__ . '/build/company-email', array(
        'render_callback' => 'mindset_render_company_email',
    ) );

    // 5. Copyright Date
    register_block_type( __DIR__ . '/build/copyright-date', array(
        'render_callback' => 'mindset_render_copyright_date',
    ) );
}
add_action( 'init', 'mindset_blocks_init' );

/**
 * Render Testimonials: Featured Logic
 */
function mindset_render_featured_testimonial( $attributes, $content, $block ) {
    $testimonial_query = new WP_Query( array(
        'post_type'      => 'fwd-testimonial',
        'posts_per_page' => 1,
        'tax_query'      => array(
            array(
                'taxonomy' => 'fwd-testimonial-featured',
                'field'    => 'slug',
                'terms'    => 'featured', 
            ),
        ),
    ) );

    if ( ! $testimonial_query->have_posts() ) {
        return '<p>No featured testimonials found.</p>';
    }

    $output = '<div class="featured-testimonials-wrapper">';
    while ( $testimonial_query->have_posts() ) {
        $testimonial_query->the_post();
        $output .= '<blockquote class="testimonial-item">';
        $output .= '<div class="testimonial-content">' . get_the_content() . '</div>';
        $output .= '<cite class="testimonial-author">— ' . get_the_title() . '</cite>';
        $output .= '</blockquote>';
    }
    $output .= '</div>';

    wp_reset_postdata();
    return $output;
}

/**
 * Render Services: Simple List Logic
 */
function mindset_render_services_jump_links( $attributes, $content, $block ) {
    $services_query = new WP_Query( array(
        'post_type'      => 'fwd-service',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ) );

    if ( ! $services_query->have_posts() ) {
        return '<p>No services found.</p>';
    }

    $output = '<div class="services-container"><ul>';
    while ( $services_query->have_posts() ) {
        $services_query->the_post();
        $output .= '<li><a href="#' . sanitize_title( get_the_title() ) . '">' . get_the_title() . '</a></li>';
    }
    $output .= '</ul></div>';

    wp_reset_postdata();
    return $output;
}

/**
 * Render Company Address
 */
function mindset_render_company_address( $attributes, $content, $block ) {
    $address = get_theme_mod( 'mindset_address_setting', '123 Default St, City, State' );
    return '<div class="company-address">' . esc_html( $address ) . '</div>';
}

/**
 * Render Company Email
 */
function mindset_render_company_email( $attributes, $content, $block ) {
    $email = get_theme_mod( 'mindset_email_setting', 'hello@mindset.com' );
    return '<div class="company-email"><a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a></div>';
}

/**
 * Render Copyright Date
 */
function mindset_render_copyright_date( $attributes, $content, $block ) {
    $year = date( 'Y' );
    $company_name = get_bloginfo( 'name' );
    return '<div class="wp-block-copyright-date">&copy; ' . esc_html( $year ) . ' ' . esc_html( $company_name ) . '</div>';
}