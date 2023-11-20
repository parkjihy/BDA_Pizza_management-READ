<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
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
</head>

<body id="page-body">
    <!--side bar-->
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
        <h1>Inventory</h1>
        <br>
        <span>about stock</span>
        <br>
        <!--search-->
        <form method="post" action="">
            <div class="search-container">
                <input type="text" class="search-box" name="search" placeholder="search">
                <button class="search-button" name="search_submit">Search</button>
            </div>
        </form>
        <!--add item-->
        <h4>Add Stock</h4>
        <form method="post" class="inventory-add" action="addstock.php">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" class="form-control" name="stock_name">
            </div>
            <div class="form-group">
                <label for="amount">amount</label>
                <input type="text" class="form-control" name="stock_amount">
            </div>
            <div class="form-group">
                <label for="cost">cost</label>
                <input type="text" class="form-control" name="stock_cost">
            </div>
            <button type="submit" class="btn" name="add">Add</button>
        </form>
        <!--table of stock-->
        <div class="table-box" style="width: 90%;">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        include("database.php");


                        if (isset($_POST["search_submit"])) {
                            $search = $_POST["search"];

                            $sql = "select stock_name, stock_amount, cost from inventory where stock_name like ?";

                            $stmt = $dbhandle->prepare($sql);
                            $search_param = "%" . $search . "%";
                            $stmt->bind_param("s", $search_param);
                            $stmt->execute();

                            $result = $stmt->get_result();
                        } else {
                            $sql = "select stock_name, stock_amount, cost from inventory";

                            $result = $dbhandle->query($sql);
                        }

                        $count = 0;
                        ?>

                        <table class="table text-dark text-center">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col" style="width: 10%;">ID</th>
                                    <th scope="col" style="width: 30%;">NAME</th>
                                    <th scope="col" style="width: 30%;">AMOUNT</th>
                                    <th scope="col" style="width: 30%;">COST</th>
                                    <th scope="col" style="width: 30%;">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $count++;
                                        ?>
                                        <tr>
                                            <th>
                                                <?php echo $count ?>
                                            </th>
                                            <th>
                                                <?php echo $row["stock_name"] ?>
                                            </th>
                                            <th>
                                                <?php echo $row["stock_amount"] ?>
                                            </th>
                                            <th>
                                                <?php echo $row["cost"] ?>
                                            </th>
                                            <th>
                                                <!--edit and delete form-->
                                                <form action="edit.php" method="post" style="display: inline;">
                                                    <input type="hidden" name="stock_name"
                                                        value="<?php echo $row["stock_name"] ?>">
                                                    <button type="submit" name="edit"
                                                        style="border: none; background: none; color: black; cursor: pointer;">Edit</button>
                                                </form>
                                                <form action="delete.php" method="post" style="display: inline;">
                                                    <input type="hidden" name="stock_name"
                                                        value="<?php echo $row["stock_name"] ?>">
                                                    <button type="submit" name="delete"
                                                        style="border: none; background: none; color: black; cursor: pointer;">Delete</button>
                                                </form>
                                            </th>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        $dbhandle->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>