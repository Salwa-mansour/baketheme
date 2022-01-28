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
			'default'     			   => 'Default title ',
			'sanitize_callback'        =>'wp_filter_nohtml_kses'
			));
			$wp_customize->add_control('title_setting'.$i, array(
			'label'   => 'title for feature '.$i,
			'section' => 'site_features_section',
			'type'    => 'text',
			'priority' => $i.'0',
			));
			//adding setting 
			$wp_customize->add_setting('feature_description_setting'.$i, array(
			'default'       		 => 'defualt feature descripion ',
			'sanitize_callback'      =>'wp_filter_nohtml_kses',
			'priority'				 => $i.'0',
			));
			$wp_customize->add_control('feature_description_setting'.$i, array(
			'label'   => 'description for feature '.$i,
			'section' => 'site_features_section',
			'type'    => 'textarea',
			'priority' => $i.'0',
			));
	endfor;
			
}
// /////////////////
function testomonials_images_settings($wp_customize,$k=3){

	for($i=1;$i<=$k;$i++):
			//adding setting 
			$wp_customize->add_setting('person_image'.$i, array(
				'default' => '',
				'type' => 'theme_mod',
				'sanitize_callback' => 'my_customize_sanitize_feature_image',
			));

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize, 'my_person_image'.$i, array(
						'label'    => 'person Image '.$i,
						'settings' => 'person_image'.$i,
						'section'  => 'site_testomonials_section',
						'priority' => $i.'0',
					)
				)
			);
			//adding setting 
			$wp_customize->add_setting('name_setting'.$i, array(
			'default'     			   => 'Default name ',
			'sanitize_callback'        =>'wp_filter_nohtml_kses'
			));
			$wp_customize->add_control('name_setting'.$i, array(
			'label'   => 'person name  '.$i,
			'section' => 'site_testomonials_section',
			'type'    => 'text',
			'priority' => $i.'0',
			));
			//adding setting 
			$wp_customize->add_setting('testomonial_datails_setting'.$i, array(
			'default'       		 => 'what person seys ',
			'sanitize_callback'      =>'wp_filter_nohtml_kses',
			'priority'				 => $i.'0',
			));
			$wp_customize->add_control('testomonial_datails_setting'.$i, array(
			'label'   => 'what person says '.$i,
			'section' => 'site_testomonials_section',
			'type'    => 'textarea',
			'priority' => $i.'0',
			));
	endfor;
			
}
// /----------------------------------------------
function baketheme_customize_title1_setting( $wp_customize ) {
	//All our sections, settings, and controls will be added here

 	// fornt page features   --------- 
		$wp_customize->add_section('site_features_section', array(
		'title'          => 'Frontpage Features Section'
		));
			feature_images_settings($wp_customize);

 	// fornt page testomonials   --------- 
		$wp_customize->add_section('site_testomonials_section', array(
		'title'          => 'Frontpage testomonials Section'
		));
				//adding setting 
				$wp_customize->add_setting('t_background_image', array(
					'default' => '',
					'type' => 'theme_mod',
					'sanitize_callback' => 'my_customize_sanitize_feature_image',
				));

				$wp_customize->add_control(
					new WP_Customize_Image_Control(
						$wp_customize, 'testomonial_background_image', array(
							'label'    => 'testmonials background Image ',
							'settings' => 't_background_image',
							'section'  => 'site_testomonials_section',
							'priority' => '0',
						)
					)
				);
				testomonials_images_settings($wp_customize);

		//visit us section-----------------------
			$wp_customize->add_section('visit_us_details_section', array(
				'title'          => 'visit us details'
				));
				//adding setting 
				$wp_customize->add_setting('location_text_setting', array(
					'default'              => 'lorem',
					'sanitize_callback'    =>'wp_filter_nohtml_kses'
					));
					$wp_customize->add_control('location_text_setting', array(
					'label'   => 'location details',
					'section' => 'visit_us_details_section',
					'type'    => 'text',
					'priority' => 10,
					));
				//adding setting 
				$wp_customize->add_setting('location_ifram_setting', array(
					'default'        => '',
					'type' => 'theme_mod',
					'sanitize_callback' => 'wp_kses'
					));
					$wp_customize->add_control('location_ifram_setting', array(
					'label'   => 'map embed link',
					'section' => 'visit_us_details_section',
					'type'    => 'textarea',
					'priority' => 20,
					));
		// --------footer section------------------

		$wp_customize->add_section('contact_footer_section', array(
			'title'          => 'contact footer Section'
			));
			//adding setting 
			$wp_customize->add_setting('telephone_setting', array(
				'default'                => '0645556',
				'sanitize_callback'      =>'absint' //converts value to a non-negative integer
				));
				$wp_customize->add_control('telephone_setting', array(
				'label'   => 'telephone number',
				'section' => 'contact_footer_section',
				'type'    => 'phone',
				'priority' => 10,
				));
			//adding setting 
			$wp_customize->add_setting('cellphone_setting', array(
				'default'               => '7777777777',
				'sanitize_callback'     =>'absint'
				));
				$wp_customize->add_control('cellphone_setting', array(
				'label'   => 'cellphone number',
				'section' => 'contact_footer_section',
				'type'    => 'phone',
				'priority' => 20,
				));
			//adding setting 
			$wp_customize->add_setting('email_setting', array(
				'default'        => 'bake@gmai.com',
				'sanitize_callback' => 'sanitize_email'
				));
				$wp_customize->add_control('email_setting', array(
				'label'   => 'email ',
				'section' => 'contact_footer_section',
				'type'    => 'mail',
				'priority' => 30,
				));

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



// ---------------allow iframe--------
add_filter( 'wp_kses_allowed_html', 'esw_author_cap_filter',1,1 );

function esw_author_cap_filter( $allowedposttags ) {

//Here put your conditions, depending your context

if ( !current_user_can( 'publish_posts' ) )
return $allowedposttags;

// Here add tags and attributes you want to allow

$allowedposttags['iframe']=array(

'align' => false,
// 'width' => false,
// 'height' => false,
'frameborder' => true,
'name' => true,
'src' => true,
'id' => true,
'class' => true,
'style' => true,
'scrolling' => true,
'marginwidth' => true,
'marginheight' => true,
'allowfullscreen' => true, 
'mozallowfullscreen' => true, 
'webkitallowfullscreen' => true,


);
return $allowedposttags;

}