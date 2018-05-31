<?php

/*
	WPB Filterable Portfolio
	By WPBean
	
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 




/* ==========================================================================
   Shortcode For this plugin
   ========================================================================== */


add_shortcode( 'wpb-portfolio','wpb_fp_shortcode_funcation' );	

if( !function_exists( 'wpb_fp_shortcode_funcation' ) ):
	function wpb_fp_shortcode_funcation( $atts ){
		extract(shortcode_atts(array(
			'orderby'				=> 'none', // portfolio orderby
			'order'					=> '', // portfolio order
		), $atts));
	   
		ob_start();

		echo do_shortcode( '[wpb-another-portfolio orderby="'.$orderby.'" order="'.$order.'"]' );

		return ob_get_clean();
	}
endif;



/* ==========================================================================
   Another Portfolio
   Added since V 1.06
   ========================================================================== */

add_shortcode( 'wpb-another-portfolio','wpb_fp_another_portfolio_shortcode_funcation' );

if( !function_exists('wpb_fp_another_portfolio_shortcode_funcation') ):
	function wpb_fp_another_portfolio_shortcode_funcation( $atts ){


		extract(shortcode_atts(array(
			'orderby'				=> 'date', // portfolio orderby
			'order'					=> 'DESC', // portfolio order
			'fp_category'			=> '', // comma separated cat id's
			'exclude_tax'			=> '', // comma separated cat id's
			'posts'					=> -1, // Number of post
			'pagination'			=> 'off',
			'filtering'				=> 'yes',
			'column' 				=> wpb_fp_get_option( 'wpb_fp_column_', 'wpb_fp_general', 4 ),
			'width' 				=> wpb_fp_get_option( 'wpb_fp_image_width_', 'wpb_fp_advanced', 680 ),
			'height' 				=> wpb_fp_get_option( 'wpb_fp_image_height_', 'wpb_fp_advanced', 680 ),
			'post_type' 			=> wpb_fp_get_option( 'wpb_post_type_select_', 'wpb_fp_advanced', 'wpb_fp_portfolio' ),
			'taxonomy' 				=> wpb_fp_get_option( 'wpb_taxonomy_select_', 'wpb_fp_advanced', 'wpb_fp_portfolio_cat' ),
			'wpb_fp_skin' 			=> wpb_fp_get_option( 'wpb_fp_skin', 'wpb_fp_style', 'img_bg_hover_effect' ),
			'img_hard_crop' 		=> wpb_fp_get_option( 'wpb_fp_image_hard_crop_', 'wpb_fp_advanced', 'yes' ),
			'img_no_hard_crop_size' => wpb_fp_get_option( 'wpb_fp_no_hard_crop_image_size', 'wpb_fp_advanced', 'wpb_portfolio_thumbnail' ),
			'filtering_script' 		=> wpb_fp_get_option( 'wpb_fp_filtering_script', 'wpb_fp_advanced', 'mixitup' ),

		), $atts));

		$rand_id 			= rand( 10,1000 );
		$wpb_fp_filtering 	= wpb_fp_get_option( 'wpb_fp_filtering', 'wpb_fp_advanced', 'enable' );

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$args = array(
			'post_type' 		=> $post_type,
			'posts_per_page'	=> $posts,
			'orderby' 			=> $orderby,
			'order' 			=> $order,
			'paged' 			=> $paged,
			'meta_query' 		=> array( array('key' => '_thumbnail_id') ),
		);

		// Exclude selected categories form portfolio.
		
		if( $exclude_tax && $exclude_tax != '' ){
			$exclude_tax = explode(',', $exclude_tax);
			$args['tax_query'][] = array(
				'taxonomy' 	=> $taxonomy,
		        'field'    	=> 'id',
				'terms'    	=> $exclude_tax,
		        'operator' 	=> 'NOT IN' 
			);
		}

		// only selected categories
		if( $fp_category && $fp_category != '' ){
			$fp_category = explode(',', $fp_category);
			$args['tax_query'][] = array(
				'taxonomy' 	=> $taxonomy,
		        'field'    	=> 'id',
				'terms'    	=> $fp_category,
		        'operator' 	=> 'IN' 
			);
		}

		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			$output = '<div class="wpb_portfolio_area wpb_category_portfolio wpb_portfolio_area_'.$filtering_script.'" data-mix="#wpb_portfolio_'.$rand_id.'">';

			if( $wpb_fp_filtering == 'enable' && $filtering == 'yes' ){
				ob_start();
				wpb_fp_portfolio_filter( $taxonomy, $exclude_tax, $fp_category );
				$output .= ob_get_clean();
			}

			$output .= '<div class="wpb_portfolio wpb_fp_row wpb_fp_grid '. esc_attr( $wpb_fp_skin ) .'" id="wpb_portfolio_'.$rand_id.'">';

			while ( $loop->have_posts() ) : $loop->the_post();
				ob_start();


				wpb_fp_get_template( 'portfolio-loop-'.$wpb_fp_skin.'.php', array( 'atts' => $atts ) );


				$output .= ob_get_clean();
			endwhile;

			$output .= '</div><!-- wpb_portfolio -->';
			$output .= '</div><!-- wpb_portfolio_area -->';

			if ( function_exists('wpb_fp_pagination') && $pagination == 'on' ) {
				$output .=	wpb_fp_pagination( $loop->max_num_pages, "", $paged );
			}

			$output .= do_action('wpb_fp_after_portfolio');

			wp_reset_postdata();

		} else {
			$output = __( 'No portfolio found.', WPB_FP_TEXTDOMAIN );
		}

		wpb_fp_get_scripts($atts);	

		return $output;

	}
endif;