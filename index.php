<?php
session_start();
$page_title = "Help People";
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
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
              </p>
          </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-2">
                    <div class="card" style="width: 18rem;">
                      <img class="card-img-top" src="images/jumb.png" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title">Step 1</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="card" style="width: 18rem;">
                      <img class="card-img-top" src="images/jumb.png" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title">Step 2</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="card" style="width: 18rem;">
                      <img class="card-img-top" src="images/jumb.png" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title">Step 3</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>