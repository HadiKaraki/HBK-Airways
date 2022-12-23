<?php
require 'vendor/autoload.php';

if (!isset($_COOKIE['username'])) {
    header("Location: SignIn.php");
    die();
}

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection1 = $client->airline->user_flights;
$collection2 = $client->airline->user;
$user = $collection2->findOne(['Username' => $_COOKIE['username']]);
$allFlights = [];
if (count($user['booked_flights']) > 0) {
    foreach ($user['booked_flights'] as $flight_id) {
        $flight = $collection1->findOne(['_id' => $flight_id]);
        array_push($allFlights, $flight);
    }
    $currentDate = time();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked flights</title>
    <link rel="stylesheet" href="CSS/BookedFlights.css">
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
                            <?php endif; ?>
                            <a href="Account Information.php">Manage Account Details</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <?php if (count($user['booked_flights']) > 0): ?>
    <?php foreach ($allFlights as $flight): ?>
    <section id="container">
        <h1 style="color: red; text-decoration: underline;">Flight #
            <?php print($flight['flight']['id']) ?>
        </h1>
        <div id="flight">
            <p><label>From:</label>
                <?php print($flight['flight']['from']) ?>
            </p>
            <p><label>To:</label>
                <?php print($flight['flight']['destination']) ?>
            </p>
            <form action="editFlightInfo.php" method="GET">
                <input name="takenSeatNb" style="display: none;" value="<?php print($flight['seat_nb']) ?>">
                <input type="text" name="userFlightID" value="<?php print($flight['_id']) ?>" style="display: none;">
                <button id="editInfo">EDIT INFO</button>
            </form>
            <p><label>Seat:</label>
                <?php print($flight['seat_nb']) ?>
            </p>
            <form id="cancelForm" action="cancelFlight.php" method="POST">
                <input name="takenSeatNb" style="display: none;" value="<?php print($flight['seat_nb']) ?>">
                <input name="UserFlightID" style="display: none;" value="<?php print($flight['_id']) ?>">
                <input name="FlightID" style="display: none;" value="<?php print($flight['flight']['id']) ?>">
                <input name="bookedOrReserved" style="display: none;" value="booked">
                <button type="button" id="cancelBtn">Cancel</button>
            </form>
            <p><label>Departure on:</label>
                <?php print($flight['flight']['depart_on']) ?>,
                <?php print((isset($flight['flight']['departure_time'])) ? $flight['flight']['departure_time'] : $flight['flight']['departure_time1']) ?>
            <p style="color: red">
                <span id="daysLeft">
                    <?php print(floor((strtotime($flight['flight']['depart_on']) - $currentDate) / (60 * 60 * 24))) ?>
                </span>
                days left
            </p>
            </p>
        </div>
    </section>
    <?php endforeach; ?>
    <?php else: ?>
    <h3>No booked flights.</h3>
    <?php endif; ?>

    <footer>
        <a href="#"><i id="social-media" class="fa fa-facebook"></i></a>
        <a href="#"><i id="social-media" class="fa fa-twitter"></i></a>
        <a href="#"><i id="social-media" class="fa fa-linkedin"></i></a>
        <hr class="line">
        <p>&copy 2022 HBK Airways, Inc. <em>All Rights Reserved</em></p>
    </footer>
    <script src="JS/Navbar.js"></script>
    <script>
        var cancelBtns = document.querySelectorAll("#cancelBtn");
        var daysLeft = parseInt(document.getElementById('daysLeft').innerHTML);

        for (let button of cancelBtns) {
            button.addEventListener("click", submitForm);
        }

        function submitForm(e) {
            var response = false;
            if (daysLeft < 7) {
                response = confirm("Are you sure you want to cancel? (No fee will be returned since the flight would depart in less than a week!)");
            }
            else {
                response = confirm("Are you sure you want to cancel? (50% of the fee will be returned only)");
            }
            if (response) {
                e.target.form.submit();
            }
        }
    </script>
</body>

</html>