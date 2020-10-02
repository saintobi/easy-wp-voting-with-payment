<?php

/*

    ========================
        AJAX FUNCTIONS
    ========================
*/

add_action('wp_ajax_nopriv_ewvwp_form_ajax', 'ewvwp_ajax');
add_action('wp_ajax_ewvwp_form_ajax', 'ewvwp_ajax');

function ewvwp_ajax()
{
    $quantity = intval($_POST['quantity']);
    $userID = intval($_POST['userID']);
    $reference = sanitize_text_field($_POST['reference']);
    $email = sanitize_email($_POST['email']);

//The parameter after verify/ is the transaction reference to be verified
    $bearer = "Bearer ".get_option( 'ewvwp_paystack_secret_key' )."";
    $url = 'https://api.paystack.co/transaction/verify/'.$reference;
    $args = array(
          'headers' => array(
              'Authorization' => $bearer )
          );
    $response =  wp_remote_get( $url, $args );
    
    return wp_send_json( json_decode( $response, true) );
    //$result = array();

    //if ($request) {
      //$result = json_decode($response, true);
    //}

    //return wp_send_json( $result );



    die();
}
