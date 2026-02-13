<?php
/**
 * Title: Book Review
 * Slug: mindset-theme/book-review
 * Categories: text, media
 */
?>

<!-- wp:media-text {"mediaId":24,"mediaLink":"http://localhost:8888/mindset/?attachment_id=24","mediaType":"image","mediaWidth":40} -->
<div class="wp-block-media-text is-stacked-on-mobile" style="grid-template-columns:40% auto"><figure class="wp-block-media-text__media"><img src="<?php echo get_theme_file_uri( '/assets/images/book-cover.jpg' ); ?>" alt="<?php esc_html_e('Book Cover', 'mindset-theme'); ?>" class="wp-image-24 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e('Title', 'mindset-theme'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Author</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Description</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:media-text -->