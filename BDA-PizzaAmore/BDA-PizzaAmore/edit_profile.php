<?php session_start(); ?>
<HTML>

<HEAD></HEAD>

<BODY>
    <?php
    require_once("config.php");
    $pdo = db_connect();
    $username = $_POST['username'];

    try {
        $sql = "SELECT * FROM Login WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        echo "$count";
    } catch (PDOException $e) {
        echo "" . $e->getMessage();
    }

    if ($count > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        ?>

        <form method="post" action="update_profile.php">
            <table border="1">
                <tr>
                    <td colspan="2"><b>
                            <font color='Red'>Edit Records </font>
                        </b></td>
                </tr>
                <tr>
                    <td width="179"><b>
                            <font>Name<em>*</em></font>
                        </b></td>
                    <td><label>
                            <input type="text" name="profilename"
                                value="<?= isset($row['profilename']) ? htmlspecialchars($row['profilename']) : '' ?>" />
                        </label></td>
                </tr>
                <tr>
                    <td width="179"><b>
                            <font>Id<em>*</em></font>
                        </b></td>
                    <td><label>
                            <input type="text" name="username"
                                value="<?= isset($row['username']) ? htmlspecialchars($row['username']) : '' ?>" />
                        </label></td>
                </tr>
                <tr>
                    <td width="179"><b>
                            <font color='#663300'>role<em>*</em></font>
                        </b></td>
                    <td><label>
                            <input type="text" name="role"
                                value="<?= isset($row['role']) ? htmlspecialchars($row['role']) : '' ?>" />
                        </label></td>
                </tr>
                <tr align="Right">
                    <td colspan="2"><label>
                            <input type="submit" name="submit" value="Edit Records">
                        </label></td>
                </tr>
            </table>
        </form>
        <?php
    }
    ?>
</BODY>

</HTML>