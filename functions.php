<?php
/**
 * @package Easy_WP_Voting_With_Payment
 * @version 1.0.0
 */


function easy_wp_voting_add_admin_page() {

    //Admin page

	add_submenu_page( 'edit.php?post_type=easy-wp-voting', 'Easy Wp Voting Settings', 'Settings', 'manage_options', 'easy_wp_voting_plugin', 'easy_wp_voting_setting_page');

    //Activate Custom Setting

    add_action( 'admin_init', 'easy_wp_voting_custom_setting' );


}
add_action( 'admin_menu', 'easy_wp_voting_add_admin_page' );


function easy_wp_voting_custom_setting() {

	register_setting( 'easy-wp-voting-group', 'easy_wp_voting_paystack_public_key' );
	register_setting( 'easy-wp-voting-group', 'easy_wp_voting_paystack_secret_key' );
	register_setting( 'easy-wp-voting-group', 'easy_wp_voting_min_amount' );
	add_settings_section( 'easy-wp-voting-form-plugin' , 'Settings' , 'easy_wp_voting_plugin_settings' , 'easy_wp_voting_plugin' );
	add_settings_field( 'easy-wp-voting-public-key', 'Paystack Public Key', 'easy_wp_voting_paystack_public_key_input', 'easy_wp_voting_plugin', 'easy-wp-voting-form-plugin' );
	add_settings_field( 'easy-wp-voting-secret-key', 'Paystack Secret Key', 'easy_wp_voting_paystack_secret_key_input', 'easy_wp_voting_plugin', 'easy-wp-voting-form-plugin' );
	add_settings_field( 'easy-wp-voting-min-amount', 'Amount for one vote', 'easy_wp_voting_min_amount_input', 'easy_wp_voting_plugin', 'easy-wp-voting-form-plugin' );

}


function easy_wp_voting_setting_page() {
	include( plugin_dir_path(__FILE__) . 'templates/admin.php');
}

function easy_wp_voting_plugin_settings(){
	//echo "Paystack Public Key";
}

function easy_wp_voting_paystack_public_key_input() {
	$option = get_option( 'easy_wp_voting_paystack_public_key' );
	echo '<input type="text" name="easy_wp_voting_paystack_public_key" value="'.$option.'" id="easy_wp_voting_paystack_public_key"/>';
}


function easy_wp_voting_paystack_secret_key_input() {
	$option = get_option( 'easy_wp_voting_paystack_secret_key' );
	echo '<input type="text" name="easy_wp_voting_paystack_secret_key" value="'.$option.'" id="easy_wp_voting_paystack_secret_key"/>';
}


function easy_wp_voting_min_amount_input() {
	$option = get_option( 'easy_wp_voting_min_amount' );
	echo '<input type="text" name="easy_wp_voting_min_amount" value="'.$option.'" id="easy_wp_voting_min_amount"/>';
}