<?php
  session_start();
  //doest allow users to get to the page before logging in
  if (!$_SESSION['organization_email']) {
      header("location: login.php");
  }
  
  //include autoloader
  include('autoloader.php');
  //create instance of products class
  
  $need_id = $_GET['need_id'];
  
  $organization = new Organization();
  $need = $organization -> getNeed($need_id);
  
  $title = $need['title'];
  $description = $need['description'];
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //handle need register here
        $orgns = new Organization();
        //receive post variables from form
        $title = $_POST['title'];
        $description = $_POST['description'];
        $need_id = $_POST['need_id'];
        
        $organizationNeed = $orgns -> updateNeed($need_id, $title, $description);
  
        if ($organizationNeed) {
            header("location: organization-needs.php");
        } else {
            $message = "The need could not be updated, try again later";
            $alert = "warning";
        }
        
  }
  
  
  $page_title = "Edit Need Page";
  $css_page = "<link rel='stylesheet' href='includes/css/organization-edit-need.css'>";
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
                    <form id="organization-need-edit-form" method="post" action="organization-edit-need.php">
                        <input class="d-none" value="<?php echo $need_id ?>" name="need_id">
                       <h3>Register a Need</h3>
                       <div class="form-group">
                           <label for="title">Title</label>
                           <input class="form-control" name="title" id="title" value="<?php echo $title ?>" placeholder="Type the need title E.g Clothes">
                       </div>
                       <div class="form-group">
                           <label>Description</label>
                           <textarea class="form-control" name="description" id="description" rows="3" placeholder="Type a description about the need here ..."><?php echo $description ?></textarea>
                       </div>
                       <button class="btn btn-primary" type="submit">Submit</button>
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