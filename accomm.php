<!DOCTYPE html>
<?php
    include("connectMySQL.php");

    session_start();

    //$aid = $_GET['id'];
    //$aresult = mysqli_query($conn, "SELECT * FROM accommodation WHERE aid = $aid");

?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Accommodation Finder">
        <meta name="author" content="Anthony Hanh & Ian Wong">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Quest Hotel</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">

        <!-- Lightbox CSS -->
        <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!-- Icon -->
        <link rel="icon" href="img/logo.png" />

        <!-- Bootstrap CDN -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
        <!-- JQuery from Google-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!-- Lightbox JS -->
        <script type="text/javascript" src="js/prototype.js"></script>
        <script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
        <script type="text/javascript" src="js/lightbox.js"></script>


    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <a href="index.php" class="navbar-brand">
                    <img src="img/logo.png" id="Logo" class="d-inline-block align-top">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <!-- Search Bar -->
                    <!-- also add functionality to search accommodations by name, location, user(host) by using dropdown list next to search bar -->
                    <form class="form-inline" action="searchResult.php" method="POST">
                        <!--Can use GET method-->
                        <input class="form-control mr-sm-2" id="searchBar" type="search" placeholder="Search" aria-label="Search" name="searchInput">
                        <!--type="search"-->
                        <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
                    </form>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="login.html">Account</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8 px-md-5 pt-md-4">
                        <div class="row">
                            <?php

                            $aid = $_GET['id'];    
                            $sqlselect = "SELECT * FROM accommodation WHERE aid='$aid'";
                            $result = mysqli_query($conn, $sqlselect);
                            
                            $row = mysqli_fetch_assoc($result);
                            $aid = $row['aid'];
                            $aphoto = '<img src = "SQLgetphoto.php?id='.$aid.'" class= img-fluid width=100%>';
                            $aname = $row['name'];
                            $aloc = $row['location'];
                            $adescr = $row['descr'];
                            
                            echo ($aphoto);

                            echo '<div class="col-md-12 mt-md-4">';
                            echo '<h4>'.$aname.'</h4>';
                            echo '<p>'.$aloc.'<p>';
                            echo '<p>'.$adescr.'<p>';
                            
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-md-4">
                    <div class="row">
                        <div class="col-sm-12 bg-primary">
                            <div class="row">
                                <?php
                                    $sqlhost = "SELECT * FROM  user, accommodation WHERE accommodation.aid='$aid' AND accommodation.uid=user.uid";
                                    $uresult = mysqli_query($conn, $sqlhost);

                                    $urow = mysqli_fetch_assoc($uresult);
                                    $uid = $urow['uid'];
                                    $uphoto = '<img src="SQLgetuphoto.php?id='.$uid.'" class="img-fluid">';
                                    $ufname = $urow['firstname'];
                                    $usname = $urow['surname'];
                                    
                                    echo "<div class='col-sm-3'>";
                                        echo $uphoto;
                                    echo "</div>";
                                    echo "<div class='col-sm-9'>";
                                            echo '<br/>';
                                        //echo '<div class="align-baseline">';
                                            echo '<h3>'.$ufname.' '.$usname. '</h3>';
                                        //echo '</div>';
                                    echo "</div>";
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-12 bg-danger">
                            <p>Calendar</p>
                        </div>
                    
                    </div>
                </div>
                
            </div>
            </div>

        </main>

    </body>

    </html>