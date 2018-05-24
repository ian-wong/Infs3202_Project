<?php

    function isset_user(){
        include 'connectMySQL.php';

        if(isset($_SESSION['login_user']) ){  //&& isset($_SESSION['password'])){
            $email = $_SESSION['login_user'];
            $sqlselect="SELECT * FROM user WHERE email='$email'";
            $result = mysqli_query($conn, $sqlselect);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $uid = $row['uid'];

            echo '<a class="nav-link" href="profile.php?uid='.$uid.'">Welcome, '.$row['firstname'] .'</a>';
            
        } else {
            echo '<a class="nav-link" href="login.php">Account</a>';
        } 
    }

    function head_html(){
        echo '<meta charset="UTF-8">';
        echo '<meta name="description" content="Accommodation Finder">';
        echo '<meta name="author" content="Anthony Hanh & Ian Wong">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';

        echo '<title>Quest Hotel</title>';

        echo '<!-- Bootstrap CSS -->';
        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';

        echo '<!-- Custom CSS -->';
        echo '<link rel="stylesheet" type="text/css" href="css/style.css"/>';
        echo '<!-- Icon -->';
        echo '<link rel="icon" href="images/logo.png"/>';

        echo '<!-- Bootstrap CDN -->';
        echo '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                crossorigin="anonymous"></script>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>';
        echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>';
        echo '<!-- JQuery from Google-->';
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
    }
?>