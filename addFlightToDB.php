<?php

require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->airline->flight;

$ID = $_POST["id"];
$Type = $_POST["type"];
$From = $_POST["from"];
$Destination = $_POST["destination"];
$Depart_on = $_POST["depart_on"];
$Return_on = $_POST["return_on"];
$SeatsNb = intval($_POST["seats"]);
$allSeats = [];
for ($i = 0; $i < $SeatsNb; $i++) {
    array_push($allSeats, 0);
}
$AdultTicket = $_POST["adult_ticket"];
$ChildTicket = $_POST["child_ticket"];
$InfantTicket = $_POST["infant_ticket"];
$Duration = $_POST["duration"];
$BusinessTicket = intval($_POST["business_ticket"]);
$EconomyTicket = intval($_POST["economy_ticket"]);
$FirstClassTicket = intval($_POST["first_class_ticket"]);

if ($Type != "One way") {
    $DepartureTime1 = $_POST["departure_time1"];
    $DepartureTime2 = $_POST["departure_time2"];
    $ArrivalTime1 = $_POST["arrival_time1"];
    $ArrivalTime2 = $_POST["arrival_time2"];
    $Aircraft1 = $_POST["aircraft1"];
    $Aircraft2 = $_POST["aircraft2"];
    $Terminal1 = $_POST["terminal1"];
    $Terminal2 = $_POST["terminal2"];
    $result = $collection->insertOne(
        [
            'id' => $ID,
            'type' => $Type,
            'from' => $From,
            'destination' => $Destination,
            'depart_on' => $Depart_on,
            'return_on' => $Return_on,
            'departure_time1' => $DepartureTime1,
            'arrival_time1' => $ArrivalTime1,
            'duration' => $Duration,
            'departure_time2' => $DepartureTime2,
            'arrival_time2' => $ArrivalTime2,
            'aircraft1' => $Aircraft1,
            'aircraft2' => $Aircraft2,
            'terminal1' => $Terminal1,
            'terminal2' => $Terminal2,
            "seats" => $allSeats,
            "adult_ticket" => $AdultTicket,
            "child_ticket" => $ChildTicket,
            "infant_ticket" => $InfantTicket,
            "Business" => $BusinessTicket,
            "Economy" => $EconomyTicket,
            "First class" => $FirstClassTicket
        ]
    );
} else {
    $DepartureTime = $_POST["departure_time"];
    $ArrivalTime = $_POST["arrival_time"];
    $Aircraft = $_POST["aircraft"];
    $Terminal = $_POST["terminal"];
    $result = $collection->insertOne(
        [
            'id' => $ID,
            'type' => $Type,
            'from' => $From,
            'destination' => $Destination,
            'depart_on' => $Depart_on,
            'departure_time' => $DepartureTime,
            'arrival_time' => $ArrivalTime,
            'duration' => $Duration,
            'aircraft' => $Aircraft,
            'terminal' => $Terminal,
            "seats" => $allSeats,
            "adult_ticket" => $AdultTicket,
            "child_ticket" => $ChildTicket,
            "infant_ticket" => $InfantTicket,
            "Business" => $BusinessTicket,
            "Economy" => $EconomyTicket,
            "First class" => $FirstClassTicket
        ]
    );
}

echo "<p>The new Flight was inserted with Database ID: '" . $result->getInsertedId() . "'</p>";
?>