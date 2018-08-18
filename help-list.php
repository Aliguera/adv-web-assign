<?php
session_start();
//doest allow users to get to the page before logging in
if (!$_SESSION['user_email'] && !$_SESSION['organization_email']) {
    header("location: index.php");
}

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
            <div class="card mt-5">
              <div class="card-header">
                Featured
              </div>
              <div class="card-body">
                <div class="row">
                      <div class="col-md-6">
                          <img src="images/i_wanna_help.jpg">
                      </div>
                      <div class="col-md-6">
                          <h3>This is a test</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget quam sollicitudin, tempus augue nec, iaculis risus. Vivamus eu velit vel erat molestie auctor. Nulla id laoreet massa, vitae mollis dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer a odio bibendum, interdum enim sit amet, commodo turpis.</p>
                          <button class="btn btn-primary right">View</button>
                      </div>
                  </div>
              </div>
            </div>
            
            <div class="card mt-5">
              <div class="card-header">
                Featured
              </div>
              <div class="card-body">
                <div class="row">
                      <div class="col-md-6">
                          <img src="images/i_wanna_help.jpg">
                      </div>
                      <div class="col-md-6">
                          <h3>This is a test</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget quam sollicitudin, tempus augue nec, iaculis risus. Vivamus eu velit vel erat molestie auctor. Nulla id laoreet massa, vitae mollis dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer a odio bibendum, interdum enim sit amet, commodo turpis.</p>
                          <button class="btn btn-primary right">View</button>
                      </div>
                  </div>
              </div>
            </div>
            
            <div class="card mt-5">
              <div class="card-header">
                Featured
              </div>
              <div class="card-body">
                <div class="row">
                      <div class="col-md-6">
                          <img src="images/i_wanna_help.jpg">
                      </div>
                      <div class="col-md-6">
                          <h3>This is a test</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget quam sollicitudin, tempus augue nec, iaculis risus. Vivamus eu velit vel erat molestie auctor. Nulla id laoreet massa, vitae mollis dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer a odio bibendum, interdum enim sit amet, commodo turpis.</p>
                          <button class="btn btn-primary right">View</button>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </body>
</html>