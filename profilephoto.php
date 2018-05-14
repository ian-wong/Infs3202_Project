<!DOCTYPE html>
<?php 
    include("connectMySQL.php");
    
    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Accommodation Finder">
    <meta name="author" content="Anthony Hanh & Ian Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quest Hotel</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Lightbox CSS -->
    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <!-- Icon -->
    <link rel="icon" href="img/logo.png"/>

    <!-- Bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <!-- JQuery from Google-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Lightbox JS -->
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript"
            src="js/scriptaculous.js?load=effects,builder"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
     <!-- Google Maps API -->
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD556cffToiu6QUeMA370u-To2aBgcKngw&callback=initMap" async
            defer></script>

</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">
            <img src="img/logo.png" id="Logo" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            
            <!-- Search Bar -->
            <form class="form-inline" action="searchResult.php" method="POST"><!--Can use GET method-->
                <input class="form-control mr-sm-2" id="searchBar" type="search" placeholder="Search" onkeyup="showResult(this.value)" aria-label="Search" name="searchInput"> 
                <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
            </form>
             <!-- Add functionality to search accommodations by name, location, user(host) by using dropdown list next to search bar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php
                        if(isset($_SESSION['login_user']) ){  //&& isset($_SESSION['password'])){
                            //header("location: index.php");
                            $email = $_SESSION['login_user'];
                            $sqlselect="SELECT * FROM user WHERE email='$email'";
                            $result = mysqli_query($conn, $sqlselect);
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            $uid = $row['uid'];

                            echo '<a class="nav-link" href="profile.php?id='.$uid.'">Welcome, '.$row['firstname'] .'</a>';
                        } else {
                            echo '<a class="nav-link" href="login.php">Account</a>';
                        } 
                    ?>
                </li>
            </ul>

            
        </div>
    </nav>
</header>
<div class="card">
        <div class="card-header mb-4">
            <h3 class="col-7 mb-1 ">Update Profile Picture</h3>
        </div>
            <?php
                echo '<form class="" id="hostForm" action="SQLprofilephoto.php?uid='.$uid.'" method="POST" enctype="multipart/form-data">';
            ?>
                <!--User Input -->
                
                <div class="col-md-5 ml-3 bg-danger">
                    <label for="photoInput">Select new profile picture </label><br>
                    <input type="file" id="photoInput" name="photoInput" />
                </div>
                
                <div class="col-md-7 ml-3 mt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Update Profile Picture</button>
                </div>
                
            </form>
    </div>

</body>

</html>