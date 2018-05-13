<?php
    include("connectMySQL.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    //use PHPMailer\Vendor\PHPMailer\PHPMailer\PHPMailer;
    //use PHPMailer\Vendor\PHPMailer\PHPMailer\Exception;


    //Load Composer's autoloader
    require 'phpmailer/vendor/autoload.php';

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mailhub.eait.uq.edu.au;smtp2.example.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = false; //true;                               // Enable SMTP authentication
        $mail->Username = 's4353213';                           // SMTP username
        $mail->Password = 'anto333anto';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to

        
        //Recipients
        $mail->setFrom($_REQUEST['fromemail'], 'Anthony');

        $mail->addAddress($_REQUEST['toemail']);   //'Joe User');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $_REQUEST['subject'];
        $mail->Body    = $_REQUEST['message'];
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        


        $mail->send();
        echo 'Message has been sent';
        
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }


    /*
    //$aid = $_POST['aid'];
    
    $fromemail = $_REQUEST['fromemail'];
    $toemail = $_REQUEST['toemail'];
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];
    $headers = "From: ".$fromemail;

    mail($toemail, $subject, $message, $headers);

    //header("location: accomm.php?uid'.$aid.'");
    echo "email sent";
    */

    header("location: index.php");



    $conn->close;
?>