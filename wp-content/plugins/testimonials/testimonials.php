<?php
/*
  Plugin Name: Testimonials
  Description: Testimonials is a WordPress plugin that allows you to manage and display testimonials for your blog, product or service. It can be used to build your Testimonial or to encourage readers to subscribe / buy your products.
  Author: Techlab TN
  Author URI: http://www.techlab.tn/
  Version: 9.9.9
*/
  
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************

define('TP_PLUGIN_URL', plugins_url() . '/testimonials');
if( ! current_theme_supports('post-thumbnails') )
  add_theme_support( 'post-thumbnails' );
add_image_size('tm-thumb', 100, 100, true);
require_once 'cpt.php';  

add_shortcode('testimonials', 'getTestimonials');
add_shortcode('sliding_testimonials', 'slidingTestimonials');
function getTestimonials($atts){
   $defaults = array(
                      'view'    => 'list',
                      'style'   => 'one',
                      'columns' => 3,
                      'limit'   => 10,
                      'thumb'   => 'medium',
                      'post_id' => '',
                      'orderby' => 'date',
                      'order'   => 'DESC'
                    );
                    
   extract( shortcode_atts($defaults,$atts) );
   // Fix for the WordPress 3.0 "paged" bug.
  $paged = 1;
  if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
  if ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
  $paged = intval( $paged );
   $args = array('post_type' => 'testimonial', 'posts_per_page' => $limit, 'orderby' => $orderby, 'order' => $order, 'paged' => $paged);
   if( $post_id != '') { $args['post__in'] = extract(",", $post_id );}
   
   $tm = "";
   $testimonials = new WP_Query($args);
   if( $testimonials->have_posts() ):  
 
     if($view == 'list'){
		switch($style) {
			case "one" :
			include_once "view/list-one.php";
			break;
			case "two" :
			include_once "view/list-two.php";
			break;	
			case "three" :
			include_once "view/list-three.php";
			break;		  
		}  
     }
   endif;
   
   $tm .= tm_pagination($testimonials);
   wp_reset_query();
      
   return $tm;
}
function slidingTestimonials($atts){
   $defaults = array(
                      'view'    => 'list',
                      'style'   => 'one',
                      'columns' => 3,
                      'limit'   => 10,
                      'thumb'   => 'medium',
                      'post_id' => '',
                      'orderby' => 'date',
                      'order'   => 'DESC',
                      'autoslide' => true,
                      'animation' => "fade",
                      'pauseOnHover' => false,
                      'directional_nav' => true,
                      'slideshowSpeed' => 7000,
                      'animationSpeed' => 600
                    );
                    
   extract( shortcode_atts($defaults,$atts) );
   $args = array('post_type' => 'testimonial', 'posts_per_page' => $limit, 'orderby' => $orderby, 'order' => $order);
   if( $post_id != '') { $args['post__in'] = extract(",", $post_id );}
   
   $tm = "";
   $testimonials = new WP_Query($args);
   if( $testimonials->have_posts() ):
	  switch($style) {
		  case "one" :
		  include_once "view/slider/slider-one.php";
		  break;
		  case "two" :
		  include_once "view/slider/slider-two.php";
		  break;	
		  case "three" :
		  include_once "view/slider/slider-three.php";
		  break;		  
		  case "four" :
		  include_once "view/slider/slider-four.php";
		  break;		
	  }
		
   endif;       
   wp_reset_postdata();   
   return $tm;     
}

// Adding Testimonials CSS & JS file
add_action( 'wp_enqueue_scripts', 'testimonials_scripts' );
function testimonials_scripts(){
  wp_register_style( 'testimonials-css', plugins_url( 'css/testimonials.css', __FILE__ ), array(), '3.0', 'all' );
  wp_enqueue_style( 'testimonials-css' );
  wp_register_style( 'flexslider-css', plugins_url( 'css/flexslider.css', __FILE__ ), array(), '3.0', 'all' );
  wp_enqueue_style( 'flexslider-css' );
  wp_enqueue_script( 'flexslider', plugins_url( 'js/jquery.flexslider-min.js', __FILE__ ), array( 'jquery' ), '20131205', true );   
  wp_enqueue_script( 'flexslider-manualDirectionControls', plugins_url( 'js/jquery.flexslider.manualDirectionControls.js', __FILE__ ), array( 'jquery' ), '20131205', true );
}

add_filter('widget_text', 'do_shortcode');

if ( ! function_exists( 'tm_pagination' ) ) {
	function tm_pagination( $query = '', $args = array()) {
		global $wp_rewrite, $wp_query;

		if ( $query ) {
			$wp_query = $query;
		} // End IF Statement
    
		/* If there's not more than one page, return nothing. */
		if ( 1 >= $wp_query->max_num_pages )
			return;

		/* Get the current page. */
		$current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

		/* Get the max number of pages. */
		$max_num_pages = intval( $wp_query->max_num_pages );

		/* Set up some default arguments for the paginate_links() function. */
		$defaults = array(
			'base' => add_query_arg( 'paged', '%#%' ),
			'format' => '',
			'total' => $max_num_pages,
			'current' => $current,
			'prev_next' => true,
			'prev_text' => __( '&larr; Previous', 'tm' ), // Translate in WordPress. This is the default.
			'next_text' => __( 'Next &rarr;', 'tm' ), // Translate in WordPress. This is the default.
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => 1,
			'add_fragment' => '',
			'type' => 'plain',
			'before' => '<div class="pagination tm-pagination">', // Begin tm_pagination() arguments.
			'after' => '</div>',
			'echo' => false, 
			'use_search_permastruct' => false
		);

		/* Allow themes/plugins to filter the default arguments. */
		$defaults = apply_filters( 'tm_pagination_args_defaults', $defaults );

		/* Add the $base argument to the array if the user is using permalinks. */
		if( $wp_rewrite->using_permalinks() && ! is_search() )
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

		/* Merge the arguments input with the defaults. */
		$args = wp_parse_args( $args, $defaults );

		/* Allow developers to overwrite the arguments with a filter. */
		$args = apply_filters( 'tm_pagination_args', $args );

		/* Don't allow the user to set this to an array. */
		if ( 'array' == $args['type'] )
			$args['type'] = 'plain';

		/* Make sure raw querystrings are displayed at the end of the URL, if using pretty permalinks. */
		$pattern = '/\?(.*?)\//i';

		preg_match( $pattern, $args['base'], $raw_querystring );

		if( $wp_rewrite->using_permalinks() && $raw_querystring )
			$raw_querystring[0] = str_replace( '', '', $raw_querystring[0] );
			@$args['base'] = str_replace( $raw_querystring[0], '', $args['base'] );
			@$args['base'] .= substr( $raw_querystring[0], 0, -1 );
		
		/* Get the paginated links. */
		$page_links = paginate_links( $args );

		/* Remove 'page/1' from the entire output since it's not needed. */
		$page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

		/* Wrap the paginated links with the $before and $after elements. */
		$page_links = $args['before'] . $page_links . $args['after'];

		/* Allow devs to completely overwrite the output. */
		$page_links = apply_filters( 'tm_pagination', $page_links );

		/* Return the paginated links for use in themes. */
		if ( $args['echo'] )
			echo $page_links;
		else
			return $page_links;
	} // End tm_pagination()
} // End IF Statement


class MySettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_submenu_page_to_post_type' ) );
		add_action( 'admin_init', array( $this, 'sub_menu_page_init' ) );
		//add_action( 'admin_init', array( $this, 'media_selector_scripts' ) );
	}
	
	/**
	 * Add sub menu page to the custom post type
	 */
	public function add_submenu_page_to_post_type()
	{
		add_submenu_page(
			'edit.php?post_type=testimonial',
			__('Testimonials Options', 'tp'),
			__('Testimonial Options', 'tp'),
			'manage_options',
			'testimonials_settings',
			array($this, 'testimonial_view_display'));
	}
	
	/**
	 * Register and add settings
	 */
	public function sub_menu_page_init()
	{
		register_setting( 'testimonials_settings','testimonial_view' );
		register_setting( 'testimonials_settings', 'testimonial_list_style' );
		register_setting( 'testimonials_settings', 'testimonial_slider_style' );
		register_setting( 'testimonials_settings', 'testimonial_order' );
		register_setting( 'testimonials_settings', 'testimonial_orderby');
		register_setting( 'testimonials_settings', 'testimonial_bgr');
		register_setting( 'testimonials_settings', 'testimonial_thumb');
		register_setting( 'testimonials_settings', 'testimonial_limit');
		register_setting( 'testimonials_settings', 'slide_show_speed');
		register_setting( 'testimonials_settings', 'animation_type');
		register_setting( 'testimonials_settings', 'animation_speed');
		register_setting( 'testimonials_settings', 'auto_slide');		
	}
	
	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input )
	{
		$new_input = array();
	
		if( isset( $input['testimonial_description'] ) )
			$new_input['testimonial_description'] = sanitize_text_field( $input['testimonial_description'] );
	
		if( isset( $input['image_attachment_id'] ) )
			$new_input['image_attachment_id'] = absint( $input['image_attachment_id'] );
	
		return $new_input;
	}
	

		/**
	 * Options page callback
	 */
	public function testimonial_view_display()
	{
		//wp_enqueue_media();

		?>
	<div class="wrap">
      <form action="options.php" method="post">
			<h1> Testimonial Options</h1>
			<br/>
        <?php
          settings_fields( 'testimonials_settings' );
          do_settings_sections( 'testimonials_settings' );
        ?>
        <table> 
            <tr class="testimonial-type">
                <th>Testimonial Type</th>
                <td>
                    <label>
                        <input type="radio" name="testimonial_view" value="list" <?php echo esc_attr( get_option('testimonial_view') ) == 'list' ? 'checked="checked"' : ''; ?> /> List <br/>
                    </label>
                    <label>
                        <input type="radio" name="testimonial_view" value="slider" <?php echo esc_attr( get_option('testimonial_view') ) == 'slider' ? 'checked="checked"' : ''; ?> /> Slider
                    </label>
                </td>
			</tr>
			<tr valign="top">
				<th scope="row">Background Color</th>
				<td><input type="text" name="testimonial_bgr" value="<?php echo esc_attr( get_option('testimonial_bgr') ); ?>" /></td>
			</tr>
        
			<tr>
                <th>Order</th>
                <td>
				<select name="testimonial_order">
					<option value="">&mdash; select &mdash;</option>
                    <option value="DESC" <?php echo esc_attr( get_option('testimonial_order') ) == 'DESC' ? 'selected="selected"' : ''; ?>>Descending</option>
                    <option value="ASC" <?php echo esc_attr( get_option('testimonial_order') ) == 'ASC' ? 'selected="selected"' : ''; ?>>Ascending</option>
				</select>
	           </td>
			<!-- </tr>
			<tr> -->
                <th>OrderBy</th>
                <td>
				<select name="testimonial_orderby">
                        <option value="">&mdash; select &mdash;</option>
                        <option value="date" <?php echo esc_attr( get_option('testimonial_orderby') ) == 'date' ? 'selected="selected"' : ''; ?>>Date</option>
                        <option value="rand" <?php echo esc_attr( get_option('testimonial_orderby') ) == 'rand' ? 'selected="selected"' : ''; ?>>Random</option>
						<option value="ID" <?php echo esc_attr( get_option('testimonial_orderby') ) == 'ID' ? 'selected="selected"' : ''; ?>>ID</option>
						<option value="title" <?php echo esc_attr( get_option('testimonial_orderby') ) == 'title' ? 'selected="selected"' : ''; ?>>Title</option>
                    </select>
                </td>
			</tr>
			<tr>
                <th>Thumb Size</th>
                <td>
				<select name="testimonial_thumb">
                        <option value="">&mdash; select &mdash;</option>
                        <option value="small" <?php echo esc_attr( get_option('testimonial_thumb') ) == 'small' ? 'selected="selected"' : ''; ?>>Small</option>
                        <option value="medium" <?php echo esc_attr( get_option('testimonial_thumb') ) == 'medium' ? 'selected="selected"' : ''; ?>>Medium</option>
						<option value="large" <?php echo esc_attr( get_option('testimonial_thumb') ) == 'large' ? 'selected="selected"' : ''; ?>>Large</option>
                    </select>
                </td>
			<!-- </tr>
			<tr> -->
                <th>Limit</th>
                <td>
				<input type="number" name="testimonial_limit" value="-1" min="-1"><br/>
                </td>
			</tr>
			
			<tr class="list-row">
                <th>List Style</th>
                <td>
                    <select name="testimonial_list_style">
                        <option value="">&mdash; select &mdash;</option>
                        <option value="one" <?php echo esc_attr( get_option('testimonial_list_style') ) == 'one' ? 'selected="selected"' : ''; ?>>Style One</option>
                        <option value="two" <?php echo esc_attr( get_option('testimonial_list_style') ) == 'two' ? 'selected="selected"' : ''; ?>>Style Two</option>
                        <option value="three" <?php echo esc_attr( get_option('testimonial_list_style') ) == 'three' ? 'selected="selected"' : ''; ?>>Style Three</option>
                    </select> 
                </td>
            </tr>
			<tr class="slider-row">
                <th>Slider Style</th>
                <td>
                    <select name="testimonial_slider_style">
                        <option value="">&mdash; select &mdash;</option>
                        <option value="one" <?php echo esc_attr( get_option('testimonial_slider_style') ) == 'one' ? 'selected="selected"' : ''; ?>>Style One</option>
                        <option value="two" <?php echo esc_attr( get_option('testimonial_slider_style') ) == 'two' ? 'selected="selected"' : ''; ?>>Style Two</option>
						<option value="three" <?php echo esc_attr( get_option('testimonial_slider_style') ) == 'three' ? 'selected="selected"' : ''; ?>>Style Three</option>
						<option value="four" <?php echo esc_attr( get_option('testimonial_slider_style') ) == 'four' ? 'selected="selected"' : ''; ?>>Style four</option>
                    </select>
                </td>
			</tr>
			<tr class="slider-row">
				<th>Auto-slide </th>
				<td><input name="auto_slide" type="checkbox" value="1" <?php checked( '1', get_option( 'auto_slide' ) ); ?> />
					<!-- <input type="checkbox" class="radio" value="1" name="auto_slide" /> -->
				</td>
			</tr>
			<tr class="slider-row">
				<th>Slide Show Speed</th>
				<td>
					<select name="slide_show_speed">
                        <option value="">&mdash; select &mdash;</option>
                        <option value="1000" <?php echo esc_attr( get_option('slide_show_speed') ) == '1000' ? 'selected="selected"' : ''; ?>>1000</option>
                        <option value="2000" <?php echo esc_attr( get_option('slide_show_speed') ) == '2000' ? 'selected="selected"' : ''; ?>>2000</option>
						<option value="3000" <?php echo esc_attr( get_option('slide_show_speed') ) == '3000' ? 'selected="selected"' : ''; ?>>3000</option>
						<option value="4000" <?php echo esc_attr( get_option('slide_show_speed') ) == '4000' ? 'selected="selected"' : ''; ?>>4000</option>
						<option value="5000" <?php echo esc_attr( get_option('slide_show_speed') ) == '5000' ? 'selected="selected"' : ''; ?>>5000</option>
						<option value="6000" <?php echo esc_attr( get_option('slide_show_speed') ) == '3000' ? 'selected="selected"' : ''; ?>>6000</option>
						<option value="7000" <?php echo esc_attr( get_option('slide_show_speed') ) == '3000' ? 'selected="selected"' : ''; ?>>7000</option>
                    </select>					
				</td>
			</tr>
			<tr class="slider-row">
				<th>Animation Type</th>
				<td>
					<select name="animation_type">
						<option value="">&mdash; select &mdash;</option>
						<option value="fade" <?php echo esc_attr( get_option('animation_type') ) == 'fade' ? 'selected="selected"' : ''; ?>>Fade</option>
						<option value="slide" <?php echo esc_attr( get_option('animation_type') ) == 'slide' ? 'selected="selected"' : ''; ?>>Slide</option>
					</select>
				</td>
			</tr>
			<tr class="slider-row">
				<th>Animation Speed</th>
				<td>
					<select name="animation_speed">
                        <option value="">&mdash; select &mdash;</option>
                        <option value="200" <?php echo esc_attr( get_option('animation_speed') ) == '200' ? 'selected="selected"' : ''; ?>>200</option>
                        <option value="300" <?php echo esc_attr( get_option('animation_speed') ) == '300' ? 'selected="selected"' : ''; ?>>300</option>
						<option value="400" <?php echo esc_attr( get_option('animation_speed') ) == '400' ? 'selected="selected"' : ''; ?>>400</option>
						<option value="500" <?php echo esc_attr( get_option('animation_speed') ) == '500' ? 'selected="selected"' : ''; ?>>500</option>
						<option value="600" <?php echo esc_attr( get_option('animation_speed') ) == '600' ? 'selected="selected"' : ''; ?>>600</option>
						<option value="700" <?php echo esc_attr( get_option('animation_speed') ) == '700' ? 'selected="selected"' : ''; ?>>700</option>
						<option value="800" <?php echo esc_attr( get_option('animation_speed') ) == '800' ? 'selected="selected"' : ''; ?>>800</option>
                    </select>					
				</td>
			</tr>
            <tr>
                <td><?php submit_button(); ?></td>
            </tr>
 
        </table>
 
      </form>
	</div>
	<style>
		tr.list-row,
		tr.slider-row {
		display: none;
		}

		tr.list-row.active,
		tr.slider-row.active {
		display: contents !important;
		}
	
	</style>
	<script>

	// jQuery(function(){
   if(jQuery( 'input[name="testimonial_view"]:checked' ).val() === 'list'){
	  jQuery("tr.list-row").addClass("active");
   }else{
	jQuery("tr.slider-row").addClass("active");
   }

  jQuery(".testimonial-type").on("change", function(){
	  var value= jQuery( 'input[name="testimonial_view"]:checked' ).val();
	  if(value === 'list'){
		//remove active
		jQuery("tr.slider-row.active").removeClass("active");
		//check if select vlass exists..if it does show it
		jQuery("tr.list-row").addClass("active");
	  }
	  else{
		//remove active
		jQuery("tr.list-row.active").removeClass("active");
		//check if select vlass exists..if it does show it
		jQuery("tr.slider-row").addClass("active");
	  }

  });
  
// });
	</script>
  <?php
	}
	
}

if( is_admin() )
    $my_settings_page = new MySettingsPage();