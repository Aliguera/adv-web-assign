<?php
session_start();
$page_title = "Help2Day";
$css_page = "<link rel='stylesheet' href='includes/css/index.css'>";
?>
<!doctype html>
<html>
    <?php
        include('includes/head.php');
    ?>
    <body style="padding-top: 64px;">
        <?php
            include('includes/navbar.php');
        ?>
        <div class="jumbotron homePageJumbo">
          <div class="jumboBox">
              <h2 class="display-4">Help to be helped!</h2>
              <p class="lead">There are many people suffering asking for your help, help today to be helped tomorrow!</p>
              <p class="lead">
                <a class="btn btn-primary btn-lg" href="#learn" role="button">Learn more</a>
              </p>
          </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 mb-2">
                    <div class="card" style="width: 18rem;">
                      <div class="img-size-div">
                        <img class="card-img-top img-size step-img" src="images/step1.png" alt="Card image cap">
                      </div>
                      
                      <div class="card-body">
                        <h5 class="card-title">Sign Up</h5>
                        <p class="card-text">Join us to make a difference in others life today!</p>
                      </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="card" style="width: 18rem;">
                      <div class="img-size-div">
                        <img class="card-img-top img-size step-img" src="images/step2.png" alt="Card image cap">
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">View Help List</h5>
                        <p class="card-text">Look for opportunity that you are willing to help and INTERESTED it.</p>
                      </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="card" style="width: 18rem;">
                      <div class="img-size-div">
                        <img class="card-img-top img-size step-img" src="images/step3.png" alt="Card image cap">
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">Reply From Insitution</h5>
                        <p class="card-text">If you have been selected by our institution, a representitive will contact you by email or phone</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-box mt-5">
          <div class="container">
            <h1 class="text-center">Who are we?</h1>
            <div class="row justify-content-center">
              <div class="col-md-4">
                <img src="images/home/about-us-alick.jpg" class="img-fluid" alt="Responsive image">
              </div>
              <div class="col-md-4">
                <img src="images/home/about-us-victor.jpg" class="img-fluid" alt="Responsive image">
              </div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui totam voluptates officiis nisi odio, incidunt tempora. Iure repellat nesciunt molestias eos magnam itaque, eveniet, sed magni ipsam eum perspiciatis repellendus.</p>
          </div>
        </div>
        <div class="container" id="learn">
          <h1 class="text-center needs-help-header">Who needs your help?</h1>
          <div class="needs-help-box">
            <h3 class="text-center">Sick People</h3>
            <img src="images/home/sick-people-home.png" class="rounded-circle" alt="Cinque Terre">
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eligendi ea voluptatibus laudantium, magnam enim praesentium est quam, et vero obcaecati odit voluptas vitae reiciendis qui rem mollitia expedita quod.</p>
          </div>
          <div class="needs-help-box">
            <h3 class="text-center">Poor People</h3>
            <img src="images/home/poor-people-home.jpg" class="rounded-circle" alt="Cinque Terre">
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eligendi ea voluptatibus laudantium, magnam enim praesentium est quam, et vero obcaecati odit voluptas vitae reiciendis qui rem mollitia expedita quod.</p>
          </div>
          <div class="needs-help-box">
            <h3 class="text-center">Old People</h3>
            <img src="images/home/old-people-home.jpg" class="rounded-circle" alt="Cinque Terre">
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab eligendi ea voluptatibus laudantium, magnam enim praesentium est quam, et vero obcaecati odit voluptas vitae reiciendis qui rem mollitia expedita quod.</p>
          </div>
        </div>
        <?php
            include('includes/footer.php');
        ?>
    </body>
    <script src="includes/js/index.js"></script>
</html>