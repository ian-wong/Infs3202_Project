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
            <h3 class="col-7 mb-1 ">Update Profile Picture</h3>
        </div>
            <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if($error == "photo"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Invalid file uploaded for profile picture, please upload</p>";
                        echo '</div>';
                    }
                }
                
                $uid = $_GET['uid'];
                echo '<form class="" id="hostForm" action="SQLprofilephoto.php?uid='.$uid.'" method="POST" enctype="multipart/form-data">';
            ?>
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