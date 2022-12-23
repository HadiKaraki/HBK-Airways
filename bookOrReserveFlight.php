<?php
session_start();

require 'vendor/autoload.php';

$CardNb = $_POST['card_nb'];
$ExpDate = $_POST['exp_date'];
$CvvNb = $_POST['cvv_nb'];
$username = $_COOKIE['username'];
$bookOrRes = $_POST['reserveOrBook'];
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection1 = $client->airline->user;
$collection2 = $client->airline->user_flights;
$collection3 = $client->airline->flight;

$CardNbFormat = preg_match("/[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}/", $CardNb);
$ExpDateFormat = preg_match("/[0-9]{2}\/[0-9]{2}/", $ExpDate);
$CvvNbFormat = preg_match("/[0-9]{3}/", $CvvNb);

if ($CardNbFormat && $ExpDateFormat && $CvvNbFormat) {
    if ($bookOrRes != "bookFromReserve") {
        $flight = $collection3->findOne(['id' => $_SESSION['flight_id']]);
        $flight['seats'][$_SESSION['SeatNb'] - 1] = 1;
        $collection3->updateOne(['id' => $_SESSION['flight_id']], ['$set' => ['seats' => $flight['seats']]]);

        $random_id = rand(0, 1000000);
        $collection2->insertOne(
            [
                '_id' => $random_id,
                'flight' => $flight,
                'date_reserved' => time(),
                'adults' => $_SESSION['Adults_nb'],
                'children' => $_SESSION['Children_nb'],
                'infants' => $_SESSION['Infants_nb'],
                'seat_nb' => $_SESSION['SeatNb'],
                'fav_meal' => $_SESSION['FavMeal'],
                'fav_seat' => $_SESSION['FavSeat'],
                'fav_drink' => $_SESSION['FavDrink'],
                'blankets' => $_SESSION['Blankets'],
                'pillows' => $_SESSION['Pillows'],
                'magazines' => $_SESSION['Magazines']
            ]
        );
        if ($bookOrRes == "book") {
            $collection1->updateOne(
                ['Username' => $username],
                ['$push' => ['booked_flights' => $random_id]]
            );
            header("Location: bookedFlights.php");
        } else if ($bookOrRes == "reserve") {
            $dateDiffrence = intval($_POST['dateDiffrence']);
            if ($dateDiffrence < 7) {
                echo '<script type="text/javascript">';
                echo 'alert("Flight will depart in less than a week. Cannot reserve anymore");';
                echo 'window.location.href = "searchFlights.php";';
                echo '</script>';
            } else {
                $collection1->updateOne(
                    ['Username' => $username],
                    ['$push' => ['reserved_flights' => $random_id]]
                );
                header("Location: reservedFlights.php");
            }
        }
    } else {
        $UserflightID = intval($_POST['userFlightID']);
        $collection1->updateOne(
            ['Username' => $username],
            ['$push' => ['booked_flights' => $UserflightID]]
        );

        $collection1->updateOne(
            ['Username' => $username],
            ['$pull' => ['reserved_flights' => $UserflightID]]
        );
        header("Location: bookedFlights.php");
    }
    session_destroy();
} else {
    echo "Wrong format: check format of credit card number, expiration date or CVV number.";
}
?>