<?php
    include("connectMySQL.php");
    session_start();

    $uid = $_GET['uid'];

    $deluser = "DELETE FROM users WHERE uid='$uid')";
    sqli_query($conn, $deluser);

    if(session_destroy()){
        header("Location: index.php");
    }

?>