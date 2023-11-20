<?php session_start(); ?>
<HTML>
    <HEAD> <TITLE></TITLE></HEAD>
    <BODY>
        <?php 
        require_once("config.php"); 
        $pdo = db_connect();

        try { 
            $pdo->beginTransaction();
            $sql = "UPDATE inventory SET stock_name = :stock_name, stock_amount = :stock_amount, cost = :cost WHERE stock_name = :stock_name";
            $stmh = $pdo->prepare($sql);
            $stmh->bindValue(':stock_name', $_POST['stock_name'], PDO::PARAM_STR);
            $stmh->bindValue(':stock_amount', $_POST['stock_amount'], PDO::PARAM_INT);
            $stmh->bindValue(':cost', $_POST['cost'], PDO::PARAM_INT); 
            $stmh->execute(); 
            $pdo->commit(); 
            
        } catch(PDOException $Exception) { 
            $pdo->rollBack();
            print "오류: " . $Exception->getMessage();
        }
        // 세션 변수를 전부 삭제합니다.
        $_SESSION = array();
        // 마지막으로 세션을 파기합니다.
        session_destroy();
        header('location: inventory.php');
        ?>
    </BODY>
</HTML>
