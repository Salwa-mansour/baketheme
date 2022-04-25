<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bake
 */

get_header();
?>
<?php 
	// $about_page =get_page_by_title('about us');
	// print_r($about_page);

?>
<main id="primary" class="site-main front-page">
	<section class=" front-section about-us">
		<div class="content">
			<!-- about us section -->
			<?php
				// global $post;
			
				$aboutpage = get_posts( array(
					'post_type'   => 'page',
					'title'  => 'about us',
					
				) );
			
				if ( $aboutpage ) {
					foreach ( $aboutpage as $post ) : 
						setup_postdata( $post ); ?>
			<?php	get_template_part( 'template-parts/content', 'front-about' ); ?>
			<?php
					endforeach;
					wp_reset_postdata();
				}
				?>



		</div>



	</section>
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<?php if ( class_exists( 'WooCommerce' ) ) : ?>

			<section class="front-section">
				<!-- catigories section -->
				<div class="content">
					<ul class="wp-block-categories-list ">
						<?php 
							$args = array(
								'taxonomy'     => 'product_cat',
								'orderby'      => 'date',
								'order'		   => 'asc',
								// 'show_count'   => $show_count,
								// 'pad_counts'   => $pad_counts,
								// 'hierarchical' => 0,
								'title_li'     => '',
								// 'hide_empty'   => $empty
						);
						$all_categories = get_categories( $args );
						foreach ($all_categories as $cat) :
							
							$category_id = $cat->term_id;  
								// get the thumbnail id using the queried category term_id
								$thumbnail_id = get_term_meta( $category_id , 'thumbnail_id', true ); 

								// get the image URL
								$image = wp_get_attachment_url( $thumbnail_id ); 
						// echo ($image.'kkkkkk');
							$cat_data=get_term($category_id);
							//    print_r($cat_data);
							?>
						<li class="cat-item ">
							<img src="<?php echo($image) ; ?>" alt="<?php esc_html_e('catigoury image'); ?>" class="cat-img">
							<div class="cat-text">
								<div class="center-text">
									<h1 class="cat-name"><?php echo$cat_data->name; ?></h1>
									<p class="cat-description"><?php echo($cat_data -> description) ?></p>
									<a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?> " class="callout-link">shop
										now</a>
								</div>
								<!--.center-text-->

							</div>
							<!--cat-item-->

						</li>
						<?php
							//    echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';
						endforeach;?>



					</ul>
				</div>

			</section>

	<?php endif;//if ( class_exists( 'WooCommerce' ) ) : ?>
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<?php if ( class_exists( 'WooCommerce' ) ) : ?>

			<section class=" front-section">

				<div class="content best-selling">
					<h3>best selling products</h3>
					<ul class="best-selling-prodcuts">
						<?php
						$args = array(
							'post_type' => 'product',
							'meta_key' => 'total_sales',
							'orderby' => 'meta_value_num',
							'posts_per_page' => 1,
						);

						$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post(); 
							global $product;
						?>
						<li class="product">
							<a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>" title="<?php the_title(); ?>">

								<?php if (has_post_thumbnail( $loop->post->ID )) 
								echo get_the_post_thumbnail($loop->post->ID, 'medium'); 
								else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" width="65px" height="115px" />'; ?>


							</a>
						</li>
						<?php 
						endwhile;
						wp_reset_query(); ?>
					</ul>

				</div>
			</section>
			
	<?php endif;//if ( class_exists( 'WooCommerce' ) ) : ?>
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<section class="front-section featuers-section">
		<!-- features section -->
		<div class="content">
			<p class="why-choose">why choose</p>
			<h3 class="our-service">our bakery</h3>
			<div class="features-wrapper">
				<?php for($i=1;$i<=4;$i++): ?>

				<div id="feature-<?php echo($i); ?>" class="feature">

					<?php echo wp_get_attachment_image(( get_theme_mod('feature_image'.$i) )); ?>

					<h4><?php echo get_theme_mod('title_setting'.$i ,'freashly baked'  ); ?></h4>

					<p><?php echo(get_theme_mod('feature_description_setting'.$i ,'Lorem ipsum dolor sit amet consectetur.'))  ?>
					</p>
				</div>
				<!--feature--->
				<?php endfor; ?>
			</div>
			<!--features wrapper-->


		</div>

	</section>
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<section class=" front-section rivew">
		<!-- user reviue section -->
		<?php $backgroundId= get_theme_mod('t_background_image'); ?>
		<div id="bake-reviw-slider" class="carousel slide" data-ride="carousel"
			style="background-image: linear-gradient(rgba(225, 225, 225, .3) , rgba(225, 225, 225, .3))  , url(<?php echo wp_get_attachment_image_url($backgroundId, 'large' ); ?>);">
			<!-- <ol class="carousel-indicators">
				<li data-target="#bake-reviw-slider" data-slide-to="0" class="active"></li>
				<li data-target="#bake-reviw-slider" data-slide-to="1"></li>
				<li data-target="#bake-reviw-slider" data-slide-to="2"></li>
			</ol> -->
			<div class="carousel-inner">

				<?php for($k=1;$k<=3;$k++): ?>

				<div class="carousel-item <?php if($k===1){echo('active');} ?>"  >
					<?php echo wp_get_attachment_image(( get_theme_mod('person_image'.$k) )); ?>
					<h3 class=""><?php echo get_theme_mod('name_setting'.$k ,'jone doe'  ); ?></h3>
					<p><?php echo get_theme_mod('testomonial_datails_setting'.$k ,'lorem to the serviese reviwo'  ); ?>
					</p>
				</div><!--carousel-item-->

				<?php endfor; ?>
				<a class="carousel-control-prev" href="#bake-reviw-slider" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#bake-reviw-slider" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			<!--carousel-inner-->

		</div>
		<!--carousel-->

	</section>
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<section class="front-section contact">
		<!-- contact us section -->
		<div class="content">
			<!-- <h2>contact us</h2> -->
			<?php get_template_part('template-parts/content' ,'contact'); ?>
		</div>
	</section>
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<section class=" front-section ">
		<div class="content">

			<div class="location-wrapper">
				<h2>visit us</h2>
				<div id="loaction"><span class="dashicons"></span>
					<span
						class="location-text"><?php echo get_theme_mod('location_text_setting' ,'lorem lorem reomr ela flfjelje fkewrj wlfjelkr wefekw'  ); ?></span>
				</div>
				<div class="map-container">
					<?php  echo get_theme_mod('location_ifram_setting'  ); ?>
				</div>
				<!--map-container-->
			</div>
			<!--location-wrapper-->


		</div>
		<!-- map section section -->

	</section>



</main><!-- #main -->

<?php

get_footer();