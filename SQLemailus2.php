<?php
    include("connectMySQL.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'phpmailer/vendor/autoload.php';

    $fromemail = mysqli_real_escape_string($conn, $_GET['fromemail']);
    $toemail = mysqli_real_escape_string($conn, $_GET['toemail']);
    $subject = mysqli_real_escape_string($conn, $_GET['subject']);
    $message = mysqli_real_escape_string($conn, $_GET['message']);


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
        echo 'Unable to send email, please try again later.';
    }
    //worked.
    //echo "<script>window.close();</script>";
    //echo '<script type="text/javascript">window.close();</script> ';
    //echo 'adsfasdfasdfa';
    //header("location: index.php");
    //exit();
    //echo '<h1 text-color: green;><a href="JavaScript:window.close()">Email Sent, thank you. Close Window.</a></h1>';
    //echo "EMAIL SENTSDAFFFFFFFFFFFFFFFFFFFFFFFASDFASDFSAFASDFA";
    header("location: emailussent.php");
    //echo '<button id="cboxClose" type=button>close </button>';

    $conn->close();
?>