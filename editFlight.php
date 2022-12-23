<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection1 = $client->airline->user_flights;
$collection2 = $client->airline->flight;
$UserFlightID = intval($_POST['userFlightID']);
$userFlight = $collection1->findOne(['_id' => $UserFlightID]);
$flight_id = $userFlight['flight']['id'];
$flight = $collection2->findOne(['id' => $flight_id]);

$collection1->updateOne(
    ['_id' => $UserFlightID],
    [
        '$set' => [
            'fav_meal' => $_POST['fav_meal'],
            'fav_seat' => $_POST['fav_seat'],
            'fav_drink' => $_POST['fav_drink'],
            'blankets' => $_POST['blankets'],
            'pillows' => $_POST['pillows'],
            'magazines' => $_POST['magazines']
        ]
    ]
);

if (isset($_POST['changedSeatNb'])) {
    $ChangedSeatNb = intval($_POST['changedSeatNb']);
    $TakenSeatNb = intval($_POST['takenSeatNb']);
    $allSeats = $flight['seats'];
    $allSeats[$TakenSeatNb - 1] = 0;
    $allSeats[$ChangedSeatNb - 1] = 1;

    $collection2->updateOne(
        ['id' => $flight_id],
        ['$set' => ['seats' => $allSeats]]
    );
    $collection1->updateOne(
        ['_id' => $UserFlightID],
        [
            '$set' => [
                'seat_nb' => $ChangedSeatNb
            ]
        ]
    );
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>