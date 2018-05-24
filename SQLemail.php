<?php
    include("connectMySQL.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'phpmailer/vendor/autoload.php';
       
    $fromemail = mysqli_real_escape_string($conn, $_POST['fromemail']);
    $toemail = mysqli_real_escape_string($conn, $_POST['toemail']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = $_POST['message'];

    if (!isset($_POST['submit'])){
        header("location: index.php");
    } else {
        if(empty($fromemail) || empty($toemail) || empty($subject) || empty($message)){
            header("location: contact.php?error=value");
        } else {
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 2;    //according to eaitSmartOS      // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'mailhub.eait.uq.edu.au';//;smtp2.example.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = false; //true;                               // Enable SMTP authentication
                $mail->Username = 's4353213';                           // SMTP username
                $mail->Password = 'anto333anto';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom($fromemail);

                $mail->addAddress($toemail);   // Add a recipient

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $message;
                $mail->send();
                
            } catch (Exception $e) {
                header("location: contact.php?error=email");
            }
            header("location: index.php?success=email");
        }
    }
    $conn->close;
?>