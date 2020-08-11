<?php

/**
 * @package Easy_WP_Voting_With_Payment
 * @version 1.0.0
 */

@ob_start();
add_action( 'init', 'easy_wp_voting_custom_post_type' );
add_filter( 'manage_easy-wp-voting_posts_columns', 'easy_wp_voting_set_columns_name' );
add_action( 'manage_easy-wp-voting_posts_custom_column', 'easy_wp_voting_custom_columns', 10, 2 );
add_action( 'add_meta_boxes', 'easy_wp_voting_add_meta_box' );
add_action( 'save_post', 'easy_wp_voting_save_nickname_data' );
add_action( 'save_post', 'easy_wp_voting_save_age_data' );
add_action( 'save_post', 'easy_wp_voting_save_state_data' );
add_action( 'save_post', 'easy_wp_voting_save_occupation_data' );
add_action( 'save_post', 'easy_wp_voting_save_vote_data' );

add_filter('gettext','custom_enter_title');

add_action( 'wp_loaded', 'wpse_19240_change_place_labels', 20 );

function custom_enter_title( $input ) {

    global $post_type;

    if( is_admin() && 'Add title' == $input && 'easy-wp-voting' == $post_type )
        return 'Enter Fullname';

    return $input;
}


function wpse_19240_change_place_labels()
{
    $p_object = get_post_type_object( 'easy-wp-voting' );

    if ( ! $p_object )
        return FALSE;

    // see get_post_type_labels()
    $p_object->labels->add_new            = 'Add Candidate';
    $p_object->labels->add_new_item       = 'Add new candidate';
    $p_object->labels->all_items          = 'All candidate';
    $p_object->labels->edit_item          = 'Edit candidate';
    $p_object->labels->new_item           = 'New Candidate';
    $p_object->labels->not_found          = 'No candidates found';
    $p_object->labels->not_found_in_trash = 'No candidates found in trash';
    $p_object->labels->search_items       = 'Search candidates';
    $p_object->labels->view_item          = 'View candidate';

    return TRUE;
}


	function easy_wp_voting_custom_post_type(){
		$labels = array(
				'name'				=>	'Easy WP Voting With Payment',
				'singular_name'		=>	'Easy WP Voting With Payment',
				'menu_name'			=>	'Easy WP Voting With Payments',
				'name_admin_bar'	=>	'Easy WP Voting With Payment'
		);

		$args = array(
				'labels'				=>	$labels,
				'show_ui'		=>	true,
				'show_ui_menu'			=>	true,
				'capability_type'	=>	'post',
				'hierarchical'	=>	false,
				'menu_position'	=>	200,
				'publicly_queryable' => true,
				'menu_icon'	=>	'dashicons-email-alt',
				'supports'	=>	array('title', 'thumbnail')
		);

		register_post_type( 'easy-wp-voting', $args );
	}

	function easy_wp_voting_set_columns_name( $columns ) {
		$clientColumns = array();
		$clientColumns['cb'] = "<input type=\"checkbox\" />";
		$clientColumns['title'] = 'Full Name';
		$clientColumns['nickname'] = 'Nick Name';
		$clientColumns['state'] = 'State';
		$clientColumns['age'] = 'Age';
		$clientColumns['occupation'] = 'Occupation';
		$clientColumns['votes'] = 'Number of votes';
		return $clientColumns;

	}


function easy_wp_voting_custom_columns( $columns, $post_id ) {

	switch ( $columns ) {
		case 'nickname':
			$value = get_post_meta( $post_id, '_easy_wp_voting_nickname_value_key', true );
			echo '<strong>'.$value.'</strong>';
			break;

		case 'state':
			$value = get_post_meta( $post_id, '_easy_wp_voting_state_value_key', true );
			echo '<strong>'.$value.'</strong>';
			break;

		case 'age':
			$value = get_post_meta( $post_id, '_easy_wp_voting_age_value_key', true );
			echo '<strong>'.$value.'</strong>';
			break;

		case 'votes':
			$value = get_post_meta( $post_id, '_easy_wp_voting_vote_value_key', true );
			echo '<strong>'.$value.'</strong>';
			break;

		case 'occupation':
			$value = get_post_meta( $post_id, '_easy_wp_voting_occupation_value_key', true );
			echo '<strong>'.$value.'</strong>';
			break;
	}

}

function easy_wp_voting_add_meta_box(){
	add_meta_box( 'easy_wp_voting_nickname', 'Nickname', 'easy_wp_voting_nickname_callback', 'easy-wp-voting', 'normal' );
	add_meta_box( 'easy_wp_voting_age', 'Age', 'easy_wp_voting_age_callback', 'easy-wp-voting', 'normal' );
	add_meta_box( 'easy_wp_voting_votes', 'Number of Votes', 'easy_wp_voting_vote_callback', 'easy-wp-voting', 'normal' );
	add_meta_box( 'easy_wp_voting_state', 'State', 'easy_wp_voting_state_callback', 'easy-wp-voting', 'normal' );
	add_meta_box( 'easy_wp_voting_occupation', 'Occupation', 'easy_wp_voting_occupation_callback', 'easy-wp-voting', 'normal' );
}


function easy_wp_voting_nickname_callback( $post ){
	wp_nonce_field( 'easy_wp_voting_save_nickname_data', 'easy_wp_voting_nickname_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_easy_wp_voting_nickname_value_key', true );

	echo '<label for="easy_wp_voting_nickname_field"> Nick Name </label><br><br> ';
	echo '<input type="text" name="easy_wp_voting_nickname_field" id="easy_wp_voting_nickname_field" value="'. esc_attr( $value ).'" size="25"/>';
}

function easy_wp_voting_vote_callback( $post ){
	wp_nonce_field( 'easy_wp_voting_save_vote_data', 'easy_wp_voting_vote_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_easy_wp_voting_vote_value_key', true );

	echo '<label for="easy_wp_voting_vote_field"> Number of Votes </label><br><br> ';
	echo '<input type="number" name="easy_wp_voting_vote_field" id="easy_wp_voting_vote_field" value="'. esc_attr( $value ).'" size="25"/>';
}

function easy_wp_voting_age_callback( $post ){
	wp_nonce_field( 'easy_wp_voting_save_age_data', 'easy_wp_voting_age_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_easy_wp_voting_age_value_key', true );

	echo '<label for="easy_wp_voting_age_field"> Ages </label><br><br> ';
	echo '<input type="number" name="easy_wp_voting_age_field" id="easy_wp_voting_age_field" value="'. esc_attr( $value ).'" size="25"/>';
}

function easy_wp_voting_state_callback( $post ){
	wp_nonce_field( 'easy_wp_voting_save_state_data', 'easy_wp_voting_state_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_easy_wp_voting_state_value_key', true );

	echo '<label for="easy_wp_voting_state_field"> Name of State </label><br><br> ';
	echo '<input type="text" name="easy_wp_voting_state_field" id="easy_wp_voting_state_field" value="'. esc_attr( $value ).'" size="25"/>';
}

function easy_wp_voting_occupation_callback( $post ){
	wp_nonce_field( 'easy_wp_voting_save_occupation_data', 'easy_wp_voting_occupation_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_easy_wp_voting_occupation_value_key', true );

	echo '<label for="easy_wp_voting_occupation_field"> Occupation </label><br><br> ';
	echo '<input type="text" name="easy_wp_voting_occupation_field" id="easy_wp_voting_occupation_field" value="'. esc_attr( $value ).'" size="25"/>';
}



function easy_wp_voting_save_nickname_data( $post_id ){

	if (! isset( $_POST['easy_wp_voting_nickname_meta_box_nonce'] ) ) {
		 		return;
 	}
	if (! wp_verify_nonce( $_POST['easy_wp_voting_nickname_meta_box_nonce'], 'easy_wp_voting_save_nickname_data' ) ) {
	 		return;
	}
	if ( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if (! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if (! isset( $_POST['easy_wp_voting_nickname_field'] )) {
		return;
	}

 	$my_data = sanitize_text_field( $_POST['easy_wp_voting_nickname_field'] );

 	update_post_meta( $post_id , '_easy_wp_voting_nickname_value_key' , $my_data );

}

function easy_wp_voting_save_age_data( $post_id ){

	if (! isset( $_POST['easy_wp_voting_age_meta_box_nonce'] ) ) {
		 		return;
 	}
	if (! wp_verify_nonce( $_POST['easy_wp_voting_age_meta_box_nonce'], 'easy_wp_voting_save_age_data' ) ) {
	 		return;
	}
	if ( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if (! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if (! isset( $_POST['easy_wp_voting_age_field'] )) {
		return;
	}

 	$my_data = sanitize_text_field( $_POST['easy_wp_voting_age_field'] );

 	update_post_meta( $post_id , '_easy_wp_voting_age_value_key' , $my_data );

}

function easy_wp_voting_save_state_data( $post_id ){

	if (! isset( $_POST['easy_wp_voting_state_meta_box_nonce'] ) ) {
		 		return;
 	}
	if (! wp_verify_nonce( $_POST['easy_wp_voting_state_meta_box_nonce'], 'easy_wp_voting_save_state_data' ) ) {
	 		return;
	}
	if ( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if (! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if (! isset( $_POST['easy_wp_voting_state_field'] )) {
		return;
	}

 	$my_data = sanitize_text_field( $_POST['easy_wp_voting_state_field'] );

 	update_post_meta( $post_id , '_easy_wp_voting_state_value_key' , $my_data );

}

function easy_wp_voting_save_occupation_data( $post_id ){

	if (! isset( $_POST['easy_wp_voting_occupation_meta_box_nonce'] ) ) {
		 		return;
 	}
	if (! wp_verify_nonce( $_POST['easy_wp_voting_occupation_meta_box_nonce'], 'easy_wp_voting_save_occupation_data' ) ) {
	 		return;
	}
	if ( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if (! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if (! isset( $_POST['easy_wp_voting_occupation_field'] )) {
		return;
	}

 	$my_data = sanitize_text_field( $_POST['easy_wp_voting_occupation_field'] );

 	update_post_meta( $post_id , '_easy_wp_voting_occupation_value_key' , $my_data );

}

function easy_wp_voting_save_vote_data( $post_id ){

	if (! isset( $_POST['easy_wp_voting_vote_meta_box_nonce'] ) ) {
		 		return;
 	}
	if (! wp_verify_nonce( $_POST['easy_wp_voting_vote_meta_box_nonce'], 'easy_wp_voting_save_vote_data' ) ) {
	 		return;
	}
	if ( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if (! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if (! isset( $_POST['easy_wp_voting_vote_field'] )) {
		return;
	}

 	$my_data = sanitize_text_field( $_POST['easy_wp_voting_vote_field'] );

 	update_post_meta( $post_id , '_easy_wp_voting_vote_value_key' , $my_data );

}

 