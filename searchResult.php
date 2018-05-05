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
        <!-- Google Maps API -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD556cffToiu6QUeMA370u-To2aBgcKngw&callback=initMap" async
            defer></script>
        <!-- Lightbox JS -->
        <script type="text/javascript" src="js/prototype.js"></script>
        <script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
        <script type="text/javascript" src="js/lightbox.js"></script>


    </head>

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
                            <?php
                        if(isset($_SESSION['login_user']) ){  //&& isset($_SESSION['password'])){
                            //header("location: index.php");
                            $email = $_SESSION['login_user'];
                            $sqlselect="SELECT firstname FROM user WHERE email='$email'";
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

        <div class="container-fluid">
            <!--
        <div class="page-header">
            <h1>page header inside container</h1>
        </div>
        -->
            <div class="row">
                <div class="col-md-8 bg-danger">
                    <!--for accomms-->
                    <div class="row">
                        <?php
                        $searchInput = $_POST['searchInput'];

                        if(empty($searchInput)){
                            //$make = '<h3>input values to search</h3>';
                            //=print ($make);
                            echo '<script language="javascript">';
                            echo 'alert("Input value")';
                            echo '</script>';

                        } else {
                            $make = '<h3>Sorry, no matches found</h3>';
                            $sqlselect = "SELECT * FROM accommodation WHERE location LIKE '%".$searchInput."%'";
                            $result = mysqli_query($conn, $sqlselect);
                
                            if($make = mysqli_num_rows($result) > 0){
                
                                while($row = mysqli_fetch_assoc($result)){
        
                                    echo '<div class="col-md-5  bg-warning" >';
                                    echo '<br/>';

                                    $aid = $row['aid'];
                                    $aphoto = '<img src="SQLgetphoto.php?id='.$row['aid'].'" class="img-fluid">';
                                    $aname = $row['name'];
                                    $aloc = $row['location'];


                                    //retrieving accomm info, they become links to accomm pages, identified as their own accomm id
                                    echo ('<a target="_blank" href="accomm.php?id='.$aid. '">' . $aphoto  . '</a>');     
                                    echo ('<h5><a target="_blank" class="text-dark" href="accomm.php?id='.$aid. '">' . $aname  . '</a></h5>');     
                                    echo ('<h7><a target="_blank" class="text-dark" href="accomm.php?id='.$aid. '">' . $aloc  . '</a></h7>');     
                                    
                                    //echo '<h5>' . $row['name'] . '</h5>'; //accomm name
                                    //echo '<h7>' . $row['location'] . '</h7>'; //accomm location
                                    //echo '<br>'; 

                                    echo "</div>";
                                }
                                
                            } else { 
                                echo '<h3> search result </h3>';
                                print ($make); // no matches found
                            }
                        }

                            /*
                        $num = 10;
                        while($num > 0 ){
                            echo '<div class="col-md-4">';
                            echo "Containers provide a means to center and 
                            horizontally pad your site’s contents. Use .container 
                            for a responsive pixel width or .container-fluid for 
                            width: 100% across all viewport and device sizes.
                            Rows are wrappers for columns. END OF TEXT";
                            echo "<br/>";
                            echo "</div>";
                            $num--;
                        }
                        */
                    ?>
                            <!--</div>-->
                    </div>
                </div>
                <div class="col-sm-4 bg-primary">
                    <div class="row">
                        <div class="col-sm-12 bg-success">hi
                            <div id="map height=100%"></div>
                            <script>
                                var map;
                                function initMap() {
                                    map = new google.maps.Map(document.getElementById('map'), {
                                        center: {
                                            lat: -34.397,
                                            lng: 150.644
                                        },
                                        zoom: 8
                                    });
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <?php
    /*
    //if($_REQUEST['submit']){
        $searchInput = $_POST['searchInput'];

        if(empty($searchInput)){
            $make = '<h3>input values to search</h3>';
            print ($make);
        } else {
            $make = '<h3>Sorry, no matches found</h3>';
            $sqlselect = "SELECT * FROM accommodation WHERE location LIKE '%".$searchInput."%'";
            $result = mysqli_query($conn, $sqlselect);

            if($make = mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_assoc($result)){

                    echo '<img src="SQLgetphoto.php?id='.$row['aid'].'" />'; //width="300" height="200" />';
                    
                    echo '<br><h4>Name: ' . $row['name'] . '</h4>';
                    echo '<br><h5>Location: ' . $row['location'] . '</h5>';
                    echo '<br>'; 
                }
                
            } else { 
                echo '<h3> search result </h3>';
                print ($make); // no matches found
            }
            mysqli_free_result($result);
        }
    //} else {
      //  echo "else'd the first if";
    //}
    */
    
    $conn->close();

?>

    </body>

    </html>