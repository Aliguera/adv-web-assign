<?php
  session_start();
  
  $id = $_GET['id'];
  //include autoloader
  include('autoloader.php');
  //   //create instance of organization class
  $orgns = new Organization();
  $organization_details = $orgns -> getOrganizationDetails($id);
  
  $organization_needs = $orgns -> getOrganizationNeeds($id);
  
  $organization_carousel = $orgns -> getCarouselImages($id);
  
  $user = new Account();
  $user_interest_check = $user -> checkUserInterest($id);
  
  function executeUserInterest() {
    $user_obj = new Account();
    $user_interest = $user_obj -> setUserInterest($_GET['id']);
    header("Refresh:0");
  }
  
  if (array_key_exists('interestSubmit', $_POST)) {
    executeUserInterest();
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
            <!--<div id="organizationCarousel" class="carousel slide" data-ride="carousel">-->
            <!--  <ol class="carousel-indicators">-->
            <!--    <li data-target="#organizationCarousel" data-slide-to="0" class="active"></li>-->
            <!--    <li data-target="#organizationCarousel" data-slide-to="1"></li>-->
            <!--    <li data-target="#organizationCarousel" data-slide-to="2"></li>-->
            <!--  </ol>-->
            <!--  <div class="carousel-inner">-->
            <!--    <div class="carousel-item active">-->
            <!--      <img class="d-block w-100" src="images/organizations/carousel/organization1/orga1_pic1.jpg" alt="First Organization Pic">-->
            <!--      <div class="carousel-caption d-none d-md-block">-->
            <!--        <h5>Organization Pic 1</h5>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--    <div class="carousel-item">-->
            <!--      <img class="d-block w-100" src="images/organizations/carousel/organization1/orga1_pic2.jpg" alt="Second Organization Pic">-->
            <!--      <div class="carousel-caption d-none d-md-block">-->
            <!--        <h5>Organization Pic 2</h5>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--    <div class="carousel-item">-->
            <!--      <img class="d-block w-100" src="images/organizations/carousel/organization1/orga1_pic3.jpg" alt="Third Organization Pic">-->
            <!--      <div class="carousel-caption d-none d-md-block">-->
            <!--        <h5>Organization Pic 3</h5>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--  <a class="carousel-control-prev" href="#organizationCarousel" role="button" data-slide="prev">-->
            <!--    <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
            <!--    <span class="sr-only">Previous</span>-->
            <!--  </a>-->
            <!--  <a class="carousel-control-next" href="#organizationCarousel" role="button" data-slide="next">-->
            <!--    <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
            <!--    <span class="sr-only">Next</span>-->
            <!--  </a>-->
            <!--</div>-->
            
            <div id="organizationCarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php foreach( $organization_carousel as $item ) {
                  $active = $item['active'];
                  echo "<li data-target=\"#organizationCarousel\" data-slide-to=\""; echo key($item); echo"\" class=\""; if($active == 1) { echo "active"; } echo"\"></li>";
                }?>
              </ol>
              <div class="carousel-inner">
                <?php foreach( $organization_carousel as $item ) {
                  $title = $item['title'];
                  $description = $item['description'];
                  $carousel_image = $item['carousel_image'];
                  echo "<div class\"carousel-item "; if($active == 1) { echo "active"; } echo"\">
                          <img class=\"d-block w-100\" src=\"images/organizations/carousel/$carousel_image\" alt=\"$title\">
                          <div class=\"carousel-caption d-none d-md-block\">
                            <h5>$title</h5>
                            <p>$description</p>
                          </div>
                        </div>";
                }?>
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
              <?php
                if (!$_SESSION['organization_email']) {
                                echo"<form method=\"post\">
                                       <button type=\"submit\" name=\"interestSubmit\" id=\"interestSubmit\" class=\"btn btn-primary\""; if ($user_interest_check == 1) {echo "disabled";} echo">Interested</button>
                                     </form>";            
                }
              ?>
              </div>
              
              <div class="needs-list">
                <h3>Needs List</h3>
                <?php
                  if ($_SESSION['organization_email']) {
                      
                  }
                  //check if the company has needs then display content
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
                                    $need_title ";
                          if (!$_SESSION['organization_email']) {
                              echo"<button class=\"btn btn-info float-right\">I can help</button>";
                          }
                          echo "</div>
                          <p class=\"need-description\">$need_description</p>
                        </div>";
                        }
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

