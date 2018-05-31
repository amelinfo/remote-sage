<?php

/**
 * Portfolio Loop
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$width 								= ( array_key_exists('width', $atts) ? $atts['width'] : wpb_fp_get_option( 'wpb_fp_image_width_', 'wpb_fp_advanced', 680 ) );
$height 							= ( array_key_exists('height', $atts) ? $atts['height'] : wpb_fp_get_option( 'wpb_fp_image_height_', 'wpb_fp_advanced', 680 ) );
$image_thumb 						= wpb_fp_resize( wp_get_attachment_url( get_post_thumbnail_id(), 'full' ), $width, $height, true, true, true ); //resize & crop the image
$alt 								= get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
$portfolio_permalink 				= get_post_meta( $post->ID, 'wpb_fp_portfolio_ex_link', true );
$wpb_fp_image_hard_crop 			= ( array_key_exists('img_hard_crop', $atts) ? $atts['img_hard_crop'] : wpb_fp_get_option( 'wpb_fp_image_hard_crop_', 'wpb_fp_advanced', 'yes' ) );
$wpb_fp_no_hard_crop_image_size 	= ( array_key_exists('img_no_hard_crop_size', $atts) ? $atts['img_no_hard_crop_size'] : wpb_fp_get_option( 'wpb_fp_no_hard_crop_image_size', 'wpb_fp_advanced', 'wpb_portfolio_thumbnail' ) );
$column 							= ( array_key_exists('column', $atts) ? $atts['column'] : wpb_fp_get_option( 'wpb_fp_column_', 'wpb_fp_general', 4 ) );
$filtering_script 					= ( array_key_exists('filtering_script', $atts) ? $atts['filtering_script'] : wpb_fp_get_option( 'wpb_fp_filtering_script', 'wpb_fp_advanced', 'mixitup' ) );
$portfolio_column 					= apply_filters( 'wpb_fp_portfolio_column_class', array( 'wpb_fp_col-md-'.$column, 'wpb_fp_col-sm-6', 'wpb_fp_col-xs-12' ) );
$taxonomy 							= wpb_fp_get_option( 'wpb_taxonomy_select_', 'wpb_fp_advanced', 'wpb_fp_portfolio_cat' );
$wpb_fp_popup_effect 				= wpb_fp_get_option( 'wpb_fp_popup_effect_', 'wpb_fp_style', 'mfp-zoom-in' );
$wpb_fp_link_full_grid_type 		= wpb_fp_get_option( 'wpb_fp_link_full_grid_type_', 'wpb_fp_advanced', 'details_page' );
$wpb_fp_single_portfolio_link 		= wpb_fp_get_option( 'wpb_fp_single_portfolio_link', 'wpb_fp_advanced', 'show' );
$categories_classes 				= wpb_fp_portfolio_categories( $taxonomy );
$item_classes 						= array( 'wpb-fp-item' );

$portfolio_link_target = $link_full_grid = '';

if( $filtering_script == 'mixitup' ){
	$item_classes[] = 'mix';
}

$item_classes 						= array_merge( $item_classes, $portfolio_column );
$item_classes 						= array_merge( $item_classes, $categories_classes );

if( $wpb_fp_image_hard_crop == 'yes' ){
	$feature_image 					= '<img src="'. esc_url( $image_thumb ) .'" alt="'. esc_html( $alt ) .'"/>';
}else{
	$feature_image 					= get_the_post_thumbnail( $post->ID, $wpb_fp_no_hard_crop_image_size );
}



if( $portfolio_permalink && $portfolio_permalink != '' ){
	$portfolio_permalink 			= $portfolio_permalink;
	$portfolio_link_target 			= 'target="_blank"';
}else{
	$portfolio_permalink 			= get_the_permalink();
}

// Link Image if overlay is eabled


if( $wpb_fp_link_full_grid_type == 'details_page' ){
	$link_full_grid 			= '<a '.$portfolio_link_target.' href="'. esc_url( $portfolio_permalink ) .'"><i class="fa fa-link" aria-hidden="true"></i></a>';
} elseif( $wpb_fp_link_full_grid_type == 'quickview_popup' ){
	$link_full_grid 			= '<a data-post-id="' . esc_attr( $post->ID ) . '" class="wpb_fp_preview open-popup-link" href="#" data-effect="'. esc_attr( $wpb_fp_popup_effect ) .'"><i class="fa fa-plus" aria-hidden="true"></i></a>';
}

?>

<div <?php post_class( $item_classes ) ?>>

	<div class="portfolio_item">

		<div class="portfolio_thumbnail">
			<?php echo $feature_image; ?>
			<div class="portfolio_overlay"></div>
			<div class="center-bar">
				<?php echo $link_full_grid; ?>
			</div>
		</div>

		<div class="portfolio_info">
			<a href="<?php echo esc_url( $portfolio_permalink ); ?>"><h3><?php the_title(); ?></h3></a>
			<span class="portfolio_category"><?php echo wpb_fp_portfolio_terms( $taxonomy, 3 ); ?></span>
		</div>

	</div>
</div>