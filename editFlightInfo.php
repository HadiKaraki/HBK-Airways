<?php
require 'vendor/autoload.php';

if (!isset($_GET['userFlightID'])) {
    header('Location: bookedFlights.php');
}

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection1 = $client->airline->user_flights;
$collection2 = $client->airline->flight;
$collection3 = $client->airline->user;
$UserFlightID = intval($_GET['userFlightID']);
$userFlight = $collection1->findOne(['_id' => $UserFlightID]);
$flight = $collection2->findOne(['id' => $userFlight['flight']['id']]);
$user = $collection3->findOne(['Username' => $_COOKIE['username']]);

$allAvailableSeats = [];
for ($i = 0; $i < count($flight['seats']); $i++) {
    if ($flight['seats'][$i] == 0) {
        array_push($allAvailableSeats, $i + 1);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/EditFlightInfo.css">
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
    <!-- <h1 style="text-align: center;">Edit flight information</h1> -->
    <section id="container">
        <form action="editFlight.php" method="POST">
            <div id="left_side">
                <input type="text" name="changedInfo" value="true" style="display: none;">
                <h1
                    style="text-decoration: underline; text-align: center; font-size: 30px; margin-top: 38px; margin-right: 18px;">
                    Preferences/Services:
                </h1>
                <label>Picked seat number:</label>
                <select id="option" name="changedSeatNb">
                    <?php foreach ($allAvailableSeats as $seatNumber): ?>
                    <option>
                        <?php print($seatNumber) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <label>Your favorite meal:</label>
                <select id="option" name="fav_meal" required>
                    <option selected>
                        <?php print($userFlight['fav_meal']) ?>
                    </option>
                    <option>Meat</option>
                    <option>Fish</option>
                    <option>Vegetarian</option>
                </select>
                <label>Your favorite seat:</label>
                <select id="option" name="fav_seat">
                    <option selected>
                        <?php print($userFlight['fav_seat']) ?>
                    </option>
                    <option>Aisle</option>
                    <option>Window</option>
                </select>
                <label>Your favorite drink:</label>
                <select id="option" name="fav_drink">
                    <option selected>
                        <?php print($userFlight['fav_drink']) ?>
                    </option>
                    <option>Drinks</option>
                    <option>Water</option>
                </select>
                <label style="font-weight: bold;" for="blankets">Blankets?</label>
                <input id="blankets" name="blankets" type="checkbox" style="cursor: pointer;">
                <label style="font-weight: bold;" for="pillows">Pillows?</label>
                <input id="pillows" name="pillows" type="checkbox" style="cursor: pointer;">
                <label style="font-weight: bold;" for="magazines">Magazines?</label>
                <input id="magazines" name="magazines" type="checkbox" style="cursor: pointer;">
                <label style="color: red;">+$10 each</label>
                <input style="display: none;" name="userFlightID" value="<?php print($UserFlightID) ?>">
            </div>
            <div id="right_side">
                <h1
                    style="text-decoration: underline; text-align: center; font-size: 30px; margin-top: 40px; color: black;">
                    Total Price:
                </h1>
                <p style="color: #0DAD8D; font-size: 35px; margin-top: 30px; text-align: center; font-weight: bold;">
                    <span id="currency">$</span>
                    <span id="price">0</span>
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
                <input name="takenSeatNb" value="<?php print($userFlight['seat_nb']) ?>" style="display: none;">
                <button type="submit" id="bookBtn">EDIT FLIGHT</button>
            </div>
        </form>
    </section>
    <footer>
        <a href="#"><i id="social-media" class="fa fa-facebook"></i></a>
        <a href="#"><i id="social-media" class="fa fa-twitter"></i></a>
        <a href="#"><i id="social-media" class="fa fa-linkedin"></i></a>
        <hr class="line">
        <p>&copy 2022 HBK Airways, Inc. <em>All Rights Reserved</em></p>
    </footer>
    <script>
        var blanketsCheck = $("#blankets");
        var pillowsCheck = $("#pillows");
        var magazinesCheck = $("#magazines");
        var priceSpan = $('#price');
        var price = parseInt(priceSpan.text());

        blanketsCheck.click(addPrice);
        pillowsCheck.click(addPrice);
        magazinesCheck.click(addPrice);
        function addPrice(e) {
            if (e.target.checked) {
                price += 10;
            }
            else {
                price -= 10;
            }
            priceSpan.html(price);
        }
    </script>
    <script src="JS/Navbar.js"></script>
</body>

</html>