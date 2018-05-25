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
        <!-- Colorbox CSS -->
        <link rel="stylesheet" type="text/css" href="colorbox.css" />
        <!-- JQueryUI CSS-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- JQueryUI JS-->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- Colorbox JQuery -->
        <script src="js/jquery.colorbox.js"></script>

        <script>
            //Assigning Colorbox event to elements
            $(document).ready(function () {
                $(".group1").colorbox({
                    rel: 'group1'
                });
                $(".iframe").colorbox({
                    iframe: true,
                    width: "70%",
                    height: "80%"
                });
            })
            $(function () {
                $(".accordion").accordion({
                    collapsible: true
                });
            });
        </script>

</head>

<body>
    <header>
        <?php
            header_nav();
        ?>
    </header>
    <main>
        <div class="row-feature">
            <div class="row">
                <div class="col-md-12" id="aboutusBG">
                    <div class="row">
                        <div class="col-md-8 text-right">
                            <h2 class="feature-heading">WE ARE QUEST HOTEL</h2>
                        </div>
                        <div class="col-md-4 mt-md-5 text-center">
                            <a class="group1" href="images/logo.png" title="Quest Hotel">
                                <img src="images/logo.png">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="feature-divider">

        </div>
        <div class="row-feature">
            <div class="row">
                <div class="col-md-1 pb-md-5"></div>
                <div class="col-md-10 text-center pb-md-5">
                    <h2 class="feature-heading"> About Us</h2>
                    <p>Quest Hotel is a Brisbane based short-term lodging search system where we help travellers and hosts have
                        a stress free time locating and hosting accommodations. Easily locate, manage and book accommodations
                        around the world with no fuss at all. There are a range of selection to choose from apartments, homes,
                        units or cottages.</p>
                    <p> After experiencing first-hand the unpleasant experience of trying to find a suitable and inexpensive
                        accommodation in another country. We set out to create a solution.
                    </p>
                    <a class="iframe btn btn-dark" href="contactus.php">Contact Us</a>

                </div>
                <div class="col-md-1 pb-md-5"></div>
            </div>
        </div>
        <hr class="feature-divider">
        <h2 class="feature-heading text-center">Meet The Team</h2>
        <div class="row">
            <div class="col-md-6 text-center">
                <img class="rounded mx-auto" src="images/profileImg3.png" alt="Anthony Hanh" height="250em" width="200em">
                <h3 class="mt-md-2">Anthony Hanh</h3>
                <div class="row">
                    <div class=col-md-4></div>
                    <div class="accordion col-md-4 pb-md-5">
                        <h3>Backend Developer</h3>
                        <p class="text-muted">Hi I'm Anthony! I'm currently studying IT at Univerisity of Queensland.</p>
                    </div>
                    <div class=col-md-4></div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img class="rounded mx-auto " src="images/profileImg1.jpg" alt="Ian Wong" height="250em" width="200em">
                <h3 class="mt-md-2">Ian Wong</h3>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class=" accordion col-md-4 pb-md-5">
                        <h3>UX Designer</h3>
                        <p class="text-muted">22 year old, studying IT at Univerisity of Queensland.</p>
                    </div>
                    <div class=col-md-4></div>
                </div>


            </div>


    </main>
</body>

</html>