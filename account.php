<!DOCTYPE html>
<?php 
    session_start();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-commerce</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- html5 shim and Respond.js for IE8 support of html5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <?php
                                if (isset($_SESSION['email']))
                                {
                                    echo "<li><a href=\"account.php\"><i class=\"fa fa-user\"></i> My Account</a></li>";
                                }
                                else
                                {
                                    echo "<li><a href=\"login.php\"><i class=\"fa fa-user\"></i> My Account</a></li>";
                                }
                            ?>
                            <li><a href="cart.php"><i class="fa fa-user"></i> My Cart</a></li>
                            <li><a href="checkout.php"><i class="fa fa-user"></i> Checkout</a></li>
                            <?php
                                if (isset($_SESSION['email']))
                                {
                                    echo "<li><a href=\"logout.php\"><i class=\"fa fa-user\"></i> Logout</a></li>";
                                }
                                else
                                {
                                    echo "<li><a href=\"login.php\"><i class=\"fa fa-user\"></i> Login</a></li>";
                                }
                            ?>
                            <li><a href="register.php"><i class="fa fa-user"></i> Register</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">currency :</span><span class="value">USD </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">INR</a></li>
                                    <li><a href="#">GBP</a></li>
                                </ul>
                            </li>

                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">language :</span><span class="value">English </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./"><img src="img/logo.png"></a></h1>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="cart.php">Cart - <span class="cart-amunt">$100</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">5</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="shop.php">Shop page</a></li>
                        <li><a href="single-product.php">Single product</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="checkout.php">Checkout</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Others</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <div id="user-info">
        <div class="signup-form container">
            <?php
                $mysqli = mysqli_connect("localhost:3306", "root", "", "testphp");
                if (mysqli_connect_errno($mysqli)) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                $q = "SELECT first_name AS fname, last_name AS lname, avatar_url AS avatar FROM users WHERE email = '$_SESSION[email]'";
                $result = mysqli_query($mysqli, $q);
                $row = mysqli_fetch_assoc($result);
                $fname = $row['fname'];
                $lname = $row['lname'];
                $avatar = $row['avatar'];
            ?>
            <form action="#" method="POST">
                <h2 class="account-info">Current Email: </h2><?php echo "<p class=\"account-info-data\">$_SESSION[email]</p>" ?><br>
                <input class="input-lg" name="email" type="email" placeholder="New Email" required>
                <input type="submit" value="Change Email"><br/><br/>
                <?php
                    if (isset($_POST) && array_key_exists('email', $_POST))
                    {
                        $mysqli = mysqli_connect("localhost:3306", "root", "", "testphp");
                        if (mysqli_connect_errno($mysqli)) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $query = "UPDATE `testphp`.`users` SET `email` = '$_POST[email]' WHERE `users`.`email` = '$_SESSION[email]'";
                        mysqli_query($mysqli, $query);
                        $_SESSION['email'] = $_POST['email'];
                        echo '<script>window.location.href = "account.php"</script>';
                    }
                ?>
            </form>
            <form action="#" method="POST">
                <h2 class="account-info">First Name: </h2><?php echo "<p class=\"account-info-data\">$fname</p>" ?><br/>
                <input class="input-lg" name="fname" type="text" placeholder="New First Name" required>
                <input type="submit" value="Change Name"><br/><br/>
                <?php
                    if (isset($_POST) && array_key_exists('fname', $_POST))
                    {
                        $mysqli = mysqli_connect("localhost:3306", "root", "", "testphp");
                        if (mysqli_connect_errno($mysqli)) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $query = "UPDATE `testphp`.`users` SET `first_name` = '$_POST[fname]' WHERE `users`.`email` = '$_SESSION[email]'";
                        mysqli_query($mysqli, $query);
                        echo '<script>window.location.href = "account.php"</script>';
                    }
                ?>
            </form>
            <form action="#" method="POST">
                <h2 class="account-info">Last Name: </h2><?php echo "<p class=\"account-info-data\">$lname</p>" ?><br/>
                <input class="input-lg" name="lname" type="text" placeholder="New Last Name" required>
                <input type="submit" value="Change Name"><br/><br/>
                <?php
                    if (isset($_POST) && array_key_exists('lname', $_POST))
                    {
                        $mysqli = mysqli_connect("localhost:3306", "root", "", "testphp");
                        if (mysqli_connect_errno($mysqli)) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $query = "UPDATE `testphp`.`users` SET `last_name` = '$_POST[lname]' WHERE `users`.`email` = '$_SESSION[email]'";
                        mysqli_query($mysqli, $query);
                        echo '<script>window.location.href = "account.php"</script>';
                    }
                ?>
            </form>
            <form action="#" method="POST">
                <h2 class="account-info">Avatar: </h2><?php echo "<img src=\"$avatar\"><br/>" ?><br/>
                <input class="input-lg" name="avatar" type="text" placeholder="New Avatar URL" required>
                <input type="submit" value="Change Avatar URL"><br/><br/>
                <?php
                    if (isset($_POST) && array_key_exists('avatar', $_POST))
                    {
                        $mysqli = mysqli_connect("localhost:3306", "root", "", "testphp");
                        if (mysqli_connect_errno($mysqli)) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $query = "UPDATE `testphp`.`users` SET `avatar_url` = '$_POST[avatar]' WHERE `users`.`email` = '$_SESSION[email]'";
                        mysqli_query($mysqli, $query);
                        echo '<script>window.location.href = "account.php"</script>';
                    }
                ?>
            </form>
            <form action="#" method="POST">
                <h2 class="account-info">Change Password: </h2>
                <input class="input-lg" name="cpass" type="password" placeholder="Current Password" required>
                <input class="input-lg" name="npass" type="password" placeholder="New Password" required>
                <input type="submit" value="Change Password"><br/><br/>
                <?php
                    if (isset($_POST) && array_key_exists('cpass', $_POST) && array_key_exists('npass', $_POST))
                    {
                        $mysqli = mysqli_connect("localhost:3306", "root", "", "testphp");
                        if (mysqli_connect_errno($mysqli)) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $check = "SELECT COUNT(*) AS ex FROM `testphp`.`users` WHERE `users`.`email` = '$_SESSION[email]' AND `users`.`_password` = '$_POST[cpass]'";
                        $result = mysqli_query($mysqli, $check);
                        $row = mysqli_fetch_assoc($result);
                        if ($row['ex'] == 0)
                        {
                            echo "<script>alert(\"Current password is incorrect!!\");</script>";
                        }
                        else
                        {
                            $query = "UPDATE `testphp`.`users` SET `_password` = '$_POST[npass]' WHERE `users`.`email` = '$_SESSION[email]'";
                            mysqli_query($mysqli, $query);
                        }
                        echo '<script>window.location.href = "account.php"</script>';
                    }
                ?>
            </form>
        </div>
    </div>

    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>u<span>Stora</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis magni at?</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">User Navigation </h2>
                        <ul>
                            <li><a href="account.php">My account</a></li>
                            <li><a href="#">Order history</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Vendor contact</a></li>
                            <li><a href="#">Front page</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            <li><a href="#">Mobile Phone</a></li>
                            <li><a href="#">Home accesseries</a></li>
                            <li><a href="#">LED TV</a></li>
                            <li><a href="#">Computer</a></li>
                            <li><a href="#">Gadets</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <form action="#">
                                <input type="email" placeholder="Type your email">
                                <input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->
    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com" target="_blank">freshDesignweb.com</a></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->
   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="js/main.js"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="js/bxslider.min.js"></script>
    <script type="text/javascript" src="js/script.slider.js"></script>
</body>
</html>