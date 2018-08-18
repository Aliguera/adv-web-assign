<?php
    if(isset($_SESSION['email'])) {
        $navs = array(
                'Home' => 'admin-home.php',
                'Log Out' => 'admin-logout.php'
            );
    } else {
        $navs = array(
                'Home' => 'admin-home.php',
                'Sign In' => 'admin-login.php'
            );
    }
?>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
    <a href="admin-home.php" class="navbar-brand order-sm-8">Admin - Help2Day</a>
    <button class="navbar-toggler order-sm-5" type="button" data-toggle="collapse" data-target="#main-menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="main-menu">
        <ul class="navbar-nav ml-auto">
            <?php
                foreach( $navs as $key => $value) {
                    echo "<li class=\"nav-item\">
                            <a href=\"$value\" class=\"nav-link\">$key</a>
                          </li>";
                }
            ?>
        </ul>
    </div>
</nav>