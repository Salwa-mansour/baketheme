<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bake
 */

?>

<article id="post-<?php the_ID(); ?>" <?php 

if ( class_exists( 'WooCommerce' ) ):

	if ( is_checkout() ) {post_class('checkout-post');} 

	elseif (is_user_logged_in() && is_account_page() ) {post_class('wc-dashboard'); }
	elseif (! is_user_logged_in() && is_account_page() ) {post_class('login-page'); }
		
		else post_class();

	endif;
  ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	


	<div class="entry-content">
	<?php baketheme_post_thumbnail(); ?>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'baketheme' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->



		<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'baketheme' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
		
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
