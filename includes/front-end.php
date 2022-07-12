<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter( 'woocommerce_add_to_cart_redirect', 'dtc_add_to_cart_redirect' );
function dtc_add_to_cart_redirect( $url ) {
	$redirect_checkout = wc_get_checkout_url();
	return $redirect_checkout;
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'dtc_custom_add_to_cart_text' );
// add_filter( 'woocommerce_product_add_to_cart_text', 'dtc_custom_add_to_cart_text' );

function dtc_custom_add_to_cart_text( $button_text ) {
	$setting = get_option( 'wc_settings_tab_direct_to_checkout_single_product_page_button_text' );
	if ( isset( $setting ) && '' != $setting ) {
		$button_text = $setting;
	}
	return $button_text;
}

add_filter( 'woocommerce_loop_add_to_cart_link', 'dtc_custom_simple_product_add_to_cart_text', 10, 2 );
function dtc_custom_simple_product_add_to_cart_text( $button, $product ) {
	$setting = get_option( 'wc_settings_tab_direct_to_checkout_simple_shop_page_button_text' );
	if ( $product->is_type( 'simple' ) && isset( $setting ) && '' != $setting ) {
		$button = '<a class="button" href="' . $product->add_to_cart_url() . '">' . $setting . '</a>';
	}
	return $button;
}

add_action( 'woocommerce_before_checkout_form', 'dtc_add_cart_on_checkout', 5 );
function dtc_add_cart_on_checkout() {
	if ( is_wc_endpoint_url( 'order-received' ) ) {
		return;
	}
	$setting = get_option( 'wc_settings_tab_direct_to_checkout_add_cart_to_checkout' );
	if ( isset( $setting ) && 'yes' == $setting ) {
 		echo do_shortcode('[woocommerce_cart]'); // Woocommerce cart page shortcode
	}
}

// add_filter( 'woocommerce_coupons_enabled', 'dtc_coupon_field_on_checkout' );
function dtc_coupon_field_on_checkout( $enabled ) {
	$setting = get_option( 'wc_settings_tab_direct_to_checkout_add_cart_to_checkout' );
	if ( is_checkout() && isset( $setting ) && 'yes' == $setting ) {
		$enabled = false;
	}
	return $enabled;
}