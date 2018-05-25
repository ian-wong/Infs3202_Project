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
        <?php
            header_nav();
        ?>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
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
                                $aloc = $row['location'];
                                accomm_info($row);
                                echo ('<h7><a target="_blank" class="text-dark" href="accomm.php?aid='.$aid. '">' . $aloc  . '</a></h7>');     
                                
                                echo "</div>";
                            }
                        }
                    }
                ?>
                </div>
                </div>
            <div class="col-md-5 mt-md-4">
            <input id = "pac-input" class="controls" type="text" placeholder="Search Accommodations">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <script>
   function initAutocomplete() {
        var sydney = {lat: -33.8688, lng: 151.2195};
        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: sydney
        });

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

        // Clear out the old markers.
        markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: 'images/marker.png',
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(60, 60)
            };
            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }
    
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAP3i49kq94CnzbJJzPq0nolckpUzXbVIA&libraries=places&callback=initAutocomplete"
        async defer></script>
    
    <?php
        $conn->close();
    ?>
</body>

</html>