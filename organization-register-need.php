<?php
  session_start();
  //doest allow users to get to the page before logging in
  if (!$_SESSION['organization_email']) {
      header("location: login.php");
  }
  
  //include autoloader
  include('autoloader.php');
  //create instance of products class
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //handle need register here
        $orgns = new Organization();
        //receive post variables from form
        $title = $_POST['title'];
        $description = $_POST['description'];
        
        $organizationNeed = $orgns -> addNeed($title, $description);
  
        if ($organizationNeed) {
            $message = "The need has been succesfully created";
            $alert = "success";
        } else {
            $message = "The need could not be created, try again later";
            $alert = "warning";
        }
        
  }
  
  
  $page_title = "Register Need Page";
  $css_page = "<link rel='stylesheet' href='includes/css/organization-register-need.css'>";
  ?>
<!doctype html>
<html>
    <?php
        include('includes/head.php');
    ?>
    <body style="padding-top: 64px;">
        <?php include('includes/navbar.php') ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <?php
                    
                        if( $message ) {
                            echo "  
                                    <div class=\"alert alert-$alert\" role=\"alert\">
                                        $message
                                    </div>
                                 ";
                        }
                    
                    ?>
                    <form id="organization-need-form" method="post" action="organization-register-need.php">
                       <h3>Register a Need</h3>
                       <div class="form-group">
                           <label for="title">Title</label>
                           <input class="form-control" name="title" id="title" placeholder="Type the need title E.g Clothes">
                       </div>
                       <div class="form-group">
                           <label>Description</label>
                           <textarea class="form-control" name="description" id="description" rows="3" placeholder="Type a description about the need here ..."></textarea>
                       </div>
                       <button class="btn btn-primary" type="submit">Add need</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
            include('includes/footer.php');
        ?>
    </body>
    <script src="includes/js/organization-needs.js"></script>
</html>