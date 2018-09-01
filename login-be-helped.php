<?php
    //include autoloader
    include('autoloader.php');
    if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $organization = new Organization();
        $success = $organization -> authenticate($email, $password);
        if( $success == true) {
            //login successful
            session_start();
            $_SESSION['organization_email'] = $email;
            //redirect user to home page
            header("location: index.php");
        } else {
            $message = 'Wrong credentials supplied';
            $message_class = 'warning';
        }
    }
?>

<?php
$page_title = "Signin to be helped";
$css_page = "<link rel='stylesheet' href='includes/css/login-be-helped.css'>";
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
                            echo "<div class=\"alert alert-$message_class alert-dismissable fade show mt-3\">
                                    $message
                                    <button class=\"close\" data-dismiss=\"alert\"&times;>
                                        
                                    </button>
                                </div>";
                        }
                    ?>
                    <form id="signup-form" method="post" action="login-be-helped.php">
                       <h3>Log in to be Helped</h3>
                       <div class="form-group">
                           <label for="email">Email Address</label>
                           <input class="form-control" type="email" name="email" id="email" placeholder="you@example.com">
                       </div>
                       <div class="form-group">
                           <label for="password">Password</label>
                           <input class="form-control" type="password" name="password" id="password" placeholder="Type your password">
                       </div>
                       <button class="btn btn-danger" type="submit">Clear</button>
                       <button class="btn btn-primary" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
            include('includes/footer.php');
        ?>
    </body>
</html>