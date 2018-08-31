<?php
  session_start();
  //doest allow users to get to the page before logging in
  if (!$_SESSION['organization_email']) {
      header("location: login.php");
  }
  $id = $_GET['id'];
  //include autoloader
  include('autoloader.php');
  //   //create instance of organization class
  $orgns = new Organization();
  $organization_details = $orgns -> getOrganizationDetails($id);
  
  $organization_needs = $orgns -> getOrganizationNeeds($id);
  
  // 
  //             foreach( $organization_details as $item ) {
  //                     $organization_name = $item['name'];
  //                     $organization_description = $item['description'];
  //                     $organization_address = $item['address'];
  //                     $organization_phone = $item['phone'];
  //                     $need_title = $item['title'];
  //                     $need_description = $item['need_description'];
                      
  //                     echo ""
  //                   }
  //           
  
  $page_title = "Organization Details Page";
  $css_page = "<link rel='stylesheet' href='includes/css/organization-details.css'>";
  ?>
<!doctype html>
<html>
    <?php
        include('includes/head.php');
    ?>
    <body style="padding-top: 64px;">
        <?php include('includes/navbar.php') ?>
        <div class="container">
            <div id="organizationCarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#organizationCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#organizationCarousel" data-slide-to="1"></li>
                <li data-target="#organizationCarousel" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="images/organizations/carousel/organization1/orga1_pic1.jpg" alt="First Organization Pic">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Organization Pic 1</h5>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="images/organizations/carousel/organization1/orga1_pic2.jpg" alt="Second Organization Pic">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Organization Pic 2</h5>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="images/organizations/carousel/organization1/orga1_pic3.jpg" alt="Third Organization Pic">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Organization Pic 3</h5>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#organizationCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#organizationCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            
            <h1 class="text-center"><?php echo $organization_details[0]['name'] ?></h1>
            <div class="btn-group btn-group-toggle mr-5" data-toggle="buttons">
              <button  type="button" class="btn btn-outline-primary about-us-button active">
                <input type="radio" name="options" id="option1" autocomplete="off" checked> About Us
              </button>
              <button  type="button" class="btn btn-outline-primary needs-list-button">
                <input type="radio" name="options" id="option2" autocomplete="off"> Needs List
              </button>
            </div>
            <div class="about-us">
              <h3>About Us</h3>
              <p><?php echo $organization_details[0]['description'] ?></p>
              <h3>Address</h3>
              <p><?php echo $organization_details[0]['address'] ?></p>
              <h3>Phone</h3>
              <p><?php echo $organization_details[0]['phone'] ?></p>
              <button type="button" class="btn btn-success">Send Message</button>
              <button type="button" class="btn btn-primary">Interested</button>
              </div>
              
              <div class="needs-list">
                <h3>Needs List</h3>
                <?php
                  if (sizeof($organization_needs) > 0) {
                    if (sizeof($organization_needs) > 1) {
                      echo "<h4>This company has ", sizeof($organization_needs);echo" needs</h4>";
                    } else {
                      echo "<h4>This company has ", sizeof($organization_needs);echo" need</h4>";
                    }
                    
                    foreach( $organization_needs as $item ) {
                          $need_title = $item['title'];
                          $need_description = $item['description'];
                          
                          echo "<div class=\"card\">
                                  <div class=\"card-header\">
                                    $need_title <button class=\"btn btn-info float-right\">I can help</button>
                                  </div>
                                  <p class=\"need-description\">$need_description</p>
                                </div>";
                        }
                  } else {
                    echo "<p>This organization doesn't have needs yet</p>";
                  }
                  
                 ?>
                
                
              </div>
        </div>
        <?php
            include('includes/footer.php');
        ?>
    </body>
    <script src="includes/js/organization-details.js"></script>
</html>