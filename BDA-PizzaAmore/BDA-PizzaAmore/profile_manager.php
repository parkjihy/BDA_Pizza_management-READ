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
    <title>Profile for Manager</title>
    <style>
        .bg-light-gray {
            background-color: #f7f7f7;
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }


        .bg-sky.box-shadow {
            box-shadow: 0px 5px 0px 0px #00a2a7
        }

        .bg-orange.box-shadow {
            box-shadow: 0px 5px 0px 0px #af4305
        }

        .bg-green.box-shadow {
            box-shadow: 0px 5px 0px 0px #4ca520
        }

        .bg-yellow.box-shadow {
            box-shadow: 0px 5px 0px 0px #dcbf02
        }

        .bg-pink.box-shadow {
            box-shadow: 0px 5px 0px 0px #e82d8b
        }

        .bg-purple.box-shadow {
            box-shadow: 0px 5px 0px 0px #8343e8
        }

        .bg-lightred.box-shadow {
            box-shadow: 0px 5px 0px 0px #d84213
        }


        .bg-sky {
            background-color: #02c2c7
        }

        .bg-orange {
            background-color: #e95601
        }

        .bg-green {
            background-color: #5bbd2a
        }

        .bg-yellow {
            background-color: #f0d001
        }

        .bg-pink {
            background-color: #ff48a4
        }

        .bg-purple {
            background-color: #9d60ff
        }

        .bg-lightred {
            background-color: #ff5722
        }

        .padding-15px-lr {
            padding-left: 15px;
            padding-right: 15px;
        }

        .padding-5px-tb {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .margin-10px-bottom {
            margin-bottom: 10px;
        }

        .border-radius-5 {
            border-radius: 5px;
        }

        .margin-10px-top {
            margin-top: 10px;
        }

        .font-size14 {
            font-size: 14px;
        }

        .text-light-gray {
            color: #d6d5d5;
        }

        .font-size13 {
            font-size: 13px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
    </style>
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
        <h1>Profile</h1>
        <br>
        <span>Welcome Manager!</span>
        <br><br>
        <!--profile information-->
        <div class="profile-container">
            <div class="profile-image">
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle"
                    width="150">
            </div>
            <div class="profile-info">
                <div class="card-body">
                    <div class="info-row">
                        <div class="info-label">Name: </div>
                        <div class="info-text">
                            <?php
                            include('database.php');

                            $sql = "SELECT * FROM login WHERE username='" . $_POST['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                            $stmt = $dbhandle->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();

                            if ($row) {
                                echo $row["ProfileName"];
                            }
                            ?>
                            test: Jiyeon Kim
                        </div>
                    </div>
                    <hr>
                    <div class="info-row">
                        <div class="info-label">Id</div>
                        <div class="info-text">
                            <?php
                            include('database.php');

                            $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                            $stmt = $dbhandle->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();

                            if ($row) {
                                echo $row["username"];
                            }
                            ?>

                        </div>
                    </div>
                    <hr>
                    <div class="info-row">
                        <div class="info-label">Role</div>
                        <div class="info-text">
                            <?php
                            include('database.php');

                            $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                            $stmt = $dbhandle->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();

                            if ($row) {
                                echo $row["role"];
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="info-row">
                        <form action="edit_profile.php" method="post" style="display: inline;">
                            <input type="hidden" name="username" value="<?php echo $row['username'] ?>">
                            <button type="submit" name="edit-profile"
                                style="border: none; background: none; color: black; cursor: pointer;">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--schedule-->
        <div class="container">
            <div class="timetable-img text-center">
                <img src="img/content/timetable.png" alt="">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <h3>December</h3>
                        <tr class="bg-light-gray">
                            <th class="text-uppercase">Time
                            </th>
                            <th class="text-uppercase">Monday</th>
                            <th class="text-uppercase">Tuesday</th>
                            <th class="text-uppercase">Wednesday</th>
                            <th class="text-uppercase">Thursday</th>
                            <th class="text-uppercase">Friday</th>
                            <th class="text-uppercase">Saturday</th>
                            <th class="text-uppercase">Sunday</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">09:00 ~ 15:00</td>
                            <td>
                                <span
                                    class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                    <?php
                                    include('database.php');

                                    $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                    $stmt = $dbhandle->prepare($sql);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();

                                    if ($row) {
                                        echo $row["profilename"];
                                    }
                                    ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="align-middle">15:00 ~ 21:00</td>
                            <td>
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td class="bg-light-gray">
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td class="bg-light-gray">
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td class="bg-light-gray">
                                <?php
                                include("database.php");
                                $sql = "SELECT * FROM login WHERE username='" . $_SESSION['username'] . "' && work_day = 'tuesday' && work_time_start = '09:00:00'";
                                $stmt = $dbhandle->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <span
                                            class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">
                                            <?php
                                            echo $row["profilename"];
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>