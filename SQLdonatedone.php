<?php

    include 'connectMySQL.php';

    session_start();

    require 'paypal/app/start.php';
    
    use PayPal\Api\Payment;
    use PayPal\Api\PaymentExecution;
    use PHPMailer\PHPMailer\Exception;

    if(!isset($_SESSION['login_user'])){
        header('location: login.php');
    }
    $email = $_SESSION['login_user'];
    $sqlselect="SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sqlselect);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $uid = $row['uid'];

    if (!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'], $_GET['amount'])){
        header("location: index.php");
    } else {
        if ((bool)$_GET['success'] === false){
            header("location: index.php?error=paypal");
        } else {
            $paymentId = $_GET['paymentId'];
            $payerId = $_GET['PayerID'];

            $payment = Payment::get($paymentId, $paypal);

            $exe = new PaymentExecution();
            $exe->setPayerId($payerId);

            try{
                $result = $payment->execute($exe, $paypal);
            } catch (Exception $e) {
                header("location: index.php?error=paypal");
            }
            $amount=$_GET["amount"];

            header("location: SQLdonatedone2.php?paymentId=$paymentId&payerId=$payerId&amount=$amount&uid=$uid");
            
        }
    }


?>