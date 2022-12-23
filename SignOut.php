<?php

if (!isset($_COOKIE['username'])) {
    header('Location: SignIn.php');
}

require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$usercollection = $client->airline->user;
$username = $_COOKIE["username"];
setcookie('username', $username, time() - (86400 * 30));
?>
<html>

<head>
    <title>Account Signed Out !</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/Form.css" />
    <script src="https://code.jquery.com/jquery-git.js"> </script>
</head>

<body>
    <header>
        <div class="content-header">
            <h1>Succesfully Signed Out!</h1>
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