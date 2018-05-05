<?php
    include("connectMySQL.php");

    //$aid = $_POST['aid'];
    $fromemail = $_REQUEST['fromemail'];
    $toemail = $_REQUEST['toemail'];
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];
    $headers = "From: ".$fromemail;
    mail($toemail, $subject, $message, $headers);

    //header("location: accomm.php?uid'.$aid.'");

?>