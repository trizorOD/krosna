<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//Создаем свой статус заказа "Оплачено"
function register_my_new_order_statuses() {
  register_post_status( 'wc-status-name', array(
    'label'                     => _x( 'Оплачено', 'Order status', 'textdomain' ), //Заменяем "Оплачено" на нужное
    'public'                    => true,
    'exclude_from_search'       => false,
    'show_in_admin_all_list'    => true,
    'show_in_admin_status_list' => true,
    'label_count'               => _n_noop( 'Оплачено <span class="count">(%s)</span>', 'Оплачено <span class="count">(%s)</span>', 'textdomain' ) //Заменяем "Оплачено" на нужное
  ) );
}
add_action( 'init', 'register_my_new_order_statuses' );
 
function my_new_wc_order_statuses( $order_statuses ) {
  $order_statuses['wc-status-name'] = _x( 'Оплачено', 'Order status', 'textdomain' ); //Заменяем "Оплачено" на нужное
 
  return $order_statuses;
}
add_filter( 'wc_order_statuses', 'my_new_wc_order_statuses' );
/**
 * Enqueue child scripts
 */
 add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
  
function custom_override_checkout_fields( $fields ) {
	
   // remove billing fields
    //unset($fields['billing']['billing_first_name']);
    //unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    //unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    //unset($fields['billing']['billing_email']);
   
    // remove shipping fields 
    //unset($fields['shipping']['shipping_first_name']);    
    //unset($fields['shipping']['shipping_last_name']);  
   // unset($fields['shipping']['shipping_company']);
    //unset($fields['shipping']['shipping_address_1']);
    //unset($fields['shipping']['shipping_address_2']);
    //unset($fields['shipping']['shipping_city']);
    //unset($fields['shipping']['shipping_postcode']);
    //unset($fields['shipping']['shipping_country']);
    //unset($fields['shipping']['shipping_state']);
    
    // remove order comment fields
    unset($fields['order']['order_comments']);
	
  //unset($fields['account']['account_username']);
  //unset($fields['account']['account_password']);
  //unset($fields['account']['account_password-2']);
    return $fields;
}

add_action( 'wp_enqueue_scripts', 'learts_child_enqueue_scripts' );

if ( ! function_exists( 'learts_child_enqueue_scripts' ) ) {

	function learts_child_enqueue_scripts() {
		if ( is_rtl() ) {
			wp_enqueue_style( 'learts-main-style', trailingslashit( LEARTS_THEME_URI ) . 'style-rtl.css' );
			wp_enqueue_style( 'learts-style-rtl-custom', trailingslashit( LEARTS_THEME_URI ) . 'style-rtl-custom.css' );
		} else {
			wp_enqueue_style( 'learts-main-style', trailingslashit( LEARTS_THEME_URI ) . 'style.css' );
		}
		wp_enqueue_style( 'learts-child-style', trailingslashit( LEARTS_CHILD_THEME_URI ) . 'style.css' );
		wp_enqueue_script( 'child-script',
			trailingslashit( LEARTS_CHILD_THEME_URI ) . 'script.js',
			array( 'jquery' ),
			null,
			true );
	}

}

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

