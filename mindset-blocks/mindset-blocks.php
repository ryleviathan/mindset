<?php
/**
 * Registers the block(s) metadata from the `blocks-manifest.php`
 */
function mindset_blocks_mindset_blocks_block_init() {
    // This line registers ALL your blocks at once from the build folder
    wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
}
add_action( 'init', 'mindset_blocks_mindset_blocks_block_init' );

/**
 * 1. The Rendering Function for Services
 * This is what outputs the HTML for the Services block specifically.
 */
function mindset_render_services_jump_links( $attributes, $content, $block ) {
    $services_query = new WP_Query( array(
        'post_type'      => 'fwd-service',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ) );

    if ( ! $services_query->have_posts() ) {
        return '<p>' . __( 'No services found.', 'mindset-theme' ) . '</p>';
    }

    ob_start();
    ?>
    <div class="wp-block-mindset-blocks-company-services">
        <nav class="services-jump-navigation">
            <ul>
                <?php while ( $services_query->have_posts() ) : $services_query->the_post(); 
                    $anchor_id = sanitize_title( get_the_title() ); 
                ?>
                    <li>
                        <a href="#<?php echo esc_attr( $anchor_id ); ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </nav>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * 2. The Filter
 * This attaches the function above to the specific block name.
 */
function mindset_register_dynamic_render_callbacks( $args, $name ) {
    if ( $name === 'mindset-blocks/company-services' ) {
        $args['render_callback'] = 'mindset_render_services_jump_links';
    }
    return $args;
}
add_filter( 'register_block_type_args', 'mindset_register_dynamic_render_callbacks', 10, 2 );

/**
* 3. Custom Fields
*/
function mindset_register_custom_fields() {
    register_post_meta(
        'page',
        'company_email',
        array(
            'type'         => 'string',
            'show_in_rest' => true,
            'single'       => true
        )
    );
    register_post_meta(
        'page',
        'company_address',
        array(
            'type'         => 'string',
            'show_in_rest' => true,
            'single'       => true
        )
    );
}
add_action( 'init', 'mindset_register_custom_fields' );
