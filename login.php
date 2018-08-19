<?php
$page_title = "Login Page";
$css_page = "<link rel='stylesheet' href='includes/css/login.css'>";
?>
<!doctype html>
<html>
    <?php
        include('includes/head.php');
    ?>
    <body style="padding-top: 64px;">
        <?php include('includes/navbar.php') ?>
        <div class="container">
            <h3 class="login-header">You wanna help or be helped?</h3><br><br><br>
            <div class="row">
                <div class="col-md-4 offset-md-4">
                     <div class="card wanna-help-card" style="width: 100%;">
                         <h3 class="wanna-help-h3">I wanna help</h3>
                         <div class="img-size-div">
                             <a href="login-help.php" role="button">
                                 <img class="card-img-top img-size" src="images/i_wanna_help.jpg" alt="Card image cap">
                             </a>
                         </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 offset-md-4">
                    <a style="text-align:center" href="user-signup.php">Don't you have an accout yet? Click to register!</a>
                </div>
            </div><br><br><br>
            <div class="row mb-5">
                <div class="col-md-4 offset-md-4">
                    <div class="card" style="width: 100%;">
                       <h3 class="login-card-header">I need help</h3>
                       <div class="img-size-div">
                           <a href="login-be-helped.php" role="button">
                              <h3>I want to be helped<img class="card-img-top img-size" src="images/i_want_to_be_helped.jpg" alt="Card image cap"></h3>
                           </a>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include('includes/footer.php');
        ?>
    </body>
</html>