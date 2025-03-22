<?php
session_start();

$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$username = $is_logged_in ? $_SESSION['user_name'] : "User Name";


$logout_url = $is_logged_in ? "logout.php" : "#";


$user_email = $is_logged_in ? $_SESSION['user_email'] : "user@example.com";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ComScanner</title>
    <link rel="stylesheet" type="text/css" href="userpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <a href="index.html" style="text-decoration: none;">
            <img src="images/comscan.jpg" class="logo">
        </a>
        <div class="navigation">
            <a href="#" class="indx1" id="userimag" onclick="toggleMenu()"><?php echo htmlspecialchars($username); ?></a>
            <img class="userim" src="user1.png" alt="Log In" onclick="toggleMenu()">
        </div>
        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img src="user1.png">
                    <h2><?php echo htmlspecialchars($user_email); ?></h2>
                </div>
                <hr>
                <a href="<?php echo $logout_url; ?>" class="sub-menu-link">
                    <img src="logout1.png">
                    <p>Log Out</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </header>
    <section class="his" id="History">
        <div class="nhcard">
            <div class="card">
                <div class="icons">
                    <i class="fa-solid fa-file-circle-plus"></i>
                </div>
                <div class="infor">
                    <a href="index.html" style="text-decoration: none;"><h3>New Scan</h3></a>
                </div>
            </div>
            <a href="hestory.html" style="text-decoration: none;">
                <div class="card">
                    <div class="ncard">
                        <div class="icons">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <div class="infor">
                            <h3>History</h3>
                            <p>Your Last Scans</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </section>
    <script>
        function toggleMenu() {
            var menu = document.getElementById("subMenu");
            if (menu.style.maxHeight === "0px" || menu.style.maxHeight === "") {
                menu.style.maxHeight = "400px";
            } else {
                menu.style.maxHeight = "0px";
            }
        }
    </script>
</body>
</html>
