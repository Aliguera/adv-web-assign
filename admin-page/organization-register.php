<?php
    session_start();
    //doest allow users to get to the page before logging in
    if (!$_SESSION['admin_email']) {
        header("location: admin-login.php");
    }
    //include autoloader
    include('../autoloader.php');
    
    //check request method
    // if request is a POST request
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
        $phone = $_POST['phone'];
        $org_image = $_FILES['org_image'];
        
        $target_dir = "../images/organizations/profile_image/";
        $target_file = $target_dir . basename($_FILES["org_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["org_image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        
        if (move_uploaded_file($_FILES["org_image"]["tmp_name"], $target_file)) {
            
        } else {
            
        }
        
        //sign user up
        $organization_register = $organization -> create($email, $password, $name, $description, $abn, $address, $org_image, $phone);
        if($organization_register == true) {
            //signup succeeded
            //organization register succeeded
            $message = "You have successfully registered an organization!";
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
                    <form id="organization-register-form" method="post" enctype="multipart/form-data" action="organization-register.php">
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
                       <div class="form-group">
                           <label>Phone</label>
                           <input class="form-control" name="phone" id="phone" placeholder="+61 477777777">
                       </div>
                       <div class="form-group">
                           <label>Organization Profile Picture</label>
                           <input type="file" name="org_image" id="org_image">
                       </div>
                       <button class="btn btn-danger" type="submit">Clear</button>
                       <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>