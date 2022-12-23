<?php

require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$usercollection = $client->airline->user;
$username = $_COOKIE["username"];
$result = $usercollection->findOne(['Username' => $username]);
$insertOneResult = $usercollection->updateOne(
    ['Username' => $username],
    [
        '$set' => [
            'First_Name' => $_POST["Fname"],
            'Middle_Name' => $_POST["Mname"],
            'Last_Name' => $_POST["Lname"],
            'Date_Of_Birth' => $_POST["birthday"],
            'Email_Address' => $_POST["mail"],
            'Phone_Number' => $_POST["phone"],
            'Username' => $_POST["username"],
            'Password' => $_POST["pssword"],
            'Credit_Card_Number' => $_POST["card_number"],
            'CVV' => $_POST["CVV"],
            'Expiry_Date' => $_POST["exp_date"],
        ]
    ]
);
echo '<script type="text/javascript">';
echo 'alert("Information has been succesfully changed ! Please Login again.");';
echo 'window.location.href = "SignIn.php";';
echo '</script>';
?>