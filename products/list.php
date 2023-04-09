<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головна сторінка</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/_header.php"); ?>

<h1 class="text-center">Product list</h1>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php"); ?>

<div class="container">
    <a href="/products/create.php" class="btn btn-success">Add product</a>
    <ul>
        <?php
        $sql = "SELECT tbl_products.id, tbl_products.name, tbl_products.price, tbl_products.description, tbl_categories.name AS category FROM tbl_products
            INNER JOIN tbl_categories ON tbl_products.category_id = tbl_categories.id";
        $command = $dbh->query($sql);
        foreach ($command as $row) {
            $id = $row["id"];
            $name = $row["name"];
            $price = $row["price"];
            $description = $row["description"];
            $category = $row["category"];

            echo "
            <li class='list-group m-5'>
                <div class='card bg-light'>
                    <img class='card-img-top'>
                    <div class='card-body'>
                        <h5 class='card-title'>$name</h5>
                        <p class='card-text'>$description</p>
                        <p class='card-text text-primary'>$price</p>
                        <p class='card-footer text-bg-success'>$category</p>
                        <a href='./images.php?product_id=$id' class='stretched-link'></a>
                    </div>
                </div>
            </li>
            ";
        }
        ?>
    </ul>

    <!-- Modal -->
    <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Delete category</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    Are you sure?
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                    <button type='button' class='btn btn-danger' onclick="deleteCategory()">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="./js/deleteCategory.js"></script>
</body>
</html>
