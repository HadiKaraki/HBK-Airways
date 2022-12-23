<?php
if (!isset($_COOKIE['username'])) {
    header('Location: SignIn.php');
}

require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->airline->user;
$user = $collection->findOne(['Username' => $_COOKIE['username']]);
if (!$user['admin']) {
    header('Location: mainpage.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/addFlight.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="CSS/Footer.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="//code.jquery.com/jquery-3.6.1.js"></script>
    <title>Document</title>
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
    <div id="container">
        <button id="oneWayBtn">One way</button>
        <button id="roundTripBtn">Round trip</button>
        <form action="addFlightToDB.php" method="POST">
            <input id="flightType" type="text" name="type" value="One way" style="display: none;">
            <div id="txt_field">
                <label>ID</label>
                <input type="text" name="id" required>
            </div>
            <div id="txt_field">
                <label>From</label>
                <select id="selectTo" name="from" required>
                    <option selected>From</option>
                    <option>Abu dhabi</option>
                    <option>Baghdad</option>
                    <option>Riyadh</option>
                    <option>Paris</option>
                </select>
            </div>
            <div id="txt_field">
                <label>Destination</label>
                <select id="selectTo" name="destination" required>
                    <option selected>From</option>
                    <option>Abu dhabi</option>
                    <option>Baghdad</option>
                    <option>Riyadh</option>
                    <option>Paris</option>
                </select>
            </div>
            <div id="txt_field">
                <label>Depart_on</label>
                <input type="date" name="depart_on" required>
            </div>
            <div id="txt_field">
                <label>Duration</label>
                <input type="text" name="duration" placeholder="3hr40min">
            </div>
            <section id="oneWaySection">
                <div id="txt_field">
                    <label>Departure time</label>
                    <input type="text" name="departure_time" placeholder="12:30 PM">
                </div>
                <div id="txt_field">
                    <label>Arrival time</label>
                    <input type="text" name="arrival_time">
                </div>
                <div id="txt_field">
                    <label>Aircraft</label>
                    <input type="text" name="aircraft">
                </div>
                <div id="txt_field">
                    <label>Terminal</label>
                    <input type="text" name="terminal">
                </div>
            </section>
            <section id="roundTripSection" style="display: none;">
                <div id="txt_field">
                    <label>Return_on</label>
                    <input type="date" name="return_on">
                </div>
                <div id="txt_field">
                    <label>Departure time1</label>
                    <input type="text" name="departure_time1" placeholder="12:30 PM">
                </div>
                <div id="txt_field">
                    <label>Arrival time1</label>
                    <input type="text" name="arrival_time1">
                </div>
                <div id="txt_field">
                    <label>Departure time2</label>
                    <input type="text" name="departure_time2" placeholder="12:30 PM">
                </div>
                <div id="txt_field">
                    <label>Arrival time2</label>
                    <input type="text" name="arrival_time2">
                </div>
                <div id="txt_field">
                    <label>Aircraft1</label>
                    <input type="text" name="aircraft1">
                </div>
                <div id="txt_field">
                    <label>Aircraft2</label>
                    <input type="text" name="aircraft2">
                </div>
                <div id="txt_field">
                    <label>Terminal1</label>
                    <input type="text" name="terminal1">
                </div>
                <div id="txt_field">
                    <label>Terminal2</label>
                    <input type="text" name="terminal2">
                </div>
            </section>
            <div id="txt_field">
                <label>Seats</label>
                <input type="text" name="seats" required>
            </div>
            <div id="txt_field">
                <label>Adult ticket</label>
                <input type="text" name="adult_ticket" required>
            </div>
            <div id="txt_field">
                <label>Child ticket</label>
                <input type="text" name="child_ticket" required>
            </div>
            <div id="txt_field">
                <label>Infant ticket</label>
                <input type="text" name="infant_ticket" required>
            </div>
            <div id="txt_field">
                <label>Business ticket</label>
                <input type="text" name="business_ticket" required>
            </div>
            <div id="txt_field">
                <label>Economy ticket</label>
                <input type="text" name="economy_ticket" required>
            </div>
            <div id="txt_field">
                <label>First class ticket</label>
                <input type="text" name="first_class_ticket" required>
            </div>
            <input type="submit" value="Add flight">
        </form>
    </div>
    <footer>
        <a href="#"><i id="social-media" class="fa fa-facebook"></i></a>
        <a href="#"><i id="social-media" class="fa fa-twitter"></i></a>
        <a href="#"><i id="social-media" class="fa fa-linkedin"></i></a>
        <hr class="line">
        <p>&copy 2022 HBK Airways, Inc. <em>All Rights Reserved</em></p>
    </footer>
    <script src="JS/AddFlight.js"></script>
    <script src="JS/Navbar.js"></script>
</body>

</html>