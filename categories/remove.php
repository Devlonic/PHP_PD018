<?php
// get id from GET request
$id = $_GET["id"];

// get db connection
include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php");

// create and execute insert statement
$sql = "DELETE FROM `tbl_categories` WHERE `tbl_categories`.`id` = $id";
$command = $dbh->exec($sql);

header('Location: '."/"); // redirect to root page (categories)