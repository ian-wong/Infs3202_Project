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
    <link rel="stylesheet" type="text/css" href="css/colorbox.css" />
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

    <!-- Colorbox JQuery -->
    <script src="js/jquery.colorbox.js"></script>

    <script>
        $(document).ready(function () {
            var accommCount = 4;
            $("button").click(function () {
                accommCount = accommCount + 4;
                $("#accomms").load("loadaccomm.php", {
                    accommNewCount: accommCount
                });
            });
        });
        //Assigning Colorbox event to elements
        $(document).ready(function () {
            $(".group1").colorbox({
                rel: 'group1'
            });
            $(".iframe").colorbox({
                iframe: true,
                width: "80%",
                height: "80%"
            });

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
                <form class="form-inline" action="searchResult.php" method="POST">
                    <input class="form-control mr-md-2" id="searchBar" type="search" placeholder="Search" onkeyup="showResult(this.value)" aria-label="Search"
                        name="searchInput">
                    <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
                </form>

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
        <div class="row-feature">
            <div class="row">
                <div class="col-md-7 text-right" id="contactFeature">
                    <h2 class="feature-heading">WE ARE QUEST HOTEL</h2>
                </div>
                <div class="col-md-5 mt-md-5 text-center">
                    <a class="group1 img-fluid mx-auto" href="img/logo.png" title="Quest Hotel">
                        <img src="img/logo.png">
                    </a>

                </div>

            </div>
            <hr class="feature-divider">

        </div>
        <div class="row-feature">
            <div class="col-md-12 text-center">
                <h2 class="feature-heading"> About Us</h2>
                <p>Quest Hotel is </p>
                <a class="iframe btn btn-dark" href="index.php">Contact Us</a>

            </div>
        </div>
        <hr class="feature-divider">

        <div class="row-feature">

        </div>
        <div class="container">
                <div class="col-lg-4">
                        <img class="rounded-circle" src="img/profileImg1.jpg" alt="Generic placeholder image" height="180px" width="170px">
                        <h2>Heading</h2>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                      </div>
        </div>
    </main>