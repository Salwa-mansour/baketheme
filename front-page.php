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
							<a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>">shop catigury</a>
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
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<section class=" front-section">
		best selling products section
		<div class="content">

		</div>
	</section>
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
					
					<p><?php echo(get_theme_mod('feature_description_setting'.$i ,'Lorem ipsum dolor sit amet consectetur.'))  ?></p>
				</div><!--feature--->
			<?php endfor; ?>
		</div>
		<!--features wrapper-->
			
			
		</div>
		
	</section>
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<section class=" front-section">
		user reviue section
		<div class="content">

		</div>

	</section>
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<section class="front-section">
		<!-- contact us section -->
			<div class="content">

			</div>
	</section>
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<section class=" front-section">
				<div class="content">
					
				</div>
		<!-- map section section -->
	
	</section>



</main><!-- #main -->

<?php

get_footer();