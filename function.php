<?php

    function isset_user(){
        include 'connectMySQL.php';

        if(isset($_SESSION['login_user']) ){  //&& isset($_SESSION['password'])){
            $email = $_SESSION['login_user'];
            $sqlselect="SELECT * FROM user WHERE email='$email'";
            $result = mysqli_query($conn, $sqlselect);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $uid = $row['uid'];

            echo '
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="profile.php?uid='.$uid.'">Welcome, '.$row['firstname'] .'</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="profile.php?uid='.$uid.'">View Profile</a>
                            <a class="dropdown-item" href="profilename.php?uid='.$uid.'">Edit Name</a>
                            <a class="dropdown-item" href="profilephoto.php?uid='.$uid.'">Edit Profile Picture</a>
                            <a class="dropdown-item" href="logout.php">Log Out</a>
                        </div>
                    </li>';

            
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

    function header_nav(){
        echo '
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <a href="index.php" class="navbar-brand">
                    <img src="images/logo.png" id="Logo" class="d-inline-block align-top">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <form class="form-inline" action="searchResult.php" method="POST">
                        <input class="form-control mr-md-2" id="searchBar" type="search" placeholder="Search" aria-label="Search" name="searchInput">
                        <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
                    </form>

                    <ul class="navbar-nav ml-auto">
                    <a class="nav-link" href="aboutus.php">About Us</a>
                        <li class="nav-item">
                        ';
                            echo isset_user();
                        echo '     
                        </li>
                    </ul>
                </div>
            </nav>';
    }

    function accomm_info($row){
        $aid = $row['aid'];
        $aphoto = '<img src="SQLgetphoto.php?aid='.$row['aid'].'" class="img-fluid">';
        $aname = $row['name'];
        $aloc = $row['location'];

        echo ('<a target="_blank" href="accomm.php?aid='.$aid. '">' . $aphoto  . '</a>');     
        echo ('<h5><a target="_blank" class="text-dark" href="accomm.php?aid='.$aid. '">' . $aname  . '</a></h5>');
            
    }
?>