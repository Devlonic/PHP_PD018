<?php
$name ="";
$price = "";
$description = "";
$category_id = "";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php");

    $name=$_POST["name"];
    $price=$_POST["price"];
    $description=$_POST["description"];
    $category_id=$_POST["category_id"];

    $sql = "INSERT INTO `tbl_products`(`name`, `price`, `description`, `category_id`) VALUES (?,?,?,?)";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$name, $price, $description, $category_id]);

    $last_id = $dbh->lastInsertId();


    $imageFileName = "";

    $total = count($_FILES['images']['name']);

    for( $i=0 ; $i < $total ; $i++ ) {
        $tmpFilePath = $_FILES['images']['tmp_name'][$i];

        if ($tmpFilePath != ""){
            $imageFileName = './../files/images/products/'.$_FILES['images']['name'][$i];

            if(move_uploaded_file($tmpFilePath, $imageFileName)) {
                $sql = "INSERT INTO `tbl_product_images`(`id_product`, `image_path`) VALUES (?,?)";
                $stmt= $dbh->prepare($sql);
                $stmt->execute([$last_id, $imageFileName]);
            } else {
                echo 'SERVER FILE UPLOAD ERROR: '.$_FILES['images']['error'];
                exit();
            }
        }
    }

    header("location: /products/list.php");
    exit();
}

?>

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
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php"); ?>

<h1 class="text-center">Додати product</h1>
<div class="container">
    <div class="row">
        <form method="post" enctype='multipart/form-data' class="offset-md-3 col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Назва</label>
                <input type="text" class="form-control" value="<?php echo $name; ?>" required id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" value="<?php echo $price; ?>" required id="price" name="price">
            </div>

            <div class="mb-3">
                <label for="description">Опис</label>
                <textarea required class="form-control" placeholder="Leave a comment here"
                          name="description"
                          id="description"><?php echo $description; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" required name="category_id" id="category_id">
                    <?php
                    $sql = "SELECT `id`, `name`, `image` FROM `tbl_categories`";
                    $command = $dbh->query($sql);
                    foreach ($command as $row) {
                        $image = $row["image"];
                        $id = $row["id"];
                        $name = $row["name"];
                        echo "
                            <option value='$id'>$name</option>
                        ";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input accept="image/*" class="form-control" type="file" name="images[]" id="images" multiple>
                <div class="container" id="imagesContainer">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Додати</button>
        </form>
    </div>
</div>
<script src="/js/displayImages.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>