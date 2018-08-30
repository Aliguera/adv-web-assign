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
  
  foreach( $organization_details as $item ) {
                    $organization_name = $item['name'];
                    $organization_description = $item['description'];
                    $organization_address = $item['address'];
                    $organization_phone = $item['phone'];
                    $need_title = $item['title'];
                    $need_description = $item['need_description'];
                    
                    echo $need_title;
  }
//   session_start();
//   //doest allow users to get to the page before logging in
//   if (!$_SESSION['user_email'] && !$_SESSION['organization_email']) {
//       header("location: index.php");
//   }
  
//   //include autoloader
//   include('autoloader.php');
//   //create instance of products class
//   $orgns = new Organization();
//   $organizations = $orgns -> getOrganizations();
  
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
            //     foreach( $organizations as $item ) {
            //         $organization_id = $item['id'];
            //         $organization_name = $item['name'];
            //         $organization_description = $item['description'];
            //         $organization_image = $item['profile_image'];
                    
            //         echo "<div class=\"card mt-5\">
            //                 <div class=\"card-header\">
            //                   $organization_name
            //                 </div>
            //                 <div class=\"card-body\">
            //                   <div class=\"row\">
            //                         <div class=\"col-md-6\">
            //                             <div class=\"im-size-div\">
            //                               <img class\"img-size\" src=\"images/organizations/$organization_image\">
            //                             </div>
            //                         </div>
            //                         <div class=\"col-md-6\">
            //                             <h3>$organization_name</h3>
            //                             <p>$organization_description</p>
            //                             <a href=\"detail.php?organization_id=$organization_id\"><button class=\"btn btn-primary right\">View</button></a>
            //                         </div>
            //                     </div>
            //                 </div>
            //               </div>";
            //     }
             ?>
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
            
            <h1 class="text-center">Hospital Alfred</h1>
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
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
              sed diam nonummy nibh euismod tincidunt ut laoreet dolore
              magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
              quis nostrud exerci tation ullamcorper suscipit lobortis nisl
              ut aliquip ex ea commodo consequat. Duis autem vel eum iriure
              dolor in hendrerit in vulputate velit esse molestie consequat,
              vel illum dolore eu feugiat nulla facilisis at vero eros et
              accumsan et iusto odio dignissim qui blandit praesent luptatum
              zzril delenit augue duis dolore te feugait nulla facilisi.
              Nam liber tempor cum soluta nobis eleifend option congue
              nihil imperdiet doming id quod mazim placerat facer possim
              assum.</p>
              <h3>Address</h3>
              <p>45/123 Geroge Street, Sydney, Australia</p>
              <h3>Phone</h3>
              <p>53252435326</p>
              <button type="button" class="btn btn-success">Send Message</button>
              <button type="button" class="btn btn-primary">Interested</button>
              </div>
              
              <div class="needs-list">
                <h3>Needs List</h3>
                <div class="card">
                  <div class="card-header">
                    Needs Title
                  </div>
                  <p>Lorem ipsum d</p>
                  <button class="btn btn-primary need-help-button">I can help</button>
                </div>
              </div>
        </div>
        <?php
            include('includes/footer.php');
        ?>
    </body>
    <script src="includes/js/organization-details.js"></script>
</html>