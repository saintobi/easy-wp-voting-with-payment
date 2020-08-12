<?php


if (! defined('WP_UNINSTALL_PLUGIN') ) {
    exit;
}


//delete all custom post type with metadata
$myplugin_cpt_args = array('post_type' => 'easy-wp-voting', 'posts_per_page' => -1);
$myplugin_cpt_posts = get_posts($myplugin_cpt_args);
foreach ($myplugin_cpt_posts as $post) {
    wp_delete_post($post->ID, false);
    delete_post_meta($post->ID, '_easy_wp_voting_vote_value_key');
    delete_post_meta($post->ID, '_easy_wp_voting_age_value_key');
    delete_post_meta($post->ID, '_easy_wp_voting_occupation_value_key');
    delete_post_meta($post->ID, '_easy_wp_voting_state_value_key');
    delete_post_meta($post->ID, '_easy_wp_voting_nickname_value_key');
}


//remove shortcode
remove_shortcode( 'easy_wp_voting' );


//delete register options
delete_option( 'easy_wp_voting_paystack_public_key' );
delete_option( 'easy_wp_voting_paystack_secret_key' );
delete_option( 'easy_wp_voting_min_amount' );
