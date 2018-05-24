<?php
    include("connectMySQL.php");

    $aid = $_GET['aid'];
    $uid = $_GET['uid'];

    $delaccomm = "DELETE FROM accommodation WHERE aid='$aid'";
    try{
        mysqli_query($conn, $delaccomm);
    } catch (exception $e){
        header("location: profile.php?uid=$uid&aid=$aid&error=accommdel");
    }
    header("Location: profile.php?uid=$uid");
    $conn->close();
?>