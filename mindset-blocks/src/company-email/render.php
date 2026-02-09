<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
$email_address = get_post_meta( 17, 'company_email', true );
?>

<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php if ( $attributes[ 'svgIcon' ] ) : ?>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Email Icon">
			<path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
		</svg>
	<?php endif; ?>

	<p>
		<?php if ( ! empty( $email_address ) ) : ?>
			<a href="mailto:<?php echo esc_attr( $email_address ); ?>">
				<?php echo esc_html( $email_address ); ?>
			</a>
		<?php else : ?>
			<?php esc_html_e( 'Add email in editor...', 'company-email' ); ?>
		<?php endif; ?>
	</p>
</div>