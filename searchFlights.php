<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Booking.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="CSS/Footer.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="//code.jquery.com/jquery-3.6.1.js"></script>
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

    <form action="onewayResults.php" method="GET" id="form">
        <button type="button" id="oneWayBtn" onlick="oneWay()"
            style="margin-left: 50px; margin-top: 40px; font-weight: bold; border: 0; padding: 15px; font-size: 20px; cursor: pointer; background-color: rgb(240, 240, 240);">One
            way</button>
        <button type="button" id="roundTripBtn" onlick="oneWay()"
            style="font-weight: bold; border: 0; padding: 15px; font-size: 20px; cursor: pointer; background-color: white">Round
            trip</button>
        <section id="container">
            <div class="left_side">
                <div class="reg_details">
                    <!-- This is just a sample to test the database (in reality more options would be available) -->
                    <select id="selectTo" name="from" required>
                        <option selected>From</option>
                        <option>Abu dhabi</option>
                        <option>Baghdad</option>
                        <option>Riyadh</option>
                        <option>Paris</option>
                        <option>London</option>
                        <option>Beirut</option>
                        <option>Damascus</option>
                        <option>Madrid</option>
                        <option>Cairo</option>
                        <option>Doha</option>
                        <option>Moscow</option>
                    </select>
                </div>
                <div class="reg_details">
                    <select id="selectFrom" name="destination" required>
                        <option selected>To</option>
                        <option>Abu dhabi</option>
                        <option>Baghdad</option>
                        <option>Riyadh</option>
                        <option>Paris</option>
                        <option>London</option>
                        <option>Beirut</option>
                        <option>Damascus</option>
                        <option>Madrid</option>
                        <option>Cairo</option>
                        <option>Doha</option>
                        <option>Moscow</option>
                    </select>
                </div>
                <div class="reg_details">
                    <span>Depart on</span>
                    <input type="date" id="depart_on_input" name="depart_date" required>
                </div>
                <div class="reg_details" id="return_on" style="display: none;">
                    <span id="return_to_span">Return on</span>
                    <input type="date" id="return_on_input" name="return_date">
                </div>
            </div>
            <div class="right_side">
                <section class="passengers">
                    <div class="pass_type">
                        <h1>Adults</h1>
                        <p>
                            <input type="number" value="1" id="input1" name="adults" min=1 />
                        </p>
                        <p>
                            <button type="button" class="minus" id="minus1">−</button>
                            <button type="button" class="plus" id="plus1">+</button>
                        </p>
                    </div>
                    <div class="pass_type">
                        <h1>Children</h1>
                        <p>
                            <input type="number" value="0" id="input2" name="children" min=0 />
                        </p>
                        <p>
                            <button type="button" class="minus" id="minus2">−</button>
                            <button type="button" class="plus" id="plus2">+</button>
                        </p>
                    </div>
                    <div class="pass_type">
                        <h1>Infants</h1>
                        <p>
                            <input type="number" value="0" id="input3" name="infants" min=0>
                        </p>
                        <p>
                            <button type="button" class="minus" id="minus3">−</button>
                            <button type="button" class="plus" id="plus3">+</button>
                        </p>
                    </div>
                </section>
                <select id="ride_class" name="ticketClass" required style="cursor: pointer;">
                    <option selected>Ticket class</option required>
                    <option>Economy</option>
                    <option>Business</option>
                    <option>First class</option>
                </select>
                <button type="submit" id="search">SEARCH</button>
            </div>
        </section>
    </form>
    <footer>
        <a href="#"><i id="social-media" class="fa fa-facebook"></i></a>
        <a href="#"><i id="social-media" class="fa fa-twitter"></i></a>
        <a href="#"><i id="social-media" class="fa fa-linkedin"></i></a>
        <hr class="line">
        <p>&copy 2022 HBK Airways, Inc. <em>All Rights Reserved</em></p>
    </footer>
    <script src="JS/SearchFlights.js"></script>
    <script src="JS/Navbar.js"></script>
</body>

</html>