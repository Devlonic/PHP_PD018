<?php
// get id from GET request
$id = $_POST["id"];

echo $_POST["id"];

// get db connection
include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php");

// create and execute insert statement
$sql = "DELETE FROM tbl_categories WHERE `tbl_categories`.`id` = ?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);
