if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
      
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