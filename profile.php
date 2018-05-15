<!DOCTYPE html>
<?php 
    include("connectMySQL.php");
    
    session_start();
    if(!isset($_SESSION['login_user'])){
        header('location: login.php');
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

    <style>
        a:link{
           color:black;
        }
        a:visited{
            color:black;
        }
        a:hover{
            color:blue;
        }
    </style>

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
            <!-- also add functionality to search accommodations by name, location, user(host) by using dropdown list next to search bar -->
            <form class="form-inline" action="searchResult.php" method="POST"><!--Can use GET method-->
                <input class="form-control mr-sm-2" id="searchBar" type="search" placeholder="Search" aria-label="Search" name="searchInput"> <!--type="search"-->
                <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
            </form>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php
                        if(isset($_SESSION['login_user']) ){  //&& isset($_SESSION['password'])){
                            
                            //header("location: index.php");
                            $email = $_SESSION['login_user'];
                            $sqlselect="SELECT * FROM user WHERE email='$email'";
                            $result = mysqli_query($conn, $sqlselect);
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                            echo '<a class="nav-link" href="profile.php">Welcome, '.$row['firstname'] .'</a>';
                        } else {
                            echo '<a class="nav-link" href="login.php">Account</a>';
                        }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!--col basic info-->
            <?php 
                //$make = '<h3>Something went wrong :(</h3>';
                
                //cant use this, because no 'id' to GET if not coming from index.php
                //$uid = $_GET['id'];
                //as Profile.php can only be accessed by user that is logged in then - 
                $uid = $row['uid'];
                $sqlselectuser = "SELECT * FROM user WHERE uid='$uid'";
                $result = mysqli_query($conn, $sqlselectuser);
        
                //check if there are records
                if ($make = mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
            
                    echo "<br>";
                    $uid = $row['uid'];
                    $uphoto = '<img src="SQLgetuphoto.php?id='.$uid.'" class="img-fluid">';
                    $ufname = $row['firstname'];
                    $usname = $row['surname'];
            
                    //retrieving user info
                    echo $uphoto;
                    echo '<div class="text-center">';
                        echo '<h3>'.$ufname.' '.$usname. '</h3>';
                    echo '</div>';

                } else {
                print ($make);
                }
            ?>
            
            <?php
                //host accommodation
                echo '<a href="host.php?id='.$uid.'" class="btn btn-block btn-primary"><h5>Host Accommodation</h5></a>';
                //<a href="host.php" class="btn btn-block btn-primary"><h4>Become a Host</h4></a>
            ?>
        </div>
        <div class="col-md-7">
            <!--col main info-->
            <br>
            <h2>Your hosted accommodations: </h2>
            <?php 
                $amake = '<h3>Something went wrong :(</h3>';
                //$uid = $_GET['id'];
                $sqlua = "SELECT * FROM user, accommodation WHERE user.uid=accommodation.uid AND user.uid=$uid";
                $aresult = mysqli_query($conn, $sqlua);
        
                //check if there are records
                if ($amake = mysqli_num_rows($aresult)>0){
                    while ($row = mysqli_fetch_assoc($aresult)){
                        echo '<div class="row mt-md-3" >';
                            echo '<div class=col-md-12>';
                                $uid = $row['uid'];
                                $aid = $row['aid'];
                                $aphoto = '<img src="SQLgetphoto.php?id='.$aid.'" class="img-fluid">';
                                $aname = $row['name'];
                                $aloc = $row['location'];
                                $adesc = $row['descr'];

                                //retrieving user info
                                //echo $aphoto;
                                $anamestr = '<h5>'.$aname.'</h5>';
                                $alocstr = '<h6>'.$aloc.'</h6>';
                                $adescstr = '<p>'.$adesc.'</p>';

                                echo ('<a target="_blank" href="accomm.php?id='.$aid. '">' . $aphoto  . '</a>'); 
                                echo ('<a target="_blank" href="accomm.php?id='.$aid. '">' . $anamestr  . '</a>');
                                echo ('<a target="_blank" href="accomm.php?id='.$aid. '">' . $alocstr  . '</a>');
                                echo ($adescstr);
                                echo '<a href="accommdelete.php?aid='.$aid.'" class="btn btn-danger">Delete this accommodation</a>';
                                echo '<br>';
                                echo '<br>';
                                echo '<br>';
                            echo '</div>';
                        echo "</div>"; 
                    }
                } else {
                    print ($amake);
                }
            ?>
        </div>
        <div class="col-md-2">
            <br>
            <!--Upload photo update name-->
            <?php
                echo '<a href="profilename.php?id='.$uid.'" class="btn btn-primary"><h5>Edit Profile Name</h5></a>';
            ?>
            <br>
            <br>
            <?php
                echo '<a href="profilephoto.php?id='.$uid.'" class="btn btn-primary"><h5>Edit Profile Picture</h5></a>';
            ?>
            <br>
            <br>
            <?php
                echo '<a href="profiledelete.php?id='.$uid.'" class="btn btn-warning"><h5>Delete Account</h5></a>';
            ?>
            <br>
            <br>
            <a href="logout.php" class="btn btn-danger"><h4>Log Out</h4></a>
        </div>
    </div>
</div>

</body>

</html>