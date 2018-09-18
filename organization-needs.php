<?php
  session_start();
  //doest allow users to get to the page before logging in
  if (!$_SESSION['organization_email']) {
      header("location: login.php");
  }
  
  //include autoloader
  include('autoloader.php');
  //create instance of organizations class
  
  $orgns = new Organization();
  $organizationProfile = $orgns -> getOrganizationProfile();
  
  $name = $organizationProfile[0];
  $description = $organizationProfile[1];
  $abn = $organizationProfile[2];
  $address = $organizationProfile[3];
  $id = $organizationProfile[6];
  
  $need_id_url = $_GET['need_id'];
  
  if(isset($need_id_url)) {
    $orgns2 = new Organization();
    $need_deleted_success = $orgns2 -> deleteNeed($need_id_url);
  }
  
  $organization_needs = $orgns -> getOrganizationNeeds($id);
  
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
            
            <h1 class="text-center">Needs List <a href="organization-register-need.php"><button class="btn btn-success float-right">+</button></a></h1>
            <?php
              foreach( $organization_needs as $item ) {
                          $need_id = $item['id'];
                          $need_title = $item['title'];
                          $need_description = $item['description'];
                          
                          $users = new Account();
                          $users_needs = $users -> getUserNeedsInfo($need_id);
                          
                          echo "<div class=\"card\">
                                  <div class=\"card-header\">
                                    $need_title <button class=\"btn btn-danger float-right ml-3\" id=\"delete-$need_id\">Delete</button><a href=\"organization-edit-need.php?need_id=$need_id\"><button class=\"btn btn-secondary float-right\">Edit</button></a></h1>
                                  </div>
                                  <p>$need_description</p>
                                  <div id=\"accordion$need_id\">
                                      <div class=\"card\">
                                        <div class=\"card-header\" id=\"heading$need_id\">
                                          <h5 class=\"mb-0\">
                                            <button class=\"btn btn-info btn-block volunteer-button\" id=\"$need_id\" data-toggle=\"collapse\" data-target=\"#collapse$need_id\" aria-expanded=\"true\" aria-controls=\"collapse$need_id\">Volunteer List</button>
                                          </h5>
                                        </div>
                                        <div id=\"collapse$need_id\" class=\"collapse\" aria-labelledby=\"heading$need_id\" data-parent=\"#accordion$need_id\">
                                          ";if (count($users_needs) > 0) {
                                            echo"<div class=\"card-body\">
                                            <table class=\"table table-striped\">
                                                <thead>
                                                  <tr>
                                                    <th scope=\"col\">Full Name</th>
                                                    <th scope=\"col\">Email</th>
                                                  </tr>
                                                </thead>
                                                <tbody>";
                                                foreach ($users_needs as $itemm) {
                                                  $user_fullname = $itemm['fullname'];
                                                  $user_email = $itemm['email'];
                                                  echo"<tr>
                                                        <td>$user_fullname</td>
                                                        <td>$user_email</td>
                                                      </tr>";
                                                  }
                                                  
                                                echo "</tbody>
                                              </table>
                                          </div>";
                                          } else {
                                            echo "<p style=\"text-align: center; font-weight: bold\">No volunteers yet</p>";
                                          }
                                          
                                        echo "</div>
                                      </div>
                                    </div>
                                </div>";
              }
            ?>
        </div>
        <?php
            include('includes/footer.php');
        ?>
    </body>
    <script src="includes/js/organization-needs.js"></script>
</html>