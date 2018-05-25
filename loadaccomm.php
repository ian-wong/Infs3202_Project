<?php
    include 'connectMySQL.php';
    include 'function.php';
    
    $accommNewCount = $_POST['accommNewCount'];

    $selaccomm = "SELECT * FROM accommodation LIMIT $accommNewCount";
    $result = mysqli_query($conn, $selaccomm);
    if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)){
            echo "<div class='col-md-3'>";
            echo "<br>";
            
            accomm_info($row);

            echo "</div>";
        }
    } else {
        echo "No accommodations to display at this time, sorry.";
    }
?>  