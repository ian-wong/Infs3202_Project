<?php
    include("connectMySQL.php");
    session_start();


    $uid = $_GET['uid'];

    $deluser = "DELETE FROM users WHERE uid='$uid'";

    try {
        mysqli_query($conn, $deluser);
    } catch (exception $e){
        header("location: profile.php?uid=$uid&error=profdel");
    }

    if(session_destroy()){
        header("Location: index.php");
    }

    $conn->close();

?>