<?php

include("database.php");

$sqlProducts = "SELECT * FROM Items";
$resultProducts = $dbhandle->query($sqlProducts);

$sqlTopSellers = "SELECT items.item_ID, items.item_name, SUM(Order_items.amount) AS total_quantity
FROM Order_items
JOIN items ON Order_items.item_ID = items.item_ID
JOIN orders ON Order_items.order_ID = Orders.order_ID
GROUP BY items.item_ID, items.item_name
ORDER BY total_quantity DESC
LIMIT 3";
$resultTopSellers = $dbhandle->query($sqlTopSellers);

$dbhandle->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU</title>
    <style>

        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>MENU</h1>

       
        <h2>All Items</h2>
        <table>
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Size</th>
                <th>Ingredients List</th>
            </tr>
            <?php
           
            while ($row = $resultProducts->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['item_ID']}</td>";
                echo "<td>{$row['item_name']}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['item_category']}</td>";
                echo "<td>{$row['item_size']}</td>";
                echo "<td>{$row['ingredients_list']}</td>";
                echo "</tr>";
            }
            ?>
</table>

<h2>Top 3 Best Sellers</h2>
<table>
    <tr>
        <th>Item Name</th>
        <th>Popularity</th>
    </tr>
    <?php
    
    $starsArray = [5, 4, 3];

    foreach ($resultTopSellers as $key => $row) {
        echo "<tr>";
        echo "<td>{$row['item_name']}</td>";
        echo "<td>" . generateStars($starsArray[$key]) . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php

function generateStars($numStars) {
   
    $numStars = max(1, min(5, $numStars));

    
    $stars = str_repeat("<span style='color: gold;'>&#9733;</span>", $numStars);

    return $stars;
}
?>


    
    </div>
</body>
</html>
