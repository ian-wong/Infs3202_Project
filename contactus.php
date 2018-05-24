<!DOCTYPE html>
<?php
    include 'connectMySQL.php';
    session_start();
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Accommodation Finder">
    <meta name="author" content="Anthony Hanh & Ian Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quest Hotel</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <!-- Icon -->
    <link rel="icon" href="img/logo.png"/>

    <!-- Bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <!-- JQuery from Google-->
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
    <div class=row>
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
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
        </div>
        <div class="col-md-1">
        </div>
    </div>


</body>
</html>
