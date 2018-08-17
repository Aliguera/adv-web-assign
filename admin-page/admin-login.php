<?php
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
        //sign user up
        $login = $admin -> login($email, $password);
        if($login == true) {
            //signup succeeded
            echo "login successfull";
        } else {
            //signup failed
            //get the errors and show to user
            echo "login failed";
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
                    <form id="admin-login-form" method="post" action="admin-login.php">
                      <h2>Welcome to the Help People Admin Page!</h2>
                       <h4>Log in to manage Help People Website</h4>
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