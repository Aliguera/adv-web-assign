<?php
  session_start();
  
  if (!$_SESSION['organization_email'] && !$_SESSION['user_email']) {
      header("location: login.php");
  }
  
  $id = $_GET['id'];
  //include autoloader
  include('autoloader.php');
  //   //create instance of organization class
  $orgns = new Organization();
  $organization_details = $orgns -> getOrganizationDetails($id);
  
  $organization_carousel = $orgns -> getCarouselImages($id);
  $org_carousel_length = count($organization_carousel);
  
  $user = new Account();
  $user_interest_check = $user -> checkUserInterest($id);
  
  $user_id = $user -> getUserId();
  
  $organization_needs = $orgns -> getOrganizationNeedsUser($id, $user_id);
  
  //need id took from the url when ajax takes the I can help button id
  $need_id_url = $_GET['need_id'];
  
  if (isset($need_id_url)) {
    executeUserNeed($need_id_url);
  }
  
  function executeUserNeed($need_id) {
    $user_need_obj = new Account();
    $user_need = $user_need_obj -> setUserNeed($need_id);
  }
  
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
            <?php 
            echo "<div id=\"carouselExampleIndicators\" class=\"carousel slide"; if ($org_carousel_length == 0) { echo " d-none"; } echo"\" data-ride=\"carousel\">
              <ol class=\"carousel-indicators\">";
                  foreach( $organization_carousel as $i => $item ) {
                    $active = $item['active'];
                    echo "<li data-target=\"#organizationCarousel\" data-slide-to=\""; echo $i; echo"\" class=\""; if($active == 1) { echo "active"; } echo"\"></li>";
                  }
              echo "</ol>
              <div class=\"carousel-inner\">";
                foreach( $organization_carousel as $item ) {
                  $active = $item['active'];
                  $title = $item['title'];
                  $description = $item['description'];
                  $carousel_image = $item['carousel_image'];
                    echo "<div class=\"carousel-item "; if($active == 1) { echo "active"; } echo "\">
                      <div class=\"img-size-div\">
                        <img class=\"d-block w-100 img-size\" src=\"images/organizations/carousel/$carousel_image\" alt=\"Second slide\">
                      </div>
                      <div class=\"carousel-caption d-none d-md-block\">
                        <h5>$title</h5>
                        <p>$description</p>
                      </div>
                    </div>";
                  }
              echo "</div>
              <a class=\"carousel-control-prev "; if ($org_carousel_length == 1) { echo "d-none"; } echo "\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"prev\">
                <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
                <span class=\"sr-only\">Previous</span>
              </a>
              <a class=\"carousel-control-next "; if ($org_carousel_length == 1) { echo "d-none"; } echo "\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"next\">
                <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
                <span class=\"sr-only\">Next</span>
              </a>
            </div>"; ?>
            
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
              </div>
              
              <div class="needs-list d-none">
                <?php
                  //check if the company has needs then display content
                  if (sizeof($organization_needs) > 0) {
                    echo "<h3>Needs List</h3>";
                    if (sizeof($organization_needs) > 1) {
                      echo "<h4>"; echo $organization_details[0]['name']; echo" has ", sizeof($organization_needs);echo" needs</h4>";
                    } else {
                      echo "<h4>"; echo $organization_details[0]['name']; echo" has ", sizeof($organization_needs);echo" need</h4>";
                    }
                    
                    foreach( $organization_needs as $item ) {
                          $need_id = $item['id'];
                          $need_title = $item['title'];
                          $need_description = $item['description'];
                          $created_at = $item['created_at'];
                          $user_id_fk = $item['user_id_fk'];
                          
                          echo "<div class=\"alert alert-success mt-4 mb-0 d-none\" role=\"alert\">
                                  The organization "; echo $organization_details[0]['name']; echo " has received your help! They will get in contact with you ASAP. Thanks!
                                </div>";
                          
                          echo "<div class=\"card\">
                                  <div class=\"card-header\">
                                    $need_title ";
                                    
                          if (!$_SESSION['organization_email']) {
                              if (!$user_id_fk) {
                                echo"
                                    <button id=\"$need_id\" class=\"btn btn-info float-right need-button\">I can help</button>
                                   ";
                              } else {
                                echo"
                                    <button id=\"$need_id\" class=\"btn btn-info float-right need-button\" disabled>I can help</button>
                                   ";
                              }
                              
                          }
                          echo "</div>
                          <p class=\"need-description\">$need_description</p>
                        </div>";
                        }
                  } else {
                    echo "<h5 class=\"text-center mt-5\">This organization doesn't have needs yet.</h5>";
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

