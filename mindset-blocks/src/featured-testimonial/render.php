<?php
$query = new WP_Query( array(
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

if ( ! $query->have_posts() ) {
    echo '<p>No featured testimonials found. Tag one as "Featured"!</p>';
    return;
}

$query->the_post(); // Pull the data
?>

<div <?php echo get_block_wrapper_attributes(); ?>>
    <blockquote class="testimonial-item">
        <div class="testimonial-content"><?php the_content(); ?></div>
        <cite class="testimonial-author">— <?php the_title(); ?></cite>
    </blockquote>
</div>

<?php wp_reset_postdata(); ?>