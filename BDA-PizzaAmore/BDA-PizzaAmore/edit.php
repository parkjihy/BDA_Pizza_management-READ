<?php session_start(); ?>
<HTML>

<HEAD></HEAD>

<BODY>
    <?php
    include_once("config.php");
    $pdo = db_connect();
    $stock_name = $_POST['stock_name'];

    try {
        $sql = "SELECT * FROM inventory WHERE stock_name = :stock_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":stock_name", $stock_name, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
    } catch (PDOException $e) {
        echo "" . $e->getMessage();
    }

    if ($count > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <form method="post" action="update.php">
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
                            <input type="text" name="stock_name"
                                value="<?= isset($row['stock_name']) ? htmlspecialchars($row['stock_name']) : '' ?>" />
                        </label></td>
                </tr>
                <tr>
                    <td width="179"><b>
                            <font>Amount<em>*</em></font>
                        </b></td>
                    <td><label>
                            <input type="text" name="stock_amount"
                                value="<?= isset($row['stock_amount']) ? htmlspecialchars($row['stock_amount']) : '' ?>" />
                        </label></td>
                </tr>
                <tr>
                    <td width="179"><b>
                            <font color='#663300'>Cost<em>*</em></font>
                        </b></td>
                    <td><label>
                            <input type="text" name="cost"
                                value="<?= isset($row['cost']) ? htmlspecialchars($row['cost']) : '' ?>" />
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