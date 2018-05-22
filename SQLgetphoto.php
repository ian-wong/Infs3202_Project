<?php
    include('connectMySQL.php');

    $aid = $_GET['aid'];

    $sqlselphoto= "SELECT photos FROM accommodation WHERE aid=$aid";
    $result = mysqli_query($conn, $sqlselphoto);
    $row = mysqli_fetch_assoc($result);

    $conn->close();

    header("Content-type: image/jpeg");
    echo $row['photos'];


?>