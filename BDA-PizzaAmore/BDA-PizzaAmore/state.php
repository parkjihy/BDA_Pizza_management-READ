<?php
session_start();


if (!isset($_SESSION["username"])) {

  header("Location: login.php");
  exit();
} //$username = $_SESSION["username"];

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
      <span>individual store performance, employees/ staff </span>
    </div>

    <?php

    //SQL query that returns all 8 states
    $strQuery = "SELECT L.state, COUNT(O.order_ID) AS total_orders, L.state_no
   FROM Orders O
   JOIN Location L ON O.store_ID = L.store_ID
   GROUP BY L.state_no, L.state
   ORDER BY total_orders DESC
   ";

    // Query-Execution
    $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    if ($result) {
      $arrData = array(
        "chart" => array(
          "caption" => "Order Total according to States",
          "subCaption" => "which state accumulates more orders",
          "xAxisName" => "State",
          "yAxisName" => "Number of Orders",
          "showValues" => "0",
          "theme" => "zune"
        )
      );

      $arrData["data"] = array();

      while ($row = mysqli_fetch_array($result)) {
        array_push(
          $arrData["data"],
          array(
            "label" => $row["state"],
            "value" => $row["total_orders"],
            "link" => "stateDrillDown.php?state=" . $row["state_no"]
          )
        );
      }

      $jsonEncodedData = json_encode($arrData);

      $columnChart = new FusionCharts("column2D", "myFirstChart", 600, 300, "chart-1", "json", $jsonEncodedData);


      $columnChart->render();

      $dbhandle->close();

    }

    ?>
    <div id="chart-1"><!-- Fusion Charts will render here--></div>
  </body>

</html>