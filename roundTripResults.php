<?php
session_start();

require 'vendor/autoload.php';

$_SESSION['From'] = $_GET["from"];
$_SESSION['Destination'] = $_GET["destination"];
$_SESSION['DepartDate'] = $_GET["depart_date"];
$_SESSION['ReturnDate'] = $_GET["return_date"];
$_SESSION['Adults_nb'] = $_GET['adults'];
$_SESSION['Children_nb'] = $_GET['children'];
$_SESSION['Infants_nb'] = $_GET['infants'];
$_SESSION['FlightType'] = 'Round trip';
$_SESSION['TicketType'] = $_GET['ticketClass'];

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->airline->flight;

$results = $collection->find(
    ['type' => 'Round trip', 'from' => $_SESSION['From'], 'destination' => $_SESSION['Destination'], 'depart_on' => $_SESSION['DepartDate']],
    ['projection' => ['id' => 1, 'departure_time1' => 1, 'departure_time2' => 1]]
);
if ($results->isDead()) {
    echo "<p>No results found</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/RoundTripResults.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    <section id="flights">
        <!-- GENERATE HTML CODE FOR ALL RESULTS FOUND -->
        <?php foreach ($results as $entry): ?>
        <form action="preferences.php" method="GET">
            <div class="flight" id="<?php print($entry['id']) ?>">
                <input type="text" style="display: none;" value="<?php print($entry['id']) ?>" name="flight_id">
                <div id="go">
                    <p><i class="fa fa-plane" style="font-size:24px; margin-right: 10px;"></i><b
                            style="font-size: large; margin-right: 10px;">
                            <?php print($_SESSION['From']) ?>
                        </b> to <b style="font-size: large; margin-left: 10px;">
                            <?php print($_SESSION['Destination']) ?>
                        </b></p>
                    <p>
                        <?php print($_SESSION['DepartDate']) ?>
                    </p>
                    <div id="info1">
                        <h1>Departure time:</h1>
                        <h3>
                            <?php print($entry['departure_time1']) ?>
                        </h3>
                    </div>
                    <div id="info">
                        <h1>Arrival time:</h1>
                        <h3 id="arrival_time1">
                        </h3>
                    </div>
                    <div id="info">
                        <h1>Duration:</h1>
                        <h3 id="duration1">
                        </h3>
                    </div>
                    <div id="info">
                        <h1>Aircraft:</h1>
                        <h3 id="aircraft1">
                        </h3>
                    </div>
                    <div id="info">
                        <h1>Terminal:</h1>
                        <h3 id="terminal1">
                        </h3>
                        <button type="button" id="closeDetails">X</button>
                    </div>
                    <button type="button" id="showDetails">Show details</button>
                </div>
                <div id="return">
                    <p><i class="fa fa-plane"
                            style="font-size:24px; margin-right: 10px; transform: rotateY(180deg);"></i><b
                            style="font-size: large; margin-right: 10px;">
                            <?php print($_SESSION['Destination']) ?>
                        </b> to <b style="font-size: large; margin-left: 10px;">
                            <?php print($_SESSION['From']) ?>
                        </b></p>
                    <p>
                        <?php print($_SESSION['ReturnDate']) ?>
                    </p>
                    <div id="info1">
                        <h1>Departure time:</h1>
                        <h3>
                            <?php print($entry['departure_time2']) ?>
                        </h3>
                    </div>
                    <div id="info">
                        <h1>Arrival time:</h1>
                        <h3 id="arrival_time2">
                        </h3>
                    </div>
                    <div id="info">
                        <h1>Duration:</h1>
                        <h3 id="duration2">
                        </h3>
                    </div>
                    <div id="info">
                        <h1>Aircraft:</h1>
                        <h3 id="aircraft2">
                        </h3>
                    </div>
                    <div id="info">
                        <h1>Terminal:</h1>
                        <h3 id="terminal2">
                        </h3>
                    </div>
                    <button id="choose_btn">CHOOSE</button>
                </div>
            </div>
        </form>
        <?php endforeach; ?>
    </section>
    <script src="JS/Navbar.js"></script>
    <script src="JS/RoundtripResults.js"></script>
</body>

</html>