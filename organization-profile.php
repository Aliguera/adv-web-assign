<?php
  session_start();
  //doest allow users to get to the page before logging in
  if (!$_SESSION['organization_email']) {
      header("location: login.php");
  }
  
  //include autoloader
  include('autoloader.php');
  //create instance of products class
  $orgns = new Organization();
  $organizationProfile = $orgns -> getOrganizationProfile();
  
  $name = $organizationProfile[0];
  $description = $organizationProfile[1];
  $abn = $organizationProfile[2];
  $address = $organizationProfile[3];
  $profile_image = $organizationProfile[4];
  
  $page_title = "Organization Profile Page";
  $css_page = "<link rel='stylesheet' href='includes/css/organization-profile.css'>";
  ?>
<!doctype html>
<html>
    <?php
        include('includes/head.php');
    ?>
    <body style="padding-top: 64px;">
        <?php include('includes/navbar.php') ?>
        <div class="container">
            <div class="img-size-div">
                <img class="profile-image img-responsive center-block" src="images/organizations/profile_image/<?php echo $profile_image ?>" class="img-fluid" alt="Responsive image">
            </div>
            <h1 class="text-center"><?php echo $name?></h1>
            <div class="card">
              <div class="card-body">
                <h3>About Us</h3>
                <?php echo $_SESSION['organization_description'] ?>
                <p><?php echo $description?></p>
                <h3>Address</h3>
                <p><?php echo $address?></p>
                <h3>ABN</h3>
                <p><?php echo $abn?></p>
              </div>
            </div>
            
            <hr>
            <a href="organization-needs.php"><button class="btn btn-primary" type="button">Needs List</button></a>
        </div>
        <?php
            include('includes/footer.php');
        ?>
    </body>
</html>