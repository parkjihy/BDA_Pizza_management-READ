<?php
include("database.php");

$sql = "SELECT store_ID, store_address FROM Store";
$result = mysqli_query($dbhandle, $sql);
$stores = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $stores[] = $row;
    }
}

mysqli_close($dbhandle);
?>
