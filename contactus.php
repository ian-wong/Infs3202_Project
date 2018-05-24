<!DOCTYPE html>
<?php
    include 'connectMySQL.php';
    include 'function.php';
    session_start();
?>

<html>
<head>
    <?php
        head_html();
    ?>

    <script>
        $(document).ready(function() {
            $("form").submit(function(event){
                event.preventDefault();
                var fromemail = $("#email-from").val();
                var toemail = $("#email-to").val();
                var subject = $("#email-subject").val();
                var message = $("#email-message").val();
                var submit = $("#email-submit").val();
                $(".form-message").load("SQLemailus.php", {
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
            <form action="SQLemailus.php" method="post">
                <p class="form-message"></p>
                
                <label for="fromemail">From:</label>
                <input type="text" class="form-control" id="email-from" name="fromemail"></br>

                <label for="toemail">To:</label>
                <input type="text" class="form-control" id="email-to" name="toemail"></br>
                
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="email-subject" name="subject"></br>

                <label for="message">Comment:</label>
                <textarea class="form-control" rows="5" id="email-message" name="message"></textarea></br>
                
                <button type="submit" id="email-submit" name="submit" class="btn btn-primary">Send Email</button>
            </form>
        </div>
        <div class="col-md-1">
        </div>
    </div>


</body>
</html>
