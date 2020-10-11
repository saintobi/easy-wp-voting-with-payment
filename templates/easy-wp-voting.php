<?php

/**
 * @package Easy_WP_Voting_With_Payment
 * @version 1.0.0
 */

$args = array(  
    'post_type' => 'ewvwp',
    'post_status' => 'publish',
    'posts_per_page' => 8, 
    'orderby' => 'title', 
    'order' => 'ASC', 
);

$loop = new WP_Query( $args );

if(!empty(get_option('ewvwp_template'))){
	$template = get_option('ewvwp_template');
} else {
	$template = 1;
}

include 'pages/theme_'.$template.'.php';

?>

