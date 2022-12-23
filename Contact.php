<?php
if (isset($_POST['emailAd'])) {
    $email = "invalid";
    $phoneNb = "invalid";
    $EmailAdPattern = "/^[a-zA-Z][a-zA-Z0-9\/\(\)\"\'\:\,\.\;\<\>\~\!\#\$\%\^\&\*\|\+\=\[\]\{\}\`\?\-\_]+@[a-zA-Z0-9\/\(\)\"\'\:\,\;\<\>\~\!\#\$\%\^\&\*\|\+\=\[\]\{\}\`\?\-\_]+\.[a-zA-Z0-9\/\(\)\"\'\:\,\;\<\>\~\!\#\$\%\^\&\*\|\+\=\[\]\{\}\`\?\-\_]+$/";
    $PhoneNbPattern = "/^\([0-9]{3}\)[0-9]{3}\-[0-9]{4}$/";
    if (preg_match($EmailAdPattern, $_POST["emailAd"]) == 1) {
        $email = "valid";
    }
    if (preg_match($PhoneNbPattern, $_POST["phoneNb"]) == 1) {
        $phoneNb = "valid";
    }
    if ($email == "valid" && $phoneNb == "valid") {
        header("Location: Mainpage.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Contact Us" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="CSS/Contact.css" />
    <link rel="stylesheet" href="CSS/Navbar.css" />
    <link rel="stylesheet" href="CSS/Footer.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <nav class="navbar">
        <div class="brand-title"> <a href="Mainpage.php"> <img src="Assets/HBK.png" width="170em"> </a></div>
        <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links">
            <ul>
                <li><a href="searchFlights.php"><i class="fa fa-plane" id="icons"></i>Book a Flight</a></li>
                <li><a href="Contact.php"><i class="fa fa-envelope" id="icons"></i>Contact</a></li>
                <li><a href="About.php"><i class="fa fa-info" id="icons"></i>About</a></li>
                <li>
                    <div class="DropDown">
                        <button class="drop"><i class="fa fa-user" id="icons"></i>Account</button>
                        <div class="dropdown-links">
                            <?php if (!isset($_COOKIE['username'])): ?>
                            <a href="SignUp.php">Sign up</a>
                            <a href="SignIn.php">Login</a>
                            <?php else: ?>
                            <a href="SignOut.php">Sign out</a>
                            <a href="bookedFlights.php">Booked flights</a>
                            <a href="reservedFlights.php">Reserved flights</a>
                            <a href="Account Information.php">Manage Account Details</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="contact-form">
        <form method="POST" action="Contact.php" validate>
            <label for="topic">Topic</label>
            <br>
            <select class="topic" required>
                <option disabled selected>Select</option>
                <option>Make a complaint</option>
                <option>Give feedback</option>
                <option>General Inquiry</option>
            </select>
            <br><br><br>
            <label for="email">Email</label>
            <br>
            <input type="text" placeholder="name@domain.com" class="email" name="emailAd" required />
            <?php
            if (isset($email) && $email == "valid"):
            ?>
            <p style="font-size: medium; float: right; margin-right: 215px;">✔️</p>
            <?php elseif (isset($email) && $email == "invalid"):
            ?>
            <p style="font-size: medium; float: right; margin-right: 215px;">❌</p>
            <?php
            endif;
            ?>
            <br><br><br>
            <label for="phone">Phone Number</label>
            <br>
            <input type="tel" placeholder="(###) ###-####" class="phone" name="phoneNb" required />
            <?php
            if (isset($phoneNb) && $phoneNb == "valid"):
            ?>
            <p style="font-size: medium; float: right; margin-right: 215px;">✔️</p>
            <?php elseif (isset($phoneNb) && $phoneNb == "invalid"):
            ?>
            <p style="font-size: medium; float: right; margin-right: 215px;">❌</p>
            <?php
            endif;
            ?>
            <br><br><br>
            <textarea class="message" name="message" rows="12" cols="68" placeholder="Type your message here..."
                required></textarea>
            <br>
            <input type="submit" value="SUBMIT" class="submit" name="submit_button" />
        </form>
    </div>
    <h1 class="header">GET IN TOUCH</h1>
    <p class="desc">Your feedback is important to us. Share with us your comments and compliments to help us improve our
        services. We love hearing from our users!</p>
</body>
<footer style="margin-top: 50%;">
    <div class="social">
        <a href="#"><i id="social-media" class="fa fa-facebook"></i></a>
        <a href="#"><i id="social-media" class="fa fa-twitter"></i></a>
        <a href="#"><i id="social-media" class="fa fa-linkedin"></i></a>
    </div>
    <hr>
    <p>&copy 2022 HBK Airways, Inc. <em>All Rights Reserved</em></p>
</footer>

</html>