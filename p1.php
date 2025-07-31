<?php
// Starting session
include("connection/db.php");
$sqlCN = "ALTER TABLE `sample1` ADD `on_off` INT NULL AFTER `cond`;";
$qCN = mysqli_query($dbConn, $sqlCN) or die(mysqli_error($dbConn));
?>

