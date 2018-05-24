<!DOCTYPE html>
<?php
    include("connectMySQL.php");
    include 'function.php';

    session_start();
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
            <div class="col-md-8 bg-success">
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
                                echo '<div class="col-md-4">';
                                echo '<br/>';

                                $aid = $row['aid'];
                                $aphoto = '<img src="SQLgetphoto.php?aid='.$row['aid'].'" class="img-fluid">';
                                $aname = $row['name'];
                                $aloc = $row['location'];

                                echo ('<a target="_blank" href="accomm.php?aid='.$aid. '">' . $aphoto  . '</a>');     
                                echo ('<h5><a target="_blank" class="text-dark" href="accomm.php?aid='.$aid. '">' . $aname  . '</a></h5>');     
                                echo ('<h7><a target="_blank" class="text-dark" href="accomm.php?aid='.$aid. '">' . $aloc  . '</a></h7>');     
                                echo "</div>";
                            }
                        }
                    }
                ?>
                </div>
                </div>
            <div class="col-md-4 mt-md-4 bg-warning">
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