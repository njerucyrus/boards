<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/4/17
 * Time: 5:33 PM
 */
?>
<style type="text/css">
    .navbar {
        margin-bottom: 0;
        background-color: #f4511e;
        z-index: 9999;
        border: 0;
        font-size: 12px !important;
        line-height: 1.42857143 !important;
        letter-spacing: 4px;
        border-radius: 0;
        font-family: Montserrat, sans-serif;
    }
    .navbar li a, .navbar .navbar-brand {
        color: #fff !important;
    }
    .navbar-nav li a:hover, .navbar-nav li.active a {
        color: #f4511e !important;
        background-color: #fff !important;
    }
    .navbar-default .navbar-toggle {
        border-color: transparent;
        color: #fff !important;
    }

</style>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#myPage">iBoard</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">How it Works</a></li>
                <li><a href="#">Search</a></li>
                <li><a href="#">Knowledge Center</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Add Your Location</a></li>
                <?php
                if(isset($_SESSION['username'])){
                    ?>
                    <li><a href="#">Logged in as (<?php echo $_SESSION['username']?>)</a></li>
                <?php
                }
                else {
                    ?>
                <li><a href="login.php">Login</a></li>

                <?php
                }
                ?>





            </ul>
        </div>
    </div>
</nav>


