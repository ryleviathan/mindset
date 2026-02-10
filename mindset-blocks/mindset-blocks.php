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
    register_block_type( __DIR__ . '/build/company-services', array(
        'render_callback' => 'mindset_render_services_jump_links',
    ) );
}
add_action( 'init', 'mindset_blocks_init' );

/**
 * Render Callback for the Services Jump Links Block
 * This version organizes posts by their Taxonomy Terms (Service Types)
 */
function mindset_render_services_jump_links( $attributes, $content, $block ) {
    // 1. Get all terms from our 'fwd-service-type' taxonomy
    $terms = get_terms( array(
        'taxonomy'   => 'fwd-service-type',
        'hide_empty' => true, // Only show terms that actually have posts
    ) );

    // If no terms exist, show a helpful message
    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        return '<p>' . __( 'No service categories found. Please add Service Types and assign them to your services.', 'mindset-theme' ) . '</p>';
    }

    ob_start();
    ?>
    <div class="wp-block-mindset-blocks-company-services">
        <?php 
        // 2. Loop through each Category (Term)
        foreach ( $terms as $term ) : ?>
            <div class="service-taxonomy-group" style="margin-bottom: 2rem;">
                <h2 class="taxonomy-title">
                    <?php echo esc_html( $term->name ); ?>
                </h2>
                
                <?php
                // 3. Query only the services belonging to this specific term
                $services_query = new WP_Query( array(
                    'post_type'      => 'fwd-service',
                    'posts_per_page' => -1,
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'fwd-service-type',
                            'field'    => 'slug',
                            'terms'    => $term->slug,
                        ),
                    ),
                ) );

                if ( $services_query->have_posts() ) : ?>
                    <ul class="service-links-list">
                        <?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                            <li class="service-link-item">
                                <a href="#<?php echo sanitize_title( get_the_title() ); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php 
                endif; 
                wp_reset_postdata(); // Reset the global $post object for the next loop
                ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
