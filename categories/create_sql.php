<?php
// get params from POST request
$name = $_POST["name"];
$image = $_POST["image"];
$description = $_POST["description"];

// get db connection
include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php");

// create and execute insert statement
$sql = "INSERT INTO `tbl_categories`(`name`, `image`, `description`) VALUES ('$name','$image','$description')";
$command = $dbh->exec($sql);

header('Location: '."/"); // redirect to root page (categories)