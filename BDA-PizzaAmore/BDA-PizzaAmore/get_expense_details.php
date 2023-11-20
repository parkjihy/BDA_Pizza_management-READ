<?php
session_start();

if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit();
}
$expenseId = $_GET['expense_id'];

include("database.php");

$sql = "SELECT * FROM expenses WHERE expense_ID = $expenseId";
$res = mysqli_query($dbhandle, $sql);

if ($res) {
    $details = mysqli_fetch_assoc($res);
    echo "Selected Expense ID: " . $details['expense_ID'] . "<br>";
    echo "Location Rent: " . $details['location_rent'] . "<br>";
    echo "Water/Electricity Expenses: " . $details['water_electricity_bill'] . "<br>";
    echo "Production Cost: " . $details['production_cost'] . "<br>";
    echo "Maintenance Cost: " . $details['maintenance_cost'] . "<br>";
    echo "Staff Cost: " . $details['staff_cost'] . "<br>";
    echo "Packaging Cost: " . $details['packaging_cost'] . "<br>";
    echo "Store ID: " . $details['store_ID'] . "<br>";
} else {
    echo "Error: " . mysqli_error($dbhandle);
}

mysqli_close($dbhandle);
?>