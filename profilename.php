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
                <a class="nav-link" href="aboutus.php">About Us</a>
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
        <h3 class="col-7 mb-1 ">Edit Profile Name</h3>
    </div>
        <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if($error == "empty"){
                    echo '<div class="form-group col-md-12 ml-3 mb-4">';
                    echo "<p class='text-danger'>Please fill out all fields.</p>";
                    echo '</div>';
                } 
                elseif($error == "value"){
                    echo '<div class="form-group col-md-12 ml-3 mb-4">';
                    echo "<p class='text-danger'>You entered invalid values for your name, please enter characters only.</p>";
                    echo '</div>';
                } 
                elseif($error == "error"){
                    echo '<div class="form-group col-md-12 ml-3 mb-4">';
                    echo "<p class='text-danger'>Unable to connect to server, please try again later.</p>";
                    echo '</div>';
                } 
            }

            $uid = $_GET['uid'];
            echo '<form class="" id="hostForm" action="SQLprofilename.php?uid='.$uid.'" method="POST">';
        ?>
            <div class="form-row form-inline ml-3">
                <div class="col-md-4 ml-3 bg-success">
                    <h5>First name: </h5>
                    <input type="text" class="form-control" id="fNameInput" name="fNameInput" maxlength="30">
                </div>

                <div class="col-md-4 ml-3 bg-success">
                    <h5>Surname: </h5>
                    <input type="text" class="form-control" id="lNameInput" name="lNameInput" maxlength="30">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-7 ml-3 mt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Update Name</button>
                </div>
            </div>
        </form>
</div>
</body>

</html>