<?php
    $servername = "localhost";
    $username = "infs";
    $password = "3202";
    $dbname = "3202database";

    //Create connection 
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check connection
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    } 

?>
