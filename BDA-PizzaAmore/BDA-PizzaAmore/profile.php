<?php
    session_start();

    include("database.php");

    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION["username"];

    $role_query = "SELECT role from login where username = '$username'";
    $result = mysqli_query($dbhandle, $role_query);

    if (!$result) {
        die("Database query failed.");
    }

    $row = mysqli_fetch_assoc($result);
    $user_role = $row["role"];

    if ($user_role == "Manager") {
        header("Location: profile_manager.php");
        exit();
    } else if ($user_role == "Staff") {
        header("Location: profile_staff.php");
        exit();
    }

// whether the user logged in is a manager of employee
if (!isset($_GET['role']) || ($_GET['role'] !== 'Manager' && $_GET['role'] !== 'Staff')) {
    echo 'filed to log in';
    exit();
}

$type = $_GET['role'];

if ($type === 'manager') {
    include('manager_profile.html');
} elseif ($type === 'staff') {
    include('staff_profile.html');
}
?>

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
        <h1>Profile</h1>
        <br>
        <span>Welcome User!</span>
    </div>
</body>

</html>