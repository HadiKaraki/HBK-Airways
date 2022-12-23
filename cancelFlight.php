<?php

require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection1 = $client->airline->user;
$collection2 = $client->airline->user_flights;
$collection3 = $client->airline->flight;
$flight_id = $_POST["FlightID"];
$seatNb = intval($_POST['takenSeatNb']);
$UserflightID = intval($_POST["UserFlightID"]);
$bookedOrReserved = $_POST['bookedOrReserved'];
$username = $_COOKIE['username'];

// make the seat that was taken avaiable again
$flight = $collection3->findOne(["id" => $flight_id]);
$allSeats = $flight['seats'];
$allSeats[$seatNb - 1] = 0;

$collection3->updateOne(
    ['id' => $flight_id],
    ['$set' => ['seats' => $allSeats]]
);

$collection2->deleteOne(["_id" => $UserflightID]);

if ($bookedOrReserved == 'booked') {
    $collection1->updateOne(
        ['Username' => $username],
        ['$pull' => ['booked_flights' => $UserflightID]]
    );
    header("Location: bookedFlights.php");
} else {
    $collection1->updateOne(
        ['Username' => $username],
        ['$pull' => ['reserved_flights' => $UserflightID]]
    );
    header("Location: reservedFlights.php");
}
?>