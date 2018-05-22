<!DOCTYPE html>
<?php 
    include("connectMySQL.php");
    include 'function.php';

    session_start();
    if(!isset($_SESSION['login_user'])){
        header("location: login.php");
    }
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
                <input class="form-control mr-md-2" id="searchBar" type="search" placeholder="Search" aria-label="Search" name="searchInput"> <!--type="search"-->
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <?php
                $luemail = $_SESSION['login_user'];
                $uid = $_GET['uid'];
                $sqlhost = "SELECT * FROM user WHERE uid='$uid'";
                $result = mysqli_query($conn, $sqlhost);

                $row = mysqli_fetch_assoc($result);
                $hostemail = $row['email'];
                $hostphoto = '<img src="SQLgetuphoto.php?uid='.$uid.'" class="img-fluid">';
                $hostfname = $row['firstname'];
                $hostsname = $row['surname'];

                echo "<br />";
                echo '<div class="row">';
                    echo "<div class='col-md-3'>";
                        echo $hostphoto;
                    echo "</div>";
                    echo "<div class='col-md-9'>";
                            echo '<br/>';
                            echo '<h3>'.$hostfname.' '.$hostsname. '</h3>';
                    echo "</div>";
                echo '</div>';
                echo '</br>';
                echo "<h5>Email ".$hostfname. " " .$hostsname." the host of this accommodation</h5>";

                echo '<form method="POST" action="SQLemail.php">';
                    echo '<label for="fromemail">From:</label>';
                    echo '<input type="text" class="form-control" id="fromemail" value="'.$luemail.'" name="fromemail"></br>';

                    echo '<label for="toemail">To:</label>';
                    echo '<input type="text" class="form-control" id="toemail" value="'.$hostemail.'" name="toemail"></br>';
                    
                    echo '<label for="subject">Subject:</label>';
                    echo '<input type="text" class="form-control" id="subject" name="subject"></br>';

                    echo '<label for="message">Comment:</label>';
                    echo '<textarea class="form-control" rows="5" id="message" name="message"></textarea></br>';
                    
                    echo '<button type="submit" name="submit" class="btn btn-primary">Send Email</button>';
                echo '</form>';
            ?>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>
    

</body>

</html>

