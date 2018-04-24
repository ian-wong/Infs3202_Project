<?php
    include('connectMySQL.php');

    $id = $_GET['id'];
    // do some validation here to ensure id is safe


    $sqlselphoto= "SELECT photos FROM accommodation WHERE aid=$id";
    $result = mysqli_query($conn, $sqlselphoto);
    $row = mysqli_fetch_assoc($result);

    $conn->close();

    header("Content-type: image/jpeg");
    echo $row['photos'];


?>