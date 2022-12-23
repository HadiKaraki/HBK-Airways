<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$usercollection = $client->airline->user;
$username = $_POST["username"];
$password = $_POST["pssword"];
$result = $usercollection->findOne(['Username' => $username,]);

if (isset($result)) {
    if ($result['Password'] == $password) {
        setcookie('username', $username, time() + (86400 * 30));
        header('Location: Mainpage.php');
    } else if ($result['Password'] != $password) {
        echo '<script type="text/javascript">';
        echo 'alert("Incorrect Username/Password");';
        echo 'window.location.href = "SignIn.php";';
        echo '</script>';

    }
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Incorrect Username/Password");';
    echo 'window.location.href = "SignIn.php";';
    echo '</script>';
}
?>