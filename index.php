<!DOCTYPE html>
<?php 
    include("connectMySQL.php");
    include 'function.php';

    session_start();

    //YouTube Data API request returns the JSON data that includes the information of the video
    $ytAPI_key    = 'AIzaSyC58pvE_Y0F8--HCIUVUfXaKNg1GcjSbNM';
    $ytChannelID  = 'UC2QGb0wattUTF82jpM3UL2w';
    $ytResults = 4;
    //retrieves video data, name, description etc. 
    $ytvideos = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$ytChannelID.'&maxResults='.$ytResults.'&key='.$ytAPI_key.''));
    
    $twitAPI_key = 'T0tQ4JGdEm4vb2Q31FFa9fRSL';
    $twitAPI_secret = "IU21cYDqrs3rOZm0NVTidNa0WidXMAlTshV97RHmPcNiXG16So";
    $twitToken = "996969380633182208-hZ8jwnPScjqBsg1Xg6ZBi6cweyfoaNV";
    $twitToken_secret = "B1vta4JRBQgqBZEu5rLLu8kdg53rFLUBGtZG2KAYz53OZ";

    require "twitter/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;
    //twitter API
    $twitconn = new TwitterOAuth($twitAPI_key, $twitAPI_secret, $twitToken, $twitToken_secret);
    //user info
    $user = $twitconn->get("account/verify_credentials");

    //paypal sandbox
    //sand-box account anthonysailou3-facilitator@gmail.com OR anthonysailou3-buyer@gmail.com
    $paypAPI_key = 'Aa3JuAqm4QMvrZCRuwdxnjKjNgPa3cvlgK-co4EHkpQ-H3fIM-3W1dhfZQck3g-6b37cgYTWX3uIwqGf';
    $paypAPI_secret = 'EChbiuGJmDoqbzQstsI4c-sWwO5Jmhxdv4ex9FJa6nKnwrgfj0nEcP2emz8NGDyHnWE5iGZNdy0oPYlW';
?>

<html lang="en">
<head>
    <?php
        head_html();
    ?>
    <script>
        $(document).ready(function(){
            var accommCount = 4;
            $("button").click(function(){
                accommCount = accommCount + 4;
                $("#accomms").load("loadaccomm.php", {
                    accommNewCount: accommCount
                });
            }); 
        });
    </script>

</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">
            <img src="images/logo.png" id="Logo" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <form class="form-inline" action="searchResult.php" method="POST">
                <input class="form-control mr-md-2" id="searchBar" type="search" placeholder="Search" onkeyup="showResult(this.value)" aria-label="Search" name="searchInput"> 
                <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
            </form>

            
            <?php 
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if($error == "donatevalue"){
                        echo "<p class='text-danger'>&emsp;Please enter a value to donate.</p>";
                    } 
                    elseif($error == "paypal"){
                        echo "<p class='text-danger'>&emsp;PayPal transaction failed, please try again later.</p>";
                    } 
                    elseif($error == "search"){
                        echo "<p class='text-danger'>&emsp;Please enter values into the search bar.</p>";
                    } 
                } elseif (isset($_GET['success'])){
                    $success = $_GET['success'];
                    if($success == "paypal"){
                        echo "<p class='text-success'>&emsp;Thank you very much for your donation!</p>";
                    }
                    elseif($success == "login"){
                        echo "<p class='text-success'>&emsp;Successful login.</p>";
                    }
                    elseif($success == "email"){
                        echo "<p class='text-success'>&emsp;Successfully sent email to host.</p>";
                    }
                }
            ?>

            <ul class="navbar-nav ml-auto">
             <a class="nav-link" href="aboutus.php">About Us</a>
                <li class="nav-item">
                    <?php
                        isset_user();
                    ?>
                </li>
            </ul>

            
        </div>
    </nav>
</header>

<main>
    <div id="carouselHome" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
            <li data-target="#carouselHome" data-slide-to="1"></li>
            <li data-target="#carouselHome" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" src="images/bg.jpeg" alt="">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Experience new homes</h1>
                        <h1>around the world.</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="second-slide" src="images/bg2.jpeg" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>The easy way to stay.</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="third-slide" src="images/bg3.jpeg" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Discover new favourite spots to stay.</h1>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="row feature">
        <div class="col-md-7">
            <h2 class="feature-heading">Quest Hotel</h2>
            <p class="lead">Easily locate, manage and book short-term accommodation. From holiday homes, apartments,
                cottages to single rooms, there are a variety of accommodation available to reserve.</p>
        </div>
        <div class="col-md-5">
        </div>
    </div>

</main>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <h2><a target="_blank" href="https://www.youtube.com/channel/UC2QGb0wattUTF82jpM3UL2w/"> Quest Hotel Videos</a></h2>
                <div class="row">
                <?php
                    foreach($ytvideos->items as $item){ 
                        if(isset($item->id->videoId)){
                            echo '<div class=" col-md-4 youtube-video">';
                                echo '<iframe src="https://www.youtube.com/embed/'.$item->id->videoId.'" frameborder="0" allowfullscreen></iframe>';
                            echo '</div>';
                        }   
                    }
                ?>
                </div> 
            </div>
            <div class="col-md-2">
                <?php
                    
                    echo "<h2><a target=_'blank' href='https://twitter.com/HotelsQuest'>$user->screen_name Twitter</a></h2>";
                    
                    $tweets = $twitconn->get('statuses/user_timeline', ['count'=>5,'exclude_replies'=>true,'include_rts'=>false]);
                    

                    $firsttweet = 1;
                    foreach ($tweets as $twt){
                        echo $twt->text . '<br><br>';
                        $firsttweet++;
                    }
                
                ?>
            </div>
        </div>

        <div class="row"> 
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <br>
                <h2>Available Accommodations: </h2>
                <div class="row">
                    <?php
                        $sqlselectaccom = "SELECT * FROM accommodation";
                        $result = mysqli_query($conn, $sqlselectaccom);

                        if (!(mysqli_num_rows($result)>0)){
                            echo 'Unable to connect to server';
                        } else {
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
                        }
                    ?>
                </div>
                <br><br><br><br><br>
                <div class="row" id="accomms">
                        <?php
                            $selaccomm = "SELECT * FROM accommodation LIMIT 4";
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
                </div>
                <button> Show more accommodations </button>  
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <br><br><br><br>
                <form action="SQLdonate.php" method="post" autocomplete="off">
                    <h4>Enjoy using Quest Hotel? Support us by donating.</h4>
                    <label for="donate">Amount</label>
                    <input type="text" name="donate">
                    <input type="submit" value="Donate" name="submit">
                    <p>You'll be taken to Paypal to complete your payment.</p><br>
                </form>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
</body>
</html>