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
  $id = $organizationProfile[6];
  
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
            
            <h1 class="text-center">Needs List <button class="btn btn-success float-right">+</button></h1>
            <?php
              foreach( $organization_needs as $item ) {
                          $need_id = $item['id'];
                          $need_title = $item['title'];
                          $need_description = $item['description'];
                          
                          echo "<div class=\"card\">
                                  <div class=\"card-header\">
                                    $need_title <button class=\"btn btn-secondary float-right\">Edit</button></h1>
                                  </div>
                                  <p>$need_description</p>
                                  <div id=\"accordion$need_id\">
                                      <div class=\"card\">
                                        <div class=\"card-header\" id=\"heading$need_id\">
                                          <h5 class=\"mb-0\">
                                            <button class=\"btn btn-info block\" data-toggle=\"collapse\" data-target=\"#collapse$need_id\" aria-expanded=\"true\" aria-controls=\"collapse$need_id\">Volunteer List</button>
                                          </h5>
                                        </div>
                                    
                                        <div id=\"collapse$need_id\" class=\"collapse\" aria-labelledby=\"heading$need_id\" data-parent=\"#accordion$need_id\">
                                          <div class=\"card-body\">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                          </div>
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