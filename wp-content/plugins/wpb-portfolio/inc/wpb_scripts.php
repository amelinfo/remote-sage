<?php

/*
	WPB Filterable Portfolio
	By WPBean
	
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 



/**
 * register scripts
 */

function wpb_fp_registering_scripts() {

	wp_register_script('wpb-fp-mixitup', plugins_url('../assets/js/jquery.mixitup.min.js', __FILE__), array('jquery'), '2.1.6', false);
	wp_register_script('wpb-fp-imagesloaded', plugins_url('../assets/js/imagesloaded.pkgd.min.js', __FILE__), array('jquery'), '4.1.4', false);
	wp_register_script('wpb-fp-isotope', plugins_url('../assets/js/isotope.pkgd.min.js', __FILE__), array('jquery'), '3.0.5', false);
	wp_register_script('wpb-fp-tooltipster', plugins_url('../assets/js/jquery.tooltipster.min.js', __FILE__), array('jquery'),'3.3.0', false);
	wp_register_script('wpb-fp-magnific-popup', plugins_url('../assets/js/jquery.magnific-popup.min.js', __FILE__) ,array('jquery'),'1.0', false);	
	wp_register_script('wpb-fp-main-js', plugins_url('../assets/js/main.js', __FILE__) ,array('jquery'),'1.0', false);

	wp_register_style('wpb-fp-bootstrap-grid', plugins_url('../assets/css/wpb-custom-bootstrap.css', __FILE__), '', '3.2');
	wp_register_style('wpb-fp-tooltipster', plugins_url('../assets/css/tooltipster.css', __FILE__), '', '3.3.0');
	wp_register_style('wpb-fp-font-awesome', plugins_url('../assets/css/font-awesome.min.css', __FILE__), '', '4.2.0');	
	wp_register_style('wpb-fp-magnific-popup', plugins_url('../assets/css/magnific-popup.css', __FILE__), '', '1.0');
	wp_register_style('wpb-fp-hover-effects', plugins_url('../assets/css/hover-effects.css', __FILE__), '', '1.0');
	wp_register_style('wpb-fp-main', plugins_url('../assets/css/main.css', __FILE__), '', '1.0');


	wp_register_script( "wpb_fp_ajax", plugins_url('../assets/js/wpb_fp_ajax.js', __FILE__), array('jquery'), '1.0', true );
	wp_localize_script( 'wpb_fp_ajax', 'wpb_fp_ajax_name', array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );

	wp_add_inline_style( 'wpb-fp-main', wpb_fp_get_option( 'wpb_fp_custom_css_', 'wpb_fp_style', '' ) );
}
add_action( 'wp_enqueue_scripts', 'wpb_fp_registering_scripts', 20 ); 



/**
 * enqueue scripts 
 */

function wpb_fp_get_scripts( $atts ){
	$wpb_fp_show_counting 	= wpb_fp_get_option( 'wpb_fp_show_counting_', 'wpb_fp_general', 'show' );
	$load_magnific_popup 	= wpb_fp_get_option( 'wpb_fp_load_magnific_popup', 'wpb_fp_style', 'off' );
	$load_fa_icon 			= wpb_fp_get_option( 'wpb_fp_load_fa_icon', 'wpb_fp_style', 'off' );
	$wpb_fp_skin 			= ( array_key_exists('wpb_fp_skin', $atts) ? $atts['wpb_fp_skin'] : 'img_bg_hover_effect' );
	$filtering_script 		= ( array_key_exists('filtering_script', $atts) ? $atts['filtering_script'] : 'mixitup' );


	if( $filtering_script == 'mixitup' ){
		wp_enqueue_script('wpb-fp-mixitup');
	}elseif( $filtering_script == 'isotope' ){
		wp_enqueue_script('wpb-fp-imagesloaded');
		wp_enqueue_script('wpb-fp-isotope');
	}

	wp_enqueue_script('wpb-fp-main-js');
	wp_enqueue_style('wpb-fp-bootstrap-grid');

	if( isset($wpb_fp_show_counting) && $wpb_fp_show_counting == 'show' ){
		wp_enqueue_style('wpb-fp-tooltipster');
		wp_enqueue_script('wpb-fp-tooltipster');
	}
	if( isset($load_fa_icon) && $load_fa_icon == 'off' ){
		wp_enqueue_style('wpb-fp-font-awesome');
	}
	
	if( $wpb_fp_skin == 'img_bg_hover_effect' ){

		wp_enqueue_style('wpb-fp-hover-effects');
		wp_enqueue_script('wpb-fp-lightslider-js');
		wp_enqueue_style('wpb-fp-lightslider');

		if( isset($load_magnific_popup) && $load_magnific_popup == 'off' ){
			wp_enqueue_style('wpb-fp-magnific-popup');
			wp_enqueue_script('wpb-fp-magnific-popup');
		}
	}

	wp_enqueue_script( 'wpb_fp_ajax' );
	wp_enqueue_style('wpb-fp-main');
	wp_enqueue_style( 'js_composer_front' );
}


/**
 * Portfolio Single Scripts
 */

function wpb_fp_get_scripts_single_portfolio(){
	wp_enqueue_script('wpb-fp-main-js');
	wp_enqueue_style('wpb-fp-bootstrap-grid');
	wp_enqueue_style('wpb-fp-main');
	wp_enqueue_style( 'js_composer_front' );
}