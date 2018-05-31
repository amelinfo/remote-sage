<?php 
/**
*Plugin Name: WPB Filterable Portfolio
*Plugin URI: https://wpbean.com/product/wpb-filterable-portfolio
*Description: Filterable portfolio Wordpress plugin. Shortcode [wpb-portfolio]
*Author: WpBean
*Version: 2.2.3.8
*Author URI: https://wpbean.com
*text-domain: wpb_fp
*/

/**
 * WpBean Plugin updater init
 * Warning!!!! 
 * Do not make any change in the code bellow. It will process the plugin auto update.
 */

define( 'WPB_FP_VERSION', '2.2.3.8' );
define( 'WPB_FP_STORE_URL', 'https://wpbean.com' );
define( 'WPB_FP_ITEM_NAME', 'WPB Filterable Portfolio' );
define( 'WPB_FP_PLUGIN_LICENSE_PAGE', 'wpb-filterable-portfolio-license' );

function wpb_fp_plugin_updater_init() {

	$license_key = trim( get_option( 'wpb_fp_license_key' ) );

	$edd_updater = new WpBean_Plugin_Updater( WPB_FP_STORE_URL, __FILE__, array(
			'version'   => WPB_FP_VERSION,
			'license'   => $license_key,
			'item_name' => WPB_FP_ITEM_NAME,
			'author'    => 'WpBean',
			'url'       => home_url()
		)
	);

}
add_action( 'admin_init', 'wpb_fp_plugin_updater_init', 0 );



/**
 * Define Path 
 */

if ( !defined( 'WPB_FP_URI' ) ) {
	define( 'WPB_FP_URI', plugin_dir_path( __FILE__ ) );
}


/**
 * Define metaboxes directory constant
 */

if ( !defined( 'WPB_FP_CUSTOM_METABOXES_DIR' ) ) {
	define( 'WPB_FP_CUSTOM_METABOXES_DIR', plugins_url('/admin/metaboxes', __FILE__) );
}


/**
 * Define TextDomain
 */

if ( !defined( 'WPB_FP_TEXTDOMAIN' ) ) {
	define( 'WPB_FP_TEXTDOMAIN','wpb_fp' );
}


/**
 * WPB Filterable Portfolio Class
 */


class WPB_Filterable_Portfolio {

    /**
     * The plugin path
     *
     * @var string
     */
    public $plugin_path;


    /**
     * The theme directory path
     *
     * @var string
     */
    public $theme_dir_path;


    /**
     * Initializes the WPB_Filterable_Portfolio() class
     *
     * Checks for an existing WPB_Filterable_Portfolio() instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new WPB_Filterable_Portfolio();

            $instance->plugin_init();
        }

        return $instance;
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    function plugin_init() {
    	$this->theme_dir_path = apply_filters( 'wpb_filterable_portfolio_dir_path', 'wpb-filterable-portfolio/' );

    	$this->file_includes();

        add_action( 'init', array( $this, 'localization_setup' ) );

        add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );

        add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( $this, 'wpb_portfolio_plugin_actions' ) );
    }


    /**
     * Load the required files
     *
     * @return void
     */
    function file_includes() {
        
		require_once dirname( __FILE__ ) . '/admin/wpb_aq_resizer.php';
		require_once dirname( __FILE__ ) . '/admin/wpb-fp-admin.php';
		require_once dirname( __FILE__ ) . '/admin/wpb-class.settings-api.php';
		require_once dirname( __FILE__ ) . '/admin/wpb-settings-config.php';
		require_once dirname( __FILE__ ) . '/admin/metaboxes/meta_box.php';
		require_once dirname( __FILE__ ) . '/admin/wpb_fp_metabox_conig.php';
		require_once dirname( __FILE__ ) . '/admin/wpb_fp_shortcode_generator.php';


		require_once dirname( __FILE__ ) . '/inc/wpb_scripts.php';
		require_once dirname( __FILE__ ) . '/inc/wpb-fp-shortcode.php';
		require_once dirname( __FILE__ ) . '/inc/wpb-fp-post-type.php';
		require_once dirname( __FILE__ ) . '/inc/wpb-fp-functions.php';

		if( !class_exists( 'WpBean_Plugin_Updater' ) ) {
			include( dirname( __FILE__ ) . '/admin/updater/plugin-updater.php' );
		}
		require_once dirname( __FILE__ ) . '/admin/updater/updater-init.php';


		$wpb_fp_gallery_support = wpb_fp_get_option( 'wpb_fp_gallery_support', 'wpb_fp_general' );
		if( $wpb_fp_gallery_support != 'on' ){
			require_once dirname( __FILE__ ) . '/inc/wpb_fp_gallery.php';
		}
    }


    /**
     * Plugin loaded
     */
    
    function plugins_loaded() {
        
    }


    /**
     * Initialize plugin for localization
     *
     * @uses load_plugin_textdomain()
     */
    public function localization_setup() {

        load_plugin_textdomain( WPB_FP_TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }


    /**
	 * Add plugin action links
	 */

	function wpb_portfolio_plugin_actions( $links ) {
	   $links[] = '<a href="'.menu_page_url('portfolio-settings', false).'">'. __('Settings', WPB_FP_TEXTDOMAIN) .'</a>';
	   $links[] = '<a href="http://wpbean.com/support/" target="_blank">'. __('Support', WPB_FP_TEXTDOMAIN) .'</a>';
	   $links[] = '<a href="http://wpbean.com/wpb-filterable-portfolio-documentation/" target="_blank">'. __('Documentation', WPB_FP_TEXTDOMAIN) .'</a>';
	   return $links;
	}



    /**
     * Get the plugin path.
     *
     * @return string
     */
    public function plugin_path() {
        if ( $this->plugin_path ) return $this->plugin_path;

        return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
    }

    /**
     * Get the template path.
     *
     * @return string
     */
    public function template_path() {
        return $this->plugin_path() . '/templates/';
    }

}

/**
 * Initialize the plugin
 */
function wpb_filterable_portfolio() {
    return WPB_Filterable_Portfolio::init();
}

// kick it off
wpb_filterable_portfolio();