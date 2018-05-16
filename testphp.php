<!DOCTYPE html>
<?php
include("connectMySQL.php");

    //YouTube Data API request returns the JSON data that includes the information of the video
    //Get videos from channel by YouTube Data API
    $API_key    = 'AIzaSyC58pvE_Y0F8--HCIUVUfXaKNg1GcjSbNM';
    $channelID  = 'UCXhEVz35SzaTuLey3L5TGVA';
    $maxResults = 10;

    $videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.''));
    

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

    <div class="container">
        <div class="row">
            <div class="col-md">
                <h3>test test </h3>
                
                <?php 

                    /*
                    echo 'work please<br/>';
                
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    //also dbname
                    $dbname = "3202database";
                
                    //Create connection 
                    $conn = new mysqli($servername, $username, $password, $dbname);
                
                    //Check connection
                    if ($conn->connect_error){
                        die("Connection failed: " . $conn->connect_error);
                    } 
                    
                    echo "Connected Successfully<br>";

                    */
                    
                    /*
                    //inserting data to database
                    $sqlinsert = "INSERT INTO user (firstname, surname, email, password) VALUES ('testfname', 'testlname', 'testemail@t.co', '1234567890')";
                    if ($conn->query($sqlinsert) === TRUE){ //=== is 'equal and of same type'
                        echo "new record entered<br/>";
                    } else {
                        echo "Error: " . $sqlinsert . "<br>" . $conn->error . "<br>";
                    }
                    */

                        //retrieving data from database
                    $sqlselect = "SELECT uid, firstname, surname, email FROM user";
                    $result = $conn->query($sqlselect);

                    while ($row = $result->fetch_assoc()) {
                        echo "id: " . $row["uid"] . " - Name: " . $row["firstname"] . " " . $row["surname"] . "Email: " . $row["email"] . "<br>";
                    }
                    ?>
                </div>
            </div>
        </div>
    
    <!-- Login Form -->
    <div class="card">
        <div class="card-header">
            <h3 class="col-7 mb-1">An example of inserting accomm data, with a focus on  accomm photo (blob).</h3>
        </div>
        <div class="card-body">

            <form id="randomform" action="#" method="POST">
                <div class="form-group">
                    <!--<div class="col-7 mb-4 mt-4"> -->
                    <div class="col-7">
                        <label for="emailInput">Email address</label>
                        <input type="email" class="form-control" id="emailInput" placeholder="email@example.com" name="emailInput">
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div class="col-7">
                        <label for="passwordInput">Password</label>
                        <input type="password" class="form-control" id="passwordInput" name="passwordInput">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7">
                        <a href="signup.html" class="signupBtn">Sign Up</a>
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

<?php
    foreach($videoList->items as $item){
        //Embed video
        if(isset($item->id->videoId)){
            echo '<div class="youtube-video">
                    <iframe width="280" height="150" src="https://www.youtube.com/embed/'.$item->id->videoId.'" frameborder="0" allowfullscreen></iframe>
                    <h2>'. $item->snippet->title .'</h2>
                </div>';
        }
    }
?>






</body>

    <?php
        //Close connection
    $conn->close();
    ?>

</html>