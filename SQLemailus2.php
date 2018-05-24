<?php
    include("connectMySQL.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'phpmailer/vendor/autoload.php';

    $fromemail = mysqli_real_escape_string($conn, $_GET['fromemail']);
    $toemail = mysqli_real_escape_string($conn, $_GET['toemail']);
    $subject = mysqli_real_escape_string($conn, $_GET['subject']);
    $message = $_POST['message'];


    $mail = new PHPMailer(true);                              
    try {
        $mail->SMTPDebug = 2;    
        $mail->isSMTP();                                      
        $mail->Host = 'mailhub.eait.uq.edu.au';
        $mail->SMTPAuth = false; 
        $mail->Username = 's4353213';                           
        $mail->Password = 'anto333anto';                           
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 25;                                    

       
        $mail->setFrom($fromemail);

        $mail->addAddress($toemail);  

      
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
    
        
    } catch (Exception $e) {
        header("location: contact.php?error=email");
    }
    //worked.
    die();
    

    $conn->close();
?>