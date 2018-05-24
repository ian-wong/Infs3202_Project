<!DOCTYPE html>
<?php 
    include("connectMySQL.php");
    include 'function.php';

    session_start();
    if(!isset($_SESSION['login_user'])){
        header('location: login.php');
    }
?>

<html lang="en">
<head>
    <?php
        head_html();
    ?>

</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">
            <img src="images/logo.png" id="Logo" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <form class="form-inline" action="searchResult.php" method="POST">
                <input class="form-control mr-md-2" id="searchBar" type="search" placeholder="Search" onkeyup="showResult(this.value)" aria-label="Search" name="searchInput"> 
                <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
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
    <div class="card">
        <div class="card-header">
            <h3 class="col-7 mb-1">Add a mobile phone number to your Quest Hotel account</h3>
        </div>
        <div class="card-body">
            <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if($error == "empty"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Please fill out the phone field.</p>";
                        echo '</div>';
                    } 
                    elseif($error == "value"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Invalid values for phone number, please enter digits only.</p>";
                        echo '</div>';
                    } 
                    elseif($error == "error"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Unable to connect to server, please try again later.</p>";
                        echo '</div>';
                    } 
                }

                $uid = $_GET['uid'];
                echo '<form id="hostForm" action="SQLprofilephone.php?uid='.$uid.'" method="POST">';
            ?>
                <div class="col-md-5 ml-3 mb-4 bg-success">
                    <label for="phoneInput">You will receive sms updates from Quest Hotel (enter digits only, mobile only):</label>
                    <input type="tel" class="form-control" id="phoneInput" name="phoneInput" maxlength="10">
                </div>

                <div class="col-md-7 mt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Add a phone number</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
