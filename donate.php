<?php
    require 'paypal/app/start.php';

    use PayPal\Api\Payer;
    //use PayPal\Api\Item;
    use PayPal\Api\Amount;
    use PayPal\Api\Transaction;
    use PayPal\Api\RedirectUrls;
    use PayPal\Api\Payment;

    if(!isset($_POST['submit'])){
        //error handle.
    } else {
        if (!isset($_POST['donate'])){
            //error handle.
        } else {

            //error handle amount value

            $donate = (float) $_POST['donate'];

            $total = $donate;

            $payer = new Payer();
            $payer->setPaymentMethod('paypal'); 

            /*
            $item = new Item();
            $item->setName($product)
                ->setCurrency('AUD')
                ->setQuantity(1)
                ->setPrice($donate);
            */

            //$itemList = new ItemList();
            //$itemList->setItems([$item]);

            //$details = new Details();

            $amount = new Amount();
            $amount->setCurrency('AUD')
                ->setTotal($total);
            
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setDescription('Donation to Quest Hotel')
                ->setInvoiceNumber(uniqid());

            $redirectUrls = new RedirectUrls();
            //$redirectUrls->setReturnUrl('http://google.com')
            //    ->setCancelUrl('http://bing.com');
            $redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true')
                ->setCancelUrl(SITE_URL . '/pay.php?success=false');
            
            $payment = new Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

            try {
                $payment->create($paypal);
            } catch(Exception $e) {
                die($e);
            }

            $approvalUrl = $payment->getApprovalLink();
            header("location: $approvalUrl");


        }
    }


?>