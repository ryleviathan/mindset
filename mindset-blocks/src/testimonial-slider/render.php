<?php
/**
 * Testimonial Slider Block Render Template.
 */

// Attributes
$bg_color    = isset( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : 'transparent';
$arrow_color = isset( $attributes['arrowColor'] ) ? $attributes['arrowColor'] : '#000000';

// PHP Variable storing the CSS custom property string (Requirement)
$custom_styles = "background-color: $bg_color; --arrow-color: $arrow_color;";

$slider_options = wp_json_encode( array(
    'pagination' => $attributes['pagination'],
    'navigation' => $attributes['navigation']
) );

// Pass variable to wrapper attributes (Requirement)
$wrapper_attributes = get_block_wrapper_attributes( array(
    'data-options' => $slider_options,
    'style'        => $custom_styles
) );
?>

<div <?php echo $wrapper_attributes; ?>>
    <?php
    $query = new WP_Query( array( 'post_type' => 'fwd-testimonial', 'posts_per_page' => -1 ) );
    if ( $query->have_posts() ) : ?>
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="swiper-slide"><?php the_content(); ?></div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</div>