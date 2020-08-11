<?php

/*

    ========================
        AJAX FUNCTIONS
    ========================
*/

add_action('wp_ajax_nopriv_easy_wp_woting_ajax', 'easy_wp_woting_ajax');
add_action('wp_ajax_easy_wp_woting_ajax', 'easy_wp_woting_ajax');

function easy_wp_woting_ajax()
{
    $title = wp_strip_all_tags($_POST['name']);
    $email = wp_strip_all_tags($_POST['email']);
    $message = wp_strip_all_tags($_POST['comment']);
    $country = wp_strip_all_tags($_POST['country']);
    $investment = wp_strip_all_tags($_POST['investment']);
    $risk = wp_strip_all_tags($_POST['risk']);

    $appartment = wp_strip_all_tags($_POST['appartment']);
    $currentExp = wp_strip_all_tags($_POST['currentExp']);
    $investExp = wp_strip_all_tags($_POST['investExp']);
    $moneyExp = wp_strip_all_tags($_POST['moneyExp']);
    $acctType = wp_strip_all_tags($_POST['acctType']);
    $annualSave = wp_strip_all_tags($_POST['annualSave']);
    $cryptoExp = wp_strip_all_tags($_POST['cryptoExp']);
    $citizen = wp_strip_all_tags($_POST['citizen']);
    $portRest = wp_strip_all_tags($_POST['portRest']);


    $otherEight = wp_strip_all_tags($_POST['otherEigth']);
    $otherSeven = wp_strip_all_tags($_POST['otherSeven']);
    $otherSix = wp_strip_all_tags($_POST['otherSix']);
    $otherFive = wp_strip_all_tags($_POST['otherFive']);
    $otherFour = wp_strip_all_tags($_POST['otherFour']);
    $otherThree = wp_strip_all_tags($_POST['otherThree']);
    $otherTwo = wp_strip_all_tags($_POST['otherTwo']);
    $otherOne = wp_strip_all_tags($_POST['otherOne']);
    $investmentAsset = wp_strip_all_tags($_POST['investmentAsset']);
    $ra = wp_strip_all_tags($_POST['ra']);
    $rc = wp_strip_all_tags($_POST['rc']);
    $rd = wp_strip_all_tags($_POST['rd']);
    $io = wp_strip_all_tags($_POST['io']);
    $portfolioOption = wp_strip_all_tags($_POST['porfolioOption']);
    $investPercent = wp_strip_all_tags($_POST['investPercent']);
    $affiliate = wp_strip_all_tags($_POST['affiliate']);
    $networth = wp_strip_all_tags($_POST['networth']);
    $jointAssets = wp_strip_all_tags($_POST['jointAssets']);
    $pJointIncome = wp_strip_all_tags($_POST['pJointIncome']);
    $spouseIncome = wp_strip_all_tags($_POST['spouseIncome']);
    $vote = wp_strip_all_tags($_POST['vote']);
    $grossIncome = wp_strip_all_tags($_POST['grossIncome']);
    $addressB = wp_strip_all_tags($_POST['addressB']);
    $birthdate = wp_strip_all_tags($_POST['birthdate']);
    $otherP = wp_strip_all_tags($_POST['otherP']);
    $occupation = wp_strip_all_tags($_POST['occupation']);
    $dlState = wp_strip_all_tags($_POST['dlState']);
    $phoneB = wp_strip_all_tags($_POST['phoneB']);
    $sOccupation = wp_strip_all_tags($_POST['sOccupation']);
    $sAddressB = wp_strip_all_tags($_POST['sAddressB']);
    $sPhoneB = wp_strip_all_tags($_POST['sPhoneB']);
    $marryStatus = wp_strip_all_tags($_POST['marryStatus']);
    $addressR = wp_strip_all_tags($_POST['addressR']);
    $phone = wp_strip_all_tags($_POST['phone']);





    $post_title = $title;
    $post_status = "publish"; //publish, draft, etc
    $post_type = "client-form"; // or whatever post type desired

    /* Attempt to find post id by post name if it exists */
    $found_post_title = get_page_by_title( $post_title, OBJECT, $post_type );
    $found_post_id = $found_post_title->ID;

    /**********************************************************
    ** Check If Page does not exist, if true, create a new post
    ************************************************************/
    if ( FALSE === get_post_status( $found_post_id ) ) {

      $args = array(
          'post_title' => $title,
          'post_content' => $otherP,
          'post_author' => 1,
          'post_status' => 'publish',
          'post_type' => 'client-form',
          'meta_input' => array(
              '_client_contact_email_value_key' => $email,
              '_client_website_value_key' => $occupation,
              '_client_asset_value_key' => $investmentAsset,
              '_client_appartment_value_key' => $appartment,
              '_client_current_exp_value_key' => $currentExp,
              '_client_money_exp_value_key' => $message,
              '_client_invest_exp_value_key' => $investExp,
              '_client_crypto_exp_value_key' => $cryptoExp,
              '_client_annual_save_value_key' => $annualSave,
              '_client_acct_type_value_key' => $acctType,
              '_client_affiliat_company_value_key' => $affiliate,
              '_client_portfolio_option_value_key' => $porfolioOption,
              '_client_portfolio_restrict_value_key' => $portRest,
              '_client_risk_rate_value_key' => $rc,
              '_client_risk_describe_value_key' => $rd,
              '_client_risk_reaction_value_key' => $ra,
              '_client_invest_objective_value_key' => $io,
              '_client_contact_address_value_key' => $addressR,
              '_client_country_value_key' => $country,
              '_client_telephone_value_key' => $phone,
              '_client_vote_area_value_key' => $vote,
              '_client_driver_licence_value_key', $dlState,
              '_client_citizen_country_value_key' => $citizen,
              '_client_business_name_value_key' => $addressB,
              '_client_business_number_value_key' => $phoneB,
              '_client_spouse_business_name_value_key' => $sAddressB,
              '_client_spouse_number_value_key' => $sPhoneB,
              '_client_spouse_occupation_value_key' => $sOccupation,
              '_client_spouse_status_value_key' => $marryStatus,
              '_client_last_two_income_value_key' => $pJointIncome,
              '_client_gross_income_value_key' => $grossIncome,
              '_client_spouse_income_value_key' => $spouseIncome,
              '_client_birthdate_value_key' => $birthdate,
              '_client_invest_percent_value_key' => $investPercent,
              '_client_net_worth_option_value_key' => $jointAssets,
              '_client_net_worth_value_key' => $networth,
              '_client_investment_asset_value_key' => $investment,
              '_client_risk_value_key' => $risk,
              '_client_other_one_value_key' => $otherOne,
              '_client_other_two_value_key' => $otherTwo,
              '_client_other_three_value_key' => $otherThree,
              '_client_other_four_value_key' => $otherFour,
              '_client_other_five_value_key' => $otherFive,
              '_client_other_six_value_key' => $otherSix,
              '_client_other_seven_value_key' => $otherSeven,
              '_client_other_eight_value_key' => $otherEight,
          ),
       );
       $returned_post_id = wp_insert_post( $args );
       $result = array(
         'success' => true,
         'name' => $title,
         'investment' => $investmentAsset
       );
       return wp_send_json( $result );

    } else {
    /***************************
    ** IF POST EXISTS, update it
    ****************************/

          /* Update post */
          $update_post_args = array(
            'ID'           => $found_post_id,
            'post_title'   => $post_title,
            'post_content' => $otherP,
          );

          /* Update the post into the database */
          wp_update_post( $update_post_args );
          update_post_meta( $found_post_id, '_client_contact_email_value_key', $email );
          update_post_meta( $found_post_id, '_client_risk_value_key', $risk );
          update_post_meta( $found_post_id, '_client_asset_value_key', $investmentAsset );
          update_post_meta( $found_post_id, '_client_website_value_key', $occupation );

          update_post_meta( $found_post_id, '_client_acct_type_value_key', $acctType );
          update_post_meta( $found_post_id, '_client_annual_save_value_key', $annualSave );
          update_post_meta( $found_post_id, '_client_crypto_exp_value_key', $cryptoExp );
          update_post_meta( $found_post_id, '_client_invest_exp_value_key', $investExp );
          update_post_meta( $found_post_id, '_client_money_exp_value_key', $message );
          update_post_meta( $found_post_id, '_client_current_exp_value_key', $currentExp );
          update_post_meta( $found_post_id, '_client_appartment_value_key', $appartment );

          update_post_meta( $found_post_id, '_client_other_one_value_key', $otherOne );
          update_post_meta( $found_post_id, '_client_other_two_value_key', $otherTwo );
          update_post_meta( $found_post_id, '_client_other_three_value_key', $otherThree );
          update_post_meta( $found_post_id, '_client_other_four_value_key', $otherFour );
          update_post_meta( $found_post_id, '_client_other_five_value_key', $otherFive );
          update_post_meta( $found_post_id, '_client_other_six_value_key', $otherSix );
          update_post_meta( $found_post_id, '_client_other_seven_value_key', $otherSeven );
          update_post_meta( $found_post_id, '_client_other_eight_value_key', $otherEight );

          update_post_meta( $found_post_id, '_client_affiliat_company_value_key', $affiliate );
          update_post_meta( $found_post_id, '_client_portfolio_option_value_key', $portfolioOption );
          update_post_meta( $found_post_id, '_client_portfolio_restrict_value_key', $portRest );
          update_post_meta( $found_post_id, '_client_risk_rate_value_key', $ra );
          update_post_meta( $found_post_id, '_client_risk_reaction_value_key', $rc );
          update_post_meta( $found_post_id, '_client_risk_describe_value_key', $rd );
          update_post_meta( $found_post_id, '_client_invest_objective_value_key', $io );

          update_post_meta( $found_post_id, '_client_contact_address_value_key', $addressR );
          update_post_meta( $found_post_id, '_client_country_value_key', $country );

          update_post_meta( $found_post_id, '_client_vote_area_value_key', $vote );
          update_post_meta( $found_post_id, '_client_telephone_value_key', $phone );

          update_post_meta( $found_post_id, '_client_driver_licence_value_key', $dlState );
          update_post_meta( $found_post_id, '_client_citizen_country_value_key', $citizen );
          update_post_meta( $found_post_id, '_client_business_name_value_key', $addressB );
          update_post_meta( $found_post_id, '_client_business_number_value_key', $phoneB );
          update_post_meta( $found_post_id, '_client_spouse_occupation_value_key', $sOccupation );
          update_post_meta( $found_post_id, '_client_spouse_status_value_key', $marryStatus );
          update_post_meta( $found_post_id, '_client_spouse_business_name_value_key', $sAddressB );
          update_post_meta( $found_post_id, '_client_spouse_number_value_key', $sPhoneB );
          update_post_meta( $found_post_id, '_client_gross_income_value_key', $grossIncome );
          update_post_meta( $found_post_id, '_client_last_two_income_value_key', $pJointIncome );
          update_post_meta( $found_post_id, '_client_invest_percent_value_key', $investPercent );
          update_post_meta( $found_post_id, '_client_investment_asset_value_key', $investment );
          update_post_meta( $found_post_id, '_client_spouse_income_value_key', $spouseIncome );
          update_post_meta( $found_post_id, '_client_birthdate_value_key', $birthdate );
          update_post_meta( $found_post_id, '_client_net_worth_value_key', $networth );
          update_post_meta( $found_post_id, '_client_net_worth_option_value_key', $jointAssets );

          $result = array(
            'success' => true,
            'name' => $title,
            'investment' => $investmentAsset
          );
          return wp_send_json( $result );
    }
    die();
}
