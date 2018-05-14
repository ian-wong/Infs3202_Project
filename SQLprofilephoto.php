<?php
    include("connectMySQL.php");


    if(isset($_POST['submit'])){
        
        $uid = $_GET['uid'];
        /*
        $photoName = mysqli_real_escape_string($conn, $_FILES["photoInput"]["name"]);  // --
        $photoData = mysqli_real_escape_string($conn, file_get_contents($_FILES["photoInput"]["tmp_name"]));
        $photoType = mysqli_real_escape_string($conn, $_FILES["photoInput"]["type"]);
        */

        if ((($_FILES["photoInput"]["type"] == "image/gif") || ($_FILES["photoInput"]["type"] == "image/jpeg") || ($_FILES["photoInput"]["type"] == "image/pjpeg") || ($_FILES["photoInput"]["type"] == "image/png")) && ($_FILES["photoInput"]["size"] < 20000)){
            if ($_FILES["photoInput"]["error"] > 0){
                echo "Error";
            } else {
                $photoName = mysqli_real_escape_string($conn, $_FILES["photoInput"]["name"]);
                $photoType = mysqli_real_escape_string($conn, $_FILES["photoInput"]["type"]);
                $photoData = mysqli_real_escape_string($conn, file_get_contents($_FILES["photoInput"]["tmp_name"]));

                if(substr($photoType, 0, 5) == "image"){
                    //need to do whole row (?)
                    $updphoto = "UPDATE user SET photos='$photoData' WHERE uid='$uid'";
                    mysqli_query($conn, $updphoto);

                    header("location: profile.php?uid=$uid");
                } else {
                    echo "error";
                    //error handle NOT an image
                } 
            }
        } else {
            echo "invalid file";
        }

    }
?>