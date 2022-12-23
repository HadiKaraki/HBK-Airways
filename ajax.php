<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->airline->flight;
$ID = $_GET["id"];
$flight = $collection->findOne(['id' => $ID]);
echo json_encode($flight);
?>