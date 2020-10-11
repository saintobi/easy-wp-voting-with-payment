    <style>
        .tp-vote-container {
            margin: 20px;
            padding:20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            grid-gap: 1rem;
            justify-content: center;
        }

        .vote-item{
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 1px solid rgb(115, 187, 8);
            
            
            
        }

        .vote-item img{
            max-width:320px;
            padding:20px;
            border-radius: 5px;
        }

        .vote-item span{
            padding-bottom:10px;
            font-size: 25px;
        }

        .vote-item a{
            padding-bottom:20px;
            background-color: rgb(129, 204, 18);
            padding-top:10px;
            width:100%;
            text-decoration: none;
            text-align: center;
            display: flex;
            flex-direction: column;
            color: white;
            font-size: 24px;
            font-weight: bold;

        }

        .vote-item a:hover{
            
            background-color: rgb(104, 170, 4);
            
        }

        section.tp-search-bar {
            margin-top:30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        section.tp-search-bar input{
            width:50%;
            padding: 15px;
            padding-left:10px;
            border-radius: 5px;
            border:1px solid grey;
        }

        section.tp-search-bar button{
            
            padding: 15px;
            margin-left: 10px;
            color: white;
            background-color: rgb(133, 209, 18);
            border: 1px solid grey;
            border-radius: 5px;
            
        }

        section.tp-search-bar button:hover{
            cursor: pointer;
            
            background-color: rgb(104, 170, 4);
        }

        .ewvwp-modal {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: scale(1.1);
            transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
        }

        .ewvwp-modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 1rem 1.5rem;
            width: 24rem;
            border-radius: 0.5rem;
        }

        .ewvwp-close-button {
            float: right;
            width: 1.5rem;
            line-height: 1.5rem;
            text-align: center;
            cursor: pointer;
            border-radius: 0.25rem;
            background-color: rgb(206, 235, 197);
        }

        .ewvwp-close-button:hover {
            background-color: rgb(244, 247, 243);
        }

        .ewvwp-show-modal {
            opacity: 1;
            visibility: visible;
            transform: scale(1.0);
            transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
        }

        .ewvwp-modal-content div{
            display:flex;
            flex-direction: column;
            padding-top: 35px;
            padding-bottom: 25px;

        }

        
        .ewvwp-modal-content div input{
            width: 100%;
            padding: 15px;
            padding-left: 10px;
            border-radius: 5px;
            border: 1px solid grey;
            margin-bottom: 10px;
        }


    </style>


    <section class="tp-search-bar">
        <!-- Add an Ajax search Functionality Here so people can search for participants  -->
        <input type="text" placeholder="Search For a Participant...">
        <button>Search</button>
    </section>

    <section class="tp-vote-container">
    

    <?php 
        while ( $loop->have_posts() ) : $loop->the_post();
        $nickname = get_post_meta(get_the_ID(),"_ewvwp_nickname_value_key",true);
        $age = get_post_meta(get_the_ID(),"_ewvwp_age_value_key",true);
        $state = get_post_meta(get_the_ID(),"_ewvwp_state_value_key",true);
        $vote = get_post_meta(get_the_ID(),"_ewvwp_vote_value_key",true);
    ?>

    

        <div class="vote-item">
            <?php the_post_thumbnail(); ?>
            <span><?php the_title(); ?></span>
            <a class="ewvwp-trigger" id="vote-<?php print get_the_ID(); ?>" onclick="return easyWVWPMForm(<?php print get_the_ID(); ?>)">Vote Now</a>
        </div>

    

        <?php endwhile; ?>
    </section>
    <div class="ewvwp-modal">
        <div class="ewvwp-modal-content">
            <span class="ewvwp-close-button">&times;</span>
            <div>
                <form method="post" action="#">
                    <input placeholder="Enter your Email" type="text">
                    <input type="number" placeholder="Amount">
                    <input value="10" readonly type="text">
                    <input type="submit" name="vote" value="Vote">
                </form>
            </div>
        </div>
    </div>
    <script>
            // MODAL BOX JS
        var modal = document.querySelector(".ewvwp-modal");
        var trigger = document.querySelector(".ewvwp-trigger");
        var closeButton = document.querySelector(".ewvwp-close-button");

        function toggleModal() {
            modal.classList.toggle("ewvwp-show-modal");
        }

        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal();
            }
        }

        function easyWVWPMForm(id){
            toggleModal();
        }

        //trigger.addEventListener("click", toggleModal);
        closeButton.addEventListener("click", toggleModal);
        //window.addEventListener("click", windowOnClick);

    </script>
<?php
wp_reset_postdata(); 

?>