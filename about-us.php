<?php
    session_start();
    //doest allow users to get to the page before logging in
    // if (!$_SESSION['user_email'] && !$_SESSION['organization_email']) {
    //     header("location: index.php");
    // }

    $page_title = "About Us Page";
    $css_page = "<link rel='stylesheet' href='includes/css/about-us.css'>";
?>
<!doctype html>
<html>
    <?php
        include('includes/head.php');
    ?>
    <body style="padding-top: 64px;">
        <?php include('includes/navbar.php') ?>
        <!--start working here-->

    <div class="about-us-panel">
        <div>
            <h1 class="set-text-middle">Our Mission</h1>
            <p class="set-text-middle">Let's make a difference in others life from today.</p>
        </div>
        <div>
            <h1 class="set-text-middle">About</h1>
            <p>At Help2day, we all come to work every day because we want to solve the biggest problem in our community.</p>
            <img src="/images/can_help.jpg" width='700'>
        </div>

    </div>

    <div class="about-us-panel">
        <h1 class="set-text-middle">Leadership</h1>
        <br>
        <div class="row">
            <div class="col-md-6">
                <img class="img rounded" src="images/home/about-us-alick.jpg">
                <h3 class="set-text-middle">Alick</h3>
                <p class="set-text-middle">Bachelor of Information Technology</p>
                <br>
                <p>I am a </p>
                <h4 class="set-text-middle" >Social Network</h4>
                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" class="fa fa-instagram"></a>
                &nbsp;&nbsp;
                <a href="#" class = "fa fa-linkedin"></a>

            </div>
            <div class="col-md-6">
                <img class="img rounded" src="images/home/about-us-victor.jpg">
                <h3 class="set-text-middle">Victor</h3>
                <p class="set-text-middle">Bachelor of Information Technology</p>
                <br>
                <p>I am a 19 year old Web Programmer and Designer based in Sydney.
                I have 2 year of experiences in Web Development and have built products both
                on my own and on a team. Currently, I am a designer and programmer at Help2day,
                where I build products to help people.
                </p>
                <h4 class="set-text-middle" >Social Network</h4>
                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" class="fa fa-instagram"> Instagram</a>
                &nbsp;&nbsp;
                <a href="#" class = "fa fa-linkedin"> Linkedin</a>

            </div>
        </div>

    </div>


    </body>
    <?php
        include('includes/footer.php');
    ?>
</html>