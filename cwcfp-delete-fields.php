<?php
/**
 * Plugin Name: Conditional Woo Checkout Field Pro Delete Fields
 * Description: Delete fields that were not correctly deleted from the plugin. This plugin will deactivate itself after it runs once.
 */
function cwcfp_delete_fields_from_checkout(){
  $field_count = get_option( 'pro_conditional_fields_qty' );
  $conditional_a = 1;
  for ( $conditional_a; $conditional_a <= $field_count; $conditional_a++ ) {
    $delete = get_option( 'pro_conditional_fields_delete_' . $conditional_a );
    switch ( $delete ) {
      case 'yes':
        update_option( 'pro_conditional_fields_pid_' . $conditional_a, '' );
        update_option( 'pro_conditional_fields_cid_' . $conditional_a, '' );
        update_option( 'pro_conditional_fields_variation_ids_' . $conditional_a, '' );
        break;
      
      default:
        //do nothing
        break;
    }
  }
  deactivate_plugins( plugin_basename( __FILE__ ) );
}
add_action( 'admin_init', 'cwcfp_delete_fields_from_checkout' );
