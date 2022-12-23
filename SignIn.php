<?php
if (isset($_COOKIE['username'])) {
    header('Location: mainpage.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Account: Login</title>
    <link rel="icon" type="image/x-icon" href="../Assets/Logo.jpeg">
    <link rel="stylesheet" href="CSS/Sign In.css" />
    <link rel="stylesheet" href="CSS/Navbar.css" />
    <link rel="stylesheet" href="CSS/Footer.css" />
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
                            <?php endif; ?>
                            <a href="Account Information.php">Manage Account Details</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>Login to HBK</h1>
        <br>
        <h5>Don't have an account? <a href="SignUp.php" style="text-decoration:none;color:blue">Sign-Up</a></h5>
        <br>
        <form method="POST" action="SignInForm.php" class="check-validation" novalidate>
            <div class="row">
                <div class="col-sm-6 p-2">
                    <label for="username">Username</label>
                    <input type="text" autocomplete="off" class="form-control" id="username" name="username" required>
                </div>
                <div class="col-sm-6 p-2">
                    <label for="pssword">Password</label>
                    <input type="password" class="form-control" id="pssword" name="pssword" required>
                    <div class="invalid-feedback">Please Enter Your password.</div>
                </div>
            </div>
            <script type="text/javascript" src="../JS/Validator.js">
            </script>
            <div class="row">
                <div class="col-sm-12 p-2">
                    <button type="submit" class="btn btn-primary" id="btnSubmit"> Sign In</button>
                </div>
            </div>
        </form>
    </div>
    <script src="JS/Validator.js"></script>
    <script src="JS/Navbar.js"></script>
</body>
<footer>
    <div class="social">
        <a href="#"><i id="social-media" class="fa fa-facebook"></i></a>
        <a href="#"><i id="social-media" class="fa fa-twitter"></i></a>
        <a href="#"><i id="social-media" class="fa fa-linkedin"></i></a>
    </div>
    <hr>
    <p>&copy 2022 HBK Airways, Inc. <em>All Rights Reserved</em></p>
</footer>

</html>