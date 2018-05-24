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
     <!-- Google Maps API -->
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD556cffToiu6QUeMA370u-To2aBgcKngw&callback=initMap" async
            defer></script>

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
            <form class="form-inline" action="searchResult.php" method="POST"><!--Can use GET method-->
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
            <h3 class="col-7 mb-1">Host Your Own Accommodation</h3>
        </div>
        <div class="card-body">
            <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if($error == "empty"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Please fill out all fields.</p>";
                        echo '</div>';
                    } 
                    elseif($error == "photo"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>You uploaded an invalid file for the accommodation, please upload a photo.</p>";
                        echo '</div>';
                    } 
                    elseif($error == "error"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Unable to connect to server, please try again later.</p>";
                        echo '</div>';
                    } 
                }

                $uid = $_GET['uid'];
                echo '<form id="hostForm" action="SQLhost.php?uid='.$uid.'" method="POST" enctype="multipart/form-data">';
            ?>   
                <div class="col-md-5 ml-3 mb-4 bg-success">
                    <label for="nameInput">Title of Accommodation:</label>
                    <input type="text" class="form-control" id="nameInput" name="nameInput" maxlength="200">
                </div>
                
                <div class="form-group col-md-7 ml-3 mb-4 bg-primary">
                    <label for="locInput">Address of Accommodation: </label>
                    <input type="text" class="form-control" placeholder="12 Example St Brisbane QLD 4000  //   Street Address - Suburb and State - Postcode"
                    id="locInput" name="locInput" maxlength="200">
                </div>
                
                <div class="col-md-3 ml-3 bg-success">
                    <label>Pricing: </label>
                </div>
                <div class="col-md-2 ml-3 mb-4">
                    <div class="input-group">
                        <div class="input-group-addon "><b>$AUD </b></div>
                        <input class="form-control" type="text" name="priceInput">
                        <div class="input-group-addon"><b> per night</b></div>
                    </div>
                </div>
                
                <div class="col-md-8 ml-3 mb-4 bg-warning">
                    <label for="descInput">Description: </label>
                    <textarea class="form-control" rows="5" placeholder="Basic Description / Amenities / Arrangements / Rules / Cancellations - (Maximum 2000 characters)"
                        id="descInput" name="descInput"></textarea>
                </div>
            
                <div class="col-md-5 ml-3 bg-danger">
                    <label for="photoInput">Upload a Photo of Accommodation: </label><br>
                    <input type="file" id="photoInput" name="photoInput" />
                </div>
                <div class="col-md-7 mt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Host Accommodation!</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
