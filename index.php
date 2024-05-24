<?php
    require_once 'includes/header.php';

?>


<?php

if (isset($_SESSION['sessionId'])) {
    echo '<h1 class="notify">You are home</h1>>';
}
else{
    echo '<h1 class="notify">Please login to proceed!</h1>';

}
?>
    <div class="about_page">
        <section class="about">
            <div class="main_about">
                <img src="includes/src/quote.png" alt="Elfat Memaj">
                <div class="about-text">
                    <h1>Ideology</h1>
                    <h3>Provide for all <span>the best they can get</span></h3>
                    <p>
                        As of today's world every company or person that deals with direct selling main goal is to
                        maximize the profit and get the most of their costumers. We don't think the same, providing the
                        customer the
                        best deal and letting them know the differences from a store to another and from a product to
                        another is a must.
                        That is our motto to show the difference and let the customer get the best deal they can get!!!
                    </p>
                    <button type="button">Got something to show?</button>
                    <button type="button" class="cv">Other products</button>
                </div>
            </div>
        </section>
    </div>
<?php
require_once 'includes/footer.php';
?>