<?php
/**
 * Plugin Name: Disable WooCommerce Bloat
 * Description: Disable unnecessary WooCommerce features and make your shop faster and cleaner
 * Version: 2.4.1
 * Author: ospiotr
 * Developer: ospiotr
 * Text Domain: disable-dashboard-for-woocommerce
 * Domain Path: /languages
 * Requires at least: 4.5
 * Tested up to: 5.6
 * Requires PHP: 5.6
 * WC requires at least: 4.0
 * WC tested up to: 5.2
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action( 'init', 'wpdocs_load_textdomain' );
  
/**
 * Load plugin textdomain.
 */
function wpdocs_load_textdomain() {
  load_plugin_textdomain( 'disable-dashboard-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
 
function wcbloat_settings_link($links) {
  $settings_link = __( '<a href="admin.php?page=wc-settings&tab=advanced&section=wcbloat">Settings</a>', 'disable-dashboard-for-woocommerce' );
  $donate_link = __( '<a target="_blank" style="color:#d64e07;font-weight:bold;" href="https://www.paypal.com/donate?hosted_button_id=VHFM47MRPMTYG">Donate</a>', 'disable-dashboard-for-woocommerce' );
  array_unshift($links, $settings_link, $donate_link); 
  return $links; 
}
$wcbloat_plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$wcbloat_plugin", 'wcbloat_settings_link' );

add_filter( 'woocommerce_get_sections_advanced', 'wcbloat_add_section' );
function wcbloat_add_section( $sections ) {
	
	$sections['wcbloat'] = __( 'Disable WooCommerce Bloat', 'disable-dashboard-for-woocommerce' );
	return $sections;
	
}

/**
 * Add settings to the specific section we created before
 */
add_filter( 'woocommerce_get_settings_advanced', 'wcbloat_all_settings', 10, 2 );
function wcbloat_all_settings( $settings, $current_section ) {
	/**
	 * Check the current section is what we want
	 **/
	if ( $current_section == 'wcbloat' ) {
		$settings_wcbloat = array();
		// Add Title to the Settings
		$settings_wcbloat[] = array(
			'name' => __( 'Disable WooCommerce Bloat Settings', 'disable-dashboard-for-woocommerce' ),
			'type' => 'title',
			'desc' => __( 'Below you will find four sections with settings which will speed up your shop. Decide which unnecessary features should be disabled.<br><br><div style="width:400px"><strong>If you find the plugin useful, please consider <a target="_blank" href="https://www.paypal.com/donate?hosted_button_id=VHFM47MRPMTYG">buying me a coffee</strong></a> <span style="font-size:17px;">&#9749;</span><p style="text-align:right;margin:0">~ Peter</p></div><hr>', 'disable-dashboard-for-woocommerce' ),
			'id' => 'wcbloat'
		);
		
		$settings_wcbloat[] = array(
			'type' => 'sectionend',
			'id' => 'wcbloat',
		);
		
		// General
		$settings_wcbloat[] = array(
			'name' => __( 'Remove bloat', 'disable-dashboard-for-woocommerce' ),
			'type' => 'title',
			'id' => 'wcbloat_general',
			'desc' => __( 'Disable bloatware features introduced in WooCommerce 4.0 and 4.1. Remove different WooCommerce additional features that are slowing your page down.', 'disable-dashboard-for-woocommerce' )
		);
		
		// WooCommerce Admin, Analytics tab, Notification bar
		$settings_wcbloat[] = array(
			'name'     => __( 'WooCommerce Admin', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'This option will completely disable WooCommerce Admin, Analytics tab and Notification bar. Home screen feature will also be disabled. <strong><span style="color:red">Note:</span> Reload the page after saving changes to see the results.</strong>', 'disable-dashboard-for-woocommerce.' ),
			'id'       => 'wcbloat_admin_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable WooCommerce Admin' ),
			'default' => 'yes'
		);
		// Marketing Hub
		$settings_wcbloat[] = array(
			'name'     => __( 'Marketing Hub', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'This option will completely disable WooCommerce Marketing Hub. Coupon menu entry will stay accessible the old way (WooCommerce -> Coupons).' ),
			'id'       => 'wcbloat_marketing_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable Marketing Hub' ),
			'default' => 'yes'
		);
		
		$settings_wcbloat[] = array(
			'type' => 'sectionend',
			'id' => 'wcbloat_general',
		);
		
		
		// Admin interface
		
		$settings_wcbloat[] = array(
			'name' => __( 'Admin interface', 'disable-dashboard-for-woocommerce' ),
			'type' => 'title',
			'id' => 'wcbloat_interface',
			'desc' => __( 'Make your admin panel faster and cleaner using the options below.', 'disable-dashboard-for-woocommerce' )
		);
		
		// Connect your store to WooCommerce.com to receive extensions updates and support. message for WooCommerce.com plugins
		$settings_wcbloat[] = array(
			'name'     => __( 'WooCommerce.com notice', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'Disables notice from WooCommerce.com plugins: <code>Connect your store to WooCommerce.com to receive extensions updates and support</code>.', 'disable-dashboard-for-woocommerce' ),
			'id'       => 'wcbloat_wc_helper_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable WooCommerce.com notice', 'disable-dashboard-for-woocommerce' ),
			'default' => 'yes'
		);
				
		// Disable WooCommerce Status Meta Box
		$settings_wcbloat[] = array(
			'name'     => __( 'WooCommerce Status Meta Box', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'Enabling this option will remove WooCommerce Status Meta Box from <a href="/wp-admin/index.php">WordPress Dashboard</a>.', 'disable-dashboard-for-woocommerce' ),
			'id'       => 'wcbloat_wc_status_meta_box_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable WooCommerce Status Meta Box', 'disable-dashboard-for-woocommerce' ),
		);
		
		// Disable Marketplace Suggestions
		$settings_wcbloat[] = array(
			'name'     => __( 'Marketplace Suggestions', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'This option will disable Marketplace Suggestions.', 'disable-dashboard-for-woocommerce' ),
			'id'       => 'wcbloat_wc_marketplace',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable WooCommerce Marketplace Suggestions', 'disable-dashboard-for-woocommerce' ),
		);
		
		// Disable Extensions submenu
		$settings_wcbloat[] = array(
			'name'     => __( 'Extensions submenu', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'Hide Extensions submenu in the WooCommerce menu in your admin panel menu. <strong>Reload the page after saving changes to see the results.</strong>', 'disable-dashboard-for-woocommerce' ),
			'id'       => 'wcbloat_remove_addon_submenu',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable Extensions submenu', 'disable-dashboard-for-woocommerce' ),
		);
		
		$settings_wcbloat[] = array(
			'type' => 'sectionend',
			'id' => 'wcbloat_interface',
		);
		
		//Site performance
		
		$settings_wcbloat[] = array(
			'name' => __( 'Site performance', 'disable-dashboard-for-woocommerce' ),
			'type' => 'title',
			'id' => 'wcbloat_performance',
			'desc' => __( 'Reduce HTTP requests on the front end of your site. Disable scripts that are slowing your page down your shop clean and lightweight. <strong>Please be careful while configuring the options below, as thay can affect some of the features your site uses</strong>.', 'disable-dashboard-for-woocommerce' ),
		);
		
		
		
		// Disable Password Strength Meter
		$settings_wcbloat[] = array(
			'name'     => __( 'Password Strength Meter', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'Removes the WordPress and WooCommerce password strength meter scripts (over 400 KB) from non-essential pages.', 'disable-dashboard-for-woocommerce' ),
			'id'       => 'wcbloat_password_meter_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable Password Strength Meter', 'disable-dashboard-for-woocommerce' ),
		);
		
		// Disable WooCommerce Scripts and Styles
		$settings_wcbloat[] = array(
			'name'     => __( 'WooCommerce scripts and styles', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'Use this option to disable WooCommerce scripts (javascript) and styles (CSS) everywhere except on product, cart and checkout pages.', 'disable-dashboard-for-woocommerce' ),
			'id'       => 'wcbloat_wc_scripts_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable WooCommerce scripts and styles', 'disable-dashboard-for-woocommerce' ),
		);
		
		// Disable WooCommerce Cart Fragments
		$settings_wcbloat[] = array(
			'name'     => __( 'WooCommerce Cart Fragments', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'The cart fragments feature is used to update the cart total without refreshing the page. <strong>Warning:</strong> Disabling it will speed up your store, but may result in wrong calculations in mini cart. Use with caution.' ),
			'id'       => 'wcbloat_wc_fragmentation_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable WooCommerce Cart Fragments', 'disable-dashboard-for-woocommerce' ),
		);
		

		// Disable WooCommerce Widgets
		$settings_wcbloat[] = array(
			'name'     => __( 'WooCommerce Widgets', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'WooCommerce by default comes with a lot of widgets installed. They often are not used at all, but can add backend load and front-end load. Use this option to disable the WooCommerce widgets. <strong>Warning: </strong>Please make sure that you are <a href="/wp-admin/widgets.php">not using any of WooCommerce Widgets</a> anywhere in your site.', 'disable-dashboard-for-woocommerce' ),
			'id'       => 'wcbloat_wc_widgets_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable WooCommerce Widgets', 'disable-dashboard-for-woocommerce' ),
		);
		
		$settings_wcbloat[] = array(
			'type' => 'sectionend',
			'id' => 'wcbloat_performance',
		);
		
		// Third party section
		
		$settings_wcbloat[] = array(
			'name' => __( 'Third-party plugins bloat', 'disable-dashboard-for-woocommerce' ),
			'type' => 'title',
			'id' => 'wcbloat_thirdparty',
			'desc' => __( 'Disable unnecessary features of the third-party plugins installed in your site.', 'disable-dashboard-for-woocommerce' ),
		);
		
		
		// Disable Jetpack ads
		$settings_wcbloat[] = array(
			'name'     => __( 'Jetpack promotions', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'This option will disable Jetpack-related notices that promote services like the backup services VaultPress or WordPress Apps. Works only if you have Jetpack installed.', 'disable-dashboard-for-woocommerce' ),
			'id'       => 'wcbloat_jetpack_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable Jetpack promotions', 'disable-dashboard-for-woocommerce' ),
		);		
		
		// Disable SkyVerge Dashboard
		$settings_wcbloat[] = array(
			'name'     => __( 'SkyVerge Dashboard', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'This option will disable SkyVerge Dashboard. Works only if you are using SkyVerge plugins.', 'disable-dashboard-for-woocommerce' ),
			'id'       => 'wcbloat_wc_skyverge_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable SkyVerge Dashboard', 'disable-dashboard-for-woocommerce' ),
		);
		
		// Disable Elementor overview Dashboard widget
		$settings_wcbloat[] = array(
			'name'     => __( 'Elementor Dashboard widget', 'disable-dashboard-for-woocommerce' ),
			'desc_tip' => __( 'This option will disable Elementor overview <a href="/wp-admin/index.php">Dashboard</a> widget. Works only if you are using Elementor.', 'disable-dashboard-for-woocommerce' ),
			'id'       => 'wcbloat_elementor_widget_disable',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Disable Elementor Dashboard widget', 'disable-dashboard-for-woocommerce' ),
		);
	

		$settings_wcbloat[] = array(
			'type' => 'sectionend',
			'id' => 'wcbloat_thirdparty',
		);
		

		
		// ending
			$settings_wcbloat[] = array(
			'name' => __( '', 'disable-dashboard-for-woocommerce' ),
			'type' => 'title',
			'id' => 'wcbloat_ending',
			'desc' => __( '<hr><strong><span style="color:red">Note:</span> Reload the page after saving changes to see the results.</strong><div style="width:400px"><br>If you find the plugin useful, please consider <a target="_blank" href="https://www.paypal.com/donate?hosted_button_id=VHFM47MRPMTYG"><strong>buying me a coffee</strong></a> <span style="font-size:17px;">&#9749;</span><p style="text-align:right;margin:0">~ Peter</p></div>', 'disable-dashboard-for-woocommerce' ),
		);
		
		
				$settings_wcbloat[] = array(
			'type' => 'sectionend',
			'id' => 'wcbloat_ending',
		);
		
		return $settings_wcbloat;

	
	/**
	 * If not, return the standard settings
	 **/
	} else {
		return $settings;
	}
}

/* Disable WooCommerce Admin, Analytics tab, Notification bar
/***********************************************************************/
if(!empty(get_option('wcbloat_admin_disable', 'yes' )) && (get_option('wcbloat_admin_disable', 'yes' ) == 'yes')){
	add_filter( 'woocommerce_admin_disabled', '__return_true' );
}

/* Marketing Hub
/***********************************************************************/

if(!empty(get_option('wcbloat_marketing_disable', 'yes' )) && (get_option('wcbloat_marketing_disable', 'yes' ) == 'yes')){
	add_filter( 'woocommerce_marketing_menu_items', '__return_empty_array' );
	add_filter( 'woocommerce_admin_features', 'disable_features' );

function disable_features( $features ) {
	$marketing = array_search('marketing', $features);
	unset( $features[$marketing] );
	return $features;
}
}

/* Connect your store to WooCommerce.com to receive extensions updates and support. message for WooCommerce.com plugins
/***********************************************************************/

if(!empty(get_option('wcbloat_wc_helper_disable', 'yes' )) && (get_option('wcbloat_wc_helper_disable', 'yes' ) == 'yes')){
	add_filter( 'woocommerce_helper_suppress_admin_notices', '__return_true' );
}

/* Disable Password Strength Meter
/***********************************************************************/
if(!empty(get_option('wcbloat_password_meter_disable')) && (get_option('wcbloat_password_meter_disable') == 'yes')) {
	add_action('wp_print_scripts', 'wcbloat_disable_password_strength_meter', 100);
}

function wcbloat_disable_password_strength_meter() {
	global $wp;

	$wp_check = isset($wp->query_vars['lost-password']) || (isset($_GET['action']) && $_GET['action'] === 'lostpassword') || is_page('lost_password');

	$wc_check = (class_exists('WooCommerce') && (is_account_page() || is_checkout()));

	if(!$wp_check && !$wc_check) {
		if(wp_script_is('zxcvbn-async', 'enqueued')) {
			wp_dequeue_script('zxcvbn-async');
		}

		if(wp_script_is('password-strength-meter', 'enqueued')) {
			wp_dequeue_script('password-strength-meter');
		}

		if(wp_script_is('wc-password-strength-meter', 'enqueued')) {
			wp_dequeue_script('wc-password-strength-meter');
		}
	}
}

/* Disable WooCommerce Scripts
/***********************************************************************/
if(!empty(get_option('wcbloat_wc_scripts_disable')) && (get_option('wcbloat_wc_scripts_disable') == 'yes')) {
	add_action('wp_enqueue_scripts', 'wcbloat_disable_woocommerce_scripts', 99);
}

function wcbloat_disable_woocommerce_scripts() {
	if(function_exists('is_woocommerce')) {
		if(!is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page() && !is_product() && !is_product_category() && !is_shop()) {
			
			//Dequeue WooCommerce Styles
			wp_dequeue_style('woocommerce-general');
			wp_dequeue_style('woocommerce-layout');
			wp_dequeue_style('woocommerce-smallscreen');
			wp_dequeue_style('woocommerce_frontend_styles');
			wp_dequeue_style('woocommerce_fancybox_styles');
			wp_dequeue_style('woocommerce_chosen_styles');
			wp_dequeue_style('woocommerce_prettyPhoto_css');
			//Dequeue WooCommerce Scripts
			wp_dequeue_script('wc_price_slider');
			wp_dequeue_script('wc-single-product');
			wp_dequeue_script('wc-add-to-cart');
			wp_dequeue_script('wc-checkout');
			wp_dequeue_script('wc-add-to-cart-variation');
			wp_dequeue_script('wc-single-product');
			wp_dequeue_script('wc-cart');
			wp_dequeue_script('wc-chosen');
			wp_dequeue_script('woocommerce');
			wp_dequeue_script('prettyPhoto');
			wp_dequeue_script('prettyPhoto-init');
			wp_dequeue_script('jquery-blockui');
			wp_dequeue_script('jquery-placeholder');
			wp_dequeue_script('fancybox');
			wp_dequeue_script('jqueryui');

			if(!empty(get_option('wcbloat_wc_fragmentation_disable')) && (get_option('wcbloat_wc_fragmentation_disable') == 'yes')) {
				wp_dequeue_script('wc-cart-fragments');
			}
		}
	}
}

/* Disable WooCommerce Cart Fragments
/***********************************************************************/
if(!empty(get_option('wcbloat_wc_fragmentation_disable')) && (get_option('wcbloat_wc_fragmentation_disable') == 'yes')) {
	add_action('wp_enqueue_scripts', 'wcbloat_disable_woocommerce_cart_fragments', 99);
}

function wcbloat_disable_woocommerce_cart_fragments() {
	if(function_exists('is_woocommerce')) {
		wp_dequeue_script('wc-cart-fragments');
	}
}

/* Disable WooCommerce Status Meta Box
/***********************************************************************/
if(!empty(get_option('wcbloat_wc_status_meta_box_disable')) && (get_option('wcbloat_wc_status_meta_box_disable') == 'yes')) {
	add_action('wp_dashboard_setup', 'wcbloat_disable_woocommerce_status');
}

function wcbloat_disable_woocommerce_status() {
	remove_meta_box('woocommerce_dashboard_status', 'dashboard', 'normal');
}

/* Disable WooCommerce Marketplace Suggestions
/***********************************************************************/
if(!empty(get_option('wcbloat_wc_marketplace')) && (get_option('wcbloat_wc_marketplace') == 'yes')) {
add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false', 999 );
}

/* Disable Extensions submenu
/***********************************************************************/
if(!empty(get_option('wcbloat_remove_addon_submenu')) && (get_option('wcbloat_remove_addon_submenu') == 'yes')) {
	add_action( 'admin_menu', 'wcbloat_remove_admin_addon_submenu', 999 );
		function wcbloat_remove_admin_addon_submenu() {
			remove_submenu_page( 'woocommerce', 'wc-addons');
	}
	}

/* Disable WooCommerce Widgets
/***********************************************************************/
if(!empty(get_option('wcbloat_wc_widgets_disable')) && (get_option('wcbloat_wc_widgets_disable') == 'yes')) {
	add_action('widgets_init', 'wcbloat_disable_woocommerce_widgets', 99);
}
function wcbloat_disable_woocommerce_widgets() {

	unregister_widget('WC_Widget_Products');
	unregister_widget('WC_Widget_Product_Categories');
	unregister_widget('WC_Widget_Product_Tag_Cloud');
	unregister_widget('WC_Widget_Cart');
	unregister_widget('WC_Widget_Layered_Nav');
	unregister_widget('WC_Widget_Layered_Nav_Filters');
	unregister_widget('WC_Widget_Price_Filter');
	unregister_widget('WC_Widget_Product_Search');
	unregister_widget('WC_Widget_Recently_Viewed');
	unregister_widget('WC_Widget_Recent_Reviews');
	unregister_widget('WC_Widget_Top_Rated_Products');
	unregister_widget('WC_Widget_Rating_Filter');
	}
	
	/* Disable Jetpack promotions
/***********************************************************************/
if(!empty(get_option('wcbloat_jetpack_disable')) && (get_option('wcbloat_jetpack_disable') == 'yes')) {
add_filter( 'jetpack_just_in_time_msgs', '__return_false', 20 );
add_filter( 'jetpack_show_promotions', '__return_false', 20 );
}
	
	/* Disable SkyVerge Dashboard
/***********************************************************************/
if(!empty(get_option('wcbloat_wc_skyverge_disable')) && (get_option('wcbloat_wc_skyverge_disable') == 'yes')) {
	// remove SkyVerge support dashboard
	add_action( 'admin_menu', function() { remove_menu_page( 'skyverge' ); }, 99 );

	// remove dashboard stylesheet
	add_action( 'admin_enqueue_scripts', function() { wp_dequeue_style( 'sv-wordpress-plugin-admin-menus' ); }, 20 );
}

	/* Disable Elementor Dashboard widget
/***********************************************************************/
if(!empty(get_option('wcbloat_elementor_widget_disable')) && (get_option('wcbloat_elementor_widget_disable') == 'yes')) {
	function disable_elementor_dashboard_overview_widget() {
		remove_meta_box( 'e-dashboard-overview', 'dashboard', 'normal');
	}
	add_action('wp_dashboard_setup', 'disable_elementor_dashboard_overview_widget', 40);
}