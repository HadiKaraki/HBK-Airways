<?php
session_start();
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->airline->user;
$collection2 = $client->airline->flight;
$_SESSION['SeatNb'] = intval($_GET["seat_nb"]);
$_SESSION['FavSeat'] = $_GET["fav_seat"];
$_SESSION['FavMeal'] = $_GET["fav_meal"];
$_SESSION['FavDrink'] = $_GET["fav_drink"];
$user = $collection->findOne(['Username' => $_COOKIE['username']]);
$flight = $collection2->findOne(['id' => $_SESSION['flight_id']]);
$currentDate = time();
$TotalPrice = ($_SESSION['adult_price'] * $_SESSION['Adults_nb'] + $_SESSION['child_price'] * $_SESSION['Children_nb'] + $_SESSION['infant_price'] * $_SESSION['Infants_nb']);
if (isset($_GET['blankets'])) {
    $TotalPrice += 10;
    $_SESSION['Blankets'] = "Yes";
} else {
    $_SESSION['Blankets'] = "No";
}
if (isset($_GET['pillows'])) {
    $TotalPrice += 10;
    $_SESSION['Pillows'] = "Yes";
} else {
    $_SESSION['Pillows'] = "No";
}
if (isset($_GET['magazines'])) {
    $TotalPrice += 10;
    $_SESSION['Magazines'] = "Yes";
} else {
    $_SESSION['Magazines'] = "No";
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
                <?php print($_SESSION['FlightType']) ?> flight
            </h1>
            <div style="float: right;" class="to">
                <h2>To</h2>
                <p>
                    <?php print($_SESSION['Destination']) ?>
                </p>
            </div>
            <br>
            <div class="from">
                <h2>From</h2>
                <p>
                    <?php print($_SESSION['From']) ?>
                </p>
            </div>
            <?php if ($_SESSION['FlightType'] == 'Round trip'): ?>
            <div style="float: right;" class="return">
                <h2>Return on</h2>
                <p>
                    <?php print($_SESSION['ReturnDate']) ?>
                </p>
            </div>
            <?php endif; ?>
            <br>
            <div class="depart">
                <h2>Depart on</h2>
                <p>
                    <?php print($_SESSION['DepartDate']) ?>
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
            <button id="editInfo" onclick="history.back()">EDIT INFO</button>
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
                <input id="bookOrReserve" name="reserveOrBook" style="display: none;" value="">
                <button type="submit" id="bookBtn">BOOK FLIGHT</button>
                <hr>
                <p style="text-align: center;">or reserve for <span style="color: green">100$</span></p>
                <hr>
                <input name="dateDiffrence" style="display: none;"
                    value="<?php print(floor((strtotime($flight['depart_on']) - $currentDate) / (60 * 60 * 24))) ?>">
                <button type="submit" id="reserveBtn">RESERVE FLIGHT</button>
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
    <script>
        var bookButton = $("#bookBtn");
        var reserveBtn = $("#reserveBtn");
        var bookOrRes = $('#bookOrReserve');

        bookButton.click(book);
        reserveBtn.click(reserve);

        function book() {
            bookOrRes.val("book");
        }

        function reserve() {
            bookOrRes.val("reserve");
        }
    </script>
</body>

</html>