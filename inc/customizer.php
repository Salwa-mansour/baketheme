<?php
/**
 * bake Theme Customizer
 *
 * @package bake
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function baketheme_customize_register( $wp_customize ) { 
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'baketheme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'baketheme_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'baketheme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function baketheme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function baketheme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function baketheme_customize_preview_js() {
	wp_enqueue_script( 'baketheme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'baketheme_customize_preview_js' );

// /////////////////
function feature_images_settings($wp_customize,$k=4){

	for($i=1;$i<=$k;$i++):
			//adding setting 
			$wp_customize->add_setting('feature_image'.$i, array(
				'default' => '',
				'type' => 'theme_mod',
				'sanitize_callback' => 'my_customize_sanitize_feature_image',
			));

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize, 'my_feature_image'.$i, array(
						'label'    => 'feature Image '.$i,
						'settings' => 'feature_image'.$i,
						'section'  => 'site_features_section',
						'priority' => $i.'0',
					)
				)
			);
			//adding setting 
			$wp_customize->add_setting('title_setting'.$i, array(
			'default'        => 'Default title ',
			));
			$wp_customize->add_control('title_setting'.$i, array(
			'label'   => 'title for feature '.$i,
			'section' => 'site_features_section',
			'type'    => 'text',
			'priority' => $i.'0',
			));
			//adding setting 
			$wp_customize->add_setting('feature_description_setting'.$i, array(
			'default'        => 'defualt feature descripion ',
			'priority' => $i.'0',
			));
			$wp_customize->add_control('feature_description_setting'.$i, array(
			'label'   => 'description for feature '.$i,
			'section' => 'site_features_section',
			'type'    => 'textarea',
			'priority' => $i.'0',
			));
	endfor;
			
}
// /----------------------------------------------
function baketheme_customize_title1_setting( $wp_customize ) {
	//All our sections, settings, and controls will be added here
 //adding fornt page features section in wordpress customizer   
		$wp_customize->add_section('site_features_section', array(
		'title'          => 'Frontpage Features Section'
		));
		feature_images_settings($wp_customize);
 }
//  -----------------------------------
 add_action( 'customize_register', 'feature_images_settings' , 8);
 add_action( 'customize_register', 'baketheme_customize_title1_setting' );
 /**
 * Sanitize feature image
 *
 * @param $input
 *
 * @return string
 */
function my_customize_sanitize_feature_image($input)
{
    error_log(attachment_url_to_postid($input));//debug
    return attachment_url_to_postid($input);
}
