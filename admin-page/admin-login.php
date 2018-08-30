<?php
    //include autoloader
    include('../autoloader.php');
    if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $admin = new Admin();
        $success = $admin -> authenticate($email, $password);
        if( $success == true) {
            //login successful
            session_start();
            $_SESSION['admin_email'] = $email;
            //redirect user to home page
            header("location: admin-home.php");
        } else {
            $message = 'Wrong credentials supplied';
            $message_class = 'warning';
        }
        
    }
?>

<?php
$page_title = "Help People Admin Page";
$css_page = "<link rel='stylesheet' href='../includes/css/admin-login.css'>";
?>
<!doctype html>
<html>
    <?php
        include('head.php');
    ?>
    <body style="padding-top: 64px;">
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
                    <form id="admin-login-form" method="post" action="admin-login.php">
                      <h2 class="text-center">Welcome to the Help2Day Admin Page</h2>
                       <h4 class="text-center">Log in to manage Help2Day Website</h4>
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