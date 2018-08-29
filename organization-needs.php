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
  
  $page_title = "Organization Needs Page";
  $css_page = "<link rel='stylesheet' href='includes/css/organization-needs.css'>";
  ?>
<!doctype html>
<html>
    <?php
        include('includes/head.php');
    ?>
    <body style="padding-top: 64px;">
        <?php include('includes/navbar.php') ?>
        <div class="container">
            <h1 class="text-center">Needs List <button class="btn btn-success float-right">+</button></h1>
            <div class="card">
              <div class="card-header">
                Needs Title <button class="btn btn-secondary float-right">Edit</button></h1>
              </div>
              <p>Lorem ipsum d</p>
              <button class="btn btn-info">Volunteer List</button>
            </div>
            <div class="card">
              <div class="card-header">
                Needs Title <button class="btn btn-secondary float-right">Edit</button></h1>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quo ad nemo nisi, exercitationem eaque recusandae, culpa vel aspernatur omnis eligendi corporis, debitis, saepe perferendis obcaecati delectus dignissimos magnam animi.</p>
              <button class="btn btn-info">Volunteer List</button>
            </div>
            <div class="card">
              <div class="card-header">
                Needs Title <button class="btn btn-secondary float-right">Edit</button></h1>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quo ad nemo nisi, exercitationem eaque recusandae, culpa vel aspernatur omnis eligendi corporis, debitis, saepe perferendis obcaecati delectus dignissimos magnam animi.</p>
              <button class="btn btn-info">Volunteer List</button>
            </div>
            <div class="card">
              <div class="card-header">
                Needs Title <button class="btn btn-secondary float-right">Edit</button></h1>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quo ad nemo nisi, exercitationem eaque recusandae, culpa vel aspernatur omnis eligendi corporis, debitis, saepe perferendis obcaecati delectus dignissimos magnam animi.</p>
              <button class="btn btn-info">Volunteer List</button>
            </div>
            <div class="card">
              <div class="card-header">
                Needs Title <button class="btn btn-secondary float-right">Edit</button></h1>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quo ad nemo nisi, exercitationem eaque recusandae, culpa vel aspernatur omnis eligendi corporis, debitis, saepe perferendis obcaecati delectus dignissimos magnam animi.</p>
              <button class="btn btn-info">Volunteer List</button>
            </div>
            <div class="card">
              <div class="card-header">
                Needs Title <button class="btn btn-secondary float-right">Edit</button></h1>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore quo ad nemo nisi, exercitationem eaque recusandae, culpa vel aspernatur omnis eligendi corporis, debitis, saepe perferendis obcaecati delectus dignissimos magnam animi.</p>
              <button class="btn btn-info">Volunteer List</button>
            </div>
        </div>
        <?php
            include('includes/footer.php');
        ?>
    </body>
</html>