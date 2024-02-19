<?php
/**
 * Disable Shipping Methods Admin Menu
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Settings_Direct_To_Checkout' ) ) {
	class WC_Settings_Direct_To_Checkout {

		/*
		* Bootstraps the class and hooks required actions & filters.
		*/
		public static function init() {
			add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
			add_action( 'woocommerce_settings_tabs_direct_to_checkout', __CLASS__ . '::settings_tab' );
			add_action( 'woocommerce_update_options_direct_to_checkout', __CLASS__ . '::update_settings' );
			add_action( 'before_woocommerce_init', __CLASS__ . '::declare_hpos_compability' );
		}


		/*
		* Add a new settings tab to the WooCommerce settings tabs array.
		*
		* @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
		* @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
		*/
		public static function add_settings_tab( $settings_tabs ) {
			$settings_tabs['direct_to_checkout'] = __( 'Direct To Checkout', 'direct-to-checkout-for-woocommerce' );
			return $settings_tabs;
		}


		/* Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
		*
		* @uses woocommerce_admin_fields()
		* @uses self::get_settings()
		*/
		public static function settings_tab() {
			// Set up the WooCommerce admin settings for this plugin.
			echo '<div class="notice notice-warning"><p>';
			echo sprintf(
				'<strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a> %5$s',
				esc_html__( 'Want to take your store to the next level?', 'direct-to-checkout-for-woocommerce' ),
				esc_html__( 'Get Quick Checkout, which lets your customers checkout directly on the product and shop pages as well as on custom landing pages.', 'direct-to-checkout-for-woocommerce' ),
				esc_url( 'https://quickcheckoutplugin.com/checkout?edd_action=add_to_cart&download_id=46&edd_options[price_id]=1' ),
				esc_html__( 'Click here', 'direct-to-checkout-for-woocommerce' ),
				esc_html__( 'to purchase a license and begin offering customers the best checkout experience for WooCommerce.', 'direct-to-checkout-for-woocommerce' )
			);
			echo '</p></div>';
			woocommerce_admin_fields( self::get_settings() );
		}


		/* Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
		*
		* @uses woocommerce_update_options()
		* @uses self::get_settings()
		*/
		public static function update_settings() {
			woocommerce_update_options( self::get_settings() );
		}


		/* Get all the settings for this plugin for @see woocommerce_admin_fields() function.
		*
		* @return array Array of settings for @see woocommerce_admin_fields() function.
		*/
		public static function get_settings() {

			$settings = array(
				'section_title' => array(
					'name'     => __( 'Direct To Checkout Settings', 'direct-to-checkout-for-woocommerce' ),
					'type'     => 'title',
					'desc'     => '',
					'id'       => 'wc_settings_tab_direct_to_checkout_section_title'
				),
				'product_page' => array(
					'name' => __( 'Direct to Checkout Product Page Button Text', 'direct-to-checkout-for-woocommerce' ),
					'type' => 'text',
					'desc' => __( 'Change the default Add To Cart button text on the product page.', 'direct-to-checkout-for-woocommerce' ),
					'id'   => 'wc_settings_tab_direct_to_checkout_single_product_page_button_text'
				),
				'shop_page' => array(
					'name' => __( 'Direct to Checkout Shop Page Button Text', 'direct-to-checkout-for-woocommerce' ),
					'type' => 'text',
					'desc' => __( 'Change the default Add To Cart button text on the shop page. Simple products only. All other products will display the default text.', 'direct-to-checkout-for-woocommerce' ),
					'id'   => 'wc_settings_tab_direct_to_checkout_simple_shop_page_button_text'
				),
				'add_cart_to_checkout' => array(
					'name' => __( 'Add Cart to Checkout Page', 'direct-to-checkout-for-woocommerce' ),
					'type' => 'checkbox',
					'desc' => __( 'Add the shopping cart to the checkout page. This allows customers to change quantities, remove products, apply coupons, etc.', 'direct-to-checkout-for-woocommerce' ),
					'id'   => 'wc_settings_tab_direct_to_checkout_add_cart_to_checkout'
				),
				'section_end' => array(
					'type' => 'sectionend',
					'id' => 'wc_settings_tab_direct_to_checkout_section_end'
				)
			);

			return apply_filters( 'wc_settings_tab_direct_to_checkout_settings', $settings );
		}

		public static function declare_hpos_compability() {
			if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
				\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', DTC_PLUGIN, true );
			}
		}
	}
}
WC_Settings_Direct_To_Checkout::init();