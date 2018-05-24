<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <?php

    /*
    echo "test123";
    echo "<br>";
    echo password_hash("test123", PASSWORD_DEFAULT);
    */
    $input = "test123";
    $hashedPwdInDb = password_hash("test123", PASSWORD_DEFAULT);

    echo password_verify($input, $hashedPwdInDb);

    ?>


</body>
</html>