<?php
    include("connectMySQL.php");


    $uid = $_GET['uid'];
    if(!isset($_POST['submit'])){
        header("location: index.php");
    } else {
        if ((($_FILES["photoInput"]["type"] == "image/gif") || ($_FILES["photoInput"]["type"] == "image/jpeg") || ($_FILES["photoInput"]["type"] == "image/pjpeg") || ($_FILES["photoInput"]["type"] == "image/png")) && ($_FILES["photoInput"]["size"] < 50000)){
            if ($_FILES["photoInput"]["error"] > 0){
                header("location: profilephoto.php?uid=$uid&error=photo");
            } else {
                $photoName = mysqli_real_escape_string($conn, $_FILES["photoInput"]["name"]);
                $photoType = mysqli_real_escape_string($conn, $_FILES["photoInput"]["type"]);
                $photoData = mysqli_real_escape_string($conn, file_get_contents($_FILES["photoInput"]["tmp_name"]));

                $updphoto = "UPDATE user SET photos='$photoData' WHERE uid='$uid'";
                
                mysqli_query($conn, $updphoto);
                
                header("location: profile.php?uid=$uid");
            }
        } else {
            header("location: profilephoto.php?uid=$uid&error=photo");
        }
    }
    $conn->close();
?>