<!DOCTYPE html>
<?php 
    include("connectMySQL.php");
    
    session_start();

    //YouTube Data API request returns the JSON data that includes the information of the video
    $ytAPI_key    = 'AIzaSyC58pvE_Y0F8--HCIUVUfXaKNg1GcjSbNM';
    $ytChannelID  = 'UC2QGb0wattUTF82jpM3UL2w';
    $ytResults = 4;
    //retrieves video data, name, description etc. 
    $ytvideos = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$ytChannelID.'&maxResults='.$ytResults.'&key='.$ytAPI_key.''));
    
    $twitAPI_key = 'T0tQ4JGdEm4vb2Q31FFa9fRSL';
    $twitAPI_secret = "IU21cYDqrs3rOZm0NVTidNa0WidXMAlTshV97RHmPcNiXG16So";
    $twitToken = "996969380633182208-hZ8jwnPScjqBsg1Xg6ZBi6cweyfoaNV";
    $twitToken_secret = "B1vta4JRBQgqBZEu5rLLu8kdg53rFLUBGtZG2KAYz53OZ";

    require "twitter/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;
    //twitter API
    $twitconn = new TwitterOAuth($twitAPI_key, $twitAPI_secret, $twitToken, $twitToken_secret);
    //user info
    $user = $twitconn->get("account/verify_credentials");

    //paypal sandbox
    //sand-box account anthonysailou3-facilitator@gmail.com
    $paypAPI_key = 'Aa3JuAqm4QMvrZCRuwdxnjKjNgPa3cvlgK-co4EHkpQ-H3fIM-3W1dhfZQck3g-6b37cgYTWX3uIwqGf';
    $paypAPI_secret = 'EChbiuGJmDoqbzQstsI4c-sWwO5Jmhxdv4ex9FJa6nKnwrgfj0nEcP2emz8NGDyHnWE5iGZNdy0oPYlW';
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
        <h3 class="col-7 mb-1 ">Your donations to Quest Hotel</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="row">
            <?php 
                $selpay = "SELECT * FROM payment,user WHERE payment.uid=user.uid AND user.uid=$uid";
                $result = mysqli_query($conn, $selpay);
        
                //check if there are records
                if (mysqli_num_rows($result)<=0){
                    //print ($make);
                    echo 'no donations yo.';
                } else {
                    //there are values
                    //create a good ol table
                    echo "<table border='1'>
                        <tr>
                        <th>PayPal Id</th>
                        <th>PayPal Payment Id</th>
                        <th>Amount Donated AUD$</th>
                        </tr>";

                    while ($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>" . $row['payerid'] . "</td>";
                        echo "<td>" . $row['paymentid'] . "</td>";
                        echo "<td>" . $row['amount'] . "</td>";
                        echo "</tr>";
                    }
                    echo '</table>';
                }   
            ?>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>

</body>

</html>