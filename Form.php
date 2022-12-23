<?php

require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$usercollection = $client->airline->user;
$username = $_POST["username"];
$result = $usercollection->findOne(['Username' => $username]);
if (isset($result)) {
    echo '<script type="text/javascript">';
    echo 'alert("Email Already Exists in our Database");';
    echo 'window.location.href = "SignIn.php";';
    echo '</script>';

} else {
    $insertOneResult = $usercollection->insertOne([
        'First_Name' => $_POST["Fname"],
        'Middle_Name' => $_POST["Mname"],
        'Last_Name' => $_POST["Lname"],
        'Gender' => $_POST["gender"],
        'Date_Of_Birth' => $_POST["birthday"],
        'Nationality' => $_POST["country"],
        'Email_Address' => $_POST["mail"],
        'Phone_Number' => $_POST["phone"],
        'Username' => $_POST["username"],
        'Password' => $_POST["pssword"],
        'card_number' => $_POST["card_number"],
        'CVV' => $_POST["CVV"],
        'exp_date' => $_POST["exp_date"],
        'booked_flights' => [],
        'reserved_flights' => []
    ]);
    setcookie('username', $username, time() + (86400 * 30));
}
?>

<html>

<head>
    <title>Submission Confirmed !</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="CSS/Form.css" />
    <script src="https://code.jquery.com/jquery-git.js"> </script>

</head>

<body>
    <header>
        <div class="content-header">
            <h1>Welcome!</h1>
            <h2>We thank you for registering with HBK Airways.</h2>
            <h2> Kindly click on the button below to be redirected to the main page.</h2>
            <div class="line1"></div>
            <br>
            <div class="redirect">
                <button>Homepage</button>
            </div>

        </div>
    </header>

    <script>
        $("button").click(function () {
            $(".redirect").text("Redirecting to Homepage....").css({ "color": "black", "font-weight": "bold", "font-family": "Segoe UI" });

            let delay = 5000;
            let url = "Mainpage.php";
            setTimeout(function () {
                location = url;
            }, 5000)
        })
    </script>
</body>

</html>