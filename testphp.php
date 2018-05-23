<!DOCTYPE html>
<?php
    include 'connectMySQL.php';
?>

<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("form").submit(function(event){
                event.preventDefault();
                var fromemail = $("#email-from").val();
                var toemail = $("#email-to").val();
                var subject = $("#email-subject").val();
                var message = $("#email-message").val();
                var submit = $("#email-submit").val();
                $(".form-message").load("test2.php", {
                    fromemail: fromemail, 
                    toemail: toemail, 
                    subject: subject, 
                    message: message, 
                    submit: submit 
                });
            });
        });
    </script>
</head>

<body>

    <!--
    <form method="POST" action="SQLemail.php">
    -->
    <form action="test2.php" method="post">
        <label for="fromemail">From:</label>
        <input type="text" id="email-from" name="fromemail"></br>

        <label for="toemail">To:</label>
        <input type="text" class="form-control" id="email-to" name="toemail"></br>
        
        <label for="subject">Subject:</label>
        <input type="text" class="form-control" id="email-subject" name="subject"></br>

        <label for="message">Comment:</label>
        <textarea class="form-control" rows="5" id="email-message" name="message"></textarea></br>
        
        <button type="submit" id="email-submit" name="submit" class="btn btn-primary">Send Email</button>

        <p class="form-message"></p>
    </form>


</body>
</html>
