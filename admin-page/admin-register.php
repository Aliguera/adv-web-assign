<?php
    session_start();
    //doest allow users to get to the page before logging in
    if (!$_SESSION['admin_email']) {
        header("location: admin-login.php");
    }
    //include autoloader
    include('../autoloader.php');
    
    //check request method
    //if request is a POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //handle sign up here
        $admin = new Admin();
        //receive post variables from form
        $email = $_POST['email'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        //sign user up
        $admin_register = $admin -> create($email, $password, $fullname);
        if($admin_register == true) {
            //company register succeeded
            //show success message
            $message = "Your account has been created!";
            $message_class = "success";
        } else {
            //signup failed
            $message = implode('', $admin -> errors);
            $message_class = 'warning';
            //get the errors and show to user
        }
    }
?>

<?php
$page_title = "Admin Register Page";
$css_page = "<link rel='stylesheet' href='../includes/css/company-register.css'>";
?>
<!doctype html>
<html>
    <?php include('head.php') ?>
    <body style="padding-top:64px;">
        <?php include('../includes/admin-navbar.php') ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <?php
                    
                        if( $message ) {
                            echo "  
                                    <div class=\"alert alert-$message_class\" role=\"alert\">
                                        $message
                                    </div>
                                 ";
                        }
                    
                    ?>
                    <form id="admin-register-form" method="post" action="admin-register.php">
                       <h3>Please fill the following fields to register a company</h3>
                       <div class="form-group">
                           <label for="email">Email Address</label>
                           <input class="form-control" type="email" name="email" id="email" placeholder="company@example.com">
                       </div>
                       <div class="form-group">
                           <label for="password">Password</label>
                           <input class="form-control" type="password" name="password" id="password" placeholder="Minimum 6 characters">
                       </div>
                       <div class="form-group">
                           <label>Fullname</label>
                           <input class="form-control" name="fullname" id="fullname" placeholder="Admin Alick Liu">
                       </div>
                       <button class="btn btn-danger" type="submit">Clear</button>
                       <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>