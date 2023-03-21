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

<h1 class="text-center">Список категорій</h1>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php"); ?>

<div class="container">
    <a href="/categories/create.php" class="btn btn-success">Додати категорію</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Фото</th>
            <th scope="col">Назва</th>
            <th scope="col">Опис</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        <?php
        $sql = "SELECT * FROM tbl_categories";
        $command = $dbh->query($sql);
        foreach ($command as $row) {
            $image = $row["image"];
            $id = $row["id"];
            $name = $row["name"];
            $description = $row["description"];
            echo "
            <tr>
                <th><img src='$image' alt='' width='50'></th>
                <td>$name</td>
                <td>$description</td>
                <td><a href='/categories/edit.php?id=$id' class='btn btn-secondary'>Змінити</a></td>
                <td>
                    <button onclick='categoryToDelete = $id' type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal'>Remove</button>
                </td>
            </tr>
            ";
        }
        ?>
        </tbody>
    </table>

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
