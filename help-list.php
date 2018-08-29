<?php
  session_start();
  //doest allow users to get to the page before logging in
  if (!$_SESSION['user_email'] && !$_SESSION['organization_email']) {
      header("location: login.php");
  }
  
  //include autoloader
  include('autoloader.php');
  //create instance of products class
  $orgns = new Organization();
  $organizations = $orgns -> getOrganizations();
  
  $page_title = "Help-List Page";
  $css_page = "<link rel='stylesheet' href='includes/css/help-list.css'>";
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
                foreach( $organizations as $item ) {
                    $organization_id = $item['id'];
                    $organization_name = $item['name'];
                    $organization_description = $item['description'];
                    $organization_image = $item['profile_image'];
                    
                    echo "<div class=\"card mt-5\">
                            <div class=\"card-header\">
                              $organization_name
                            </div>
                            <div class=\"card-body\">
                              <div class=\"row\">
                                    <div class=\"col-md-6\">
                                        <div class=\"img-size-div\">
                                          <img class=\"img-size rounded\" src=\"images/organizations/profile_image/$organization_image\">
                                        </div>
                                    </div>
                                    <div class=\"col-md-6\">
                                        <h3>$organization_name</h3>
                                        <p>$organization_description</p>
                                        <a href=\"organization-details.php\"><button class=\"btn btn-primary right\">View</button></a>
                                    </div>
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
</html>

<!--<a href=\"detail.php?organization_id=$organization_id\"><button class=\"btn btn-primary right\">View</button></a>-->