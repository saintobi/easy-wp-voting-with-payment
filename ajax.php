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
    $url = 'https://api.paystack.co/transaction/verify/'.$reference;


      $headers = array(
        'Content-Type'  => 'application/json',
        'Authorization' => 'Bearer ' . get_option( 'ewvwp_paystack_secret_key' ),
      );

      $args = array(
        'headers' => $headers,
        'timeout' => 60,
      );

      $request = wp_remote_get( $url, $args );

      if ( ! is_wp_error( $request ) && 200 === wp_remote_retrieve_response_code( $request ) ) {

        $paystack_response = json_decode( wp_remote_retrieve_body( $request ), true );

        if ( 'success' == $paystack_response['data']['status'] ) {

            $post_status = "publish"; //publish, draft, etc
            $post_type = "ewvwp"; // or whatever post type desired

            /* Attempt to find post id by post name if it exists */
            $found_post = get_post( $userID );
            $found_post_id = $found_post_title->ID;

            if ( FALSE === get_post_status( $found_post ) ) {

              $result = array(
                'success' => false,
                'message' => "Candidate not found"
              );
              return wp_send_json( $result );

            } else {
        
                $vote = get_post_meta($userID, "_ewvwp_vote_value_key", true);

                $total = $vote + $quantity;
                update_post_meta( $userID, '_ewvwp_vote_value_key', $total );

                $result = array(
                  'success' => true,
                  'message' => "Thanks for voting"
                );
              
                $from = "mujhtech@gmail.com";
                $title = "Easy Wp Voting With Payment";
                $headers = "From: $title <$from> \r\n";
                $headers .= "Reply-To: $title <$from> \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $message = "Thanks for voting, we appreciate your votes";

                wp_mail($to, $subject, $message, $headers);
                
                return wp_send_json( $result );
            }



          return wp_send_json($paystack_response);

        } else {

          return wp_send_json(array('success' => false, 'status' => 500, 'message' => 'Payment failed'));

        }
      }


    die();
}
