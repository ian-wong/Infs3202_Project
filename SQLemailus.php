<?php
    include ('connectMySQL.php');

    if(isset($_POST['submit'])){
        $fromemail = mysqli_real_escape_string($conn, $_POST['fromemail']);

        //$fromemail = $_POST['email-from'];
        $toemail = mysqli_real_escape_string($conn, $_POST['toemail']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $message = $_POST['message'];

        $errorEmpty = false;
        $erroEmail = false;

        if(empty($fromemail)|| empty($toemail)|| empty($subject)|| empty($message) ){
            echo "<span class='form-error'> Please fill in all fields.</span>";
            $errorEmpty = true;
        }
        elseif (!filter_var($fromemail, FILTER_VALIDATE_EMAIL) || !filter_var($toemail, FILTER_VALIDATE_EMAIL) ){
            echo "<span class='form-error'> Please enter a valid email.</span>";
            $errorEmail = true;
        } else {
            header("location: SQLemailus2.php?fromemail=$fromemail&toemail=$toemail&subject=$subject&message=$message");
            //echo "<script>window.close();</script>";
            //echo '<script type="text/javascript">window.close();</script> ';
        }
    } else {
        echo "There was an error!";
    }
?>

<script>
    $("#mail-to, #mail-from, #mail-subject, #mail-message").removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorEmail = "<?php echo $errorEmail; ?>";

    if (errorEmpty == true){
        $("#mail-to, #mail-from, #mail-subject, #mail-message").addClass("input-error");
    }
    if(errorEmail == true){
        $("#mail-to, #mail-from").addClass("input-error");    
    }
    if (errorEmpty == false && errorMail == false){
        $("#mail-to, #mail-from, #mail-subject, #mail-message").val("");
    }
</script>