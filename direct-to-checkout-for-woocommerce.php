<?php
	/*
	Plugin Name: Direct to Checkout for WooCommerce
	Plugin URI: https://amplifyplugins.com
	Description: Redirects WooCommerce customers to checkout instead of the cart page.
	Requires at least: 3.3.0
	Tested up to: 6.0
	Version: 1.0.1
	WC requires at least: 3.0.0
	WC tested up to: 6.5.1
	Author: Amplify Plugins
	Author URI: https://amplifyplugins.com
	Text Domain: direct-to-checkout-for-woocommerce
	*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
 * Includes for our Plugin
 */
if ( ! defined( 'DTC_PLUGIN' ) ) {
	define( 'DTC_PLUGIN', __FILE__ );
}
if ( ! defined( 'DTC_PLUGIN_VERSION' ) ) {
	define( 'DTC_PLUGIN_VERSION', '1.0.1' );
}
if ( ! defined( 'DTC_PLUGIN_DIR' ) ) {
	define( 'DTC_PLUGIN_DIR', dirname( __FILE__ ) );
}
if ( ! defined( 'DTC_PLUGIN_URL' ) ) {
	define( 'DTC_PLUGIN_URL', plugins_url( '', __FILE__ ) );
}
if ( ! defined( 'DTC_PLUGIN_BASENAME' ) ) {
	define( 'DTC_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

/* Front End Functions */
require  DTC_PLUGIN_DIR . '/includes/front-end.php';
/* Admin Settings */
require  DTC_PLUGIN_DIR . '/includes/class-wc-settings-direct-to-checkout.php';