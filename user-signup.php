<?php
    //include autoloader
    include('autoloader.php');
    
    //check request method
    //if request is a POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //handle sign up here
        $account = new Account();
        //receive post variables from form
        $email = $_POST['email'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        //sign user up
        $signup = $account -> create($email, $password, $fullname);
        if($signup == true) {
            //signup succeeded
            //start session
            session_start();
            //create session variable with user's email
            $_SESSION['email'] = $email;
            //show success message
            $message = "Your account has been created!";
            $message_class = "success";
            header("location: index.php");
        } else {
            //signup failed
            $message = implode('', $account -> errors);
            $message_class = 'warning';
            //get the errors and show to user
        }
    }
?>

<?php
$page_title = "Login Page";
$css_page = "<link rel='stylesheet' href='includes/css/user-signup.css'>";
?>
<!doctype html>
<html>
    <?php include('includes/head.php') ?>
    <body style="padding-top:64px;">
        <?php include('includes/navbar.php') ?>
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
                    <form id="user-signup-form" method="post" action="user-signup.php">
                       <h3>Sign up and start helpping people</h3>
                       <div class="form-group">
                           <label for="email">Email Address</label>
                           <input class="form-control" type="email" name="email" id="email" placeholder="you@example.com">
                       </div>
                       <div class="form-group">
                           <label for="password">Password</label>
                           <input class="form-control" type="password" name="password" id="password" placeholder="Minimum 6 characters">
                       </div>
                       <div class="form-group">
                           <label>Full Name</label>
                           <input class="form-control" name="fullname" id="fullname" placeholder="Alick Liu">
                       </div>
                       <button class="btn btn-danger" type="submit">Clear</button>
                       <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>