
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>ComScanner</title>

</head>

<body>
    <header>
        <div class="logo" style="flex-grow: 0.5" ;>
            <img src="images/photo_2024-04-26_13-53-29.jpg" width="120px" height="40 px" />
        </div>
        <div class="web_group">
            <div class="home-icon">
                <a href="History.php"> History </a>
                <span class="green"></span>
                </div>
            <div class="home-icon">
                <a href="#home"> Home </a>
                <span class="green"></span>
            </div>
            <div class="Contact-icon">
                <a href="#contact"> Contact Us </a>
                <span class="green"></span>
            </div>
            <div class="Lgin-icon">
                <div class="login-icon-wrapper">
                     <?php
                   
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
                        echo '<a href="logout.php"> Logout </a>';
                    } else {
                        echo '<a href="#log"> Login </a>';
                    }
                    ?>
                </div>
                <a href="userpage.php">
                    <img src="user1.png" width="50px" height="50 px" style="border: none;" />
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
                        <a href="userpage.php"><img src="images/c28deec925acb5beb6b2e8b5ed2a2dd3.jpg" width="50px"
                                height="50 px" /></a>
                    </li>
                    <li><a href="#"> Login</a></li>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#contact">contact us</a></li>
                    <li><a href="#about">About us</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="main_page" id="home">
        <div class="scan_div">
            <div class="scan_text">
                <h1> ComScanner </h1>
                <p>We are glad you are using our website </p>
                <p>We hope that your website will be more secure <span class="heart">&hearts;</span></p>
            </div>
            <div class="scan_form">
                <form action="process_input.php" method="post">
                    <div class="url_box">
                        <input type="text" id="Url" name="Url" required placeholder="Enter your URL">
                    </div>
                    <br>
                    <input type="submit" value="Scan" class="submit" name="submit">
                </form>
            </div>
        </div>
        <div class="scan_img">
        </div>
    </section>
    <section class="login_section" id="log">
        <div class="login_image">
            <!-- <img src="images/1447c3dde903d7ac5681ca2e774a3411.jpg" alt="Login Image"> -->
        </div>
        <div class="login_form">
            <form action="login.php" method="POST">
                <div class="form_group">
                     <?php
                if(isset( $email_err)){
                    echo   $email_err;
                }
                ?> 

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_group">

                    <?php
                if(isset(  $password_err)){
                    echo   $password_err;
                }
                ?> 

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                </div>
                <input type="submit" value="Login" class="submit_button" name="submit">
                <p>Don't have an account? <a href="signupindex.php">Sign Up</a></p>
            </form>
        </div>
    </section>
    <section class="about_us" id="about">
    <div class="about_txt">
        <h2>Our idea</h2>
        <p>
            In the current digital era, ensuring the security of IT infrastructure is paramount.
            This project, in collaboration with TrendMicro and WedgeNetworks,
            aims to use open-source vulnerability scanning tools to generate an intensive
            vulnerability report. This report will be fed into a large language model (LLM) that is trained on
            various cybersecurity frameworks and standards such as OWASP, NIST, Rapid7, Mitre, and IDPS rules.
            The ultimate goal of the LLM is to provide actionable recommendations to remediate the vulnerabilities
            identified in the report. Furthermore, the LLM will also process various system logs to verify if
            any attacks are ongoing or have taken place.
        </p>
        <a href="ourteam.html">Our Team</a>
    </div> 

    <div class="about_img">
        <!-- <img scr="aboutus.jpg"> -->
    </div>
</section>

    <section class="contact_us" id="contact">
        <div class="contact_form">
            <form action="#" method="post">
                <div class="form_group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form_group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form_group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <input type="submit" value="Submit" class="submit_button">
            </form>
        </div>
        <div class="contact_image">
            <img src="images/modfycontact.png" alt="Contact Us Image">
        </div>
    </section>

    <footer>
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h3>About ComScanner</h3>
                        <p>CamScanner is a site that scans your site for vulnerabilities and gives effective ways to solve them .</p>
                    </div>
                    <div class="col-md-4">
                        <h3>Useful Links</h3>
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#about">About us</a></li>
                            <li><a href="#contact">Contact</a></li>
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
            <div class="container">
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
    minu.style.right = "-250px";
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
