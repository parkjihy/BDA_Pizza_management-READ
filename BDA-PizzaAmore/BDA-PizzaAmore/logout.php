<?php
session_start();

session_destroy();

// Redirect to the login page


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css" rel="stylesheet">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    <style>
        .demo-layout-waterfall .mdl-layout__header-row .mdl-navigation__link:last-of-type {
            padding-right: 0;
        }

        .mdl-layout__header-row {
            background-color: rgb(0, 0, 0);
        }

        .logo {

            width: 13%;
            height: auto;
        }

        body {
            background-color: rgb(255, 255, 255);
        }
    </style>

</head>

<body>


    <div class="header-row">
        <!-- Uses a header that contracts as the page scrolls down. -->
        <div class="demo-layout-waterfall mdl-layout mdl-js-layout">
            <header class="mdl-layout__header mdl-layout__header--waterfall">
                <!-- Top row, always visible -->
                <div class="mdl-layout__header-row">
                    <!-- Title -->
                    <span class="mdl-layout-title">PizzaAmore</span>
                    <a href="/"><img alt="Pizzeria Logo" class="logo" src="pizzamore.jpeg"></a>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                      mdl-textfield--floating-label mdl-textfield--align-right">

                        <div class="mdl-textfield__expandable-holder">

                        </div>
                    </div>
                </div>
               
                <div class="mdl-layout__header-row">
                    <div class="mdl-layout-spacer"></div>
                  
                    <nav class="mdl-navigation">
                        <a class="mdl-navigation__link" href="mainpage.html">Return to Homepage</a>
                        <a class="mdl-navigation__link" href="login.php">Login</a>
                    </nav>
                </div>
            </header>
            <div class="mdl-layout__drawer">

                <span class="mdl-layout-title">Navigation</span>
                <nav class="mdl-layout__drawer">
                    <a class="mdl-navigation__link" href="mainpage.html">Return to Homepage</a>
                    <a class="mdl-navigation__link" href="login.php">Login</a>
                </nav>
            </div>
            <main class="mdl-layout__content">
                <div class="page-content">
                    <div class="container">
                        <br>
                        <header>
                            <h6 class="text-center">Good-Bye!</h6>
                        </header>
                        <br>

                        <div class="text-center">
                            <h2>You are logged out.</h2>
                        </div>
                    </div>
                </div>

                <footer class="mdl-mini-footer">
                    <div class="mdl-mini-footer__left-section">
                        <div class="mdl-logo">PizzaAmore</div>
                        <ul class="mdl-mini-footer__link-list">
                            <!-- Links (empty)-->
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="mdl-mini-footer__right-section">
                        <ul class="mdl-mini-footer__link-list">
                            <li><a href="#">Follow Us</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                        </ul>
                    </div>
                </footer>

            </main>
        </div>
    </div>

</body>

</html>