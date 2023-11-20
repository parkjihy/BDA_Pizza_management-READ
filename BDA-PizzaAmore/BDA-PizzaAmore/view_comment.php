<?php
include("database.php");

// 각 상점별 평균 랭킹 쿼리
$sql = "SELECT store_ID, AVG(ranking) as avg_ranking
            FROM Reviews
            GROUP BY store_ID
            ORDER BY avg_ranking ASC";

$result = $dbhandle->query($sql);

// 결과 출력
if ($result->num_rows > 0) {
    echo "<table><tr><th>Store ID</th><th>Average Ranking</th><th>Top 3 Comments</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $storeID = $row["store_id"];
        $avgRanking = $row["avg_ranking"];

        // 각 상점별 상위 3개 코멘트 쿼리
        $commentSql = "SELECT comments FROM Reviews WHERE store_id = '$storeID' ORDER BY ranking ASC LIMIT 3";
        $commentResult = $dbhandle->query($commentSql);

        // 코멘트 출력
        $comments = [];
        while ($commentRow = $commentResult->fetch_assoc()) {
            $comments[] = $commentRow["comments"];
        }

        echo "<tr><td>" . $storeID . "</td><td>" . $avgRanking . "</td><td>" . implode(", ", $comments) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No results found.";
}

// 연결 종료
$dbhandle->close();
?>