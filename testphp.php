<html>
    <head></head>
<body>
    <h3>test test </h3>
    
    <?php 
        echo 'work please<br/>';
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        //also dbname
        $dbname = "3202database";
    
        //Create connection 
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        //Check connection
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        } 
        
        echo "Connected Successfully<br>";
    
        //inserting data to database
        $sqlinsert = "INSERT INTO user (firstname, surname, email, password) VALUES ('testfname', 'testlname', 'testemail@t.co', '1234567890')";
        if ($conn->query($sqlinsert) === TRUE){ //=== is 'equal and of same type'
            echo "new record entered<br/>";
        } else {
            echo "Error: " . $sqlinsert . "<br>" . $conn->error . "<br>";
        }

        //retrieving data from database
        $sqlselect = "SELECT uid, firstname, surname, email FROM user";
        $result = $conn->query($sqlselect);

        while($row = $result->fetch_assoc()){
            echo "id: ". $row["uid"]. " - Name: " . $row["firstname"]. " " . $row["surname"] . "Email: ". $row["email"].    "<br>";
        }

        

        //Close connection
        $conn->close();


    ?>

</body>

</html>