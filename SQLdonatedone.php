<?php

    use PayPal\Api\Payment;
    use PayPal\Api\PaymentExecution;
    use PHPMailer\PHPMailer\Exception;

    require 'paypal/app/start.php';
    include 'connectMySQL.php';

    session_start();
    if(!isset($_SESSION['login_user'])){
        header('location: login.php');
    }
    $email = $_SESSION['login_user'];
    $sqlselect="SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sqlselect);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $uid = $row['uid'];

    if (!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])){
        //error handle
    } else {
        if ((bool)$_GET['success'] === false){
            //error handle
        } else {
            $paymentId = $_GET['paymentId'];
            $payerId = $_GET['PayerID'];

            $payment = Payment::get($paymentId, $paypal);

            $exe = new PaymentExecution();
            $exe->setPayerId($payerId);

            try{
                $result = $payment->execute($exe, $paypal);
                $ins = "INSERT INTO payment VALUES ('$paymentId', '$payerId', '$uid')";
                mysqli_query($conn, $ins);
            } catch (Exception $e) {
                //error handle
            }
            echo 'Payment Successful.';
            header('location: index.php');
        }
    }


?>