<?php
session_start();
//doest allow users to get to the page before logging in
if (!$_SESSION['user_email'] && !$_SESSION['organization_email']) {
    header("location: index.php");
}

$page_title = "About Us Page";
?>
<!doctype html>
<html>
    <?php
        include('includes/head.php');
    ?>
    <body style="padding-top: 64px;">
        <?php include('includes/navbar.php') ?>
    </body>
</html>