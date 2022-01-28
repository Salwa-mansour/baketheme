<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bake
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'baketheme' ); ?></a>

	<header id="masthead" class="site-header <?php if (  ! is_front_page() ) {echo('short-header');   }   ?>">
	
 

	

			<div class="hero-container">
                <img src="<?php header_image(); ?>" alt="" class="hero-img">
            </div>

		<div class="site-branding">
			<?php
			the_custom_logo();?>
			<p class="welcom"><?php esc_html_e('welcom to'); ?></p>
		<?php	if ( is_front_page() && is_home() ) :
				?>
			
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			endif;
			$baketheme_description = get_bloginfo( 'description', 'display' );
			if ( $baketheme_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $baketheme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
			<!-- \\get link of about us page by query -->
			<a href="<?php  echo esc_url(get_permalink( get_option( 'woocommerce_shop_page_id' )));  ?>" class="callout-link">collect bread</a>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="dashicons dashicons-menu-alt"></span></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
			<?php the_custom_logo(); ?>
			<?php
				if ( class_exists( 'WooCommerce' ) ) {
				?>
				<!-- <div class="cart-menu"> -->

				
							<ul class="cart-nav">
							 <li class="page-item cart-item">
								
								<a href="<?php echo wc_get_cart_url(); ?>">
									<span class="dashicons dashicons-cart"></span>
									<span class="items-count"><?php echo  WC()->cart->get_cart_contents_count(); ?></span>
								</a>
							 </li>	
							 <li class="page-item">
								 <?php  get_search_form(); ?>
							 </li>
							 <?php if( is_user_logged_in()): ?>
								 <li>
								<a href="<?php echo esc_url(get_permalink( get_option( 'woocommerce_myaccount_page_id' ))); ?>" title="<?php esc_html_e('my account'); ?>">
								<span class="dashicons dashicons-admin-users"></span></a>
								</li>
								 <li>
								 <a href="<?php echo esc_url( wp_logout_url( get_permalink(get_option( 'woocommerce_myaccount_page_id' )) )); ?>" title="<?php esc_html_e('logout'); ?>" >
								 <span class="dashicons dashicons-exit"></span></a>
								 </li>
							 <?php else: ?>
								<li>
								<a href="<?php echo esc_url(get_permalink( get_option( 'woocommerce_myaccount_page_id' ))); ?>">
								<?php esc_html_e('login/register'); ?></a>
								</li>
							 <?php  endif; ?>
							
								
							</ul><!--cart-nav-->

						<?php	
						}else{
									wp_nav_menu(
							array(
								'theme_location' => 'menu-2',
								'menu_id'        => 'secondary-menu',
							)
						);
							}
					
						?>
					</nav><!-- #site-navigation -->
				<!-- </div>cart-menu -->
	</header><!-- #masthead -->
