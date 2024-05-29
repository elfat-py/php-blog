<?php
    require_once 'includes/header.php';

?>

    <div class="about_page">
        <section class="about">
            <div class="main_about">
                <img src="includes/src/quote.png" alt="Elfat Memaj">
                <div class="about-text">
                    <h1>WeBlog</h1>
                    <h3 class="fw-lighter">Get inspired <span class="fw-light">&& inspire</span></h3>
                    <p>
                        Welcome to BlogSphere, the ultimate destination for aspiring bloggers!
                        At BlogSphere, we believe everyone has a story to tell and a unique perspective to share.
                        Our platform is designed to make blogging accessible and enjoyable for everyone,
                        from novices to seasoned writers. With user-friendly tools, a supportive community,
                        and a plethora of resources, BlogSphere helps you turn your thoughts into captivating blog posts.
                        Whether you're passionate about travel, cooking, technology, or personal experiences,
                        BlogSphere empowers you to express yourself and connect with like-minded individuals.
                        Join us today and start your blogging journey with BlogSphere!
                    </p>
                    <button type="button">Got something to show?</button>
                    <button type="button" class="cv">Other products</button>
                </div>
            </div>
        </section>
    </div>

<?php

if (isset($_SESSION['sessionId'])) {
    echo '<h3 class="notify">You are home</h3>>';
}
else{
    echo '<h3 class="notify">Please login to proceed!</h3>';
}
?>
<?php
require_once 'includes/footer.php';
?>