<?php
    include('connectMySQL.php');

    $id = $_GET['id'];

    $sqlselphoto= "SELECT photos FROM accommodation WHERE aid=$id";
    $result = mysqli_query($conn, $sqlselphoto);
    $row = mysqli_fetch_assoc($result);

    $conn->close();

    header("Content-type: image/jpeg");
    echo $row['photos'];


?>