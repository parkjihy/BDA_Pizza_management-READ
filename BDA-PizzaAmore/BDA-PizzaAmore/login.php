<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "database.php";

    // Get the form data
    $id = $_POST["username"];
    $enteredPassword = $_POST["password"];

    $sql = "SELECT * FROM Login WHERE username=? AND password=?";
    $stmt = $dbhandle->prepare($sql);
    $stmt->bind_param("ss", $id, $enteredPassword);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $_SESSION["username"] = $id;
        header("Location: analytics.html");
        exit(); // Ensure that the script stops execution after redirection
    } else {
        echo ("Invalid Username or Password.");
    }

    $stmt->close();
    $dbhandle->close();
}

if (isset($_SESSION['username'])) {
    header("Location: analytics.html");
    exit();
}



?>
<!DOCTYPE HTML>
<html>

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
            background-color: black;
        }

        .logo {

            width: 13%;
            height: auto;
        }

        body {
            background-color: rgb(255, 255, 255);
        }

        .login-container {
            width: 300px;
            margin: 100px auto;
            border: 1px solid rgb(0, 0, 0);
            padding: 20px;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid rgb(0, 0, 0);
            box-sizing: border-box;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
        }

        .login-btn {
            background-color: rgb(0, 0, 0);
            color: rgb(255, 255, 255);
            padding: 14px 20px;
            margin: 20px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .lost-btn {
            background-color: rgb(0, 0, 0);
            color: white;
            padding: 14px 20px;
            margin: 20px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>

</head>

<body>
    <!--Header-Row for search and all-->
    <div class="header-row">
        <!-- Uses a header that contracts as the page scrolls down. -->
        <div class="demo-layout-waterfall mdl-layout mdl-js-layout">
            <header class="mdl-layout__header mdl-layout__header--waterfall">
                <!-- Top row, always visible -->
                <div class="mdl-layout__header-row">
                    <!-- Title -->
                    <span class="mdl-layout-title">PizzaAmore</span>
                    <a href="/"><img alt="Pizzeria Logo" class="logo" src="/BigDataAppl/Restaurant/pizzamore.jpeg"></a>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                      mdl-textfield--floating-label mdl-textfield--align-right">

                        <div class="mdl-textfield__expandable-holder">

                        </div>
                    </div>
                </div>
                <!-- Bottom row, not visible on scroll -->
                <div class="mdl-layout__header-row">
                    <div class="mdl-layout-spacer"></div>
                    <!-- Navigation -->
                    <nav class="mdl-navigation">
                        <a class="mdl-navigation__link" href="mainpage.html">Return to Homepage</a>
                    </nav>
                </div>
            </header>
            <div class="mdl-layout__drawer">
                <span class="mdl-layout-title">Navigation</span>
                <nav class="mdl-layout__drawer">
                    <a class="mdl-navigation__link" href="mainpage.html">Homepage</a>
                    <a class="mdl-navigation__link" href="mainpage.html">Return to Homepage</a>
                </nav>
            </div>
            <main class="mdl-layout__content">
                <div class="page-content">

                    <div class="secondBannerr">

                        <div>

                        </div>
                    </div>



                </div>
                <div class="login-container">

                    <form class="" method="post" action="login.php">
                        <h1>Log into Management</h1>
                        <label for="username">Username:</label>
                        <input autofocus="true" id="username" name="username" required="true" type="text">
                        <label for="password">Password:</label>
                        <input id="password" name="password" required="true" type="password">
                        <h6>
                            By continuing with any of the options below, you agree to our Terms of Service and have read
                            our
                            Privacy
                            Policy.
                        </h6>
                        <button class="login-btn" value="login" type="submit">Login</button>

                    </form>
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
    </div>
</body>