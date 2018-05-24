<?php
    include("connectMySQL.php");
    
    $uid = $_GET['uid'];

    if(!isset($_POST['submit'])){
        header("location: index.php");
    } else {
        if (!isset($_POST['phoneInput'])){
            header("location: profilephone.php?uid=$uid&error=empty");
        } else {
            $pho = str_pad($_POST['phoneInput'],1);

            $phone = mysqli_real_escape_string($conn, $pho);

            if(is_numeric($phone)){
                $updphone = "UPDATE user SET phone='$phone' WHERE uid='$uid'";
        
                try {
                    mysqli_query($conn, $updphone);
                } catch (exception $e){
                    header("location: profilephone.php?uid=$uid&error=error");    
                }
                header("Location: profile.php?uid=".$uid."");
            } else {
                header("location: profile.php?uid=$uid&error=value");
            }
        }
    }
    $conn->close();
?>