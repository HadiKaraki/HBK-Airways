<?php
$dateDiffrence = intval($_GET['dateDiffrence']);
if ($dateDiffrence < 7) {
    echo '<script type="text/javascript">';
    echo 'alert("Flight will depart in less than a week. Cannot book anymore");';
    echo 'window.location.href = "reservedFlights.php";';
    echo '</script>';
}
session_start();
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->airline->user;
$collection2 = $client->airline->user_flights;
$userFlight = $collection2->findOne(['_id' => intval($_GET['flight_id'])]);
$user = $collection->findOne(['Username' => $_COOKIE['username']]);
$_SESSION['SeatNb'] = $userFlight['seat_nb'];
$_SESSION['FavSeat'] = $userFlight["fav_seat"];
$_SESSION['FavMeal'] = $userFlight["fav_meal"];
$_SESSION['FavDrink'] = $userFlight["fav_drink"];
$_SESSION['Adults_nb'] = $userFlight['adults'];
$_SESSION['Children_nb'] = $userFlight['children'];
$_SESSION['Infants_nb'] = $userFlight['infants'];
$_SESSION['SeatNb'] = $userFlight['seat_nb'];
$_SESSION['Blankets'] = $userFlight['blankets'];
$_SESSION['Pillows'] = $userFlight['pillows'];
$_SESSION['Magazines'] = $userFlight['magazines'];
$_SESSION['flight_id'] = $userFlight['flight']['id'];
$TotalPrice = ($userFlight['flight']['adult_ticket'] * $userFlight['adults'] + $userFlight['flight']['child_ticket'] * $userFlight['children'] + $userFlight['flight']['infant_ticket'] * $userFlight['infants']);
if ($userFlight['blankets'] == "Yes") {
    $TotalPrice += 10;
}
if ($userFlight['pillows'] == "Yes") {
    $TotalPrice += 10;
}
if ($userFlight['magazines'] == "Yes") {
    $TotalPrice += 10;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/pay.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="CSS/Footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <section id="container">
        <div id="left_side">
            <i class="fa fa-plane" style="font-size:24px; margin-right: 10px;"></i>
            <h1 style="text-align: center; text-decoration: underline; font-size: 30px;">
                <?php print($userFlight['flight']['type']) ?> flight
            </h1>
            <div style="float: right;" class="to">
                <h2>To</h2>
                <p>
                    <?php print($userFlight['flight']['destination']) ?>
                </p>
            </div>
            <br>
            <div class="from">
                <h2>From</h2>
                <p>
                    <?php print($userFlight['flight']['from']) ?>
                </p>
            </div>
            <?php if ($userFlight['flight']['type'] == 'Round trip'): ?>
            <div style="float: right;" class="return">
                <h2>Return on</h2>
                <p>
                    <?php print($userFlight['flight']['return_date']) ?>
                </p>
            </div>
            <?php endif; ?>
            <br>
            <div class="depart">
                <h2>Depart on</h2>
                <p>
                    <?php print($userFlight['flight']['depart_on']) ?>
                </p>
            </div>
            <br>
            <div style="float: right;" class="terminal">
                <h2>Terminal</h2>
                <p>10/15/2022</p>
            </div>
            <div class="aircraft">
                <h2>Aircraft</h2>
                <p>10/15/2022</p>
            </div>
            <br>
            <h2>Passengers:</h2>
            <div class="nb_of_passengers">
                <p>Adults:
                    <?php print($_SESSION['Adults_nb']) ?>,&nbsp;Children:
                    <?php print($_SESSION['Children_nb']) ?>,&nbsp;Infants:
                    <?php print($_SESSION['Infants_nb']) ?>
                </p>
            </div>
        </div>
        <div id="middle_side">
            <h1
                style="text-decoration: underline; text-align: center; font-size: 30px; margin-top: 38px; margin-right: 18px;">
                Preferences/Services:
            </h1>
            <label>Picked seat number:</label>
            <p id="option">
                <?php print($_SESSION['SeatNb']) ?>
            </p>
            <label>Your favorite meal:</label>
            <p id="option">
                <?php print($_SESSION['FavMeal']) ?>
            </p>
            <label>Your favorite seat:</label>
            <p id="option">
                <?php print($_SESSION['FavSeat']) ?>
            </p>
            <label>Your favorite drink:</label>
            <p id="option">
                <?php print($_SESSION['FavDrink']) ?>
            </p>
            <label>Blankets?</label>
            <p id="option">
                <?php print($_SESSION['Blankets']) ?>
            </p>
            <label>Pillows?</label>
            <p id="option">
                <?php print($_SESSION['Pillows']) ?>
            </p>
            <label>Magazines?</label>
            <p id="option">
                <?php print($_SESSION['Magazines']) ?>
            </p>
        </div>
        <div id="right_side">
            <form action="bookOrReserveFlight.php" method="POST">
                <h1
                    style="text-decoration: underline; text-align: center; font-size: 30px; margin-top: 40px; color: black;">
                    Total Price:
                </h1>
                <p style="color: #0DAD8D; font-size: 35px; margin-top: 30px; text-align: center; font-weight: bold;">
                    <span id="currency">$</span>
                    <span id="price">
                        <?php print($TotalPrice) ?>
                    </span>
                </p>
                <p>Currency:
                    <select id="changeCurrency" style="width: 100%;">
                        <option class="chosenCurr">Dollar</option>
                        <option class="chosenCurr">Euro</option>
                        <option class="chosenCurr">Pounds</option>
                    </select>
                </p>
                <label>Credit card</label>
                <input required name="card_nb"
                    value="<?php print((isset($user['card_number'])) ? $user['card_number'] : '') ?>" type="textbox"
                    placeholder="1111-2222-3333-4444"
                    style="width: 100%; margin-bottom: 10px; margin-top: 10px; height: 40px; font-size: 16px;">
                <p style="margin: 0; margin-bottom: 10px;"><label>Exp date</label> <label
                        style="margin-left: 185px;">CVV</label></p>
                <input required value="<?php print((isset($user['exp_date'])) ? $user['exp_date'] : '') ?>"
                    name="exp_date" placeholder="09/22" type="textbox" style="height: 40px; width: 30%;">
                <input required value="<?php print((isset($user['CVV'])) ? $user['CVV'] : '') ?>" name="cvv_nb"
                    placeholder="000" type="textbox" style="height: 40px; width: 30%; float: right;">
                <br>
                <input id="bookOrReserve" name="reserveOrBook" style="display: none;" value="bookFromReserve">
                <input name="userFlightID" style="display: none;" value="<?php print($userFlight['_id']) ?>">
                <button type="submit" id="bookBtn">BOOK FLIGHT</button>
            </form>
        </div>
    </section>
    <footer>
        <a href="#"><i id="social-media" class="fa fa-facebook"></i></a>
        <a href="#"><i id="social-media" class="fa fa-twitter"></i></a>
        <a href="#"><i id="social-media" class="fa fa-linkedin"></i></a>
        <br>
        <br>
        <p>&copy 2022 HBK Airways, Inc. <em>All Rights Reserved</em></p>
        <br>
    </footer>
    <script src="JS/Pay.js"></script>
    <script src="JS/Navbar.js"></script>
</body>

</html>