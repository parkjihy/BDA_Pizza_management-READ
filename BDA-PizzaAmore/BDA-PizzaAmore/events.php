<?php
// Assume you have a database connection

include_once "database.php";

// Get current date
$currentDate = date("Y-m-d");

// Retrieve events for the current date
$sql = "SELECT E.*, S.store_address FROM Events E
JOIN Store S ON E.store_ID = S.store_ID
WHERE '$currentDate' BETWEEN E.start_date AND E.end_date";

$result = $dbhandle->query($sql);

// Display events
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="event">';
        echo "<h1>Event: </h1>";
        echo "<span><h3>" . $row["event_name"] . "</h3>";
        echo "<span>Description: " . $row["description"] . "<br>";
        echo "<span>Start Date: " . $row["start_date"] . "<br>";
        echo "<span>End Date: " . $row["end_date"] . "<br>";
        echo "<span>Store Location: " . $row["store_address"];
    }
} else {
    echo "No events available.";
}

$dbhandle->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            color: black;
        }

        header {
            background-color: black;
            color: white;
            padding: 10px;
        }

        .section {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
        }

        .analytics {
            text-align: center;
        }

        .submit-btn {
            background-color: white;
            color: black;
            padding: 10px 20px;
            font-size: 16px;
            border: 1px solid black;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
        }

        .event {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 10px;
            float: left border-radius: 8px;
            box-shadow: 0 4 10px rgba(0, 0, 0, 0.1);
            clear: both;
        }

        .event h1 {
            margin-top: 0;
            color: #333;
        }

        .event h3 {
            color: #007BFF;
        }

        .event span {
            color: #555;
            display: block;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>
    <main class="section">

        <h2>Customer service</h2>

        <div class="analytics">
            <a href="reveiw_write.php" class="submit-btn">write your review</a>
            <a href="item_ranking.php" class="submit-btn">Menu & Best-Sellers</a>
            <a href="review_customer.php" class="submit-btn">Reviews</a>
            <a href="customer_help.html" class="submit-btn">Help</a>
            <a href="events.php" class="submit-btn">Events</a>

        </div>
    </main>
    <div class="events">
        <title>Available Events</title>

    </div>
</body>

</html>