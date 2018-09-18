<?php 
    session_start();
    //doest allow users to get to the page before logging in
    if (!$_SESSION['organization_email']) {
        header("location: login.php");
    }
  
    //include autoloader
    include('autoloader.php');
    //create instance of organization class
    $orgns = new Organization();
    //get organization id
    $org_id = $orgns -> getOrganizationId();
    //get organization carousel images
    $organization_carousel = $orgns -> getCarouselImages($org_id);
    //get how many images the organization has
    $org_carousel_length = count($organization_carousel);
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //handle sign up here
        $organization = new Organization();
        //receive post variables from form
        $title = $_POST['title'];
        $description = $_POST['description'];
        $carousel_image = $_FILES['carousel_image'];
        
        $target_dir = "images/organizations/carousel/";
        $target_file = $target_dir . basename($_FILES["carousel_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["carousel_image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        
        if (move_uploaded_file($_FILES["carousel_image"]["tmp_name"], $target_file)) {
            
        } else {
            
        }
        
        $organization_carousel_boolean = $organization -> addCarouselImage($title, $description, $_FILES["carousel_image"]["name"], 0, $org_id);
        if($organization_carousel_boolean == true) {
            //carousel image added
            header("Refresh:0");
            $message = "You have successfully added an image to the carousel!";
            $message_class = "success";
        } else {
            $message = "The carousel image couldn't be uploaded. Try again later.";
            $message_class = "warning";
        }
    }
  
  $page_title = "Organization Carousel Page";
  $css_page = "<link rel='stylesheet' href='includes/css/organization-carousel.css'>";
?>

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
            
            <?php
                    
                if( $message ) {
                    echo "  
                            <div class=\"mt-3 alert alert-$message_class\" role=\"alert\">
                                $message
                            </div>
                         ";
                }
            
            ?>
            
            <form id="carousel-form" method="post" enctype="multipart/form-data" action="organization-carousel.php">
               <h4 class="text-center">Carousel image add form</h4>
               <div class="form-group">
                   <label for="title">Title</label>
                   <input class="form-control" type="text" name="title" id="title" placeholder="Type a title for the carousel image">
               </div>
               <div class="form-group">
                   <label for="description">Description</label>
                   <textarea class="form-control" type="textarea" rows="5" name="description" id="description" placeholder="Type a description for the carousel image"></textarea>
               </div>
               <div class="form-group">
                   <label>Carousel Picture</label><br>
                   <input type="file" name="carousel_image" id="carousel_image">
               </div>
               <button class="btn btn-primary" type="submit">Submit</button>
            </form>
         </div>
        <?php
            include('includes/footer.php');
        ?>
    </body>
    <script src="includes/js/organization-needs.js"></script>
</html>