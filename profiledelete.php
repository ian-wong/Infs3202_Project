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
            <img src="img/logo.png" id="Logo" class="d-inline-block align-top">
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
        <div class="card-header mb-4">
            <h3 class="col-7 mb-1 ">Are you sure you want to permanently delete your account? </h3>
        </div>
            <?php
                $uid = $_GET['uid'];

                echo '<form class="" id="hostForm" action="SQLprofiledelete.php?uid='.$uid.'" method="POST">';
            
                echo '<a href="profile.php?uid='.$uid.'" class="btn btn-primary">No, go back.</a>';
            ?>    
                <div class="col-md-7 ml-3 mt-4">
                    <button class="btn btn-danger" type="submit" name="submit">Yes, permanently delete account.</button>
                </div>  
            </form>
    </div>
</body>

</html>