<?php
session_start();
//doest allow users to get to the page before logging in
if (!$_SESSION['admin_email']) {
    header("location: admin-login.php");
}
//redirect user to home page

$page_title = "Help People Admin Page";
$css_page = "<link rel='stylesheet' href='../includes/css/admin-home.css'>";
?>
<!doctype html>
<html>
    <?php
        include('head.php');
    ?>
    <body style="padding-top: 64px;">
        <?php include('../includes/admin-navbar.php') ?>
        <div class="container-fluid">
            <h1>Welcome to Help2Day Admin Page</h1>
            <br><br>
            <h3>Registration</h3>
            <hr>
            <a href="organization-register.php" class="form-group" ><button type="button" class="btn btn-primary btn-lg">Register Company</button></a>
            <a href="admin-register.php" class="form-group" ><button type="button" class="btn btn-secondary btn-lg">Register Admin</button></a>
            <br><br><br><br>
            <h3>Website Information</h3>
            <hr>
            <div class="form-inline">
                <h4>Status:</h4>
                <p class="webStatus">Online</p>
            </div>
            
        </div>
    </body>
</html>