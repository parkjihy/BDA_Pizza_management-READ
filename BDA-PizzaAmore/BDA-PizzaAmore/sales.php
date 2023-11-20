<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
include("database.php");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    $sql = "SELECT income_ID, SUM(selling_income) AS total_amount FROM income GROUP BY income_ID ORDER BY total_amount DESC";
    $res = mysqli_query($dbhandle, $sql);

    if ($res) {
        $data = array();

        while ($newArray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $category = $newArray['income_ID'];
            $totalAmount = $newArray['total_amount'];

            // Add data to the $data array in the format expected by CanvasJS
            $data[] = array("y" => $totalAmount, "label" => $category);
        }
    } else {
        printf("Could not retrieve records: %s\n", mysqli_error($dbhandle));
    }

    mysqli_free_result($res);
    mysqli_close($dbhandle);
}
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
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Income Summary"
                },
                axisY: {
                    title: "Total amount"
                },
                axisX: {
                    title: "Store ID"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.## $",
                    dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
                }]
            });

            // Add click event handler for chart pillars
            chart.options.data[0].click = function (e) {
                var selectedItem = e.dataPoint.label;
                displayIncomeDetails(selectedItem);
            };

            chart.render();

            // Function to display income details
            function displayIncomeDetails(incomeId) {
                // Use AJAX to fetch details for the selected income ID
                // Replace the following line with your actual endpoint
                var url = "get_income_details.php?income_id=" + incomeId;

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        // Display the details in a suitable area on your page
                        document.getElementById("incomeDetails").innerHTML = this.responseText;
                    }
                };
                xhr.open("GET", url, true);
                xhr.send();
            }
        }
    </script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <title>Management</title>
</head>

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
                <a href="profile.html">
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
        <h1>Sales</h1>
        <br>
        <span></span>
        <br>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <br>
        <!-- Display income details here -->
        <div id="incomeDetails"></div>
    </div>
</body>

</html>