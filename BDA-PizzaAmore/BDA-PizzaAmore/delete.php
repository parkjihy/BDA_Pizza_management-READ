<?php session_start(); ?>

<?php
    require_once("config.php");
    $pdo = db_connect();

    
    try {
        $pdo->beginTransaction();
        $sql = 'DELETE FROM inventory WHERE stock_name = :stock_name';
        echo "nomal";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':stock_name', $_POST['stock_name'], PDO::PARAM_STR);
        $stmt->execute();
        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        $e->getMessage();
    }
    
    $_SESSION = array();

    session_destroy();
    header('location: inventory.php');
?>