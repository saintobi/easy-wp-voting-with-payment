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
    $nickname = get_term_meta(get_the_ID(),"_easy_wp_voting_nickname_value_key",true);
?>


<div class="product">
        <div class="make3D">
            <div class="product-front">
                <div class="shadow"></div>
                <?php the_post_thumbnail(); ?>
                <div class="image_overlay"></div>
                <div class="view_gallery">Vote</div>                
                <div class="stats">        	
                    <div class="stats-container">
                        <span class="product_price">$39</span>
                        <span class="product_name"><?php the_title(); ?></span>    
                        <p><?php echo $nickname; ?></p>                                            
                        
                        <div class="product-options">
                        <strong>SIZES</strong>
                        <span>XS, S, M, L, XL, XXL</span>
                    </div>                       
                    </div>                         
                </div>
            </div>
            
            <div class="product-back">
                <div class="shadow"></div>
                <form class="form-group">
                    <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control">
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
