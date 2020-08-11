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
                <form class="easy-wp-voting-form" action="#" method="post" id="easy-wp-voting-form" data-form="<?php print get_the_ID(); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                    <input type="email" name="email" id="email" placeholder="Enter your email" class="easy-wp-voting-form-input">
                    <input type="number" name="quantity" id="quantity" placeholder="Number of vote" class="easy-wp-voting-form-input"/>
                    <input type="text" name="amount" id="amount" placeholder="Amount" class="easy-wp-voting-form-input"/>
                    <button type="submit" id="easy-wp-voting-button">Vote</button>
                </form>
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
