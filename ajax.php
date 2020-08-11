<?php

/*

    ========================
        AJAX FUNCTIONS
    ========================
*/

add_action('wp_ajax_nopriv_easy_wp_voting_form_ajax', 'easy_wp_voting_ajax');
add_action('wp_ajax_easy_wp_voting_form_ajax', 'easy_wp_voting_ajax');

function easy_wp_voting_ajax()
{
    $quantity = wp_strip_all_tags($_POST['quantity']);
    $userID = wp_strip_all_tags($_POST['userID']);
    $reference = wp_strip_all_tags($_POST['reference']);
    $email = wp_strip_all_tags($_POST['email']);

//The parameter after verify/ is the transaction reference to be verified
    $url = 'https://api.paystack.co/transaction/verify/'.$reference;
    $ch = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$reference,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ".get_option( 'easy_wp_voting_paystack_public_key' ),
        "Cache-Control: no-cache",
      ),
    ));

    //send request
    $request = curl_exec($ch);
    //close connection
    curl_close($ch);
    //declare an array that will contain the result 
    $result = array();

    if ($request) {
      $result = json_decode($request, true);
    }

    if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
      
      $post_status = "publish"; //publish, draft, etc
      $post_type = "easy-wp-voting"; // or whatever post type desired

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
        
            $vote = get_post_meta($userID, "_easy_wp_voting_vote_value_key", true);

            $total = $vote + $quantity;
            update_post_meta( $userID, '_easy_wp_voting_vote_value_key', $total );

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

			mail($to, $subject, $message, $headers);
          
            return wp_send_json( $result );
      }

    } else {

      $result = array(
        'success' => false,
        'message' => "Transaction not successful"
      );
      return wp_send_json( $result );

    }

    die();
}
