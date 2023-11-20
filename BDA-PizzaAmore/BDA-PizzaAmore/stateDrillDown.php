<?php
session_start();

if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit();
}

include("fusioncharts/fusioncharts-wrapper/fusioncharts.php");

include_once "database.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="test.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="test.js" defer></script>
  <title>Management</title>

  <title>FusionCharts XT - Column 2D Chart - Data from a database</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <script src="js/fusioncharts.js"></script>


</head>

<body>


  <body id="page-body">
    <nav>
      <ul>
        <li>
          <a href="analytics.html" class="logo">
            <img src="logo.jpg" alt="nav-bars">
            <span class="nav-item">Analytics</span>
          </a>
        </li>
        <li>
          <a href="profile.php">
            <i class="fa-regular fa-user"></i>
            <span class="nav-item">Profile</span>
          </a>
        </li>
        <li>
          <a href="state.php">
            <i class="fa-solid fa-shop"></i>
            <span class="nav-item">Stores</span>
          </a>
        </li>
        <li>
          <a href="inventory.php">
            <i class="fa-solid fa-chart-simple"></i>
            <span class="nav-item">Inventory</span>
          </a>
        </li>
        <li>
          <a href="review.php">
            <i class="fa-regular fa-star"></i>
            <span class="nav-item">Ranking</span>
          </a>
        </li>

        <div class="logout">
          <li>
            <a href="settings.html">
              <i class="fa-solid fa-gear"></i>
              <span class="nav-item">Settings</span>
            </a>
          </li>
          <li>
            <a href="logout.php">
              <i class="fa-solid fa-right-from-bracket"></i>
              <span class="nav-item">Logout</span>
            </a>
          </li>
        </div>
      </ul>
    </nav>
    <div class="section">
      <h1>Stores</h1>
      <br>
      <span>individual store performance, employees/ staff <br><br><br><br></span>
    </div>

    <body>
      <?php

      // Get the country code from the URL that was sent
      $stateNumber = $_GET["state"];


      // SQL query that returns the cities
      $cityQuery = "SELECT L.city, COUNT(O.order_ID) AS total_orders
      FROM Orders O
      JOIN Location L ON O.store_ID = L.store_ID
      WHERE L.state_no=?
      GROUP BY L.city
      ORDER BY total_orders DESC";

      // Prepare the query statement
      $cityPrepStmt = $dbhandle->prepare($cityQuery);

      if ($cityPrepStmt === false) {
        exit("Error while preparing the query to fetch data from City Table. " . $dbhandle->error);
      }

      // Bind the parameters to the query prepared
      $cityPrepStmt->bind_param("s", $stateNumber);

      // Execute the query
      $cityPrepStmt->execute();

      // Get the results from the query executed
      $cityResult = $cityPrepStmt->get_result();

      // If the query returns a valid response, prepare the JSON string
      if ($cityResult) {

        $stateNameQuery = "SELECT state FROM Location WHERE state_no = ?";

        // Prepare the query statement
        $statePrepStmt = $dbhandle->prepare($stateNameQuery);

        // If there is an error in the statement, exit with an error message
        if ($statePrepStmt === false) {
          exit("Error while preparing the query to fetch data from Country Table. " . $dbhandle->error);
        }


        $statePrepStmt->bind_param("s", $stateNumber);

        $statePrepStmt->execute();

        $statePrepStmt->bind_result($stateName);

        $statePrepStmt->fetch();

        $arrData = array(
          "chart" => array(
            "caption" => "Total Orders of each City in this State: " . $stateName,
            "subCaption" => "which city accumulates the most orders in this state",
            "xAxisName" => "City",
            "yAxisName" => "Number of Orders",
            "showValues" => "0",
            "theme" => "zune"
          )
        );

        $arrData["data"] = array();

        // Push the data into the array
        while ($row = $cityResult->fetch_array()) {
          array_push(
            $arrData["data"],
            array(
              "label" => $row["city"],
              "value" => $row["total_orders"]
            )
          );
        }

        $jsonEncodedData = json_encode($arrData);

        $columnChart = new FusionCharts("column2D", "myFirstChart", 600, 300, "chart-1", "json", $jsonEncodedData);

        $columnChart->render();

        $dbhandle->close();
      }
      ?>

      <a href="state.php" class=back-button> ----------------------> Back</a>
      <div id="chart-1"><!-- Fusion Charts will render here--></div>
    </body>

</html>