<?php
$page_title = "Help People";
$css_page = "<link rel='stylesheet' href='includes/css/login-help.css'>";
?>
<!doctype html>
<html>
    <?php include('includes/head.php') ?>
    <body style="padding-top:64px;">
        <?php include('includes/navbar.php') ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form id="signup-form" method="post" action="signup.php">
                       <h3>Log in to Help</h3>
                       <div class="form-group">
                           <label for="email">Email Address</label>
                           <input class="form-control" type="email" name="email" id="email" placeholder="you@example.com">
                       </div>
                       <div class="form-group">
                           <label for="password">Password</label>
                           <input class="form-control" type="password" name="password" id="password" placeholder="Minimum 6 characters">
                       </div>
                       <button class="btn btn-danger" type="submit">Clear</button>
                       <button class="btn btn-primary" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>