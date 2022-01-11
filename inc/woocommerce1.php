<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package bake
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function baketheme_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'baketheme_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function baketheme_woocommerce_scripts() {
	wp_enqueue_style( 'baketheme-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'baketheme-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'baketheme_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function baketheme_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'baketheme_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function baketheme_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'baketheme_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'baketheme_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function baketheme_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'baketheme_woocommerce_wrapper_before' );

if ( ! function_exists( 'baketheme_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function baketheme_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'baketheme_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'baketheme_woocommerce_header_cart' ) ) {
			baketheme_woocommerce_header_cart();
		}

	?>
 */

if ( ! function_exists( 'baketheme_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function baketheme_woocommerce_cart_link_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		?>
		<span class="items-count"><?php echo  WC()->cart->get_cart_contents_count(); ?></span>
		<?php
		// baketheme_woocommerce_cart_link();
		$fragments['span.items-count'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'baketheme_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'baketheme_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function baketheme_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'baketheme' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d ', '%d ', WC()->cart->get_cart_contents_count(), 'baketheme' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> 
			<span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		
		</a>
		<?php
	}
}

if ( ! function_exists( 'baketheme_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function baketheme_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php baketheme_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
				ghjtrfu tf uxtxty
			</li>
		</ul>
		<?php
	}
}
	// ///////////////////
	
	remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
	// if(is_shop()){
	 remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
	// }
	add_action('woocommerce_after_shop_loop_item_title','the_excerpt', 2);
	add_action('woocommerce_before_shop_loop_item_title' ,'thumnail_container_start',9  );
	add_action('woocommerce_before_shop_loop_item_title' ,'thumnail_container_end',11  );
	// add_action('woocommerce_before_shop_loop_item_title','sale_container_start',8);
	// add_action('woocommerce_before_shop_loop_item_title','sale_container_end',9);
	// function sale_container_start(){
	// 	echo('<div class="sale-div" >');
	// }
	// function sale_container_end(){
	// 	echo('</div><!--.sale-div-->');
	// }
	function thumnail_container_start(){
		echo('<figure class="product-thumpnail">');
	}
	function thumnail_container_end(){
		echo('</figure ><!--product-thumpnail-->');
	}
	
	add_action('woocommerce_shop_loop_item_title' ,'product_prife_info_div_start', 9 );
	add_action('woocommerce_after_shop_loop_item' ,'product_prife_info_div_end' , 11);
	
	function product_prife_info_div_start(){
		echo('<div class="product-prife-info">');
	}
	function product_prife_info_div_end(){
		echo('</div><!-- product-prife-info -->');
	}
	remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
	
	add_action('woocommerce_before_single_product_summary' , 'single_product_flex_start' , 9);
	add_action('woocommerce_after_single_product_summary' , 'single_product_flex_end' , 9);
	
	function single_product_flex_start(){
		echo('<div class="single_product_flex">');
	}
	function single_product_flex_end(){
		echo('</div> <!--single_product_flex-->');
	}


