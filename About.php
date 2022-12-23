<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="About" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us</title>
    <link rel="stylesheet" href="CSS/About.css" />
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
    <h1 class="header">ABOUT US</h1>
    <p class="desc">Connecting the world through the sky.</p>
    <br><br>
    <div class="div1">
        <img src="Assets/ezgif-3-611a348731.jpg" width=100% height=50% />
        <h2 style="padding-left: 5%;">Our fleet</h2>
        <p style="padding-left: 5%;">Discover our modern, fuel-efficient aircrafts and future designs.</p>
        <p style="padding-left: 5%;"><a href="#" onclick="function1()">Learn more</a></p>
    </div>
    <div class="div2">
        <img src="Assets/join-us.jpg" width=100% height=50% />
        <h2 style="padding-left: 5%;">Join us</h2>
        <p style="padding-left: 5%;">Our people are our greatest asset. Explore opportunities to become a part of the
            HBK Air-
            ways team.</p>
        <p style="padding-left: 5%;"><a href="#" onclick="function2()">Learn more</a></p>
    </div>
    <div class="div3">
        <img src="Assets/istockphoto-1276398647-612x612.jpg" width=100% height=50% />
        <h2 style="padding-left: 5%;">Affiliates</h2>
        <p style="padding-left: 5%;">Find out how you can work with HBK Airways.</p>
        <p style="padding-left: 5%;"><a href="#" onclick="function3()">Learn more</a></p>
    </div>
    <div id="div1" class="div4">
        <ul>
            <li>Airbus A320-200</li>
            <li>Airbus A321-200</li>
            <li>Airbus A321neo</li>
            <li>Airbus A350-1000</li>
            <li>Boeing 777-300</li>
            <li>Boeing 787-9</li>
            <li>Boeing 787-10</li>
            <li>Embraer 190</li>
        </ul>
    </div>
    <div id="div2" class="div5">
        <ul style="list-style-type: circle">
            <li class="li1">Cabin Crew</li>
            <li class="li1">Pilots</li>
            <li class="li1">On the Ground</li>
            <li class="li1">Emerging Talent</li>
        </ul>
    </div>
    <div id="div3" class="div6">
        <a href="#" style="color: white;"><i>
                <h2 style="padding-left: 6%; padding-top: 15%; width: 90%; text-align: center;">HBK Airways Affiliate
                    Marketing Programme</h2>
            </i></a>
    </div>
    <script>
        function function1() {
            var x = document.getElementById("div1");
            if (x.style.display === "none") {
                x.style.display = "block";
            }
            else {
                x.style.display = "none";
            }
        }
        function function2() {
            var x = document.getElementById("div2");
            if (x.style.display === "none") {
                x.style.display = "block";
            }
            else {
                x.style.display = "none";
            }
        }
        function function3() {
            var x = document.getElementById("div3");
            if (x.style.display === "none") {
                x.style.display = "block";
            }
            else {
                x.style.display = "none";
            }
        }
    </script>
</body>
<footer>
    <div class="social">
        <a href="#"><i id="social-media" class="fa fa-facebook"></i></a>
        <a href="#"><i id="social-media" class="fa fa-twitter"></i></a>
        <a href="#"><i id="social-media" class="fa fa-linkedin"></i></a>
    </div>
    <hr>
    <p>&copy 2022 HBK Airways, Inc. <em>All Rights Reserved</em></p>
</footer>

</html>