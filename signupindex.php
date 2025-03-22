<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signupstyle.css">
</head>

<body>  
<header>
        <div class="logo" style="flex-grow: 0.5;">
        <a href="index.html">
            <img src="images/photo_2024-04-26_13-53-29.jpg" width="120px" height="40px" /> </a>
        </div>
        <div class="web_group">
            <div class="home-icon">
                <a href="index.php"> Home </a>
                <span class="green"></span>
            </div>
            <div class="Contact-icon">
                <a href="index.html#contact"> Contact Us </a>
                <span class="green"></span>
            </div>
            <div class="Lgin-icon">
                <div class="login-icon-wrapper">
                    <a href="index.php#log"> Login </a>
                </div>
                <a href="userpage.php">
                    <img src="user1.png" width="50px" height="50px" style="border: none;" />
                </a>
            </div>
        </div>
        <div class="minu_icon" id="icon">
            <img src="images/th-removebg-preview.png" />
        </div>
        <div class="mobil_group" id="nav">
            <nav>
                <ul>
                    <li>
                        <a href="userpage.php"><img src="images/c28deec925acb5beb6b2e8b5ed2a2dd3.jpg" width="50px" height="50px" /></a>
                    </li>
                    <li><a href="index.html"> Login</a></li>
                    <li><a href="index.html#home">Home</a></li>
                    <li><a href="index.html#contact">Contact us</a></li>
                    <li><a href="index.html#about">About us</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="signupp">   
        <div class="container">
            <form class="signup-form" action="sign_up.php" method="post">
                <h2>Sign With New Account</h2>
                <?php
                if (isset($f_name_error)) {
                    echo $f_name_error;
                }
                ?>
                <div class="form-group">
                    <label for="fname">First Name :</label>
                    <input type="text" id="fname" name="fname" required>
                </div>
                <?php
                if (isset($l_name_error)) {
                    echo $l_name_error;
                }
                ?>
                <div class="form-group">
                    <label for="lname">Last Name :</label>
                    <input type="text" id="lname" name="lname" required>
                </div>
                <?php
                if (isset($mail_error)) {
                    echo $mail_error;
                }
                ?>
                <div class="form-group">
                    <label for="email">Enter Your E-mail :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <?php
                if (isset($pass_error)) {
                    echo $pass_error;
                }
                ?>
                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password">Repeat The Password :</label>
                    <input type="password" id="repeat_password" name="repeat_password" required>
                </div>
                <?php
                if (isset($_GET['error']) && $_GET['error'] === 'password_mismatch') {
              echo '<p style="color: red; margin-top: -10px;">Passwords do not match.</p>';;}
               elseif (isset($_GET['error']) && $_GET['error'] === 'password_complexity') {
            echo '<p style="color: red; margin-top: -10px;">Password must be at least 8 characters long and include letters, numbers, and special characters..</p>'; }
 elseif (isset($_GET['error']) && $_GET['error'] === 'email_existed') {
            echo '<p style="color: red; margin-top: -10px;">Email already existed</p>'; }
                ?>
                <input type="submit" class="btn" value="Sign Up" name="submit">
            </form>
        </div>
    </section>

    <footer>
        <div class="footer_top">
            <div class="container2">
                <div class="row">
                    <div class="col-md-4">
                        <h3>About ComScanner</h3>
                        <p>CamScanner is a site that scans your site for vulnerabilities and gives effective ways to solve them .</p>
                    </div>
                    <div class="col-md-4">
                        <h3>Useful Links</h3>
                        <ul>
                            <li><a href="index.html#home">Home</a></li>
                            <li><a href="index.html#about">About us</a></li>
                            <li><a href="index.html#contact">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Contact Info</h3>
                        <p>Phone: +20 1552434572</p>
                        <p>Email: comscanner2@gmail.com</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container2">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; 2024 ComScanner. All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <ul class="social_icons">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        var bt = document.getElementById("icon");
        var minu = document.getElementById("nav");
        bt.onclick = function() {
            if (minu.style.right === "-250px") {
                minu.style.right = "0px";
            } else {
                minu.style.right = "-250px";
            }
        };
   </script>

</body>
</html>
