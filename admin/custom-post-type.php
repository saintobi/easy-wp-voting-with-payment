<?php

/**
 * @package Easy_WP_Voting_With_Payment
 * @version 1.0.0
 */

@ob_start();
add_action( 'init', 'ewvwp_custom_post_type' );
add_filter( 'manage_ewvwp_posts_columns', 'ewvwp_set_columns_name' );
add_action( 'manage_ewvwp_posts_custom_column', 'ewvwp_custom_columns', 10, 2 );
add_action( 'add_meta_boxes', 'ewvwp_add_meta_box' );
add_action( 'save_post', 'ewvwp_save_nickname_data' );
add_action( 'save_post', 'ewvwp_save_age_data' );
add_action( 'save_post', 'ewvwp_save_state_data' );
add_action( 'save_post', 'ewvwp_save_occupation_data' );
add_action( 'save_post', 'ewvwp_save_vote_data' );

add_filter('gettext','custom_enter_title');

add_action( 'wp_loaded', 'wpse_19240_change_place_labels', 20 );

function custom_enter_title( $input ) {

    global $post_type;

    if( is_admin() && 'Add title' == $input && 'ewvwp' == $post_type )
        return 'Enter Fullname';

    return $input;
}


function wpse_19240_change_place_labels()
{
    $p_object = get_post_type_object( 'ewvwp' );

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


	function ewvwp_custom_post_type(){
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

		register_post_type( 'ewvwp', $args );
	}

	function ewvwp_set_columns_name( $columns ) {
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


function ewvwp_custom_columns( $columns, $post_id ) {

	switch ( $columns ) {
		case 'nickname':
			$value = get_post_meta( $post_id, '_ewvwp_nickname_value_key', true );
			echo '<strong>'.$value.'</strong>';
			break;

		case 'state':
			$value = get_post_meta( $post_id, '_ewvwp_state_value_key', true );
			echo '<strong>'.$value.'</strong>';
			break;

		case 'age':
			$value = get_post_meta( $post_id, '_ewvwp_age_value_key', true );
			echo '<strong>'.$value.'</strong>';
			break;

		case 'votes':
			$value = get_post_meta( $post_id, '_ewvwp_vote_value_key', true );
			echo '<strong>'.$value.'</strong>';
			break;

		case 'occupation':
			$value = get_post_meta( $post_id, '_ewvwp_occupation_value_key', true );
			echo '<strong>'.$value.'</strong>';
			break;
	}

}

function ewvwp_add_meta_box(){
	add_meta_box( 'ewvwp_nickname', 'Nickname', 'ewvwp_nickname_callback', 'ewvwp', 'normal' );
	add_meta_box( 'ewvwp_age', 'Age', 'ewvwp_age_callback', 'ewvwp', 'normal' );
	add_meta_box( 'ewvwp_votes', 'Number of Votes', 'ewvwp_vote_callback', 'ewvwp', 'normal' );
	add_meta_box( 'ewvwp_state', 'State', 'ewvwp_state_callback', 'ewvwp', 'normal' );
	add_meta_box( 'ewvwp_occupation', 'Occupation', 'ewvwp_occupation_callback', 'ewvwp', 'normal' );
}


function ewvwp_nickname_callback( $post ){
	wp_nonce_field( 'ewvwp_save_nickname_data', 'ewvwp_nickname_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_ewvwp_nickname_value_key', true );

	echo '<label for="ewvwp_nickname_field"> Nick Name </label><br><br> ';
	echo '<input type="text" name="ewvwp_nickname_field" id="ewvwp_nickname_field" value="'. esc_attr( $value ).'" size="25"/>';
}

function ewvwp_vote_callback( $post ){
	wp_nonce_field( 'ewvwp_save_vote_data', 'ewvwp_vote_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_ewvwp_vote_value_key', true );

	$final_value = (!empty($value)) ? $value : 0;

	echo '<label for="ewvwp_vote_field"> Number of Votes </label><br><br> ';
	echo '<input type="number" name="ewvwp_vote_field" id="ewvwp_vote_field" readonly value="'. esc_attr( $final_value ).'" size="25"/>';
}

function ewvwp_age_callback( $post ){
	wp_nonce_field( 'ewvwp_save_age_data', 'ewvwp_age_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_ewvwp_age_value_key', true );

	echo '<label for="ewvwp_age_field"> Ages </label><br><br> ';
	echo '<input type="number" name="ewvwp_age_field" id="ewvwp_age_field" value="'. esc_attr( $value ).'" size="25"/>';
}

function ewvwp_state_callback( $post ){
	wp_nonce_field( 'ewvwp_save_state_data', 'ewvwp_state_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_ewvwp_state_value_key', true );

	echo '<label for="ewvwp_state_field"> Name of State </label><br><br> ';
	echo '<input type="text" name="ewvwp_state_field" id="ewvwp_state_field" value="'. esc_attr( $value ).'" size="25"/>';
}

function ewvwp_occupation_callback( $post ){
	wp_nonce_field( 'ewvwp_save_occupation_data', 'ewvwp_occupation_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_ewvwp_occupation_value_key', true );

	echo '<label for="ewvwp_occupation_field"> Occupation </label><br><br> ';
	echo '<input type="text" name="ewvwp_occupation_field" id="ewvwp_occupation_field" value="'. esc_attr( $value ).'" size="25"/>';
}



function ewvwp_save_nickname_data( $post_id ){

	if (! isset( $_POST['ewvwp_nickname_meta_box_nonce'] ) ) {
		 		return;
 	}
	if (! wp_verify_nonce( $_POST['ewvwp_nickname_meta_box_nonce'], 'ewvwp_save_nickname_data' ) ) {
	 		return;
	}
	if ( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if (! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if (! isset( $_POST['ewvwp_nickname_field'] )) {
		return;
	}

 	$my_data = sanitize_text_field( $_POST['ewvwp_nickname_field'] );

 	update_post_meta( $post_id , '_ewvwp_nickname_value_key' , $my_data );

}

function ewvwp_save_age_data( $post_id ){

	if (! isset( $_POST['ewvwp_age_meta_box_nonce'] ) ) {
		 		return;
 	}
	if (! wp_verify_nonce( $_POST['ewvwp_age_meta_box_nonce'], 'ewvwp_save_age_data' ) ) {
	 		return;
	}
	if ( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if (! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if (! isset( $_POST['ewvwp_age_field'] )) {
		return;
	}

 	$my_data = sanitize_text_field( $_POST['ewvwp_age_field'] );

 	update_post_meta( $post_id , '_ewvwp_age_value_key' , $my_data );

}

function ewvwp_save_state_data( $post_id ){

	if (! isset( $_POST['ewvwp_state_meta_box_nonce'] ) ) {
		 		return;
 	}
	if (! wp_verify_nonce( $_POST['ewvwp_state_meta_box_nonce'], 'ewvwp_save_state_data' ) ) {
	 		return;
	}
	if ( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if (! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if (! isset( $_POST['ewvwp_state_field'] )) {
		return;
	}

 	$my_data = sanitize_text_field( $_POST['ewvwp_state_field'] );

 	update_post_meta( $post_id , '_ewvwp_state_value_key' , $my_data );

}

function ewvwp_save_occupation_data( $post_id ){

	if (! isset( $_POST['ewvwp_occupation_meta_box_nonce'] ) ) {
		 		return;
 	}
	if (! wp_verify_nonce( $_POST['ewvwp_occupation_meta_box_nonce'], 'ewvwp_save_occupation_data' ) ) {
	 		return;
	}
	if ( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if (! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if (! isset( $_POST['ewvwp_occupation_field'] )) {
		return;
	}

 	$my_data = sanitize_text_field( $_POST['ewvwp_occupation_field'] );

 	update_post_meta( $post_id , '_ewvwp_occupation_value_key' , $my_data );

}

function ewvwp_save_vote_data( $post_id ){

	if (! isset( $_POST['ewvwp_vote_meta_box_nonce'] ) ) {
		 		return;
 	}
	if (! wp_verify_nonce( $_POST['ewvwp_vote_meta_box_nonce'], 'ewvwp_save_vote_data' ) ) {
	 		return;
	}
	if ( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if (! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if (! isset( $_POST['ewvwp_vote_field'] )) {
		return;
	}

 	$my_data = sanitize_text_field( $_POST['ewvwp_vote_field'] );

 	update_post_meta( $post_id , '_ewvwp_vote_value_key' , $my_data );

}

 