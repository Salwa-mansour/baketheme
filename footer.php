<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bake
 */

?>

	<footer id="colophon" class="site-footer">

		<div class="site-info">

		<div class="contact-details-wrapper">
			<h2>contact us</h2>
			<ul>
				<li id="phone"><span class="dashicons"></span>
					<span class="data"><?php echo get_theme_mod('telephone_setting' ,'0634241'  ); ?></span>
				</li>

				<li id="cell-phone"><span class="dashicons"></span>
					<span class="data"><?php echo get_theme_mod('cellphone_setting' ,'7777777'  ); ?>	</span>
				</li>
					<li id="email"><span class="dashicons"></span>
				<span class="data"><?php echo get_theme_mod('email_setting' ,'7777777'  ); ?></span>
				</li>
				
			</ul>
		</div><!--contact-details-wrapper-->
		<div class = "vertical-roll"></div>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
			//	printf( esc_html__( 'Theme: %1$s by %2$s.', 'baketheme' ), 'baketheme', '<a href="https:githubsalwa-mansour.com">salwa</a>' );
			
			if ( ! is_active_sidebar( 'footer-socail-1' ) ) {
				return;
			}
			?>
			
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'footer-socail-1' ); ?>
			</aside><!-- #secondary -->
				

				
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
