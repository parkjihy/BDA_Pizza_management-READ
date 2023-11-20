<?php
    function db_connect() {
        $db_user = "root";
        $db_pass = "";
        $db_host = "localhost";
        $db_name = "review3";
        $db_type = "mysql";

        $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

        try {
            $pdo = new PDO($dsn, $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("error: ".$e->getMessage());
        }
        return $pdo;
    }
?>