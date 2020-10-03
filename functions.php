<?php
/**
 * @package Easy_WP_Voting_With_Payment
 * @version 1.0.0
 */


function ewvwp_add_admin_page() {

    //Admin page

	add_submenu_page( 'edit.php?post_type=ewvwp', 'Easy Wp Voting Settings', 'Settings', 'manage_options', 'ewvwp_plugin', 'ewvwp_setting_page');

    //Activate Custom Setting

    add_action( 'admin_init', 'ewvwp_custom_setting' );


}
add_action( 'admin_menu', 'ewvwp_add_admin_page' );


function ewvwp_custom_setting() {

	register_setting( 'ewvwp-group', 'ewvwp_paystack_public_key' );
	register_setting( 'ewvwp-group', 'ewvwp_paystack_secret_key' );
	register_setting( 'ewvwp-group', 'ewvwp_min_amount' );
	add_settings_section( 'ewvwp-form-plugin' , 'Settings' , 'ewvwp_plugin_settings' , 'ewvwp_plugin' );
	add_settings_field( 'ewvwp-public-key', 'Paystack Public Key', 'ewvwp_paystack_public_key_input', 'ewvwp_plugin', 'ewvwp-form-plugin' );
	add_settings_field( 'ewvwp-secret-key', 'Paystack Secret Key', 'ewvwp_paystack_secret_key_input', 'ewvwp_plugin', 'ewvwp-form-plugin' );
	add_settings_field( 'ewvwp-min-amount', 'Amount for one vote', 'ewvwp_min_amount_input', 'ewvwp_plugin', 'ewvwp-form-plugin' );

}


function ewvwp_setting_page() {
	include( plugin_dir_path(__FILE__) . 'templates/admin.php');
}

function ewvwp_plugin_settings(){
	//echo "Paystack Public Key";
}

function ewvwp_paystack_public_key_input() {
	$option = get_option( 'ewvwp_paystack_public_key' );
	echo '<input type="text" name="ewvwp_paystack_public_key" value="'.$option.'" id="ewvwp_paystack_public_key"/>';
}


function ewvwp_paystack_secret_key_input() {
	$option = get_option( 'ewvwp_paystack_secret_key' );
	echo '<input type="text" name="ewvwp_paystack_secret_key" value="'.$option.'" id="ewvwp_paystack_secret_key"/>';
}


function ewvwp_min_amount_input() {
	$option = get_option( 'ewvwp_min_amount' );
	echo '<input type="number" name="ewvwp_min_amount" value="'.$option.'" id="ewvwp_min_amount"/>';
}