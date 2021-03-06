<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bake
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-feed'); ?>>


	<?php baketheme_post_thumbnail(); ?>
	<div class="feed-text">

	
			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
		?>
			</header><!-- .entry-header -->
			<div class="entry-content">
				<?php
				the_excerpt(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'baketheme' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);


				?>
			</div><!-- .entry-content -->
	</div><!--feed-text-->
</article><!-- #post-<?php the_ID(); ?> -->
