<?php
/**
 * @package Easy_WP_Voting_With_Payment
 * @version 1.0.0
 */
/*
Plugin Name: Easy WP Voting With Payment
Plugin URI: https://github.com/Mujhtech/easy-wp-voting-with-payment
Description: Easy WP Voting With Payment allows you to create a simple voting system with payment method
Author: Mujhtech Mujeeb Muhideen
Version: 1.0.0
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Author URI: https://github.com/Mujhtech/
*/


require plugin_dir_path(__FILE__) . 'functions.php';
require plugin_dir_path(__FILE__) . 'admin/custom-post-type.php';



function ewvwp_shortcode( $atts, $content = null ){

	extract(shortcode_atts(
		array( 'display' => 'all' ),
		$atts,
		'ewvwp_plugin'
	));


	ob_start();
	include plugin_dir_path(__FILE__) . 'templates/easy-wp-voting.php';
	return ob_get_clean();

}
add_shortcode( 'ewvwp_plugin', 'ewvwp_shortcode' );


function ewvwp_scripts(){

    wp_enqueue_style( 'ewvwp-owl-carousel-css', plugin_dir_url(__FILE__) . 'assets/css/style.css', array(), '1.0.0', 'all' );

    wp_enqueue_style( 'ewvwp-sweetalert-css', plugin_dir_url(__FILE__) . 'assets/css/sweetalert.css', array(), '1.0.0', 'all' );
  
  	wp_enqueue_script( 'ewvwp-paystack-js', 'https://js.paystack.co/v1/inline.js', array(), '1.0' );

  	wp_enqueue_script( 'ewvwp-sweetalert-js', plugin_dir_url(__FILE__) . 'assets/js/sweetalert.js', array(), '1.0' );

  	wp_enqueue_script( 'ewvwp-js', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), '1.0.0', true );
  
  }
add_action( 'wp_enqueue_scripts', 'ewvwp_scripts' );

require plugin_dir_path(__FILE__) . 'ajax.php';