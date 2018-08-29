<?php
    if(isset($_SESSION['user_email'])) {
        $navs = array(
                'Home' => 'index.php',
                'Help List' => 'help-list.php',
                'About Us' => 'about-us.php',
                'Log Out' => 'logout.php'
            );
    } else if(isset($_SESSION['organization_email'])) {
        $navs = array(
                'Home' => 'index.php',
                'Help List' => 'help-list.php',
                'About Us' => 'about-us.php',
                'Profile' => 'organization-profile.php',
                'Log Out' => 'logout.php'
            );
    } else {
        $navs = array(
                'Home' => 'index.php',
                'About Us' => 'about-us.php',
                'Sign In' => 'login.php'
            );
    }
?>

<nav class="navbar bgNavColor navbar-expand-lg fixed-top">
    <a href="index.php" class="navbar-brand nav-link-color">Help2Day</a>
    <button class="navbar-toggler order-sm-5" type="button" data-toggle="collapse" data-target="#main-menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="main-menu">
        <ul class="navbar-nav ml-auto">
            <?php
                foreach( $navs as $key => $value) {
                    echo "<li class=\"nav-item\">
                            <a href=\"$value\" class=\"nav-link nav-link-color\">$key</a>
                          </li>";
                }
            ?>
        </ul>
    </div>
</nav>