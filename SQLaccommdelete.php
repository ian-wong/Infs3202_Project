<?php
    include("connectMySQL.php");

    $aid = $_GET['aid'];
    $uid = $_GET['uid'];

    $delaccomm = "DELETE FROM accommodation WHERE aid='$aid'";// AND 'uid'=$uid";
    
    
    mysqli_query($conn, $delaccomm);
    //$conn->exec($delaccomm);

    
    header("Location: profile.php?uid=$uid");
   

?>