<?php

if (!isset($_COOKIE['username'])) {
    header('Location: SignIn.php');
}

require 'vendor/autoload.php';

session_start();
$flightID = $_GET['flight_id'];
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->airline->flight;
$collection2 = $client->airline->user;
$collection3 = $client->airline->user_flights;
$flight = $collection->findOne(['id' => $flightID]);
$user = $collection2->findOne(['Username' => $_COOKIE['username']]);
foreach ($user['booked_flights'] as $flight_ID) {
    $result = $collection3->findOne(['_id' => $flight_ID]);
    if ($result['flight']['id'] == $flightID) {
        echo '<script type="text/javascript">';
        echo 'alert("Flight already booked");';
        echo 'window.location.href = "bookedFlights.php";';
        echo '</script>';
    }
}
foreach ($user['reserved_flights'] as $flight_ID) {
    $result = $collection3->findOne(['_id' => $flight_ID]);
    if ($result['flight']['id'] == $flightID) {
        echo '<script type="text/javascript">';
        echo 'alert("Flight already reserved");';
        echo 'window.location.href = "reservedFlights.php";';
        echo '</script>';
    }
}
$_SESSION['flight_id'] = $flightID;
if (!isset($_SESSION['flight_id'])) {
    header("Location: searchFlights.html");
    die();
}

$allAvailableSeats = [];
for ($i = 0; $i < count($flight['seats']); $i++) {
    if ($flight['seats'][$i] == 0) {
        array_push($allAvailableSeats, $i + 1);
    }
}

$TicketTypePrice = $flight[$_SESSION['TicketType']];
$_SESSION['adult_price'] = intval($flight['adult_ticket']) * $TicketTypePrice;
$_SESSION['child_price'] = intval($flight['child_ticket']) * $TicketTypePrice;
$_SESSION['infant_price'] = intval($flight['infant_ticket']) * $TicketTypePrice;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/preferences.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="CSS/Footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <form action="pay1.php" method="GET">
        <div id="container">
            <h1>Preferences and services</h1>
            <div id="preferences">
                <label>Pick seat number:</label>
                <select id="option" name="seat_nb" required>
                    <?php foreach ($allAvailableSeats as $seatNumber): ?>
                    <option>
                        <?php print($seatNumber) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <label>Your favorite meal:</label>
                <select id="option" name="fav_meal" required>
                    <option>Meat</option>
                    <option>Fish</option>
                    <option>Vegetarian</option>
                </select>
                <label>Your favorite seat:</label>
                <select id="option" name="fav_seat">
                    <option>Aisle</option>
                    <option>Window</option>
                </select>
                <label>Your favorite drink:</label>
                <select id="option" name="fav_drink">
                    <option>Drinks</option>
                    <option>Water</option>
                </select>
                <label style="font-weight: 100;" for="blankets">Blankets?</label>
                <input id="blankets" name="blankets" type="checkbox" style="cursor: pointer;">
                <label style="font-weight: 100;" for="pillows">Pillows?</label>
                <input id="pillows" name="pillows" type="checkbox" style="cursor: pointer;">
                <label style="font-weight: 100;" for="magazines">Magazines?</label>
                <input id="magazines" name="magazines" type="checkbox" style="cursor: pointer;">
                <label style="color: red;">+$10 each</label>
                <button id="contBtn">Continue</button>
            </div>
        </div>
    </form>
    <footer>
        <a href="#"><i id="social-media" class="fa fa-facebook"></i></a>
        <a href="#"><i id="social-media" class="fa fa-twitter"></i></a>
        <a href="#"><i id="social-media" class="fa fa-linkedin"></i></a>
        <hr class="line">
        <p>&copy 2022 HBK Airways, Inc. <em>All Rights Reserved</em></p>
    </footer>
    <script src="JS/Navbar.js"></script>
</body>

</html>