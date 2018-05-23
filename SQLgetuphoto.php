<?php
    include('connectMySQL.php');

    $uid = $_GET['uid'];

    $sqlselphoto= "SELECT photos FROM user WHERE uid=$uid";
    $result = mysqli_query($conn, $sqlselphoto);
    $row = mysqli_fetch_assoc($result);
    if(!$result){
        echo 'Something wrong happened, could not connect to server.';
    }

    header("Content-type: image/jpeg");
    echo $row['photos'];
    $conn->close();
?>