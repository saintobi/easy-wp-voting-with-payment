<?php

/**
 * @package Easy_WP_Voting_With_Payment
 * @version 1.0.0
 */

$args = array(  
    'post_type' => 'easy-wp-voting',
    'post_status' => 'publish',
    'posts_per_page' => 8, 
    'orderby' => 'title', 
    'order' => 'ASC', 
);

$loop = new WP_Query( $args );

?>

<div id="grid">
<?php 
    while ( $loop->have_posts() ) : $loop->the_post();
    $nickname = get_post_meta(get_the_ID(),"_easy_wp_voting_nickname_value_key",true);
    $age = get_post_meta(get_the_ID(),"_easy_wp_voting_age_value_key",true);
    $state = get_post_meta(get_the_ID(),"_easy_wp_voting_state_value_key",true);
    $vote = get_post_meta(get_the_ID(),"_easy_wp_voting_vote_value_key",true);
?>


<div class="product">
        <div class="make3D">
            <div class="product-front">
                <div class="shadow"></div>
                <?php the_post_thumbnail(); ?>
                <div class="image_overlay"></div>
                <div class="view_gallery">Vote Now</div>                
                <div class="stats">        	
                    <div class="stats-container">
                        <span class="product_price"><?php echo $age; ?></span>
                        <span class="product_name"><?php the_title(); ?></span>    
                        <p><?php echo $nickname; ?></p>                                            
                        
                        <div class="product-options">
                            <p><strong>State:</strong> <?php echo $state; ?>
                            <br><strong>Votes:</strong> <?php echo $vote; ?></p>
                        </div>                       
                    </div>                         
                </div>
            </div>
            
            <div class="product-back">
                <div class="shadow"></div>
                <form class="easy-wp-voting-form" onsubmit="return easyWpVotingForm(event, <?php print get_the_ID(); ?>)" action="#" method="post" id="easy-wp-voting-form-<?php print get_the_ID(); ?>" data-form="<?php print get_the_ID(); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                    <input type="email" name="email" id="email-<?php print get_the_ID(); ?>" placeholder="Enter your email" class="easy-wp-voting-form-input">
                    <input type="number" name="quantity" onkeyup="return updateAmount(event, <?php print get_the_ID(); ?>)" id="quantity-<?php print get_the_ID(); ?>" value="1" class="easy-wp-voting-form-input"/>
                    <input type="text" name="amount" id="amount-<?php print get_the_ID(); ?>" placeholder="Amount" class="easy-wp-voting-form-input" readonly/>
                    <button type="submit" id="easy-wp-voting-button">Vote</button>
                </form>
                <small class="text-success form-control-msg easy-wp-voting-form-success-<?php print get_the_ID(); ?>">Vote Successfully submitted, thank you!</small>
                <small class="text-danger form-control-msg easy-wp-voting-form-error-<?php print get_the_ID(); ?>">There was a problem with the Inquiry Form, please try again!</small>
                <div class="flip-back">
                    <div class="cy"></div>
                    <div class="cx"></div>
                </div>
            </div>	  
        </div>	
    </div>  


<?php endwhile; ?>

</div>
<?php
wp_reset_postdata(); 

?>
 <script src="https://js.paystack.co/v1/inline.js"></script>
<script>

    function updateAmount(event, formid){

        var amount = $('#amount-'+formid).val();
        var quantity = event.target.value;

        var total = quantity * <?php echo get_option('easy_wp_voting_min_amount'); ?>;
        $("#amount-"+formid).val(total);

    }

    function easyWpVotingForm(event, formid){
        event.preventDefault();
        var amount = $('#amount-'+formid).val();
        var quantity = parseInt($('#quantity-'+formid).val());
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        var email = $("#email-"+formid).val();


        var handler = PaystackPop.setup({
            key: '<?php echo get_option( 'easy_wp_voting_paystack_public_key' ); ?>', // Replace with your public key
            email: email,
            amount: total * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
            currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
            //firstname: document.getElementById('first-name').value,
            //lastname: document.getElementById('first-name').value,
            reference: 'Easy Wp Voting', // Replace with a reference you generated
            callback: function(response) {
            //this happens after the payment is completed successfully
            var reference = response.reference;
            $.ajax({
                url : ajaxurl,
                type : 'post',
                dataType: 'json',
                data : {

                    quantity : quantity,
                    userID : formid,
                    reference: reference,
                    action: 'easy_wp_voting_form_ajax'

                },
                success : function( response ){
                        
                        if(response.success == true){
                            $('#easy-wp-voting-form-'+formid).css('display', 'none');
                            $('.easy-wp-voting-form-success-'+formid).css({'display':'block', 'margin':'0 auto 100px'})
                        } else {
                            console.log(response.message);
                            alert(response.message);
                        }

                }

            });
            },
            onClose: function() {
            alert('Transaction was not completed, window closed.');
            },
        });
        handler.openIframe();
        
    }

</script>
