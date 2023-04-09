<?php
$product_id = 0;
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    include_once($_SERVER["DOCUMENT_ROOT"]."/connection.php");

    $product_id=$_GET["product_id"];

    $sql = "SELECT image_path
FROM tbl_product_images
where id_product = :id;";
    $stmt= $dbh->prepare($sql);
    $stmt->execute(['id' => $product_id]);
    $results = $stmt->fetchAll();
    foreach ($results as $res) {
        $img = $res['image_path'];
        echo "
            <img alt='bad' class='card-img-top' src='$img'>
        ";
    }


    exit();
}

?>