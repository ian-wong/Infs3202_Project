<?php
    include('connectMySQL.php');

    $aid = $_GET['aid'];

    $sqlselphoto= "SELECT photos FROM accommodation WHERE aid=$aid";
    $result = mysqli_query($conn, $sqlselphoto);
    if(!$result){
        echo 'Something wrong happened, could not connect to server.';
    }
    $row = mysqli_fetch_assoc($result);

    header("Content-type: image/jpeg");
    echo $row['photos'];

    $conn->close();
?>