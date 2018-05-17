<?php

    use PayPal\Api\Payment;
    use PayPal\Api\PaymentExecution;
    use PHPMailer\PHPMailer\Exception;

    require 'paypal/app/start.php';

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
            } catch (Exception $e) {
                //error handle
            }
            echo 'Payment Successful.';
            header('location: index.php');
        }
    }


?>