<?php
    include("connectMySQL.php");

    $aid = $_GET['aid'];
    $uid = $_GET['uid'];

    $delaccomm = "DELETE FROM accommodation WHERE aid='$aid')";
    sqli_query($conn, $delaccomm);

    
    header("Location: profile.php?uid=$uid");
   

?>