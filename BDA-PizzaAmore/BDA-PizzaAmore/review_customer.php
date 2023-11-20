<?php
include 'db_connection.php';

try {
    $pdo->beginTransaction();

    // 1. 가게의 리뷰 평균 평점을 가져오는 쿼리
    $sqlGetAverageRating = "SELECT store_ID, AVG(ranking) as avg_rating FROM reviews GROUP BY store_ID";
    $stmtGetAverageRating = $pdo->prepare($sqlGetAverageRating);

    // Execute the query
    $stmtGetAverageRating->execute();

    // Fetch the result into an associative array
    $averageRatings = $stmtGetAverageRating->fetchAll(PDO::FETCH_ASSOC);

    // 2. 가져온 평균 평점을 기반으로 가게들을 정렬하는 쿼리
    $sortedStores = array();
    foreach ($averageRatings as $rating) {
        $storeID = $rating['store_ID'];
        $avgRating = $rating['avg_rating'];

        // You can perform additional processing or formatting if needed

        // Add to the array for sorting
        $sortedStores[$storeID] = $avgRating;
    }

    // Sort the stores based on average rating in descending order
    arsort($sortedStores);

    // Commit the transaction if everything is successful
    $pdo->commit();

    // Now $sortedStores array contains the stores sorted by average rating
    // You can use this array to display the ranking on the webpage

    // ... (display the ranking as needed)
} catch (PDOException $e) {
    // Handle exceptions
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
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
    <title>Management</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: 1px solid #ddd;
            padding: 16px;
            margin: 16px 0;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* 행별 구분선 스타일 */
            border-bottom: 1px solid #333;
        }


        /* 각 card 요소 사이에 행별 구분선 스타일 */
        .card .card {
            border-top: 1px solid #ccc;
            margin-top: 0;
            /* 상단 마진을 없애서 구분선이 겹치지 않도록 합니다. */
        }

        hr {
            margin: 5px 0;
            /* 여백 설정 */
            border: none;
            /* 기본 선 제거 */
            border-top: 1px solid #ddd;
            /* 위쪽 선 추가 */
        }

        h1,
        h2,
        h3 {
            color: #333;
        }

        h2,
        h3 {
            margin-bottom: 8px;
        }

        span {
            display: block;
            margin-bottom: 8px;
        }

        /* Additional styles for improved layout */
        .top-ranked {
            border: 2px solid #4CAF50;
        }

        .bottom-ranked {
            border: 2px solid red;
        }

        .comments {
            margin-top: 8px;
        }

        .comments p {
            margin: 4px 0;
        }
    </style>
</head>

<body id="page-body">
    <nav>
        <ul>
            <li>
                <a href="customer.html" class="logo">
                    <img src="logo.jpg" alt="nav-bars">
                    <span class="nav-item">Homepage</span>
                </a>
            </li>
            <li>
                <a href="item_ranking.php">
                    <i class="fa-regular fa-user"></i>
                    <span class="nav-item">Menu</span>
                </a>
            </li>

            <li>
                <a href="review_customer.php">
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
        <h1>Top and Bottom 5 Ranking Stores</h1>
        <p>About Ranking store</p>
        <div>
            <?php
            include("database.php");

            // 각 상점별 평균 랭킹 쿼리 (상위 5개)
            $topSql = "SELECT Store.store_ID, Store.store_address, AVG(Reviews.ranking) as avg_ranking
                    FROM Reviews
                    JOIN Store ON Reviews.store_ID = Store.store_ID
                    GROUP BY Store.store_ID
                    ORDER BY avg_ranking DESC
                    LIMIT 5";

            $topResult = $dbhandle->query($topSql);

            // 결과 출력 - 상위 랭킹
            if ($topResult->num_rows > 0) {
                echo '<h2>Top 5 Ranking Stores</h2>';
                while (
                    $row = $topResult->fetch_assoc()
                ) {
                    $storeID = $row["store_ID"];
                    $storeAddress = $row["store_address"];
                    $avgRanking = $row["avg_ranking"];

                    echo '<div class="card top-ranked">';
                    echo '<h3>Store ID: ' . $storeID . '</h3>';
                    echo '<hr>';
                    echo '<span>Store Address: ' . $storeAddress . '</span>';
                    echo '<hr>';
                    echo '<span>Average Ranking: ' . $avgRanking . '</span>';
                    echo '<hr>';

                    //리뷰 총 개수
                    $totalCommentSql = "SELECT COUNT(*) as total_comments FROM Reviews WHERE Reviews.store_ID = '$storeID'";
                    $totalCommentResult = $dbhandle->query($totalCommentSql);
                    $totalCommentRow = $totalCommentResult->fetch_assoc();
                    $totalComments = $totalCommentRow['total_comments'];

                    echo '<span>Total Comments: ' . $totalComments . '</span>';
                    echo '<hr>'; // Display total comments
            

                    // 각 상점별 상위 3개 코멘트 쿼리
                    $commentSql = "SELECT comments FROM Reviews WHERE Reviews.store_ID = '$storeID' ORDER BY ranking ASC LIMIT 3";
                    $commentResult = $dbhandle->query($commentSql);

                    // 코멘트 출력
                    echo '<div class="comments">';
                    while ($commentRow = $commentResult->fetch_assoc()) {
                        echo '<p><span> Comments : ' . $commentRow["comments"] . '</span></p>';
                    }
                    echo '</div>';

                    echo '</div>';
                }
            } else {
                echo "<p>No top-ranking stores found.</p>";
            }
            // 연결 종료
            $dbhandle->close();
            ?>
        </div>
        <div>
            <?php
            include("database.php");

            // 각 상점별 평균 랭킹 및 리뷰 총 개수 쿼리
            $sql = "SELECT store_ID, AVG(ranking) as avg_ranking, COUNT(*) as review_count
                    FROM Reviews
                    GROUP BY store_ID
                    ORDER BY avg_ranking DESC";

            $result = $dbhandle->query($sql);

            // 결과 출력
            if ($result->num_rows > 0) {
                echo "<table><tr><th>Store ID</th><th>Average Ranking</th><th>Total Reviews</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["store_ID"] . "</td><td>" . $row["avg_ranking"] . "</td><td>" . $row["review_count"] . "</td></tr>";
                }
                echo "</table>";

                // Chart data
                $storeIDs = [];
                $avgRankings = [];

                // Reset data seek
                $result->data_seek(0);

                while ($row = $result->fetch_assoc()) {
                    $storeIDs[] = $row["store_ID"];
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
        </div>
    </div>
</body>

</html>