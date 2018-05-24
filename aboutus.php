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
    <link rel="stylesheet" href="colorbox.css"/>
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
    </script>
    <script>
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
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 text-center">
                    <h2 class="feature-heading"> About Us</h2>
                    <p>Quest Hotel is a Brisbane based short-term lodging search system where we help travellers and hosts have
                        a stress free time locating and hosting accommodations. Easily locate, manage and book accommodations
                        around the world with no fuss at all. There are a range of selection to choose from apartments, homes,
                        units or cottages.</p>
                    <p> After experiencing first-hand the unpleasant experience of trying to find a suitable and inexpensive
                        accommodation in another country. We set out to create a solution.
                    </p>
                    <a class="iframe btn btn-dark" href="index.php">Contact Us</a>

                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <hr class="feature-divider">

        <div class="row">
            <div class="col-md-6 text-center">
                <img class="rounded mx-auto" src="img/profileImg2.png" alt="Anthony Hanh" height="250em" width="200em">
                <h3 class="mt-md-2">Anthony Hanh</h3>
            </div>
            <div class="col-md-6 text-center">
                <img class="rounded mx-auto " src="img/profileImg1.jpg" alt="Ian Wong" height="250em" width="200em">
                <h3 class="mt-md-2">Ian Wong</h3>
            </div>


        </div>
        <div class="container">


        </div>

    </main>