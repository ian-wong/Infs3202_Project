<!DOCTYPE html>

<?php
include 'connectMySQL.php';
include 'SQLsignup.php';

$db = new MySQLDatabase(); // create a Database object
$db->connect(“root”, “”, “3202database”); //Doesnt work, why? $db->connect(“quay”, “3202”, “3202database”);
    // do some database jobs.
$db->disconnect(); // disconnect after use is a good habit
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Login page for Quota">
    <meta name="author" content="Anthony Hanh & Ian Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Quest Hotel</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

    <!-- Icon -->
    <link rel="icon" href="img/logo.png"/>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <script src="js/loginJS.js" type="text/javascript"></script>

</head>

<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="index.html" class="navbar-brand">
            <img src="img/logo.png" id="Logo" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <form class="form-inline">
                <input class="form-control mr-sm-2" id="searchBar" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light " type="submit">Search</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.html">Account</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<?php
    /* Bad practice - trusting user input.
    if(isset($_POST['create'])){
        $sql = "INSERT INTO users (fname, password, email)
        VALUES ('".$_POST["fname"]."','".$_POST["password"]."','".$_POST["email"]."')";
    }
    */
?>

<div class="card">
    <div class="card-header">
        <h3 class="col-7 mb-1">Register</h3>
    </div>
    <div class="card-body">
        <form id="loginForm " action="SQLsignup.php">
            <!--User Input -->
            <div class="form-row">
                <div class="form-group col-md-5 ml-3 mb-4">
                    <label for="fNameInput">First Name</label>
                    <input type="text" class="form-control" id="fNameInput">
                </div>
                <div class="form-group col-md-5 ml-3 mb-4">
                    <label for="lNameInput">Last Name</label>
                    <input type="text" class="form-control" id="lNameInput">
                </div>
            </div>

            <div class="form-group">
                <div class="col-7 mb-4">
                    <label for="emailInputReg">Email address</label>
                    <input type="email" class="form-control" id="emailInputReg" placeholder="email@example.com">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5 ml-3">
                    <label for="passwordInput">Password</label>
                    <input type="password" class="form-control" id="passwordInput">
                </div>
                <div class="form-group col-md-5 ml-3">
                    <label for="confirmPassInput">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassInput">
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-7">
                    <button type="submit" class="btn btn-primary" name="create">Create Account</button>
                </div>
            </div>


        </form>
    </div>
</div>

</body>

</html>