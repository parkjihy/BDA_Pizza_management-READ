<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="test.js" defer></script>
    <title>Customer</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .section {
            margin: 50px auto;
            max-width: 800px;
        }
        h1 {
            color: #343a40;
            text-align: center;
        }
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            color: #343a40;
        }
        select,
        textarea {
            margin-top: 10px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 14px;
        }
        .btn-primary {
            margin-top: 20px;
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
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
        <h1>Your Review Write</h1>
        <div class="row">
            <!-- Form for submitting a review -->
            <form action="save_review.php" method="post" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="restaurantDropdown">Select the store:</label>
                    <select id="restaurantDropdown" name="restaurantDropdown" class="form-control" required>
                        <?php
                        include 'get_stores.php';
                        foreach ($stores as $store) {
                            echo "<option value='" . $store['store_ID'] . "'> " . $store['store_address'] . " </option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">Please select a store.</div>
                </div>
                <div class="ranking-comment-area">
                    <div class="form-group">
                        <label for="user_rating">Select Rating 🍕</label>
                        <select id="user_rating" name="user_rating" class="form-control" required>
                            <option value="" disabled selected>Select rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <div class="invalid-feedback">Please select a rating.</div>
                    </div>

                    <div class="form-group">
                        <label for="user_comment">Write Comment 🖍</label>
                        <textarea id="user_comment" name="user_comment" class="form-control" placeholder="Type Comment Here" required></textarea>
                        <div class="invalid-feedback">Please write a comment.</div>
                    </div>
                </div>

                <button id="input3" type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>