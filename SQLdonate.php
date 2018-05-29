<?php
    include("connectMySQL.php");
    
    session_start();

    require 'paypal/app/start.php';
        
    use PayPal\Api\Payer;
    use PayPal\Api\Amount;
    use PayPal\Api\Transaction;
    use PayPal\Api\RedirectUrls;
    use PayPal\Api\Payment;

    if(!isset($_SESSION['login_user'])){
        header('location: login.php?error=login'); 
    } else {
        if(!isset($_POST['submit'])){
            header('location: index.php');
        } else {
            if (!isset($_POST['donate'])){
                header('location: index.php?error=donatevalue');
            } else {
                $don = mysqli_real_escape_string($conn, $_POST['donate']);
                if (is_numeric($don)){
                    $donate = (float) $don;
                    $total = $donate;

                    $payer = new Payer();
                    $payer->setPaymentMethod('paypal'); 

                    $amount = new Amount();
                    $amount->setCurrency('AUD')
                        ->setTotal($total);
                    
                    $transaction = new Transaction();
                    $transaction->setAmount($amount)
                        ->setDescription('Donation to Quest Hotel')
                        ->setInvoiceNumber(uniqid());

                    $redirectUrls = new RedirectUrls();
                    $redirectUrls->setReturnUrl(SITE_URL . '/SQLdonatedone.php?success=true&amount='.$donate.'')
                        ->setCancelUrl(SITE_URL . '/SQLdonatedone.php?success=false');
                    
                    $payment = new Payment();
                    $payment->setIntent('sale')
                        ->setPayer($payer)
                        ->setRedirectUrls($redirectUrls)
                        ->setTransactions([$transaction]);

                    try {
                        $payment->create($paypal);
                    } catch(Exception $e) {
                        header("location: index.php?error=paypal");
                    }
                    $approvalUrl = $payment->getApprovalLink();
                    header("location: $approvalUrl");
                } else {
                    header("location: index.php?error=paypal");
                }
            }
        }
    }
    $conn->close();
?>