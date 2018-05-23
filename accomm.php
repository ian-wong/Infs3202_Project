<!DOCTYPE html>
<?php
    include("connectMySQL.php");
    include 'function.php';

    session_start();
?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Accommodation Finder">
        <meta name="author" content="Anthony Hanh & Ian Wong">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Quest Hotel</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!-- Colorbox CSS-->
        <link rel="stylesheet" type="text/css" href="css/colorbox.css"/>
        <!-- Icon -->
        <link rel="icon" href="img/logo.png" />

        <!-- Bootstrap CDN -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
        <!-- JQuery from Google-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!-- Colorbox Jquery -->
        <script src="js/jquery.colorbox.js"></script>

        <script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});

			});

        </script>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <a href="index.php" class="navbar-brand">
                    <img src="img/logo.png" id="Logo" class="d-inline-block align-top">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <!-- Search Bar -->
                    <form class="form-inline" action="searchResult.php" method="POST">
                        <input class="form-control mr-md-2" id="searchBar" type="search" placeholder="Search" aria-label="Search" name="searchInput">
                        <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
                    </form>

                    <ul class="navbar-nav ml-auto">
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 px-md-5 pt-md-4 ">
                        <div class="row">
                            <?php
                            $aid = $_GET['aid'];    
                            $sqla = "SELECT * FROM accommodation WHERE aid='$aid'";
                            $aresult = mysqli_query($conn, $sqla);
                            
                            $arow = mysqli_fetch_assoc($aresult);
                            $aid = $arow['aid'];
                            $aphoto = '<img src = "SQLgetphoto.php?aid='.$aid.'" class="img-fluid" width=100%>';
                            $aname = $arow['name'];
                            $aloc = $arow['location'];
                            $adescr = $arow['descr'];
                            
                            echo ($aphoto);
                            echo '<div class="col-md-12 mt-md-4">';
                            echo '<h4>'.$aname.'</h4>';
                            echo '<p>'.$aloc.'<p>';
                            echo '<p>'.$adescr.'<p>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <?php
                                    $sqlhost = "SELECT * FROM  user, accommodation WHERE accommodation.aid='$aid' AND accommodation.uid=user.uid";
                                    $uresult = mysqli_query($conn, $sqlhost);

                                    $urow = mysqli_fetch_assoc($uresult);
                                    $uid = $urow['uid'];
                                    $uphoto = '<img src="SQLgetuphoto.php?uid='.$uid.'" class="img-fluid">';
                                    $ufname = $urow['firstname'];
                                    $usname = $urow['surname'];
                                    
                                    echo "<div class='col-md-3'>";
                                        echo $uphoto;
                                    echo "</div>";
                                    echo "<div class='col-md-9'>";
                                        echo '<br/>';
                                        echo '<h3>'.$ufname.' '.$usname. '</h3>';
                                        echo '<a href="contact.php?uid='.$uid.'" class="btn btn-primary">Contact Host</a>';
                                    echo "</div>";
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php
                                echo '<br>';
                                $acost = $arow['cost'];
                                echo '<h4-inline>$'.$acost.' AUD </h4-inline> per night'; 
                                
                            ?>
                        </div>
                    
                    </div>
                </div>
                
            </div>
            </div>

            
        </main>

    </body>

    </html>