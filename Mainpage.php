<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homepage: Welcome to HBK Airways!</title>
    <link rel="icon" type="image/x-icon" href="../Assets/Logo.jpeg">
    <link rel="stylesheet" href="CSS/Mainpage.css" />
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
    <header>
        <div class="content-header">
            <h1>In A World Full Of Wonders</h1>
            <h2>Reach For The Skies</h2>
            <div class="line1"></div>
            <br>
            <a href="searchFlights.php" class="btn">Explore Flights</a>
        </div>
    </header>
    <section class="destinations">
        <div class="title">
            <h1>Our Destinations</h1>
        </div>
        <div class="line2"></div>
        <div class="row">
            <div class="col">
                <img src="Assets/Beirut.jpg" alt="">
                <h4> Beirut, Lebanon</h4>
                <p class="p1"> Known as the paris of the middle east, the creme de la creme of east meets west. Discover
                    its beautiful bustling streets to have an exotic experience.</p>
                <br>
                <a href="searchFlights.php" class="btn"> Book a Ticket </a>
            </div>
            <div class="col">
                <img src="Assets/Istanbul.webp" alt="">
                <h4> Istanbul, Turkey</h4>
                <p class="p1"> When in Rome is overrated, however when in Istanbul is underrated.
                    Visit it's well known city centre, the Taksim square to shop and dine in its famous restaurants.</p>
                <br>
                <a href="searchFlights.php" class="btn"> Book a Ticket </a>
            </div>
            <div class="col">
                <img src="Assets/Dubai.jpg" alt="">
                <h4> Dubai, United Arab Emirates</h4>
                <p class="p1"> They say oasis are mirage's of the desert. Dubai proves this wrong.
                    Explore its diverse malls and be sure to visit the world's tallest building the Burj Khalifa.</p>
                <br>
                <a href="searchFlights.php" class="btn"> Book a Ticket </a>
            </div>
        </div>
    </section>
    <script src="JS/Navbar.js"></script>
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