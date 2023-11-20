<?php
$hostdb = "127.0.0.1";
$userdb = "root";
$passdb = "";
$namedb = "review3";
$port = 3306;

$dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb, $port);
if ($dbhandle->connect_error) {
    exit("There was an error with your connection: " . $dbhandle->connect_error);
}
?>