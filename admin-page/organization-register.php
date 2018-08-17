<?php
    //include autoloader
    include('../autoloader.php');
    
    //check request method
    //if request is a POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //handle sign up here
        $organization = new Organization();
        //receive post variables from form
        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $abn = $_POST['abn'];
        $address = $_POST['address'];
        //sign user up
        $organization_register = $organization -> create($email, $password, $name, $description, $abn, $address);
        if($organization_register == true) {
            //signup succeeded
            //organization register succeeded
            $message = "You have successfully created your user!";
            $message_class = "success";
        } else {
            //signup failed
            //get the errors and show to user
            $message = implode('', $organization -> errors);
            $message_class = "warning";
        }
    }
?>

<?php
$page_title = "Register Organization Page";
$css_page = "<link rel='stylesheet' href='../includes/css/organization-register.css'>";
?>
<!doctype html>
<html>
    <?php include('head.php') ?>
    <body style="padding-top:64px;">
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
                    <form id="organization-register-form" method="post" action="organization-register.php">
                       <h3>Please fill the following fields to register an organization</h3>
                       <div class="form-group">
                           <label for="email">Email Address</label>
                           <input class="form-control" type="email" name="email" id="email" placeholder="organization@example.com">
                       </div>
                       <div class="form-group">
                           <label for="password">Password</label>
                           <input class="form-control" type="password" name="password" id="password" placeholder="Minimum 6 characters">
                       </div>
                       <div class="form-group">
                           <label>Organization Name</label>
                           <input class="form-control" name="name" id="name" placeholder="Royal Prince Alfred Hospital">
                       </div>
                       <div class="form-group">
                           <label>Description</label>
                           <textarea class="form-control" name="description" id="description" rows="3" placeholder="Type a description about the place here ..."></textarea>
                       </div>
                       <div class="form-group">
                           <label>Abn Number</label>
                           <input class="form-control" name="abn" id="abn" placeholder="49795302391">
                       </div>
                       <div class="form-group">
                           <label>Address</label>
                           <input class="form-control" name="address" id="address" placeholder="28/192 George Street, Sydney">
                       </div>
                       <button class="btn btn-danger" type="submit">Clear</button>
                       <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>