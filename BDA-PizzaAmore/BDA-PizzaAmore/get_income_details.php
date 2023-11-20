<?php
session_start();

if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit();
}
$incomeId = $_GET['income_id'];

include("database.php");

$sql = "SELECT * FROM income WHERE income_ID = $incomeId";
$res = mysqli_query($dbhandle, $sql);

if ($res) {
    $details = mysqli_fetch_assoc($res);
    echo "Selected Income ID: " . $details['income_ID'] . "<br>";
    echo "Selling Income: " . $details['selling_income'] . "<br>";
    echo "Store ID: " . $details['store_ID'] . "<br>";
} else {
    echo "Error: " . mysqli_error($dbhandle);
}

mysqli_close($dbhandle);
?>