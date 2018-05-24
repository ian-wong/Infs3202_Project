<!DOCTYPE html>
<?php
    include("connectMySQL.php");
    include 'function.php';

    session_start();
?>
    <html lang="en">

    <head>
        <?php
            head_html();
        ?>
        <!-- Colorbox Jquery -->
        <script src="js/jquery.colorbox.js"></script>

    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <a href="index.php" class="navbar-brand">
                    <img src="images/logo.png" id="Logo" class="d-inline-block align-top">
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