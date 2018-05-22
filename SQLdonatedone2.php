<?php
    include 'connectMySQL.php';

    if (!isset($_GET['paymentId'], $_GET['payerId'], $_GET['amount'], $_GET['uid'])){
        //error handle
    } else {       
        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['payerId'];
        $amount = $_GET['amount'];
        $uid = $_GET['uid'];


        $ins = "INSERT INTO payment VALUES ('$paymentId', '$payerId', '$amount', '$uid')";
        mysqli_query($conn, $ins);
        header("location: index.php?donate=success");
    }
?>