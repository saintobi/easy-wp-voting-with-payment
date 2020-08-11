<?php
/**
 * @package Easy_WP_Voting_With_Payment
 * @version 1.0.0
 */
/*
Plugin Name: Easy WP Voting With Payment
Plugin URI: https://github.com/Mujhtech/easy-wp-voting-with-payment
Description: This plugin is an easy voting system plugin integrated with payment system
Author: Mujhtech Mujeeb Muhideen
Version: 1.0.0
Author URI: https://github.com/Mujhtech/
*/


require plugin_dir_path(__FILE__) . 'functions.php';
require plugin_dir_path(__FILE__) . 'admin/custom-post-type.php';










function easy_wp_voting_shortcode( $atts, $content = null ){

	extract(shortcode_atts(
		array( 'display' => 'all' ),
		$atts,
		'easy_wp_voting'
	));


	ob_start();
	include plugin_dir_path(__FILE__) . 'templates/easy-wp-voting.php';
	return ob_get_clean();

}
add_shortcode( 'easy_wp_voting', 'easy_wp_voting_shortcode' );


function easy_wp_voting_load_scripts(){
    wp_enqueue_style( 'owl-carousel', plugin_dir_url(__FILE__) . 'asset/css/style.css', array(), '1.0.0', 'all' );
  
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery' , plugin_dir_url(__FILE__) . 'asset/js/jquery.min.js', false, '1.11.3', true );
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'scriptjs', plugin_dir_url(__FILE__) . 'asset/js/script.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'scriptjs' );
  
  }
  add_action( 'wp_enqueue_scripts', 'easy_wp_voting_load_scripts' );

require plugin_dir_path(__FILE__) . 'ajax.php';