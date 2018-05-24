<?php
    include("connectMySQL.php");
    $uid = $_GET['uid'];

    if(!isset($_POST['submit'])){
        header("Location: index.php");
    } else{
        //not checking photo input isset
        if((!isset($_POST['nameInput'])) || (!isset($_POST['locInput'])) || (!isset($_POST['priceInput'])) || (!isset($_POST['descInput'])) ){
            header("location: host.php?uid=$uid&error=empty");
        } else {
            if ((($_FILES["photoInput"]["type"] == "image/gif") || ($_FILES["photoInput"]["type"] == "image/jpeg") || ($_FILES["photoInput"]["type"] == "image/pjpeg") || ($_FILES["photoInput"]["type"] == "image/png")) && ($_FILES["photoInput"]["size"] < 50000)){
                if ($_FILES["photoInput"]["error"] > 0){
                    header("location: host.php?uid=$uid&error=photo");
                } else {
                    $photoName = mysqli_real_escape_string($conn, $_FILES["photoInput"]["name"]);
                    $photoType = mysqli_real_escape_string($conn, $_FILES["photoInput"]["type"]);
                    $photoData = mysqli_real_escape_string($conn, file_get_contents($_FILES["photoInput"]["tmp_name"]));

                    $name = mysqli_real_escape_string($conn, $_POST['nameInput']);
                    $loc = mysqli_real_escape_string($conn, $_POST['locInput']);
                    $price = mysqli_real_escape_string($conn, $_POST['priceInput']);
                    $desc = mysqli_real_escape_string($conn, $_POST['descInput']);

                    $insaccomm = "INSERT INTO accommodation (uid, name, location, descr, photos, cost) VALUES ('$uid', '$name','$loc', '$desc', '$photoData', '$price')";
                    
                    try {
                        mysqli_query($conn, $insaccomm);
                    } catch (exception $e){
                        header("location: host.php?uid=$uid&error=error");
                    }
                    header("location: profile.php?uid=$uid&success=host");
                }
            } else{
                header("location: host.php?uid=$uid&error=photo");
            }
        } 
    }
    $conn->close();
?>