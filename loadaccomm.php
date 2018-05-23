<?php
    include 'connectMySQL.php';
    
    $accommNewCount = $_POST['accommNewCount'];

    $selaccomm = "SELECT * FROM accommodation LIMIT $accommNewCount";
    $result = mysqli_query($conn, $selaccomm);
    if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)){
            echo "<div class='col-md-3'>";
            echo "<br>";
            $aid = $row['aid'];
            $aphoto = '<img src="SQLgetphoto.php?aid='.$row['aid'].'" class="img-fluid">';
            $aname = $row['name'];
            $aloc = $row['location'];

            echo ('<a target="_blank" href="accomm.php?aid='.$aid. '">' . $aphoto  . '</a>');     
            echo ('<h5><a target="_blank" class="text-dark" href="accomm.php?aid='.$aid. '">' . $aname  . '</a></h5>');
            echo "</div>";
        }
    } else {
        echo "No accommodations to display at this time, sorry.";
    }
?>  