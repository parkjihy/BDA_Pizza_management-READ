<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Statistics</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        canvas {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
  include("database.php");

    // 각 상점별 평균 랭킹 및 리뷰 총 개수 쿼리
    $sql = "SELECT store_id, AVG(ranking) as avg_ranking, COUNT(*) as review_count
            FROM Reviews
            GROUP BY store_id
            ORDER BY avg_ranking DESC";

    $result = $dbhandle->query($sql);

    // 결과 출력
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Store ID</th><th>Average Ranking</th><th>Total Reviews</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["store_id"] . "</td><td>" . $row["avg_ranking"] . "</td><td>" . $row["review_count"] . "</td></tr>";
        }
        echo "</table>";

        // Chart data
        $storeIDs = [];
        $avgRankings = [];

        // Reset data seek
        $result->data_seek(0);

        while ($row = $result->fetch_assoc()) {
            $storeIDs[] = $row["store_id"];
            $avgRankings[] = $row["avg_ranking"];
        }

        // Convert data to JSON format for JavaScript
        $storeIDsJSON = json_encode($storeIDs);
        $avgRankingsJSON = json_encode($avgRankings);
    } else {
        echo "No results found.";
    }

    // 연결 종료
    $dbhandle->close();
    ?>

    <!-- Bar Chart -->
    <canvas id="rankingChart" width="400" height="200"></canvas>

    <script>
        // Parse JSON data from PHP
        var storeIDs = <?php echo $storeIDsJSON; ?>;
        var avgRankings = <?php echo $avgRankingsJSON; ?>;

        // Get chart canvas
        var ctx = document.getElementById('rankingChart').getContext('2d');

        // Create a bar chart
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: storeIDs,
                datasets: [{
                    label: 'Average Ranking',
                    data: avgRankings,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Store ID'
                        }
                    },
                    y: {
                        reverse: true,
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
