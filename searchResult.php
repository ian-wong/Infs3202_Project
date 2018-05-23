<!DOCTYPE html>
<?php
    include("connectMySQL.php");
    include 'function.php';

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
                    <form class="form-inline" action="searchResult.php" method="POST">
                    <input class="form-control mr-md-2" id="searchBar" type="search" placeholder="Search" aria-label="Search" name="searchInput">
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
            <div class="col-md-8">
                <div class="row">
                    <?php
                    $searchInput = mysqli_real_escape_string($conn, $_POST['searchInput']);

                    if(empty($searchInput)){
                        header("location: index.php?error=search");
                    } else {
                        $condition = "";
                        $keyword = explode(" ", $searchInput);
                        foreach($keyword as $key){
                            $condition .= "location LIKE '%".mysqli_real_escape_string($conn, $key)."%' OR ";
                        }
                        $condition = substr($condition,0, -4);

                        $sqlselect = "SELECT * FROM accommodation WHERE ".$condition;
                        
                        $result = mysqli_query($conn, $sqlselect);
                                        
                        if(!(mysqli_num_rows($result)>0)){
                            echo "Sorry, your search did not match any accommodations.";
                        } else {
                            while($row = mysqli_fetch_array($result)){
                                echo '<div class="col-md-6">';
                                echo '<br/>';

                                $aid = $row['aid'];
                                $aphoto = '<img src="SQLgetphoto.php?aid='.$row['aid'].'" class="img-fluid">';
                                $aname = $row['name'];
                                $aloc = $row['location'];

                                echo ('<a target="_blank" href="accomm.php?id='.$aid. '">' . $aphoto  . '</a>');     
                                echo ('<h5><a target="_blank" class="text-dark" href="accomm.php?id='.$aid. '">' . $aname  . '</a></h5>');     
                                echo ('<h7><a target="_blank" class="text-dark" href="accomm.php?id='.$aid. '">' . $aloc  . '</a></h7>');     
                                echo "</div>";
                            }
                        }
                    }
                ?>
                </div>
            </div>
            <div class="col-md-4 mt-md-3">
                <div id="map"></div>
                </div>
        </div>
    </div>
    <script>
    function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: uluru
        });
        var marker = new google.maps.Marker({
        position: uluru,
        map: map
        });
    }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD556cffToiu6QUeMA370u-To2aBgcKngw&callback=initMap">
    </script>
    
    <?php
        $conn->close();
    ?>
</body>

</html>