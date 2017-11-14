<?php

if ( !defined( 'ABSPATH' ) ) {
    die;
}
// Exit if accessed directly
/*
Plugin Name: NMI Gateway for WooCommerce
Plugin URI: http://bngdesign.net/plugins/nmi-gateway-woocommerce-plugin
Description: Add the NMI Gateway for WooCommerce.
Version: 1.5.4
Author: BNGDesign
Author URI: http://bngdesign.net/plugins
License: GPLv2
*/
//freemius
// Create a helper function for easy SDK access.
function ngfw_fs()
{
    global  $ngfw_fs ;
    
    if ( !isset( $ngfw_fs ) ) {
        // Include Freemius SDK.
        require_once dirname( __FILE__ ) . '/freemius/start.php';
        $ngfw_fs = fs_dynamic_init( array(
            'id'             => '1214',
            'slug'           => 'woo-nmi-three-step',
            'type'           => 'plugin',
            'public_key'     => 'pk_25aa83790f8c599b20186a6c2f3c8',
            'is_premium'     => false,
            'has_addons'     => false,
            'has_paid_plans' => true,
            'menu'           => array(
            'slug'           => 'wc-settings',
            'override_exact' => true,
            'contact'        => false,
            'support'        => false,
            'parent'         => array(
            'slug' => 'woocommerce',
        ),
        ),
            'is_live'        => true,
        ) );
    }
    
    return $ngfw_fs;
}

// Init Freemius.
ngfw_fs();
// Signal that SDK was initiated.
do_action( 'ngfw_fs_loaded' );
function ngfw_fs_settings_url()
{
    return admin_url( 'admin.php?page=wc-settings&tab=checkout&section=nmi_three_step' );
}

ngfw_fs()->add_filter( 'connect_url', 'ngfw_fs_settings_url' );
ngfw_fs()->add_filter( 'after_skip_url', 'ngfw_fs_settings_url' );
ngfw_fs()->add_filter( 'after_connect_url', 'ngfw_fs_settings_url' );
ngfw_fs()->add_filter( 'after_pending_connect_url', 'ngfw_fs_settings_url' );
//end freemius
/* WooCommerce fallback notice. */
function woocommerce_nmi_fallback_notice()
{
    echo  '<div class="error"><p>' . sprintf( __( 'WooCommerce Custom Payment Gateways depends on the last version of %s to work!', 'nmi_three_step' ), '<a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce</a>' ) . '</p></div>' ;
}

/* Load functions. */
function nmi_three_step_load()
{
    
    if ( !class_exists( 'WC_Payment_Gateway' ) ) {
        add_action( 'admin_notices', 'woocommerce_nmi _fallback_notice' );
        return;
    }
    
    function wc_Custom_add_nmi_gateway( $methods )
    {
        $methods[] = 'NMI_Custom_Payment_Gateway';
        return $methods;
    }
    
    add_filter( 'woocommerce_payment_gateways', 'wc_Custom_add_nmi_gateway' );
    // Include the WooCommerce Custom Payment Gateways classes.
    require_once plugin_dir_path( __FILE__ ) . 'nmi_three_step_gateway_functions.php';
}

add_action( 'plugins_loaded', 'nmi_three_step_load', 0 );
/* Adds custom settings url in plugins page. */
function nmi_three_step_action_links( $links )
{
    $settings = array(
        'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=wc-settings&tab=checkout' ), __( 'Payment Gateways', 'nmi_three_step' ) ),
    );
    return array_merge( $settings, $links );
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'nmi_three_step_action_links' );