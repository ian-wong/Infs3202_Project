<!DOCTYPE html>
<?php
    include 'connectMySQL.php';
    include 'function.php';
    session_start();

    if(isset($_SESSION['login_user'])){ 
        header("location: index.php");
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Login page for Quota">
    <meta name="author" content="Anthony Hanh & Ian Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Quest Hotel</title>

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
        <a href="index.php  " class="navbar-brand">
            <img src="img/logo.png" id="Logo" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <form class="form-inline">
                <input class="form-control mr-md-2" id="searchBar" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light " type="submit">Search</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php
                        isset_user();
                    ?>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Login Form -->
<div class="card">
    <div class="card-header">
        <h3 class="col-7 mb-1">Login</h3>
    </div>
    <div class="card-body">
        <form id="loginForm" action="SQLlogin.php" method="POST">
            <div class="form-group">
                
                <!--When login failed, redirect to this page, but have an extra text displays 'incorrect username or password' -->
                <?php
                    /*
                    if ($_POST['$error']){
                        echo $error;
                    }
                    */
                ?>
                <div class="col-7 mb-4 mt-4">
                    <label for="emailInput">Email address</label>
                    <input type="email" class="form-control" id="emailInput" placeholder="email@example.com" name="emailInput">
                </div>
            </div>
            <div class="form-group mb-5">
                <div class="col-7">
                    <label for="passwordInput">Password</label>
                    <input type="password" class="form-control" id="passwordInput" name="passwordInput">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-7">
                    <a href="signup.php" class="btn btn-primary">Sign Up</a>
                    <button type="submit" class="btn btn-primary">Log In</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>