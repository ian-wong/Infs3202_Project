<?php
    include 'connectMySQL.php';

    if (!isset($_GET['paymentId'], $_GET['payerId'], $_GET['amount'], $_GET['uid'])){
        header("location: index.php");
    } else {       
        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['payerId'];
        $amount = $_GET['amount'];
        $uid = $_GET['uid'];

        $ins = "INSERT INTO payment VALUES ('$paymentId', '$payerId', '$amount', '$uid')";
        try{
            mysqli_query($conn, $ins);
        } catch (exception $e){
            header("location: index.php?success=paypal");
            //Payment through paypal still worked.
            //However transaction not logged in our database...rip
        }
        header("location: index.php?success=paypal");
    }
?>