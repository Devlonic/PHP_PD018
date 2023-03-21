<?php
// get params from POST request
$name = $_POST["name"];
$id = $_POST["id"];
$image = $_POST["image"];
$description = $_POST["description"];

// get db connection
include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php");

// create and execute insert statement
$sql = "UPDATE `tbl_categories` SET `name` = '$name', `image` = '$image', `description` = '$description'  WHERE `tbl_categories`.`id` = $id";
$command = $dbh->exec($sql);

header('Location: '."/"); // redirect to root page (categories)